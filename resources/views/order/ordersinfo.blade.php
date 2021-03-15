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
                <div class="col-sm-8">
                  <h1 class="card-title">Active Orders For <span class="text-primary">{{date('Y-m-d')}}</span></h1>
                </div>
                <div class="col-sm-4"> 
                </div>
              </div>
            </div>
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
                          <span class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                              Status
                            </button>
                            <div class="dropdown-menu">
                              <button class="dropdown-item status" id="{{$item -> orderid}}" data-id="Order Send">Order Send</a>
                              <button class="dropdown-item status" id="{{$item -> orderid}}" data-id="Delivered">Order Delivered</a>
                            </div>
                          </span>
                        </td>
                        <td>
                          <a target="_blank" href="{{url('order/report/'.$item -> orderid)}}" class="btn btn-block btn-primary btn-sm"><i class="fa fa-print"></i> Print</a>
                        </td>
                    </tr>
                    @endforeach
                  @endif 
                </tbody>
                <tfoot>
                <tr>
                  <th>Order No</th>
                  <th>Store</th>
                  <th>Quantities</th>
                  <th>Total Amount</th>
                  <th>Order Date</th>
                  <th>Progress</th>'
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

  $('#example2 tbody').on('click','.status',function(){

    var id = $(this).attr('id');
    var status = $(this).data('id');
    
    $.ajax({
      url: 'order/status',
      data: {id:id,status:status},
      success: function()
      {
        location.reload();
      }

    });


  });

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