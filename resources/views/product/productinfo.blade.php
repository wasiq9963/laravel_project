@extends('adminlayout')

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
                <div class="col-sm-6">
                  <h1 class="card-title">All Products</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="float-right">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" id="addmodal">
                            <span class="fa fa-plus"></span> Add Product
                          </button>
                  </ol>
                </div>
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                 @if ($proinfo)
                    @foreach ($proinfo as $item)
                    <tr>
                        <td>{{$item -> pro_id}}</td>
                        <td>{{$item -> product_name}}</td>
                        <td>{{$item -> price}}</td>
                        <td><img src="{{URL::to('/')}}/images/{{$item -> image}}" width="70" class="img-thumbnail"></td>
                        <td>{{$item -> category_name}}</td>
                        <td>{{$item -> brand_name}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs editmodal"  id="{{$item -> pro_id}}"><span class="fa fa-edit"></span> Edit</button>
                            <button type="button" class="btn btn-danger btn-xs deletemodal" id="{{$item -> pro_id}}"><span class="fa fa-trash"></span> Delete</button>
                          </td>
                    </tr>
                        
                    @endforeach
                     
                 @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Brand Name</th>
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
    <!-- /.container-fluid -->
<!-- INSERT, UPDATE AND DELETE MODEL WORK -->

<!-- -----------INSERT AND UPDATE MODEL START---------- -->

<div class="modal fade" id="promodal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="proform">
            @csrf
            <div class="modal-body">
              <span id="result"></span>
              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" value="{{old('product_name')}}" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                          <label for="exampleInputEmail1">Product Price</label>
                          <input type="number" name="product_price" id="product_price" class="form-control" value="{{old('product_price')}}" placeholder="Enter Product Price">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload Product Image</label>
                        <div class="custom-file">
                            <input type="file" name="product_image" class="custom-file-input" id="product_image" onChange="readURL(this)">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <span id="stor_image"></span>
                    </div>
                    <div class="form-group">
                          <label for="exampleInputEmail1">Select Category</label>
                          <select class="form-control" name="category" id="category">
                              <option value="">Select Category</option>
                              @if ($catinfo)
                                  @foreach ($catinfo as $item)
                                      <option value="{{$item -> id}}">{{$item -> category_name}}</option>
                                      
                                  @endforeach
                                  
                              @endif
                          </select>
                    </div>
                    <div class="form-group">
                          <label for="exampleInputEmail1">Select Brand</label>
                          <select class="form-control" name="brand" id="brand" >
                              <option value="">Select Brand</option>
                              @if ($brandinfo)
                                  @foreach ($brandinfo as $item)
                                      <option value="{{$item -> brand_id}}">{{$item -> brand_name}}</option>
                                  @endforeach
                                  
                              @endif
                          </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="" id="proimg" class="img-thumbnail" width="250" height="250">
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

<!-- -----------INSERT AND UPDATE MODEL END---------- -->

<!-- -----------DELETE MODEL START---------- -->

<div class="modal fade" id="prodeletemodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Conformation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editform">
          @csrf
          <div class="modal-body">
              
                <h4 class="text-center">Are you sure you want to delete this data?</h4>
          </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id='deletebtn' name="deletebtn" class="btn btn-danger">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- -----------DELETE MODEL END---------- -->

  </section>
@endsection
@section('javascript')
    @parent

    <!-- AJAX INSERT,UPDATE AND DELETE WORK -->
<script>

$(document).ready(function(){

// Set insert model
    $('#addmodal').click(function(){
        $('#promodal').modal('show');
        $('.modal-title').text('Add Product');
        $('#btnsubmit').html('Insert Record');
        $('#action').val('Add');
        $('#proform')[0].reset();
    });

// Set update model
    $('#example1 tbody').on('click','.editmodal',function(){
        
        var prouid;
        prouid = $(this).attr('id');
        $.ajax({
            url: '/product/edit/' + prouid,
            datatype: 'json',
            success:function(data)
            {
                $('#product_name').val(data.result.product_name);
                $('#product_price').val(data.result.price);
                $('#stor_image').html("<img src={{URL::to('/')}}/images/" + data.result.image + " width='70' class='img-thumbnail'>");
                $('#stor_image').append('<input type="hidden" name="hidden_image" value="'+data.result.image+'"/>');
                $('#category').val(data.result.category_id);
                $('#brand').val(data.result.b_id);
                $('#did').val(prouid);

                $('#promodal').modal('show');
                $('.modal-title').text('Update Product');
                $('#btnsubmit').html('Update Record');
                $('#action').val('Edit');
            }
        })
    });

//insert
    $('#btnsubmit').click(function(e){
        e.preventDefault();
        var route_url;

        if ($('#action').val() == 'Add')
        {
            route_url = '/product/add';            
        }
        if ($('#action').val() == 'Edit')
        {
            route_url = '/product/update';            
        }
        var form_data = new FormData(document.getElementById('proform'));
        console.log(form_data);
        $.ajax({
            type: 'POST',
            url: route_url,
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
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
                    $('#proform')[0].reset();
                    setTimeout(function(){
                    $('#promodal').modal('hide');
                    location.reload();
                    },2000); 
                }
                    $('#result').html(html);
            }
        })

    });

//Set delete modal
  $('#example1 tbody').on('click','.deletemodal',function(){
    $('#prodeletemodal').modal('show');
    var prodid;
    prodid = $(this).attr('id');
    $('#deletebtn').click(function(){
        $.ajax({
            url: '/product/delete/' + prodid,
            success:function(data)
            {
            setTimeout(function()
            {
                $('#prodeletemodal').modal('hide');
                location.reload();
                alert('Data Deleted');
            },2000);           
            }
        })
    });

});
});
</script>

<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#proimg')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(250)
					.css( "visibility", "visible" );
					
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>   


@endsection