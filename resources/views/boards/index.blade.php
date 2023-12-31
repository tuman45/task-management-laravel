@extends('layouts.main')
@section('container')
   <div class="container-fluid mt-n23 px-6" style="padding-top: 70px">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
               <div class="d-flex justify-content-between align-items-center">
                  <div class="mb-2 mb-lg-0">
                     <h3 class="mb-0 text-white">Welcome, {{ $user->name }}</h3>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="boardModal" tabindex="-1">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Board</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <form action="/boards" method="post">
                                 @csrf
                                 <input type="hidden" id="board_slug" class="form-control" name="board_slug" readonly>
                                 <div>
                                    <label class="form-label" for="board_name">Board Name</label>
                                    <input type="text" id="board_name"
                                       class="form-control @error('board_name') is-invalid @enderror" name="board_name"
                                       autofocus>
                                    @error('board_name')
                                       <div class="invalid-feedback">
                                          {{ $message }}
                                       </div>
                                    @enderror
                                 </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" id="submitBtn">Create Board</button>
                              </form>
                           </div>
                        </div>
                     </div>
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
            </div>
            <!-- row  -->
            <div class="row mt-6">
               <div class="col-md-12 col-12">
                  <!-- card  -->
                  <div class="card">
                     <!-- card header  -->
                     <div class="card-header bg-white py-4">
                        <div class="d-flex justify-content-between align-items-center">
                           <h4 class="mb-0"> All Boards </h4>
                           <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#boardModal">
                              <i data-feather="plus-circle" class="nav-icon icon-xs"></i> New Board
                           </button>
                        </div>
                     </div>
                     <!-- table  -->
                     <div class="row mt-3 mb-3 mx-3">
                        @foreach ($boards as $board)
                           <a href="/boards/{{ $board->board_slug }}" class="col-lg-3 my-2 py-1">
                              <div style="background-color: #669de7; height:100px">
                                 <p class="mx-3 fs-4 text-white">{{ $board->board_name }}</p>

                              </div>
                           </a>
                        @endforeach
                     </div>
                     <!-- card footer  -->
                     {{-- <div class="card-foo  ter bg-white text-center">
                     <a href="#" class="link-primary">View All Projects</a>
                  </div> --}}
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
                  .then(data => slug.value = data.slug)
               submitBtn.disabled = false;
            })
         </script>
      @endsection
