<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Numeral\Numeral;
use App\Models\Store;

class Filters extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('count_words', [$this, 'countWords']),
            new TwigFilter('asset_url', [$this, 'assetUrl']),
            new TwigFilter('address', [$this, 'address']),
            new TwigFilter('accept', [$this, 'accept']),
            new TwigFilter('reject', [$this, 'reject']),
            new TwigFilter('money_format', [$this, 'moneyFormat']),
            new TwigFilter('status_note', [$this, 'StatusNote']),
        ];
    }

    public static function countWords($sentence)
    {
      return count(explode(' ', $sentence));
    }

    public static function assetUrl($asset) {
        if(session()->has('store_id')) {
            $store = Store::find(session()->get('store_id'));
            return 'https://fashionerize.nyc3.cdn.digitaloceanspaces.com/'.$store->slug.'/'.$asset;
        }
        return $asset;
    }

    public function address($address) {
        return sprintf('<address> %s <br> %s <br> %s %s %s </address>',
            $address->address,
            $address->address2,
            $address->city,
            $address->state,
            $address->zip
        );
    }

    public function accept($button) {
        return '<button> This is my accept button </button>';
    }

    public function reject($button) {
        return '<button> THis is the reject button</button>';
    }

    public function moneyFormat($money) {
        return Numeral::number($money)->format('$0,0.00');
    }

    public function statusNote($transaction) {
        $status_id = (int)$transaction->status_id;
        switch($status_id) {
            case 60:
                return '<h1>We have received your request for a kit!</h1>
                        <b>Here is what happens next ...</b>
                        <p>Within one business day we will ship an appraisal kit to you. It will take 2-3 days to arrive. If you do not want to wait you can also <a href="/track-my-kit.html?kit=<?php echo $transaction_id; ?>">download</a> and print your own kit.</p>
                        <b>'.$transaction->customer->first_name.', when you receive your kit ...</b>
                        <p>Follow the instructions inside to learn how to properly pack and return your items to us. Everything you need is provided in this kit including a pre-paid and insured shipping label. We have an <a href="/faqs">FAQ</a> that answers the most common questions and if you have any more please <a href="/contact-us.html">contact us</a>.</p>';
            case 4:
                return '<h1 class="grey">' .$transaction->customer->first_name. ', we love what you sent us! Here is our offer:</h1><div class="our-offer">
                        <b>'.$transaction->final_offer.'</b></div><p>Great news! ' . $transaction->customer->first_name . ', our expert appraiser just approved an offer of '. $transaction->final_offer .' for your transaction. This amount also includes a 10% bonus for being a first time seller to ' . $transaction->store->name. '.</p>
                        <b>The choice is yours ...</b>
                        <p>If you accept our offer of ' .$transaction->final_offer. ' you will get paid by the end of the day. </p>
                        <button class="accept-offer">Accept Offer</button>
                        <br/><br/><p>If you decline our offer we will ship your items back to you at our expense.</p><button class="decline-offer">Decline Offer</button><p>If you have any questions before making your decision please <a href="/contact-us">contact us</a>.</p>';
            case 5:
                return '<h1 class="green">Offer Accepted!</h1>
                        <p>Wonderful '.$transaction->customer->first_name.'!,  We will send your payment of '. $transaction->final_offer .' to you within one business day. You will receive one last notification from us when it is sent. Thank you again for your business, and please think of us again next time you have something to sell! If you have any questions please <a href="/contact-us">contact us</a>.</p>';
            default:
                return 'this is another test for the rest of the statuses';

        }
    }
 }
