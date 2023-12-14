@extends('layouts.main')
@section('container')
   <div class="container-fluid mt-n23 px-6" style="padding-top: 70px">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
               <div class="d-flex justify-content-between align-items-center">
                  <div class="mb-2 mb-lg-0">
                     <h3 class="mb-0 text-white">{{ $board->board_name }}</h3>
                  </div>
                  <div>
                     <a href="#" class="btn btn-white">Create New {{ $title }} </a>
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
                     <h4 class="mb-0"> All {{ $title }} </h4>
                  </div>
                  <!-- table  -->
                  <div class="row my-3 mx-3">
                     @foreach ($boardLists as $boardList)
                        @php
                           $tasks = $groupedTasks[$boardList->id] ?? [];
                        @endphp
                        <div class="col-lg-4 my-2 py-1">
                           <table class="table">
                              <thead>
                                 <tr class="text-center fw-bold">
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
@endsection
