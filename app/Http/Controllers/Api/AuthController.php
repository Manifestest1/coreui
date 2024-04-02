<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\JobPost;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
        } 
        catch (Exception $e) 
        {
            return $e->getMessage();
        }
    }
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
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() 
    {
        Auth::logout();
        return response()->json(['message' => 'User successfully signed out']);
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
    public function userProfile() 
    {
        return response()->json(auth()->user());
    }
    public function updateProfile(Request $request) 
    {
        // return response()->json($request->all());
        $userid = Auth::user()->id;
        $user = User::find($userid);

        if($request->imageurl != '' || $request->imageurl != null)
        {
            $uploadedFile = $request->file('imageurl');
            $filename = time() . '_' . $uploadedFile->getClientOriginalName();
            $destinationPath = public_path() . '/uploads';
            $uploadedFile->move($destinationPath, $filename);
            $user->imageurl = asset('uploads/' . $filename);
        }
        if (!empty($request->name)) {
            // Update the name
            $user->name = $request->name;
        }
        if(!empty($request->phone))
        {
            $user->phone = $request->phone;
        }
        if(!empty($request->current_address))
        {
            $user->current_address = $request->current_address;
        }
        if($request->permanent_address != '' || $request->permanent_address != null)
        {
            $user->permanent_address = $request->permanent_address;
        }
        if($request->adhar_card_no != '' || $request->adhar_card_no != null)
        {
            $user->adhar_card_no = $request->adhar_card_no;
        }
        if($request->qualification != '' || $request->qualification != null)
        {
            $user->qualification = $request->qualification;
        }
        if($request->certifications != '' || $request->certifications != null)
        {
            $user->certifications = $request->certifications;
        }
        if($request->skills != '' || $request->skills != null)
        {
            $user->skills = $request->skills;
        }
        if($request->working_from != '' || $request->working_from != null)
        {
            $user->working_from = $request->working_from;
        }
        if($request->work_experience != '' || $request->work_experience != null)
        {
            $user->work_experience = $request->work_experience;
        }
        if($request->current_working_skill != '' || $request->current_working_skill != null)
        {
            $user->current_working_skill = $request->current_working_skill;
        }
        if($request->languages != '' || $request->languages != null)
        {
            $user->languages = $request->languages;
        }
        if($request->hobbies != '' || $request->hobbies != null)
        {
            $user->hobbies = $request->hobbies;
        }
        if($request->city != '' || $request->city != null)
        {
            $user->city = $request->city;
        }
        if($request->state != '' || $request->state != null)
        {
            $user->state = $request->state;
        }
        if($request->country != '' || $request->country != null)
        {
            $user->country = $request->country;
        }
        if($request->pincode != '' || $request->pincode != null)
        {
            $user->pincode = $request->pincode;
        }
       
        $user->update();
        return response()->json($user);
    }

    public function updateEmployeeProfile(Request $request) 
    {
        $userId = Auth::id(); // Get the authenticated user's ID

        // Update the user's attributes
        User::where('id', $userId)->update([
            'name' => $request->name,
            // other user attributes
        ]);

        // Retrieve the user model instance
        $user = User::find($userId);

        // Update the employee attributes if the user has an associated employee
        if ($user) 
        {
            $user->employee()->update([
                'phone' => $request->phone,
                // other employee attributes
            ]);
        }

        return response()->json($user);

    }


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
        }
        else
        {
            $user->role_id = 2;
        }
        $user->update();
        return response()->json($user); 
    }

    public function publicProfileOfEmployee($id)
    {
        $user = User::find($id);
        return response()->json($user);
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
}
