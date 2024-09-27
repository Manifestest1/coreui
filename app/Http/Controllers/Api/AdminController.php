<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Page;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function __construct()
    {
        // Use 'auth:admin' middleware for protected routes
        $this->middleware('auth:admin', ['except' => ['login','getUsersList','showMetaTag']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Authenticate using the 'admin' guard
        if (!$token = Auth::guard('admin')->attempt($credentials))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Return the JWT token on successful login

        $admin = Auth::guard('admin')->user();

        return response()->json([
            'status' => 'success',
            'user' => $admin,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);

    }

    public function editUser($id)
    {
        $data = User::find($id);
        if (!$data) {
            return response()->json(['message' => 'user not found.'], 404);
        }
        return response()->json([
            'message' => 'user retrieved successfully',
            'data' => $data
        ], 200);
    }

    public function adminProfile()
    {
        $admin = Auth::guard('admin')->user();
        return response()->json($admin);
    }

    public function getUsersList()
    {
        $users_list = User::whereNull('deleted_at')->get();
        return "$users_list ";
        return response()->json($users_list);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
    
        if ($request->hasFile('image')) { 
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename = time() . '_' . 'user_profile' . '.' . $extension;
            $destinationPath = public_path('uploads'); 
            $uploadedFile->move($destinationPath, $filename);
            $updateData['imageurl'] = $filename; 
            $updateData['imagebaseurl'] = url('uploads/'); 
        }
    
        $user->update($updateData);
    
        return response()->json($user);
    }

    public function userDelete($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }

    public function logout(Request $request)
    {
        // Log the admin out using the 'admin' guard
        Auth::guard('admin')->logout();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function showMetaTag()
    {
        $pages = Page::select('id','title', 'description', 'keywords', 'url')->get();
    
        if ($pages->isEmpty()) {
            return response()->json(['error' => 'No pages found'], 404);
        }
        
        return response()->json($pages);
    }

    public function metaTagEdit($id)
    {
        $page = Page::find($id);
        
        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }
        
        return response()->json($page);
    }

    public function metaTagAdd(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|string|unique:pages',
            'title' => 'required|string',
            'description' => 'required|string',
            'keywords' => 'required|string',
        ]);

        $page = Page::create($validated);

        return response()->json(['message' => 'Page created successfully', 'page' => $page], 201);
    }

    public function metaTagUpdate(Request $request, $id)
    {
        $page = Page::find($id);

        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }

        $validated = $request->validate([
            'url' => 'required|string|unique:pages,url,' . $id, 
            'title' => 'required|string',
            'description' => 'required|string',
            'keywords' => 'required|string',
        ]);

        $page->update($validated);

        return response()->json(['message' => 'Page updated successfully', 'page' => $page], 200);
    }

    public function metaTagDelete($id)
    {
        $page = Page::find($id);

        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }

        $page->delete();

        return response()->json(['message' => 'Page deleted successfully'], 200);
    }
}