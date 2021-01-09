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
                  <h1 class="card-title">All Shifts</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="float-right">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" id="addmodal">
                            <span class="fa fa-plus"></span> Add Shift
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
                    <th>Shift Name</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Late</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if ($shiftinfo)
                        @foreach ($shiftinfo as $item)
                        <tr>
                            <td>{{$item -> s_id}}</td>
                            <td>{{$item -> shift_name}}</td>
                            <td>{{$item -> time_in}}</td>
                            <td>{{$item -> time_out}}</td>
                            <td>{{$item -> late}}min</td>
                            <td>
                              <button type="button" class="btn btn-primary btn-xs editmodal"  id="{{$item -> s_id}}"><span class="fa fa-edit"></span> Edit</button>
                              <button type="button" class="btn btn-danger btn-xs deletemodal" id="{{$item -> s_id}}"><span class="fa fa-trash"></span> Delete</button>
                            </td>
                          </tr>  
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Shift Name</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Late</th>
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

<div class="modal fade" id="shiftmodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="shiftform">
            @csrf
            <div class="modal-body">
              <span id="result"></span>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Shift Name</label>
                    <input type="text" name="txtshift_name" id="txtshift_name" class="form-control" value="{{old('txtshift_name')}}" placeholder="Enter Employee Name">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Time In</label>
                      <input type="time" name="txtshift_in" id="txtshift_in" class="form-control" value="{{old('txtshift_in')}}" placeholder="Enter Employee Phone_No">
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Time Out</label>
                    <input type="time" name="txtshift_out" id="txtshift_out" class="form-control" value="{{old('txtshift_out')}}" placeholder="Enter Employee Email">
                  </div>
                </div>
              </div>  
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Late</label>
                      <input type="number" name="txtshift_late" id="txtshift_late" class="form-control" value="{{old('txtshift_late')}}" placeholder="Enter Employee Address">
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

<div class="modal fade" id="shiftdeletemodal">
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
        $('#shiftmodal').modal('show');
        $('.modal-title').text('Add Shift');
        $('#btnsubmit').html('Insert Record');
        $('#action').val('Add');
    });

// Set update model
    $('#example1 tbody').on('click','.editmodal',function(){
        
        var shiftid;
        shiftid = $(this).attr('id');
        $.ajax({
            url: '/shift/edit/' + shiftid,
            datatype: 'json',
            success:function(data)
            {
                $('#txtshift_name').val(data.result.shift_name);
                $('#txtshift_in').val(data.result.time_in);
                $('#txtshift_out').val(data.result.time_out);
                $('#txtshift_late').val(data.result.late);
                $('#did').val(shiftid);

                $('#shiftmodal').modal('show');
                $('.modal-title').text('Update Shift');
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
            route_url = '/shift/add';            
        }
        if ($('#action').val() == 'Edit')
        {
            route_url = '/shift/update';            
        }
        $.ajax({
            type: 'POST',
            url: route_url,
            data: $('#shiftform').serialize(),
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
                    $('#shiftform')[0].reset();
                    setTimeout(function(){
                    $('#shiftmodal').modal('hide');
                    location.reload();
                    },2000); 
                }
                    $('#result').html(html);
            }
        })

    });

//Set delete modal
  $('#example1 tbody').on('click','.deletemodal',function(){
    $('#shiftdeletemodal').modal('show');
    var shiftid;
    shiftid = $(this).attr('id');
    $('#deletebtn').click(function(){
      $.ajax({
          url: '/shift/delete/' + shiftid,
          success:function(data)
          {
            setTimeout(function()
            {
              $('#deletemodal').modal('hide');
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