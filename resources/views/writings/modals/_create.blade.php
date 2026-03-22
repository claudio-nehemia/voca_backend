<!-- Modal Create -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <form action="{{ route('writings.store') }}" method="POST" id="createForm">
            @csrf
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Tambah Writing Baru</h3>
                <button type="button" class="btn-icon" onclick="closeModal('createModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Theme Selection -->
                <div class="form-group">
                    <label class="form-label">Jenis Writing</label>
                    <div id="theme-select-container">
                        <select name="writing_theme_id" id="theme-select" class="form-control" onchange="checkNewTheme(this)">
                            <option value="">Pilih Jenis Writing</option>
                            @foreach($themes as $theme)
                                <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                            @endforeach
                            <option value="new" style="color: var(--primary); font-weight: 600;">+ Tambah Jenis Baru</option>
                        </select>
                    </div>
                    
                    <div id="new-theme-container" style="display: none; margin-top: 0.75rem; background: #f8fafc; padding: 1rem; border-radius: 0.75rem; border: 1px dashed var(--border-color);">
                        <label class="form-label">Nama Jenis Writing Baru</label>
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="text" name="new_theme" id="new-theme-input" class="form-control" placeholder="Contoh: Descriptive Text">
                            <button type="button" class="btn" onclick="cancelNewTheme()" style="background-color: #f1f5f9; color: var(--text-main); border: 1px solid var(--border-color);">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Jenis Soal (Title) -->
                <div class="form-group">
                    <label class="form-label">Jenis Soal <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="e.g., Essay, Story Writing" required>
                </div>

                <!-- Poin -->
                <div class="form-group">
                    <label class="form-label">Poin <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="point" class="form-control" placeholder="e.g., 20" value="0" required>
                </div>

                <!-- Instruksi -->
                <div class="form-group">
                    <label class="form-label">Instruksi <span style="color: #ef4444;">*</span></label>
                    <textarea name="instruction" class="form-control" rows="5" placeholder="Tulis instruksi lengkap untuk soal writing..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal('createModal')" style="background-color: white; border: 1px solid var(--border-color); color: var(--text-secondary);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function checkNewTheme(select) {
        const container = document.getElementById('new-theme-container');
        const input = document.getElementById('new-theme-input');
        if (select.value === 'new') {
            container.style.display = 'block';
            input.focus();
            select.style.display = 'none';
        } else {
            container.style.display = 'none';
        }
    }

    function cancelNewTheme() {
        const select = document.getElementById('theme-select');
        const container = document.getElementById('new-theme-container');
        const input = document.getElementById('new-theme-input');
        
        select.value = "";
        select.style.display = 'block';
        container.style.display = 'none';
        input.value = "";
    }
</script>
