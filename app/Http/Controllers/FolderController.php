<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Files;

class FolderController extends Controller
{
    public function show(Request $request)
    {
        $id_category = $request->query('category');
        $rootFolders = Folder::where('id_category', $id_category)->get();
          
        return $rootFolders;
        // return view('layouts/folders', ['folders' => $rootFolders, 'id_category' => $id_category]);
    }
    public function getHierarchy(Request $request)
    {
        $q = $request->input('folder');
        $files = Files::where('path','like','%'.$q.'%')->get();
        return $files;
        // return view('layouts/myfiles', ['files' => $files]);
    }

    public function editName(Request $request)
    {
        
        // Validate the request data
        $request->validate([
            'new_name' => 'required|string|max:255', // Adjust the validation rules as needed
        ]);


        $folderId = $request->input('folder_id');
        // Find the folder by ID
        $folder = Folder::find($folderId);
        // Check if the folder exists
        if (!$folder) {
            return response()->json(['message' => 'Folder not found'], 404);
        }
        // Update the folder name
        $folder->name = $request->input('new_name');
        $folder->save();

        return response()->json(['message' => 'Folder name updated successfully', 'folder' => $folder]);
    }

    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255', 
            'id_category' => 'required|exists:categories,id',
        ]);

        // Create a new folder
        $newFolder = Folder::create([
            'name' => $request->input('name'),
            'id_category' => $request->input('id_category'),
            'parent_id' => $request->input('parent_id'),
          
        ]);

        return response()->json(['message' => 'Folder created successfully', 'folder' => $newFolder]);
    }
 
}
