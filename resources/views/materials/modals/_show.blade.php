<!-- Modal Show -->
<div id="showModal" class="modal">
    <div class="modal-content" style="max-width: 800px; padding: 0; overflow: hidden;">
        <div class="modal-header" style="padding: 1.5rem 2rem; border-bottom: 1px solid var(--border-color); background: #f8fafc;">
            <div>
                <h3 id="show-name" style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin: 0;"></h3>
                <p style="color: var(--text-secondary); margin: 0.25rem 0 0 0; font-size: 0.8125rem;">Pratinjau Materi</p>
            </div>
            <button type="button" class="btn-icon" onclick="closeModal('showModal')">
                <i data-lucide="x" style="width: 20px; height: 20px;"></i>
            </button>
        </div>
        <div class="modal-body" style="padding: 0; height: calc(90vh - 140px); display: flex; flex-direction: column;">
            <div style="padding: 1.5rem 2rem; border-bottom: 1px solid var(--border-color); background: white;">
                <h4 style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">DESKRIPSI MATERI</h4>
                <p id="show-description" style="color: var(--text-main); line-height: 1.6; font-size: 0.9375rem; margin: 0;"></p>
            </div>
            
            <div style="flex: 1; background: #e2e8f0; position: relative;">
                <iframe id="show-pdf-preview" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
        </div>
        <div class="modal-footer" style="padding: 1rem 2rem; background: #f8fafc; display: flex; justify-content: space-between; align-items: center;">
            <a id="show-pdf-link" href="#" target="_blank" class="btn" style="background-color: white; border: 1px solid var(--border-color); color: var(--text-main); font-size: 0.875rem;">
                <i data-lucide="external-link" style="width: 16px; height: 16px;"></i>
                Buka di Tab Baru
            </a>
            <button type="button" class="btn" onclick="closeModal('showModal')" style="background-color: var(--text-main); color: white; border: none; font-size: 0.875rem; padding: 0.625rem 1.5rem;">
                Tutup
            </button>
        </div>
    </div>
</div>
