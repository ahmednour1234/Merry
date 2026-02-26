<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CvResource\Pages;
use App\Models\Cv;
use App\Models\Office;
use App\Models\Category;
use App\Models\Nationality;
use App\Services\PermissionService;
use App\Repositories\System\Cv\Contracts\CvRepositoryInterface;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CvResource extends Resource
{
    protected static ?string $model = Cv::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    protected static ?string $navigationLabel = 'السير الذاتية';

    protected static ?string $modelLabel = 'سيرة ذاتية';

    protected static ?string $pluralModelLabel = 'السير الذاتية';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('office_id')
                    ->options(fn () => Office::on('system')->where('active', true)->pluck('name', 'id')->toArray())
                    ->searchable()
                    ->label('المكتب'),
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
                    ->label('الجنسية'),
                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'ذكر',
                        'female' => 'أنثى',
                    ])
                    ->label('الجنس'),
                Forms\Components\Toggle::make('has_experience')
                    ->label('لديه خبرة'),
                Forms\Components\Toggle::make('is_muslim')
                    ->label('مسلم'),
                Forms\Components\FileUpload::make('file_path')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('cvs')
                    ->label('ملف السيرة الذاتية'),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'approved' => 'موافق عليه',
                        'rejected' => 'مرفوض',
                        'frozen' => 'مجمد',
                        'deactivated_by_office' => 'معطل من المكتب',
                    ])
                    ->label('الحالة'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system')->with(['office', 'category', 'nationality']))
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('office.name')
                    ->searchable()
                    ->sortable()
                    ->label('المكتب'),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->label('الفئة'),
                Tables\Columns\TextColumn::make('nationality.name')
                    ->label('الجنسية')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('gender')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'male' => 'info',
                        'female' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'male' => 'ذكر',
                        'female' => 'أنثى',
                        default => $state,
                    })
                    ->label('الجنس'),
                Tables\Columns\IconColumn::make('has_experience')
                    ->boolean()
                    ->label('خبرة'),
                Tables\Columns\IconColumn::make('is_muslim')
                    ->boolean()
                    ->label('مسلم'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'frozen' => 'info',
                        'deactivated_by_office' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'قيد الانتظار',
                        'approved' => 'موافق عليه',
                        'rejected' => 'مرفوض',
                        'frozen' => 'مجمد',
                        'deactivated_by_office' => 'معطل من المكتب',
                        default => $state,
                    })
                    ->sortable()
                    ->label('الحالة'),
                Tables\Columns\TextColumn::make('approved_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الموافقة')
                    ->toggleable(),
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
                        'deactivated_by_office' => 'معطل من المكتب',
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
                Action::make('approve')
                    ->label('موافقة')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Cv $record) {
                        $repo = app(CvRepositoryInterface::class);
                        $repo->approve($record->id, auth()->id());
                    })
                    ->visible(fn (Cv $record) => $record->status !== 'approved' && app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.approve')),
                Action::make('reject')
                    ->label('رفض')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('reason')
                            ->required()
                            ->maxLength(2000)
                            ->label('سبب الرفض'),
                    ])
                    ->action(function (Cv $record, array $data) {
                        $repo = app(CvRepositoryInterface::class);
                        $repo->reject($record->id, auth()->id(), $data['reason']);
                    })
                    ->visible(fn (Cv $record) => $record->status !== 'rejected' && app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.reject')),
                Action::make('freeze')
                    ->label('تجمد')
                    ->icon('heroicon-o-snowflake')
                    ->color('info')
                    ->requiresConfirmation()
                    ->action(function (Cv $record) {
                        $repo = app(CvRepositoryInterface::class);
                        $repo->freeze($record->id, auth()->id());
                    })
                    ->visible(fn (Cv $record) => $record->status !== 'frozen' && app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.freeze')),
                Action::make('unfreeze')
                    ->label('إلغاء التجمد')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (Cv $record) {
                        $repo = app(CvRepositoryInterface::class);
                        $repo->unfreeze($record->id, auth()->id());
                    })
                    ->visible(fn (Cv $record) => $record->status === 'frozen' && app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.freeze')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.destroy')),
                ]),
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
            'edit' => Pages\EditCv::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.index');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.cvs.destroy');
    }
}
