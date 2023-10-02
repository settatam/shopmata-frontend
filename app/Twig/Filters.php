<?php

namespace App\Twig;

use Illuminate\Support\Facades\URL;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Numeral\Numeral;
use App\Models\Store;
use App\Models\StoreDomain;

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
      new TwigFilter('link', [$this, 'link']),
      new TwigFilter('mail_heading', [$this, 'mailHeading']),
      new TwigFilter('money_format', [$this, 'moneyFormat']),
      new TwigFilter('status_note', [$this, 'statusNote']),
      new TwigFilter('status_length', [$this, 'statusLength']),
      new TwigFilter('salutation', [$this, 'salutation']),
      new TwigFilter('return_label', [$this, 'returnLabel']),
      new TwigFilter('kit_by_mail', [$this, 'kitByMail']),
      new TwigFilter('kit_by_print', [$this, 'kitByPrint']),
      new TwigFilter('payment_information', [$this, 'paymentInformation']),
      new TwigFilter('password_reset_link', [$this, 'passwordResetLink']),
      new TwigFilter('customer_status', [$this, 'customerStatus']),
      new TwigFilter('fedex_inbound_tracking', [$this, 'fedexInboundTracking']),
      new TwigFilter('fedex_outbound_tracking', [$this, 'fedexOutboundTracking']),
      new TwigFilter('fedex_inbound_tracking_sms', [$this, 'fedexInboundTrackingSms']),
      new TwigFilter('fedex_outbound_tracking_sms', [$this, 'fedexOutboundTrackingSms']),
      new TwigFilter('fedex_return_tracking', [$this, 'fedexReturnTracking']),
      new TwigFilter('fedex_return_tracking_sms', [$this, 'fedexReturnTrackingSms']),
      new TwigFilter('transaction_settings', [$this, 'transactionSettings']),
      new TwigFilter('settings_button', [$this, 'settingsButton']),
    ];
  }

  public static function fedexInboundTracking($transaction) {
        return $transaction->addFedexLinksToTrackingNumbers('inbound');
    }

    public static function fedexOutboundTracking($transaction) {
      return $transaction->addFedexLinksToTrackingNumbers('outbound');
    }

    public static function paymentInformation($transaction) {
    $text = 'Access Your Payment Method';
    $url = 'https://'.$transaction->store->store_domain . '/my-settings';
    return self::mail_button($text, $url);
  }

  public static function settingsButton($customer)
    {
        $url = self::transactionSettings($customer);
        return self::mail_button('Update My Settings', $url);
    }

    public static function transactionSettings($customer)
    {
        $store = $customer->store;
        $token = $customer->generateLoginTokenForEmail(false);
        return 'https://' . $store->store_domain . '/my-settings?token='.$token->token;
    }

    public static function fedexReturnTracking($transaction)
    {
        return $transaction->addFedexLinksToTrackingNumbers('return');
    }

    public static function fedexReturnTrackingSms($transaction)
    {
      return $transaction->addFedexLinksToTrackingNumbers('return', false);
    }

    public static function fedexInboundTrackingSms($transaction)
    {
        return $transaction->addFedexLinksToTrackingNumbers('inbound', false);
    }

    public static function fedexOutboundTrackingSms($transaction)
    {
      return $transaction->addFedexLinksToTrackingNumbers('outbound', false);
    }

  public static function countWords($sentence)
  {
    return count(explode(' ', $sentence));
  }

  public static function returnLabel($transaction) {
    $label = $transaction->getReturnLabel();
    $trackingNumber = null;
    if(null !== $label) {
      $trackingNumber =  $label->tracking_number;
      return sprintf('Your tracking number is: <a href="https://www.fedex.com/apps/fedextrack/index.html?tracknumbers=%s"', $label->tracking_number);
    }

    return '';
  }

  public static function salutation($store) {
    $store->load('address');
    $store->load('meta');
    return sprintf('<p>Sincerely, </p> %s Team <br> %s %s <br> %s %s %s',
      $store->getMeta('shipping_display_name'),
      $store->address->street_address,
      $store->address->apt_suite,
      $store->address->city,
      $store->address->resolvedState->code,
      $store->address->zip
    );
  }

  public function payment_type($store) {


  }

  public static function assetUrl($asset) {
    if(session()->has('store_id')) {
      $store = Store::find(session()->get('store_id'));
      return 'https://fashionerize.nyc3.digitaloceanspaces.com/'.$store->slug.'/'.$asset;
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

  public static function accept($transaction) {
    $store = $transaction->store;
    $token = $transaction->customer->generateLoginTokenForEmail(false);
    $url = 'https://' . $store->store_domain . '/transactions/' . $transaction->id . '?accept=1&token='.$token->token;
    return self::mail_button('SELL', $url);
  }

  public static function link($transaction) {
    $store = $transaction->store;
    $token = $transaction->customer->generateLoginTokenForEmail(false);
    return 'https://' . $store->store_domain . '/transactions/' . $transaction->id . '?token='.$token->token;
  }

  public static function passwordResetLink($customer)
  {
    $url = URL::to('/');
    $storeDomain = StoreDomain::with('store')->where('name', $url)->first();
    $store = $storeDomain->store;

    $tokenObj = $customer->getPasswordResetToken();
    $tokenString = sprintf('%s---%s', $customer->email, $tokenObj->token);
    $token = base64_encode($tokenString);
    return 'https://' . $store->store_domain . '/password/change?t='.$token;
  }

  public static function reject($transaction)
  {
    $store = $transaction->store;
    $token = $transaction->customer->generateLoginTokenForEmail(false);
    $url = 'https://' . $store->store_domain . '/transactions/' . $transaction->id . '?decline=1&token='.$token->token;
    return self::mail_button('DENY', $url, '#bcbec0','#FFFFFF','#555555');
  }


  public static function kitByMail($transaction) {
    //create login token ...
    $text = 'Mail My Free Appraisal Kit';
    $token = $transaction->customer->generateLoginTokenForEmail(false);
    $url = 'https://'.$transaction->store->store_domain . '/thank-you/'.$transaction->id . '?token='.$token->token;
    return self::mail_button($text, $url);
  }

  public static function kitByPrint($transaction) {
    //create login token ...
    $text = 'Print Your Free Appraisal Kit';
    $token = $transaction->customer->generateLoginTokenForEmail(false);
    $url = 'https://'.$transaction->store->store_domain . '/thank-you/'.$transaction->id . '?download=1&token='.$token->token;
    return self::mail_button($text, $url);
  }

  public function mailHeading($text) {
    return sprintf('<p style="margin: 15px 0"><span style="text-decoration: underline; font-weight: bold; font-size: 20px">%s</span></p>',
      $text
    );
  }

  public static function mail_button($text,$url='#',$background='#dbf0f1',$textcolor='#000000',$border='#0066aa') {
    return '<a style="background: '.$background.';border: 1px solid '.$border.';box-shadow: inset 1px 1px 0px #fff1cb;color: '.$textcolor.';display: inline-block;vertical-align: middle;padding: 0px 2em;font-size: 13px;line-height: 34px;text-decoration: none;border-radius: 3px;margin-bottom:5px;outline: none;cursor: pointer;text-transform: none;font-weight: normal;" href="'.$url.'">&nbsp;'.$text.'&nbsp;</a>';
  }

  public function moneyFormat($money) {
    return Numeral::number($money)->format('$0,0.00');
  }

  public function statusLength($transaction) {
    if($transaction->payment_date_time) return '0%';
    if($transaction->is_declined || $transaction->is_accepted) return '30%';
    $status_id = (int)$transaction->status_id;
    switch($status_id) {
      case 4:
      case 15:
      case 50:
      case 8:
      case 6:
        return '30%';
      case 24:
      case 2:
        return '50%';
      case 3:
      case 1:
        return '70%';
      default:
        return '90%';

    }
  }

  public function customerStatus($transaction) {
    $status_id = (int)$transaction->status_id;
    switch($status_id) {
      case 8:
      case 25:
      case 13:
      case 11:
        $status = 'Payment Processed';
        break;
      case 60:
      case 54:
      case 53:
      case 57:
      case 58:
        $status = 'Kit Request Pending';
        break;
      case 4:
      case 15:
      case 50:
        $status =  'Offer Given';
        break;
      case 5:
        $status = 'Offer Accepted';
        break;
      case 24:
      case 1:
      case 2:
        $status = 'Kit Received';
        break;
      case 6:
      case 19:
      case 12:
      case 18:
        $status =  'Offer Declined';
        break;
      default:
        $status =  'Processing';
    }

    return $status;
  }

  public function statusNote($transaction) {
    $status_id = (int)$transaction->status_id;
    switch($status_id) {
      case 8:
      case 25:
      case 13:
      case 11:
        return '<h1 class="green">Your Payment is processed!</h1>
                        <p>Congratulations on the sale '.$transaction->customer->first_name.'! Your payment for this transaction has been sent.</p>';
      case 60:
      case 54:
      case 53:
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
      case 5:
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
                                    <b>Attention '.$transaction->customer->first_name.' &mdash; you have not told us how you want to be paid.</b>
                                     <p>Please take a moment and fill out your <a href="/my-settings">payment information</a> so we know how you would like to be paid. You will not be able to accept our offer without providing your information.</p>
                                  </div>';
        }
        $message .= '<b>Here is what happens next ...</b>
                    <p>Once our appraiser reviews your items we will either provide you with an offer, or decline your items. If we decline your items they will be sent back to you promptly. If we are interested in purchasing your items we will provide you with an offer. You will then have the opportunity to accept or decline or offer. If you accept your payment will be sent within 1 business day. If you decline we will return your items to you promptly, at our expense. We will send you or decision very soon, keep an eye on your email and if you have any questions please <a href="/contact-us">contact us</a>.</p>';
        return $message;
      case 6:
      case 19:
      case 12:
      case 18:
        return '<h1 class="red">Offer Declined</h1>
                        <p>'.$transaction->customer->first_name.' we have received your request to decline this transaction. We will return your items to you promptly at our expense. Your items will be sent in 3 - 5 business days. We will let you know when your items ship. Thanks again for your interest and we are sorry that we could not make you an acceptable offer. If you have any questions please <a href="/contact-us.html">contact us</a>.</p>';
      default:
        return '<h1> Kit Processing</h1><p>Your transaction is processing. PLease contact us to find out more about your kit.</p>';

    }
  }
}
