@php
    $alertTypes = [
        'success' => ['title' => 'Berhasil!', 'icon' => 'success'],
        'error' => ['title' => 'Terjadi Kesalahan!', 'icon' => 'error'],
        'warning' => ['title' => 'Peringatan!', 'icon' => 'warning'],
        'info' => ['title' => 'Informasi', 'icon' => 'info'],
    ];
@endphp

@foreach ($alertTypes as $type => $data)
    @if (session($type))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    title: "{{ $data['title'] }}",
                    text: "{{ session($type) }}",
                    icon: "{{ $data['icon'] }}",
                    customClass: {
                        popup: "bg-white shadow-lg rounded-lg p-6",
                        title: "text-xl font-bold text-gray-900",
                        confirmButton: "bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg",
                    },
                    buttonsStyling: false
                });
            });
        </script>
    @endif
@endforeach

{{-- Konfirmasi Hapus --}}
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            customClass: {
                popup: "bg-white shadow-lg rounded-lg p-6",
                title: "text-xl font-bold text-gray-900",
                confirmButton: "bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg",
                cancelButton: "bg-gray-300 hover:bg-gray-400 text-gray-900 font-medium py-2 px-4 rounded-lg"
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; // Arahkan ke URL penghapusan
            }
        });
    }
</script>
