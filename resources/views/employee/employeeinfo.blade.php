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
                  <h1 class="card-title">All Employees</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="float-right">
                    <li class="breadcrumb-item">
                        <button type="button" class="btn btn-primary" data-toggle="modal" id="addmodal">
                            <span class="fa fa-plus"></span> Add Employee
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
                    <th>Full Name</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Shift</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @if ($empinfo)
                    @foreach ($empinfo as $item)
                    <tr>
                      <td>{{$item -> id}}</td>
                      <td>{{$item -> emp_name}}</td>
                      <td>+92{{$item -> emp_phoneno}}</td>
                      <td>{{$item -> emp_email}}</td>
                      <td>{{$item -> department_name}}</td>
                      <td>{{$item -> shift_name}}</td>
                      <td>{{$item -> emp_salary}}</td>
  
                      <td>
                        <button type="button" class="btn btn-warning btn-xs viewemodal" id="{{$item -> id}}"><span class="fa fa-sticky-note"></span> View</button>
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
                    <th>Full Name</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Shift</th>
                    <th>Salary</th>
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

<div class="modal fade" id="empmodal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="empform">
            @csrf
            <div class="modal-body">
              <span id="result"></span>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" name="txtemp_name" id="txtemp_name" class="form-control" value="{{old('txtemp_name')}}" placeholder="Enter Employee Name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone No</label>
                    <input type="number" name="txtemp_phoneno" id="txtemp_phoneno" class="form-control" value="{{old('txtemp_phoneno')}}" placeholder="Enter Employee Phone_No">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="txtemp_email" id="txtemp_email" class="form-control" value="{{old('txtemp_email')}}" placeholder="Enter Employee Email">
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Salary</label>
                    <input type="number" name="txtemp_salary" id="txtemp_salary" class="form-control" value="{{old('txtemp_salary')}}" placeholder="Enter Employee Salary">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Address</label>
                    <textarea name="txtemp_address" id="txtemp_address" cols="15" class="form-control" rows="4"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Qualification</label>
                    <input type="text" name="txtemp_qualification" id="txtemp_qualification" class="form-control" value="{{old('txtemp_qualification')}}" placeholder="Enter Qualification">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date Of Birth</label>
                        <input type="Date" name="txtemp_dob" id="txtemp_dob" class="form-control" value="{{old('txtemp_dob')}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">CNIC</label>
                        <input type="number" name="txtemp_cnic" id="txtemp_cnic" class="form-control" value="{{old('txtemp_cnic')}}" placeholder="Enter CNIC">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row"> 
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Department</label>
                    <select class="form-control" style="width: 100%;" id="department" name="department">
                        <option value="">Select Department</option>
                        @if ($depinfo)
                          @foreach ($depinfo as $item)
                              <option value="{{$item -> dep_id}}">{{$item -> department_name}}</option>
                          @endforeach
                        @endif
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Shift</label>
                    <select class="form-control" style="width: 100%;" id="shift" name="shift">
                        <option value="">Select Shift</option>
                        @if ($shift)
                          @foreach ($shift as $item)
                              <option value="{{$item -> s_id}}">{{$item -> shift_name}}</option>
                          @endforeach
                        @endif
                    </select>
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date Of Join</label>
                        <input type="Date" name="txtemp_doj" id="txtemp_doj" class="form-control" value="{{old('txtemp_doj')}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date Of Last</label>
                        <input type="date" name="txtemp_dol" id="txtemp_dol" class="form-control" value="{{old('txtemp_dol')}}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">NTN</label>
                        <input type="number" name="txtemp_ntn" id="txtemp_ntn" class="form-control" placeholder="Enter NTN Number"  value="{{old('txtemp_ntn')}}">
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

<div class="modal fade" id="empdeletemodal">
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

<!-- -----------View MODEL START---------- -->

<div class="modal fade " id="empviewmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Employee Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <label for="">ID: </label> <span id="id"> </span><br>
                <label for="">Full Name: </label> <span id="fn"> </span><br>
                <label for="">Phone No: </label> <span id="ph"> </span><br>
                <label for="">Email: </label> <span id="email"> </span><br>
                <label for="">Salary: </label> <span id="salary"> </span><br>
                <label for="">Address: </label> <span id="address"> </span><br>
                <label for="">Qualification: </label> <span id="qualification"> </span>
              </div>
              <div class="col-md-6">
                <label for="">Date of Birth: </label> <span id="dob"> </span><br>
                <label for="">CNIC: </label> <span id="cnic"> </span><br>
                <label for="">NTN Number: </label> <span id="ntn"> </span><br>
                <label for="">Department: </label> <span id="dep"> </span><br>
                <label for="">Shift: </label> <span id="sh"> </span><br>
                <label for="">Date of Join: </label> <span id="doj"> </span><br>
                <label for="">Date of Last: </label> <span id="dol"> </span><br>
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

<!-- -----------View MODEL END---------- -->


  </section>
@endsection
@section('javascript')
    @parent

    <!-- AJAX INSERT,UPDATE AND DELETE WORK -->
<script>

$(document).ready(function(){

// Set insert model
  $('#addmodal').click(function(){
    $('#empmodal').modal('show');
    $('.modal-title').text('Add Employee');
    $('#btnsubmit').html('Insert Record');
    $('#action').val('Add');
  });

// Set update model
  $('#example1 tbody').on('click','.editmodal',function(){
    var empuid ;
    empuid = $(this).attr('id');
    $.ajax({
      url: '/employee/edit/' + empuid,
      datatype: 'json',
      success: function(data)
      {
        $("#txtemp_name").val(data.result.emp_name);
        $("#txtemp_phoneno").val(data.result.emp_phoneno);
        $("#txtemp_email").val(data.result.emp_email);
        $("#txtemp_salary").val(data.result.emp_salary);
        $("#txtemp_address").val(data.result.emp_address);
        $("#txtemp_qualification").val(data.result.qualification);
        $("#txtemp_dob").val(data.result.dob);
        $("#txtemp_cnic").val(data.result.cnic);
        $("#txtemp_ntn").val(data.result.ntn);
        $("#department").val(data.result.department_id);
        $("#shift").val(data.result.shift_id);
        $("#txtemp_doj").val(data.result.doj);
        $("#txtemp_dol").val(data.result.dol);
        $("#did").val(empuid);

        $('#empmodal').modal('show');
        $('.modal-title').text('Update Employee');
        $('#btnsubmit').html('Update Record');
        $('#action').val('Edit');
      }
    })
  });

  //insert request using ajax
  $('#btnsubmit').click(function(e){
    e.preventDefault();

      var route_url;
      if ($("#action").val() == 'Add') 
      {
        route_url = '/employee/add';
        
      }
      if ($("#action").val() == 'Edit') 
      {
        route_url = '/employee/update';
        
      }

      $.ajax({
        type: 'POST',
        url: route_url,
        data: $('#empform').serialize(),
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
            $('#empform')[0].reset();
            setTimeout(function(){
              $('#empmodal').modal('hide');
              location.reload();
            },2000); 
          }
            $('#result').html(html);
            
        }

      });
  });


//Set delete modal
  $('#example1 tbody').on('click','.deletemodal',function(){
    $('#empdeletemodal').modal('show');
    var empdid ;
    empdid = $(this).attr('id');
    $('#deletebtn').click(function(){
      $.ajax({
        url: '/employee/delete/' + empdid,
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

  //set view modal
  $('#example1 tbody').on('click','.viewemodal',function(){
    var empid ;
    empid = $(this).attr('id');

    $.ajax({
      url: '/employee/view/' + empid,
      datatype: 'json',
      success: function(data)
      {
        $("#id").text(empid);
        $("#fn").text(data.result.emp_name);
        $("#ph").text(data.result.emp_phoneno);
        $("#email").text(data.result.emp_email);
        $("#salary").text(data.result.emp_salary);
        $("#address").text(data.result.emp_address);
        $("#qualification").text(data.result.qualification);
        $("#dob").text(data.result.dob);
        $("#cnic").text(data.result.cnic);
        $("#ntn").text(data.result.ntn);
        $("#dep").text(data.result.department_name);
        $("#sh").text(data.result.shift_name);
        $("#doj").text(data.result.doj);
        $("#dol").text(data.result.dol);
        $('#empviewmodal').modal('show');

      }
    });
  });

});
</script>


@endsection