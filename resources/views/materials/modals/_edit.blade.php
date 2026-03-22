<!-- Modal Edit -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <form action="" method="POST" id="editForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Ubah Materi</h3>
                <button type="button" class="btn-icon" onclick="closeModal('editModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nama Materi -->
                <div class="form-group">
                    <label class="form-label">Nama Materi <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" id="edit-name" class="form-control" required>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label class="form-label">Deskripsi <span style="color: #ef4444;">*</span></label>
                    <textarea name="description" id="edit-description" class="form-control" rows="4" required></textarea>
                </div>

                <!-- Update PDF -->
                <div class="form-group">
                    <label class="form-label">Update File PDF (Opsional)</label>
                    <div style="background: #f8fafc; border: 1px dashed var(--border-color); padding: 1.5rem; border-radius: 1rem; text-align: center;">
                        <input type="file" name="file_path" accept=".pdf" style="display: none;" id="edit-pdf-input" onchange="updateFileNameEdit(this, 'edit-file-name')">
                        <label for="edit-pdf-input" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 0.75rem;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: white; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; color: #ef4444; box-shadow: var(--card-shadow);">
                                <i data-lucide="file-up"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main);" id="edit-file-name">Klik untuk mengganti File PDF</div>
                                <div style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.25rem;">Biarkan kosong jika tidak ingin mengganti file</div>
                                <div style="font-size: 0.6875rem; margin-top: 0.5rem; padding: 0.25rem 0.5rem; background: white; border-radius: 4px; border: 1px solid var(--border-color); display: inline-block;">
                                    Saat ini: <span id="current-file-name" style="font-style: italic; color: #64748b;">Tidak ada file</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal('editModal')" style="background-color: white; border: 1px solid var(--border-color); color: var(--text-secondary);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Update Materi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileNameEdit(input, targetId) {
        if (input.files && input.files[0]) {
            document.getElementById(targetId).innerText = "File baru: " + input.files[0].name;
            document.getElementById(targetId).style.color = '#ef4444';
        }
    }
</script>
