@extends('subwaymaster');
<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
  </style>

@section('maincontent')
<div class="row">
  <div class="col-md-4">
    <form class="form-inline mt-2 mt-md-0">
      <label for="">Contact Number:</label>&nbsp;
      <input class="form-control mr-sm-2" id="contact" name="contact" type="number" placeholder="Type Number" >
    </form>
  </div>
  <div class="col-md-4" id="result">
    
  </div>
  <div class="col-md-4" id="result">
    
  </div>
</div>
 <div class="row" style="margin-top: 10px">
    <div class="col-md-12">
      <button type="button" class="btn  btn-outline-success" data-toggle="modal" id="btncustomer">Customer</button>
      <button type="button" class="btn  btn-outline-primary">Add Form</button>

     <!-- <h3>Categories</h3>
              <select name="category" id="category" class="form-control">
              <option value="">Select Category</option>
              @foreach ($categories as $item)
                  <option value="{{$item -> id}}">{{$item -> categoryname}}</option>
              @endforeach
          </select>-->
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-8">
          <div class="row" id="card" >
          </div>
        </div>
        <div class="col-md-4" >
       
            <table class="table table-striped">
              <tr class="bg-success">
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
                  <tr class="bg-warning">
                    <td>{{$i++}}</td>
                    <td>{{$item -> name}}</td>
                    <td>{{Cart::get($item -> id)->getPriceSum()}}</td><input type="hidden" id="price" class="form-control" value="{{$item -> price}}">
                    <td>
                      <div class="input-group mb-3">
                        <input type="number" min="1" name="qty" id="qty{{$item -> id}}" class="form-control " value="{{$item -> quantity}}">
                        <div class="input-group-append">
                          <button type="button" id="{{$item -> id}}" class="btn btn-primary update"><i class="fa fa-pencil"></i></button>
                        </div>
                      </div>
    
                    </span>
                    </td>
                    <td>
                      <button type="button" id="{{$item -> id}}" class="btn btn-danger remove"><i class="fa fa-remove"></i></button>
                    </td>
                  </tr>
                  @endforeach
                  <tr class="bg-success">
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

<!-- -----------Customer MODEL START---------- -->

<div class="modal fade" id="customermodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Customer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="proform">
          @csrf
          <div class="modal-body">
            <span id="result"></span>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mobile Number</label>
                      <input type="number" name="" id="" class="form-control" value="923123456789" placeholder="Enter Mobile Number">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Landline Number</label>
                      <input type="number" name="" id="" class="form-control" value="01236315347" placeholder="Enter Landline Number">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Contact Person</label>
                          <input type="number" name="" id="" class="form-control" value="923123456789" placeholder="Enter Contact Person">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Landmark</label>
                          <input type="text" name="" id="" class="form-control" value="abc Area" placeholder="Enter Landmark">
                        </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Delivery Address</label>
                      <textarea name="" class="form-control" id="" cols="30" rows="5" placeholder="Type Delivert Address">FB Area Azizabad Karachi</textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Select Store</label>
                          <select class="form-control" name="" id="">
                              <option value="">Select Store</option>
                              <option value="">Store 1</option>
                              <option value="">Store 2</option>
                              <option value="">Store 3</option>
                              <option value="">Store 4</option>
                              <option value="">Store 5</option>
                          </select>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Select Area</label>
                          <select class="form-control" name="" id="" >
                              <option value="">Select Area</option>
                              <option value="">a</option>
                              <option value="">b</option>
                              <option value="">c</option>
                              <option value="">d</option>

                          </select>
                    </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Foodpanda Order?</label><br>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="customRadio" name="example" value="customEx" checked>
                        <label class="custom-control-label" for="customRadio">Yes</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="customRadio2" name="example" value="customEx">
                        <label class="custom-control-label" for="customRadio2">No</label>
                      </div>                   
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="did" id="did">
        <input type="hidden" name="action" id="action" value="">
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id='btnsubmit' class="btn btn-primary btnadd"></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- -----------Customer MODEL END---------- -->

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
    
    //fetch record using dropdown change  event
    /*$('#category').change(function(){
      var catid = $(this).val();
      fetchproduct(catid,null);
    });*/

    //fetch record using click event
    $('.catid').click(function(){
      var catid = $(this).data('postId');
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
              html += '<div class="col-md-3 col-sm-3" style="width:100%;padding-bottom: 10px;">';
              html += '<div class="card border-success" style="width:100%">';
              //html += '<img class="card-img-top imgclick" id="'+response.result[i].itemid+'" src="{{URL::to('/')}}/images/BBQ-Chicken.jpg" alt="Card image" width:"50px" height="50px">';
              html +='<a href="#"><img class="card-img-top imgclick" id="'+response.result[i].itemid+'" src={{URL::to('/')}}/images/'+response.result[i].categoryid+'.jpg alt="Card image" width:"100px" height="100px"></a>';
              html +='<div class="card-body bg-warning">';
              //html +='<p>'+response.result[i].itemname+'</p>';
              html +='<p class="text-success"> Rs: <b>'+response.result[i].price+'</b></p>';
              html +='<input type="hidden" name="did" id="did" value="'+response.result[i].itemid+'">';
              html +='<button type="button" id="'+response.result[i].itemid+'" class="btn btn-block btn-success btn-sm btncard">Add</button> ';
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

    //customer work
    $('#btncustomer').click(function(){

      $('#customermodal').modal('show');
    });

    var data = '';
    data += '<div class="border rounded border-success bg-warning" style="padding: 10px">'
    data += '<lable><b>Name:</b> Wasiq Ali</lable> <b>|</b>';
    data += '<lable><b>Email: </b>wasiq5884@gmail.com</lable> </br>';
    data += '<lable><b>Phone No: </b>03122609768</lable> <b>|</b>';
    data += '<lable><b>Address: </b>FB Area</lable>';
    data += '</div>';
    //contact work
    $(document).on('keyup','#contact',function(){
      var number = $(this).val();
      if (number.length == 11)
      {
        $('#result').html(data);
      }
      else if((number.length > 11) || (number.length < 11) )
      {
        $('#result').html('Incorrect Number');
      }
      else
      {
        $('#result').html('');
      }
    });

});
  </script>
@endsection