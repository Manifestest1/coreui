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

class JobController extends Controller
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

     public function createJobPost(Request $request)
    {
        $userid = Auth::user()->id;
        $jobpost = new JobPost();
        $jobpost->title = $request->title;
        $jobpost->description = $request->description;
        $jobpost->location = $request->location;
        $jobpost->user_id = $userid;
        $jobpost->save();
        return response()->json($jobpost);
    }

    public function jobGetonEmployee()
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $userJobPosts = $user->jobPosts;
        $job = JobPost::get();
        return response()->json(['job'=>$job,'userJobPosts'=>$userJobPosts]);
    }

    public function jobGetonEmployer()
    {
        $userid = Auth::user()->id;
        $job = JobPost::where('user_id',$userid)->get();
        return response()->json(['job'=>$job]);
    }

    public function jobSearchEmployer(Request $request)
    {
        $query = JobPost::query();

        if ($request->has('keyword'))  
        {
            $query->where('title', 'like', '%' . $request->input('keyword') . '%')
                  ->orWhere('location', 'like', '%' . $request->input('keyword') . '%')
                  ->orWhere('description', 'like', '%' . $request->input('keyword') . '%');
        }
    
        $results = $query->get();
        return response()->json($results);
    }

    public function jobViewOnEmployer($id)
    {
        $jobPost = JobPost::find($id);
        $jobPostUsers = $jobPost->users;
        $CountjobPostUsers = $jobPost->users->count(); 
        $job = JobPost::where('id',$id)->first();
        return response()->json(['job'=>$job,'jobpostusers'=>$jobPostUsers,'count'=>$CountjobPostUsers]);
    }

    public function jobViewOnEmployee($id)
    {
        $job = JobPost::where('id',$id)->first();
        return response()->json($job);
    }

    public function jobApplyOnEmployee($id)
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $jobPost = JobPost::find($id);
        $user->jobPosts()->attach($jobPost->id);
        return response()->json($jobPost);
    }

}
