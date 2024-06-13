<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use HTMLPurifier;
use HTMLPurifier_Config;
use Flasher\Laravel\Facade\Flasher;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $blogs = blog::all();
    return view('page.blog.blog',compact('blogs'));
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'lang' => 'required|in:ar,en',
            'header' => 'required|string|max:255',
            'paragraph' => 'required|string', 
            'brief' => 'required|string|max:255',
            'image' => 'required|image|max:25000',
        ]);

        if ($validator->fails()) {
            $errorMessage = implode('<br>', $validator->errors()->all());
            Flasher::addError($errorMessage, 'Validation Error');
            return redirect()->back()->withInput();
        }

        // HTMLPurifier setup
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $blog = new Blog();
        $blog->lang = $request->input('lang');
        $blog->header = $request->input('header');
        $blog->brief = $request->input('brief');
         $blog->paragraph = $purifier->purify($request->paragraph);

        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $domain = $_SERVER['HTTP_HOST'];
        $url = "$protocol://$domain";
        
         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('imageBlog'), $imageName);
            $blog->image = $url   . '/' . 'imageBlog/' . $imageName;
        }

        $blog->save();

        return redirect()->back()->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    
    {
        $blog = blog::findOrFail($id);
        if (!$blog) {
            return redirect()->back()->with('error', 'Article not found');
        }   

        return view('page.blog.edit',compact('blog'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $domain = $_SERVER['HTTP_HOST'];
        $url = "$protocol://$domain";
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'lang' => 'in:ar,en|nullable',
            'header' => 'string|max:255|nullable',
            'paragraph' => 'string|nullable',
            'brief' => 'string|max:255|nullable',
            'image' => 'image|max:25000|nullable',
        ]);
        
        if ($validator->fails()) {
                 $errorMessage = implode('<br>', $validator->errors()->all());
            return redirect()->back()->with('error', $errorMessage);
        }

        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $domain = $_SERVER['HTTP_HOST'];
        $url = "$protocol://$domain";
        
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect()->back()->with('error', 'Blog not found');
        }

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $changes = false;


        if ($request->filled('lang') && $blog->lang !== $request->lang) {
            $blog->lang = $request->lang;
            $changes = true;
        }
        if ($request->filled('header') && $blog->header !== $request->header) {
            $blog->header = $request->header;
            $changes = true;
        }

        if ($request->filled('paragraph')) {
            $cleanedParagraph = $purifier->purify($request->paragraph);
            if ($blog->paragraph !== $cleanedParagraph) {
                $blog->paragraph = $cleanedParagraph;
                $changes = true;
            }
        }


        if ($request->filled('brief')) {
            $blog->brief = $request->brief;
            $changes = true;
        } else {
            $blog->brief = null;
            $changes = true;  
        }

     

         
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/imageBlog'), $imageName);
            $blog->image = $url   . '/' . 'imageBlog/' . $imageName;
            $changes = true;
        }

        if ($changes) {
            $blog->save();
            return redirect()->back()->with('success', 'Blog updated successfully');
        } else {
            return redirect()->back()->with('info', 'No changes were made');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $delete = blog::findOrFail($id);
        if(!$delete){
            return redirect()->back()->with('error', 'Blog not found');
        }
        $delete->delete();
        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully');
        
    }
}

 