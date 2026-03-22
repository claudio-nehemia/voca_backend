<!-- Modal Create -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <form action="{{ route('materials.store') }}" method="POST" id="createForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Tambah Materi Baru</h3>
                <button type="button" class="btn-icon" onclick="closeModal('createModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nama Materi -->
                <div class="form-group">
                    <label class="form-label">Nama Materi <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: English Grammar Basic" required>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label class="form-label">Deskripsi <span style="color: #ef4444;">*</span></label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan isi materi ini..." required></textarea>
                </div>

                <!-- File PDF -->
                <div class="form-group">
                    <label class="form-label">File PDF <span style="color: #ef4444;">*</span></label>
                    <div style="background: #f8fafc; border: 1px dashed var(--border-color); padding: 1.5rem; border-radius: 1rem; text-align: center;">
                        <input type="file" name="file_path" accept=".pdf" required style="display: none;" id="create-pdf-input" onchange="updateFileName(this, 'create-file-name')">
                        <label for="create-pdf-input" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 0.75rem;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: white; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; color: #ef4444; box-shadow: var(--card-shadow);">
                                <i data-lucide="upload-cloud"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main);" id="create-file-name">Klik untuk upload atau drag PDF</div>
                                <div style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.25rem;">Max 10MB (Format .pdf)</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal('createModal')" style="background-color: white; border: 1px solid var(--border-color); color: var(--text-secondary);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan Materi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input, targetId) {
        if (input.files && input.files[0]) {
            document.getElementById(targetId).innerText = input.files[0].name;
            document.getElementById(targetId).style.color = 'var(--primary)';
        }
    }
</script>
