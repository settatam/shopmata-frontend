<?php

namespace App\Http\Controllers;

use App\Services\Barcode;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use App\Models\Transaction;
use App\Models\Store;


class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trackKit($id)
    {
        $transaction = Transaction::find($id);
        $store = Store::find(session()->get('store_id'));
        $shippingLabel = $transaction->getShippingLabel('to');
        //base64Label
        $barcode = Barcode::generate($transaction);
        $label = $shippingLabel->base64Label;

        $view = \View::make('pages.pdf', compact('barcode', 'label')->render());

        try {
            $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($view);
            $html2pdf->output('my-appraisal-kit.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }

    }


}
