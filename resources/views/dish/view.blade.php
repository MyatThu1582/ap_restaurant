@extends('layouts.adminlte')
@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dishes</h3></div>
              <div class="col-sm-6">
                <a href="{{ route('dish.create') }}" class="btn btn-dark btn-sm float-sm-end ms-2">Add New Dish +</a>
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Kitchen Panel</li>
                </ol>
              </div>
            </div>
            @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="close btn btn-default float-end ms-5" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>              
            @endif
            <div class="row mt-3">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 20px;">ID</th>
                            <th>Dish Name</th>
                            <th>Category Name</th>
                            <th>Dish Image</th>
                            <th>Created At</th>
                            <th style="width: 110px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $id = 1;
                      ?>
                        @foreach($dishes as $dish)
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $dish->name }}</td>
                            <td>{{ $dish->category->name }}</td>
                            <td>
                              <img src="{{ asset('images/'.$dish->image) }}" alt="" style="width: 100px;">
                            </td>
                            <td>{{ $dish->created_at }}</td>
                            <td>
                              <a href="dish/{{ $dish->id }}/edit" style="border: none; background-color: transparent;">
                                Edit
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>
                              </a>
                              <form action="/dish/{{ $dish->id }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" style="border: none; background-color: transparent;">
                                  Delete
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                  </svg>
                                </button>
                              </form>
                            </td>
                        </tr>
                        <?php
                        $id++;
                        ?>
                        @endforeach
                    </tbody>
                </table>                
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
      </main>
      <!--end::App Main-->
@endsection