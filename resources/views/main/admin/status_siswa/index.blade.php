<x-main-layout>
    <x-slot:title>Status Siswa</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Status Siswa
                </h3>
                <x-button type="add" route="{{ route('status-siswa.create') }}" />
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="['Status']" :aligns="['left']" />
                    <x-table-body>
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @foreach ($data as $status_siswa)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $status_siswa->status }}</x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">
                                            <x-button type="edit"
                                                route="{{ route('status-siswa.edit', $status_siswa->id) }}" />
                                            <x-button type="delete"
                                                route="{{ route('status-siswa.destroy', $status_siswa->id) }}" />
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
