<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
    
    class PdfController extends Controller
    {
        public function generatepdf($id)
    {
        $user = User::where('id',$id)->with('employee')->first(); 
    
        $imageUrl = "https://staging.fyies.com/jobsite/backend/public/uploads/1723803210_user_profile.jpg";
        
            $imageData = file_get_contents($imageUrl);
            $base64 = base64_encode($imageData);
            $base64Image = 'data:image/jpeg;base64,' . $base64; // Adjust MIME type based on actual image type
        
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
    

