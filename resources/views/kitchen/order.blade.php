@extends('layouts.master')
    
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex bd-highlight mb-3">
                          <h3>Kitchen - Order Lists Panel</h3>
                        </div>
                        @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show mx-5" role="alert">
                        <strong>Success!</strong> {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('cancel'))
                        <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                        <strong>Success!</strong> {{ session('cancel') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="dishes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Dish Name</th>
                                        <th>Table Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->dishes->name}}</td>
                                            <td>{{$order->table_id}}</td>
                                            <td>{{$status[$order->status]}}</td>
                                            <td>
                                              <div>
                                                  <a href="/order/{{$order->id}}/approve" class="btn btn-warning">Approve</a>
                                                  <a style="margin:0 2em;" href="/order/{{$order->id}}/cancel" class="btn btn-danger">Cancel</a>
                                                  <a href="/order/{{$order->id}}/ready" class="btn btn-success">Ready</a>
                                              </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- card -->
                </div><!-- col-lg-12 -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
<script src="plugins/jquery/jquery.min.js"></script>
<script>
    $(function () {
        // $("#example1").DataTable({
        // "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#dishes').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "pageLength": 10,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
</script>