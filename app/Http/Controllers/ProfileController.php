<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $names = User::latest()->pluck('email');
        
        return response([
            'profile' => $names,
        ], 200);
    }

    public function store(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $profile = Profile::create([
            'file_name'=> $request->image->getClientOriginalName(),
            'user_id' => auth()->user()->id
        ]);
        $imageName = $request->image->getClientOriginalName();
       // $imageName = str_replace(' ', '%20', $imageName); // Replace spaces with '%20'
        $request->image->storeAs('profile', $imageName, 'public');
        return response([
            'message'=> 'upload profile successfull'
        ]);
    }
    public function show(Request $request) {
        $profile = Profile::join('users', 'profiles.user_id', '=', 'users.id')
                        ->select('profiles.file_name', 'users.name')
                        ->orderBy('profiles.created_at', 'desc') // Specify the table for created_at
                        ->where('users.id', Auth::user()->id)
                        ->limit(1)
                        ->first();
    
        // Check if a profile is found
        if ($profile) {
            $imageName = $profile->file_name;
            $imageName = str_replace(' ', '%20', $imageName); // Replace spaces with '%20'
    
            // Assuming your base URL is 'http://192.168.3.36'
            $baseUrl = 'http://192.168.3.36:8000';
            $imagePath = '/storage/profile/';
            $imageUrl = $baseUrl . $imagePath . $imageName;
    
            return response([
                'url'=> $imageUrl,
                'name' => $profile->name, // Retrieve the name from the profile
            ]);
        } else {
            // Return a response indicating that no profile was found
            return response([
                'message'=> 'No profile found',
            ], 404);
        }
    }
    
    
    
       
}