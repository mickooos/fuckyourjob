<?php

namespace App\Filament\Resources;

use App\Enums\KategoriStatus;
use App\Exports\PackageExport;
use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Maatwebsite\Excel\Excel;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('unit')
                    ->relationship('tenant', 'no_unit')
                    ->required(),
                Forms\Components\TextInput::make('pengirim')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('penerima')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('deskripsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('kategori')
                    ->relationship('category', 'nama')
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('posisi')
                    ->relationship('position', 'nama')
                    ->required(),
                Forms\Components\Select::make('kurir')
                    ->relationship('courier', 'nama')
                    ->required(),
                Forms\Components\TextArea::make('catatan')
                    ->required(),
                Forms\Components\TextInput::make('taken_by')
                    ->label('Diambil')
                    ->nullable(),
                Forms\Components\DateTimePicker::make('dateandtime_taken')
                    ->label('Tanggal dan Waktu Diambil')
                    ->timezone('Asia/Jakarta')
                    ->nullable(),
                Forms\Components\Select::make('petugas')
                    ->relationship('handler', 'nama')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal')
                ->dateTime()
                ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('unit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pengirim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('penerima')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.code')
                    ->label('Kategori')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('courier.nama')
                    ->label('Kurir')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('position.nama')
                    ->label('Posisi')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('catatan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('handler.nama')
                    ->label('Petugas')
                    ->sortable()
                    ->searchable(),    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                BulkAction::make('export')
                    ->label('Export to Excel')
                    ->icon('heroicon-o-table-cells')
                    ->color('success')
                    ->action(function () {
                        return app(Excel::class)->download(new PackageExport, 'package_recap.xlsx');
                    })
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            // 'view' => Pages\ViewPackage::route('/{record}'),
            // 'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
