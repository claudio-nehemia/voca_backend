<!-- Modal Delete -->
<div id="deleteModal" class="modal">
    <div class="modal-content" style="max-width: 400px; text-align: center; padding: 2rem;">
        <div style="font-size: 4rem; margin-bottom: 1.5rem;">🗑️</div>
        <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.75rem;">Hapus Achievement?</h3>
        <p style="color: var(--text-secondary); margin-bottom: 2rem; line-height: 1.5;">Achievement ini akan dihapus secara permanen dan tidak dapat dipulihkan.</p>
        
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <button type="button" class="btn" onclick="closeModal('deleteModal')" style="background-color: #f1f5f9; color: var(--text-main); border: 1px solid var(--border-color);">
                    Batal
                </button>
                <button type="submit" class="btn" style="background-color: #ef4444; color: white; border: none; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2);">
                    Hapus Permanen
                </button>
            </div>
        </form>
    </div>
</div>
