
@extends('frontmaster')
@section('maincontent')
    
<div class="row">
  <div class="col-md-6">
    <br>
    <h3>Categories</h3>
            <select name="category" id="category" class="form-control">
            <option value="">Select Category</option>
            @foreach ($categories as $item)
                <option value="{{$item -> id}}">{{$item -> category_name}}</option>
            @endforeach
        </select>
  </div>
  <div class="col-md-6"></div>
</div>
<h1 class="text-center">Products</h1>
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-9">
        <div class="row" id="card" >
        </div>
      </div>
      <div class="col-md-3" style="background-color: #000">
      </div>
    </div>
  </div>
</div>
<!-- -----------view Detail MODEL START---------- -->
<div class="modal fade" id="viewdetailemodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Product Detail</h4>
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
                  <h1 id="proname"></h1>
                    <div class="caption">

                     <h4 id="price"></h4>
                    </div>
                    <div class="d-sm-flex justify-content-between">
                        <div class="occasional">
                            <h5 class="sp_title mb-3">Product Detail</h5>
                            <ul class="single_specific">
                             	<li>
                                Category :<span id="catname"> </span></li>
                                <li>
                                  Brand :<span id="brandname"> </span></li>
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
    $('#category').change(function(){

      var catid = $(this).val();
      fetchproduct(catid);
    });

    function fetchproduct(data = '')
    {
      $.ajax({
        url: '/mart/product',
        data: {data:data},
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
              html += '<div class="col-md-4 col-sm-4" style="width:100%;padding-bottom: 10px;">';
              html += '<div class="card" style="width:100%">';
              html +='<a href="#"><img class="card-img-top imgclick" id="'+response.result[i].pro_id+'" src={{URL::to('/')}}/images/'+response.result[i].image+' alt="Card image" width:"100%" height="250px"></a>';
              html +='<div class="card-body">';
              html +='<input type="hidden" name="did" id="did" value="'+response.result[i].pro_id+'">'
              html +='<button type="button" id="'+response.result[i].pro_id+'" class="btn btn-dark btncard">Add To Card</button> ';
             // html +='<button type="button" id="'+response.result[i].pro_id+'" class="btn btn-primary btn-sm viewdetail">View Detail</button>';
              html +='</div> </div> </div>';
             // html = '<h1>'+response.result[i].product_name+'</h1>';
              //alert(response.result[i].product_name);
            }
            $('#card').html(html);
            
          }
        }
      });
      
    }
    //single product work
  $(document).on('click','.imgclick',function(){

   var id = $(this).attr('id');
    $.ajax({
      url: 'mart/singlproduct',
      data: {id:id},
      datatype: 'json',
      success: function(data)
      {
        $('#image').attr('src','{{URL::to('/')}}/images/'+data.result.image);
        $('#proname').text(data.result.product_name);
        $('#price').text('Rs: '+data.result.price);
        $('#catname').text(data.result.category_name);
        $('#brandname').text(data.result.brand_name);
        $('#viewdetailemodal').modal('show');
      }
    });
  });
  //card work
  $(document).on('click','.btncard',function(){

    var id = $(this).attr('id');
    
    $.ajax({
      url: '/mart/add-to-cart',
      data: {id:id},
      datatype: 'json',
      success:function()
      {
        alert('ok');
      }
    });
  })
});
</script>

@endsection
