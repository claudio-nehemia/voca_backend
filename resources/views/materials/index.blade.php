@extends('layouts.admin')

@section('title', 'Materials')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; animation: fadeIn 0.5s ease-out;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); margin: 0 0 0.5rem 0; letter-spacing: -0.025em;">Materials</h1>
        <p style="color: var(--text-secondary); margin: 0; font-size: 1rem;">Kelola materi PDF untuk dipelajari user</p>
    </div>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <div class="search-box">
            <i data-lucide="search"></i>
            <input type="text" id="material-search" onkeyup="filterBySearch()" placeholder="Cari materi...">
        </div>
        <button class="btn btn-primary" onclick="openModal('createModal')" style="padding: 0.75rem 1.5rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);">
            <i data-lucide="plus" style="width: 20px; height: 20px;"></i>
            Tambah Materi
        </button>
    </div>
</div>

<!-- Stats Card -->
<div style="margin-bottom: 2.5rem;">
    <div class="stat-card" style="background: white; padding: 1.5rem; border-radius: 1.25rem; border: 1px solid var(--border-color); box-shadow: var(--card-shadow); display: inline-block; min-width: 200px;">
        <div style="color: var(--text-secondary); font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Materi</div>
        <div style="font-size: 1.75rem; font-weight: 700; color: var(--primary);">{{ $materials->total() }}</div>
    </div>
</div>

<!-- Table Container -->
<div class="card" style="border-radius: 1.25rem; overflow: hidden; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
    <div class="table-container">
        <table id="material-table" style="border-collapse: separate; border-spacing: 0;">
            <thead>
                <tr>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">NAMA MATERI</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">DESKRIPSI</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">FILE PDF</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">TANGGAL</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; text-align: center; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materials as $material)
                    <tr class="material-row">
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="font-weight: 600; color: var(--text-main); font-size: 1rem;" class="title-text">{{ $material->name }}</div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; max-width: 350px; color: var(--text-secondary); line-height: 1.5; overflow-wrap: break-word; white-space: normal;">
                            {{ Str::limit($material->description, 100) }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="audio-badge" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; background: #fef2f2; color: #ef4444; border: 1px solid #fee2e2;">
                                <i data-lucide="file-text" style="width: 14px; height: 14px;"></i>
                                <span style="font-size: 0.75rem; font-weight: 600;">Lihat PDF</span>
                            </a>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: var(--text-secondary); white-space: nowrap; font-size: 0.875rem;">
                            {{ $material->created_at->format('Y-m-d') }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="display: flex; justify-content: center; gap: 0.75rem;">
                                <button class="action-btn btn-view" onclick="openShowModal({{ $material->id }})" title="Pratinjau">
                                    <i data-lucide="eye"></i>
                                </button>
                                <button class="action-btn btn-edit" onclick="openEditModal({{ $material->id }})" title="Ubah Data">
                                    <i data-lucide="edit-3"></i>
                                </button>
                                <button class="action-btn btn-delete" onclick="openDeleteModal({{ $material->id }})" title="Hapus Data">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="empty-state">
                        <td colspan="5" style="text-align: center; padding: 5rem 2rem;">
                            <div style="color: #cbd5e1; margin-bottom: 1rem;">
                                <i data-lucide="layers" style="width: 48px; height: 48px;"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-secondary); margin-bottom: 0.5rem;">Data Kosong</div>
                            <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">Klik tombol di atas untuk menambah materi pertama Anda.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $materials->links() }}
</div>

@include('materials.modals._create')
@include('materials.modals._edit')
@include('materials.modals._delete')
@include('materials.modals._show')

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

    .btn-view:hover { color: var(--primary); border-color: #dbeafe; background: #eff6ff; }
    .btn-edit:hover { color: #6366f1; border-color: #e0e7ff; background: #eef2ff; }
    .btn-delete:hover { color: #ef4444; border-color: #fee2e2; background: #fef2f2; }

    table tr:hover td {
        background-color: #fcfdfe;
    }
    
    table td {
        transition: background-color 0.2s;
    }

    .audio-badge {
        padding: 0.375rem 0.875rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }
    .audio-badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
</style>
@endpush

@push('scripts')
<script>
    function filterBySearch() {
        const searchQuery = document.getElementById('material-search').value.toLowerCase();
        const rows = document.querySelectorAll('.material-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const title = row.querySelector('.title-text').innerText.toLowerCase();
            if (title.includes(searchQuery)) {
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

    function openShowModal(id) {
        fetch(`/materials/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('show-name').innerText = data.name;
                document.getElementById('show-description').innerText = data.description;
                document.getElementById('show-pdf-link').href = `/storage/${data.file_path}`;
                document.getElementById('show-pdf-preview').src = `/storage/${data.file_path}#toolbar=0`;
                openModal('showModal');
            });
    }

    function openEditModal(id) {
        fetch(`/materials/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const form = document.getElementById('editForm');
                form.action = `/materials/${id}`;
                
                document.getElementById('edit-name').value = data.name;
                document.getElementById('edit-description').value = data.description;
                
                // File preview text
                const currentFile = document.getElementById('current-file-name');
                if (data.file_path) {
                    const fileName = data.file_path.split('/').pop();
                    currentFile.innerText = fileName;
                }
                
                openModal('editModal');
            });
    }

    function openDeleteModal(id) {
        const form = document.getElementById('deleteForm');
        form.action = `/materials/${id}`;
        openModal('deleteModal');
    }
</script>
@endpush
