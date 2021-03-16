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
                                <h1 class="card-title">Sauces</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="float-right">
                                    <li class="breadcrumb-item">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" id="addsaucemodal">
                                            <span class="fa fa-plus"></span> Add Sauce
                                        </button>
                                </ol>
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
                </div>
            </div>
        </div>
    </div>
</section>   
    <!-- /.container-fluid -->
<!-- INSERT, UPDATE AND DELETE MODEL WORK -->

<!-- -----------INSERT AND UPDATE MODEL START---------- -->

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
    $('#addsaucemodal').click(function(){
        $('#saucemodal').modal('show');
        $('.modal-title').text('Add Sauce');
        $('#btnsaucesubmit').html('Insert Record');
        $('#action').val('Add');
        $("#sauceform").get(0).reset();
    });

// Set update model
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