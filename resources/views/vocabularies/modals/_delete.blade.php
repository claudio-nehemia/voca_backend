<!-- Modal Delete Confirmation -->
<div id="deleteModal" class="modal">
    <div class="modal-content" style="width: 400px; text-align: center; border-radius: 1.25rem;">
        <div class="modal-body" style="padding: 2.5rem 2rem;">
            <div style="width: 64px; height: 64px; background-color: #fef2f2; color: #ef4444; border-radius: 9999px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                <i data-lucide="alert-triangle" style="width: 32px; height: 32px;"></i>
            </div>
            
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0 0 0.5rem 0;">Hapus Vocabulary?</h3>
            <p style="color: #6b7280; font-size: 0.875rem; line-height: 1.5; margin-bottom: 2rem;">
                Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div style="display: flex; gap: 0.75rem;">
                    <button type="button" class="btn" onclick="closeModal('deleteModal')" style="flex: 1; background-color: #f3f4f6; color: #374151; font-weight: 600;">
                        Tidak, Batal
                    </button>
                    <button type="submit" class="btn" style="flex: 1; background-color: #ef4444; color: white; font-weight: 600;">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
