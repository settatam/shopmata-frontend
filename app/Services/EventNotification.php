<?php
namespace App\Services;

use App\Exceptions\InvalidInputException;
use App\Exceptions\SMSException;
use App\Models\EmailNotificationMessageSent;
use App\Models\Order;
use App\Models\Sms;
use App\Models\SMSMessage;
use App\Models\StoreNotificationMessage;
use App\Mail\EmailSender;
use App\Models\Store;
use App\Models\ThemeFile;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Twig\Environment;
use Illuminate\Support\Facades\Auth;


class EventNotification
{
    protected $transaction = NULL;
    protected $customer = NULL;
    protected $order = NULL;
    protected $data = [];
    protected $event = '';
    protected $options;

    /**
     * @throws InvalidInputException
     */
    public function __construct($event, $data, $options=[]) {
          $this->data = $data;
          $this->event = $event;
          $this->options = $options;

          if(!count($this->data)) {
              throw new InvalidInputException('There is no event');
          }
          if(!isset($data['store_id'], $data['customer_id'])) {
//              throw new InvalidInputException("You must attach a store and customer to an event notification");
          }

          if(!isset($this->options['for'])) {
              $this->options['for'] = 'transaction';
          }

          $this->options['smsable_id'] = $this->data[$this->options['for']]->id;
          $this->options['smsable_type'] = get_class($this->data[$this->options['for']]);

          $this->getAndSendMessages();
    }

    /**
     * @throws InvalidInputException
     */
    public function getAndSendMessages() {
        $storeNotificationMessages = StoreNotificationMessage::getAllMessages($this->data['store']->id, $this->event);
        $messageData = [];

        if(count($storeNotificationMessages)) {

            $messageData['is_customer'] = $storeNotificationMessages[0]->store_notification->is_customer;

            $this->data['store']->load('address');
            $messageData['store'] = $this->data['store'];
            $messageData['user'] = isset($this->data['user']) ? $this->data['user'] : NULL;
            $messageData['customer'] = isset($this->data['customer']) ? $this->data['customer'] : NULL;
            $messageData['transaction'] = isset($this->data['transaction']) ? $this->data['transaction'] : NULL;
            $messageData['order'] = isset($this->data['order']) ? $this->data['order'] : NULL;

            foreach($storeNotificationMessages as $storeNotificationMessage) {

                switch ($storeNotificationMessage->channel) {
                    case 'email':
                        if($storeNotificationMessage->message) {
                            $messageData['notification_id'] = $storeNotificationMessage->id;
                            $messageData['to'] = ($storeNotificationMessage->store_notification->is_customer) ? $this->data['customer']->email : $this->data['user']->email;
                            $messageData['subject'] = ThemeFile::generateParsedContent($storeNotificationMessage->email_subject, $messageData);
                            $messageData['content_for_email'] = ThemeFile::generateParsedContent($storeNotificationMessage->message, $messageData);
                            $emailTemplate = ThemeFile::getTemplateFor($this->data['store'], 'email');
                            $templateContent = null !== $emailTemplate ? $emailTemplate->content : '';
                            $messageData['parsed_message'] = html_entity_decode(ThemeFile::generateParsedContent($templateContent, $messageData));
                            $this->sendEmail($messageData);
                        }
                        break;
                    case 'sms':
                        if($storeNotificationMessage->message) {
                            $messageData['parsed_message'] = html_entity_decode(ThemeFile::generateParsedContent($storeNotificationMessage->message, $messageData));
                            $messageData['notification_id'] = $storeNotificationMessage->id;
                            $messageData['is_customer'] = $storeNotificationMessage->is_customer;
                            $this->sendSMS($messageData);
                        }
                        break;
                    default:
                }
            }
        } else {
//            throw new InvalidInputException('There are no messages for this event in the selected store');
        }

    }

    public function sendEmail($data) {

        if(env('APP_ENV') != 'production') {
            $data['to'] = env('DEVELOPER_EMAIL', 'seth.atam@gmail.com');
        }

        try {
          Mail::to($data['to'])->send(new EmailSender($data));

          $emailNotificationMessageSent = new EmailNotificationMessageSent();

          $emailNotificationMessageSent->sent_to = $data['to'];
          $emailNotificationMessageSent->store_id = $data['store']->id;
          $emailNotificationMessageSent->subject = $data['subject'];
          $emailNotificationMessageSent->message = $data['parsed_message'];
          $emailNotificationMessageSent->save();
        } catch (\Exception $e) {
          Log::error('Log issues');
        }

    }

    public function sendSMS($data) {

        $renderedMessage = $data['parsed_message'];
        if(strlen($renderedMessage) > 160) {
//            throw new InvalidInputException("An SMS has a maximum character length of 160");
        }

        if(env('APP_ENV') != 'production') {
            if($data['is_customer']) {
                $data['customer']->phone_number = env('DEVELOPER_PHONE', '2679809681');
            }else{
                $data['user']->phone_number = env('DEVELOPER_PHONE', '2679809681');;
                $data['customer'] = $data['user'];
            }

        }

//        if(is_null($data['customer']->phone_number)) {
//            return;
//        }

        $smsSender = new SmsManager($data['store']);
        try {
            if ($isCustomer = data_get($data, 'is_customer')) {
                if($data['customer']->phone_number) {
                    $smsSender->sendSMSForStore($data['store'], $renderedMessage, $data['customer']->phone_number);
                    if(Sms::create([
                        'from' => $smsSender->from,
                        'to' => $data['customer']->phone_number,
                        'store_id' => $data['store']->id,
                        'message' => $renderedMessage,
                        'smsable_id' => $this->options['smsable_id'],
                        'smsable_type' => $this->options['smsable_type']
                    ])) {
                        Log::info(Auth::id() . ' created a new SMS message');
                    }
                }
            } else {
                if($data['user']->phone_number) {
                    //We don't care about SMS sent to users for now
                    $smsSender->sendSMSForStore($data['store'], $renderedMessage, $data['user']->phone_number);
                }
            }

        } catch(SMSException $e) {
           // throw new InvalidInputException($e);
        }
    }
}
