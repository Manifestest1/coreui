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
use App\Models\Project;
use App\Models\Certificate;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','loginForSuperadmin','generatepdf']]);
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
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function refresh() 
    {
        return $this->createNewToken(auth()->refresh());
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