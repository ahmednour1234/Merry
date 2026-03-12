<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Models\Notification;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    public static function typeLabel(string $type): string
    {
        return match ($type) {
            'cv.approved' => 'موافقة على السيرة الذاتية',
            'cv.rejected' => 'رفض السيرة الذاتية',
            'cv.frozen' => 'تجميد السيرة الذاتية',
            'cv.unfrozen' => 'إلغاء تجميد السيرة الذاتية',
            'cv.submitted' => 'إرسال سيرة ذاتية جديدة',
            'enduser.logged_in' => 'تسجيل الدخول',
            'enduser.registered' => 'إنشاء حساب مستخدم',
            default => $type,
        };
    }

    public static function titleLabel(string $title): string
    {
        return match ($title) {
            'CV Approved' => 'تمت الموافقة على السيرة الذاتية',
            'CV Rejected' => 'تم رفض السيرة الذاتية',
            'CV Frozen' => 'تم تجميد السيرة الذاتية',
            'CV Unfrozen' => 'تم إلغاء تجميد السيرة الذاتية',
            'New CV Submitted' => 'سيرة ذاتية جديدة للمراجعة',
            'Login Successful' => 'تم تسجيل الدخول بنجاح',
            'Welcome!' => 'مرحباً!',
            default => $title,
        };
    }

    public static function bodyLabel(string $body): string
    {
        $map = [
            'Your CV has been approved.' => 'تمت الموافقة على سيرتك الذاتية.',
            'A new CV has been submitted and is pending review.' => 'تم إرسال سيرة ذاتية جديدة وهي قيد المراجعة.',
            'You have successfully logged in.' => 'تم تسجيل دخولك بنجاح.',
            'Your account has been created successfully.' => 'تم إنشاء حسابك بنجاح.',
        ];
        $bodyTrim = trim($body, " \t\n\r.");
        foreach ($map as $en => $ar) {
            $enTrim = trim($en, " \t\n\r.");
            if (str_starts_with($bodyTrim, $enTrim) || $bodyTrim === $enTrim || str_contains($bodyTrim, $enTrim)) {
                return $ar;
            }
        }
        if (str_contains($body, 'CV has been approved') || str_contains($body, 'has been approved.')) {
            return 'تمت الموافقة على سيرتك الذاتية.';
        }
        if (str_contains($body, 'has been rejected')) {
            $reason = preg_match('/Reason:\s*(.+)$/', $body, $m) ? trim($m[1]) : '';
            return $reason ? 'تم رفض سيرتك الذاتية. السبب: ' . $reason : 'تم رفض سيرتك الذاتية.';
        }
        if (str_contains($body, 'has been frozen')) {
            return 'تم تجميد سيرتك الذاتية.';
        }
        if (str_contains($body, 'has been unfrozen')) {
            return 'تم إلغاء تجميد سيرتك الذاتية وهي قيد المراجعة.';
        }
        return $body;
    }

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell-alert';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    public static function getNavigationSort(): ?int
    {
        return 11;
    }

    protected static ?string $navigationLabel = 'الإشعارات';

    protected static ?string $modelLabel = 'إشعار';

    protected static ?string $pluralModelLabel = 'الإشعارات';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::on('system')->count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->maxLength(191)
                    ->label('النوع'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('العنوان'),
                Forms\Components\Textarea::make('body')
                    ->rows(3)
                    ->label('المحتوى'),
                Forms\Components\Select::make('priority')
                    ->options([
                        'low' => 'منخفض',
                        'normal' => 'عادي',
                        'high' => 'عالي',
                    ])
                    ->default('normal')
                    ->label('الأولوية'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('type')
                    ->label('النوع')
                    ->formatStateUsing(fn ($state) => $state ? static::typeLabel($state) : $state)
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->formatStateUsing(fn ($state) => $state ? static::titleLabel($state) : $state)
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('body')
                    ->label('المحتوى')
                    ->formatStateUsing(fn ($state) => $state ? static::bodyLabel($state) : $state)
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('priority')
                    ->label('الأولوية')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'low' => 'منخفض',
                        'normal' => 'عادي',
                        'high' => 'عالي',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'low' => 'gray',
                        'normal' => 'info',
                        'high' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('recipients_count')
                    ->counts('recipients')
                    ->label('عدد المستلمين')
                    ->sortable(),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('أنشأ بواسطة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('تاريخ الإنشاء')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('النوع'),
                Tables\Filters\SelectFilter::make('priority')
                    ->options([
                        'low' => 'منخفض',
                        'normal' => 'عادي',
                        'high' => 'عالي',
                    ])
                    ->label('الأولوية'),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make()->label('رؤية'),
                \Filament\Actions\DeleteAction::make()
                    ->label('حذف')
                    ->modalHeading('تأكيد الحذف')
                    ->modalDescription('هل أنت متأكد من حذف هذا الإشعار؟')
                    ->modalSubmitActionLabel('نعم، احذف'),
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
            'index' => Pages\ListNotifications::route('/'),
            'view' => Pages\ViewNotification::route('/{record}'),
        ];
    }
}
