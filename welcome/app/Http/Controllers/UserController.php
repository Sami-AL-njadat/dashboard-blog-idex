<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Don't forget to import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Flasher\Laravel\Facade\Flasher;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('page.user.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:25048',
            'phone' => 'required|string|regex:/^\+?[0-9\s\-]*$/|max:16|min:4',
        ]);

        
       
        if ($validator->fails()) {
            $errorMessage = implode('<br>', $validator->errors()->all());
            Flasher::addError($errorMessage, 'Validation Error');
            return redirect()->back()->withInput();
        }

        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $domain = $_SERVER['HTTP_HOST'];
        $url = "$protocol://$domain";

        $user = new User;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('userImage'), $imageName);
            $user->image = $url   . '/' . 'imageBlog/' . $imageName;
        }
      
        $user->save();

        return redirect()->route('user.create')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $currentUser = auth()->user();

         $user = User::findOrFail($id);

         if ($user->id == $currentUser->id) {
            return redirect()->route('user.index')->with('warning', 'You cannot delete your own account. Only other admins can delete you.');
        }

         $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

}