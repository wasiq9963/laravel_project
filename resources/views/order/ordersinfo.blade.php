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
                  <h1 class="card-title">Active Orders</h1>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                  <select class="form-control" name="store" id="store">
                    <option value="">Select Store</option>
                    @foreach ($store as $item)
                      <option value="{{$item -> storename}}">{{$item -> storename}}</option>
                    @endforeach
                  </select>
                </div>
                
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Order No</th>
                    <th>Store</th>
                    <th>Quantities</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Progress</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                </tbody>
                <tfoot>
                <tr>
                  <th>Sno</th>
                  <th>Store</th>
                  <th>Quantities</th>
                  <th>Total Amount</th>
                  <th>Order Date</th>
                  <th>Progress</th>
                  <th>Action</th>
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
    <!-- -----------View MODEL START---------- -->

<div class="modal fade " id="orderdetailmodel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Order Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <table id="detail" class="table table-border">
              
            </table>
          </div>            
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
    <!-- /.container-fluid -->
  </section>

@endsection

@section('javascript')
 @parent
<script>
$(document).ready(function(){
fetch();
$('#store').change(function(){
  var store = $(this).val();
  fetch(store);
});
function fetch(data = '')
{
  $.ajax({
    url: '/order/info',
    data:{query:data},
    datatype: 'json',
    success: function(response)
    {
      var len = 0;
          var html = '';
        if(response.order != null)
        {
              len = response.order.length;
        }
        alert(len);
        if(len > 0)
        {
          for( i=0; i<len; i++)
          {

          }
        }

    }

  });
}


});

</script>
@endsection