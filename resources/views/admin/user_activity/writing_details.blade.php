@extends('layouts.admin')

@section('title', 'Detail Writing - ' . $user->name)

@section('content')
<div class="page-header" style="margin-bottom: 2.5rem; animation: fadeIn 0.5s ease-out;">
    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
        <a href="{{ route('user-activity.index', ['view' => 'user', 'user_id' => $user->id]) }}" style="color: var(--text-secondary);"><i data-lucide="arrow-left"></i></a>
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin:0;">Riwayat Writing</h1>
    </div>
    <div style="display: flex; align-items: center; gap: 1rem;">
        <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700;">{{ substr($user->name, 0, 1) }}</div>
        <div>
            <div style="font-weight: 600;">{{ $user->name }}</div>
            <div style="font-size: 0.75rem; color: var(--text-secondary);">Semua jawaban latihan menulis</div>
        </div>
    </div>
</div>

<div class="card" style="border-radius: 1.25rem; overflow: hidden; border: 1px solid var(--border-color);">
    <div class="table-container">
        <table style="border-collapse: separate; border-spacing: 0;">
            <thead>
                <tr>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">JUDUL LATIHAN</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">SOAL / INSTRUKSI</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;"> JAWABAN USER</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; text-align: center;">POIN</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">WAKTU SUBMIT</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $act)
                    <tr>
                        <td style="padding: 1.25rem 1.5rem; font-weight: 600;">{{ $act->title }}</td>
                        <td style="padding: 1.25rem 1.5rem; font-size: 0.875rem; color: #64748b;">
                            <div style="max-height: 80px; overflow-y: auto; max-width: 200px;">{{ $act->instruction }}</div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; line-height: 1.6; color: #334155;">
                            <div style="background: #f8fafc; padding: 1rem; border-radius: 0.75rem; border: 1px solid #f1f5f9;">
                                "{{ $act->answer }}"
                            </div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; text-align: center;">
                            <span style="background: #eff6ff; color: var(--primary); padding: 0.25rem 0.75rem; border-radius: 1rem; font-weight: 700; font-size: 0.8125rem;">{{ $act->point_earned }} pts</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; font-size: 0.8125rem; color: var(--text-secondary);">
                            {{ \Carbon\Carbon::parse($act->submitted_at)->format('d M Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 5rem 2rem; color: var(--text-secondary);">Belum ada riwayat writing.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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
    table tr:hover td { background-color: #fcfdfe; }
</style>
@endpush
