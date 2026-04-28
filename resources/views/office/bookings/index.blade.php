@extends('office.layouts.app')

@section('title', 'الحجوزات')
@section('page-title', 'الحجوزات')

@section('content')

<div class="flex items-center justify-between" style="margin-bottom:1.25rem;">
    <div>
        <h2 style="font-size:1.1rem;font-weight:700;color:#111827;margin:0;">قائمة الحجوزات</h2>
        <p style="color:#6b7280;font-size:0.82rem;margin:0.2rem 0 0;">إجمالي: {{ $bookings->total() }} حجز</p>
    </div>
</div>

{{-- Filter --}}
<div style="background:#fff;border-radius:10px;padding:1rem 1.25rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);margin-bottom:1rem;">
    <form method="GET" action="{{ route('office.bookings.index') }}" class="flex items-center gap-3 flex-wrap">
        <select name="status" class="form-input" style="max-width:200px;">
            <option value="">جميع الحالات</option>
            <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>قيد الانتظار</option>
            <option value="accepted"  {{ request('status') === 'accepted'  ? 'selected' : '' }}>مقبول</option>
            <option value="rejected"  {{ request('status') === 'rejected'  ? 'selected' : '' }}>مرفوض</option>
            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>ملغي</option>
        </select>
        <button type="submit" class="btn-primary" style="padding:0.5rem 1rem;">تصفية</button>
        @if(request()->has('status'))
            <a href="{{ route('office.bookings.index') }}" class="btn-secondary" style="padding:0.5rem 1rem;text-decoration:none;">مسح</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div style="background:#fff;border-radius:10px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
    @if($bookings->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>رقم السيرة</th>
                    <th>الجنسية</th>
                    <th>رقم العميل</th>
                    <th>الحالة</th>
                    <th>ملاحظة</th>
                    <th>التاريخ</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                @php
                    $natName = $booking->cv?->nationality?->translations->where('lang_code','ar')->first()?->name
                            ?? $booking->cv?->nationality?->translations->first()?->name
                            ?? $booking->cv?->nationality_code;

                    $statusMap = [
                        'pending'   => ['label'=>'قيد الانتظار','class'=>'badge-warning'],
                        'accepted'  => ['label'=>'مقبول',       'class'=>'badge-success'],
                        'rejected'  => ['label'=>'مرفوض',       'class'=>'badge-danger'],
                        'cancelled' => ['label'=>'ملغي',         'class'=>'badge-gray'],
                    ];
                    $st = $statusMap[$booking->status] ?? ['label'=>$booking->status,'class'=>'badge-gray'];
                @endphp
                <tr>
                    <td style="font-weight:700;">{{ $booking->id }}</td>
                    <td>CV #{{ $booking->cv_id }}</td>
                    <td>{{ $natName ?? '—' }}</td>
                    <td style="color:#6b7280;">#{{ $booking->end_user_id }}</td>
                    <td><span class="badge {{ $st['class'] }}">{{ $st['label'] }}</span></td>
                    <td style="font-size:0.82rem;color:#6b7280;max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $booking->note ?? '—' }}</td>
                    <td style="color:#6b7280;font-size:0.82rem;">{{ $booking->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($booking->status === 'pending')
                        <form method="POST" action="{{ route('office.bookings.reject', $booking->id) }}" onsubmit="return confirm('هل تريد رفض هذا الحجز؟')" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-danger" style="padding:0.3rem 0.7rem;font-size:0.78rem;">رفض</button>
                        </form>
                        @else
                            <span style="color:#d1d5db;font-size:0.8rem;">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($bookings->hasPages())
        <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6;">
            <div class="pagination-wrap">
                @if($bookings->onFirstPage())
                    <span style="color:#d1d5db;">&rsaquo;</span>
                @else
                    <a href="{{ $bookings->previousPageUrl() }}">&rsaquo;</a>
                @endif

                @foreach($bookings->links()->elements[0] as $page => $url)
                    @if($page == $bookings->currentPage())
                        <span class="active-page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if($bookings->hasMorePages())
                    <a href="{{ $bookings->nextPageUrl() }}">&lsaquo;</a>
                @else
                    <span style="color:#d1d5db;">&lsaquo;</span>
                @endif
            </div>
        </div>
        @endif
    @else
        <div style="text-align:center;padding:3rem;color:#9ca3af;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d1d5db" style="width:48px;height:48px;margin:0 auto 0.75rem;display:block;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            لا توجد حجوزات حتى الآن
        </div>
    @endif
</div>

@endsection
