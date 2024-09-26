<!-- Adjusted Messages Section to col-md-8 -->
<div>
    <!-- Messages Section -->
    <div class="bg-primary-subtle text-primary-emphasis border-bottom border-black border-5 rounded btnShado">

        <div class="d-flex justify-content-between">
            {{-- Today's total received messages --}}
            <p class="fs-4 ms-3 mt-2">Inform System Update, News Section</p>
        </div>

        {{-- Today Pending, Accepted and Rejected messages --}}
        <div class="d-flex flex-column flex-sm-row gap-3">

            {{-- All Solved, Document Pending, Processing messages --}}
            <div class="p-1 w-100 bg-white text-dark rounded btnShado">
                <div class="form-check form-switch ms-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault1">
                    <label class="form-check-label" for="flexSwitchCheckDefault1">All Subscribed Users</label>
                </div>

                <div class="form-check form-switch ms-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                    <label class="form-check-label" for="flexSwitchCheckDefault2">All Registered Users</label>
                </div>

                <div class="input-group">
                    <span class="input-group-text">Message area</span>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
            </div>
        </div>

        <!-- Right-aligned Send button -->
        <div class="text-end">
            <button type="button" class="btn btn-info">Send</button>
        </div>

    </div>
</div>