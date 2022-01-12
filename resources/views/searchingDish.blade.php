<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
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
    <div class="container">
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
        @if(isset($dishes))
            @if(count($dishes) > 0)
                <div class="container">
                    <form action="{{route('order.submit')}}" method="POST">
                    @csrf
                        @foreach($dishes as $dish)
                        <div class="card" style="width: 230px;">
                            <img style="width:230px; height:230px;" src="{{url('/images/' . $dish->dish_image)}}" class="card-img-top" alt="{{$dish->name}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$dish->name}}</h5>
                                <br><br>
                                <input type="number" min="0" name="{{$dish->id}}" placeholder="Quantity">
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <select class="form-select form-control" name="table_number" aria-label="Default select example">
                                <option selected>Select Table Number</option>
                                @foreach($tables as $table)
                                    <option value="{{$table->id}}">{{$table->number}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="btn btn-success" type="submit" value="Submit">
                    </form>
                </div>
            @else   
                <h3>No result found!</h3>
            @endif
        @endif
        
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

<!-- <form action="{{route('order.submit')}}" method="POST">
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
        </form> -->