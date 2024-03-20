
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @include('layouts.flash-message')
            @include('layouts.notify-messages')
</h2>
        <div class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @include('layouts/search')
        </div>  
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <ul class="grid gap-4">
                            @foreach ($files as $file)
                                <li class="border p-4 rounded-md shadow-md">
                                @if (($file->id_type !== 2))
                                        <img src="data:image/jpeg;base64,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" alt="PDF Icon" class="img-thumbnail">
                                    @else
                                        <img src="{{ route('files.preview', ['file' => $file->id]) }}" alt="{{ $file->file_name }}" class="img-thumbnail">
                                    @endif
                                 
                                    <h5 class="text-l font-semibold mb-2">{{ $file->file_name }}</h5>
                                    <div class="mt-1">
                                        <a href="{{ route('files.preview', $file->id) }}" class="btn btn-primary inline-block mr-4" id="openFilePreview" target = "blank">Preview</a>
                                        <a href="{{ route('files.download', $file->id) }}" class="btn btn-secondary inline-block">Download</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- todo open inside modal -->
    <div id="fileModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <iframe id="filePreview" width="100%" height="500"></iframe>
    </div>
</div>


</x-app-layout>
<style>
  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem; 
  }
</style>