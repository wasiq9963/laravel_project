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
<!--<div class="row">
  <div class="col-md-4">
    <form class="form-inline mt-2 mt-md-0">
      <label for="">Contact Number:</label>&nbsp;
      <input class="form-control" id="contact" name="contact" type="number" placeholder="Type Number" >
    </form>
  </div>
</div>-->
 <div class="row" style="margin-top: 10px">
    <div class="col-md-4">
      <button type="button" class="btn  btn-outline-success" data-toggle="modal" id="btncustomer">New Customer</button>
      <button type="button" class="btn  btn-outline-primary">Add Form</button>

     <!-- <h3>Categories</h3>
              <select name="category" id="category" class="form-control">
              <option value="">Select Category</option>
              @foreach ($categories as $item)
                  <option value="{{$item -> id}}">{{$item -> categoryname}}</option>
              @endforeach
          </select>-->
    </div>
    <div class="col-md-4" id="result">
    
    </div>
    <div class="col-md-4">
      
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
       
            <table class="table table-striped carttable">
              <tr class="bg-success">
                <th>Items</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
              <tbody id="cartitems">

              </tbody>
    
              
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

<!-- -----------Detail MODEL START---------- -->

<div class="modal fade" id="detailmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sub Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="detail">
          @csrf
          <div class="modal-body">
            <span id="result"></span>
            <div class="row">
              <div class="col-md-12">
                <!--<div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Sub Size</label>
                          <select class="form-control" name="subsize" id="subsize">
                              <option value="none">Select Sub Size</option>
                              <option value="6 Inch">6 Inch</option>
                              <option value="12 Inch">12 Inch</option>
                              <option value="Salad">Salad</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Extra Topping</label>
                          <select class="form-control" name="extratopping" id="extratopping" >
                              <option value="none">Select Extra Topping</option>
                              <option value="Italian BMT">Italian BMT</option>
                              <option value="Spicy Italian">Spicy Italian</option>
                              <option value="Chicken Teriyaki">Chicken Teriyaki</option>
                              <option value="Steak & Cheese">Steak & Cheese</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bread</label>
                          <select class="form-control" name="bread" id="bread">
                              <option value="none">Select Bread</option>
                              <option value="Honey Oat">Honey Oat</option>
                              <option value="Permesan Oregano">Permesan Oregano</option>
                              <option value="Wheat/Brown">Wheat/Brown</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Toasted?</label><br>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" value="Yes" name="toasted" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1">Yes</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" value="No" name="toasted" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">No</label>
                          </div>                  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>-->
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cheese</label>
                          <select class="form-control" name="cheese" id="cheese">
                              <option value="No">No</option>
                              <option value="White Cheese">White Cheese</option>
                              <option value="Yellow Cheese">Yellow Cheese</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Extra Cheese</label>
                          <select class="form-control" name="extracheese" id="extracheese">
                              <option value="No">No</option>
                              <option value="Single Extra">Single Extra</option>
                          </select>
                        </div>
                      </div>
                    </div> 
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Extra Meat Topping Is Free</label><br>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="extra3" name="extra" class="custom-control-input" value="No" checked>
                        <label class="custom-control-label" for="extra3">No</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="extra4" name="extra" value="Yes" class="custom-control-input">
                        <label class="custom-control-label" for="extra4">Yes</label>
                      </div>                  
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Vegetables?</label><br> 
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Lettuc" name="vegetable[]" id="vegetable1">
                        <label class="custom-control-label" for="vegetable1">Lettuc</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Tomato" name="vegetable[]" id="vegetable2">
                        <label class="custom-control-label" for="vegetable2">Tomato</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Capsicum" name="vegetable[]" id="vegetable3">
                        <label class="custom-control-label" for="vegetable3">Capsicum</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Onion" name="vegetable[]" id="vegetable4">
                        <label class="custom-control-label" for="vegetable4">Onion</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Cucumber" name="vegetable[]" id="vegetable5">
                        <label class="custom-control-label" for="vegetable5">Cucumber</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Jalapenos" name="vegetable[]" id="vegetable6">
                        <label class="custom-control-label" for="vegetable6">Jalapenos</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Olives" name="vegetable[]" id="vegetable7">
                        <label class="custom-control-label" for="vegetable7">Olives</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Coleslaw" name="vegetable[]" id="vegetable8">
                        <label class="custom-control-label" for="vegetable8">Coleslaw</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Pickles" name="vegetable[]" id="vegetable9">
                        <label class="custom-control-label" for="vegetable9">Pickles</label>
                      </div>                  
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sauces?</label><br> 
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Thousand Island" name="sauces[]" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Thousand Island</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Mayonaise" name="sauces[]" id="customCheck2">
                        <label class="custom-control-label" for="customCheck2">Mayonaise</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Ketchup" name="sauces[]" id="customCheck3">
                        <label class="custom-control-label" for="customCheck3">Ketchup</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Chilli Garlic" name="sauces[]" id="customCheck4">
                        <label class="custom-control-label" for="customCheck4">Chilli Garlic</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Southwest" name="sauces[]" id="customCheck5">
                        <label class="custom-control-label" for="customCheck5">Southwest</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Honey mustard" name="sauces[]" id="customCheck6">
                        <label class="custom-control-label" for="customCheck6">Honey mustard</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Mustard" name="sauces[]" id="customCheck7">
                        <label class="custom-control-label" for="customCheck7">Mustard</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Ceaser garlic" name="sauces[]" id="customCheck8">
                        <label class="custom-control-label" for="customCheck8">Ceaser garlic</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Sweet onion" name="sauces[]" id="customCheck9">
                        <label class="custom-control-label" for="customCheck9">Sweet onion</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="BBQ sauce" name="sauces[]" id="customCheck10">
                        <label class="custom-control-label" for="customCheck10">BBQ sauce</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Hot sauce" name="sauces[]" id="customCheck11">
                        <label class="custom-control-label" for="customCheck11">Hot sauce</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Olive oil" name="sauces[]" id="customCheck12">
                        <label class="custom-control-label" for="customCheck12">Olive oil</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Cheesy Mayo" name="sauces[]" id="customCheck13">
                        <label class="custom-control-label" for="customCheck13">Cheesy Mayo</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" value="Vinegar Sauce" name="sauces[]" id="customCheck14">
                        <label class="custom-control-label" for="customCheck14">Vinegar Sauce</label>
                      </div>                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="id" id="id">
        <input type="hidden" name="action" id="action" value="">
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id='btnsubmit' class="btn btn-primary btnadd">Submit</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- -----------Detail MODEL END---------- -->

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
              html += '<div class="col-md-2 col-sm-2" style="width:100%;padding-bottom: 10px;">';
              html += '<div class="card border-success" style="width:100%">';
              //html += '<img class="card-img-top imgclick" id="'+response.result[i].itemid+'" src="{{URL::to('/')}}/images/BBQ-Chicken.jpg" alt="Card image" width:"50px" height="50px">';
              html +='<a href="#"><img class="card-img-top imgclick" id="'+response.result[i].itemid+'" src={{URL::to('/')}}/images/'+response.result[i].categoryid+'.jpg alt="Card image" width:"100px" height="100px"></a>';
              html +='<div class="card-body bg-warning" style="padding: 5px;">';
              //html +='<p>'+response.result[i].itemname+'</p>';
              html +='<p class="text-success"> Rs: <b>'+response.result[i].price+'</b></p>';
              html +='<input type="hidden" name="price" id="price" value="'+response.result[i].price+'">';
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
    fetchcart();
    //card work
    $(document).on('click','.btncard',function(){

        var id = $(this).attr('id');

        $.ajax({
            url: '/subway/add-to-cart',
            data: {id:id},
            datatype: 'json',
            success:function(data)
            {
                fetchcart();
                alert(data.result);
            }
        });
    });
//get cart items
function fetchcart()
{
  $.ajax({
          url: '/subway/get-cart-items',
          datatype: 'json',
          success:function(data)
          {
            var len = 0;
            var html = '';
            if (data.result != '')
            {
              len = data.result.length;
            }
            if (len >0)
            {
              $a = 0;
              var total,qtys,items;
              for (let i = 0; i < len; i++)
              {
                $a++;
                html += '<tr><td>'+data.result[i].item_name+'</td>';
                html += '<td>'+data.result[i].price+'</td>';
                html += '<td><div class="input-group input-group-sm">';
                html += '<input type="number" min="1" name="qty" id="qty'+data.result[i].cartid+'" class="form-control" value="'+data.result[i].quantity+'">';
                html += '<button type="button" id="'+data.result[i].cartid+'" class="btn btn-primary btn-sm update"><i class="fa fa-plus"></i></button> </div>'
                html += '<td>'+(data.result[i].price)*(data.result[i].quantity)+'</td>';
                html += '<td><button type="button" id="'+data.result[i].cartid+'" class="btn btn-info btn-sm detail">Detail</button>';
                html += '<button type="button" id="'+data.result[i].cartid+'" class="btn btn-danger btn-sm remove"><i class="fa fa-remove"></i></button></td>';
              }
                html += '<tr class="bg-success"><td colspan="3">Total Items: '+ $a +' Total Qty: '+data.qtys+'</td>';
                html += '<td colspan="2">Total:'+total+'</td></tr>'
              $('#cartitems').html(html);
            }
          }
      });
}

    //remove cart
    $(document).on('click','.remove',function(){

        var id = $(this).attr('id');
        $.ajax({
            url: '/subway/remove-cart',
            data: {id:id},
            datatype: 'json',
            success:function(data)
            {
                fetchcart();
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
              fetchcart();
              alert(data.result);
            }
        });
    });

    //customer work
    $('#btncustomer').click(function(){

      $('#customermodal').modal('show');
    });

    var data = '';
     /* data += '<table class="border rounded border-success bg-warning" style="padding: 10px">';
      data += '<tr><th>Phone No</th><td></td><td> 03122609768</td></tr>';
      data += '<tr><th>Address</th><td></td><td> FB Area Azizabad</td></tr>';
      data += '<tr><th>Landmark</th><td></td><td> Mukka Chok</td></tr>'; 
      data+='</table>'; */

    //contact work
    $(document).on('keyup','#contact',function(){
      var number = $(this).val();
      if (number.length == 10)
      {
        customerinfo(number);
      }
      else if((number.length > 10) || (number.length < 10) )
      {
        $('#result').html('Incorrect Number');
      }
      else
      {
        $('#result').html('');
      }
    });

    function customerinfo(number='')
    {
      $.ajax({
          url: '/subway/customer',
          data: {data:number},
          datatype: 'json',
          success:function(response)
          {
            if (response.result)
            {
              if (response.result.cus_phoneno == number)
              {
                alert(response.result.id);
                data += '<div class="border rounded border-success bg-warning" style="padding: 10px">'
                data += '<lable><b>Name:</b> '+ response.result.cus_name +'</lable>&nbsp;&nbsp;&nbsp;&nbsp;';
                data += '<lable><b>Phone No:</b> '+ response.result.cus_phoneno +'</lable> </br>';
                data += '<lable><b>Address:</b> '+ response.result.cus_address +'</lable> &nbsp;&nbsp;&nbsp;&nbsp;';
                data += '<lable><b>Landmark: </b>Mukka Chok</lable> </br>';
                data += '</div>';
                $('#result').html(data);
              }
            }
            else
            {
              alert(response.error);
              $('#customermodal').modal('show');
            }  
          }
        });
    }
    //detail work
    $(document).on('click','.detail',function(){

      //$('#detailmodal').modal('show');
      var id = $(this).attr('id');
      $('#id').val(id);

      $.ajax({
        url: '/subway/fetch-sub-detail',
        data:{data:id},
        datatype: 'json',
        success:function(data)
        {
          if (data.result)
          {
            $('#id').val(data.result.cartitem_id);
            /*$('#subsize').val(data.result.sub_size);
            $('#extratopping').val(data.result.extra_topping);
            $('#bread').val(data.result.bread);
            $('#toasted').val(data.result.toasted);
            $('#subsize').val(data.result.sub_size);*/
            $('#cheese').val(data.result.cheese);
            $('#extracheese').val(data.result.extra_cheese);
            /*$('#sauces').val(data.result.sauces);
            $('#extratopping').val(data.result.extra_topping);*/
            $('#extra').val(data.result.extra_meat_topping_is_free);
            $('#detailmodal').modal('show');
          }
          if (data.error)
          {
            $('#detail')[0].reset();
            $('#detailmodal').modal('show');  
          }
        }
      });

    });
    // add sub detail
    $(document).on('click','.btnadd',function(e){
      e.preventDefault();
      $.ajax({
        url: '/subway/sub-detail',
        data: $('#detail').serialize(),
        datatype: 'json',
        success: function(response)
        {
          $('#detail')[0].reset();
          $('#detailmodal').modal('hide');
          alert(response.result);
        }
      });
      
    });
});
  </script>
@endsection