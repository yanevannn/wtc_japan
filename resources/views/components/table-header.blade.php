@props([
    'columns' => [], // array kolom, contoh: ['No', 'Status', 'Aksi']
    'aligns' => [], // optional, array alignment: 'left', 'center', 'right'
    'showActionRow' => true, // default tampil tampil
])

<thead>
    <tr class="border-b border-gray-100 dark:border-gray-800">
        @foreach ($columns as $index => $column)
            @php
                $alignment = $aligns[$index] ?? 'left';
                $classes = match ($alignment) {
                    'center' => 'text-center',
                    'right' => 'text-right',
                    default => 'text-left',
                };
            @endphp
            <th class="px-5 py-3 sm:px-6 {{ $classes }}">
                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                    {{ $column }}
                </p>
            </th>
        @endforeach
        @if ($showActionRow)
        <th class="px-5 py-3 sm:px-6 w-10">
            <div class="flex items-center justify-center">
                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                    Aksi
                </p>
            </div>
        </th>
        @endif
    </tr>
</thead>
