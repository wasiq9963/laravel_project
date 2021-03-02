@extends('subway.subwaylayout')

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
                  <h1 class="card-title">All Stores</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="float-right">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" id="addmodal">
                            <span class="fa fa-plus"></span> Add Store
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
                    <th>Store Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if ($storeinfo)
                        @foreach ($storeinfo as $item)
                        <tr>
                            <td>{{$item -> id}}</td>
                            <td>{{$item -> storename}}</td>
                            <td>
                              <button type="button" class="btn btn-primary btn-xs editmodal"  id="{{$item -> id}}"><span class="fa fa-edit"></span> Edit</button>
                              <button type="button" class="btn btn-danger btn-xs deletemodal" id="{{$item -> id}}"><span class="fa fa-trash"></span> Delete</button>
                            </td>
                          </tr>  
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
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

<div class="modal fade" id="storemodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="storeform">
            @csrf
            <div class="modal-body">
              <span id="result"></span>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Store Name</label>
                        <input type="text" name="storename" id="storename" class="form-control" value="{{old('catname')}}" placeholder="Enter Store Name">
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

<div class="modal fade" id="storedeletemodal">
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
        $('#storemodal').modal('show');
        $('.modal-title').text('Add Store');
        $('#btnsubmit').html('Insert Record');
        $('#action').val('Add');
        $("#storeform").get(0).reset();
    });

// Set update model
    $('#example1 tbody').on('click','.editmodal',function(){
      $("#result").load(location.href + " #result");

        
        var storeid;
        storeid = $(this).attr('id');
        $.ajax({
            url: 'store/edit/' + storeid,
            datatype: 'json',
            success:function(data)
            {
                $('#storename').val(data.result.storename);
                $('#did').val(storeid);

                $('#storemodal').modal('show');
                $('.modal-title').text('Update Store');
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
            route_url = 'store/add';            
        }
        if ($('#action').val() == 'Edit')
        {
            route_url = 'store/update';            
        }
        $.ajax({
            type: 'POST',
            url: route_url,
            data: $('#storeform').serialize(),
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
                    $('#storeform')[0].reset();
                    setTimeout(function(){
                    $('#storemodal').modal('hide');
                    location.reload();
                    },2000); 
                }
                    $('#result').html(html);
            }
        })

    });

//Set delete modal
  $('#example1 tbody').on('click','.deletemodal',function(){
    $('#storedeletemodal').modal('show');
    var storeid;
    storeid = $(this).attr('id');
    $('#deletebtn').click(function(){
        $.ajax({
            url: 'store/delete/' + storeid,
            success:function(data)
            {
              $('#storedeletemodal').modal('hide');
              location.reload();           
            }
        })
    });

});
});
</script>


@endsection