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
                  <?php $a = 1; ?>
                    @foreach ($order as $item)
                    <tr>
                      <td>{{$item -> orderid}}</td>
                      <td>{{$item -> store}}</td>
                      <td>{{$item -> quantity}}</td>
                      <td>{{$item -> price}}</td>
                      <td>{{$item -> itemdate}}</td>
                      <td>
                        @if ($item -> status == 'New Order')
                        <div class="badge badge-info">
                          {{$item -> status}}
                        </div> 
                        @endif
                        @if ($item -> status == 'old')
                        <div class="badge badge-warning">
                          {{$item -> status}}
                        </div>
                        @endif
                        </td>
                        <td>
                          <a href="{{url('subway/report/'.$item -> orderid)}}" class="btn btn-info">print</a>
                          <button id="{{$item -> orderid}}" data-id="{{$item -> itemid}}" class="btn btn-block btn-primary btn-sm detail">Detail</button></td>
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
        $('#example1 tbody').on('click','.detail',function(){
          var id = $(this).attr('id');
          var itemid = $(this).data('id');
          //console.log(id);

          $.ajax({
            url: '/subway/orderdetail',
            data: {id:id},
            datatype: 'json',
            success:function(data)
            {
              console.log(data.result);

              var len=0;
              var html = '';
              if (data.result != null)
              {
                len = data.result.length;
              }
              if (len > 0)
              {
                html += '<tr>';
                html += '<th>Order Id: '+data.result[0].orderid+'</th>';
                html += '<th colspan="3">Order Date: '+data.result[0].itemdate+'</th>';
                html +='</tr>';

                html += '<tr>';
                html += '<th>ItemName</th>';
                html += '<th>Quantity</th>';
                html += '<th>Price</th>';
                html +='</tr>';
                var sno=0;
                var total = 0;
                var qty = 0;
                for (let i = 0; i < len; i++) 
                {
                  //fetch sub detail
                      sno++;
                      html += '<tr>';
                      html += '<td>'+data.result[i].itemname+'</td>';
                      html += '<td>'+data.result[i].quantity+'</td>';
                      html += '<td>'+data.result[i].price+'</td>';
                      html +='</tr>';

                      html += '<tr>';
                      html += '<td colspan="3"> <b>Sub Detail</b> ';
                      html += '<b>Cheese:</b> '+data.result[i].cheese;
                      html += ' <b>ExtraCheese:</b> '+data.result[i].extra_cheese;
                      html += ' <b>Sauces:</b> '+data.result[i].sauces;
                      html += ' <b>Vegetables:</b> '+data.result[i].vegetables;
                      html += ' <b>Extra Meat:</b> '+data.result[i].extra_meat_topping_is_free+'</td>';
                      html +='</tr>';

                      var subtotal = data.result[i].quantity * data.result[i].price;
                      total += subtotal; 
                      qty += data.result[i].quantity;
                    
                }
                html += '<tr>';
                html += '<th>items: '+ sno +'</th>';
                html += '<th>Quantity: '+qty+'</th>';
                html += '<th>Total: '+total+'</th>';
                html +='</tr>';


                $('#detail').html(html);
              }
              $('#orderdetailmodel').modal('show');

            }
          })


        });
      });
    </script>
@endsection