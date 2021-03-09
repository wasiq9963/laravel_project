@extends('subway.subwaylayout')

@section('maincontent')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Store Report</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <form action="{{url('orderslist/report')}}">
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Store</label>
                                    <select class="form-control" name="store" style="width: 100%;">
                                        <option value="" selected="selected">All Stores</option>
                                        @foreach ($store as $item)
                                        <option value="{{$item -> storename}}">{{$item -> storename}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="from" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                    </div>
                                </div> 
                            </div>         
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>To Date:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="to" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button target="_blank" type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- /.card -->

  </section>
  

</section>
<script>
    

</script>

@endsection