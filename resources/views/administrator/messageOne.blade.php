@extends('layouts.administratorLayout')
@section('administratorContent')

    <!-- Display validation errors -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "{{ $error }}",
                });
            </script>
        @endforeach
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    <section class="container">
        <div class="table-responsive">
            <a href="{{ route('administrator.messages') }}" class="btn btn-primary mb-1" type="button">Back</a>
            <table class="table table-borderless rounded messageBG">
                <thead>
                    <tr>
                        <td>
                            <div style="font-size: 17px;">
                                <b>{{ $messagesTableDataUser->user->name }}</b>'s submited issue :
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                <span class="badge bg-secondary-subtle text-dark px-4 py-2 fw-light">
                                    📅 {{ \Carbon\Carbon::parse($oneMessage->created_at)->format('d M Y ') }} &nbsp;&nbsp;
                                    ⏱ {{ \Carbon\Carbon::parse($oneMessage->created_at)->format('h:i A') }}
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top:15px">
                                <div style="font-size: 30px;">
                                    {{ $oneMessage->subject }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end gap-2" style="margin-top:15px">
                                @if ($oneMessage->request == 'pending')
                                    <div class="d-flex gap-2 d-flex justify-content-end">
                                        {{-- Accept button --}}
                                        <form action="{{ route('administrator.conform.message', $oneMessage->id) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="request" value="accept">
                                            <button class="btn btn-success me-4 me-md-2" type="submit"
                                                onclick="return confirm('Do you want to forward this user\'s message to Nanosoft Solutions Company?');">
                                                Accept Message
                                            </button>
                                        </form>

                                        {{-- Reject button --}}
                                        <form action="{{ route('administrator.reject.message', $oneMessage->id) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="request" value="reject">
                                            <button class="btn btn-danger me-4" type="submit"
                                                onclick="return confirm('Do you want to ignore this user\'s message?');">
                                                Reject Message
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Message accepted --}}
                                @elseif ($oneMessage->request == 'accept')
                                    <div class="d-flex gap-2 justify-content-md-end">
                                        <button class="btn btn-success" disabled>Accepted</button>
                                    </div>

                                    {{-- Message rejected --}}
                                @elseif ($oneMessage->request == 'reject')
                                    <div class="d-flex gap-2 justify-content-md-end">
                                        <button class="btn btn-danger" disabled>Rejected</button>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <th colspan="4" class="bg-primary-subtle fw-light">
                            {{-- Task status mode showing part --}}
                            @if ($oneMessage->request == 'accept')
                                @php
                                    $statusClasses = [
                                        'Completed' => 'text-bg-success',
                                        'Complete in next day' => 'text-bg-warning',
                                        'Document Pending' => 'text-bg-info',
                                        'In Progress' => 'text-bg-info',
                                        'In Queue' => 'text-bg-info',
                                        'Move to next day' => 'text-bg-danger',
                                        'Postponed' => 'text-bg-danger',
                                        'default' => 'text-bg-info text-dark',
                                    ];
                                    $badgeClass = $statusClasses[$oneMessage->status] ?? $statusClasses['default'];
                                    $padding = in_array($oneMessage->status, ['In Progress', 'In Queue', 'Postponed'])
                                        ? 'px-5'
                                        : 'px-4';
                                @endphp
                                Status: <span
                                    class="badge {{ $badgeClass }} btnInset py-2 {{ $padding }}">{{ $oneMessage->status }}</span>
                            @endif

                            {{-- Task request mode showing part --}}
                            @php
                                $requestClasses = [
                                    'pending' => 'text-bg-warning',
                                    'accept' => 'text-bg-success',
                                    'reject' => 'text-bg-danger',
                                ];
                            @endphp
                            request <span
                                class="badge {{ $requestClasses[$oneMessage->request] ?? 'text-bg-info' }} btnInset py-2">{{ $oneMessage->request }}</span>
                        </th>
                    </tr>
                </tbody>
                <tr>
                    <td colspan="4"><span class="fs-6">message:</span> <br>
                        <span class="fw-light">{{ $oneMessage->message }}</span>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="text-end me-2 fw-light"></div>
        </div>

        <!-- Thumbnail Images -->
        <div class="container mt-4 mb-5">
            <p class="fw-bold">Pictures of the problem areas :</p>
            <div class="p-1 mb-2 bg-primary-subtle text-dark problemImageMainBG rounded">
                <div class="row d-flex justify-content-center mx-auto">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-md-2 p-2">
                            <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->{'img_' . $i}) }}"
                                alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal"
                                data-target="#imageModal{{ $i }}">
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Modals -->
        @for ($i = 1; $i <= 5; $i++)
            <div class="modal fade" id="imageModal{{ $i }}" tabindex="-1"
                aria-labelledby="imageModalLabel{{ $i }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->{'img_' . $i}) }}"
                                alt="Full Image {{ $i }}" class="img-fluid">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </section>
@endsection
