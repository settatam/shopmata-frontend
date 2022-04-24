<?php

namespace App\Services;

class Barcode
{
    public static function generate($transaction) {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

		$barcode_data = $generator->getBarcode($transaction_id, $generator::TYPE_CODE_128,1.5,70);

		$i = imagecreatetruecolor(390, 88);
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

		imagecopy($i, $x, 0, 0, 0, 0, imagesx($x), imagesy($x));

		$text = imagecolorallocate($i, 0, 0, 0);
		$font = public_path().'/fonts/arial.ttf';
		$font_size = 10;
		$line_height = $font_size + 5;
		$y = $line_height;

		imagettftext($i, 10, 0, 1, 85, $text, $font, '#'.$transaction->id);

		imagettftext($i, $font_size, 0, 150, $y, $text, $font, $transaction->customer->name); $y += $line_height;
		$y += 5;
		$font_size = 8;
		imagettftext($i, $font_size, 0, 150, $y, $text, $font, $order_info['customer_address']); $y += $line_height;
		imagettftext($i, $font_size, 0, 150, $y, $text, $font, $order_info['customer_city'].', '.$order_info['customer_state'].', '.$order_info['customer_zip']); $y += $line_height;
		/* remove phone number from label requested July 2019 *//* if (!empty($order_info['customer_phone'])) { imagettftext($i, $font_size, 0, 150, $y, $text, $font, $order_info['customer_phone']); $y += $line_height; } */
		// imagettftext($i, $font_size, 0, 150, $y, $text, $font, $order_info['customer_email']); $y += $line_height;


		header("Content-type:image/png");
		imagepng($i);
    }
 }
