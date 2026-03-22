<!-- Modal Edit -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <form action="" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Ubah Speaking</h3>
                <button type="button" class="btn-icon" onclick="closeModal('editModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Theme Selection -->
                <div class="form-group">
                    <label class="form-label">Jenis Speaking</label>
                    <div id="edit-theme-select-container">
                        <select name="jenis_speaking_id" id="edit-theme-id" class="form-control" onchange="checkEditNewTheme(this)">
                            <option value="">Pilih Jenis Speaking</option>
                            @foreach($jenisSpeakings as $theme)
                                <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                            @endforeach
                            <option value="new" style="color: var(--primary); font-weight: 600;">+ Tambah Jenis Baru</option>
                        </select>
                    </div>
                    
                    <div id="edit-new-theme-container" style="display: none; margin-top: 0.75rem; background: #f8fafc; padding: 1rem; border-radius: 0.75rem; border: 1px dashed var(--border-color);">
                        <label class="form-label">Nama Jenis Speaking Baru</label>
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="text" name="new_jenis_speaking" id="edit-new-theme-input" class="form-control" placeholder="Contoh: Pronunciation">
                            <button type="button" class="btn" onclick="cancelEditNewTheme()" style="background-color: #f1f5f9; color: var(--text-main); border: 1px solid var(--border-color);">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Judul Soal -->
                <div class="form-group">
                    <label class="form-label">Judul Soal <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="title" id="edit-title" class="form-control" placeholder="e.g., Introduce Yourself" required>
                </div>

                <!-- Poin -->
                <div class="form-group">
                    <label class="form-label">Poin <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="point" id="edit-point" class="form-control" placeholder="e.g., 20" required>
                </div>

                <!-- Instruksi -->
                <div class="form-group">
                    <label class="form-label">Instruksi <span style="color: #ef4444;">*</span></label>
                    <textarea name="instruction" id="edit-instruction" class="form-control" rows="5" placeholder="Tulis instruksi lengkap untuk soal speaking..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal('editModal')" style="background-color: white; border: 1px solid var(--border-color); color: var(--text-secondary);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function checkEditNewTheme(select) {
        const container = document.getElementById('edit-new-theme-container');
        const input = document.getElementById('edit-new-theme-input');
        if (select.value === 'new') {
            container.style.display = 'block';
            input.focus();
            select.style.display = 'none';
        } else {
            container.style.display = 'none';
        }
    }

    function cancelEditNewTheme() {
        const select = document.getElementById('edit-theme-id');
        const container = document.getElementById('edit-new-theme-container');
        const input = document.getElementById('edit-new-theme-input');
        
        select.style.display = 'block';
        container.style.display = 'none';
        input.value = "";
    }
</script>
