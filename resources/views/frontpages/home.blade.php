
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

<div class="row my-lg-5 mb-5" id="card" >

</div>
@section('javascript')
@parent
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
              html += '<div class="col-md-4">';
              html += '<div class="card" style="width: 18rem;">';
              html +='<img class="card-img-top" src={{URL::to('/')}}/images/'+response.result[i].image+' alt="Card image" style="width:100%">';
              html +='<div class="card-body">';
              html += '<h5 class="card-title">'+ response.result[i].product_name +'</h5>';
              html +='<p class="card-text">Price:<b>'+ response.result[i].price +'</b></p>';
              html +='<a href="#" class="btn btn-dark">Add To Card</a>';
              html +='</div> </div> </div>';
             // html = '<h1>'+response.result[i].product_name+'</h1>';
              //alert(response.result[i].product_name);
            }
            $('#card').html(html);
            
          }
        }
      });
      
    }

  });
</script>
@endsection
@endsection
