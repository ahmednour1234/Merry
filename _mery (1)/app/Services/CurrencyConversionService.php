<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CurrencyConversionService
{
    protected string $conn = 'system';
    protected string $defaultBase = 'USD'; // استخدمها لمحاولات وسيطة لو لزم

    /**
     * الحصول على كود العملة الهدف من الهيدر (X-Currency أو Accept-Currency)
     */
    public function headerTarget(?string $fallback = null): ?string
    {
        $h = request()?->header('X-Currency') ?: request()?->header('Accept-Currency');
        if ($h) return strtoupper(trim($h));
        return $fallback;
    }

    /**
     * تحويل مبلغ من عملة إلى أخرى باستخدام exchange_rates
     * لو لقى معدل مباشر base=from, quote=to يستخدمه
     * لو لقى العكسي يستخدم 1/rate
     * ممكن يحاول وسيط عبر $defaultBase
     */
    public function convert(?float $amount, ?string $from, ?string $to): ?float
    {
        if ($amount === null || !$from || !$to) return $amount;
        $from = strtoupper($from); $to = strtoupper($to);
        if ($from === $to) return round($amount, 2);

        // 1) مباشر from->to
        $rate = $this->rate($from, $to);
        if ($rate !== null) return round($amount * $rate, 2);

        // 2) عكسي to->from
        $inv = $this->rate($to, $from);
        if ($inv !== null && $inv > 0) return round($amount / $inv, 2);

        // 3) وسيط عبر default base (مثلاً USD)
        if ($this->defaultBase && $from !== $this->defaultBase && $to !== $this->defaultBase) {
            $r1 = $this->rate($from, $this->defaultBase);     // from -> USD
            $r2 = $this->rate($this->defaultBase, $to);       // USD -> to
            if ($r1 !== null && $r2 !== null) {
                return round($amount * $r1 * $r2, 2);
            }
            // جرّب العكسي لو محتاج
            $r1i = $this->rate($this->defaultBase, $from);    // USD -> from
            $r2i = $this->rate($to, $this->defaultBase);      // to -> USD
            if ($r1i !== null && $r1i > 0 && $r2i !== null && $r2i > 0) {
                // amount in USD = amount / r1i ; then * (1/r2i)?? لا، نحتاج from->USD: 1/r1i
                $usd = $amount / $r1i;
                $out = $usd * $r2;
                return round($out, 2);
            }
        }

        // ما لقيناش معدل مناسب
        return null;
    }

    /**
     * رجّع معدل التحويل من base إلى quote أو null
     */
    public function rate(string $base, string $quote): ?float
    {
        $row = DB::connection($this->conn)
            ->table('exchange_rates')
            ->where('base', strtoupper($base))
            ->where('quote', strtoupper($quote))
            ->orderByDesc('fetched_at')
            ->first();

        return $row?->rate !== null ? (float)$row->rate : null;
    }
}
