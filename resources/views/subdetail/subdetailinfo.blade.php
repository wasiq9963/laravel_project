@extends('subway.subwaylayout')

@section('maincontent')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sub Detail</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

  <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-4">
                <h3 class="card-title">Vegetables</h3>
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-4">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" id="addvegesmodal">
                  <span class="fa fa-plus"></span> Add Vegetable
                </button>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
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
      <!-- /.col -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-3">
                <h3 class="card-title">Sauces</h3>
              </div>
              <div class="col-md-6">
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" id="addsaucemodal">
                  <span class="fa fa-plus"></span> Add Sauce
                </button>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered example4">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sauces</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sauce as $item2)
                <tr>
                  <td>{{$item2 -> id}}</td>
                  <td>{{$item2 -> sauce}}</td>
                  <td>
                    <button type="button" class="btn btn-primary btn-xs editsaucemodal"  id="{{$item2 -> id}}"><span class="fa fa-edit"></span> Edit</button>
                    <button type="button" class="btn btn-danger btn-xs deletesaucemodal" id="{{$item2 -> id}}"><span class="fa fa-trash"></span> Delete</button>
                  </td>                
                </tr>
                    
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.col -->
    </div>
</section>   
    <!-- /.container-fluid -->
<!-- INSERT, UPDATE AND DELETE MODEL WORK -->

<!-- -----------INSERT AND UPDATE MODEL START---------- -->

<!-- -------VEGETABLES -->

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

<!-- -------SAUCES -->

<div class="modal fade" id="saucemodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="sauceform">
          @csrf
          <div class="modal-body">
            <span id="result2"></span>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Sauce Name</label>
                      <input type="text" name="saucename" id="saucename" class="form-control"  placeholder="Enter Sauce Name">
                  </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="did" id="didsause">
        <input type="hidden" name="action" id="action" value="">
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id='btnsaucesubmit' class="btn btn-primary"></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- -----------INSERT AND UPDATE MODEL END---------- -->

<!-- -----------DELETE MODEL START---------- -->

<!-- -------VEGETABLES -->

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

<!-- -------SAUCES -->
<div class="modal fade" id="saucedeletemodal">
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
        <button type="button" id='deletesauceesbtn' name="deletesauceesbtn" class="btn btn-danger">Delete</button>
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
//vegetable
    $('#addvegesmodal').click(function(){
        $('#vegetablemodal').modal('show');
        $('.modal-title').text('Add Vegetable');
        $('#btnvegessubmit').html('Insert Record');
        $('#action').val('Add');
        $("#storeform").get(0).reset();
    });
    //sauce
    $('#addsaucemodal').click(function(){
        $('#saucemodal').modal('show');
        $('.modal-title').text('Add Sauce');
        $('#btnsaucesubmit').html('Insert Record');
        $('#action').val('Add');
        $("#sauceform").get(0).reset();
    });

// Set update model

//vegetable
    $('.example4 tbody').on('click','.editvegesmodal',function(){
      $("#result").load(location.href + " #result");

        
        var storeid;
        storeid = $(this).attr('id');
        $.ajax({
            url: 'vegetable/edit/' + storeid,
            datatype: 'json',
            success:function(data)
            {
                $('#vegetablename').val(data.result.vegetable);
                $('#did').val(storeid);

                $('#vegetablemodal').modal('show');
                $('.modal-title').text('Update Vegetable');
                $('#btnvegessubmit').html('Update Record');
                $('#action').val('Edit');
            }
        })
    });

//sauce
    $('.example4 tbody').on('click','.editsaucemodal',function(){
      $("#result").load(location.href + " #result");
            var storeid;
            storeid = $(this).attr('id');
            $.ajax({
                url: 'sauce/edit/' + storeid,
                datatype: 'json',
                success:function(data)
                {
                    $('#saucename').val(data.result.sauce);
                    $('#didsause').val(storeid);

                    $('#saucemodal').modal('show');
                    $('.modal-title').text('Update Sauce');
                    $('#btnsaucesubmit').html('Update Record');
                    $('#action').val('Edit');
                }
            })
    });   

//=====insert
//vegetable
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

//sauce
    $('#btnsaucesubmit').click(function(e){
            e.preventDefault();
            var route_url;

            if ($('#action').val() == 'Add')
            {
                route_url = 'sauce/add';            
            }
            if ($('#action').val() == 'Edit')
            {
                route_url = 'sauce/update';            
            }
            $.ajax({
                type: 'POST',
                url: route_url,
                data: $('#sauceform').serialize(),
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
                        $('#sauceform')[0].reset();
                        setTimeout(function(){
                        $('#saucemodal').modal('hide');
                        location.reload();
                        },2000); 
                    }
                        $('#result2').html(html);
                }
            })

    });

//Set delete modal

//vegetable
  $('.example4 tbody').on('click','.deletevegesmodal',function(){
    $('#vegesdeletemodal').modal('show');
    var storeid;
    storeid = $(this).attr('id');
    $('#deletevegesbtn').click(function(){
        $.ajax({
            url: 'vegetable/delete/' + storeid,
            success:function(data)
            {
              $('#storedeletemodal').modal('hide');
              location.reload();           
            }
        })
    });

  });

//sauce
$('.example4 tbody').on('click','.deletesaucemodal',function(){
    $('#saucedeletemodal').modal('show');
    var storeid;
    storeid = $(this).attr('id');
    $('#deletesauceesbtn').click(function(){
        $.ajax({
            url: 'sauce/delete/' + storeid,
            success:function(data)
            {
              $('#saucedeletemodal').modal('hide');
              location.reload();           
            }
        })
    });

  });
});
</script>


@endsection