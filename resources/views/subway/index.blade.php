@extends('subwaymaster');

@section('maincontent')
<div class="row">
    <div class="col-md-6">
      <br>
      <h3>Categories</h3>
              <select name="category" id="category" class="form-control">
              <option value="">Select Category</option>
              @foreach ($categories as $item)
                  <option value="{{$item -> id}}">{{$item -> categoryname}}</option>
              @endforeach
          </select>
    </div>
    <div class="col-md-6"></div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-8">
          <div class="row" id="card" >
          </div>
        </div>
        <div class="col-md-4" >
       
            <table class="table table-info table-striped">
              <tr>
                <th>S.no</th>
                <th>Items</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Action</th>
              </tr>
    
              <?php 
                  $i =1;?>
                  @if (Cart::getcontent()->count() != 0)
                  @foreach ($result as $item)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item -> name}}</td>
                    <td>{{Cart::get($item -> id)->getPriceSum()}}</td><input type="hidden" id="price" class="form-control" value="{{$item -> price}}">
                    <td>
                      <div class="input-group mb-3">
                        <input type="number" min="1" name="qty" id="qty{{$item -> id}}" class="form-control " value="{{$item -> quantity}}">
                        <div class="input-group-append">
                          <span ><button type="button" id="{{$item -> id}}" class="btn text-primary btn-sm update"><i class="fa fa-pencil"></i></button></span>
                        </div>
                      </div>
    
                    </span>
                    </td>
                    <td>
                      <button type="button" id="{{$item -> id}}" class="btn text-danger btn-sm remove"><i class="fa fa-remove"></i></button>
                    </td>
                  </tr>
                  @endforeach
                  <tr class="bt-primary">
                    <td colspan="3">Total Items: <b>{{Cart::getContent()->count()}}</b> <br>
                      Total Quantity: <b>{{Cart::getTotalQuantity()}}</b>
                    </td>
                    <td colspan="2">Total Amount: <b>{{Cart::getTotal()}}</b></td>
                  </tr>
                  @endif
                  @if (Cart::getcontent()->count() == 0)
                      <td colspan="5" class="text-danger text-center">Cart is Empty</td>
                  @endif
            </table>
                
          </div>
      </div>
    </div>
  </div>
 <!-- -----------view Detail MODEL START---------- -->
<div class="modal fade" id="viewdetailemodal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Item Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editform">
            @csrf
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="thumb-image">
                      <img src="" id="image" class="img-fluid"> </div>
                  </div>
                  <div class="col-md-6">
                    <h1 id="itemname"></h1>
                      <div class="caption">
  
                       <h4 id="itemprice"></h4>
                      </div>
                      <div class="d-sm-flex justify-content-between">
                          <div class="occasional">
                              <h5 class="sp_title mb-3">Item Detail</h5>
                              <ul class="single_specific">
                                   <li>
                                  Category :<span id="catname"> </span></li>
                              </ul>
                              <span>Quantity :</span><input type="number" class="form-control" min="1" name="qty" value="1"><br>
                              <button type="submit" class="btn btn-info">
                                <i class="fa fa-cart-plus" aria-hidden="true"> Add To Card</i>
                            </button>
                          </div>
  
                      </div>
                  </div>
                </div>
                  
            </div>
        </form>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- -----------view Detail MODEL END---------- -->
  
  <script>
$(document).ready(function(){
    fetchproduct();
    $(document).on('keyup','#searchproduct',function(){
      var query = $(this).val();
      fetchproduct(null,query);
    });
    
    $('#category').change(function(){
      var catid = $(this).val();
      fetchproduct(catid,null);
    });

    function fetchproduct(data = '' , query = '')
    {
      $.ajax({
        url: '/subway/items',
        data: {data:data, query:query},
        datatype: 'json',
        success:function(response)
        {
          var len = 0;
          var html = '';
        if(response.result != null)
        {
              len = response.result.length;
        }
        if(len > 0)
        {
          for( i=0; i<len; i++)
          {
              //console.log(response.result[i].product_name);
              html += '<div class="col-md-2 col-sm-2" style="width:100%;padding-bottom: 10px;">';
              html += '<div class="card" style="width:100%">';
              //html += '<img class="card-img-top imgclick" id="'+response.result[i].itemid+'" src="{{URL::to('/')}}/images/BBQ-Chicken.jpg" alt="Card image" width:"50px" height="50px">';
              html +='<a href="#"><img class="card-img-top imgclick" id="'+response.result[i].itemid+'" src={{URL::to('/')}}/images/'+response.result[i].categoryid+'.jpg alt="Card image" width:"100px" height="100px"></a>';
              html +='<div class="card-body">';
              //html +='<p>'+response.result[i].itemname+'</p>'
              html +='<input type="hidden" name="did" id="did" value="'+response.result[i].itemid+'">';
              html +='<button type="button" id="'+response.result[i].itemid+'" class="btn btn-dark btn-sm btncard">Add To Card</button> ';
             // html +='<button type="button" id="'+response.result[i].pro_id+'" class="btn btn-primary btn-sm viewdetail">View Detail</button>';
              html +='</div> </div> </div>';
             // html = '<h1>'+response.result[i].product_name+'</h1>';
              //alert(response.result[i].product_name);
            }
            $('#card').html(html);
          }
          else
          {
            alert('No Record');
            //('#result').text();
          }
        }
        
      });
      
    }
    //single product work
    $(document).on('click','.imgclick',function(){

        var id = $(this).attr('id');
        $.ajax({
            url: '/subway/singleitem',
            data: {id:id},
            datatype: 'json',
            success: function(data)
            {
                $('#image').attr('src','{{URL::to('/')}}/images/'+data.result.categoryid+'.jpg');
                $('#itemname').text(data.result.itemname);
                $('#itemprice').text('Rs: '+data.result.price);
                $('#catname').text(data.result.categoryname);
                $('#viewdetailemodal').modal('show');
            }
        });
    });
    //card work
    $(document).on('click','.btncard',function(){

        var id = $(this).attr('id');

        $.ajax({
            url: '/subway/add-to-cart',
            data: {id:id},
            datatype: 'json',
            success:function(data)
            {
                alert(data.result);
            }
        });
    });

    //remove cart
    $(document).on('click','.remove',function(){

        var id = $(this).attr('id');
        $.ajax({
            url: '/subway/remove-cart',
            data: {id:id},
            datatype: 'json',
            success:function(data)
            {
                alert(data.result);
            }
        });
    });

    //update cart
    $(document).on('click','.update',function(){

        var id = $(this).attr('id');
        var qty = $('#qty'+id).val();
        $.ajax({
            url: '/subway/update-cart',
            data: {id:id, qty:qty},
            datatype: 'json',
            success:function(data)
            {
            alert(data.result);
            }
        });
    });
});
  </script>
@endsection