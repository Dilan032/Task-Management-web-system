@if (!empty($oneMessage->support_description) || !empty($oneMessage->support_img_1) || !empty($oneMessage->support_img_2) || !empty($oneMessage->support_img_3) || !empty($oneMessage->support_img_4) || !empty($oneMessage->support_img_5))
<div class="container">

    <table>
        <tr>
            <td colspan="4" style="white-space: normal; word-wrap: break-word;">
                <span class="fs-6">Support Message: </span><br>
                <div class="fw-light rounded messageBG" style="text-align: justify; margin-top: 10px;">
                    {{ $oneMessage->support_description }}
                </div>
            </td>
        </tr>
    </table>

    <!-- Thumbnail Images -->
    <div class="container mt-3 mb-5">
        <p class="fs-6">Supported Images :</p>
        <div class="p-3 mb-2 bg-primary-subtle text-black problemImageMainBG rounded">
            <div class="row d-flex justify-content-center">
                <div class="col-md-2 py-2">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_1) }}" alt="empty"
                    class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModalSupport1">
                </div>
                <div class="col-md-2 py-2">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_2) }}" alt="empty"
                    class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModalSupport2">
                </div>
                <div class="col-md-2 py-2">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_3) }}" alt="empty"
                    class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModalSupport3">
                </div>
                <div class="col-md-2 py-2">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_4) }}" alt="empty"
                    class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModalSupport4">
                </div>
                <div class="col-md-2 py-2">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_5) }}" alt="empty"
                    class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModalSupport5">
                </div>
            </div>
        </div>
    </div>


    <!-- Modals -->
    <div class="modal fade" id="imageModalSupport1" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_1) }}" alt="empty"
                        class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModalSupport2" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_2) }}" alt="empty"
                        class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModalSupport3" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_3) }}" alt="empty"
                        class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModalSupport4" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_4) }}" alt="empty"
                        class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModalSupport5" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_5) }}" alt="empty"
                        class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>




{{-- <div class="col-md-2 py-2">
    <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_1) }}" alt="empty"
    class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModalSupport1">
</div> --}}

<!-- Modal for Image 1 -->
{{-- <div class="modal fade" id="imageModalSupport1" tabindex="-1" aria-labelledby="imageModalSupport1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->support_img_1) }}" alt="empty" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}

@else
    
@endif



