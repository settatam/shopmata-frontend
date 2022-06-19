<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Functions extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('now', [$this, 'now']),
            new TwigFunction('has_payment_method', [$this, 'hasPaymentMethod']),
        ];
    }

    public static function now()
    {
      return date('d/m/Y H:i:s');
    }

    public function hasPaymentMethod($transaction) {
        return $transaction->isValidPaymentAddress();
    }

}
