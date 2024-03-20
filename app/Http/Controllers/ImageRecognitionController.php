<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;

class ImageRecognitionController extends Controller
{
    public function invokePythonScript(Request $request)
    {
        if ($request->hasFile('imgs')) {
            $image = $request->file('imgs');
    
            // Move the uploaded file to a specific directory
            $imagePath = escapeshellarg(public_path('uploads/' . $image->getClientOriginalName()));
            $image->move(public_path('uploads'), $image->getClientOriginalName());
            
            $command = "python predict_hub.py {$imagePath}";
               
            // Execute the command and capture both standard output and standard error
            $output = shell_exec("$command 2>&1");          

            return response()->json(['predictions' => $output]);
        } else {
            return response()->json(['error' => 'No file uploaded.']);
        }
    }
}
