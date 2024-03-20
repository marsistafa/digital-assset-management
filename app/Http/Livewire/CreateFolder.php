<?php


namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Folder;

class CreateFolder extends Component
{
    public $id_category;
    
    public function createFolder()
    {
        $newFolder = Folder::create([
            'name' => 'New Folder', 
            'parent_id'=>'0',
            'id_category'=>  $this->id_category
        ]);

        // Dispatch an event to notify other parts of the application
        event(new \App\Events\FolderCreated($newFolder));

        // Optionally, redirect or emit a message
        session()->flash('success', 'Folder created successfully.');

        // Reset the Livewire component
        $this->reset();
    }

    public function render()
    {
        return view('livewire.create-folder');
    }
}