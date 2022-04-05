<?php
namespace App\Services;

use App\Exceptions\InvalidInputException;
use App\Exceptions\SMSException;
use App\Models\EmailNotificationMessageSent;
use App\Models\Order;
use App\Models\SMSMessage;
use App\Models\StoreNotificationMessage;
use App\Mail\EmailSender;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Twig\Environment;


class EventNotification
{
    protected $transaction = NULL;
    protected $customer = NULL;
    protected $order = NULL;
    protected $data = [];
    protected $event = '';

    /**
     * @throws InvalidInputException
     */
    public function __construct($event, $data) {
          $this->data = $data;
          $this->event = $event;
          if(!count($this->data)) {
              throw new InvalidInputException('There is no event');
          }
          if(!isset($data['store_id'], $data['customer_id'])) {
//              throw new InvalidInputException("You must attach a store and customer to an event notification");
          }
          $this->getAndSendMessages();
    }

    /**
     * @throws InvalidInputException
     */
    public function getAndSendMessages() {
        $storeNotificationMessages = StoreNotificationMessage::getAllMessages($this->data['store']->id, $this->event);

        $messageData = [];

        if(count($storeNotificationMessages)) {

            $messageData['store'] = $this->data['store'];
            $messageData['user'] = isset($this->data['user']) ? $this->data['user'] : NULL;
            $messageData['customer'] = isset($this->data['customer']) ? $this->data['customer'] : NULL;
            $messageData['transaction'] = isset($this->data['transaction']) ? $this->data['transaction'] : NULL;
            $messageData['order'] = isset($this->data['order']) ? $this->data['order'] : NULL;

            foreach($storeNotificationMessages as $storeNotificationMessage) {
                //Check to see if the message is for customer or for a user ...
                if($storeNotificationMessage->is_customer && null === $this->data['customer']) {
                    throw new \Exception('You need a customer object');
                }

                if(!$storeNotificationMessage->is_customer && null === $this->data['user']) {
                    throw new \Exception('You need a user object');
                }

                $messageData['to'] = ($storeNotificationMessage->is_customer) ? $this->data['customer']->email : $this->data['user']->email;

                $template = \Twig::createTemplate($storeNotificationMessage->message);
                $renderedMessage = \Twig::render($template, $messageData);

                $messageData['parsed_message'] = $renderedMessage;
                $messageData['subject'] = $storeNotificationMessage->email_subject;

                switch ($storeNotificationMessage->channel) {
                    case 'email':
                        //Get the template
                        //Form the
                        $this->sendEmail($messageData);
                        break;
                    case 'sms':
                        $this->sendSMS($messageData);
                        break;
                    default:
                }
            }
        } else {
//            throw new InvalidInputException('There are no messages for this event in the selected store');
        }


    }

    public function sendEmail($data) {

        Mail::to($data['to'])->send(new EmailSender($data));

        $emailNotificationMessageSent = new EmailNotificationMessageSent();

        $emailNotificationMessageSent->sent_to = $data['to'];
        $emailNotificationMessageSent->store_id = $data['store']->id;
        $emailNotificationMessageSent->subject = $data['subject'];
        $emailNotificationMessageSent->message = $data['parsed_message'];

        $emailNotificationMessageSent->save();
    }

    public function sendSMS($data){
        //
        //Send Email (Get message template ...
        //Send SMS
        $renderedMessage = $data['parsed_message'];
        if(strlen($renderedMessage) > 160) {
            throw new InvalidInputException("An SMS has a maximum character length of 160");
        }
        if(is_null($data['customer']->phone_number)) {
            return;
        }
        //Create a class to send the SMS and call the sender statically ...
        $smsSender = new SmsManager();
        try {
            $smsSender->sendSMS($renderedMessage, $data['customer']->phone_number);
        } catch(SMSException $e) {
            throw new InvalidInputException($e);
        }
        //Save the sent message in a database ..
        $smsMessage = new SMSMessage();
        $smsMessage->from = $smsSender->from;
        $smsMessage->to = $data['customer']->phone_number;
        $smsMessage->store_id = $data['store']->id;
        $smsMessage->customer_id = $data['customer']->id;
        $smsMessage->message = $renderedMessage;
        $smsMessage->save();
        //Call the table something like SMS messages.
        //We should be able to search the messages

    }
}
