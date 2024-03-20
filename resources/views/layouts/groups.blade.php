<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"></h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-600">
                    <div class="container">
                    <button id="myBtn" class="btn btn-primary inline-block mr-4" target="openModal()">Add Category</button>
                    <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content container mx-auto py-8 gap-8 relative hover:scale-110 transition-transform">
                            <span class="close">&times;</span>
                            <div>@include('layouts.categories-form')</div>
                        </div>
                        </div>

                        <div class="container mx-auto py-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                       
                            @foreach ($categories as $category)
                                <a href="{{ route('folder.show', ['category' => $category->id]) }}" class="group">
                                    <div class="relative hover:scale-110 transition-transform">

                                        <!-- Category square -->
                                        <div class="bg-white overflow-hidden rounded-lg shadow-md">
                                        
                                            <!-- Category logo -->
                                            <img src="data:image/jpeg;base64,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" alt="{{ $category->name }}" class="w-full h-32 object-cover">

                                            <!-- Category details -->
                                            <div class="p-4">
                                                <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                                                <p class="text-gray-600">{{ $category->description }}</p>
                                            </div>
                                        </div>

                                        <!-- Overlay for hover effect -->
                                        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-0 group-hover:opacity-40 transition-opacity"></div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

    .group:hover .transition-transform {
        transition: transform 0.4s ease-in-out;
    }
</style>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
