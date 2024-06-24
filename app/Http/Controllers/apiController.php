<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;

class apiController extends Controller
{
    public function blogs(Request $request)
    {
        $local = $request->input('local');
        $perPage = $request->input('per_page', 10);

        if ($local) {
            $blogs = blog::where('lang', $local)->paginate($perPage);
        } else {
            $blogs = blog::paginate($perPage);
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
                'blogs' => $blogs->items(),
                'pagination' => [
                    'total' => $blogs->total(),
                    'count' => $blogs->count(),
                    'per_page' => $blogs->perPage(),
                    'current_page' => $blogs->currentPage(),
                    'total_pages' => $blogs->lastPage(),
                ],
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