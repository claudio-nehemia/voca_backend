<!-- Modal Create -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <form action="{{ route('vocabularies.store') }}" method="POST" id="createForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Tambah Vocabulary Baru</h3>
                <button type="button" class="btn-icon" onclick="closeModal('createModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Theme Selection -->
                <div class="form-group">
                    <label class="form-label">Theme</label>
                    <div id="theme-select-container">
                        <select name="theme_id" id="theme-select" class="form-control" onchange="checkNewTheme(this)">
                            <option value="">Pilih Tema</option>
                            @foreach($themes as $theme)
                                <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                            @endforeach
                            <option value="new" style="color: var(--primary); font-weight: 600;">+ Tambah Tema Baru</option>
                        </select>
                    </div>
                    
                    <div id="new-theme-container" style="display: none; margin-top: 0.75rem; background: #f8fafc; padding: 1rem; border-radius: 0.75rem; border: 1px dashed var(--border-color);">
                        <label class="form-label">Nama Tema Baru</label>
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="text" name="new_theme" id="new-theme-input" class="form-control" placeholder="Contoh: Daily Activities">
                            <button type="button" class="btn" onclick="cancelNewTheme()" style="background-color: #f1f5f9; color: var(--text-main); border: 1px solid var(--border-color);">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Nama Vocabulary -->
                <div class="form-group">
                    <label class="form-label">Nama Vocabulary <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="e.g., Morning Routine" required>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi vocabulary..."></textarea>
                </div>

                <!-- Tujuan -->
                <div class="form-group">
                    <label class="form-label">Tujuan</label>
                    <textarea name="goals" class="form-control" rows="3" placeholder="Tujuan pembelajaran..."></textarea>
                </div>

                <!-- Poin -->
                <div class="form-group">
                    <label class="form-label">Poin <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="point" class="form-control" placeholder="e.g., 10" value="0" required>
                </div>

                <!-- Audio -->
                <div class="form-group">
                    <label class="form-label">Audio Content</label>
                    <div style="background: #f8fafc; border: 1px solid var(--border-color); border-radius: 1rem; padding: 1.25rem;">
                        <div style="margin-bottom: 1rem;">
                            <label style="font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); display: block; margin-bottom: 0.5rem;">UPLOAD FILE (MP3 / WAV)</label>
                            <input type="file" name="audio_file" class="form-control" accept="audio/*" style="background: white;">
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div style="flex: 1; height: 1px; background: var(--border-color);"></div>
                            <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 600;">ATAU</span>
                            <div style="flex: 1; height: 1px; background: var(--border-color);"></div>
                        </div>

                        <div>
                            <label style="font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); display: block; margin-bottom: 0.5rem;">INPUT URL AUDIO</label>
                            <input type="text" name="audio_url" class="form-control" placeholder="https://example.com/audio.mp3" style="background: white;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal('createModal')" style="background-color: white; border: 1px solid var(--border-color); color: var(--text-secondary);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Tambah Vocabulary
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
