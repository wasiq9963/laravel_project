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
                  <h1 class="card-title">All Departments</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" id="btnaddmodal">
                        <span class="fa fa-plus"></span> Add Department
                      </button>
                  </ol>
                </div>
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" name="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Department Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if($depart_info)
                        @foreach ($depart_info as $item)
                        <tr>
                            <td>{{$item -> dep_id}}</td>
                            <td>{{$item -> department_name}}</td>
                            <td>
                              <button id="{{$item -> dep_id}}" class="btn btn-primary btn-xs btnedit"><span class="fa fa-edit"></span> Edit</button>
                              <button id="{{$item -> dep_id}}" name="btndelete" class="btn btn-danger btn-xs btndelete"><span class="fa fa-trash"></span> Delete</button>
                            </td>
                          </tr>
                        @endforeach
                    @endif
                  
                      
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>  
                    <th>Department Name</th>
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
  </section>
    
<!-- INSERT Modal -->

<div class="modal fade" id="addmodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addform">
            @csrf
            <div class="modal-body">
              <span id="result"></span>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Department Name</label>
                    <input type="text" name="department_name" id="department_name" class="form-control" value="{{old('department_name')}}" placeholder="Enter Department Name">
                  </div>
            </div>
            <input type="hidden" name="did" id="did">
          <input type="hidden" name="action" id="action" value="">
        </form>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id='btnadd' class="btn btn-primary btnadd"></button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- INSERT MODAL END-->

<!-- Delete Modal -->

<div class="modal fade" id="deletemodal">
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
<!-- Delete MODAL END-->

@section('javascript')
@parent
<script type="text/javascript">
    $(document).ready(function(){

      $('#btnaddmodal').click(function(){
        $('.modal-title').text('Add Department');
        $('#btnadd').html('Insert Record');
        $('#department_name').val('');
        $('#action').val('Add');
        $('#addmodal').modal('show');
      });
        //insert using ajax
        
          $("#btnadd").click(function(e){
            e.preventDefault();

            var route_url = '';

            if ($('#action').val() == 'Add') 
            {
              route_url = "/department/add";
              
            }
            if ($('#action').val() == 'Edit') 
            {
              route_url = "/department/update";             
            }
            
              $.ajax({
                  type: "POST",
                  url: route_url,
                  data:$('#addform').serialize(),
                  datatype:'json',
                  success: function (response) 
                  {
                    var html = '';
                    if (response.errors)
                    {
                      html = '<div class="alert alert-danger">';
                      for (var count = 0; count < response.errors.length; count++)
                      {
                        html += '<p>' + response.errors[count] + '</p>';
                      }
                      html += '</div>'; 
                    }
                    if (response.success)
                    {
                      html = '<div class="alert alert-success">' + response.success + '</div>';
                      $('#addform')[0].reset();
                      setTimeout(function(){
                        $('#addmodal').modal('hide')
                      location.reload()

                      },2000);
                    }
                      $('#result').html(html);
                  }
              });

            //step2 update
          });
           
        //update using ajax
        $('#example1 tbody').on('click','.btnedit',function(){
          //step1 fetch single record
            var id = $(this).attr('id');
            $.ajax({
              url: '/department/edit/' + id,
              dataType: 'json',
              success: function(data)
              {
                $('#department_name').val(data.result.department_name);
                $('#did').val(id);
                $('#addmodal').modal('show');
                $('.modal-title').text('Update Department');
                $('#action').val('Edit');
                $('#btnadd').html('Update Record');
              }
            });
        });
        //DELETE Work
        
        $('#example1 tbody').on('click','.btndelete',function(){
            //console.log($(this).attr('id'));
          var user_id;
            user_id = $(this).attr('id');
            //alert(user_id);
            $('#deletemodal').modal('show');

            $('#deletebtn').click(function(){
              $.ajax({
                  url: '/department/delete/' + user_id,
                  success:function(data)
                  {
                    setTimeout(function(){
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
@endsection
