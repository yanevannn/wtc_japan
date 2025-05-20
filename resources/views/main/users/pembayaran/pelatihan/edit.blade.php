<x-main-layout>
    <x-slot:title>
        Pembayaran Pelatihan
    </x-slot:title>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Upload Ulang Bukti Pembayaran Pelatihan
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('pembayaranpelatihan.update', $data->id)" hasFile="true" method="put">
                        <p class="text-gray-800 dark:text-white/90 text-center">
                            Bukti Pembayaran saat ini
                        </p>
                        <img src="{{ asset('storage/' . $data->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                            class="w-[400px] h-auto mt-2 border border-gray-300 rounded mx-auto mb-3">
                        <x-form-input label="Tanggal Pembayaran" name="tanggal_bayar" inputType="date" value="{{ \Carbon\Carbon::parse($data->tanggal_bayar)->format('Y-m-d')}}" />
                        <x-form-input label="Upload Ulang Bukti Pembayaran" name="bukti_pembayaran" inputType="file" />
                        <x-button type="submit">Submit</x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
