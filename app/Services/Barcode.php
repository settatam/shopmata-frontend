<?php

namespace App\Services;

class Barcode
{
    public static function generate($transaction) {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

		$barcode_data = $generator->getBarcode($transaction->id, $generator::TYPE_CODE_128,1.8,45);

		$i = imagecreatetruecolor(390, 78);
		$x = imagecreatefromstring($barcode_data);

		$w = imagecolorallocate($i, 255, 255, 255);
		imagefill($i,0,0,$w);

		// $t2 = imagecolorallocatealpha($i, 0, 0, 0, 0);
		// imagecolortransparent($i,$t2);

		imagealphablending($i,true);
		imagealphablending($x,true);
		imagesavealpha($i, true);
		imagesavealpha($x, true);
		$t = imagecolorallocatealpha($x, 255, 255, 255, 127);
		imagecolortransparent($x,$t);

		imagecopy($i, $x, 10, 5, 0, 0, imagesx($x), imagesy($x));

		$text = imagecolorallocate($i, 0, 0, 0);
		$font = public_path().'/fonts/arial.ttf';
		$font_size = 10;
		$line_height = $font_size + 5;
		$y = $line_height;

		imagettftext($i, 10, 0, 10, 65, $text, $font, '#'.$transaction->id);

		imagettftext($i, $font_size, 0, 150, $y, $text, $font, $transaction->customer->first_name .' '. $transaction->customer->last_name); $y += $line_height;
		$y += 5;
		$font_size = 8;
		imagettftext($i, $font_size, 0, 150, $y, $text, $font, $transaction->customer->address); $y += $line_height;
		imagettftext($i, $font_size, 0, 150, $y, $text, $font, $transaction->customer->city.', '.$transaction->customer->state->code .', '.$transaction->customer->zip); $y += $line_height;
		/* remove phone number from label requested July 2019 *//* if (!empty($order_info['customer_phone'])) { imagettftext($i, $font_size, 0, 150, $y, $text, $font, $order_info['customer_phone']); $y += $line_height; } */
		// imagettftext($i, $font_size, 0, 150, $y, $text, $font, $order_info['customer_email']); $y += $line_height;

        ob_start();
		imagepng($i);
        $image_data = ob_get_contents();
        ob_end_clean();

        return base64_encode($image_data);
    }
 }
