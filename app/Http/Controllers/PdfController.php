<?php

namespace App\Http\Controllers;
use app\Http\Controllers\StaticController;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
     public function pdf()
     {
         $users=user::get();
         $data=[
             'title'=>'Funda of web IT',
             'date'=>date('m/d/y'),
            'users'=>$users

         ];
       $pdf=Pdf::loadView('generate-product-pdf',$data);
         return $pdf->download('invoise.pdf');
     }
    public function fin()
    {
            return view('fin');
    }
           

 public function pdfin()
    {
      $user =User::all();
      $data=[
        'title'=>'Funda of web IT',
        'date'=>date('m/d/y'),
        'users'=>$user
       
      ];
        $pdf=Pdf::loadView('generate-product-pdf',$data);
        return $pdf->download("\'$user->nom\'_\'$user->prenom\'.pdf");
   }

//  public function pdf()
//  {
//   $users=user::get();
//   $data=[
//       'title'=>'Funda of web IT',
//       'date'=>date('m/d/y'),
//       'users'=>$users

//   ];
// $pdf = PdfController::pdf(view('resources/views/formpdf.blade.php')->render())
//         ->showBackground()
//          ->waitUntilNetworkIdle()
//          ->pdf();

//      return response($pdf)
//         ->header('Content-Type', 'application/pdf')
//          ->header('Content-Disposition', 'inline; filename="invoise.pdf"');
//  }
}
