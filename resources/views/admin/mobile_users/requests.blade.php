@extends('layouts.admin')

@section('title', 'Activation Requests')

@section('content')
<div class="page-header" style="margin-bottom: 2.5rem; animation: fadeIn 0.5s ease-out;">
    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
        <a href="{{ route('mobile-users.index') }}" style="color: var(--text-secondary); text-decoration: none; display: flex; align-items: center; gap: 0.5rem; font-weight: 600; font-size: 0.875rem;">
            <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
            Kembali ke Daftar User
        </a>
    </div>
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); margin: 0; letter-spacing: -0.025em;">Request Aktivasi</h1>
    <p style="color: var(--text-secondary); margin: 0.5rem 0 0 0; font-size: 1rem;">Daftar akun yang menunggu persetujuan aktivasi</p>
</div>

<!-- Table for Requests -->
<div class="card" style="border-radius: 1.25rem; overflow: hidden; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
    <div class="table-container">
        <table id="request-table" style="border-collapse: separate; border-spacing: 0;">
            <thead>
                <tr>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">USER</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">EMAIL</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">KELAS</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">WAKTU DAFTAR</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; text-align: center; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="request-row">
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 40px; height: 40px; border-radius: 12px; background: #fff1f2; color: #e11d48; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; border: 1px solid #ffe4e6;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div style="font-weight: 600; color: var(--text-main); font-size: 1rem;">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: var(--text-secondary); font-size: 0.875rem;">
                            {{ $user->email }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: var(--text-main); font-weight: 600; font-size: 0.875rem;">
                            {{ $user->class ?? '-' }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: var(--text-secondary); font-size: 0.875rem;">
                            {{ $user->created_at->diffForHumans() }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="display: flex; justify-content: center; gap: 0.75rem;">
                                <form action="{{ route('mobile-users.activate', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1.25rem; border-radius: 0.75rem; font-size: 0.875rem; display: flex; align-items: center; gap: 0.5rem;">
                                        <i data-lucide="check-circle" style="width: 16px; height: 16px;"></i>
                                        Aktivasi Akun
                                    </button>
                                </form>
                                <button class="action-btn btn-delete" onclick="openDeleteModal({{ $user->id }})" title="Tolak / Hapus">
                                    <i data-lucide="user-x"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 5rem 2rem;">
                            <div style="color: #cbd5e1; margin-bottom: 1rem;">
                                <i data-lucide="check-circle-2" style="width: 48px; height: 48px; color: #10b981;"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-secondary); margin-bottom: 0.5rem;">Semua Bersih!</div>
                            <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">Tidak ada antrean request aktivasi saat ini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $users->links() }}
</div>

@include('admin.mobile_users.modals._delete')

@endsection

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid #f1f5f9;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
        color: var(--text-secondary);
    }
    .btn-delete:hover { color: #ef4444; border-color: #fee2e2; background: #fef2f2; }
</style>
@endpush
@push('scripts')
<script>
    function openDeleteModal(id) {
        const form = document.getElementById('deleteForm');
        form.action = `/mobile-users/${id}`;
        openModal('deleteModal');
    }
</script>
@endpush
