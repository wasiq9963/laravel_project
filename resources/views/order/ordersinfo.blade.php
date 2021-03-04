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
                  @if(Auth::user()->role != 'Admin')
                    <h1 class="card-title">Store: <span>{{Auth::user()->store}}</span></h3>
                  @else
                    <select class="form-control" name="store" id="store">
                      <option value="">Select Store</option>
                      @foreach ($store as $item)
                        <option value="{{$item -> storename}}">{{$item -> storename}}</option>
                      @endforeach
                    </select>
                      
                  @endif
                  
                </div>
                
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
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
                  @if ($order)
                    @foreach ($order as $item)
                    <tr>
                      <td>{{$item -> orderid}}</td>
                      <td>{{$item -> store}}</td>
                      <td>{{$item -> quantity}}</td>
                      <td>{{$item -> price}}</td>
                      <td>{{$item -> itemdate}}</td>
                      <td>
                        @if ($item -> status == 'New Order')
                        <div class="badge badge-success">
                          {{$item -> status}}
                        </div> 
                        @endif
                        @if ($item -> status == 'old')
                        <div class="badge badge-warning">
                          {{$item -> status}}
                        </div>
                        @endif
                        </td>
                        <td>                       {{--url order/report/--}}
                          <a target="_blank" href="{{url('orderdetail/'.$item -> orderid)}}" class="btn btn-block btn-primary btn-sm"><i class="fa fa-print"></i> Print</a>
                        </td>
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
  setTimeout(function()
  {
        location.reload();
  },60000);

  /*fetch();
  $('#store').change(function(){
    var store = $(this).val();
    fetch(store);
  });
  function fetch(data = '')
  {
    $('#mytable').DataTable({
      serverside : true,
      ajax:{
              url: 'order/info',
              data:{query:data},
              dataSrc: ""
              },
              
        "column":[
            {order : "orderid", name: "orderid"},
            {order : "store", name: "store"},
            {order : "quantity", name: "quantity"},
            {order : "price", name: "price"},
            {order : "itemdate", name: "itemdate"},
            {order : "status", name: "status"},
            {order  : "action", name: "action", orderable: false, searchable: false},

        ]
    });*/
    /*$.ajax({
      url: 'order/info',
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
        //alert(len);
        if(len > 0)
        {
          for( i=0; i<len; i++)
          {
            html += '<tr><td>'+response.order[i].orderid+'</td>';
            html += '<td>'+response.order[i].store+'</td>';
            html += '<td>'+response.order[i].quantity+'</td>';
            html += '<td>'+response.order[i].price+'</td>';
            html += '<td>'+response.order[i].itemdate+'</td>';
            if (response.order[i].status == 'New Order')
            {
              html += '<td><div class="badge badge-success">'+response.order[i].status+'</div></td>';
            }
            else
            {
              html += '<td><div class="badge badge-warning">'+response.order[i].status+'</div></td>';
            }
            html += '<td><a target="_blank" href="{{url('order/report')}}/'+response.order[i].orderid+'" class="btn btn-block btn-sm btn-info">Print</a></td>';
            html += '</tr>'
          }
          $("#example2 tbody").append(html);

        }
        else
        {
          html += '<tr><td class="font-weight-bold text-center text-danger" colspan="7">No Record Found</td></tr>'
          $("#example2 tbody").append(html);
        }
      }

    });
  }*/
});

</script>
@endsection