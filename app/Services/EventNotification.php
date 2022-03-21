<?php
namespace App\Services;

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

    public function __construct($event, $data) {
          $this->data = $data;
          $this->event = $event;
          if(!count($this->data)) {
              throw new \Exception('There is no event');
          }
    }

    public function getAndSendMessages() {
        $messages = StoreNotificationMessage::getAllMessages($this->data['store_id'], $this->event);
        $messageData = [];

        if(count($messages)) {
            $messageData['store'] = Store::find($this->data['store_id']);
            if(isset($this->data['customer_id'])) $messageData['customer'] = Customer::find($this->data['customer_id']);
            if(isset($this->data['transaction_id'])) $messageData['transaction'] = Transaction::find($this->data['transaction_id']);
            if(isset($this->data['order_id'])) $messageData['order'] = Order::find($this->data['order_id']);
        }

        foreach($messages as $message) {
            switch ($message->channel) {
                case 'email':
                    $messageData['message'] = $message->message;
                    //Get the template
                    //Form the
                    return $this->sendEmail($messageData);
                    break;
                case 'sms':
                   return $this->sendSMS($messageData);
                   break;
                default:
            }
        }
        //Get all messages
    }

    public function sendEmail($data) {
        return Mail::to('seth.atam@gmail.com')->send(new EmailSender($data));
    }

    public function sendSMS($message){
        //
        //Send Email (Get message template ...
        //Send SMS
        $d['name'] = 'Seth Atam';
        $template = \Twig::createTemplate('hello {{ name }}');

        $message = \Twig::render($template, $d);
        //Create a class to send the SMS and call the sender statically ...
        //Save the sent message in a database ..
        //Call the table something like SMS messages.
        //We should be able to search the messages

    }
}
