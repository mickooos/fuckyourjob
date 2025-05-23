<x-filament::widget>
    <x-filament::card>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold">Rekap Paket</div>
                <div>
                    {{ $this->form }}
                </div>
            </div>

            <div>
                <div class="text-lg text-gray-500">
                    @php
                        $kategori = $selectedCategory === 'all' ? '' : ucfirst($selectedCategory);
                    @endphp
                
                    @if ($selectedRange === 'custom')
                        {{ $kategori }} Package Tanggal {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}
                    @else
                        {{ $kategori }} Package
                        {{ $selectedRange === 'day' ? 'Hari Ini' : ($selectedRange === 'month' ? 'Bulan Ini' : 'Tahun Ini') }}
                    @endif
                
                </div>

                <div class="text-4xl font-bold">
                    {{ $count }} paket
                </div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
