@extends('layouts.main')
@section('container')
   <div class="container-fluid mt-n23" style="padding-top: 70px">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <a href="/" class="btn btn-warning mb-3"><i data-feather="arrow-left"
                  class="nav-icon icon-xs me-1"></i>Back</a>
            <div class="d-flex justify-content-between align-items-center">
               <div class="mb-2 mb-lg-0">
                  <h3 class="mb-0 text-white">{{ $board->board_name }}</h3>
               </div>
               <div class="dropdown">
                  <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                     aria-expanded="false"><i data-feather="settings" class="nav-icon icon-xs"></i>
                     Options
                  </button>
                  <ul class="dropdown-menu dropdown-menu">
                     <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#renameModal">
                           Rename Board
                        </button></li>
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     <form action="{{ route('boards.destroy', $board->board_slug) }}" method="post">
                        @method('delete')
                        @csrf
                        <li><button type="submit" class="dropdown-item"
                              onclick="return confirm('Are you sure want to delete board and all task?')">Delete
                              Board</button></li>
                     </form>
                  </ul>
               </div>
            </div>
            @if (session()->has('success'))
               <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                  <strong>{{ session('success') }}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            @endif

            @if (session()->has('error'))
               <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                  <strong>{{ session('error') }}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="renameModal" tabindex="-1">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Rename Board</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <form action="{{ route('boards.update', $board->board_slug) }}" method="post">
                           @method('put')
                           @csrf
                           <input type="hidden" id="board_slug" class="form-control" name="board_slug" readonly>
                           <div>
                              <label class="form-label" for="board_name">Board Name</label>
                              <input type="text" id="board_name"
                                 class="form-control @error('board_name') is-invalid @enderror" name="board_name"
                                 value="{{ $board->board_name }}" autofocus>
                              @error('board')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submitBtn" class="btn btn-primary">Rename Board</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- row  -->
            <div class="row mt-6">
               <div class="col-md-12 col-12">
                  <!-- card  -->
                  <div class="card">
                     <!-- card header  -->
                     <div class="card-header bg-white py-4">
                        <div class="d-flex justify-content-between align-items-center">
                           <h4 class="mb-0"> All {{ $title }} </h4>
                           <a href="{{ route('boards.tasks.create', ['board' => $board->board_slug]) }}"
                              class="btn btn-primary"><i data-feather="plus-circle" class="nav-icon icon-xs"></i> Create
                              Task</a>
                        </div>
                     </div>
                     <!-- table  -->
                     <div class="row my-3 mx-3">
                        @foreach ($boardLists as $boardList)
                           @php
                              $tasks = $groupedTasks[$boardList->id] ?? [];
                           @endphp

                           <div class="col-lg-4 my-2 py-1">
                              <div style="max-height: 300px; overflow-y: auto;">
                                 <table class="table">
                                    <thead>
                                       <tr class="text-center fw-bold position-sticky top-0 bg-light">
                                          <th class="border fw-bold fs-3 text-dark">{{ $boardList->list_name }}</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($tasks as $task)
                                          <tr class="border">
                                             <td class="p-0">
                                                <a href="{{ route('boards.tasks.show', [$board->board_slug, $task->task_slug]) }}"
                                                   class="text-muted d-block p-3">
                                                   {{ $task->task_title }}
                                                </a>
                                             </td>
                                          </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        @endforeach

                     </div>
                     <!-- card footer  -->
                     {{-- <div class="card-footer bg-white text-center">
                     <a href="#" class="link-primary">View All Projects</a>
                  </div> --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         const board = document.querySelector('#board_name');
         const slug = document.querySelector('#board_slug');
         const submitBtn = document.querySelector('#submitBtn');

         submitBtn.disabled = true;
         board.addEventListener('change', function() {
            fetch('/boards/checkSlug?board_name=' + board.value)
               .then(response => response.json())
               .then(data => {
                  slug.value = data.slug
                  submitBtn.disabled = false;
               })
               .catch(error => {
                  console.error('Error:', error);
                  submitBtn.disabled = true;
               });
         })
      </script>
   @endsection
