<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\JobPost;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use TCPDF;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','loginForSuperadmin','downloadPdf']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        try
        {
            $is_user = User::where('email', $request->email)->first();
           
            if (!$is_user) 
            {
                $save_user = User::updateOrCreate(
                    [
                        'google_id' => $request->google_id
                    ],
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'imageurl' => $request->imageurl,
                    ]
                );
                $save_user = User::where('email', $request->email)->first();
                $user = Auth::user();
                $credentials = $request->only('email','password');

                if (!$token = JWTAuth::attempt($credentials)) 
                {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Unauthorized', 
                    ], 401);
                }

                return response()->json([
                    'status' => 'success',
                    'user' => $save_user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ],
                ]);
            } 
            else 
            {
                $credentials = $request->only('email','password');

                if (!$token = JWTAuth::attempt($credentials)) 
                {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Unauthorized',
                    ], 401);
                }

                $authuser = Auth::user();
                // $userId = Auth::id();
                if($authuser->role_id == 1)
                {
                    $user = User::with('employee')->find($authuser->id);
                }
                else
                {
                    $user = User::with('employer')->find($authuser->id);
                }


                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ],
                ]);

            }
        } 
        catch (Exception $e) 
        {
            return $e->getMessage();
        }
    }

    // Start Login For Super Admin 

    public function loginForSuperadmin(Request $request) 
    {
        try
        {

            $credentials = $request->only('email','password');

                if (!$token = JWTAuth::attempt($credentials)) 
                {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Unauthorized',
                    ], 401);
                }

                $user = Auth::user();

                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ],
                ]);

        } 
        catch (Exception $e) 
        {
            return $e->getMessage();
        }
    }

    // End Login For Super Admin

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() 
    {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function createProfile(Request $request) 
     {
         $userid = Auth::user()->id;
         $user = User::find($userid);
         if($request->role == 1)
         {
             $user->employee()->create([
                     'employee_id' => $userid,
             ]);

             $user->role_id = 1;
             $user->update();
             $user = User::with('employee')->find($userid);
         }
         else
         {
             $user->employer()->create([
                 'employer_id' => $userid,
             ]);
             $user->role_id = 2;
             $user->update();
             $user = User::find($userid);
         }

         return response()->json($user); 
     }

    public function userProfile() 
    {
        return response()->json(auth()->user());
    }

    public function updateProfile(Request $request) 
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $img_base_url = url('/').'/uploads/';

        if($request->imageurl != '' || $request->imageurl != null)
        {
            // $path = url('/').'/uploads/';
            $uploadedFile = $request->file('imageurl');

            // Get the file extension
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename = time() . '_' . 'user_profile' . '.' . $extension;
            $destinationPath = public_path() . '/uploads';
            $uploadedFile->move($destinationPath, $filename);
            $user->imageurl = $filename;
            $user->imagebaseurl = $img_base_url;
        }


        if($user->role_id == 1)
        {
            $user->update();
            $user = User::with('employee')->find($userid);
        }
        else
        {
            $user->update();
            $user = User::with('employer')->find($userid);
        }


        return response()->json($user); 
    }

    // public function getCountries()
    // {

    //     $data = Country::all();
    //     return response()->json($data);
    // }

    // public function getStates()
    // {
    //     $statedata = State::all();
    //     return response()->json($statedata);
    // }

    // public function getCity()
    // {
    //     $statedata = City::all();
    //     return response()->json($statedata);
    // }


    public function updateEmployeeProfile(Request $request) 
    {
        $userId = Auth::id(); // Get the authenticated user's ID

        // Update the user's attributes
        User::where('id', $userId)->update([
            'name' => $request->name
        ]);

        // Retrieve the user model instance
        $user = User::find($userId);

        // Update the employee attributes if the user has an associated employee
        if ($user) 
        {
            $user->employee()->update([
                'marital_status' => $request->marital_status,
                'phone' => $request->phone,
                'current_address' => $request->current_address,
                'permanent_address' => $request->permanent_address,
                'adhar_card_no' => $request->adhar_card_no,
                'qualification' => $request->qualification,
                'certifications' => $request->certifications,
                'skills' => $request->skills,
                'working_from' => $request->working_from,
                'work_experience' => $request->work_experience,
                'current_working_skill' => $request->current_working_skill,
                'languages' => $request->languages,
                'hobbies' => $request->hobbies,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'gender' => $request->gender,


            ]);
        }

        $user = User::with('employee')->find($userId);

        return response()->json($user);
    }

    public function updateEmployerProfile(Request $request) 
    {
        $userId = Auth::id(); // Get the authenticated user's ID

        // Update the user's attributes
        User::where('id', $userId)->update([
            'name' => $request->name
        ]);

        // Retrieve the user model instance
        $user = User::find($userId);

        // Update the employee attributes if the user has an associated employee
        if ($user) 
        {
            $user->employer()->update([
                'phone' => $request->phone,
                'current_address' => $request->current_address,
                'permanent_address' => $request->permanent_address,
                'adhar_card_no' => $request->adhar_card_no,
                'qualification' => $request->qualification,
                'certifications' => $request->certifications,
                'skills' => $request->skills,
                'working_from' => $request->working_from,
                'work_experience' => $request->work_experience,
                'current_working_skill' => $request->current_working_skill,
                'languages' => $request->languages,
                'hobbies' => $request->hobbies,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode
            ]);
        }

        $user = User::with('employer')->find($userId);

        return response()->json($user);

    }

    public function emplyeePublicProfile($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function downloadPdf()
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('User Profile');
        $pdf->SetSubject('User Profile Information');
        $pdf->SetKeywords('TCPDF, PDF, profile, user');
    
        
        $pdf->AddPage();
        $user = User::where('id',11)->with('employee')->first(); 
        $html = '<img src="'.$user->imagebaseurl.$user->imageurl.'" />';
        echo $html;
        // $html = '<h1 style="color:red;">User Profile</h1>';
        // $html .= '<table>';
        // $html .= '<tr><td>Name</td><td>' . $user->name . '</td></tr>';
        // $html .= '<tr><td>Email</td><td>' . $user->email . '</td></tr>';
        // $html .= '<tr><td>Profile</td><td><img src="'. $user->imagebaseurl.$user->imageurl.'" /></td></tr>'; 
        // $html .= '</table>';
    
        // echo $html;exit;
        
        $pdf->writeHTML($html, true, false, true, false, '');
    
        $pdf->Output('user_profile.pdf', 'D');
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }

      /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() 
    {
        Auth::logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

   
}