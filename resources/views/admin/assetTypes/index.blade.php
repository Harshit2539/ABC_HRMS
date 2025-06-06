@extends('layouts.master')

@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
    <div class="page-wrapper">
        <div class="container-fluid mt-4 ">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">
                    <h3 id="all" class="main-heading">Asset Types<span>Let's Create Assets ?</span></h3>
                </div>

                <div class="d-flex align-items-center">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addAssetModal">
                        + Add New Asset Type
                    </button>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(function() {
                        let alert = document.getElementById('success-alert');
                        if (alert) {
                            alert.classList.remove('show');
                            alert.classList.add('fade');
                            setTimeout(() => alert.remove(), 500);
                        }
                    }, 2000);
                </script>
            @endif



            <div class="card">
                <div class="card-body">
                    <table class="table table-striped custom-table datatable assettypes">
                        <thead>
                            <tr
                                style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                <th class="text-center">S No.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Asset Type Modal -->
    <div class="modal fade" id="addAssetModal" tabindex="-1" aria-labelledby="addAssetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAssetLabel">Add New Asset Type</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addAssetTypeForm" action="{{ route('assettypes.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="addAssetTypeName" class="form-label">
                                <span class="text-danger">*</span> Name
                            </label>
                            <input type="text" class="form-control" id="addAssetTypeName" name="name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-save me-2"></i> Create
                            </button>
                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Edit Asset Type Modal -->
    <div class="modal fade" id="editAssetTypeModal" tabindex="-1" aria-labelledby="editAssetTypeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editAssetTypeForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Asset Type</h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                            aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editAssetId" name="id">
                        <div class="mb-3">
                            <label for="editAssetTypeName" class="form-label">
                                <span class="text-danger">*</span> Name
                            </label>
                            <input type="text" class="form-control" id="editAssetTypeName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save me-2"></i> Update
                        </button>
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.assettypes').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('assettypes.index') }}",
            },
            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'name',
                    className: "text-center"
                },
                {
                    data: 'action',
                    className: "text-center",
                },
            ],
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editAssetTypeModalEl = document.getElementById('editAssetTypeModal');
            const editAssetTypeName = document.getElementById('editAssetTypeName');
            const editAssetId = document.getElementById('editAssetId');
            const editForm = document.getElementById('editAssetTypeForm');

            $(document).on('click', '.editAssetTypeBtn', function() {
                const assetId = $(this).data('id');
                const assetName = $(this).data('name');

                editAssetTypeName.value = assetName;
                editAssetId.value = assetId;

                // Update form action dynamically
                editForm.action = `/assettypes/${assetId}`;
            });
        });
    </script>
@endsection
