<?php

namespace App\Widget;
use App\Widget\Filter\OffersGivenCnotesandPicturesActions;

class OffersGivenCnotesandPictures extends Form
{
    public function shouldConfirm()
    {
        return true;
    }

    public function name() {
        return 'transaction-actions';
    }

    public function formGroups($filter)
    {
        return [
            [
                'field' => (new OffersGivenCnotesandPicturesActions())->render($filter)
            ]
        ];
    }
}
