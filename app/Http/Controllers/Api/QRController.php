<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Milon\Barcode\Facades\DNS1DFacade;
use Milon\Barcode\Facades\DNS2DFacade;
class QRController extends Controller
{
    public function index()
    {
        // Data variable
        $data = [
            'first' => DNS1DFacade::getBarcodeHTML('4445645656', 'C39'),
            'second' => DNS1DFacade::getBarcodeHTML('4445645656', 'POSTNET'),
            'third' => DNS1DFacade::getBarcodeHTML('4445645656', 'PHARMA'),
            'fourth' => DNS2DFacade::getBarcodeHTML('4445645656', 'QRCODE'),
        ];

        return view('qr', $data);
    }
}