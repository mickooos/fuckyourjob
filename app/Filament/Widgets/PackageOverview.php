<?php 

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms;
use Illuminate\Support\Carbon;
use App\Models\Package;
use App\Models\Category;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class PackageOverview extends Widget implements HasForms
{   
    use InteractsWithForms;
    
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.widgets.package-time-stats';

    public ?string $timeRange = 'day';
    public ?string $customDate = null;
    public ?string $category = 'all';

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('timeRange')
                ->label('Filter Waktu')
                ->options([
                    'day' => 'Hari Ini',
                    'month' => 'Bulan Ini',
                    'year' => 'Tahun Ini',
                    'custom' =>  'Pilih Tanggal',
                ])
                ->default('day')
                ->required()
                ->reactive(),
            
            Forms\Components\DatePicker::make('customDate')
                ->label('Tanggal')
                ->visible(fn (callable $get) => $get('timeRange') === 'custom')
                ->required(fn (callable $get) => $get('timeRange') === 'custom')
                ->reactive(),

            Forms\Components\Select::make('category')
                ->label('Kategori')
                ->options(
                    ['all' => 'All'] + Category::pluck('nama', 'id')->toArray()
                )
                ->default('all')
                ->required()
                ->reactive(),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'count' => $this->getPackageCount(),
            'selectedRange' => $this->timeRange,
            'selectedDate' => $this->customDate,
            'selectedCategory' => $this->category,
            'selectedCategoryName' => $this->category === 'all'
                ? 'All'
                : Category::find($this->category)?->nama ?? 'Unknown',
        ];
    }
    
    protected function getPackageCount(): int
    {
        $query = Package::query();

        if ($this->category !== 'all') {
            $query->where('kategori', $this->category);
        }

        match ($this->timeRange) {
            'day' => $query->whereDate('created_at', Carbon::today()),
            'month' => $query->whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year),
            'year' => $query->whereYear('created_at', Carbon::now()->year),
            'custom' => $query->whereDate('created_at', $this->customDate),
        };

        return $query->count();
    }
}
