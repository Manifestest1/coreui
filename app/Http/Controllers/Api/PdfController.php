<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Certificate;
use Dompdf\Dompdf;
use Dompdf\Options;
    
    class PdfController extends Controller
    {

        public function generatepdf($id)
        {
            $user = User::where('id',$id)->with('employee','projects','certificates')->first();  
        
            $imageUrl = "https://staging.fyies.com/jobsite/backend/public/uploads/1723803210_user_profile.jpg";

                //$imageUrl = $user->imagebaseurl ? $user->imagebaseurl . $user->imageurl : $user->imageurl;
            
                $imageData = file_get_contents($imageUrl);
                $base64 = base64_encode($imageData);
                $base64Image = 'data:image/jpeg;base64,' . $base64; // Adjust MIME type based on actual image type
                //return view('pdf', ['user' => $user, 'imageUrl' => $base64Image]);
                $html = view('pdf', ['user' => $user, 'imageUrl' => $base64Image])->render();
                
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isRemoteEnabled', true);
                
                $pdf = new Dompdf($options);
                $pdf->loadHTML($html);
                
                $pdf->setPaper('A4', 'portrait'); // You can change the paper size and orientation here
                $pdf->render();
                
            return $pdf->stream('user_profile.pdf', ['Attachment' => 1]);
        }
    }
    

