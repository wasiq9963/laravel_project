@extends('subway.subwaylayout')

@section('maincontent')
  <!-- Main content -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="card-title">Vegetables</h1>
              </div>
              <div class="col-sm-6">
                <ol class="float-right">
                  <li class="breadcrumb-item">
                    <button type="button" class="btn btn-primary" data-toggle="modal" id="addvegesmodal">
                      <span class="fa fa-plus"></span> Add Vegetable
                    </button>
                </ol>
              </div>
            </div>
              
          </div>
          <div class="card-body">
            <table class="table table-bordered example4">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Vegetables</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($vegetable as $item)
                <tr>
                  <td>{{$item -> id}}</td>
                  <td>{{$item -> vegetable}}</td>
                  <td>
                    <button type="button" class="btn btn-primary btn-xs editvegesmodal"  id="{{$item -> id}}"><span class="fa fa-edit"></span> Edit</button>
                    <button type="button" class="btn btn-danger btn-xs deletevegesmodal" id="{{$item -> id}}"><span class="fa fa-trash"></span> Delete</button>
                  </td>                
                </tr>
                    
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>   
    <!-- /.container-fluid -->
<!-- INSERT, UPDATE AND DELETE MODEL WORK -->

<!-- -----------INSERT AND UPDATE MODEL START---------- -->
<div class="modal fade" id="vegetablemodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="vegetableform">
            @csrf
            <div class="modal-body">
              <span id="result"></span>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Vegetable Name</label>
                        <input type="text" name="vegetablename" id="vegetablename" class="form-control" placeholder="Enter Vegetable Name">
                    </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="did" id="did">
          <input type="hidden" name="action" id="action" value="">
        </form>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id='btnvegessubmit' class="btn btn-primary"></button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- -----------INSERT AND UPDATE MODEL END---------- -->

<!-- -----------DELETE MODEL START---------- -->

<div class="modal fade" id="vegesdeletemodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Conformation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
          @csrf
          <div class="modal-body">
              
                <h4 class="text-center">Are you sure you want to delete this data?</h4>
          </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id='deletevegesbtn' name="deletebtn" class="btn btn-danger">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- -----------DELETE MODEL END---------- -->


@endsection
@section('javascript')
    @parent

    <!-- AJAX INSERT,UPDATE AND DELETE WORK -->
<script>

$(document).ready(function(){

// Set insert model
    $('#addvegesmodal').click(function(){
        $('#vegetablemodal').modal('show');
        $('.modal-title').text('Add Vegetable');
        $('#btnvegessubmit').html('Insert Record');
        $('#action').val('Add');
        $("#vegetableform").get(0).reset();
    });

// Set update model
    $('.example4 tbody').on('click','.editvegesmodal',function(){
      $("#result").load(location.href + " #result");

        
        var vegesid;
        vegesid = $(this).attr('id');
        $.ajax({
            url: 'vegetable/edit/' + vegesid,
            datatype: 'json',
            success:function(data)
            {
                $('#vegetablename').val(data.result.vegetable);
                $('#did').val(vegesid);

                $('#vegetablemodal').modal('show');
                $('.modal-title').text('Update Vegetable');
                $('#btnvegessubmit').html('Update Record');
                $('#action').val('Edit');
            }
        })
    });
//=====insert
    $('#btnvegessubmit').click(function(e){
        e.preventDefault();
        var route_url;

        if ($('#action').val() == 'Add')
        {
            route_url = 'vegetable/add';            
        }
        if ($('#action').val() == 'Edit')
        {
            route_url = 'vegetable/update';            
        }
        $.ajax({
            type: 'POST',
            url: route_url,
            data: $('#vegetableform').serialize(),
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
                    $('#vegetableform')[0].reset();
                    setTimeout(function(){
                    $('#vegetablemodal').modal('hide');
                    location.reload();
                    },2000); 
                }
                    $('#result').html(html);
            }
        })

    });

//Set delete modal
  $('.example4 tbody').on('click','.deletevegesmodal',function(){
    $('#vegesdeletemodal').modal('show');
    var vegesid;
    vegesid = $(this).attr('id');
    $('#deletevegesbtn').click(function(){
        $.ajax({
            url: 'vegetable/delete/' + vegesid,
            success:function(data)
            {
              $('#vegesdeletemodal').modal('hide');
              location.reload();           
            }
        })
    });

  });

});


</script>


@endsection