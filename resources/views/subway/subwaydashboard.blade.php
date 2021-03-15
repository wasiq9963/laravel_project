@extends('subway.subwaylayout')
@section('maincontent')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard For <span class="text-primary">{{date('Y-m-d')}}</span></h1>
        </div>
        @if (Auth::user()->role != 'Admin')
        <div class="col-sm-6">
          <h1 class="m-0">Store: <span class="text-primary">{{Auth::user()->store}}</span></h1>
        </div>
        @else 
        <div class="col-sm-6">
          <h1 class="m-0">All <span class="text-primary">Stores</span></h1>
        </div>
            
        @endif
        
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-inbox"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Orders</span>
              <span class="info-box-number">
                @if ($orderscount->count() == 0)
                <h4>{{$orderscount->count()}}</h4>

                @else
                <h1>{{$orderscount->count()}}</h1>

                    
                @endif
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Items</span>
              <span class="info-box-number">
              @if ($itemscount == 0)
              <h4>{{$itemscount}}</h4>   
              @else
              <h1>{{$itemscount}}</h1>

              @endif
            </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sale Amount</span>
              <span class="info-box-number">
                @if ($amount->total == null)
                <h4>0</h4></span>

                @else
                <h1>{{$amount->total}}</h1></span>

                @endif
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number"><h1>{{$customer}}</h1></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Order No</th>
                      <th>Store</th>
                      <th>Items</th>
                      <th>Total Amount</th>
                      <th>Order Date</th>
                      <th>Progress</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($orderinfo)
                      @foreach ($orderinfo as $item)
                      <tr>
                        <td>{{$item -> orderid}}</td>
                        <td>{{$item -> store}}</td>
                        <td>{{$item -> items}}</td>
                        <td>{{$item -> total}}</td>
                        <td>{{$item -> itemdate}}</td>
                        <td>
                          @if ($item -> status == 'New Order')
                        <div class="badge badge-danger">
                          {{$item -> status}}
                        </div> 
                        @elseif ($item -> status == 'Processing')
                        <div class="badge badge-warning">
                          {{$item -> status}}
                        </div>
                        @elseif ($item -> status == 'Order Send')
                        <div class="badge badge-info">
                          {{$item -> status}}
                        </div>
                        @else 
                        <div class="badge badge-success">
                          {{$item -> status}}
                        </div>
                        @endif
                          </td>
                      </tr>
                      @endforeach
                    @endif 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Order No</th>
                    <th>Store</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Progress</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
    
@endsection