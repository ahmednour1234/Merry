<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // متعملش أي queries أو model calls هنا
        // سيبها لمرحلة boot
    }

    public function boot(): void
    {
        // نتأكد إن اتصال system موجود، وجاهز
        try {
            // جرّب تفتح اتصال
            DB::connection('system')->getPdo();

            // اتأكد إن جدول modules موجود
            if (! Schema::connection('system')->hasTable('modules')) {
                return;
            }
        } catch (\Throwable $e) {
            // أي مشكلة (ملوش اتصال/لسه ما تجهزش) نخرج بهدوء
            return;
        }

        // هات قائمة الموديولز من DB (استخدم Query Builder بدل Eloquent لتفادي أي boot logic)
        $modules = DB::connection('system')
            ->table('modules')
            ->where('enabled', true)
            ->orderBy('name')
            ->get(['name','namespace','provider','path']);

        foreach ($modules as $mod) {
            $provider = $mod->provider
                ?: rtrim((string) $mod->namespace, '\\') . 'src\\' . $mod->name . 'ServiceProvider';

            if (! class_exists($provider)) {
                continue;
            }

            // سجّل مزوّد الموديول
            $instance = $this->app->register($provider);

            // بما إننا بنسجّل بعد مرحلة register، نتأكد إن boot() بتاعه يتنادى
            if (method_exists($instance, 'boot')) {
                $this->app->call([$instance, 'boot']);
            }
        }
    }
}
