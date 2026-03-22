<!-- Modal Edit -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <form action="" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Ubah Admin</h3>
                <button type="button" class="btn-icon" onclick="closeModal('editModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nama -->
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" id="edit-name" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">Email <span style="color: #ef4444;">*</span></label>
                    <input type="email" name="email" id="edit-email" class="form-control" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label">Password (Opsional)</label>
                    <input type="password" name="password" id="edit-password" class="form-control" placeholder="••••••••">
                    <p style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.5rem;">Biarkan kosong jika tidak ingin mengubah password.</p>
                </div>

                <!-- Active Toggle -->
                <div class="form-group" style="display: flex; align-items: center; gap: 0.75rem; margin-top: 1.5rem; background: #f8fafc; padding: 1rem; border-radius: 0.75rem;">
                    <input type="checkbox" name="is_active" id="edit-is-active" value="1" style="width: 1.25rem; height: 1.25rem; cursor: pointer;">
                    <label for="edit-is-active" style="font-size: 0.875rem; font-weight: 600; color: var(--text-main); cursor: pointer; margin: 0;">Akun Aktif</label>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-secondary); margin-left: auto;">Jika dinonaktifkan, admin tidak dapat login.</p>
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
