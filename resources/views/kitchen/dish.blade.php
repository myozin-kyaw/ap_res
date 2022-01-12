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
                            <div class="p-2 bd-highlight">
                                <h3>Kitchen - Dishes Panel</h3>
                            </div>
                            <div class="ms-auto p-2 bd-highlight">
                                <a href="/dish/create" style="float:right;" class="btn btn-success">Create</a>
                            </div>
                        </div>
                        @if (session('created'))
                        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('created') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('updated'))
                        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('updated') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('deleted'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('deleted') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="dishes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Dish Name</th>
                                        <th>Category Name</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dishes as $dish)
                                        <tr>
                                            <td>{{$dish->name}}</td>
                                            <td>{{$dish->category->name}}</td>
                                            <td>{{$dish->created_at}}</td>
                                            <td>
                                                <div class="form-row">
                                                    <a style="height:40px; margin-right:10px;" href="/dish/{{$dish->id}}/edit" class="btn btn-warning">Edit</a>
                                                    <form action="/dish/{{$dish->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</button>
                                                    </form>
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
        "searching": true,
        "pageLength": 10,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
</script>