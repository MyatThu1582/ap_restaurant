@extends('layouts.adminlte')
@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
          <div class="col-sm-6"><h3 class="mb-0">Add New Dish</h3></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kitchen Panel</li>
            </ol>
          </div>
        </div>
        <div class="row mt-5">
            <div class="card col-8 p-3" style="margin: 0px auto !important;">
                <form action="/dish" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Dish Name</label>
                      <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name">
                    </div>
                    <div class="mb-3">
                      <label for="category" class="form-label">Category</label>
                      <select name="category_id" class="form-select">
                        <option selected>Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Image</label>
                        <input type="file" class="form-control" name="dish_img">
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary float-sm-end ms-2">Save</button>
                    <a href="/dish" class="btn btn-danger float-sm-end ms-2">Back</a>
                </form>
            </div>
        </div>
        <!--end::Row-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::App Content Header-->
  </main>
  <!--end::App Main-->
@endsection