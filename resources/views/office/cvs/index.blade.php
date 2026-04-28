@extends('office.layouts.app')

@section('title', 'السير الذاتية')
@section('page-title', 'السير الذاتية')

@section('content')

{{-- Header --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
    <div>
        <h2 style="font-size:1.1rem;font-weight:700;color:#111827;margin:0;">قائمة السير الذاتية</h2>
        <p style="color:#6b7280;font-size:0.82rem;margin:0.2rem 0 0;">إجمالي: {{ $cvs->total() }} سيرة ذاتية</p>
    </div>
    <a href="{{ route('office.cvs.create') }}" class="btn-primary" style="text-decoration:none;display:inline-flex;align-items:center;gap:0.4rem;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
        إضافة سيرة ذاتية
    </a>
</div>

{{-- Filters --}}
<div style="background:#fff;border-radius:10px;padding:1rem 1.25rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);margin-bottom:1rem;">
    <form method="GET" action="{{ route('office.cvs.index') }}" style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input" placeholder="بحث بـ ID..." style="max-width:200px;">
        <select name="status" class="form-input" style="max-width:180px;">
            <option value="">جميع الحالات</option>
            <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>قيد الانتظار</option>
            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>موافق عليه</option>
            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>مرفوض</option>
            <option value="frozen"   {{ request('status') === 'frozen'   ? 'selected' : '' }}>مجمد</option>
        </select>
        <button type="submit" class="btn-primary" style="padding:0.5rem 1rem;">بحث</button>
        @if(request()->hasAny(['search','status']))
            <a href="{{ route('office.cvs.index') }}" class="btn-secondary" style="padding:0.5rem 1rem;text-decoration:none;">مسح</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div style="background:#fff;border-radius:10px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
    @if($cvs->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>الجنسية</th>
                    <th>الفئة</th>
                    <th>الجنس</th>
                    <th>خبرة</th>
                    <th>الحالة</th>
                    <th>تاريخ الإضافة</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cvs as $cv)
                @php
                    $natName = $cv->nationality?->translations->where('lang_code','ar')->first()?->name
                            ?? $cv->nationality?->translations->first()?->name
                            ?? $cv->nationality_code;
                    $catName = $cv->category?->translations?->where('lang_code','ar')->first()?->name
                            ?? $cv->category?->name
                            ?? '—';

                    $statusMap = [
                        'pending'  => ['label'=>'قيد الانتظار','class'=>'badge-warning'],
                        'approved' => ['label'=>'موافق عليه', 'class'=>'badge-success'],
                        'rejected' => ['label'=>'مرفوض',      'class'=>'badge-danger'],
                        'frozen'   => ['label'=>'مجمد',        'class'=>'badge-gray'],
                    ];
                    $st = $statusMap[$cv->status] ?? ['label'=>$cv->status,'class'=>'badge-gray'];
                @endphp
                <tr>
                    <td style="font-weight:700;">{{ $cv->id }}</td>
                    <td>{{ $natName }}</td>
                    <td>{{ $catName }}</td>
                    <td>{{ $cv->gender === 'male' ? 'ذكر' : ($cv->gender === 'female' ? 'أنثى' : '—') }}</td>
                    <td>
                        @if($cv->has_experience)
                            <span style="color:#059669;font-weight:600;">✓ نعم</span>
                        @else
                            <span style="color:#9ca3af;">—</span>
                        @endif
                    </td>
                    <td><span class="badge {{ $st['class'] }}">{{ $st['label'] }}</span></td>
                    <td style="color:#6b7280;font-size:0.82rem;">{{ $cv->created_at->format('Y-m-d') }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            @if($cv->file_path)
                            <a href="{{ route('office.cvs.download', $cv->id) }}" title="تحميل" style="color:#2563eb;text-decoration:none;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                            </a>
                            @endif
                            <a href="{{ route('office.cvs.edit', $cv->id) }}" title="تعديل" style="color:#054F31;text-decoration:none;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                            </a>
                            <form method="POST" action="{{ route('office.cvs.destroy', $cv->id) }}" onsubmit="return confirm('هل تريد حذف هذه السيرة الذاتية؟')" style="display:inline;">
                                @csrf
                                <button type="submit" title="حذف" style="background:none;border:none;cursor:pointer;color:#dc2626;padding:0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($cvs->hasPages())
        <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6;">
            <div class="pagination-wrap">
                @if($cvs->onFirstPage())
                    <span style="color:#d1d5db;">&rsaquo;</span>
                @else
                    <a href="{{ $cvs->previousPageUrl() }}">&rsaquo;</a>
                @endif

                @foreach($cvs->links()->elements[0] as $page => $url)
                    @if($page == $cvs->currentPage())
                        <span class="active-page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if($cvs->hasMorePages())
                    <a href="{{ $cvs->nextPageUrl() }}">&lsaquo;</a>
                @else
                    <span style="color:#d1d5db;">&lsaquo;</span>
                @endif
            </div>
        </div>
        @endif
    @else
        <div style="text-align:center;padding:3rem;color:#9ca3af;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d1d5db" style="width:48px;height:48px;margin:0 auto 0.75rem;display:block;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            لا توجد سير ذاتية.
            <a href="{{ route('office.cvs.create') }}" style="color:#054F31;font-weight:600;">أضف أول سيرة ذاتية</a>
        </div>
    @endif
</div>

@endsection
