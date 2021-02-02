@extends('subway.subwaylayout')

@section('maincontent')

  <!-- Main content -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-4">
                  <h1 class="card-title">Conform Orders</h1>
                </div>
                <div class="col-sm-4">
                </div>
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sno</th>
                    <th>Store</th>
                    <th>Quantities</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Progress</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($order)
                  <?php $a = 1; ?>
                    @foreach ($order as $item)
                    <tr>
                      <td>{{$a++}}</td>
                      <td>XYZ Store</td>
                      <td>{{$item -> quantity}}</td>
                      <td>{{$item -> total_amount}}</td>
                      <td>{{$item -> orderdate}}</td>
                      <td>
                        <div class="progress-bar bg-primary" style="width:100%">
                          Delivering
                        </div>
                      </div></td>
                    </tr>
                    @endforeach
                  @endif
                </tbody>
                <tfoot>
                <tr>
                  <th>Sno</th>
                  <th>Store</th>
                  <th>Quantities</th>
                  <th>Total Amount</th>
                  <th>Order Date</th>
                  <th>Progress</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection

@section('javascript')
    @parent
@endsection