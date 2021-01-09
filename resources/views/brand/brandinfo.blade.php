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
                  <h1 class="card-title">All Brands</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="float-right">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" id="addmodal">
                            <span class="fa fa-plus"></span> Add Brand
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
                    <th>Brand Name</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if ($brandinfo)
                        @foreach ($brandinfo as $item)
                        <tr>
                            <td>{{$item -> brand_id}}</td>
                            <td>{{$item -> brand_name}}</td>
                            <td>{{$item -> category_name}}</td>
                            <td>
                              <button type="button" class="btn btn-primary btn-xs editmodal"  id="{{$item -> brand_id}}"><span class="fa fa-edit"></span> Edit</button>
                              <button type="button" class="btn btn-danger btn-xs deletemodal" id="{{$item -> brand_id}}"><span class="fa fa-trash"></span> Delete</button>
                            </td>
                          </tr>  
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Brand Name</th>
                    <th>Category Name</th>
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

<div class="modal fade" id="brandmodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="brandform">
            @csrf
            <div class="modal-body">
              <span id="result"></span>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Brand Name</label>
                        <input type="text" name="brand_name" id="brand_name" class="form-control" value="{{old('brand_name')}}" placeholder="Enter Brand Name">
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

<div class="modal fade" id="branddeletemodal">
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
        $('#brandmodal').modal('show');
        $('.modal-title').text('Add Brand');
        $('#btnsubmit').html('Insert Record');
        $('#action').val('Add');
    });

// Set update model
    $('#example1 tbody').on('click','.editmodal',function(){
        
        var branduid;
        branduid = $(this).attr('id');
        $.ajax({
            url: '/brand/edit/' + branduid,
            datatype: 'json',
            success:function(data)
            {
                $('#brand_name').val(data.result.brand_name);
                $('#category').val(data.result.category_id);
                $('#did').val(branduid);

                $('#brandmodal').modal('show');
                $('.modal-title').text('Update Brand');
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
            route_url = '/brand/add';            
        }
        if ($('#action').val() == 'Edit')
        {
            route_url = '/brand/update';            
        }
        $.ajax({
            type: 'POST',
            url: route_url,
            data: $('#brandform').serialize(),
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
                    $('#brandform')[0].reset();
                    setTimeout(function(){
                    $('#brandmodal').modal('hide');
                    location.reload();
                    },2000); 
                }
                    $('#result').html(html);
            }
        })

    });

//Set delete modal
  $('#example1 tbody').on('click','.deletemodal',function(){
    $('#branddeletemodal').modal('show');
    var branddid;
    branddid = $(this).attr('id');
    $('#deletebtn').click(function(){
        $.ajax({
            url: '/brand/delete/' + branddid,
            success:function(data)
            {
            setTimeout(function()
            {
                $('#branddeletemodal').modal('hide');
                location.reload();
                alert('Data Deleted');
            },2000);           
            }
        })
    });

});
});
</script>


@endsection