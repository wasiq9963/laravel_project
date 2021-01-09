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
                  <h1 class="card-title">All Customers</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="float-right">
                    <li class="breadcrumb-item">
                      <button type="button" class="btn btn-warning" data-toggle="modal" id="mapmodal">
                        <span class="fa fa-map-marker-alt"></span> View Customers Location
                      </button>&nbsp; &nbsp;
                        <button type="button" class="btn btn-primary" data-toggle="modal" id="addmodal">
                            <span class="fa fa-plus"></span> Add Customer
                          </button>
                    </li>
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
                    <th>Address</th>
                    <th>NTN Number</th>
                    <th>Opening Balance</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($customerinfo as $item)
                    <tr>
                        <td>{{$item -> id}}</td>
                        <td>{{$item -> cus_name}}</td>
                        <td>{{$item -> cus_phoneno}}</td>
                        <td>{{$item -> cus_email}}</td>
                        <td>{{$item -> cus_address}}</td>
                        <td>{{$item -> ntn}}</td>
                        <td>{{$item -> opening_balance}}</td>
    
                        <td>
                          <button type="button" class="btn btn-primary btn-xs editmodal"  id="{{$item -> id}}"><span class="fa fa-edit"></span> Edit</button>
                          <button type="button" class="btn btn-danger btn-xs deletemodal" id="{{$item -> id}}"><span class="fa fa-trash"></span> Delete</button>
                        </td>
                      </tr> 
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Full Name</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>NTN Number</th>
                    <th>Opening Balance</th>
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

<div class="modal fade" id="customermodal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="customerform">
            @csrf
            <div class="modal-body">
              <span id="result"></span>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" name="txt_name" id="txt_name" class="form-control" value="{{old('txt_name')}}" placeholder="Enter Full Name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone No</label>
                    <input type="number" name="txt_phoneno" id="txt_phoneno" class="form-control" value="{{old('txt_phoneno')}}" placeholder="Enter Phone_No">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="txt_email" id="txt_email" class="form-control" value="{{old('txt_email')}}" placeholder="Enter Email">
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NTN</label>
                        <input type="number" name="txt_ntn" id="txt_ntn" class="form-control" placeholder="Enter NTN Number"  value="{{old('txtemp_ntn')}}">
                      </div>
                  </div>
              </div>
              <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Address</label>
                            <input type="text" name="txt_address" id="txt_address" class="form-control" placeholder="search"  value="{{old('txt_address')}}">
                            <input type="hidden" id="longi" name="longi">
                            <input type="hidden" id="lati" name="lati">
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Opening Balance</label>
                            <input type="number" name="txt_openbalance" id="txt_openbalance" class="form-control" placeholder="Opening Balance"  value="{{old('txt_ntn')}}">
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

<div class="modal fade" id="customerdeletemodal">
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

<!-- -----------Map MODEL START---------- -->

<div class="modal fade" id="viewmapmodal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Customers Locations</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="mapresult"></p>
        <div class="row">
          <div class="col-md-12">
              <div style="width: 100%; height: 500px;" id="map"></div>
          </div>
        </div> 
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- -----------Map MODEL END---------- -->


  </section>
@endsection
@section('javascript')
    @parent

    <!-- AJAX INSERT,UPDATE AND DELETE WORK -->
<script>

$(document).ready(function(){

//google map autocomplete work
var autocomplete;
    var input = document.getElementById("txt_address");
    autocomplete = new google.maps.places.Autocomplete(input,{
      types:[('geocode')],
      componentRestrictions: {country: 'PAK'}

      //define multi country {country: ['PAK','IND',ETC]}
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function(){
      var near_place = autocomplete.getPlace();
      document.getElementById('lati').value =near_place.geometry.location.lat();
      document.getElementById('longi').value =near_place.geometry.location.lng();
    })
    //autocomplete.addListener('place_changed', place_changed); 

// Set insert model
  $('#addmodal').click(function(){
    $('#customermodal').modal('show');
    $('.modal-title').text('Add Cusomer');
    $('#btnsubmit').html('Insert Record');
    $('#action').val('Add');
  });

// Set update model
  $('#example1 tbody').on('click','.editmodal',function(){
    var cusuid ;
    cusuid = $(this).attr('id');
    $.ajax({
      url: '/customer/edit/' + cusuid,
      datatype: 'json',
      success: function(data)
      {
        $("#txt_name").val(data.result.cus_name);
        $("#txt_phoneno").val(data.result.cus_phoneno);
        $("#txt_email").val(data.result.cus_email);
        $("#txt_address").val(data.result.cus_address);
        $("#txt_ntn").val(data.result.ntn);
        $("#txt_openbalance").val(data.result.opening_balance);
        $("#longi").val(data.result.longitude);
        $("#lati").val(data.result.latitude);
        $("#did").val(cusuid);

        $('#customermodal').modal('show');
        $('.modal-title').text('Update Customer');
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
        route_url = '/customer/add';
        
      }
      if ($("#action").val() == 'Edit') 
      {
        route_url = '/customer/update';
        
      }

      $.ajax({
        type: 'POST',
        url: route_url,
        data: $('#customerform').serialize(),
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
            $('#customerform')[0].reset();
            setTimeout(function(){
              $('#customermodal').modal('hide');
              location.reload();
            },2000); 
          }
            $('#result').html(html);
            
        }

      });
  });


//Set delete modal
  $('#example1 tbody').on('click','.deletemodal',function(){
    $('#customerdeletemodal').modal('show');
    var cusdid ;
    cusdid = $(this).attr('id');
    $('#deletebtn').click(function(){
      $.ajax({
        url: '/customer/delete/' + cusdid,
        success:function(data)
        {
          setTimeout(function()
          {
            $('#customerdeletemodal').modal('hide');
            location.reload();
            alert('Data Deleted');
          },2000);
                    
        }

      })
    });

  });
// Set Map model
$('#mapmodal').click(function(){
    $('#viewmapmodal').modal('show');
    
    //set map work
    var map;
      map = new google.maps.Map(document.getElementById('map'),{
      center: {lat: 30.3753, lng: 69.3451},//method 1
      //center: new google.maps.LatLng(lati, lngi),method 2
      zoom: 5
    });

    //record fetch work
    $.ajax({
      url: 'customer/fetchmap',
      datatype: 'json',
      success: function(response)
      {
        var len = 0;
        if(response.result != null)
        {
              len = response.result.length;
        }
        if(len > 0)
        {
          for( i=0; i<len; i++)
          {
            let lati = parseFloat(response.result[i].latitude);
            let lngi = parseFloat(response.result[i].longitude);
            //addMarker({lat: lati, lng: lngi},id);
            //set multi markers
            marker = new google.maps.Marker({
            title: 'Customers Information',
            position: {lat: lati, lng: lngi},//method 1
            //position: new google.maps.LatLng(lati, lngi),
            map:map,
            icon: "{{asset('images/locationicon.png')}}",
            });
            //multi markers end
            //info window work
            infowindow = new google.maps.InfoWindow()
            google.maps.event.addListener(marker, 'click', (function(marker,i) {
              return function()
              {
                contentString ='<h6>Name: '+response.result[i].cus_name+'</h6> <hr>';
                contentString +='<p style="font-size:15px"><i class="fa fa-phone-alt text-info" ></i> '+response.result[i].cus_phoneno+ '</p>';
                contentString +='<p style="font-size:15px"><i class="fa fa-map-marker-alt text-info"></i> '+response.result[i].cus_address+'</p>';

                infowindow.setContent(contentString);
                console.log("open info window");
                infowindow.open( map, marker );
              }
            })(marker, i));
          }
        }
        else
        {
          $('#mapresult').text('No Records');
          $('#mapresult').addClass("alert alert-danger")
        }
      }

    });
    
  });
});
</script>


@endsection