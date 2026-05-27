<!-- Service Selector Modal -->
<div class="modal fade" id="serviceSelectorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold m-0" id="selectorTitle">Select Service Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                {{-- Step 1: Main Categories --}}
                <div id="categoryStep" class="row g-4">
                    @foreach($mainCategories as $cat)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100 cursor-pointer hover-shadow category-btn bg-white" 
                             onclick="showSubCategories('{{ $cat['id'] }}', '{{ $cat['name'] }} ({{ $cat['name_nep'] }})')">
                            <div class="bg-primary-blue bg-opacity-10 text-primary-blue d-inline-flex p-3 rounded-circle mb-3 mx-auto">
                                <i class="bi {{ $cat['icon'] }} fs-3"></i>
                            </div>
                            <h6 class="fw-bold mb-1 text-dark">{{ $cat['name'] }}</h6>
                            <div class="extra-small text-accent-orange fw-bold">{{ $cat['name_nep'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Step 2: Specific Exams (Sub-categories) --}}
                <div id="examStep" class="d-none">
                    <button class="btn btn-sm btn-light rounded-pill mb-4 px-3 fw-bold" onclick="backToCategories()">
                        <i class="bi bi-arrow-left me-2"></i>Back to Categories
                    </button>
                    <div class="row g-3" id="examList">
                        {{-- Populated via JS --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>