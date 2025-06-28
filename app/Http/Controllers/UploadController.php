<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('files')) {
            $urls = [];

            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                // Generate the full URL
                $url = asset('public/storage/' . $filePath);
                $urls[] = $url;
            }

            return response()->json(['urls' => $urls]);
        }

        return response()->json(['error' => 'No files uploaded.'], 400);
    }
}