<?php

use App\Services\PdfWrapper;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('example',[
        'title' => 'Bangladesh Labour Welfare Foundation'
    ]);
});

Route::get('/pdf', function () {
    $html = view('example',[
        'title' => 'বাংলাদেশ শ্রমিক কল্যাণ ফাউন্ডেশন'
    ])->render();

    $headerHtml = view('_header')->render();
    
    $footerHtml = view('_footer')->render();

    $pdf= Browsershot::html($html)
        ->margins(15,15,15,15)
        ->showBrowserHeaderAndFooter()
        ->headerHtml($headerHtml)
        ->footerHtml($footerHtml)
        ->pdf();
        
        return new Response($pdf,200,[
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="example.pdf"',
            'Content-Length' => strlen($pdf),
        ]);
    return view('welcome');
});

// Route::get('/pdf', function () {
//     return (new PdfWrapper)
//     ->loadView('example',[
//         'title' => 'PDF Wrapper'
//     ])
//     ->download('pdfwrapper.pdf');
// });
