<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Folder Structure') }}
            @include('layouts.flash-message')
            @include('layouts.notify-messages')
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <livewire:create-folder :id_category="$id_category"/>
                            @foreach ($folders as $folder)
                                <div class="mb-3">
                                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                                        <i class="bi bi-folder-plus text-xl"></i>
                                        <h5 class="text-lg font-semibold mt-2">
                                            <a href="{{ route('folder.getHierarchy', ['folder' => $folder->name]) }}">
                                                {{ '>'. $folder->name }}
                                            </a>
                                        </h5>
                                        <!-- Recursive call for subfolders -->
                                        @if ($folder->subfolders->count() > 0)
                                            <ul>
                                                @include('layouts.subfolder', ['folders' => $folder->subfolders])
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
   
</x-app-layout>
