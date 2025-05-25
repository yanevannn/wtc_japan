<x-main-layout>
    <x-slot:title>
        Pembayaran Pendaftaran
    </x-slot:title>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Upload Bukti Pembayaran Pendaftaran
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <form method="POST" action="{{ route('pembayaranpendaftaran.store') }}" enctype="multipart/form-data">
                        @csrf
                        <x-form-input label="Tanggal Pembayaran" name="tanggal_bayar" inputType="date" />
                        <x-form-input label="Upload Bukti Pembayran" name="bukti_pembayaran" inputType="file" />
                        <div class="flex justify-end mt-4">
                            <button type="submit" id="btn-submit"
                                class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600">Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('btn-submit');
            const form = document.querySelector('form');

            if (form && btn) {
                form.addEventListener('submit', function() {
                    btn.disabled = true;
                    btn.innerText = 'Sedang menyimpan...';
                });
            }
        });
    </script>
</x-main-layout>
