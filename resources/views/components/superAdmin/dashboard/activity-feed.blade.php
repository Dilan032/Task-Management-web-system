<!-- Adjusted Messages Section to col-md-8 -->
<div class="col-md-4">
    <!-- Messages Section -->
    <div class="bg-primary-subtle text-primary-emphasis border-bottom border-black border-5 rounded btnShado">

        <div class="d-flex justify-content-between">
            {{-- Today's total recived messages --}}
            <p class="fs-4">All Messages <span
                    class="badge text-bg-light px-4 btnShado">{{ $totalMessages }}</span></p>
        </div>

        {{-- Today Pending, Accepted and Rejected messages --}}
        <div class="d-flex flex-column flex-sm-row gap-3">

            {{-- All Solved, Document Pending, Processing messages --}}
            <div class="p-1 w-100 bg-white text-dark rounded btnShado">
                | Nanosoft Solutions (Pvt)Ltd Status
                <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                    ✔Solved
                    <span class="badge text-bg-success px-5">{{ $SolvedMsg }}</span>
                </div>
                <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                    📜Document Pending
                    <span class="badge text-bg-warning px-5">{{ $DocPendingMsg }}</span>
                </div>
                <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                    ⚙ Processing
                    <span class="badge text-bg-info px-5">{{ $ProcessingMsg }}</span>
                </div>
            </div>
        </div>

    </div>
</div>
