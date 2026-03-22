<!-- Modal Edit -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <form action="" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Ubah Achievement</h3>
                <button type="button" class="btn-icon" onclick="closeModal('editModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">

                <!-- Icon Picker -->
                <div class="form-group">
                    <label class="form-label">Icon <span style="color: #ef4444;">*</span></label>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div id="edit-icon-preview" style="width: 60px; height: 60px; border-radius: 1rem; background: #f8fafc; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; font-size: 2rem;">🏆</div>
                        <div style="flex: 1;">
                            <input type="text" name="icon" id="edit-icon" class="form-control" maxlength="10" required oninput="document.getElementById('edit-icon-preview').innerText = this.value || '🏆'">
                            <p style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.5rem;">Salin & tempel emoji dari <a href="https://emojipedia.org" target="_blank" style="color: var(--primary);">Emojipedia</a></p>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.5rem;">
                                @foreach(['🏆','🥇','🥈','🥉','🎯','🔥','⭐','💎','🎖️','📚','✍️','🎤','💪','🚀','👑'] as $emoji)
                                    <button type="button" onclick="setEditIcon('{{ $emoji }}')" style="font-size: 1.375rem; cursor: pointer; background: white; border: 1px solid var(--border-color); border-radius: 0.5rem; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: all 0.15s;" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border-color)'">{{ $emoji }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nama -->
                <div class="form-group">
                    <label class="form-label">Nama Achievement <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" id="edit-name" class="form-control" required>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
                </div>

                <!-- Tipe -->
                <div class="form-group">
                    <label class="form-label">Jenis Poin <span style="color: #ef4444;">*</span></label>
                    <select name="type" id="edit-type" class="form-control" required>
                        <option value="total">🏆 Total Score (keseluruhan)</option>
                        <option value="vocabulary">📚 Vocabulary</option>
                        <option value="writing">✍️ Writing</option>
                        <option value="speaking">🎤 Speaking</option>
                    </select>
                </div>

                <!-- Required Points -->
                <div class="form-group">
                    <label class="form-label">Ambang Batas Poin <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="required_points" id="edit-required-points" class="form-control" min="1" required>
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
    function setEditIcon(emoji) {
        document.getElementById('edit-icon').value = emoji;
        document.getElementById('edit-icon-preview').innerText = emoji;
    }
</script>
