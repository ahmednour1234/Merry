<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeReviewResource\Pages;
use App\Models\Identity\EndUser;
use App\Models\OfficeReview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OfficeReviewResource extends Resource
{
    protected static ?string $model = OfficeReview::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'تقييمات المكاتب';

    protected static ?string $modelLabel = 'تقييم';

    protected static ?string $pluralModelLabel = 'تقييمات المكاتب';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    public static function getNavigationSort(): ?int
    {
        return 8;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) OfficeReview::on('system')->count();
    }

    public static function getEloquentQuery(): Builder
    {
        return OfficeReview::on('system')->with('office');
    }

    public static function canCreate(): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('office.name')
                    ->label('المكتب')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_user_id')
                    ->label('المستخدم')
                    ->formatStateUsing(fn ($state): string => 'مستخدم #' . $state),

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
                    ->limit(60)
                    ->wrap()
                    ->placeholder('—'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('مفعّل')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ التقييم')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('الحالة')
                    ->trueLabel('مفعّل')
                    ->falseLabel('موقوف'),

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
            ->actions([
                Tables\Actions\Action::make('toggle_active')
                    ->label(fn (OfficeReview $record): string => $record->is_active ? 'إيقاف' : 'تفعيل')
                    ->icon(fn (OfficeReview $record): string => $record->is_active ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (OfficeReview $record): string => $record->is_active ? 'warning' : 'success')
                    ->requiresConfirmation()
                    ->modalHeading(fn (OfficeReview $record): string => $record->is_active ? 'إيقاف التقييم' : 'تفعيل التقييم')
                    ->modalDescription(fn (OfficeReview $record): string => $record->is_active
                        ? 'هل تريد إيقاف هذا التقييم؟ لن يظهر للمستخدمين.'
                        : 'هل تريد تفعيل هذا التقييم؟ سيظهر للمستخدمين.')
                    ->action(function (OfficeReview $record): void {
                        $record->update(['is_active' => !$record->is_active]);
                    }),

                Tables\Actions\DeleteAction::make()
                    ->label('حذف'),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('bulk_activate')
                    ->label('تفعيل المحدد')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn ($records) => $records->each(fn ($r) => $r->update(['is_active' => true]))),

                Tables\Actions\BulkAction::make('bulk_deactivate')
                    ->label('إيقاف المحدد')
                    ->icon('heroicon-o-eye-slash')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(fn ($records) => $records->each(fn ($r) => $r->update(['is_active' => false]))),

                Tables\Actions\DeleteBulkAction::make()
                    ->label('حذف المحدد'),
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
