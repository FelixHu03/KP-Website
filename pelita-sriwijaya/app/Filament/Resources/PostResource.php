<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Utama')->schema([
                    TextInput::make('judul')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(
                            fn(string $operation, $state, Forms\Set $set) =>
                            $operation === 'create' ? $set('slug', Str::slug($state)) : null
                        ),

                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Select::make('kategori')
                        ->options([
                            'berita' => 'Berita Sekolah',
                            'prestasi' => 'Prestasi',
                            'karya_tulis' => 'Karya Tulis',
                        ])
                        ->required(),

                    DatePicker::make('tanggal_publish')
                        ->default(now())
                        ->required(),

                    FileUpload::make('gambar_thumbnail')
                        ->label('Gambar Sampul')
                        ->image()
                        ->disk('public')
                        ->directory('posts-images')
                        ->columnSpanFull(),

                    Textarea::make('konten_singkat')
                        ->label('Ringkasan (Untuk tampilan depan)')
                        ->rows(3)
                        ->columnSpanFull(),

                    RichEditor::make('isi_konten')
                        ->label('Isi Lengkap')
                        ->columnSpanFull()
                        ->required(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Menampilkan Gambar Thumbnail
                ImageColumn::make('gambar_thumbnail')
                    ->label('Sampul')
                    ->disk('public') 
                    ->square()
                    ->width(50)
                    ->height(50)
                    ->defaultImageUrl(url('/assets/image/logo.png')), 

                // 2. Judul Postingan
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(30) 
                    ->tooltip(fn (string $state): string => $state),

                // 3. Kategori dengan Badge Berwarna
                TextColumn::make('kategori')
                    ->badge() // Tampilan seperti label/badge
                    ->color(fn (string $state): string => match ($state) {
                        'berita' => 'info',       // Biru
                        'prestasi' => 'warning',  // Kuning/Oranye
                        'karya_tulis' => 'success', // Hijau
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => str($state)->replace('_', ' ')->title())
                    ->sortable(),

                ToggleColumn::make('is_published')
                    ->label('Tayang?'),

                TextColumn::make('tanggal_publish')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') 
            ->filters([
                SelectFilter::make('kategori')
                    ->options([
                        'berita' => 'Berita Sekolah',
                        'prestasi' => 'Prestasi',
                        'karya_tulis' => 'Karya Tulis',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(), // Tombol Hapus
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
