@extends('layouts.master')
 @push('styles')
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
 @endpush
 
 @section('content')
     <style>
         .border-purple {
             border: 1px solid #9b59b6 !important;
         }
 
         .modal {
             display: none;
             position: fixed;
             z-index: 999;
             left: 0;
             top: 0;
             width: 100%;
             height: 100%;
             overflow: auto;
             background-color: rgba(0, 0, 0, 0.6);
         }
 
         .modal-content {
             background-color: #fff;
             margin: 10% auto;
             padding: 20px;
             border-radius: 8px;
             width: 40%;
             box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
             position: relative;
         }
 
         .close {
             color: #aaa;
             float: right;
             font-size: 24px;
             font-weight: bold;
             cursor: pointer;
         }
 
         .close:hover {
             color: #000;
         }
 
         textarea {
             width: 100%;
             margin-top: 10px;
             padding: 10px;
             font-size: 14px;
             border-radius: 4px;
             border: 1px solid #ccc;
             resize: vertical;
         }
 
         .attachment-info {
             margin-top: 10px;
             font-size: 13px;
         }
 
         .modal-actions {
             margin-top: 15px;
             display: flex;
             justify-content: flex-end;
             gap: 10px;
         }
 
         .modal-actions button {
             padding: 8px 16px;
             font-size: 14px;
             border: none;
             border-radius: 4px;
             cursor: pointer;
         }
 
         .modal-actions button:first-child {
             background-color: #ccc;
         }
 
         .modal-actions button:last-child {
             background-color: #007bff;
             color: white;
         }
 
         .post-container {
             margin-top: 30px;
             padding: 0 20px;
         }
 
         .post-card {
             background-color: #fff;
             border-radius: 8px;
             padding: 15px 20px;
             box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
             margin-bottom: 20px;
         }
 
         .post-card:nth-child(odd) {
             border-left: 4px solid #9b59b6;
         }
 
         .post-card:nth-child(even) {
             border-right: 4px solid #9b59b6;
         }
 
         .post-card h4 {
             margin: 0 0 10px;
             color: #007bff;
             font-size: 16px;
         }
 
         .post-card p {
             margin: 0;
             font-size: 14px;
             color: #333;
         }
 
         #postContainer {
             max-height: 300px;
             
             overflow-y: auto;
             padding-right: 10px;
         }
 
       
         #postContainer::-webkit-scrollbar {
             width: 8px;
         }
 
         #postContainer::-webkit-scrollbar-track {
             background: #f1f1f1;
         }
 
         #postContainer::-webkit-scrollbar-thumb {
             background-color: #888;
             border-radius: 4px;
         }
 
         #postContainer::-webkit-scrollbar-thumb:hover {
             background: #555;
         }
     </style>
     <div class="page-wrapper">
         <div class="container-fluid mt-4 ">
             <div class="row">
 
                 
                 <div class="container-fluid">
                   
                     <div class="row">
 
                       
                         <div class="col-md-12">
                             <div class="card-header d-flex justify-content-between align-items-center">
                                 <div class="card-title mb-0">
                                     <h3 id="all" class="main-heading">Engage <span>Ready to dive in ?</span></h3>
                                 </div>
                                 <div class="d-flex align-items-center">
                                     <img src="https://plus.unsplash.com/premium_vector-1682269287900-d96e9a6c188b?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                         alt="Profile" class="rounded-circle me-3" width="70" height="70">
                                     <span>Hey <strong>{{ Auth::user()->name }}
                                         </strong></span>
                                 </div>
                             </div>
                         </div>
 
                         <!-- Sidebar + Right Content Area -->
                         <div class="col-md-3 rounded-8xl" style="border-radius:20px">
                             <!-- Sidebar -->
                             <div style="margin-top: 20px" class="col bg-white p-4 rounded shadow">
                                 <h2 class="text-lg font-semibold mb-4">Filters</h2>
                                 <hr class="mb-4">
 
                                 <!-- Activities Section -->
                                 <div class="mb-6">
                                     <h4 class="text-sm font-semibold mb-2">Activities</h4>
                                     <div class="space-y-2">
                                         <label
                                             class="flex items-center p-2 rounded-lg cursor-pointer bg-blue-50 text-blue-700 font-medium">
                                             <input type="radio" name="activity" class="mr-2 accent-blue-500" checked>
                                             <span class="flex items-center gap-2">
                                                 <i class="fa fa-check text-secondary "></i> <a href="#all"
                                                     style="color: black">All Activities</a>
                                             </span>
                                         </label>
 
                                         {{-- <label class="flex items-center p-2 rounded-lg cursor-pointer hover:bg-gray-100">
                                             <input type="radio" name="activity" class="mr-2 accent-pink-400">
                                             <span class="flex items-center gap-2 text-pink-500">
                                                 <i class="fa fa-trophy text-danger "></i> Kudos
                                             </span>
                                         </label>
 
                                         <label class="flex items-center p-2 rounded-lg cursor-pointer hover:bg-gray-100">
                                             <input type="radio" name="activity" class="mr-2 accent-cyan-400">
                                             <span class="flex items-center gap-2 text-cyan-500">
                                                 <i class="fa fa-signal fa-1x text-info"></i> Polls
                                             </span>
                                         </label> --}}
 
                                         <label class="flex items-center p-2 rounded-lg cursor-pointer hover:bg-gray-100">
                                             <input type="radio" name="activity" class="mr-2 accent-purple-400">
                                             <span class="flex items-center gap-2 text-purple-500">
                                                 <i class="fa fa-file fa-1x" style="color: #9b59b6;"></i><a href="#post"
                                                     style="color: black"> Posts</a>
                                             </span>
                                         </label>
                                     </div>
                                 </div>
                                 <hr>
 
                                 <!-- Search -->
                                 <div class="relative mb-4">
                                     <input type="text" class="form-control rounded-pill ps-4 pe-5" placeholder="Search"
                                         aria-label="Search">
                                     <span class="position-absolute end-0 top-0 mt-2 me-3 text-muted">
                                         {{-- <i class="fa fa-search"></i> <!-- Bootstrap Icons --> --}}
                                     </span>
                                 </div>
 
                                 <!-- Collapsible Filters -->
                                 <div class="text-sm">
                                     <details class="mb-2">
                                         <summary class="font-semibold cursor-pointer">Groups</summary>
                                         <div class="mt-2 pl-4 text-gray-600">Group</div>
                                     </details>
 
                                     <details class="mb-2">
                                         <summary class="font-semibold cursor-pointer">Locations</summary>
                                         <div class="mt-2 pl-4 text-gray-600">Location</div>
                                     </details>
 
                                     <details>
                                         <summary class="font-semibold cursor-pointer">Departments</summary>
                                         <div class="mt-2 pl-4 text-gray-600">Department</div>
                                     </details>
                                 </div>
                             </div>
                         </div>
 
                         <!-- Right Content Area -->
                         <div class="col-md-9">
                             <!-- Action Buttons -->
                             <div class="d-flex justify-content-start flex-wrap">
                                 {{-- <div class="card text-center p-4 m-4 border border-danger rounded shadow-sm"
                                     style="width: 12rem;  background-color: #ffe6ec;">
                                     <span class="h4 mb-2"><i class="fa fa-trophy fa-2x text-danger"></i></span>
                                     <span class="fw-semibold text-dark">Give Kudos</span>
                                 </div>
                                 <div class="card text-center p-4 m-4 border border-info rounded shadow-sm"
                                     style="width: 12rem; background-color: #e6fcff;">
                                     <span class="h4 mb-2"><i class="fa fa-signal fa-2x text-info"></i></span>
                                     <span class="fw-semibold text-dark">Create Polls</span>
                                 </div> --}}
                                 <div class="card text-center p-4 m-4 border border-purple rounded shadow-sm"
                                     style="width: 12rem; background-color: #f3e8ff;" onclick="openModal()">
                                     <span class="h4 mb-2"><i class="fa fa-file fa-2x" style="color: #9b59b6;"></i></span>
                                     <span class="fw-semibold text-dark">Create Posts</span>
                                 </div>
                             </div>
 
 
                             <!-- Activities Section -->
                             <div class="flex-1">
                                 <div class="d-flex justify-content-between align-items-center mb-4">
                                     <div class="main-heading">All Activities - All <span>Groups</span></div>
                                 </div>
 
                                 {{-- post card section --}}
                                 <div class="text-sm text-gray-500">Sort: <span class="fw-medium"> <select id="monthSelect"
                                             class="form-select form-select rounded-pill"
                                             aria-label=".form-select-sm example">
                                             <option selected>Select Month</option>
                                             <option value="01">January</option>
                                             <option value="02">February</option>
                                             <option value="03">March</option>
                                             <option value="04">April</option>
                                             <option value="05">May</option>
                                             <option value="06">June</option>
                                             <option value="07">July</option>
                                             <option value="08">August</option>
                                             <option value="09">September</option>
                                             <option value="10">October</option>
                                             <option value="11">November</option>
                                             <option value="12">December</option>
                                         </select></span>
                                 </div>
                                 <div id="postContainer" class="post-container">
                                     @foreach ($posts as $post)
                                         <div class="post-card">
                                             <div class="d-flex justify-content-between align-items-start">
                                                 <div class="d-flex align-items-center">
                                                     <img src="https://plus.unsplash.com/premium_vector-1682269287900-d96e9a6c188b?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                         class="rounded-circle me-3" width="65" height="65">
                                                     <div>
                                                         <strong>{{ $post->user->name }}</strong><br>
                                                         <small
                                                             class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                                     </div>
                                                 </div>
 
                                                 <button class="btn btn-sm text-danger delete-post success"
                                                     data-id="{{ $post->id }}" title="Delete">
                                                     &times;
                                                 </button>
                                             </div>
 
                                             <h4>Posted to: Everyone</h4>
                                             <p>{{ $post->content }}</p>
 
                                             <hr>
                                             <div class="comments-container mt-3" id="comments-{{ $post->id }}">
                                                 @foreach ($post->comments as $comment)
                                                     <div>
                                                         <h5>Commented by: <strong>{{ $comment->user->name }} </strong></h5>
                                                         <p>{{ $comment->content }} <button
                                                                 class="btn btn-sm text-danger delete-comment success"
                                                                 data-id="{{ $comment->id }}" title="Delete">
                                                                 <i class=" fa fa-trash"></i>
                                                             </button></p>
                                                     </div>
                                                 @endforeach
                                                 <div class="comment-box" id="comment-box-{{ $post->id }}"
                                                     style="display: none;">
                                                     <form method="POST" action="{{ route('comments.store') }}">
                                                         @csrf
                                                         <input type="hidden" name="post_id"
                                                             value="{{ $post->id }}">
                                                         <textarea name="content" rows="3" placeholder="Write a comment..." required></textarea>
                                                         <button type="submit">Post Comment</button>
                                                     </form>
                                                 </div>
                                             </div>
 
 
                                             <div class="d-flex justify-content-start align-items-center gap-2 mt-3">
                                                 {{-- <button class="toggle-reaction" data-id="{{ $post->id }}">
                                                     ❤️ {{ $post->reactions->count() }} React
                                                 </button> --}}
                                                 <button class="toggle-comment" data-id="{{ $post->id }}">
                                                     💬 {{ $post->comments->count() }} Comment
                                                 </button>
                                             </div>
                                         </div>
                                     @endforeach
 
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 
 
     <!-- Modal Structure -->
     <div id="postModal" class="modal">
         <div class="modal-content">
             {{-- <span class="close" onclick="closeModal()">&times;</span> --}}
             <h2>Create a Post</h2>
             <label>You are posting in: <span id="audience">Everyone</span></label>
             <textarea id="postContent" placeholder="Write something here..." rows="4"></textarea>
             <div class="attachment-info">
                 <span>Add: <a href="#">Attachment</a></span>
                 <span><em>Max 10 images, max 10 documents</em></span>
             </div>
             <div class="modal-actions">
                 <button onclick="cancel()">Cancel</button>
                 <button onclick="post()">Post</button>
             </div>
         </div>
     </div>
 
     <script>
         document.querySelectorAll('.toggle-comment').forEach(button => {
             button.addEventListener('click', () => {
                 const postId = button.dataset.id;
                 const box = document.getElementById(`comment-box-${postId}`);
                 box.style.display = box.style.display === 'none' ? 'block' : 'none';
             });
         });
     </script>
 
 
     <script>
         function post() {
             const content = document.getElementById("postContent").value.trim();
 
             if (!content) {
                 alert("Please write something before posting.");
                 return;
             }
 
             fetch("/posts", {
                     method: "POST",
                     headers: {
                         "Content-Type": "application/json",
                         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                     },
                     body: JSON.stringify({
                         content
                     }),
                 })
                 .then((res) => res.json())
                 .then((data) => {
                     if (data.status === "success") {
                         renderPostCard(data.post, data.user);
                         document.getElementById("postContent").value = "";
                         closeModal();
                         location.reload();
 
                     }
                 })
                 .catch((err) => {
                     console.error(err);
                     alert("Error posting.");
                 });
         }
 
         $(document).on('click', '.delete-post', function() {
             let postId = $(this).data('id');
             if (confirm('Are you sure you want to delete this post?')) {
                 $.ajax({
                     url: '/posts/' + postId,
                     type: 'DELETE',
                     data: {
                         _token: '{{ csrf_token() }}'
                     },
                     success: function(response) {
                         alert(response.message);
                         location.reload();
 
 
                         //  $('#post-' + postId).remove();
                     },
                     error: function() {
                         alert('Failed to delete the post.');
                     }
                 });
             }
         });
         $(document).on('click', '.delete-comment', function() {
             let commentId = $(this).data('id');
             if (confirm('Are you sure you want to delete this post?')) {
                 $.ajax({
                     url: '/comments/' + commentId,
                     type: 'DELETE',
                     data: {
                         _token: '{{ csrf_token() }}'
                     },
                     success: function(response) {
                         alert(response.message);
                         location.reload();
 
 
                         //  $('#post-' + postId).remove();
                     },
                     error: function() {
                         alert('Failed to delete the post.');
                     }
                 });
             }
         });
 
         function renderPostCard(post, user) {
             const postCard = document.createElement("div");
             postCard.className = "post-card";
             const timeAgo = (timestamp) => {
                 const diff = Math.floor((new Date() - new Date(timestamp)) / 1000);
                 if (diff < 60) return "Just now";
                 if (diff < 3600) return `${Math.floor(diff / 60)} min ago`;
                 if (diff < 86400) return `${Math.floor(diff / 3600)} hr ago`;
                 return new Date(timestamp).toLocaleDateString();
             };
             document.getElementById("postContainer").prepend(postCard);
         }
 
         function openModal() {
             document.getElementById("postModal").style.display = "block";
         }
 
         function closeModal() {
             document.getElementById("postModal").style.display = "none";
         }
 
         function cancel() {
             closeModal();
         }
 
         window.onclick = function(event) {
             const modal = document.getElementById("postModal");
             if (event.target == modal) {
                 closeModal();
             }
         };
     </script>
 @endsection
 
 