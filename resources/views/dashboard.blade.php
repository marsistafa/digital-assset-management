<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-900">

                    <form action="/invoke-python-script" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div id="image-container" class="mb-4">
                            <img id="preview-image" src="#" alt="Selected Image" class="max-w-full h-auto">
                        </div>

                        <input type="file" name="imgs" id="image-input" accept="image/*" onchange="previewImage()">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Process Image
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            var input = document.getElementById('image-input');
            var preview = document.getElementById('preview-image');

            var file = input.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
