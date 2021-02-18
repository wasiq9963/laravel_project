@extends('subway.subwaydashboard')

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
                  <h1 class="card-title">All Users</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="float-right">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" id="addmodal">
                            <span class="fa fa-plus"></span> Add User
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Store</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if ($user)
                        @foreach ($user as $item)
                        <tr>
                            <td>{{$item -> id}}</td>
                            <td>{{$item -> name}}</td>
                            <td>{{$item -> email}}</td>
                            <td>{{$item -> role}}</td>
                            <td>{{$item -> store}}</td>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Store</th>
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

<div class="modal fade" id="usermodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="userform">
            @csrf
        <div class="modal-body">
              <span id="result"></span>
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="txt_name" id="txt_name" class="form-control" value="" placeholder="Enter User Name">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="txt_email" id="txt_email" class="form-control" value="" placeholder="Enter Email">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="text" name="password" id="password" class="form-control" value="" placeholder="Enter Password">
            </div>

            <div class="form-group">
                    <label for="">User Type</label>
                    <select name="role" id="role" class="form-control">
                        <option value="">Select User Type</option>
                        <option value="Store">Store</option>
                        <option value="OrderBooker">Order Booker</option>
                        <option value="Admin">Admin</option>
                        <option value="StoreAdmin">Store Admin </option>
                    </select>
            </div>
            <div class="form-group">
              <label for="">Store</label>
              <select name="store" id="store" class="form-control">
                  <option value="">Select Store</option>
                  @foreach ($store as $item)
                    <option value="{{$item -> storename}}">{{$item -> storename}}</option>
                      
                  @endforeach
                  
              </select>
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

<div class="modal fade" id="userdeletemodal">
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
        $('#usermodal').modal('show');
        $('.modal-title').text('Add User');
        $('#btnsubmit').html('Insert Record');
        $('#action').val('Add');
    });

// Set update model
    $('#example1 tbody').on('click','.editmodal',function(){
        
        var userid;
        userid = $(this).attr('id');
        $.ajax({
            url: '/user/edit/' + userid,
            datatype: 'json',
            success:function(data)
            {
                $('#txt_name').val(data.result.name);
                $('#txt_email').val(data.result.email);
                $('#password').val(data.result.password);
                $('#role').val(data.result.role);
                $('#store').val(data.result.store);

                $('#did').val(userid);

                $('#usermodal').modal('show');
                $('.modal-title').text('Update User');
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
            route_url = '/user/add';            
        }
        if ($('#action').val() == 'Edit')
        {
            route_url = '/user/update';            
        }
        $.ajax({
            type: 'POST',
            url: route_url,
            data: $('#userform').serialize(),
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
                    $('#userform')[0].reset();
                    setTimeout(function(){
                    $('#usermodal').modal('hide');
                    location.reload();
                    },2000); 
                }
                    $('#result').html(html);
            }
        })

    });

//Set delete modal
  $('#example1 tbody').on('click','.deletemodal',function(){
    $('#userdeletemodal').modal('show');
    var userid;
    userid = $(this).attr('id');
    $('#deletebtn').click(function(){
      $.ajax({
          url: '/user/delete/' + userid,
          success:function(data)
          {
            setTimeout(function()
            {
              $('#deletemodal').modal('hide');
              location.reload();
            },1000);           
          }
      })
    });
    });

});
</script>


@endsection