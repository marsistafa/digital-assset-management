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
             
        <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <div class="form-group">
                                <label for="directory">Choose Directory:</label>
                                <select name="directory" id="directory" class="form-control">
                                    @foreach($directories as $dir)
                                   
                                    <option value="{{ $dir->name }}">{{ $dir->name }}</option>
                                    <!-- <option value="Work">Work</option>
                                    <option value="Home">Home</option> -->
                                    <!-- make it dynamic -->
                                    @endforeach
                                </select>
</div>
            <button type="submit" class="btn btn-outline-primary">Upload</button>
        </form>
    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
