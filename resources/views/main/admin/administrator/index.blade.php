<x-main-layout>
    <x-slot:title>Administrator</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Admin WTC
                </h3>
                <x-button type="add" route="{{ route('admin.create') }}" />
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="['Name', 'Email', 'Role']" :aligns="['left', 'left', 'left']" />
                    <x-table-body>
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @foreach ($data as $admin)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $admin->fname . ' ' . $admin->lname }}</x-table-cell>
                                    <x-table-cell>{{ $admin->email }}</x-table-cell>
                                    <x-table-cell>{{ $admin->role }}</x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">
                                            <x-button type="edit" route="{{ route('angkatan.edit', $admin->id) }}" />
                                            <x-button type="delete"
                                                route="{{ route('angkatan.destroy', $admin->id) }}" />
                                        </div>
                                    </x-table-cell>
                                </tr>
                            @endforeach
                        @endif
                    </x-table-body>
                </x-table>

            </div>
        </div>
    </div>
    </div>
</x-main-layout>
