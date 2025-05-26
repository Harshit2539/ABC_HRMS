@extends('layouts.master')
 
@section('content')
    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <h3>Edit Asset</h3>
            <form action="{{ route('asset.update', $asset->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">Asset Details</div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Image</label><br>
                            @if ($asset->image)
                                <img src="{{ asset('uploads/assets/' . $asset->image) }}" width="80" class="mb-2" />
                            @endif
                            <input type="file" name="image" class="form-control">
                        </div>
 
                        <div class="form-group mb-3">
                            <label>* Asset Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $asset->name }}" required>
                        </div>
 
                        <div class="form-group mb-3">
                            <label>* Asset Type</label>
                            <select name="asset_type_id" class="form-control" required>
                                <option value="">Select Asset Type</option>
                                @foreach ($assetTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $asset->asset_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
 
                        <div class="form-group mb-3">
                            <label>* Location</label>
                            <select name="location_id" class="form-control" required>
                                <option value="">Select Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ $asset->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
 
                        <div class="form-group mb-3">
                            <label>Serial Number</label>
                            <input type="text" name="serial_number" class="form-control"
                                value="{{ $asset->serial_number }}">
                        </div>
 
                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control">{{ $asset->description }}</textarea>
                        </div>
 
                        <div class="form-group mb-3">
                            <label>Status</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" value="Working"
                                    {{ $asset->status == 'Working' ? 'checked' : '' }} class="form-check-input">
                                <label class="form-check-label">Working</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" value="Not Working"
                                    {{ $asset->status == 'Not Working' ? 'checked' : '' }} class="form-check-input">
                                <label class="form-check-label">Not Working</label>
                            </div>
                        </div>
 
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
 