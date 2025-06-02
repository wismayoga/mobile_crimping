<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrixUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            return response()->json([
                'success' => true,
                'url' => asset('uploads/' . $filename),
            ]);
        }

        return response()->json(['success' => false], 400);
    }
}
