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
                <div class="col-sm-5">
                  <h1 class="card-title">Suppliers Locations</h1>
                </div>
                <div class="col-md-2">
                  <p id="mapresult" class="text text-danger"></p>
                </div>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="search">
                </div>
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                      <div style="width: 100%; height: 500px;" id="map"></div>
                  </div>
                </div>  
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
@endsection
@section('javascript')
    @parent

    <!-- AJAX INSERT,UPDATE AND DELETE WORK -->
<script>

$(document).ready(function(){    

  fetchmap(); 
      //record fetch work
    $(document).on('keyup','#search',function(){
      var query = $(this).val();
        console.log(query);
        fetchmap(query);
    });
  function fetchmap(query = '')
  {
    //set map work
    var map;
      map = new google.maps.Map(document.getElementById('map'),{
      center: {lat: 30.3753, lng: 69.3451},//method 1
      //center: new google.maps.LatLng(lati, lngi),method 2
      zoom: 5
    });

    //record fetch work
    $.ajax({
      url: '/supplier/map',
      data: {query:query},
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
            title: 'Suppliers Information',
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
                contentString ='<h6>Name: '+response.result[i].sup_name+'</h6> <hr>';
                contentString +='<p style="font-size:15px"><i class="fa fa-phone-alt text-info" ></i> '+response.result[i].sup_phoneno+ '</p>';
                contentString +='<p style="font-size:15px"><i class="fa fa-map-marker-alt text-info"></i> '+response.result[i].sup_address+'</p>';

                infowindow.setContent(contentString);
                console.log("open info window");
                infowindow.open( map, marker );
              }
            })(marker, i));
          }
          $("#mapresult").load(location.href + " #mapresult");
        }
        else
        {
          $('#mapresult').text('No Records');
        }
      }

    });
  }
});
</script>


@endsection