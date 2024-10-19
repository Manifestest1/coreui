<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\JobPost;
use Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\Certificate;

class ProfileController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','loginForSuperadmin','generatepdf']]);
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
            $user->update();
            $user = User::find($userid);
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
   
       if ($request->has('name') && !empty($request->name)) {
           $user->name = $request->name;
       }
   
       if ($request->has('email') && !empty($request->email)) {
           $user->email = $request->email;
       }
   
       if ($request->hasFile('profile_image')) {
           $uploadedFile = $request->file('profile_image');
           $extension = $uploadedFile->getClientOriginalExtension();
           $filename = time() . '_user_profile.' . $extension;
           $destinationPath = public_path() . '/uploads';
           $uploadedFile->move($destinationPath, $filename);
           $user->profile_image = $filename; 
       } 
       $user->save();
       if ($user->role_id == 1) 
       {
           $user = User::with(['projects', 'employee', 'certificates', 'education', 'experience'])->find($userid);
       } 
       else 
       {
           $user = User::with('employer')->find($userid);
       }
   
       return response()->json($user); 
   }
       


   public function updateEmployeeProfile(Request $request) 
   {
       $userId = Auth::id(); 

       User::where('id', $userId)->update([
           'name' => $request->name,
           'email' => $request->email
       ]);

       $user = User::find($userId);
       if ($user) 
       {
           $user->employee()->update([
               'marital_status' => $request->marriage_status === 'married' ? 1 : 0,
               'phone' => $request->phone,
               'current_address' => $request->current_address,
               'permanent_address' => $request->permanent_address,
               'adhar_card_no' => $request->adhar_card_no,
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
               'company_name' => $request->company_name,
               'company_logo' => $request->company_logo,
               'responsibilities_and_achievements' => $request->responsibilities_and_achievements,
               'coursework_or_academic_achievements' => $request->coursework_or_academic_achievements,
               'dates_of_employment' => $request->dates_of_employment,
               'location' => $request->location,
               'job_title' => $request->job_title,
               'professional_summary' => $request->professional_summary,
               'linkedIn_profile' => $request->linkedIn_profile,
               'proficiency_level_of_language' => $request->proficiency_level_of_language,
               'references' => $request->references,
           ]);
       }
      $payload = $request->input('payload');

      $projects = json_decode($payload, true);

      foreach ($projects as $project_data) 
      {
          Project::create([
              'employee_id' => $userId,
              'project_name' => $project_data['project_name'],
              'company_image' => $project_data['company_image'],
              'brief_description' => $project_data['brief_description'],
              'role_of_employee' => $project_data['role_of_employee'],
              'technologies_used' => $project_data['technologies_used'],
          ]);
      }

      $result = $request->input('result');

      $certificates = json_decode($result, true);

      foreach ($certificates as $certificate_data) 
      {
       Certificate::create([
              'employee_id' => $userId,
              'certificate_name' => $certificate_data['certificate_name'],
              'date_of_certification' => $certificate_data['date_of_certification'],
              'issuing_organization' => $certificate_data['issuing_organization'],
              'grade' => $certificate_data['grade'],
              'description' => $certificate_data['description'],
          ]);
      }
      $education_data = $request->input('education_data');

      $education = json_decode($education_data, true);

      foreach ($education as $educational_data) 
      {
       Education::create([
              'education_id' => $userId,
              'institution_names' => $educational_data['institution_names'],
              'course' => $educational_data['course'],
              'from_year' => $educational_data['from_year'],
              'to_year' => $educational_data['to_year'],
              'grade' => $educational_data['grade'],
              'description' => $educational_data['description'],
          ]);
      }
      $experience_data = $request->input('experience_data');

      $experience = json_decode($experience_data, true);

      foreach ($experience as $experiences) 
      {
        Experience::create([
              'user_id' => $userId,
              'company_image' => $experiences['company_image'],
              'company_name' => $experiences['company_name'],
              'role_of_employee' => $experiences['role_of_employee'],
              'used_technology' => $experiences['used_technology'],
              'working_from' => $experiences['working_from'],
              'working_to' => $experiences['working_to'],
              'location' => $experiences['location'],
              'responsibilities' => $experiences['responsibilities'],
          ]);
      }

      $user = User::with(['employee', 'certificates', 'projects', 'education', 'experience'])->find($userId);


       return response()->json($user);
   }

   public function updateEmployerProfile(Request $request) 
   {
       $userId = Auth::id(); 

       User::where('id', $userId)->update([
           'name' => $request->name
       ]);

       $user = User::find($userId);
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
       $user = User::with('employee','projects','certificates')->find($id);
       return response()->json($user);
   }

}
