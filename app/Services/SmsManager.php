<?php

namespace App\Services;

use App\Contracts\SmsContract;
use App\Exceptions\SMSException;
use App\Models\Verification;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use App\Models\Store;

class SmsManager
{
    private $sid;
    private $token;
    public $from;

    public function __construct(Store $store)
    {
        $this->sid = config('twilio.sid');
        $this->token = config('twilio.token');
        $this->from = $store->sms_send_from;

        if(!$this->from) {
            throw new \Exception('You need to have a from number to send SMS');
        }
    }

    /**
     * @throws SMSException
     */
    public function sendSMS($message, $to, $images=[]): array
    {
        if(env('APP_ENV') !== 'production') $to = '2679809681';

//        try {
            $client = new Client($this->sid, $this->token);

            $messageToSend = [
                    'from' => $this->from,
                    'body' => $message
                ];

            if(count($images)) {
                $messageToSend['mediaUrl'] = $images;
            }

            $sender =  $client->messages->create(
                $to,
                $messageToSend
            );


            return [
                'error' => false,
                'message' => 'Message sent successfully'
            ];

//        } catch (TwilioException $exception) {
//            //We want to know why the mesaage was not sent. Store in DB???
//            return [
//                'error' => true,
//                'message' => $exception->getMessage()
//            ];
//        }

    }

    /**
     * @throws SMSException
     */
    public function sendSMSForStore(Store $store, $message, $to): void
    {
        $this->from = $store->sms_send_from;
        //We will change the SID and token here and check if the store has SMS enabled
        $this->sendSMS($message, $to);
    }
}