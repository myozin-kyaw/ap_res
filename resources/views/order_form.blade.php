<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Panel</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
    <div class="card card-primary card-outline">
        <div class="card-header d-flex bd-highlight mb-3">
            <div class="card-title p-2 bd-highlight">
                <i class="fas fa-concierge-bell"></i>
                Order Form
            </div>
            <div class="ms-auto p-2 bd-highlight">
                <form action="{{ route('dish.search') }}" method="GET">
                    @csrf
                    <input type="search" name="query">
                    <input class="btn btn-primary ml-3" type="submit" value="Search">
                </form>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
            <strong>Success!</strong> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">New Order</a>
                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Customer Order Lists</a>
                    </div>
                </div>
                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            <form action="{{route('order.submit')}}" method="POST">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        @foreach($dishes as $dish)
                                            <div class="col">
                                                <div class="card" style="width: 230px;">
                                                    <img style="width:230px; height:230px;" src="{{url('/images/' . $dish->dish_image)}}" class="card-img-top" alt="{{$dish->name}}">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$dish->name}}</h5>
                                                        <br><br>
                                                        <input type="number" min="0" name="{{$dish->id}}" placeholder="Quantity">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <select class="form-select form-control" name="table_number" aria-label="Default select example">
                                            <option selected>Select Table Number</option>
                                            @foreach($tables as $table)
                                                <option value="{{$table->id}}">{{$table->number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input class="btn btn-success" type="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            <table class="table table-bordered table-striped">
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
                                                  <a href="/order/{{$order->id}}/serve" class="btn btn-success">Serve</a>
                                              </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>
</html>