<?php

namespace App\Filament\Office\Resources;

use App\Enums\BookingStatus;
use App\Filament\Office\Resources\BookingResource\Pages;
use App\Models\Cv;
use App\Models\CvBooking;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BookingResource extends Resource
{
    protected static ?string $model = CvBooking::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'الحجوزات';

    protected static ?string $modelLabel = 'حجز';

    protected static ?string $pluralModelLabel = 'الحجوزات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cv_id')
                    ->relationship('cv', 'id', fn ($query) => $query->where('office_id', Auth::guard('office-panel')->id()))
                    ->label('السيرة الذاتية')
                    ->disabled(),
                Forms\Components\TextInput::make('end_user_id')
                    ->label('معرف المستخدم')
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        BookingStatus::PENDING->value => 'قيد الانتظار',
                        BookingStatus::ACCEPTED->value => 'مقبولة',
                        BookingStatus::REJECTED->value => 'مرفوضة',
                        BookingStatus::CANCELLED->value => 'ملغاة',
                    ])
                    ->label('الحالة')
                    ->disabled(),
                Forms\Components\Textarea::make('note')
                    ->label('ملاحظة')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $office = Auth::guard('office-panel')->user();

        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('office_id', $office->id)->with(['cv.nationality.translations']))
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('cv.id')
                    ->label('رقم السيرة الذاتية')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cv.nationality.name')
                    ->label('الجنسية')
                    ->formatStateUsing(fn ($record) => $record->cv?->nationality?->translations->where('lang_code', 'ar')->first()?->name ?? $record->cv?->nationality?->translations->first()?->name ?? '-')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('cv.gender')
                    ->label('الجنس')
                    ->formatStateUsing(fn ($state) => $state === 'male' ? 'ذكر' : 'أنثى')
                    ->badge()
                    ->color(fn ($state) => $state === 'male' ? 'primary' : 'pink')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->formatStateUsing(fn ($state) => match($state) {
                        BookingStatus::PENDING->value => 'قيد الانتظار',
                        BookingStatus::ACCEPTED->value => 'مقبولة',
                        BookingStatus::REJECTED->value => 'مرفوضة',
                        BookingStatus::CANCELLED->value => 'ملغاة',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        BookingStatus::PENDING->value => 'warning',
                        BookingStatus::ACCEPTED->value => 'success',
                        BookingStatus::REJECTED->value => 'danger',
                        BookingStatus::CANCELLED->value => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->label('ملاحظة')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الحجز'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        BookingStatus::PENDING->value => 'قيد الانتظار',
                        BookingStatus::ACCEPTED->value => 'مقبولة',
                        BookingStatus::REJECTED->value => 'مرفوضة',
                        BookingStatus::CANCELLED->value => 'ملغاة',
                    ])
                    ->label('الحالة'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('من تاريخ'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('إلى تاريخ'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('تاريخ الحجز'),
            ])
            ->actions([
                Tables\Actions\Action::make('accept')
                    ->label('قبول')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (CvBooking $record) {
                        if ($record->status !== BookingStatus::PENDING->value) {
                            \Filament\Notifications\Notification::make()
                                ->title('يمكن قبول الحجوزات قيد الانتظار فقط')
                                ->danger()
                                ->send();
                            return;
                        }

                        $activeCount = CvBooking::on('system')
                            ->where('cv_id', $record->cv_id)
                            ->whereIn('status', BookingStatus::activeStatuses())
                            ->count();

                        if ($activeCount >= 3) {
                            \Filament\Notifications\Notification::make()
                                ->title('تم الوصول للحد الأقصى من الحجوزات النشطة لهذه السيرة الذاتية (3)')
                                ->danger()
                                ->send();
                            return;
                        }

                        $record->status = BookingStatus::ACCEPTED->value;
                        $record->save();

                        \Filament\Notifications\Notification::make()
                            ->title('تم قبول الحجز بنجاح')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (CvBooking $record) => $record->status === BookingStatus::PENDING->value),
                Tables\Actions\Action::make('reject')
                    ->label('رفض')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (CvBooking $record) {
                        if ($record->status !== BookingStatus::PENDING->value) {
                            \Filament\Notifications\Notification::make()
                                ->title('يمكن رفض الحجوزات قيد الانتظار فقط')
                                ->danger()
                                ->send();
                            return;
                        }

                        $record->status = BookingStatus::REJECTED->value;
                        $record->save();

                        \Filament\Notifications\Notification::make()
                            ->title('تم رفض الحجز')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (CvBooking $record) => $record->status === BookingStatus::PENDING->value),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListBookings::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return true;
    }
}
