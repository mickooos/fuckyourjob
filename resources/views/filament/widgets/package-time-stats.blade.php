@php
    use Carbon\Carbon;
@endphp

<x-filament::widget>
    <x-filament::card>
      <div class="space-y-4 p-6 rounded-xl bg-gray-900 text-white flex flex-col md:flex-row justify-between items-center md:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold">Rekap Paket</h2>

            <p class="mt-2 text-sm text-gray-400">
                {{ $selectedCategoryName }} Package 
                @switch($selectedRange)
                    @case('day') Hari Ini @break
                    @case('month') Bulan Ini @break
                    @case('year') Tahun Ini @break
                    @case('custom') pada {{ Carbon::parse($selectedDate)->translatedFormat('d F Y') }} @break
                @endswitch
            </p>

            <div class="mt-2 text-2xl font-semibold">
                {{ $count }} paket
            </div>
        </div>

        <div>
            {{ $this->form }}
        </div>
    </div>  
    </x-filament::card>
</x-filament::widget>

