<?php

namespace App\Http\Controllers;

 use App\Models\blog;
use Illuminate\Http\Request;

class apiController extends Controller
{

    public function blogs(Request $request)
    {
        $local = $request->input('local');

         if ($local) {
             $blogs = Blog::where('lang', $local)->get();
        } else {
            $blogs = Blog::all();
        }

         if ($blogs->isEmpty()) {
            $data = [
                'status' => 404,
                'message' => 'No blogs found',
            ];
            return response()->json($data, 404);
        } else {
            $data = [
                'status' => 200,
                'blogs' => $blogs,
            ];
            return response()->json($data, 200);
        }
    }

    public function blogSpecific($id)
    {
        

        $blogs = blog::findOrFail($id);

        if (!$blogs) {
            return response()->json(['message' => 'Stock transaction not found'], 404);
        } else {
            $data = [
                'status' => 200,
                'blogs' => $blogs,
            ];
            return response()->json($data, 200);
        }
    
        
    }


}