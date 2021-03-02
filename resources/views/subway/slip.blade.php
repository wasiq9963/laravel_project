<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subway Report</title>
    

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
<link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
</head>
<body>
    <br>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">  
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="../../index2.html" class="h1"><b class="text-warning">Sub<span class="text-success">way</span></b></a>
                    <div class="row">
                        <div class="col-md-6 text-left"><b>Store: <span>Zamzama</span></b> </div>
                        <div class="col-md-6 text-right"><b>Date: <span>01/01/2021</span></b>  </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12 text-center"><h4>OrderId: <span>1</span></h4> </div>
                    </div>
                    <table class="table table-borderless">
                        <tr>
                            <th>Items</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td>Burger</td>
                            <td>2</td>
                            <td>200</td>
                        </tr>
                        <tr>
                            <td>Burger</td>
                            <td>2</td>
                            <td>200</td>
                        </tr>
                        <tr>
                            <td>Burger</td>
                            <td>2</td>
                            <td>200</td>
                        </tr>
                        <tfoot>
                            <tr class="table-dark">
                                <th colspan="2">Total Amount:</th>
                                <th>5000</th>
                            </tr>
                            <tr>
                                <th class="text-left" colspan="3">Customer Detail:</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
        <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
</html>