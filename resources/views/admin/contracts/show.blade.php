@extends('layouts.master')

@section('content')
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

    <style>
        .content-fixed-wrapper {
            margin-left: 250px;
            margin-top: 70px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .content-fixed-wrapper {
                margin-left: 0;
                margin-top: 70px;
            }
        }

        .cke_notification {
            display: none;
        }

        #update {
            margin-left: 90px;
        }
    </style>

    <div class="content-fixed-wrapper">
        <div class="container mt-4">
            <div class="row">
                <!-- Main Content -->
                <div class="col-md-12">
                    <!-- Contract Details -->
                    <div id="home" class="card mt-4 p-3">
                        <h4>Contract Detail<span> <i class="fa fa-file"></i></span> </h4>

                        <div class="row">
                            <div class="col-md-6"><strong>Vendor Name:</strong> {{ $contract->Vendor_name }}</div>
                            <div class="col-md-6"><strong>Subject:</strong> {{ $contract->subject }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><strong>Type:</strong> {{ $contract->type }}</div>
                            <div class="col-md-6"><strong>Value:</strong> ${{ number_format($contract->value, 2) }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><strong>Start Date:</strong>
                                {{ \Carbon\Carbon::parse($contract->start_date)->format('M d, Y') }}</div>
                            <div class="col-md-6"><strong>End Date:</strong>
                                {{ \Carbon\Carbon::parse($contract->due_date)->format('M d, Y') }}</div>
                        </div>
                    </div>

                    <!-- Description Box -->
                    <div class="card mt-4 p-3">
                        <h4>Description</h4>
                        <textarea id="description-editor" name="description" class="form-control" rows="6">{{ $contract->description }}</textarea>
                    </div>

                    <!-- Attachments Section -->
                    <div id="attachments-section" class="card p-4 shadow-lg">
                        <h4 class="mb-3">📂 Attachments</h4>
                        <form id="upload-form" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload PDF</label>
                                <input type="file" id="file" name="file" class="form-control" required>
                            </div>
                            <input type="hidden" id="contract_id" name="contract_id" value="{{ $contract->id }}">
                            <button type="submit" class="btn btn-danger">
                                <span class="spinner-border spinner-border-sm d-none" id="upload-spinner"></span>
                                Upload
                            </button>
                        </form>
                        <h4 class="mt-5">📁 Uploaded Files</h4>
                        <div id="attachments-list">
                            @foreach ($contract->attachments as $attachment)
                                <div class="d-flex align-items-center mt-2">
                                    <span>
                                        {{ $attachment->file_name }}
                                        ({{ number_format($attachment->file_size / 1024, 2) }} KB)
                                    </span>

                                  

                                    <a href="{{ asset($attachment->file_path) }}" 
                                        download 
                                        class="btn btn-sm btn-danger mx-2 download-btn">
                                            <i class="la la-download"></i>
                                        </a>

                                    <button type="button" class="btn btn-sm btn-danger delete-btn">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <div id="update" class="ms-auto">
                                        <span class="text small">
                                            Last updated on: {{ $attachment->updated_at->format('d M, Y') }}
                                        </span>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //attachment upload
        document.getElementById("upload-form").addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let spinner = document.getElementById("upload-spinner");
            spinner.classList.remove("d-none");

            fetch("{{ route('attachments.upload') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content")
                    }
                })
                .then(response => response.json())
                .then(data => {
                    spinner.classList.add("d-none");
                    if (data.message) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    spinner.classList.add("d-none");
                });
        });

        // Delete Button
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");

                fetch(`/attachments/delete/${id}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            location.reload();
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });

     


        // Description box
        CKEDITOR.replace('description-editor');
    </script>
@endsection
