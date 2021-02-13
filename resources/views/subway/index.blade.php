@extends('subwaymaster')

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
  .test2 {
  white-space: nowrap; 
  width: 100px; 
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 1.3;
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
    <div class="col-md-4">
      <p class="font-weight-bold text-danger" id="result"></p>
      <div id="info"></div>
    
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
              <tr>
                <td colspan="2">Select Store</td>
                <td colspan="3">
                  <select name="store" id="store" class="form-control">
                    <option value="">Select Store</option>
                    @if ($store)
                      @foreach ($store as $item)
                        <option value="{{$item -> storename}}">{{$item -> storename}}</option>
                      @endforeach
                        
                    @endif
                  </select>
                  <p id="storeresult" class="font-weight-bold text-danger"></p>
                  <input type="hidden" id="cusname">
                </td>
              </tr>
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
      <form id="customerform">
          @csrf
          <div class="modal-body">
            <span id="cusresult"></span>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="name" id="" class="form-control" value="" placeholder="Enter Name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mobile Number</label>
                          <input type="number" name="mobile_number" id="" class="form-control" value="" placeholder="Enter Mobile Number">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Landline Number</label>
                          <input type="number" name="landline_number" id="" class="form-control" value="" placeholder="Enter Landline Number">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Contact Person</label>
                          <input type="number" name="contact_person" id="" class="form-control" value="" placeholder="Enter Contact Person">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Landmark</label>
                          <input type="text" name="landmark" id="" class="form-control" value="" placeholder="Enter Landmark">
                        </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Delivery Address</label>
                      <textarea name="address" class="form-control" id="" cols="30" rows="5" placeholder="Type Delivert Address"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Select Store</label>
                          <select class="form-control" name="store" id="">
                              <option value="">Select Store</option>
                              <option value="Store 1">Store 1</option>
                              <option value="Store 2">Store 2</option>
                              <option value="Store 3">Store 3</option>
                              <option value="Store 4">Store 4</option>
                              <option value="Store 5">Store 5</option>
                          </select>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Select Area</label>
                          <select class="form-control" name="area" id="" >
                              <option value="">Select Area</option>
                              <option value="a">a</option>
                              <option value="b">b</option>
                              <option value="c">c</option>
                              <option value="d">d</option>

                          </select>
                    </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Foodpanda Order?</label><br>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="customRadio" name="example" value="Yes" checked>
                        <label class="custom-control-label" for="customRadio">Yes</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="customRadio2" name="example" value="No">
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
            <span id="subresult"></span>
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
                        <input type="radio" id="extra3" id="extra" name="extra" class="custom-control-input" value="No" checked>
                        <label class="custom-control-label" for="extra3">No</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="extra4" id="extra" name="extra" value="Yes" class="custom-control-input">
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
                        <input type="checkbox" class="custom-control-input data" value="Lettuc" name="vegetable[]" id="vegetable1">
                        <label class="custom-control-label" for="vegetable1">Lettuc</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input data" value="Tomato" name="vegetable[]" id="vegetable2">
                        <label class="custom-control-label" for="vegetable2">Tomato</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input data" value="Capsicum" name="vegetable[]" id="vegetable3">
                        <label class="custom-control-label" for="vegetable3">Capsicum</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input data" value="Onion" name="vegetable[]" id="vegetable4">
                        <label class="custom-control-label" for="vegetable4">Onion</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input data" value="Cucumber" name="vegetable[]" id="vegetable5">
                        <label class="custom-control-label" for="vegetable5">Cucumber</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input data" value="Jalapenos" name="vegetable[]" id="vegetable6">
                        <label class="custom-control-label" for="vegetable6">Jalapenos</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input data" value="Olives" name="vegetable[]" id="vegetable7">
                        <label class="custom-control-label" for="vegetable7">Olives</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input data" value="Coleslaw" name="vegetable[]" id="vegetable8">
                        <label class="custom-control-label" for="vegetable8">Coleslaw</label>
                      </div>   
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input data" value="Pickles" name="vegetable[]" id="vegetable9">
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
          <input type="hidden" name="cartid" id="cartid">
          <input type="hidden" name="itemid" id="itemid">
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
              html += '<div class="card border-success" id="'+response.result[i].itemid+'" style="width:100%">';
              //html += '<img class="card-img-top imgclick" id="'+response.result[i].itemid+'" src="{{URL::to('/')}}/images/BBQ-Chicken.jpg" alt="Card image" width:"50px" height="50px">';
              html +='<a href="#" data-toggle="tooltip" title="'+response.result[i].itemname+'"><img class="card-img-top imgclick" id="'+response.result[i].itemid+'" src={{URL::to('/')}}/images/'+response.result[i].categoryid+'.jpg alt="Card image" width:"100px" height="100px">';
              html +='<div class="card-body bg-warning" style="padding: 5px;">';
              html +='<h5 class="card-text text-dark test2">'+response.result[i].itemname+'</h5>';
              html +='<h5 class="text-dark"> Rs: <b>'+response.result[i].price+'</b></h5> </a>';
              html +='<input type="hidden" name="price" id="price" value="'+response.result[i].price+'">';
              html +='<input type="hidden" name="did" id="did" value="'+response.result[i].itemid+'">';
              html +='<button type="button" id="'+response.result[i].itemid+'" class="btn btn-block btn-success btn-sm btncard">Add</button> ';
             // html +='<button type="button" id="'+response.result[i].pro_id+'" class="btn btn-primary btn-sm viewdetail">View Detail</button>';
              html +='</div></div></div>';
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
          $('[data-toggle="tooltip"]').tooltip();
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
                //alert(data.result);
                const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: data.result
              })
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
              var a = 0;
              var total = 0;
              for (let i = 0; i < len; i++)
              {
                a++;
                html += '<tr><td>'+data.result[i].item_name+'</td>';
                html += '<td>'+data.result[i].price+'</td>';
                html += '<td> <div class="input-group number-spinner"><span class="input-group-btn">';
                html += '<button id="'+data.result[i].id+'" class="btn btn-sm btn-outline-info" data-dir="dwn"><span class="fa fa-minus"></span></button></span>';
                html += '<input type="text" min="1" class="form-control form-control-sm" value="'+data.result[i].quantity+'"><span class="input-group-btn">';
                html += '<button id="'+data.result[i].id+'" class="btn btn-sm btn-outline-info" data-dir="up"><span class="fa fa-plus"></span></button></span></div> </td>';
                html += '<td>'+(data.result[i].price)*(data.result[i].quantity)+'</td>';
                html += '<td><button type="button" id="'+data.result[i].cartid+'" data-id="'+data.result[i].item_id+'" class="btn btn-info btn-sm detail">Detail</button>';
                html += '<button type="button" id="'+data.result[i].id+'" class="btn btn-danger btn-sm remove"><i class="fa fa-remove"></i></button></td>';
                  
                  var subtotal = (data.result[i].price)*(data.result[i].quantity);
                  total += subtotal;
              }
                html += '<tr class="bg-success"><td colspan="3"><h5>Total Items:</b> '+ a +' Total Qty: '+data.qtys+'</h5></td>';
                html += '<td colspan="2"><h5>Total: '+total+'</h5></td></tr>';
                html += '<tr><td colspan="2"><button id="btnclear" class="btn btn-block btn-outline-dark">Clear</button></td>';
                html += '<td colspan="3"><button id="btnorder" data-id="'+total+'" class="btn btn-block btn-outline-primary">Order Place</button></td></tr>';
              $('#cartitems').html(html);
            }
            else
            {
              html += '<tr><td class="font-weight-bold text-center text-danger" colspan="5">Cart Is Empty</td></tr>'
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
              //alert(data.result);
              const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: data.result
              })
            }
        });
    });

    //update cart
    //INCREMENT DECREMENT QTY WORK
    $(document).on('click', '.number-spinner button', function () {    
      var btn = $(this),
        oldValue = btn.closest('.number-spinner').find('input').val().trim(),
        newVal = 0;
        id = '';
    
      if (btn.attr('data-dir') == 'up')
      {
        newVal = parseInt(oldValue) + 1;
        id = btn.attr('id');
      } 
      else if (oldValue > 1) 
      {
        newVal = parseInt(oldValue) - 1;
        id = btn.attr('id');
      } 
      else
      {
        newVal = 1;
      }
      btn.closest('.number-spinner').find('input').val(newVal);
        //update cart
      $.ajax({
          url: '/subway/update-cart',
          data: {id:id, qty:newVal},
          datatype: 'json',
          success:function(data)
          {
            fetchcart();
            //alert(data.result);
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: data.result
              })
          }
      });
    });
    /*$(document).on('click','.update',function(){

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
    });*/

    //order place work
    $(document).on('click','#btnorder',function(){
      var totalamount = $(this).data('id');
      var store = $('#store').val();
      var cusid = $('#cusname').val();

      if (store == '' )
      {
        $('#storeresult').text('Please Select Sore First');
      }
      else if(cusid == '')
      {
        const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'info',
                title: 'Please select Customer'
              });
      }
      else
      {
          $.ajax({
          url: '/subway/order-place',
          data:{data:store,id:cusid},
          datatype: 'json',
          success:function(data)
          {
            $("#storeresult").load(location.href + " #storeresult");
            fetchcart();
            //alert(data.result);
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: data.result
              });
              $("#info").load(location.href + " #info");
              $('#store').val('');
              $('#cusname').val('');
              $('#contact').val('');
              
          }
        });
      }
    });

    //cart clear work
    $(document).on('click','#btnclear',function(){
      $.ajax({
        url: '/subway/cart-clear',
        datatype: 'json',
        success:function(data)
        {
          fetchcart();
          //alert(data.result);
          const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: data.result
              })
        }
      });
    });

    //contact work
    $(document).on('keyup','#contact',function(){
      var number = $(this).val();
      if (number.length == 11)
      {
        customerinfo(number);
        $("#result").load(location.href + " #result");

      }
      else if((number.length > 11) || (number.length < 11) )
      {
        $('#result').html('Incorrect Number');
        $("#info").load(location.href + " #info");
        $("#cusname").val('');

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
              if (response.result.mobile_number == number)
              {
                //alert(response.result.id);
                data="";
                data += '<div class="border rounded border-success bg-warning" style="padding: 10px">'
                data += '<lable><b>Name:</b> '+ response.result.name +'</lable>&nbsp;&nbsp;&nbsp;&nbsp;';
                data += '<lable><b>Phone No:</b> '+ response.result.mobile_number +'</lable> </br>';
                data += '<lable><b>Landmark: </b>'+ response.result.landmark +'</lable> &nbsp;&nbsp;&nbsp;&nbsp;';
                data += '<lable><b>Address:</b> '+ response.result.delivery_address +'</lable> </br>';
                data += '</div>';
                $('#info').html(data);
                $('#cusname').val(response.result.id);
              }
            }
            else
            {
              const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'info',
                title: response.error
              });
              $('#customermodal').modal('show');
              $('#btnsubmit').html('Insert Record');
            }  
          }
        });
    }
// Set customer insert model
  $('#btncustomer').click(function(){
    $('#customermodal').modal('show');
    $('#btnsubmit').html('Insert Record');
    $('#action').val('Add');
  });
    //insert request using ajax
  $('#btnsubmit').click(function(e){
    e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '/subwaycustomer/add',
        data: $('#customerform').serialize(),
        datatype: 'json',
        success: function(response)
        {
          var html = '';
          if (response.errors) 
          {
            html = "<div class ='alert alert-danger'>";
            for (var count = 0; count < response.errors.length; count++) 
            {
              html += '<p>' +response.errors[count] + '</p>';  
            }
            html += '</div>';
          }
          if (response.success)
          {
            html = '<div class = "alert alert-success">' +response.success+ '</div>';
            $('#customerform')[0].reset();
            setTimeout(function(){
              $('#customermodal').modal('hide');
            },2000); 
          }
            $('#cusresult').html(html);
            
        }

      });
  });

    //detail work
    $(document).on('click','.detail',function(){

      //$('#detailmodal').modal('show');
      var cartid = $(this).attr('id');
      var itemid = $(this).data('id');
      $('#cartid').val(cartid);
      $('#itemid').val(itemid);


      $.ajax({
        url: '/subway/fetch-sub-detail',
        data:{cartid:cartid, itemid:itemid},
        datatype: 'json',
        success:function(data)
        {
          if (data.result)
          {
            $('#id').val(data.result.cartitem_id);
            $('#cheese').val(data.result.cheese);
            $('#extracheese').val(data.result.extra_cheese);
            var b=data.result.sauces;
            var arr = b.split(",");
            //alert(arr.length);
            for(i=0;i<arr.length;i++)
            {console.log(arr[i]);
              $('[name="sauces[]"]').each(function(){
              //alert(arr[i]);
                if($(this).val()==arr[i])
                {
                  $(this).prop('checked', true);
                }
              })
            }
            var a=data.result.vegetables;
            var arrv = a.split(",");
            //alert(arr.length);
            for(x=0;x<arrv.length;x++)
            {
              $('[name="vegetable[]"]').each(function(){
              //alert(arr[i]);
                if($(this).val()==arrv[x])
                {
                  $(this).prop('checked', true);
                }
              })
            }
            /*$('#sauces').val(data.result.sauces);
            $('#extratopping').val(data.result.extra_topping);*/
            $('[name="extra"]').val(data.result.extra_meat_topping_is_free).prop("checked", true);
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
          html = '<div class = "alert alert-success">' +response.result+ '</div>';
          $('#subresult').html(html);

                    $('#detail')[0].reset();
                    setTimeout(function(){
                    $('#detailmodal').modal('hide');
                    $("#subresult").load(location.href + " #subresult");
                    },2000);

        }
        
      });
      
    });

    //INCREMENT DECREMENT QTY WORK
    /*$(document).on('click', '.number-spinner button', function () {    
      var btn = $(this),
        oldValue = btn.closest('.number-spinner').find('input').val().trim(),
        newVal = 0;
        id = '';
    
      if (btn.attr('data-dir') == 'up')
      {
        newVal = parseInt(oldValue) + 1;
        id = btn.attr('id');
      } 
      else if (oldValue > 1) 
        {
          newVal = parseInt(oldValue) - 1;
          id = btn.attr('id');
        } 
        else
        {
          newVal = 1;
        }
        btn.closest('.number-spinner').find('input').val(newVal);
    });*/
    });
  </script>
@endsection