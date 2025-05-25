<x-main-layout>
    <x-slot:title>Pembayaran Pendaftaran</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Pembayaran Pendaftaran
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

                <div class="w-full max-w-lg p-6 mx-auto">
                    <ol class="relative border-l border-gray-300 dark:border-gray-700">
                        @foreach ($steps as $step)
                            <x-step :status="$step['status']" :title="$step['title']" :description="$step['description']" />
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
