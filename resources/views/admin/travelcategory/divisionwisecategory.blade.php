@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">

@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}


    <!-- Main content -->
    <div class="page-wrapper">
        <div class="container-fluid mt-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="javascript::void(0)">
                        <button class="nav-link" type="button">
                            Travel Allowance based on categories and divisions
                        </button>
                    </a>
                </li>
            </ul>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-toolbar">
                                <a class="btn btn-primary font-weight-bolder" href="{{ route('travelcategories.create') }}">
                                    <i class="fa fa-plus-circle mr-1"></i>
                                    Add New
                                </a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped custom-table datatable ProvinceList">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr No</th>
                                        <th class="text-center">Division Name</th>
                                        <th class="text-center">Category Name</th>
                                        <th class="text-center">Travel Allowance Name</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>


            <!-- Edit Province Modal -->
            <div class="modal fade" id="editProvinceModal" tabindex="-1" aria-labelledby="editProvinceModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProvinceModalLabel">Province</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editProvinceForm">
                                @csrf
                                <input type="hidden" name="id" id="provinceId">
                                <div class="mb-3">
                                    <label for="editCode" class="form-label"><span class="mandatory_input"
                                            style="color:red;">*</span> Code</label>
                                    <input type="text" class="form-control" id="editCode" name="code">
                                    <small class="text-danger code_error"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="editName" class="form-label"><span class="mandatory_input"
                                            style="color:red;">*</span> Name</label>
                                    <input type="text" class="form-control" id="editName" name="name">
                                    <small class="text-danger name_error"></small>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" id="editProvinceBtn" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this Province?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Edit Skill Modal -->
            <div class="modal fade" id="editSkillModal" tabindex="-1" aria-labelledby="editSkillModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSkillModalLabel">Travel Category Allowance Amount</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editSkillForm">
                                @csrf
                                <input type="hidden" name="id" id="divisionId">
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Amount <span
                                            style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="editAmount" name="amount">
                                    <small class="text-danger name_error"></small>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" id="editSkillBtn" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Script Code -->
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>

    <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>

    <!-- button -->
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.ProvinceList').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            searching: true,
            ajax: {
                url: "{{ route('travel.category.data', ['id' => $id]) }}", 
            },
            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'division_name',
                    className: "text-center"
                },
                {
                    data: 'category_name',
                    className: "text-center"
                },
                {
                    data: 'travel_allowance_category',
                    className: "text-center"
                },
                {
                    data: 'amount',
                    className: "text-center"
                },
                {
                    data: 'action',
                    className: "text-center",
                },

            ],
        });



        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: `/travel_allowance_category_amount_edit/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#divisionId').val(data.id);
                    $('#editAmount').val(data.amount);
                    $('#editSkillModal').modal('show');
                }
            });
        });


        $('#editSkillBtn').on('click', function(e) {
            e.preventDefault();
            $('.text-danger').empty();
            var id = $('#divisionId').val();
            var amount = $('#editAmount').val().trim();
            if (amount === '') {
                $('.name_error').text('Amount field cannot be empty.');
                return false; 
            }
            var formData = new FormData($('#editSkillForm')[0]);
            $('.pre-loader').show();
            $.ajax({
                url: `/travel_allowance_category_amount_update/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.pre-loader').hide();
                    if (response.result === 'success') {
                        $('#editSkillModal').modal('hide');
                        table.ajax.reload();
                    } else if (response.result === 'error') {
                        for (let key in response.msg) {
                            if (response.msg.hasOwnProperty(key)) {
                                $(`#${key}`).siblings('.text-danger').html(response.msg[key][0]);
                            }
                        }
                    }
                },
                error: function() {
                    $('.pre-loader').hide();
                }
            });
        });
    </script>
@endsection
