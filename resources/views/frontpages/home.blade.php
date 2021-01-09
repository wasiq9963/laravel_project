
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

<div id="card"></div>
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
          var html;
        if(response.result != null)
        {
              len = response.result.length;
        }
        if(len > 0)
        {
          for( response.result )
          {
              console.log(response.result[i].product_name);
              /*html = '<div class="card" style="width: 18rem;">';
              html +='<img class="card-img-top" src={{URL::to('/')}}/images/'+responce.result[i].image+' alt="Card image cap">';
              html +='<div class="card-body">';
              html += '<h5 class="card-title">'+ responce.result[i].product_name +'</h5>';
              html +='<p class="card-text">Price:<b>'+ responce.result[i].price +'</b></p>';
              html +='<a href="#" class="btn btn-dark">Add To Card</a>';
              html +='</div> </div>';*/
              html = '<h1>'+response.result[i].product_name+'</h1>';
              $('#card').html(html);

            }
            
          }
        }
      });
      
    }

  });
</script>
@endsection
@endsection
