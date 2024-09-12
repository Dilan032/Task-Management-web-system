<div class="container-fluid">
    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr style="text-align:center">
                        <th>Institute Name</th>
                        <th>Institute Type</th>
                        <th>Institute Address</th>
                        <th>Institute Contact</th>
                        <th style="width: 20%;">Email</th>
                        <th>Assigned Employee</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody style="text-align:center">
                    @foreach ($institute as $item)
                        <tr>
                            <td>{{ $item->institute_name }}</td>
                            <td>{{ $item->institute_type }}</td>
                            <td>{{ $item->institute_address }}</td>
                            <td>{{ $item->institute_contact_num }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->assigned_employee }}</td>
                            <td>
                                <!-- View Modal Trigger -->
                                {{-- <a href="#" class="view" title="View" data-toggle="modal"
                                    data-institute_name="{{ $item->institute_name }}"
                                    data-institute_type="{{ $item->institute_type }}"
                                    data-institute_address="{{ $item->institute_address }}"
                                    data-institute_contact_num="{{ $item->institute_contact_num }}"
                                    data-email="{{ $item->email }}"
                                    data-assigned_employee="{{ $item->assigned_employee }}">
                                    <i class="material-icons">&#xE417;</i>
                                </a> --}}
                                <!-- Edit Modal Trigger -->
                                <a href="#" class="edit" title="Edit" data-toggle="modal"
                                    data-user_id="{{ $item->id }}" data-role="{{ $item->id }}">
                                    <i class="material-icons" style="color: orange; margin-left:5px">&#xE254;</i>
                                </a>

                                <!-- Delete Modal Trigger -->
                                {{-- <a href="#" class="delete" title="Delete" data-toggle="modal"
                                    data-id="{{ $item->id }}">
                                    <i class="material-icons" style="color: red; margin-left:5px">&#xE872;</i>
                                </a> --}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination section --}}
            <div style="margin-top:30px">
                {{ $institute->links() }}
            </div>
        </div>
    </div>
</div>
