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
                break;
            case 4:
            case 15:
            case 50:
                return '<h1 class="grey">' .$transaction->customer->first_name. ', we love what you sent us! Here is our offer:</h1><div class="our-offer">
                        <b>'.$transaction->final_offer.'</b></div><p>Great news! ' . $transaction->customer->first_name . ', our expert appraiser just approved an offer of '. $transaction->final_offer .' for your transaction. This amount also includes a 10% bonus for being a first time seller to ' . $transaction->store->name. '.</p>
                        <b>The choice is yours ...</b>
                        <p>If you accept our offer of ' .$transaction->final_offer. ' you will get paid by the end of the day. </p>
                        <button class="accept-offer">Accept Offer</button>
                        <br/><br/><p>If you decline our offer we will ship your items back to you at our expense.</p><button class="decline-offer">Decline Offer</button><p>If you have any questions before making your decision please <a href="/contact-us">contact us</a>.</p>';
                break;
            case 8:
                return '<h1 class="green">Offer Accepted!</h1>
                        <p>Wonderful '.$transaction->customer->first_name.'!,  We will send your payment of '. $transaction->final_offer .' to you within one business day. You will receive one last notification from us when it is sent. Thank you again for your business, and please think of us again next time you have something to sell! If you have any questions please <a href="/contact-us">contact us</a>.</p>';
            case 24:
            case 1:
            case 2:
                $message = '<h1>' .$transaction->customer->first_name. ', we have received your items!</h1>';
                $message .= '<p>Your items have arrived and an expert appraiser will review them shortly. If we have any questions we will reach out to you. Please review your <a href="/my-settings">settings</a> to make sure we have the right contact and payment information for you. We will send an offer to you for this transaction within 1 business day.</p>';
                if(!$transaction->hasPaymentInfo) {
                    $message .= '<div class="red payment-info-notice">
		                            <i class="fa fa-fw fa-warning"></i>
                                    <b>Attention <?php echo $first_name; ?> &mdash; you have not told us how you want to be paid.</b>
                                     <p>Please take a moment and fill out your <a href="/my-settings">payment information</a> so we know how you would like to be paid. You will not be able to accept our offer without providing your information.</p>
                                  </div>';
                }
                $message .= '<b>Here is what happens next ...</b>
                    <p>Once our appraiser reviews your items we will either provide you with an offer, or decline your items. If we decline your items they will be sent back to you promptly. If we are interested in purchasing your items we will provide you with an offer. You will then have the opportunity to accept or decline or offer. If you accept your payment will be sent within 1 business day. If you decline we will return your items to you promptly, at our expense. We will send you or decision very soon, keep an eye on your email and if you have any questions please <a href="/contact-us">contact us</a>.</p>';
                return $message;
            default:
                return 'this is another test for the rest of the statuses';

        }
    }
 }
