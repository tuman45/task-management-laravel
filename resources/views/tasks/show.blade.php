@extends('layouts.main')
@section('container')
   {{-- @php
      use Carbon\Carbon;
   @endphp --}}
   <div class="container-fluid mt-n23" style="padding-top: 50px">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <a href="/boards/{{ $board->board_slug }}/tasks" class="btn btn-warning mb-3"><i data-feather="arrow-left"
                  class="nav-icon icon-xs me-1"></i>Back</a>
            <div class="d-flex justify-content-between">
               <div class="mb-2 mb-lg-0 me-4">
                  <h3 class="mb-0 text-white fw-bold">{{ $task->task_title }}</h3>
               </div>
               <div class="dropdown">
                  <button class="btn btn-white dropdown-toggle " type="button" data-bs-toggle="dropdown"
                     aria-expanded="false"><i data-feather="settings" class="nav-icon icon-xs"></i>
                     Options
                  </button>
                  <ul class="dropdown-menu dropdown-menu">
                     <li><a href="/boards/{{ $board->board_slug }}/tasks/{{ $task->task_slug }}/edit"
                           class="dropdown-item">
                           Edit Task
                        </a></li>
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     <form action="/boards/{{ $board->board_slug }}/tasks/{{ $task->task_slug }}" method="post">
                        @method('delete')
                        @csrf
                        <li><button type="submit" class="dropdown-item"
                              onclick="return confirm('Are you sure want to delete this task?')">Delete
                              Task</button></li>
                     </form>
                  </ul>
               </div>
            </div>
            @if (session()->has('success'))
               <div class="alert alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                  <strong>{{ session('success') }}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            @endif

            @if (session()->has('error'))
               <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                  <strong>{{ session('error') }}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            @endif
         </div>
         <!-- row  -->
         <div class="row mt-3">
            <div class="col-md-12 col-12">
               <!-- card  -->
               <div class="card">
                  <!-- card header  -->
                  <div class="card-header bg-white py-4">
                     <h4 class="mb-0">Detail</h4>
                  </div>
                  <div>
                     <div class="d-flex justify-content-end mb-3">
                        @if ($task->due_date)
                           <p class="mt-1 mx-3 fs-5 fw-bold">Due date : {{ $task->due_date->format('d M Y') }}</p>
                        @endif
                     </div>
                     <p class="mx-3 m-1 fs-4 fw-bold">Description :</p>
                     <p class="mx-3 fs-4">{{ $task->task_desc }}</p>
                  </div>
                  <!-- table  -->
                  <!-- card footer  -->
                  <div class="card-footer bg-white text-center">
                     <form action="/boards/{{ $board->board_slug }}/tasks/{{ $task->task_slug }}/move" method="post">
                        @method('put')
                        @csrf
                        @if (!$almost && !$done)
                           <button type="submit" class="btn btn-primary">Accept</button>
                        @elseif ($almost && !$done)
                           <button type="submit" class="btn btn-success">Done</button>
                     </form>
                  @elseif($done)
                     <p class="text-center">Task is already done. No further action needed.</p>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   @endsection
