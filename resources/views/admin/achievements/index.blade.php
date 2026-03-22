@extends('layouts.admin')

@section('title', 'Achievements')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; animation: fadeIn 0.5s ease-out;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); margin: 0 0 0.5rem 0; letter-spacing: -0.025em;">Achievements</h1>
        <p style="color: var(--text-secondary); margin: 0; font-size: 1rem;">Atur pencapaian yang bisa diraih pengguna berdasarkan poin</p>
    </div>
    <button class="btn btn-primary" onclick="openModal('createModal')" style="padding: 0.75rem 1.5rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);">
        <i data-lucide="plus" style="width: 20px; height: 20px;"></i>
        Tambah Achievement
    </button>
</div>

<!-- Stats Cards per type -->
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2.5rem;">
    @foreach(['total' => ['🏆', 'Total Score', '#fbbf24', '#fffbeb', '#fef3c7'], 'vocabulary' => ['📚', 'Vocabulary', '#3b82f6', '#eff6ff', '#dbeafe'], 'writing' => ['✍️', 'Writing', '#8b5cf6', '#f5f3ff', '#ede9fe'], 'speaking' => ['🎤', 'Speaking', '#10b981', '#ecfdf5', '#d1fae5']] as $type => $info)
        <div style="background: white; padding: 1.5rem; border-radius: 1.25rem; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
            <div style="font-size: 2rem; margin-bottom: 0.75rem;">{{ $info[0] }}</div>
            <div style="font-size: 0.75rem; font-weight: 700; color: {{ $info[2] }}; text-transform: uppercase; margin-bottom: 0.25rem;">{{ $info[1] }}</div>
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--text-main);">{{ \App\Models\Achievement::where('type', $type)->count() }}</div>
        </div>
    @endforeach
</div>

<!-- Achievement Cards -->
@if ($achievements->count() > 0)
    @foreach(['total' => ['Total Score', '🏆', '#fbbf24'], 'vocabulary' => ['Vocabulary', '📚', '#3b82f6'], 'writing' => ['Writing', '✍️', '#8b5cf6'], 'speaking' => ['Speaking', '🎤', '#10b981']] as $type => $info)
        @php $group = $achievements->where('type', $type); @endphp
        @if($group->count() > 0)
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
                    <span style="font-size: 1.25rem;">{{ $info[0] }}</span>
                    <h2 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">{{ $info[1] }} Achievements</h2>
                    <span style="background: #f1f5f9; color: var(--text-secondary); font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.6rem; border-radius: 1rem;">{{ $group->count() }}</span>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.25rem;">
                    @foreach($group->sortBy('required_points') as $achievement)
                        <div class="achievement-card" style="background: white; border: 1px solid var(--border-color); border-radius: 1.5rem; padding: 1.75rem; box-shadow: var(--card-shadow); display: flex; flex-direction: column; gap: 1rem; transition: all 0.2s;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="width: 64px; height: 64px; border-radius: 1rem; background: #f8fafc; display: flex; align-items: center; justify-content: center; font-size: 2rem; border: 1px solid var(--border-color);">
                                    {{ $achievement->icon }}
                                </div>
                                <div style="display: flex; gap: 0.5rem;">
                                    <button class="action-btn btn-edit" onclick="openEditModal({{ $achievement->id }})" title="Ubah">
                                        <i data-lucide="edit-3"></i>
                                    </button>
                                    <button class="action-btn btn-delete" onclick="openDeleteModal({{ $achievement->id }})" title="Hapus">
                                        <i data-lucide="trash-2"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <div style="font-weight: 700; color: var(--text-main); font-size: 1.125rem; margin-bottom: 0.375rem;">{{ $achievement->name }}</div>
                                <p style="color: var(--text-secondary); font-size: 0.875rem; line-height: 1.5; margin: 0;">{{ $achievement->description ?? 'Tidak ada deskripsi.' }}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 0.75rem; border-top: 1px solid #f1f5f9;">
                                <span class="type-badge type-{{ $achievement->type }}">{{ $achievement->type_label }}</span>
                                <span style="font-weight: 800; color: {{ $info[2] }}; font-size: 1.125rem;">≥ {{ number_format($achievement->required_points) }} <span style="font-size: 0.75rem; font-weight: 600; color: var(--text-secondary);">pts</span></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    <div style="margin-top: 1.5rem;">
        {{ $achievements->links() }}
    </div>
@else
    <div class="card" style="padding: 5rem 2rem; text-align: center; border-radius: 1.5rem; border: 1px solid var(--border-color);">
        <div style="font-size: 4rem; margin-bottom: 1rem;">🏅</div>
        <div style="font-weight: 700; color: var(--text-main); font-size: 1.25rem; margin-bottom: 0.5rem;">Belum Ada Achievement</div>
        <p style="color: var(--text-secondary); max-width: 400px; margin: 0 auto 2rem auto;">Mulai motivasi siswa Anda dengan membuat achievement pertama!</p>
        <button class="btn btn-primary" onclick="openModal('createModal')">
            <i data-lucide="plus" style="width: 18px; height: 18px;"></i>
            Buat Achievement Pertama
        </button>
    </div>
@endif

@include('admin.achievements.modals._create')
@include('admin.achievements.modals._edit')
@include('admin.achievements.modals._delete')

@endsection

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .achievement-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid #f1f5f9;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
        color: var(--text-secondary);
    }
    .action-btn i { width: 15px; height: 15px; }
    .btn-edit:hover { color: #6366f1; border-color: #e0e7ff; background: #eef2ff; }
    .btn-delete:hover { color: #ef4444; border-color: #fee2e2; background: #fef2f2; }

    .type-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .type-total      { background: #fffbeb; color: #92400e; border: 1px solid #fef3c7; }
    .type-vocabulary { background: #eff6ff; color: #1e40af; border: 1px solid #dbeafe; }
    .type-writing    { background: #f5f3ff; color: #5b21b6; border: 1px solid #ede9fe; }
    .type-speaking   { background: #ecfdf5; color: #065f46; border: 1px solid #d1fae5; }
</style>
@endpush

@push('scripts')
<script>
    function openEditModal(id) {
        fetch(`/achievements/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const form = document.getElementById('editForm');
                form.action = `/achievements/${id}`;
                document.getElementById('edit-name').value = data.name;
                document.getElementById('edit-description').value = data.description ?? '';
                document.getElementById('edit-icon').value = data.icon;
                document.getElementById('edit-icon-preview').innerText = data.icon;
                document.getElementById('edit-type').value = data.type;
                document.getElementById('edit-required-points').value = data.required_points;
                openModal('editModal');
            });
    }

    function openDeleteModal(id) {
        const form = document.getElementById('deleteForm');
        form.action = `/achievements/${id}`;
        openModal('deleteModal');
    }
</script>
@endpush
