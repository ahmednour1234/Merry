@extends('office.layouts.app')

@section('title', 'الإشعارات')
@section('page-title', 'الإشعارات')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
    <div>
        <h2 style="font-size:1.1rem;font-weight:700;color:#111827;margin:0;">الإشعارات</h2>
        <p style="color:#6b7280;font-size:0.82rem;margin:0.2rem 0 0;">إجمالي: {{ $notifications->total() }} إشعار</p>
    </div>
    @if($notifications->total() > 0)
    <form method="POST" action="{{ route('office.notifications.read-all') }}">
        @csrf
        <button type="submit" class="btn-secondary" style="font-size:0.82rem;padding:0.45rem 0.9rem;">تحديد الكل كمقروء</button>
    </form>
    @endif
</div>

<div style="display:flex;flex-direction:column;gap:0.75rem;">
    @forelse($notifications as $nr)
    @php
        $isRead = $nr->status === 'read';
        $notif  = $nr->notification;
    @endphp
    <div style="background:#fff;border-radius:10px;padding:1.1rem 1.25rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);display:flex;align-items:flex-start;gap:1rem;border-right:4px solid {{ $isRead ? '#e5e7eb' : '#054F31' }};">
        <div style="flex:1;">
            <div style="display:flex;align-items:center;gap:0.6rem;margin-bottom:0.35rem;">
                @if(!$isRead)
                    <span style="width:8px;height:8px;background:#054F31;border-radius:50%;flex-shrink:0;"></span>
                @endif
                <div style="font-size:0.95rem;font-weight:{{ $isRead ? '500' : '700' }};color:#111827;">
                    {{ $notif?->title_ar ?? $notif?->title ?? 'إشعار' }}
                </div>
            </div>
            @if($notif?->body_ar ?? $notif?->body)
                <div style="font-size:0.85rem;color:#6b7280;line-height:1.6;">{{ $notif->body_ar ?? $notif->body }}</div>
            @endif
            <div style="font-size:0.77rem;color:#9ca3af;margin-top:0.4rem;">
                {{ $nr->created_at?->diffForHumans() ?? '—' }}
            </div>
        </div>
        @if(!$isRead)
        <form method="POST" action="{{ route('office.notifications.mark-read', $nr->id) }}" style="flex-shrink:0;">
            @csrf
            <button type="submit" style="background:#e8f5ef;border:none;color:#054F31;border-radius:6px;padding:0.3rem 0.7rem;font-family:'Cairo',sans-serif;font-size:0.78rem;cursor:pointer;font-weight:600;">
                تحديد كمقروء
            </button>
        </form>
        @endif
    </div>
    @empty
    <div style="background:#fff;border-radius:10px;padding:3rem;text-align:center;color:#9ca3af;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d1d5db" style="width:48px;height:48px;margin:0 auto 0.75rem;display:block;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>
        لا توجد إشعارات
    </div>
    @endforelse
</div>

@if($notifications->hasPages())
<div style="margin-top:1.25rem;">
    <div class="pagination-wrap">
        @if($notifications->onFirstPage())
            <span style="color:#d1d5db;">&rsaquo;</span>
        @else
            <a href="{{ $notifications->previousPageUrl() }}">&rsaquo;</a>
        @endif
        @foreach($notifications->links()->elements[0] as $page => $url)
            @if($page == $notifications->currentPage())
                <span class="active-page">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach
        @if($notifications->hasMorePages())
            <a href="{{ $notifications->nextPageUrl() }}">&lsaquo;</a>
        @else
            <span style="color:#d1d5db;">&lsaquo;</span>
        @endif
    </div>
</div>
@endif

@endsection
