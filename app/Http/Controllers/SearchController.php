<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FilesController;
use App\Models\Files;
use App\View\Components\FlashMessage;

class SearchController extends Controller
{
    public function search(Request $request)
    {   
        $q = $request->input('query');

        if(!empty($q))
        {
            $storage_path = storage_path('app\\public\\FOLDER 1\\');
            $escaped_query = escapeshellarg($q);

            $command = "python searchEngine.py  $escaped_query";
            // Execute the command and capture both standard output and standard error
          
            $data = shell_exec("$command 2>&1");
            $dataArray = json_decode($data, true);
                // dd($dataArray);
            if(!$dataArray)
            {     
                return redirect()->route('search')->with('warning', 'Nothing Found :(');
            }
            else
            {     
                $files = Files::whereIn('path', $dataArray)->get();
            
                return view('layouts/myfiles', ['files' => $files]);  
            }
        }
      
        return view('layouts/myfiles', ['files' =>  Files::all()]);
        
    }

    public function searchTag(Request $request)
    {   
        
        $tagName = $request->input('tag');

        if(!empty($tagName))
        {
            $filesWithTag = Files::whereHas('tags', function ($query) use ($tagName) {
                $query->where('name', $tagName);
            })->get();

            if(!$filesWithTag)
            {     
                return 404;
            }
            else
            {     
                return $filesWithTag;  
            }
        }
      
        return  Files::all();
        
    }
}
