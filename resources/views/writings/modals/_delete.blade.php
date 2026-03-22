<!-- Modal Delete -->
<div id="deleteModal" class="modal">
    <div class="modal-content" style="max-width: 400px; text-align: center; padding: 2rem;">
        <div style="background: #fee2e2; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
            <i data-lucide="alert-triangle" style="width: 32px; height: 32px; color: #ef4444;"></i>
        </div>
        <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Hapus Writing?</h3>
        <p style="color: var(--text-secondary); margin-bottom: 2rem; font-size: 0.875rem; line-height: 1.5;">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
        
        <form action="" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                <button type="button" class="btn" onclick="closeModal('deleteModal')" style="background: #f1f5f9; color: var(--text-main); border: 1px solid var(--border-color);">
                    Batal
                </button>
                <button type="submit" class="btn" style="background: #ef4444; color: white;">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>
