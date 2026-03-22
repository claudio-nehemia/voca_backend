<!-- Modal Show -->
<div id="showModal" class="modal">
    <div class="modal-content" style="max-width: 600px;">
        <div class="modal-header">
            <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin: 0;">Pratinjau Vocabulary</h3>
            <button type="button" class="btn-icon" onclick="closeModal('showModal')">
                <i data-lucide="x" style="width: 20px; height: 20px; color: var(--text-secondary);"></i>
            </button>
        </div>
        <div class="modal-body" style="padding: 2rem;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <span id="show-theme" class="badge badge-theme"></span>
                    <span id="show-point-badge" class="badge" style="background: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd;">
                        <i data-lucide="star" style="width: 12px; height: 12px; display: inline-block; margin-right: 4px; vertical-align: middle;"></i>
                        <span id="show-point"></span> Poin
                    </span>
                </div>
                <h2 id="show-title" style="font-size: 2rem; font-weight: 800; color: var(--text-main); margin: 0.5rem 0;"></h2>
            </div>

            <div style="display: grid; gap: 1.5rem;">
                <div style="background: #f8fafc; border-radius: 1rem; padding: 1.25rem; border: 1px solid var(--border-color);">
                    <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 0.75rem;">Deskripsi</label>
                    <p id="show-description" style="color: var(--text-main); line-height: 1.6; margin: 0;"></p>
                </div>

                <div style="background: #f8fafc; border-radius: 1rem; padding: 1.25rem; border: 1px solid var(--border-color);">
                    <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 0.75rem;">Tujuan Pembelajaran</label>
                    <p id="show-goals" style="color: var(--text-main); line-height: 1.6; margin: 0;"></p>
                </div>

                <div id="show-audio-container" style="background: #eff6ff; border-radius: 1rem; padding: 1.25rem; border: 1.5px solid #dbeafe; display: none;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 0.75rem;">Audio Content</label>
                    <audio id="show-audio-player" controls style="width: 100%; height: 40px;">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                
                <div id="no-audio-msg" style="text-align: center; color: var(--text-secondary); font-style: italic; font-size: 0.875rem;">
                    Tidak ada konten audio untuk vocabulary ini.
                </div>
            </div>
        </div>
        <div class="modal-footer" style="padding: 1.5rem 2rem;">
            <button type="button" class="btn btn-primary" onclick="closeModal('showModal')" style="width: 100%;">Tutup Pratinjau</button>
        </div>
    </div>
</div>
