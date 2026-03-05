<?php

namespace App\Filament\Office\Resources;

use App\Enums\BookingStatus;
use App\Filament\Office\Resources\CvResource\Pages;
use App\Models\Cv;
use App\Models\CvBooking;
use App\Models\Category;
use App\Models\Identity\FavouriteCv;
use App\Models\Identity\EndUser;
use App\Models\Nationality;
use App\Repositories\System\Cv\Contracts\CvRepositoryInterface;
use BackedEnum;
use Filament\Actions\Action as BaseAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CvResource extends Resource
{
    protected static ?string $model = Cv::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'السير الذاتية';

    protected static ?string $modelLabel = 'سيرة ذاتية';

    protected static ?string $pluralModelLabel = 'السير الذاتية';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->options(fn () => Category::on('system')->with('translations')->where('active', true)->get()->mapWithKeys(function ($cat) {
                        $name = $cat->translations->where('lang_code', 'ar')->first()?->name ?? $cat->translations->first()?->name ?? $cat->name ?? $cat->slug;
                        return [$cat->id => $name];
                    })->toArray())
                    ->searchable()
                    ->label('الفئة'),
                Forms\Components\Select::make('nationality_code')
                    ->options(fn () => Nationality::on('system')->with('translations')->where('active', true)->get()->mapWithKeys(function ($nat) {
                        $name = $nat->translations->where('lang_code', 'ar')->first()?->name ?? $nat->translations->first()?->name ?? $nat->name;
                        return [$nat->code => $name];
                    })->toArray())
                    ->searchable()
                    ->required()
                    ->label('الجنسية'),
                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'ذكر',
                        'female' => 'أنثى',
                    ])
                    ->label('الجنس'),
                Forms\Components\Toggle::make('has_experience')
                    ->label('لديه خبرة')
                    ->default(false),
                Forms\Components\Toggle::make('is_muslim')
                    ->label('مسلم')
                    ->default(false),
                Forms\Components\FileUpload::make('file_path')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('cvs')
                    ->label('ملف السيرة الذاتية')
                    ->required(fn ($record) => !$record)
                    ->deletable(fn ($record) => (bool) $record)
                    ->downloadable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $office = Auth::guard('office-panel')->user();

        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('office_id', $office->id)->with(['category', 'nationality.translations']))
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('الفئة')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('nationality.name')
                    ->label('الجنسية')
                    ->formatStateUsing(fn ($record) => $record->nationality?->translations->where('lang_code', 'ar')->first()?->name ?? $record->nationality?->translations->first()?->name ?? $record->nationality_code)
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('الجنس')
                    ->formatStateUsing(fn ($state) => $state === 'male' ? 'ذكر' : 'أنثى')
                    ->badge()
                    ->color(fn ($state) => $state === 'male' ? 'primary' : 'pink'),
                Tables\Columns\IconColumn::make('has_experience')
                    ->label('خبرة')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_muslim')
                    ->label('مسلم')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'pending' => 'قيد الانتظار',
                        'approved' => 'موافق عليه',
                        'rejected' => 'مرفوض',
                        'frozen' => 'مجمد',
                        'deactivated_by_office' => 'معطل',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'frozen' => 'gray',
                        'deactivated_by_office' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('bookings_count')
                    ->label('عدد الحجوزات')
                    ->formatStateUsing(fn ($record) => CvBooking::on('system')
                        ->where('cv_id', $record->id)
                        ->whereIn('status', BookingStatus::activeStatuses())
                        ->count())
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('favorites_count')
                    ->label('عدد المفضلة')
                    ->formatStateUsing(fn ($record) => FavouriteCv::on('identity')
                        ->where('cv_id', $record->id)
                        ->count())
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'approved' => 'موافق عليه',
                        'rejected' => 'مرفوض',
                        'frozen' => 'مجمد',
                        'deactivated_by_office' => 'معطل',
                    ])
                    ->label('الحالة'),
                Tables\Filters\SelectFilter::make('gender')
                    ->options([
                        'male' => 'ذكر',
                        'female' => 'أنثى',
                    ])
                    ->label('الجنس'),
                Tables\Filters\TernaryFilter::make('has_experience')
                    ->label('لديه خبرة'),
                Tables\Filters\TernaryFilter::make('is_muslim')
                    ->label('مسلم'),
            ])
            ->actions([
                BaseAction::make('toggle_active')
                    ->label(fn ($record) => $record->status === 'deactivated_by_office' ? 'تفعيل' : 'تعطيل')
                    ->icon(fn ($record) => $record->status === 'deactivated_by_office' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                    ->color(fn ($record) => $record->status === 'deactivated_by_office' ? 'success' : 'warning')
                    ->requiresConfirmation()
                    ->action(function (Cv $record) {
                        $office = Auth::guard('office-panel')->user();
                        $repo = app(CvRepositoryInterface::class);
                        $active = $record->status !== 'deactivated_by_office';
                        $repo->officeToggleActive($record->id, $office->id, !$active);

                        \Filament\Notifications\Notification::make()
                            ->title('تم تحديث الحالة بنجاح')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => in_array($record->status, ['approved', 'deactivated_by_office'])),
                BaseAction::make('resubmit')
                    ->label('إعادة الإرسال')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (Cv $record) {
                        if ($record->status !== 'rejected') {
                            \Filament\Notifications\Notification::make()
                                ->title('يمكن إعادة إرسال السير الذاتية المرفوضة فقط')
                                ->danger()
                                ->send();
                            return;
                        }

                        $record->status = 'pending';
                        $record->rejected_by = null;
                        $record->rejected_at = null;
                        $record->rejected_reason = null;
                        $record->save();

                        \Filament\Notifications\Notification::make()
                            ->title('تم إعادة الإرسال بنجاح')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status === 'rejected'),
                BaseAction::make('view_favorites')
                    ->label('المستخدمين المفضلين')
                    ->icon('heroicon-o-heart')
                    ->color('pink')
                    ->modalHeading(fn ($record) => 'المستخدمين الذين أضافوا السيرة الذاتية #' . $record->id . ' للمفضلة')
                    ->modalContent(function (Cv $record) {
                        $favorites = FavouriteCv::on('identity')
                            ->where('cv_id', $record->id)
                            ->with('endUser')
                            ->get();

                        if ($favorites->isEmpty()) {
                            return view('filament.office.components.no-favorites');
                        }

                        return view('filament.office.components.favorites-list', [
                            'favorites' => $favorites,
                        ]);
                    })
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('إغلاق')
                    ->visible(fn ($record) => FavouriteCv::on('identity')->where('cv_id', $record->id)->exists()),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCvs::route('/'),
            'create' => Pages\CreateCv::route('/create'),
            'edit' => Pages\EditCv::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return true;
    }
}
