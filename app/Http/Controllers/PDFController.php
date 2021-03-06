<?php

namespace App\Http\Controllers;


use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = \View::make('pages.pdf')->render();

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
