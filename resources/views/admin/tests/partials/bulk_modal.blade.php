<!-- Bulk Import Modal -->
<div class="modal fade" id="bulkImportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold m-0"><i class="bi bi-magic text-primary-blue me-2"></i>Smart Bulk Question Importer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info border-0 rounded-4 mb-4 small bg-primary-blue bg-opacity-10 text-primary-blue">
                    <h6 class="fw-bold mb-2">Auto-Detects Multiple Formats Seamlessly</h6>
                    <p class="mb-2 extra-small text-dark">Paste questions directly from Word, PDFs, ChatGPT, Excel, or old exam papers. Our smart engine will automatically parse the structure.</p>
                    <div class="row g-2 extra-small text-dark mt-1">
                        <div class="col-md-6">
                            <div class="p-2 bg-white rounded-3 border shadow-sm">
                                <strong class="text-primary-blue"><i class="bi bi-file-text me-1"></i>Format 1: Multi-line (Word / ChatGPT)</strong><br>
                                1. What is the capital of Nepal?<br>
                                A. Pokhara<br>
                                B. Kathmandu<br>
                                C. Lalitpur<br>
                                D. Bhaktapur<br>
                                Answer: B
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-2 bg-white rounded-3 border shadow-sm">
                                <strong class="text-primary-blue"><i class="bi bi-table me-1"></i>Format 2: Tabular (Excel / Pipes / Tabs)</strong><br>
                                Question | Option A | Option B | Option C | Option D | Correct (A,B,C,D)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea id="bulkDataInput" class="form-control rounded-4 border-0 bg-light p-3 font-monospace shadow-sm" rows="10" placeholder="Paste your questions here in any supported format..."></textarea>
                </div>
                <div id="importPreview" class="d-none">
                    <h6 class="fw-bold mb-3 d-flex justify-content-between">
                        <span>Parsed Results (<span id="parsedCount">0</span>)</span>
                        <span class="text-success small"><i class="bi bi-check-circle-fill"></i> Ready to import</span>
                    </h6>
                    <div class="preview-container overflow-auto border rounded-4 bg-light p-3" style="max-height: 250px;">
                        <div id="previewList" class="small"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary-blue rounded-pill px-5 fw-bold shadow-sm d-none" id="confirmImportBtn">
                    <i class="bi bi-check2-circle me-2"></i>Confirm & Add to List
                </button>
                <button type="button" class="btn btn-primary-blue rounded-pill px-5 fw-bold shadow-sm" id="processBulkBtn">
                    <i class="bi bi-magic me-2"></i>Analyze & Parse
                </button>
            </div>
        </div>
    </div>
</div>