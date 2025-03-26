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
              <div class="col-sm-6"><h3 class="mb-0">Order</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Kitchen Panel</li>
                </ol>
              </div>
            </div>
            @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="close btn btn-default float-end ms-5" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>              
            @endif
            <div class="row">
              <table id="example" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 20px;">ID</th>
                        <th>Order No</th>
                        <th>Dish Name</th>
                        <th>Table No</th>
                        <th>Status</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                  $id = 1;
                  ?>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $id }}</td>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->dish->name }}</td>
                        <td>{{ $order->table_id }}</td>
                        <td>{{ $status[$order->status] }}</td>
                        <td>
                          <a href="/order/{{ $order->id }}/approve" class="btn btn-sm btn-primary">Approve</a>
                          <a href="/order/{{ $order->id }}/cancel" class="btn btn-sm btn-danger">Cancel</a>
                          <a href="/order/{{ $order->id }}/ready" class="btn btn-sm btn-success">Ready</a>
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