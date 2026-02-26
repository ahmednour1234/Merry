<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InsuranceCompanyResource\Pages;
use App\Models\InsuranceCompany;
use App\Models\Currency;
use App\Services\PermissionService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InsuranceCompanyResource extends Resource
{
    protected static ?string $model = InsuranceCompany::class;

    protected static $navigationIcon = 'heroicon-o-shield-check';

    public static function getNavigationGroup(): ?string
    {
        return 'النظام';
    }

    protected static ?string $navigationLabel = 'شركات التأمين';

    protected static ?string $modelLabel = 'شركة تأمين';

    protected static ?string $pluralModelLabel = 'شركات التأمين';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label('الاسم'),
                Forms\Components\TextInput::make('website')
                    ->url()
                    ->maxLength(255)
                    ->label('الموقع الإلكتروني'),
                Forms\Components\FileUpload::make('logo_path')
                    ->image()
                    ->directory('insurance-companies')
                    ->label('الشعار'),
                Forms\Components\TextInput::make('insurance_amount')
                    ->numeric()
                    ->step(0.01)
                    ->label('مبلغ التأمين'),
                Forms\Components\Select::make('currency_code')
                    ->options(fn () => Currency::on('system')->where('active', true)->pluck('name', 'code')->toArray())
                    ->searchable()
                    ->label('العملة'),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->label('نشط'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->on('system'))
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')
                    ->label('الشعار')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('الاسم'),
                Tables\Columns\TextColumn::make('website')
                    ->searchable()
                    ->label('الموقع الإلكتروني')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('insurance_amount')
                    ->money(fn ($record) => $record->currency_code ?? 'SAR')
                    ->sortable()
                    ->label('مبلغ التأمين'),
                Tables\Columns\TextColumn::make('currency_code')
                    ->badge()
                    ->label('العملة'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable()
                    ->label('نشط'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TextInput::make('name')
                    ->label('الاسم'),
                Tables\Filters\TernaryFilter::make('active')
                    ->label('نشط'),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle')
                    ->label('تبديل الحالة')
                    ->icon('heroicon-o-power')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Toggle::make('active')
                            ->label('نشط')
                            ->default(fn (InsuranceCompany $record) => $record->active),
                    ])
                    ->action(function (InsuranceCompany $record, array $data) {
                        $record->active = $data['active'];
                        $record->save();
                    })
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.insurance_companies.toggle')),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.insurance_companies.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.insurance_companies.destroy')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => app(PermissionService::class)->userHas(auth()->user(), 'system.insurance_companies.destroy')),
                ]),
            ])
            ->defaultSort('name');
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
            'index' => Pages\ListInsuranceCompanies::route('/'),
            'create' => Pages\CreateInsuranceCompany::route('/create'),
            'edit' => Pages\EditInsuranceCompany::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.insurance_companies.index');
    }

    public static function canCreate(): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.insurance_companies.store');
    }

    public static function canEdit($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.insurance_companies.update');
    }

    public static function canDelete($record): bool
    {
        return app(PermissionService::class)->userHas(auth()->user(), 'system.insurance_companies.destroy');
    }
}
