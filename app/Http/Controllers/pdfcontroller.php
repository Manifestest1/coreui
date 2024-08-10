<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use PDF; 

class PdfController extends Controller
{
    public function generatepdf($id) {

        $user = User::where('id', $id)->with('employee')->first();
        $imageUrl = asset('uploads/' . $user->imagebaseurl . $user->imageurl);
        
        $imageUrl = url('uploads/'.$user->imageurl);
       
       //return view('pdf', ['user' => $user, 'imageUrl' =>$imageUrl]);
        $html = view('pdf', ['user' => $user, 'imageUrl' =>$imageUrl])->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->download('user_profile.pdf');
    }
}
