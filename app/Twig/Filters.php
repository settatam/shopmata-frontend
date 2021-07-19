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
        ];
    }
 
    public static function countWords($sentence)
    {
      return count(explode(' ', $sentence));
    }

    public static function assetUrl($asset) {
        return 'https://fashionerize.nyc3.digitaloceanspaces.com/teheelar/'.$asset;
    }
}