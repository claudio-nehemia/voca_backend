@extends('layouts.admin')

@section('title', 'Vocabulary')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; animation: fadeIn 0.5s ease-out;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); margin: 0 0 0.5rem 0; letter-spacing: -0.025em;">Vocabulary</h1>
        <p style="color: var(--text-secondary); margin: 0; font-size: 1rem;">Kelola dan kurasi konten kata vokal untuk aplikasi mobile</p>
    </div>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <div class="search-box">
            <i data-lucide="search"></i>
            <input type="text" id="vocabulary-search" onkeyup="filterBySearch()" placeholder="Cari vocabulary...">
        </div>
        <button class="btn btn-primary" onclick="openModal('createModal')" style="padding: 0.75rem 1.5rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);">
            <i data-lucide="plus-circle" style="width: 20px; height: 20px;"></i>
            Tambah Baru
        </button>
    </div>
</div>

<!-- Stats / Filter Overview -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
    <div class="stat-card" style="background: white; padding: 1.5rem; border-radius: 1.25rem; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
        <div style="color: var(--text-secondary); font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Vocabulary</div>
        <div style="font-size: 1.75rem; font-weight: 700; color: var(--primary);">{{ $vocabularies->total() }}</div>
    </div>
    <div class="stat-card" style="background: white; padding: 1.5rem; border-radius: 1.25rem; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
        <div style="color: var(--text-secondary); font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Tema</div>
        <div style="font-size: 1.75rem; font-weight: 700; color: #6366f1;">{{ $themes->count() }}</div>
    </div>
</div>

<!-- Filter Bar -->
<div class="card" style="padding: 1.25rem; margin-bottom: 2rem; border-radius: 1.25rem; background: linear-gradient(to right, white, #f8fafc);">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;">
        <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
            <div style="color: var(--text-main); font-size: 0.9375rem; font-weight: 600; display: flex; align-items: center; gap: 0.625rem;">
                <i data-lucide="layout-grid" style="width: 18px; height: 18px; color: var(--primary);"></i>
                Filter Tema:
            </div>
            <div style="display: flex; gap: 0.625rem; flex-wrap: wrap;" id="theme-filters">
                <button class="filter-pill active" onclick="filterByTheme('all', this)">Semua ({{ $vocabularies->total() }})</button>
                @foreach($themes as $theme)
                    <button class="filter-pill" onclick="filterByTheme('{{ $theme->name }}', this)">{{ $theme->name }} ({{ $theme->vocabularies_count }})</button>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Table Container -->
<div class="card" style="border-radius: 1.25rem; overflow: hidden; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
    <div class="table-container">
        <table id="vocabulary-table" style="border-collapse: separate; border-spacing: 0;">
            <thead>
                <tr>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">TEMA</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">NAMA VOCABULARY</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">DESKRIPSI</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">TUJUAN</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">AUDIO</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">POIN</th>
                    <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; text-align: center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vocabularies as $vocabulary)
                    <tr class="vocabulary-row" data-theme="{{ $vocabulary->theme->name ?? 'none' }}">
                        <td style="padding: 1.25rem 1.5rem;">
                            <span class="badge badge-theme" style="padding: 0.375rem 0.875rem; font-size: 0.75rem; letter-spacing: 0.025em;">
                                {{ $vocabulary->theme->name ?? 'Tanpa Tema' }}
                            </span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; font-weight: 600; color: var(--text-main); font-size: 1rem;">
                            <span class="title-text">{{ $vocabulary->title }}</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; max-width: 260px; color: var(--text-secondary); line-height: 1.5; overflow-wrap: break-word; white-space: normal;">
                            {{ Str::limit($vocabulary->description, 80) }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem; max-width: 260px; color: var(--text-secondary); line-height: 1.5; overflow-wrap: break-word; white-space: normal;">
                            {{ Str::limit($vocabulary->goals, 80) }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            @if($vocabulary->audio_url)
                                <div class="audio-badge">
                                    <i data-lucide="play" style="width: 12px; height: 12px; fill: currentColor;"></i>
                                    Berisi Audio
                                </div>
                            @else
                                <span style="color: #cbd5e1; font-size: 0.875rem; font-style: italic;">Tidak ada audio</span>
                            @endif
                        </td>
                        <td style="padding: 1.25rem 1.5rem; font-weight: 700; color: var(--primary);">
                            {{ $vocabulary->point }}
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="display: flex; justify-content: center; gap: 0.75rem;">
                                <button class="action-btn btn-view" onclick="openShowModal({{ $vocabulary->id }})" title="Pratinjau">
                                    <i data-lucide="eye"></i>
                                </button>
                                <button class="action-btn btn-edit" onclick="openEditModal({{ $vocabulary->id }})" title="Ubah Data">
                                    <i data-lucide="edit-3"></i>
                                </button>
                                <button class="action-btn btn-delete" onclick="openDeleteModal({{ $vocabulary->id }})" title="Hapus Data">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="empty-state">
                        <td colspan="7" style="text-align: center; padding: 5rem 2rem;">
                            <div style="color: #cbd5e1; margin-bottom: 1rem;">
                                <i data-lucide="folder-open" style="width: 48px; height: 48px;"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-secondary); margin-bottom: 0.5rem;">Data Kosong</div>
                            <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">Klik tombol di atas untuk menambah vocabulary pertama Anda.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $vocabularies->links() }}
</div>

@include('vocabularies.modals._create')
@include('vocabularies.modals._edit')
@include('vocabularies.modals._show')
@include('vocabularies.modals._delete')

@endsection

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .filter-pill {
        padding: 0.5rem 1.25rem;
        border-radius: 0.875rem;
        background-color: white;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .filter-pill:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: var(--text-main);
    }
    .filter-pill.active {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }
    
    /* .search-box styles are now global in admin.blade.php */

    .audio-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.75rem;
        background-color: #f0fdf4;
        color: #16a34a;
        border-radius: 0.625rem;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid #dcfce7;
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
</style>
@endpush

@push('scripts')
<script>
    let activeTheme = 'all';

    function filterByTheme(theme, element) {
        activeTheme = theme;
        
        // Update pills
        document.querySelectorAll('.filter-pill').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
        
        applyFilters();
    }

    function filterBySearch() {
        applyFilters();
    }

    function applyFilters() {
        const searchQuery = document.getElementById('vocabulary-search').value.toLowerCase();
        const rows = document.querySelectorAll('.vocabulary-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowTheme = row.getAttribute('data-theme');
            const title = row.querySelector('.title-text').innerText.toLowerCase();
            
            const matchesTheme = (activeTheme === 'all' || rowTheme === activeTheme);
            const matchesSearch = title.includes(searchQuery);

            if (matchesTheme && matchesSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Toggle empty state if any
        const emptyState = document.getElementById('empty-state');
        if (emptyState) {
            emptyState.style.display = (visibleCount === 0) ? '' : 'none';
        }
    }

    function openShowModal(id) {
        fetch(`/vocabularies/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('show-theme').innerText = data.theme ? data.theme.name : 'No Theme';
                document.getElementById('show-title').innerText = data.title;
                document.getElementById('show-description').innerText = data.description || '-';
                document.getElementById('show-goals').innerText = data.goals || '-';
                document.getElementById('show-point').innerText = data.point || '0';
                
                // Handle Audio Player
                const playerContainer = document.getElementById('show-audio-container');
                const noAudioMsg = document.getElementById('no-audio-msg');
                const player = document.getElementById('show-audio-player');

                if (data.audio_url) {
                    player.src = data.audio_url;
                    playerContainer.style.display = 'block';
                    noAudioMsg.style.display = 'none';
                } else {
                    player.src = '';
                    playerContainer.style.display = 'none';
                    noAudioMsg.style.display = 'block';
                }

                openModal('showModal');
            });
    }

    function openEditModal(id) {
        fetch(`/vocabularies/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const form = document.getElementById('editForm');
                form.action = `/vocabularies/${id}`;
                
                // Set values
                document.getElementById('edit-title').value = data.vocabulary.title;
                document.getElementById('edit-description').value = data.vocabulary.description;
                document.getElementById('edit-goals').value = data.vocabulary.goals;
                document.getElementById('edit-point').value = data.vocabulary.point;
                document.getElementById('edit-audio-url').value = data.vocabulary.audio_url || '';
                
                // Show current audio preview
                const preview = document.getElementById('edit-audio-preview');
                if (data.vocabulary.audio_url) {
                    preview.innerText = data.vocabulary.audio_url;
                } else {
                    preview.innerText = 'Tidak ada audio saat ini';
                }

                // Select theme
                const themeSelect = document.getElementById('edit-theme-id');
                themeSelect.value = data.vocabulary.theme_id;
                
                openModal('editModal');
            });
    }

    function openDeleteModal(id) {
        const form = document.getElementById('deleteForm');
        form.action = `/vocabularies/${id}`;
        openModal('deleteModal');
    }
</script>
@endpush
