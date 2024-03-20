<?php

namespace App\Http\Controllers;
use App\Events\FileUploadProgressEvent;
use App\Models\Files;
use App\Models\Folder;
use App\Models\Metadata;
use App\Traits\Upload;
use Illuminate\Http\Request;
use App\View\Components\FlashMessage;
use App\Notifications\FileUploadedNotification;
use Illuminate\Support\Facades\Notification;
use App\Jobs\FileUploadJob;
use Enqueue\RdKafka\RdKafkaProducer;
use Enqueue\RdKafka\RdKafkaConsumer;

class FilesController extends Controller
{   
    use Upload;

    public function index(Request $request)
    {
        $files = Files::all();

        return response()->json($files);
       // view('layouts/myfiles', ['files' => $files]);
    }

    public function create(Request $request)
    {
        $folders = Folder::all();

        // return $folders;
        return view('layouts/files', ['directories' => $folders]);
    }
        
    public function store(Request $request)
    {
       
        if ($request->hasFile('files'))
        {
            $files = [$request->file('files')];
          
            foreach($files as $file) 
            {       
                $directory = $request->input('directory');
                // new directory is created when given directory name not found
                $path = $this->UploadFile($file, $directory);
                $filename = $file->getClientOriginalName();
                $id_type = $file->getMimeType() == 'image/jpeg'? 2:1 ;
                $tags = $request->input('tags');
                    
                FileUploadJob::dispatch(
                                        $path, 
                                        $filename,
                                        $request->input('id_category')|0,
                                        $request->input('description')??"description", 
                                        $request->input('title')??"title",
                                        $request->input('date')??date('Y-m-d H-i-s'),
                                        $id_type,
                                        $tags)->onQueue('file_uploads');

            }
               
            return redirect()->route('files.index');
        }
        else
        {
           return redirect()->route('files.create')->with('warning', 'No file was chosen. Please select a file to upload.');
        }
    }

    public function download($file)
    {
        $file = Files::findOrFail($file); 

        $filePath = storage_path('app\\public\\' . $file->path);

        return response()->download($filePath, $file->original_name);
    }

    public function preview($file)
    {
        $file = Files::findOrFail($file);

        $mime = mime_content_type(storage_path('app/public/' . $file->path));

        $filePath = storage_path('app/public/' . $file->path);

        return response()->file($filePath, [
            'Content-Type' => $mime,
        ]);
    }

    public function broadcastEvent($filename, $progress)
    {   
        event(new FileUploadProgressEvent($filename, $progress));
    }


}