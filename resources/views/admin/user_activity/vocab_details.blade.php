@extends('layouts.admin')

@section('title', 'Detail Vocabulary - ' . $user->name)

@section('content')
<div class="page-header" style="margin-bottom: 2.5rem; animation: fadeIn 0.5s ease-out;">
    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
        <a href="{{ route('user-activity.index', ['view' => 'user', 'user_id' => $user->id]) }}" style="color: var(--text-secondary);"><i data-lucide="arrow-left"></i></a>
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin:0;">Riwayat Vocabulary</h1>
    </div>
    <div style="display: flex; align-items: center; gap: 1rem;">
        <div style="width: 40px; height: 40px; border-radius: 50%; background: #22c55e; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700;">{{ substr($user->name, 0, 1) }}</div>
        <div>
            <div style="font-weight: 600;">{{ $user->name }}</div>
            <div style="font-size: 0.75rem; color: var(--text-secondary);">Progres kosakata yang telah dipelajari</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    @forelse($activities as $act)
        <div class="card" style="padding: 1.25rem; border-radius: 1rem; border: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; gap: 1rem; hover: transform: translateY(-2px); transition: all 0.2s;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: #dcfce7; color: #22c55e; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="check" style="width: 16px; height: 16px;"></i>
                </div>
                <div>
                    <div style="font-weight: 700; color: var(--text-main); font-size: 1rem;">{{ $act->title }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ \Carbon\Carbon::parse($act->completed_at)->format('d M Y') }}</div>
                </div>
            </div>
            <div style="font-size: 0.625rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">DONE</div>
        </div>
    @empty
        <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary); padding: 5rem 0;">Belum ada riwayat vocabulary.</p>
    @endforelse
</div>

<div style="margin-top: 1.5rem;">
    {{ $activities->links() }}
</div>

@endsection

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush
