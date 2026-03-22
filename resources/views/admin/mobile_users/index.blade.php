@extends('layouts.admin')

@section('title', 'Mobile Users')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; animation: fadeIn 0.5s ease-out;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); margin: 0 0 0.5rem 0; letter-spacing: -0.025em;">Mobile Users</h1>
        <p style="color: var(--text-secondary); margin: 0; font-size: 1rem;">Kelola akun pengguna aplikasi mobile</p>
    </div>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <div class="search-box">
            <i data-lucide="search"></i>
            <input type="text" id="user-search" onkeyup="filterBySearch()" placeholder="Cari user...">
        </div>
        
        <a href="{{ route('mobile-users.requests') }}" class="btn" style="background: white; border: 1px solid var(--border-color); color: var(--primary); padding: 0.75rem 1.25rem; border-radius: 1rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 600;">
            <i data-lucide="bell-ring" style="width: 18px; height: 18px;"></i>
            Request Aktivasi
            @php $reqCount = \App\Models\User::where('role', '!=', 'admin')->where('is_active', false)->count(); @endphp
            @if($reqCount > 0)
                <span style="background: #ef4444; color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem;">{{ $reqCount }}</span>
            @endif
        </a>

        <button class="btn btn-primary" onclick="openModal('createModal')" style="padding: 0.75rem 1.5rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);">
            <i data-lucide="user-plus" style="width: 20px; height: 20px;"></i>
            Tambah User
        </button>
    </div>
</div>

<!-- Stats Card -->
<div style="margin-bottom: 2.5rem;">
    <div class="stat-card" style="background: white; padding: 1.5rem; border-radius: 1.25rem; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); display: inline-block; min-width: 200px;">
        <div style="color: var(--text-secondary); font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Mobile User</div>
        <div style="font-size: 1.75rem; font-weight: 700; color: var(--primary);">{{ $users->total() }}</div>
    </div>
</div>

<!-- Table Container -->
<div class="card" style="border-radius: 1.25rem; overflow: hidden; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
    <div class="table-container">
        <table id="user-table" style="border-collapse: separate; border-spacing: 0;">
            <thead>
                <tr>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">USER</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">EMAIL</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">KELAS</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">STATUS</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; text-align: center; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="user-row">
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #eff6ff, #dbeafe); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; border: 1px solid #dbeafe;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--text-main); font-size: 1rem;" class="user-name">{{ $user->name }}</div>
                                    <div style="font-size: 0.75rem; color: var(--text-secondary);">Score: {{ $user->score }} pts</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: var(--text-secondary); font-size: 0.875rem;">
                            {{ $user->email }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: var(--text-main); font-weight: 600; font-size: 0.875rem;">
                            {{ $user->class ?? '-' }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            @if($user->is_active)
                                <span class="badge" style="background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.75rem; font-weight: 600;">Aktif</span>
                            @else
                                <span class="badge" style="background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 0.25rem 0.75rem; border-radius: 2rem; font-size: 0.75rem; font-weight: 600;">Menunggu Aktivasi</span>
                            @endif
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="display: flex; justify-content: center; gap: 0.75rem;">
                                @if(!$user->is_active)
                                    <form action="{{ route('mobile-users.activate', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="action-btn" title="Aktivasi Akun" style="color: #059669; border-color: #d1fae5; background: #ecfdf5;">
                                            <i data-lucide="check-circle"></i>
                                        </button>
                                    </form>
                                @endif
                                <button class="action-btn btn-edit" onclick="openEditModal({{ $user->id }})" title="Ubah Data">
                                    <i data-lucide="edit-3"></i>
                                </button>
                                <button class="action-btn btn-delete" onclick="openDeleteModal({{ $user->id }})" title="Hapus Data">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="empty-state">
                        <td colspan="5" style="text-align: center; padding: 5rem 2rem;">
                            <div style="color: #cbd5e1; margin-bottom: 1rem;">
                                <i data-lucide="users" style="width: 48px; height: 48px;"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-secondary); margin-bottom: 0.5rem;">Data Kosong</div>
                            <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">Belum ada user aplikasi mobile yang terdaftar.</p>
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

@include('admin.mobile_users.modals._create')
@include('admin.mobile_users.modals._edit')
@include('admin.mobile_users.modals._delete')

@endsection

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Global search-box style */

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
    .action-btn i { width: 16px; height: 16px; }

    .btn-edit:hover { color: #6366f1; border-color: #e0e7ff; background: #eef2ff; }
    .btn-delete:hover { color: #ef4444; border-color: #fee2e2; background: #fef2f2; }

    table tr:hover td {
        background-color: #fcfdfe;
    }
    
    table td {
        transition: background-color 0.2s;
    }
</style>
@endpush

@push('scripts')
<script>
    function filterBySearch() {
        const searchQuery = document.getElementById('user-search').value.toLowerCase();
        const rows = document.querySelectorAll('.user-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.querySelector('.user-name').innerText.toLowerCase();
            if (name.includes(searchQuery)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const emptyState = document.getElementById('empty-state');
        if (emptyState) {
            emptyState.style.display = (visibleCount === 0) ? '' : 'none';
        }
    }

    function openEditModal(id) {
        fetch(`/mobile-users/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const form = document.getElementById('editForm');
                form.action = `/mobile-users/${id}`;
                
                document.getElementById('edit-name').value = data.name;
                document.getElementById('edit-email').value = data.email;
                document.getElementById('edit-class').value = data.class;
                document.getElementById('edit-is-active').checked = !!data.is_active;
                
                // Reset password field
                document.getElementById('edit-password').value = "";
                
                openModal('editModal');
            });
    }

    function openDeleteModal(id) {
        const form = document.getElementById('deleteForm');
        form.action = `/mobile-users/${id}`;
        openModal('deleteModal');
    }
</script>
@endpush
