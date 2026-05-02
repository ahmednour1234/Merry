<?php

namespace App\Filament\Office\Resources;

use App\Filament\Office\Resources\OfficeReviewResource\Pages;
use App\Models\OfficeReview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class OfficeReviewResource extends Resource
{
    protected static ?string $model = OfficeReview::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'التقييمات';

    protected static ?string $modelLabel = 'تقييم';

    protected static ?string $pluralModelLabel = 'التقييمات';

    protected static ?int $navigationSort = 10;

    public static function getNavigationBadge(): ?string
    {
        $office = Auth::guard('office-panel')->user();
        if (!$office) return null;
        return (string) OfficeReview::on('system')
            ->where('office_id', $office->id)
            ->where('is_active', true)
            ->count();
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'success';
    }

    /** Office can only see their own reviews — no create/edit/delete */
    public static function canCreate(): bool  { return false; }
    public static function canEdit($record): bool   { return false; }
    public static function canDelete($record): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public static function table(Table $table): Table
    {
        $office = Auth::guard('office-panel')->user();

        return $table
            ->modifyQueryUsing(fn (Builder $query) =>
                $query->on('system')
                      ->where('office_id', $office?->id)
                      ->where('is_active', true)
                      ->orderByDesc('id')
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('التقييم')
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state) . str_repeat('☆', 5 - $state))
                    ->color(fn (int $state): string => match (true) {
                        $state >= 4 => 'success',
                        $state === 3 => 'warning',
                        default     => 'danger',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('comment')
                    ->label('التعليق')
                    ->limit(80)
                    ->wrap()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('end_user_id')
                    ->label('المستخدم')
                    ->formatStateUsing(fn ($state): string => 'مستخدم #' . $state),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ التقييم')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rating')
                    ->label('التقييم')
                    ->options([
                        5 => '★★★★★',
                        4 => '★★★★☆',
                        3 => '★★★☆☆',
                        2 => '★★☆☆☆',
                        1 => '★☆☆☆☆',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOfficeReviews::route('/'),
        ];
    }
}
