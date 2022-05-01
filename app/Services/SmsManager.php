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

    public function __construct()
    {
        $this->sid = config('twilio.sid');
        $this->token = config('twilio.token');
        $this->from = config('twilio.from');
    }

    /**
     * @throws SMSException
     */
    public function sendSMS($message, $to): array
    {
        if(env('APP_ENV') !== 'production') $to = '299679809681';

        try {
            $client = new Client($this->sid, $this->token);
            $sender =  $client->messages->create(
                $to,
                [
                    'from' => $this->from,
                    'body' => $message
                ]
            );

            return [
                'error' => false,
                'message' => 'Message sent successfully'
            ];

        } catch (TwilioException $exception) {
            //We want to know why the mesaage was not sent. Store in DB???
            return [
                'error' => true,
                'message' => $exception->getMessage()
            ];
        }

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
