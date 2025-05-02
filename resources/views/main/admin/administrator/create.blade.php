<x-main-layout>
    <x-slot:title>Administrator</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tambah Data Admin
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('admin.store')">
                        <x-form-input label="First Name" name="fname" placeholder="inut firstname" />
                        <x-form-input label="Last Name" name="lname" placeholder="input lastname" />
                        <x-form-input label="Email" name="email" type="email" placeholder="input email" />
                        <x-form-input label="Password" name="password" type="password" placeholder="input password" />
                        <x-button type="submit"></x-button>
                    </x-form>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
