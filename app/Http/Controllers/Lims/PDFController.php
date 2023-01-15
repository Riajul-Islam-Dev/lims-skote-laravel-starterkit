<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = [
            'title' => 'Test PDF Generate',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('lims.pdf.testPdf', $data);
    
        return $pdf->download('lims.pdf');
    }
}
