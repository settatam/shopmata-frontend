<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

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
        return '<address> This is my store address </address>';
    }

    public function accept($button) {
        return '<button> This is my accept button </button>';
    }

    public function reject($button) {
        return '<button> THis is the reject button</button>';
    }
}
