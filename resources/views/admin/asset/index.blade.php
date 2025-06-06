@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">
                    <h3 id="all" class="main-heading">Assets<span>Ready to lent Assets ?</span></h3>
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
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'Working' ? 'active' : '' }}"
                                href="?status=Working">Working</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'Not Working' ? 'active' : '' }}"
                                href="?status=Not Working">Not Working</a>
                        </li>
                    </ul>


                    <div class="row mt-3">
                        <div class="col-md-3">
                            <select id="filterLocation" class="form-control">
                                <option value="">Select Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="filterUser" class="form-control">
                                <option value="">Select Users...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="searchBy" class="form-control" placeholder="Search By Asset Names..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                    <th>Asset Name</th>
                                    <th>Asset Type</th>
                                    <th>Image</th>
                                    <th>Lent To</th>
                                    <th>Location</th>
                                    <th>Serial Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($assets->isEmpty())
                                    <tr>
                                        <td colspan="11" class="text-center">No assets found.</td>
                                    </tr>
                                @else
                                    @foreach ($assets as $asset)
                                        <tr>
                                            {{-- <td><input type="checkbox" class="checkbox-item" value="{{ $asset->id }}">
                                            </td> --}}
                                            <td><a href="#" class="text-primary">{{ $asset->name }}</a></td>
                                            <td>{{ $asset->assetType->name ?? 'N/A' }}</td>
                                            <td>
                                                @if ($asset->image)
                                                    <a href="{{ asset('storage/assets/' . $asset->image) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/assets/' . $asset->image) }}"
                                                            width="40">
                                                    </a>
                                                @else
                                                    <img src="{{ asset('images/placeholder.png') }}" width="40">
                                                @endif
                                            </td>

                                            <td>{{ $asset->lent_status == 'lent' ? 'Not Assigned' : $asset->lentTo->user->name }}
                                            </td>
                                            <td>{{ $asset->location->name ?? 'Unknown' }}</td>
                                            <td>{{ $asset->serial_number ?? 'N/A' }}</td>
                                            <td>
                                                <span
                                                    class="p-3 badge bg-inverse-{{ $asset->status == 'Working' ? 'success' : 'danger' }}">
                                                    {{ $asset->status ?? 'Unknown' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-secondary btn-sm view-asset"
                                                    data-id="{{ $asset->id }}"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('asset.edit', $asset->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>


                                                <form action="{{ route('asset.destroy', $asset->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Are you sure you want to delete this asset?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                                @if ($asset->lent_status == 'returned')
                                                    <button class="btn btn-danger returnBtn" data-id="{{ $asset->id }}"
                                                        data-user="{{ $asset->lentTo->user->name }}"
                                                        data-user-id="{{ $asset->lentTo->user->id }}"
                                                        data-lend-date="{{ $asset->lentTo->lend_date }}"> Return </button>
                                                @else
                                                    <button class="btn btn-success lentToBtn"
                                                        data-id="{{ $asset->id }}">Lent To</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- asset details view model blade --}}
                <div id="assetDetailModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">View Asset Details</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img id="assetImage" src="" alt="No Image" class="img-fluid">
                                    </div>
                                    <div class="col-md-9">
                                        <p><strong>Asset Name:</strong> <span id="assetName"></span></p>
                                        <p><strong>Asset Type:</strong> <span id="assetType"></span></p>
                                        <p><strong>Serial Number:</strong> <span id="serialNumber"></span></p>
                                        <p><strong>Location:</strong> <span id="location"></span></p>
                                        <p><strong>Status:</strong> <span id="status" class="badge"></span></p>
                                        <p><strong>Description:</strong> <span id="description"></span></p>
                                        <p><strong>Broken By:</strong> <span id="brokenBy">-</span></p>
                                    </div>
                                </div>
                                {{-- Asset Returns Table --}}
                                <hr>
                                <div class="mt-4">
                                    <h5>Asset Return History</h5>
                                    <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Lent to</th>
                                                    <th>Lend BY</th>
                                                    <th>Lend Date</th>
                                                    <th>Return Date</th>
                                                    <th>Return To</th>
                                                    <th>Actual Return Date</th>
                                                    <th>Notes</th>
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody id="assetReturnsTableBody">

                                            </tbody>

                                        </table>
                                        <div id="paginationLinks" class="mt-2 text-center"></div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Return Asset Modal -->
                <div class="modal fade" id="returnAssetModal" tabindex="-1" aria-labelledby="returnAssetModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="returnAssetModalLabel">Return</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <form id="returnAssetForm" method="POST" action="{{ route('asset.return') }}">
                                @csrf
                                <input type="hidden" name="asset_id" id="returnAssetId">
                                <input type="hidden" name="user_id" id="returnUserId">
                                <input type="hidden" name="return_date" id="returnDate"
                                    value="{{ now()->toDateString() }}">

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold">User</label> <span style="color: red"> *</span>
                                        <input type="text" class="form-control" id="returnUserName" disabled>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Lent Date</label>
                                            <input type="text" class="form-control" id="lendDate" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Return Date</label>
                                            <input type="text" class="form-control" id="returnDate" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Actual Return Date</label>
                                        <input type="date" class="form-control" name="actual_return_date"
                                            value="{{ now()->toDateString() }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block mb-2">Is Broken?</label>
                                        <div class="form-check form-check-inline">

                                            <input class="form-check-input" type="radio" name="is_broken"
                                                id="brokenYes" value="1">
                                            <label class="form-check-label" for="brokenYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_broken"
                                                id="brokenNo" value="0" checked>
                                            <label class="form-check-label" for="brokenNo">No</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" name="notes" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light border"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- Edit Asset Modal -->
                <div class="modal fade" id="editAssetModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Asset</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="editAssetForm">
                                    @csrf
                                    <input type="hidden" id="asset_id">

                                    <!-- Image Upload -->
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control" id="asset_image">
                                        <img id="preview_image" src="" width="100" class="mt-2">
                                    </div>

                                    <!-- Asset Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Asset Name</label>
                                        <input type="text" class="form-control" id="asset_name" required>
                                    </div>

                                    <!-- Asset Type -->
                                    <div class="mb-3">
                                        <label class="form-label">Asset Type</label>
                                        <select class="form-control" id="asset_type">
                                            <option value="">Select Type</option>
                                            @foreach ($assetTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-3">
                                        <label class="form-label">Location</label>
                                        <select class="form-control" id="asset_location">
                                            <option value="">Select Location</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Serial Number -->
                                    <div class="mb-3">
                                        <label class="form-label">Serial Number</label>
                                        <input type="text" class="form-control" id="serial_number">
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" id="asset_description"></textarea>
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" id="asset_status">
                                            <option value="Working">Working</option>
                                            <option value="Not Working">Not Working</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-danger">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- lent assets model blade --}}
                <div class="modal fade" id="lentToModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Lent To</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="lentAssetForm">
                                    @csrf
                                    <input type="hidden" name="asset_id" id="asset_id" class="asset_id">

                                    <div class="form-group">
                                        <label for="user_id">User</label><span style="color: red"> *</span>
                                        <select id="user_id" name="user_id" class="form-control" required></select>
                                    </div>

                                    <div class="form-group">
                                        <label for="lend_date">Lend Date</label><span style="color: red"> *</span>
                                        <input type="date" id="lend_date" name="lend_date" class="form-control"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="return_date">Return Date</label>
                                        <input type="date" id="return_date" name="return_date" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea id="notes" name="notes" class="form-control"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-danger">Create</button>
                                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal"
                                        mode>Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Asset Modal -->
                <div class="modal fade" id="addAssetModal" tabindex="-1" aria-labelledby="addAssetLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAssetLabel">Add New Asset</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#assetDetails">Asset
                                            Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#transactionDetails">Transaction
                                            Details</a>
                                    </li>
                                </ul>

                                <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content mt-3">
                                        <!-- Asset Details Tab -->
                                        <div class="tab-pane fade show active" id="assetDetails">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Image</label>
                                                    <div class="upload-box">
                                                        <input type="file" name="image" class="d-none"
                                                            id="uploadImage">
                                                        <label for="uploadImage" class="btn btn-danger w-100">+
                                                            Upload</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="mb-3">
                                                        <label class="form-label">* Asset Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Please Enter Asset Name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">* Asset Type</label>
                                                        <div class="d-flex">
                                                            <select name="asset_type_id" class="form-control" required>
                                                                <option value="">Select Asset Type...</option>
                                                                @foreach ($asset_types as $type)
                                                                    <option value="{{ $type->id }}">
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <button type="button" class="btn btn-outline-secondary ms-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#addAssetTypeModal">+</button>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">* Location</label>
                                                        <div class="d-flex">
                                                            <select name="location_id" class="form-control">
                                                                <option value="">Select Location</option>
                                                                @foreach (App\Models\Location::all() as $location)
                                                                    <option value="{{ $location->id }}">
                                                                        {{ $location->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <button type="button" class="btn btn-outline-secondary ms-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#addLocationModal">+</button>

                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Serial Number</label>
                                                        <input type="text" name="serial_number" class="form-control"
                                                            placeholder="Please Enter Serial Number">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" placeholder="Please Enter Description"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <div class="d-flex">
                                                            <input type="radio" class="btn-check" name="status"
                                                                value="Working" id="working" checked>
                                                            <label class="btn btn-outline-primary me-2"
                                                                for="working">Working</label>
                                                            <input type="radio" class="btn-check" name="status"
                                                                value="Not Working" id="notWorking">
                                                            <label class="btn btn-outline-secondary" for="notWorking">Not
                                                                Working</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Transaction Details Tab -->
                                        <div class="tab-pane fade" id="transactionDetails">
                                            <p>Transaction details content Not Found...</p>
                                        </div>
                                    </div>
                                    {{-- <div class="d-flex justify-content-start mt-3"> --}}
                                    <button type="submit" class="btn btn-danger">Create</button>
                                    <button type="button" class="btn btn-light border ms-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    {{-- </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Add Asset Type Modal -->
                <div class="modal fade" id="addAssetTypeModal" tabindex="-1" aria-labelledby="addAssetTypeLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAssetTypeLabel">Add New Asset Type</h5>
                                <button type="button" class="btn nbtn-close" data-bs-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="addAssetTypeForm" action="{{ route('assettypes.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="addAssetTypeName" class="form-label">
                                            <span class="text-danger">*</span> Name
                                        </label>
                                        <input type="text" class="form-control" id="addAssetTypeName" name="name"
                                            required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-save me-2"></i> Create
                                        </button>
                                        <button type="button" class="btn btn-light border"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Location Modal -->
                <div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addLocationLabel">Add New Location</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="addLocationForm" action="{{ route('locations.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="locationName" class="form-label"><span class="text-danger">*</span>
                                            Name</label>
                                        <input type="text" class="form-control" id="locationName" name="name"
                                            required placeholder="Please Enter Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="locationAddress" class="form-label">Address</label>
                                        <textarea class="form-control" id="locationAddress" name="address" placeholder="Please Enter Address"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-save me-2"></i>
                                            Create</button>
                                        <button type="button" class="btn btn-light border"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bulk Delete Form -->
                <form id="bulkDeleteForm" action="{{ route('asset.bulkDelete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ids" id="bulkDeleteIds">
                </form>
                <script>
                    $(document).ready(function() {
                        // When the "Return" button is clicked
                        $(document).on('click', '.returnBtn', function() {
                            // Get the asset data from the button's data attributes
                            var assetId = $(this).data('id');
                            var userName = $(this).data('user');
                            var lendDate = $(this).data('lend-date');
                            var returnDate = $(this).data('return-date');

                            // Populate the modal with the asset data
                            $('#returnAssetId').val(assetId);
                            $('#returnUserId').val($(this).data('user-id'));
                            $('#returnUserName').val(userName);
                            $('#lendDate').val(lendDate);
                            $('#returnDate').val(returnDate);

                            // Show the modal
                            $('#returnAssetModal').modal('show');
                        });
                        $(document).on('submit', '#returnAssetForm', function(e) {

                            e.preventDefault();

                            let formData = $(this).serialize();
                            //   let formData = new FormData(); // lowercase variable name to avoid conflict


                            $.ajax({
                                url: $(this).attr('action'),
                                type: 'POST',
                                data: formData,
                                success: function(response) {

                                    if (response.status) {

                                        let assetId = $('#returnAssetId').val();

                                        // Update button dynamically
                                        let btn = $('.returnBtn[data-id="' + assetId + '"]');
                                        btn.removeClass('btn-danger returnBtn').addClass(
                                            'btn-primary lentToBtn').text(
                                            'Lent To');

                                        // Reset the "Lent To" column
                                        let row = btn.closest('tr');
                                        row.find('td:nth-child(5)').text('Not Assigned');

                                        $('#returnAssetModal').modal('hide');
                                        window.setTimeout(function() {
                                            location.reload()
                                        }, 700);
                                    }
                                }
                            });
                        });
                    });




                    // fkjf
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectAll = document.getElementById('selectAll');
                        const checkboxes = document.querySelectorAll('.checkbox-item');
                        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
                        const bulkDeleteForm = document.getElementById('bulkDeleteForm');
                        const bulkDeleteIds = document.getElementById('bulkDeleteIds');

                        // Select All Checkbox
                        selectAll.addEventListener('change', function() {
                            checkboxes.forEach(checkbox => {
                                checkbox.checked = selectAll.checked;
                            });
                            toggleDeleteButton();
                        });

                        // Individual Checkboxes
                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function() {
                                toggleDeleteButton();
                            });
                        });

                        function toggleDeleteButton() {
                            const selected = [...checkboxes].filter(checkbox => checkbox.checked);
                            bulkDeleteBtn.classList.toggle('hidden', selected.length === 0);
                        }

                        // Bulk Delete Action
                        bulkDeleteBtn.addEventListener('click', function() {
                            let selectedIds = [...checkboxes]
                                .filter(checkbox => checkbox.checked)
                                .map(checkbox => checkbox.value);

                            if (selectedIds.length > 0) {
                                if (confirm('Are you sure you want to delete the selected Asset ?')) {
                                    bulkDeleteIds.value = selectedIds.join(',');
                                    bulkDeleteForm.submit();
                                }
                            }
                        });
                    });
                </script>
                <script>
                    // assets details view
                    $(document).ready(function() {
                        // Load Asset Details
                        $(".view-asset").click(function() {
                            let assetId = $(this).data("id");

                            $.ajax({
                                url: `/asset/${assetId}`,
                                type: "GET",
                                success: function(asset) {
                                    $("#assetName").text(asset.name);
                                    $("#assetType").text(asset.asset_type ? asset.asset_type.name : 'N/A');
                                    $("#serialNumber").text(asset.serial_number ?? 'N/A');
                                    $("#location").text(asset.location ? asset.location.name : 'N/A');
                                    $("#status").text(asset.status)
                                        .removeClass()
                                        .addClass(
                                            `badge badge-${asset.status === 'Working' ? 'success' : 'danger'}`
                                        );
                                    $("#description").text(asset.description ?? 'N/A');
                                    $("#brokenBy").text(asset.broken_by ?? '-');

                                    let imgSrc = asset.image ? `/storage/${asset.image}` :
                                        '/images/no-image.png';
                                    $("#assetImage").attr("src", imgSrc);

                                    $("#assetDetailModal").modal("show");
                                    loadAssetReturns(1, assetId); // Load return records for this asset
                                },
                                error: function() {
                                    alert("Asset details could not be loaded.");
                                }
                            });
                        });

                        // Load Asset Return History
                        function loadAssetReturns(page, assetId) {
                            $.ajax({
                                url: `/get-asset-returns?asset_id=${assetId}&page=${page}`,
                                type: "GET",
                                dataType: "json",
                                success: function(response) {
                                    let tableBody = $("#assetReturnsTableBody");
                                    tableBody.empty();

                                    if (response.data.length === 0) {
                                        tableBody.append(
                                            `<tr><td colspan="8" class="text-center">No records found</td></tr>`
                                        );
                                    } else {
                                        $.each(response.data, function(index, item) {
                                            tableBody.append(`
                            <tr>
                                <td>${item.name}</td>
                                 <td>${item.lend_to}</td>
                                 <td>${'Admin'}</td>
                                 <td>${item.lend_date}</td>
                                <td>${item.return_date ?? 'Not Returned'}</td>
                                <td>${item.return_by}</td>
                                <td>${item.actual_return_date ?? 'Not Returned'}</td>
                                <td>${item.notes}</td>
                                </tr>
                                `);
                                            // <td>
                                            //     <button class="btn btn-sm btn-danger delete-return" data-id="${item.id}">Delete</button>
                                            // </td>
                                        });
                                    }

                                    // Pagination
                                    let paginationLinks = "";
                                    if (response.pagination.prev_page_url) {
                                        paginationLinks +=
                                            `<button class="btn btn-sm btn-secondary" onclick="loadAssetReturns(${response.pagination.current_page - 1}, ${assetId})">Previous</button> `;
                                    }
                                    paginationLinks +=
                                        `Page ${response.pagination.current_page} of ${response.pagination.last_page} `;
                                    if (response.pagination.next_page_url) {
                                        paginationLinks +=
                                            `<button class="btn btn-sm btn-secondary" onclick="loadAssetReturns(${response.pagination.current_page + 1}, ${assetId})">Next</button>`;
                                    }
                                    $("#paginationLinks").html(paginationLinks);
                                },
                                error: function() {
                                    alert("Error loading asset return data.");
                                }
                            });
                        }

                        // Delete Asset Return Record
                        $(document).on("click", ".delete-return", function() {
                            let returnId = $(this).data("id");

                            if (confirm("Are you sure you want to delete this record?")) {
                                $.ajax({
                                    url: `/asset-returns/${returnId}`,
                                    type: "DELETE",
                                    success: function() {
                                        alert("Record deleted successfully.");
                                        $("#assetDetailModal").modal("hide");
                                    },
                                    error: function() {
                                        alert("Failed to delete the record.");
                                    }
                                });
                            }
                        });
                    });


                    // sdjgjf
                    document.getElementById('filterLocation').addEventListener('change', function() {
                        updateFilters();
                    });

                    document.getElementById('filterUser').addEventListener('change', function() {
                        updateFilters();
                    });

                    document.getElementById('searchBy').addEventListener('keyup', function() {
                        updateFilters();
                    });

                    function updateFilters() {
                        let location_id = document.getElementById('filterLocation').value;
                        let user_id = document.getElementById('filterUser').value;
                        let search = document.getElementById('searchBy').value;

                        let params = new URLSearchParams(window.location.search);
                        if (location_id) {
                            params.set('location_id', location_id);
                        } else {
                            params.delete('location_id');
                        }
                        if (user_id) {
                            params.set('user_id', user_id);
                        } else {
                            params.delete('user_id');
                        }
                        if (search) {
                            params.set('search', search);
                        } else {
                            params.delete('search');
                        }

                        window.location.search = params.toString();
                    }
                </script>

                <script>
                    $(document).ready(function() {
                        // Open modal and fetch users
                        $('.lentToBtn').click(function() {
                            let assetId = $(this).data('id'); // Get asset ID from button
                            $('.asset_id').val(assetId); // Set asset ID in hidden input field

                            // Fetch users dynamically from database
                            $.get('/lent-assets/users', function(data) {
                                let userDropdown = $('#user_id');
                                userDropdown.empty().append('<option value="">Select User...</option>');
                                data.forEach(user => {
                                    userDropdown.append(
                                        `<option value="${user.id}">${user.name}</option>`);
                                });
                            });

                            $('#lentToModal').modal('show'); // Show modal
                        });

                        // Submit form via AJAX
                        $('#lentAssetForm').submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: '/lent-assets/store',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(response) {
                                    alert(response.message);
                                    $('#lentToModal').modal('hide');
                                    location.reload(); // Refresh the table
                                },
                                error: function(xhr) {

                                    alert('Error: ' + (xhr.responseJSON ? xhr.responseJSON.message :
                                        'Unknown error'));
                                }
                            });
                        });
                    });




                    // Handle Status Button Click
                    $(".status-btn").click(function() {
                        $(".status-btn").removeClass("active");
                        $(this).addClass("active");
                        $("#status").val($(this).data("status"));
                    });

                    // asset type
                    document.addEventListener('DOMContentLoaded', function() {
                        // Initialize Bootstrap modals
                        const addAssetTypeModal = new bootstrap.Modal(document.getElementById('addAssetTypeModal'));
                        const editAssetTypeModal = new bootstrap.Modal(document.getElementById('editAssetTypeModal'));

                        // Form elements for asset type creation and editing
                        const addAssetTypeForm = document.getElementById('addAssetTypeForm');
                        const editAssetTypeForm = document.getElementById('editAssetTypeForm');

                        // Fields inside Edit Asset Type Modal
                        const editAssetTypeName = document.getElementById('editAssetTypeName');
                        const editAssetId = document.getElementById('editAssetId');
                        const updateAssetTypeBtn = document.getElementById('updateAssetTypeBtn');

                        // Open Edit Modal and populate data
                        document.querySelectorAll('.edit-asset-type-btn').forEach(button => {
                            button.addEventListener('click', function() {
                                let assetRow = this.closest('tr');
                                let assetId = assetRow.querySelector('.checkbox-item').value;
                                let assetName = assetRow.querySelector('td:nth-child(2)').innerText.trim();

                                editAssetId.value = assetId;
                                editAssetTypeName.value = assetName;
                                editAssetTypeForm.action = `/assettypes/${assetId}`;

                                editAssetTypeModal.show(); // Open modal
                            });
                        });


                        $(document).ready(function() {
                            $('#addAssetTypeForm').submit(function(e) {
                                e.preventDefault(); // Prevent default form submission

                                let formData = $(this).serialize(); // Serialize form data

                                $.ajax({
                                    url: "{{ route('assettypes.store') }}",
                                    type: "POST",
                                    data: formData,
                                    success: function(response) {
                                        if (response.success) {
                                            // Append new asset type to the dropdown
                                            $('select[name="asset_type_id"]').append(
                                                `<option value="${response.asset_type.id}" selected>${response.asset_type.name}</option>`
                                            );

                                            // Show success message
                                            alert('Asset Type Added Successfully!');

                                            // Reset form and close modal
                                            $('#addAssetTypeForm')[0].reset();
                                            $('#addAssetTypeModal').modal('hide');
                                        } else {
                                            alert('Error: ' + response.message);
                                        }
                                    },
                                    error: function(xhr) {
                                        alert('Failed to add asset type. Please try again.');
                                    }
                                });
                            });
                        });
                        // location
                        $(document).ready(function() {
                            $('#addLocationForm').submit(function(e) {
                                e.preventDefault();

                                let formData = $(this).serialize();

                                $.ajax({
                                    url: "{{ route('locations.store') }}",
                                    type: "POST",
                                    data: formData,
                                    success: function(response) {
                                        if (response.success) {
                                            // Append new location to dropdown
                                            $('select[name="location_id"]').append(
                                                `<option value="${response.location.id}" selected>${response.location.name}</option>`
                                            );

                                            alert('Location Added Successfully!');

                                            // Reset form & close modal
                                            $('#addLocationForm')[0].reset();
                                            $('#addLocationModal').modal('hide');
                                        } else {
                                            alert('Error: ' + response.message);
                                        }
                                    },
                                    error: function() {
                                        alert('Failed to add location. Please try again.');
                                    }
                                });
                            });
                        });
                        // Handle update asset type
                        updateAssetTypeBtn.addEventListener('click', function() {
                            if (editAssetTypeName.value.trim() === '') {
                                alert('Asset Name cannot be empty!');
                                return;
                            }
                            editAssetTypeForm.submit(); // Submit form
                        });

                        // Auto-refresh asset type dropdown after adding a new asset type
                        addAssetTypeForm.addEventListener('submit', function(event) {
                            event.preventDefault();
                            let formData = new FormData(addAssetTypeForm);

                            fetch(addAssetTypeForm.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                            .getAttribute('content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        let assetTypeDropdown = document.querySelector(
                                            'select[name="asset_type_id"]');
                                        let newOption = new Option(data.asset_type.name, data.asset_type.id, true,
                                            true);
                                        assetTypeDropdown.appendChild(newOption);
                                        addAssetTypeModal.hide();
                                        addAssetTypeForm.reset();
                                    } else {
                                        alert('Failed to add asset type. Please try again.');
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        });

                    });
                </script>


            @endsection
