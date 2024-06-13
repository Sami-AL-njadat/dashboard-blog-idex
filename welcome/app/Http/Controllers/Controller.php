<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Flasher\Laravel\Facade\Flasher;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(){
        return view('layout.home');
    }


    public function profile()


    
    {

        $user = auth()->user();
        return view('page.profile.profile',compact('user'));
    }

    public function updateInformation(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:25048',
            'name' => 'nullable|string|max:255',
            'newEmail' => 'nullable|email|max:255',

        ]);


        if ($validator->fails()) {
            $errorMessage = implode('<br>', $validator->errors()->all());
            return redirect()->back()->with('error', $errorMessage);
        }
      

        $user = Auth::user();

         $changes = false;  

         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('userImage'), $imageName);
            $user->image = 'userImage/' . $imageName;
            $changes = true;  
        }

         if ($request->filled('name') && $request->input('name') !== $user->name) {
            $user->name = $request->input('name');
            $changes = true;  
        }

         if ($request->filled('newEmail') && $request->input('newEmail') !== $user->email) {
            $user->email = $request->input('newEmail');
            $changes = true;  
        }

         if ($changes) {
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->back()->with('info', 'No changes made to the profile.');
        }
    }


    
    
}