<!-- Modal untuk Preview Gambar yang Akan Diperbarui -->
<div id="profile-picture-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal Content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal Header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Crop Profile Picture
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:text-white dark:hover:text-white" data-modal-toggle="profile-picture-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.293 4.707a1 1 0 0 0 0-1.414L9.414 1.586a1 1 0 0 0-1.414 1.414L9.586 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V6a1 1 0 0 0-.293-.707z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-6">
                <!-- Area preview gambar yang akan di-crop -->
                <div id="image-preview-container" class="mt-4 hidden">
                    <img id="image-to-crop" style="max-width: 100%; max-height: 400px;" />
                </div>

                <!-- Tombol untuk upload dan crop -->
                <div class="mt-4">
                    <x-primary-button id="crop-and-upload-button" type="button" disabled>{{ __('Upload & Crop') }}</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</div>
