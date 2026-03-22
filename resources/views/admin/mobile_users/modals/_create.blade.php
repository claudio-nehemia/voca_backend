<!-- Modal Create -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <form action="{{ route('mobile-users.store') }}" method="POST" id="createForm">
            @csrf
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Tambah Mobile User</h3>
                <button type="button" class="btn-icon" onclick="closeModal('createModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Budi Santoso" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email <span style="color: #ef4444;">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="user@example.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="class" class="form-control" placeholder="Contoh: 12 IPA 1">
                </div>

                <div class="form-group">
                    <label class="form-label">Password <span style="color: #ef4444;">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 0.75rem; margin-top: 1.5rem; background: #f8fafc; padding: 1rem; border-radius: 0.75rem;">
                    <input type="checkbox" name="is_active" id="create-is-active" value="1" checked style="width: 1.25rem; height: 1.25rem; cursor: pointer;">
                    <label for="create-is-active" style="font-size: 0.875rem; font-weight: 600; color: var(--text-main); cursor: pointer; margin: 0;">Akun Aktif</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal('createModal')" style="background-color: white; border: 1px solid var(--border-color); color: var(--text-secondary);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>
