<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactMail;
  
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


    public function send(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'phone' => 'required|string|regex:/^\+?[0-9\s\-]*$/|max:16|min:4',
        ]);

        if ($validator->fails()) {
            $errorMessage = implode('<br>', $validator->errors()->all());
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $errorMessage,
            ], 422);
        }

        $validatedData = $validator->validated();

        $recipients = [
            'sami.alnajadat@gmail.com',
            'sami.alnajadat@releans.com',
            'amro.alkhazaleh@releans.com',
        ];

        Mail::to($recipients)->send(new ContactMail($validatedData));

        return response()->json(['message' => 'Email sent successfully!'], 200);
    }
}