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
      <form id="proform">
          @csrf
          <div class="modal-body">
            <span id="result"></span>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Sub Size</label>
                          <select class="form-control" name="" id="">
                              <option value="">Select Sub Size</option>
                              <option value="">6 Inch</option>
                              <option value="">12 Inch</option>
                              <option value="">Salad</option>
                          </select>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Extra Topping</label>
                          <select class="form-control" name="" id="" >
                              <option value="">Select Extra Topping</option>
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
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bread</label>
                          <select class="form-control" name="" id="">
                              <option value="">Select Bread</option>
                              <option value="">Honey Oat</option>
                              <option value="">Permesan Oregano</option>
                              <option value="">Wheat/Brown</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Toasted?</label><br>
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
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cheese</label>
                          <select class="form-control" name="" id="">
                              <option value="">No</option>
                              <option value="">White Cheese</option>
                              <option value="">Yellow Cheese</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Extra Cheese</label>
                          <select class="form-control" name="" id="">
                              <option value="">No</option>
                              <option value="">Single Extra</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
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
                html += '<td><div class="input-group mb-3">';
                html += '<input type="number" min="1" name="qty" id="qty'+data.result[i].cartid+'" class="form-control " value="'+data.result[i].quantity+'">';
                html += '<button type="button" id="'+data.result[i].cartid+'" class="btn btn-primary update"><i class="fa fa-pencil"></i></button> </div>'
                html += '<td>'+(data.result[i].price)*(data.result[i].quantity)+'</td>';
                html += '<td><button type="button" id="'+data.result[i].cartid+'" class="btn btn-info btn-sm detail"><i class="fa fa-remove"></i></button>';
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
    //customer work
    $(document).on('click','.detail',function(){

      $('#detailmodal').modal('show');
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
});
  </script>
@endsection