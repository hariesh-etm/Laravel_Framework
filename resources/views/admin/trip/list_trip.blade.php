@extends('admin.main')
@section('content')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<style>
    #floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
}
#map {
  height: 100%;
}
    </style>
{{-- <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}
  
 
  <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Map</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="floating-panel">
                
                <select id="mode" style="display: none;">
                  <option value="DRIVING">Driving</option>
                  <option value="WALKING">Walking</option>
                  <option value="BICYCLING">Bicycling</option>
                  <option value="TRANSIT">Transit</option>
                </select>
              </div>
              <div id="map" style="width: 770px;height:500px;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row  p-3">
                <div class="col-12 p-0">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0">Master</p>
                            <h4>Trips</h4>
                        </div>
                        <div class="page-title-right">
                            {{-- <a href="<?php echo url('/'); ?>/add-country" class="btn btn-primary"   style="float: right;">Add Country</a> --}}
                            <a href="" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#addCanvas" aria-controls="offcanvasRight">Start Trip</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                       
                                        <th>Start Location</th>
                                        <th>End Location</th>
                                        <th>Start KM</th>
                                        <th>End KM</th>
                                        <th>Total KM</th>
                                        <th>Created Date</th>
                                        <th>updated Date</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addCanvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h4 id="offcanvasRightLabel">Start Trip</h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" id="addform" method="POST">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Starting KM</label>
                                        <input type="text" name="start_km" class="form-control"
                                            placeholder="Enter Starting KM" id="start_km">
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label class="form-label">Langtitude</label>
                                        <input type="text" name="langtitude" class="form-control"
                                            placeholder="Enter Langtitude" id="langtitude">
                                    </div> --}}
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="latitude" class="form-control"
                                            placeholder="Enter Latitude" id="latitude">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Langtitude</label>
                                        <input type="text" name="langtitude" class="form-control"
                                            placeholder="Enter Langtitude" id="langtitude">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary" id="save_button" type="submit" >Submit</button>
                                    <button type="button" style="display:none;" id="save_button_loading"
                                        class="btn">Storing the data please wait ...</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="updateCanvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h4 id="offcanvasRightLabel">End Trip</h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" id="form" method="POST">
                                <input type="hidden" id="id" name="id">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Ending KM</label>
                                        <input type="text" name="end_km" class="form-control"
                                            placeholder="Enter Ending KM" id="end_km">
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label class="form-label">Langtitude</label>
                                        <input type="text" name="langtitude" class="form-control"
                                            placeholder="Enter Langtitude" id="langtitude">
                                    </div> --}}
                                </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="u_latitude" class="form-control"
                                            placeholder="Enter Latitude" id="u_latitude">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Langtitude</label>
                                        <input type="text" name="u_langtitude" class="form-control"
                                            placeholder="Enter Langtitude" id="u_langtitude">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary" id="save_button" type="submit">Submit</button>
                                    <button type="button" style="display:none;" id="save_button_loading"
                                        class="btn">Storing the data please wait ...</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>
    <script src="<?= url('/') ?>/assets/datatable/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo url('/'); ?>/assets/datatable/js/sweetalert2@11.js"></script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOvRJlOOIdvOzaJ_OU_FNMMlvbjZQei00&callback=initMap&v=weekly"
    defer></script>
    <script>
function initMap() {
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const directionsService = new google.maps.DirectionsService();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 14,
    center: { lat: 37.77, lng: -122.447 },
  });
  directionsRenderer.setMap(map);
  calculateAndDisplayRoute(directionsService, directionsRenderer);
  document.getElementById("mode").addEventListener("change", () => {
    calculateAndDisplayRoute(directionsService, directionsRenderer);
  });
}
function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  const selectedMode = document.getElementById("mode").value;
  directionsService
    .route({
      origin: { lat: 37.77, lng: -122.447 },
      destination: { lat: 37.768, lng: -122.511 },
      travelMode: google.maps.TravelMode[selectedMode],
    })
    .then((response) => {
      directionsRenderer.setDirections(response);
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
}
window.initMap = initMap;
        $(document).ready(function() {
            table = $('#datatable-buttons').DataTable({
                destroy: true,
                searching: false
            });
            table.destroy();
            $('#datatable').DataTable({
                dom: '<"dt-top-container"<l><"dt-center-in-div pt-3"B><f>r>t<ip>',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "order": [
                    [0, "desc"]
                ],
                'processing': true,
                'serverSide': true,
                retrieve: true,
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "responsive": true,
                'serverMethod': 'GET',
                'ajax': {
                    'url': '<?php echo url('/'); ?>/api/v1/trip/list-tripdt'
                },
                "columns": [
                    {
                        "render": function(data, type, row, meta) {
                            if(row.end_lat_long == "" || row.end_lat_long == null){
                            var a =`<a href="" data-hash="${row.id} " class="btn btn-sm btn btn-primary btn-addon  m-b-xxs edit-value">END TRIP</a> `;
                            }else{
                                var a =`<a href="" data-hash="${row.id} " class="btn btn-sm btn btn-primary btn-addon  m-b-xxs view-value">View Map</a> `;
                            }
                            return a;
                        }
                    },
                   
                    {
                        "data": 'start_location',
                        "render": function (data, type, row) {
                                return data.split(",").join("<br/>");
                            }
                    },
                   
                    {
                        "data": 'end_location',
                        "render": function (data, type, row) {
                                return data.split(",").join("<br/>");
                            }
                    },
                    {
                        "data": 'start_km'
                    },
                    {
                        "data": 'end_km'
                    },
                    {
                        "data": 'total_km'
                    },
                    {
                        "data": 'created_date'
                    },
                    {
                        "data": 'updated_date'
                    }
                    
                ]
            });
        });
        $(document).on("click", ".delete-value", function(e) {
            e.preventDefault();
            //var result = confirm("");
            Swal.fire({
                title: 'Are you sure?',
                text: "Are you sure, you want to delete this Location?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).attr('data-hash');
                    $.ajax({
                        type: 'DELETE',
                        url: '<?php echo url('/'); ?>/api/v1/geolocation/delete-geolocation',
                        data: {
                            'id': id
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == "SUCCESS") {
                                location.reload();
                            } else {
                                alert(data.message);
                            }
                        }
                    });
                }
            });
        });
            var insertform = document.getElementById('addform');
            insertform.addEventListener('submit', function(event) {
                var headers = new Headers();
                headers.set('Accept', 'application/json');
                $("#save_button").hide();
                $("#save_button_loading").show();
                var formData = new FormData();
                for (var i = 0; i < insertform.length; ++i) {
                    if (insertform[i].name == "media") {
                        const fileField = document.querySelector('input[name="media"]');
                        formData.append('media', fileField.files[0]);
                    } else {
                        formData.append(insertform[i].name, insertform[i].value);
                    }
                }
                var url = '<?php echo url('/'); ?>/api/v1/trip/create-trip';
                var fetchOptions = {
                    method: 'POST',
                    headers,
                    body: formData
                };
                var responsePromise = fetch(url, fetchOptions);
                responsePromise
                    .then(response => response.json())
                    .then(data => {
                        $("#save_button").show();
                        $("#save_button_loading").hide();
                        if (data.status == 'SUCCESS') {
                            // console.log(data);
                            Swal.fire({
                                title: 'Location Added Successfully',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        } else {
                            Swal.fire(
                                'Failed!',
                                data.message,
                                'error'
                            );
                        }
                    })
                event.preventDefault();
            });
            var updateform = document.getElementById('form');
            updateform.addEventListener('submit', function(event) {
                var headers = new Headers();
                headers.set('Accept', 'application/json');
                $("#save_button").hide();
                $("#save_button_loading").show();
                var formData = new FormData();
                for (var i = 0; i < updateform.length; ++i) {
                    if (updateform[i].name == "media") {
                        const fileField = document.querySelector('input[name="media"]');
                        formData.append('media', fileField.files[0]);
                    } else {
                        formData.append(updateform[i].name, updateform[i].value);
                    }
                }
                var url = '<?php echo url('/'); ?>/api/v1/trip/update-trip';
                var fetchOptions = {
                    method: 'POST',
                    headers,
                    body: formData
                };
                var responsePromise = fetch(url, fetchOptions);
                responsePromise
                    .then(response => response.json())
                    .then(data => {
                        $("#save_button").show();
                        $("#save_button_loading").hide();
                        if (data.status == 'SUCCESS') {
                            // console.log(data);
                            Swal.fire({
                                title: 'Location Updated Successfully',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= url('/') ?>/manage-trip";
                                }
                            })
                        } else {
                            Swal.fire(
                                'Failed!',
                                data.message,
                                'error'
                            );
                        }
                    })
                event.preventDefault();
            });
        $(document).on("click", ".edit-value", function(e) {
            e.preventDefault();
            var id = $(this).attr('data-hash');
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/v1/trip/get-tripDt',
                data: {
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == "SUCCESS") {
                        console.log(data.list);
                        $('#updateCanvas').offcanvas('show');
                        $('#id').val(data.list.id);
                    } else {
                        alert(data.message);
                    }
                }
            });
        });
        $(document).on("click", ".view-value", function(e) {
e.preventDefault();
var id = $(this).attr('data-hash');
$.ajax({
    type: 'GET',
    url: '<?php echo url('/'); ?>/api/v1/trip/get-tripDt',
    data: {
        'id': id
    },
    success: function(data) {
        console.log(data);
        if (data.status == "SUCCESS") {
            console.log(data.list);
            $('#exampleModal').modal('show');
            
            var sarray = data.list.start_lat_long;
            var start =  sarray.split(",");
            var slong = parseFloat(start[0]);
            var slat = parseFloat(start[1]);
            var earray = data.list.end_lat_long;
            var end =  earray.split(",");
            var elong = parseFloat(end[0]);
            var elat = parseFloat(end[1]);
            const directionsRenderer = new google.maps.DirectionsRenderer();
            const directionsService = new google.maps.DirectionsService();
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: { lat: slong, lng: slat },
            });
            const selectedMode = document.getElementById("mode").value;
            directionsRenderer.setMap(map);
            directionsService
    .route({
      origin: { lat:slong, lng: slat },
      destination: { lat: elong, lng: elat },
      travelMode: google.maps.TravelMode[selectedMode],
    })
    .then((response) => {
      directionsRenderer.setDirections(response);
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
        } else {
            alert(data.message);
        }
    }
});
});
    </script>
@endsection
