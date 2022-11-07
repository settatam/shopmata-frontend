<?php

namespace App\Services;

use App\Contracts\SmsContract;
use App\Exceptions\SMSException;
use App\Models\Verification;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use App\Models\Store;
use App\Models\Meta;
use App\Models\Transaction;
use App\Models\UnreachableSmsNumber;

class SmsManager
{
    private $sid;
    private $token;
    public $from;

    public function __construct(Store $store)
    {

        $this->sid = $store->getMeta(Meta::SMS_SID);
        $this->token = config('twilio.token');
        $this->from = $store->getMeta(Meta::SMS_NUMBER);

        if(!$this->from) {
            throw new \Exception('You need to have a from number to send SMS');
        }
    }

    /**
     * @throws SMSException
     */
    public function sendSMS($message, $to, $images=[]): array
    {
        //if(env('APP_ENV') !== 'production') $to = '2679809681';

        if(!$to) {
            return [
                'error' => true,
                'message' => 'There has to be a phone number'
            ];
        }

        try {
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

    static function saveIncomingFromTwilio($data) {
        //$output = json_decode($data, true);
        parse_str($data, $output);
        $messages = explode('@', $output['Body'], 2);

        if(count($messages) == 2) {
            $message = $messages[1];
            $transaction_id = trim($messages[0]);
        }else{
            $transaction_id = null;
            $message = $output['Body'];
        }

        $images = [];

        foreach($output as $index => $image) {
            if (preg_match("/mediaUrl/i", $index)) {
                $images[] = $image;
            }
        }

        $transaction = Transaction::activeByPhone($output['From']);

        if(null !== $transaction) {
            $sms = $transaction->sms()->create([
                 'to' => $output['To'],
                 'from' => $output['From'],
                 'message' => $output['Body'],
                 'payload' => json_encode($output),
                 'is_coming' => 1
             ]);

            if(count($images)) {
                foreach ($images as $image) {
                    $sms->images()->create([
                        'url' => $image,
                        'thumb' => $image,
                        'rank' => 1
                    ]);
                }
            }

            return $transaction;
        }
        return false;
    }
}
