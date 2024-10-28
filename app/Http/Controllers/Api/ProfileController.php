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
use App\Models\Education;
use App\Models\Experience;

class ProfileController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','loginForSuperadmin','generatepdf']]);
    }

    public function createProfile(Request $request) 
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if($request->role == 1)
        {
            $user->employee()->create([
                    'employee_id' => $user_id,
            ]);

            $user->role_id = 1;
            $user->update();
            $user = User::find($user_id);
        }
        else
        {
            $user->employer()->create([
                'employer_id' => $user_id,
            ]);
            $user->role_id = 2;
            $user->update();
            $user = User::find($user_id);
        }

        return response()->json($user); 
    }

   public function userProfile() 
   {
       return response()->json(auth()->user());
   }

   public function updateProfile(Request $request) 
   {
       $user_id = Auth::user()->id;
       $user = User::find($user_id);
   
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
           $user = User::with(['projects', 'employee', 'certificates', 'education', 'experience'])->find($user_id);
       } 
       else 
       {
           $user = User::with('employer')->find($user_id);
       }
   
       return response()->json($user); 
   }
       


public function updateEmployeeProfile(Request $request) 
{
    $user_id = Auth::id(); 
    $user = User::find($user_id);

    if ($request->has('name') && !empty($request->name)) {
        $dataToUpdate['name'] = $request->name;
    }

    if ($request->has('email') && !empty($request->email)) {
        $dataToUpdate['email'] = $request->email;
    }

    if (!empty($dataToUpdate)) {
        $user->update($dataToUpdate);
    }

    if ($user) {
        $employeeData = [
            'marital_status' => $request->marrital_status === 'married' ? 1 : 0,
            'phone' => $request->phone,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'adhar_card_no' => $request->adhar_card_no,
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
            'responsibilities_and_achievements' => $request->responsibilities_and_achievements,
            'coursework_or_academic_achievements' => $request->coursework_or_academic_achievements,
            'dates_of_employment' => $request->dates_of_employment,
            'location' => $request->location,
            'job_title' => $request->job_title,
            'professional_summary' => $request->professional_summary,
            'linkedIn_profile' => $request->linkedIn_profile,
            'proficiency_level_of_language' => $request->proficiency_level_of_language,
            'references' => $request->references,
        ];

        $user->employee()->update($employeeData);

        if ($request->hasFile('company_logo')) {
            $uploadedFile = $request->file('company_logo');
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename = time() . '_user_profile.' . $extension;
            $destinationPath = public_path() . '/uploads';
            $uploadedFile->move($destinationPath, $filename);
            $user->employee()->update(['company_logo' => $filename]); // Save company logo path
        }

        $certificates = json_decode($request->input('result'), true);
        foreach ($certificates as $certificate_data) {
            Certificate::create([
                'employee_id' => $user_id,
                'certificate_name' => $certificate_data['certificate_name'],
                'date_of_certification' => $certificate_data['date_of_certification'],
                'issuing_organization' => $certificate_data['issuing_organization'],
                'grade' => $certificate_data['grade'],
                'description' => $certificate_data['description'],
            ]);
        }

        $education_data = json_decode($request->input('education_data'), true);
        foreach ($education_data as $educational_data) {
            Education::create([
                'education_id' => $user_id,
                'institution_names' => $educational_data['institution_names'],
                'course' => $educational_data['course'],
                'from_year' => $educational_data['from_year'],
                'to_year' => $educational_data['to_year'],
                'grading' => $educational_data['grading'],
                'description' => $educational_data['description'],
            ]);
        }

        // Handle project images
        $projects = json_decode($request->input('payload'), true);
        foreach ($projects as &$project_data) {
            if (isset($project_data['company_image']) && $request->hasFile('company_image')) {
                $uploadedFile = $request->file('company_image');
                $extension = $uploadedFile->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '_project_image.' . $extension;
                $destinationPath = public_path('uploads');
                $uploadedFile->move($destinationPath, $filename);
                $project_data['company_image'] = $filename;
            }
        }

        foreach ($projects as $project_data) {
            Project::create([
                'employee_id' => $user_id,
                'project_name' => $project_data['project_name'],
                'company_image' => $project_data['company_image'],
                'brief_description' => $project_data['brief_description'],
                'role_of_employee' => $project_data['role_of_employee'],
                'technologies_used' => $project_data['technologies_used'],
            ]);
        }

        // Handle experience images
        $experience_data = json_decode($request->input('experience_data'), true);
        foreach ($experience_data as &$experience) {
            if (isset($experience['company_image']) && $request->hasFile('company_image')) {
                $uploadedFile = $request->file('company_image');
                $extension = $uploadedFile->getClientOriginalExtension();
                $filename = time() . '_user_profile.' . $extension;
                $destinationPath = public_path() . '/uploads';
                $uploadedFile->move($destinationPath, $filename);
                $experience['company_image'] = $filename;
            }

            Experience::create([
                'user_id' => $user_id,
                'company_name' => $experience['company_name'],
                'company_image' => $experience['company_image'],
                'role_of_employee' => $experience['role_of_employee'],
                'used_technology' => $experience['used_technology'],
                'working_from' => $experience['working_from'],
                'working_to' => $experience['working_to'],
                'location' => $experience['location'],
                'responsibilities' => $experience['responsibilities'],
            ]);
        }
    }

    return response()->json($user->load(['employee', 'certificates', 'projects', 'education', 'experience']));
}

   

    public function updateEmployerProfile(Request $request) 
    {
        $user_id = Auth::id(); 

        User::where('id', $user_id)->update([
            'name' => $request->name
        ]);

        $user = User::find($user_id);
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

        $user = User::with('employer')->find($user_id);

        return response()->json($user);

    }

    public function emplyeePublicProfile($id)
    {
        $user = User::with('employee','projects','certificates')->find($id);
        return response()->json($user);
    }

    }
