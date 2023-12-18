@extends('layouts.main')
@section('container')
   {{-- @php
      use Carbon\Carbon;
   @endphp --}}
   <div class="container-fluid mt-n23 ps-6" style="padding-top: 60px">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-12">
            <a href="/boards/{{ $board->board_slug }}/tasks" class="btn btn-warning mb-3"><i data-feather="arrow-left"
                  class="nav-icon icon-xs me-1"></i>Back</a>
            <!-- Page header -->
            <div class="d-flex justify-content-between align-items-center">
               <div class="mb-2 mb-lg-0">
                  <h3 class="mb-0 text-white">Create Task</h3>
               </div>
               {{-- <div>
                     <a href="#" class="btn btn-white">Create New {{ $title }} </a>
                  </div> --}}
            </div>
         </div>
         <!-- row  -->
         <div class="row mt-2">
            <div class="col-md-12 col-12">
               <!-- card  -->
               <div class="card">
                  <!-- card header  -->
                  <div class="card-header bg-white py-4">
                     <h4 class="mb-2 fw-bold">Form New Task </h4>
                  </div>
                  <div class="mx-5 my-2">
                     <form action="/boards/{{ $board->board_slug }}/tasks" method="post" class="mb-3">
                        @csrf
                        <input type="hidden" name="task_slug" id="task_slug" readonly>
                        <div class="mb-3">
                           <label for="task_title" class="label-form">Task Title</label>
                           <input type="text" name="task_title" id="task_title"
                              class="form-control @error('task_title') is-invalid @enderror">
                           @error('task_title')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                           <label for="task_desc" class="label-form">Description</label>
                           <textarea name="task_desc" id="task_desc" class="form-control @error('task_desc') is-invalid @enderror">{{ old('task_desc') }}</textarea>
                           @error('task_desc')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                           <label for="due_date" class="label-form">Deadline <sup
                                 class="text-danger">*Opsional</sup></label>
                           <input type="date" name="due_date" id="due_date"
                              class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date') }}">
                           @error('due_date')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                     </form>
                  </div>
                  <!-- table  -->

                  <!-- card footer  -->
                  {{-- <div class="card-footer bg-white text-center">
                     <a href="#" class="link-primary">View All Projects</a>
                  </div> --}}
               </div>
            </div>
         </div>
      </div>
      <script>
         const task = document.querySelector('#task_title');
         const slug = document.querySelector('#task_slug');

         task.addEventListener('input', function() {
            fetch('/tasks/checkSlug?task_title=' + task.value)
               .then(response => response.json())
               .then(data => slug.value = data.slug)
         })
      </script>
   @endsection
