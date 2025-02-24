{{-- <x-filament::card>
    <h2 class="text-lg font-bold mb-4">Unit untuk {{ $record->name }}</h2>

    <x-filament::table>
        <x-slot name="columns">
            <x-filament::table.heading>Name</x-filament::table.heading>
            <x-filament::table.heading>Konversi</x-filament::table.heading>
        </x-slot>
        <x-slot name="rows">
            @foreach ($record->units as $unit)
            <x-filament::table.row>
                <x-filament::table.cell>{{ $unit->name }}</x-filament::table.cell>
                <x-filament::table.cell>{{ $unit->kali_utama }}</x-filament::table.cell>
            </x-filament::table.row>
            @endforeach
        </x-slot>
    </x-filament::table>
</x-filament::card> --}}
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Nama Unit</th>
            <th scope="col" class="px-6 py-3">Nilai Konversi</th>
        </thead>
        <tbody>
            @if (count($record->units) > 0)
            @foreach ($record->units as $unit)
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                </td>
                <td scope="row" class="px-6 py-4">{{ $unit->kali_utama }}</td>
            </tr>
            @endforeach
            @else
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td colspan="2"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Belum ada Data Unit</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>