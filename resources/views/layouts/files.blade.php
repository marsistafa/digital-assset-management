<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload your files here') }}
            @include('layouts.flash-message')
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-600">
                    <div class="container">
                    @include('livewire.dragand-drop-file')
                        <form id="file-upload-progress" action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file">Choose File:</label>
                                        <input type="file" name="files" id="files" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="directory">Choose Directory:</label>
                                        <select name="directory" id="directory" class="form-control">
                                            @foreach($directories as $dir)
                                                <option value="{{ $dir->name }}">{{ $dir->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="tags">Tags (comma-separated):</label>
                                        <input type="text" name="tags" id="tags">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" name="title" id="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_category">Category:</label>
                                        <select name="id_category" id="id_category" class="form-control">
                                            <option value="1">Category1</option>
                                            <option value="2">Category2</option>
                                            <!-- Add more categories as needed -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type:</label>
                                        <input type="text" name="type" id="type" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date:</label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">File Description:</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
