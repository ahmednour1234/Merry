<?php

namespace App\Services;

class LocaleService
{
    public function __construct(
        protected SystemSettings $settings
    ) {}

    /**
     * يقرأ اللغة المطلوبة من:
     *  - X-Locale (مثلاً ar أو ar-SA)
     *  - Accept-Language (قائمة موزونة)
     * وإن لم توجد، يرجّع لغة النظام الافتراضية من system_settings (app.locale).
     */
    public function preferred(?\Illuminate\Http\Request $request = null, ?string $fallback = null): string
    {
        $request ??= request();

        // 1) هيدر X-Locale صريح
        $x = $request?->header('X-Locale');
        if ($x && is_string($x)) {
            return $this->normalize($x);
        }

        // 2) Accept-Language (eg: "ar, en;q=0.9, fr;q=0.8")
        $al = $request?->header('Accept-Language');
        if ($al && is_string($al)) {
            $parsed = $this->parseAcceptLanguage($al);
            if (!empty($parsed)) {
                return $this->normalize($parsed[0]); // أعلى أولوية
            }
        }

        // 3) fallback من الإعدادات (app.locale) أو الممرر
        $def = $fallback ?: $this->settings->defaultLocale('en');
        return $this->normalize($def);
    }

    /**
     * اختَر اسم الترجمة من مجموعة ترجمات City/Model حسب اللغة المفضلة،
     * مع Fallbacks: ar-XX → ar → أي ترجمة موجودة.
     */
    public function pickNameFromTranslations($translations, string $locale): array
    {
        if (!$translations) {
            return ['name' => null, 'lang' => null];
        }

        $wanted = $this->normalize($locale);
        $wantedShort = strtolower(explode('-', $wanted)[0]);

        // ابحث عن مطابق كامل (ar-sa)
        $full = $translations->first(fn($t) => $this->normalize($t->lang_code) === $wanted);
        if ($full) {
            return ['name' => $full->name, 'lang' => $full->lang_code];
        }

        // ابحث عن مطابق مختصر (ar)
        $short = $translations->first(fn($t) => strtolower(explode('-', $t->lang_code)[0]) === $wantedShort);
        if ($short) {
            return ['name' => $short->name, 'lang' => $short->lang_code];
        }

        // رجّع أول المتاح
        $any = $translations->first();
        return ['name' => $any?->name, 'lang' => $any?->lang_code];
    }

    protected function normalize(string $locale): string
    {
        // "ar_SA" → "ar-SA" | "AR" → "ar"
        $locale = str_replace('_', '-', trim($locale));
        // لو بس حروف بدون بلد، نزّلها small
        if (!str_contains($locale, '-')) {
            return strtolower($locale);
        }
        // قسّم: ar-SA → ar-sa ثم رجّع ar-SA (حروف البلد uppercase)
        [$lang, $reg] = explode('-', $locale, 2);
        return strtolower($lang) . '-' . strtoupper($reg);
    }

    protected function parseAcceptLanguage(string $header): array
    {
        // بسيط: يفك اللغات بالترتيب (يتجاهل q=weights)
        $parts = array_map('trim', explode(',', $header));
        $langs = [];
        foreach ($parts as $p) {
            $lang = explode(';', $p)[0] ?? '';
            if ($lang !== '') $langs[] = $this->normalize($lang);
        }
        return $langs;
    }
}
