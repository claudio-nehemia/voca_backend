<!-- Modal Create -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <form action="{{ route('achievements.store') }}" method="POST" id="createForm">
            @csrf
            <div class="modal-header">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Tambah Achievement Baru</h3>
                <button type="button" class="btn-icon" onclick="closeModal('createModal')">
                    <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
                </button>
            </div>
            <div class="modal-body">

                <!-- Icon Picker -->
                <div class="form-group">
                    <label class="form-label">Icon <span style="color: #ef4444;">*</span></label>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div id="create-icon-preview" style="width: 60px; height: 60px; border-radius: 1rem; background: #f8fafc; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; font-size: 2rem;">🏆</div>
                        <div style="flex: 1;">
                            <input type="text" name="icon" id="create-icon-input" class="form-control" value="🏆" placeholder="Paste emoji di sini…" maxlength="10" required oninput="document.getElementById('create-icon-preview').innerText = this.value || '🏆'">
                            <p style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.5rem;">Salin & tempel emoji dari <a href="https://emojipedia.org" target="_blank" style="color: var(--primary);">Emojipedia</a>. Contoh: 🥇 🎯 🔥 ⭐ 💎</p>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.5rem;">
                                @foreach(['🏆','🥇','🥈','🥉','🎯','🔥','⭐','💎','🎖️','📚','✍️','🎤','💪','🚀','👑'] as $emoji)
                                    <button type="button" onclick="setCreateIcon('{{ $emoji }}')" style="font-size: 1.375rem; cursor: pointer; background: white; border: 1px solid var(--border-color); border-radius: 0.5rem; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: all 0.15s;" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border-color)'">{{ $emoji }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nama -->
                <div class="form-group">
                    <label class="form-label">Nama Achievement <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Speaking Star" required>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Capai 100 poin speaking untuk mendapat achievement ini."></textarea>
                </div>

                <!-- Tipe -->
                <div class="form-group">
                    <label class="form-label">Jenis Poin <span style="color: #ef4444;">*</span></label>
                    <select name="type" class="form-control" required>
                        <option value="total">🏆 Total Score (keseluruhan)</option>
                        <option value="vocabulary">📚 Vocabulary</option>
                        <option value="writing">✍️ Writing</option>
                        <option value="speaking">🎤 Speaking</option>
                    </select>
                </div>

                <!-- Required Points -->
                <div class="form-group">
                    <label class="form-label">Ambang Batas Poin <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="required_points" class="form-control" placeholder="Contoh: 100" min="1" required>
                    <p style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 0.5rem;">Achievement akan terbuka setelah pengguna mencapai jumlah poin ini pada jenis yang dipilih.</p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal('createModal')" style="background-color: white; border: 1px solid var(--border-color); color: var(--text-secondary);">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan Achievement
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function setCreateIcon(emoji) {
        document.getElementById('create-icon-input').value = emoji;
        document.getElementById('create-icon-preview').innerText = emoji;
    }
</script>
