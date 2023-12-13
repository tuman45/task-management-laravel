@extends('layouts.main')
@section('container')
<div class="container-fluid mt-n23 px-6" style="padding-top: 70px">
   <div class="row">
      <div class="col-lg-12 col-md-12 col-12">
         <!-- Page header -->
         <div>
            <div class="d-flex justify-content-between align-items-center">
               <div class="mb-2 mb-lg-0">
                  <h3 class="mb-0 text-white">{{ $title }}</h3>
               </div>
               <div>
                  <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                     {{$title}}
                  </button>
               </div>
               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Board</h1>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <form action="" method="post">
                              <div>
                                 <label class="form-label" for="board">Board Name</label>
                                 <input class="form-control" type="text" name="board" id="board">
                              </div>
                           </form>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                     </div>
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
                     <h4 class="mb-0"> All Boards </h4>
                  </div>
                  <!-- table  -->
                  <div class="row mt-3 mb-3 mx-3">
                     @foreach ($boards as $board)
                     <a href="/{{ $board->board_slug }}" class="col-lg-3 my-2 py-1">
                        <div style="background-color: aqua; height:100px">
                           <p class="mx-3 fs-4 text-dark">{{ $board->board_name }}</p>

                        </div>
                     </a>
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
      @endsection