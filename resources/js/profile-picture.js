// import Cropper from 'cropperjs'; // Import Cropper.js
// import 'cropperjs/dist/cropper.css'; // Import CSS Cropper.js jika belum di-load secara global

// document.addEventListener('DOMContentLoaded', () => {
//     const inputImage = document.getElementById('profile_picture'); // Input file
//     const imagePreviewContainer = document.getElementById('image-preview-container'); // Container preview
//     const imageToCrop = document.getElementById('image-to-crop'); // Gambar untuk di-crop
//     const cropAndUploadButton = document.getElementById('crop-and-upload-button'); // Tombol crop & upload
//     let cropper;

//     // Event ketika file gambar dipilih
//     inputImage.addEventListener('change', (event) => {
//         const file = event.target.files[0]; // Ambil file pertama
//         if (file) {
//             const reader = new FileReader(); // FileReader untuk membaca file

//             reader.onload = (e) => {
//                 // Tampilkan gambar di area preview
//                 imageToCrop.src = e.target.result;
//                 imagePreviewContainer.classList.remove('hidden'); // Tampilkan container preview

//                 // Hapus instance Cropper sebelumnya
//                 if (cropper) {
//                     cropper.destroy();
//                 }

//                 // Inisialisasi Cropper.js
//                 cropper = new Cropper(imageToCrop, {
//                     aspectRatio: 1, // Aspek rasio kotak (1:1)
//                     viewMode: 1, // Mode pandangan (crop area tidak keluar dari gambar)
//                 });

//                 // Aktifkan tombol "Crop & Upload"
//                 cropAndUploadButton.disabled = false;
//             };

//             reader.readAsDataURL(file); // Membaca file sebagai DataURL (Base64)
//         }
//     });

//     // Event ketika tombol "Crop & Upload" diklik
//     cropAndUploadButton.addEventListener('click', () => {
//         if (cropper) {
//             // Ambil hasil crop dalam format Base64
//             const croppedImage = cropper.getCroppedCanvas().toDataURL('image/jpeg');

//             // Tambahkan input hidden ke formulir untuk mengirim gambar Base64 ke server
//             const form = document.getElementById('profile-picture-form');
//             const hiddenInput = document.createElement('input');
//             hiddenInput.type = 'hidden';
//             hiddenInput.name = 'cropped_image';
//             hiddenInput.value = croppedImage;
//             form.appendChild(hiddenInput);

//             // Submit formulir
//             form.submit();
//         }
//     });
// });


import Cropper from 'cropperjs'; // Import Cropper.js
import 'cropperjs/dist/cropper.css'; // Import CSS Cropper.js jika belum di-load secara global

document.addEventListener('DOMContentLoaded', () => {
    const inputImage = document.getElementById('profile_picture'); // Input file
    const imagePreviewContainer = document.getElementById('image-preview-container'); // Container preview
    const imageToCrop = document.getElementById('image-to-crop'); // Gambar untuk di-crop
    const cropAndUploadButton = document.getElementById('crop-and-upload-button'); // Tombol crop & upload
    const modal = document.getElementById('profile-picture-modal'); // Modal
    let cropper;

    // Event ketika file gambar dipilih
    inputImage.addEventListener('change', (event) => {
        const file = event.target.files[0]; // Ambil file pertama
        if (file) {
            const reader = new FileReader(); // FileReader untuk membaca file

            reader.onload = (e) => {
                // Tampilkan gambar di area preview
                imageToCrop.src = e.target.result;
                imagePreviewContainer.classList.remove('hidden'); // Tampilkan container preview

                // Hapus instance Cropper sebelumnya
                if (cropper) {
                    cropper.destroy();
                }

                // Inisialisasi Cropper.js
                cropper = new Cropper(imageToCrop, {
                    aspectRatio: 1, // Aspek rasio kotak (1:1)
                    viewMode: 1, // Mode pandangan (crop area tidak keluar dari gambar)
                });

                // Aktifkan tombol "Crop & Upload"
                cropAndUploadButton.disabled = false;

                // Tampilkan modal
                modal.classList.remove('hidden');
            };

            reader.readAsDataURL(file); // Membaca file sebagai DataURL (Base64)
        }
    });

    // Event ketika tombol "Crop & Upload" diklik
    cropAndUploadButton.addEventListener('click', () => {
        if (cropper) {
            // Ambil hasil crop dalam format Base64
            const croppedImage = cropper.getCroppedCanvas().toDataURL('image/jpeg');

            // Tambahkan input hidden ke formulir untuk mengirim gambar Base64 ke server
            const form = document.getElementById('profile-picture-form');
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'cropped_image';
            hiddenInput.value = croppedImage;
            form.appendChild(hiddenInput);

            // Submit formulir
            form.submit();
        }
    });

    // Event untuk menutup modal
    const closeModalButton = modal.querySelector('[data-modal-toggle="profile-picture-modal"]');
    closeModalButton.addEventListener('click', () => {
        // Tutup modal
        modal.classList.add('hidden');

        // Reset cropper jika ada
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        // Reset input file dan preview
        inputImage.value = ''; // Reset input file
        imagePreviewContainer.classList.add('hidden'); // Sembunyikan preview
    });
});
