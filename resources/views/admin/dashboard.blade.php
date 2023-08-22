@extends('admin.main')
@section('content')
<!-- third party css -->
<link href="<?=url('/')?>/assets/datatable/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?=url('/')?>/assets/datatable/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
    rel="stylesheet" type="text/css" />
<link href="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
    rel="stylesheet" type="text/css" />
<link href="<?=url('/')?>/assets/datatable/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css"
    rel="stylesheet" type="text/css" />
<!-- third party css end -->
<div class="content">
    <div class="container-fluid">
    <div class="row  p-3">
            <div class="col-12 p-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div>
                    <p class="mb-0">Home</p>
                    <h4>Dashboard</h4>
                    </div>
                    
                    <div class="page-title-right">
                    <a href="" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addCanvas" aria-controls="offcanvasRight"   style="float: right;">10.00 AM - 29 Apr 2023</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 col-lg-3 col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Today Sales Amount</h5>
                            </div>
                            <div class="col-auto">
                                <div class="avatar">
                                    <div class="avatar-title rounded-circle bg-primary-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-dollar-sign align-middle">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1 class="display-5 mt-1 mb-3"><b>$25.300</b></h1>
                        <div class="mb-0">
                            <span class="text-danger"> <i class="fa-solid fa-arrow-right"></i>  -2.65% </span>
                            Less sales than usual
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Today Bill Count</h5>
                            </div>
                            <div class="col-auto">
                                <div class="avatar">
                                    <div class="avatar-title rounded-circle bg-primary-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-shopping-cart align-middle">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1 class="display-5 mt-1 mb-3"><b>122</b></h1>
                        <div class="mb-0">
                            <span class="text-success"> <i class="fa-solid fa-arrow-right"></i> 5.50% </span>
                           <a href="#">Click to view Sales History</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">This Month Sales Amount</h5>
                            </div>
                            <div class="col-auto">
                                <div class="avatar">
                                    <div class="avatar-title rounded-circle bg-primary-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-activity align-middle">
                                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1 class="display-5 mt-1 mb-3">29.232</h1>
                        <div class="mb-0">
                            <span class="text-danger"> <i class="fa-solid fa-arrow-right"></i>  -4.25% </span>
                            More earnings than usual
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">This Month Sales Count</h5>
                            </div>
                            <div class="col-auto">
                                <div class="avatar">
                                    <div class="avatar-title rounded-circle bg-primary-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-dollar-sign align-middle">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1 class="display-5 mt-1 mb-3">4596</h1>
                        <div class="mb-0">
                            <span class="text-success"> <i class="fa-solid fa-arrow-right"></i>  8.35% </span>
                            More earnings than usual
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">           
            <div class="col-md-8 mb-3">                   
                    <div class="container bg-white border pb-3">
                    <p class="mt-3"><b>Recent Sales</b></p>
                    <table id="example" class="table table-striped dataTable nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Invoice No</th>
                                <th>Sale Area</th>
                                <th>Sale Date / Time</th>
                                <th>Delivery Status</th>
                                <th class="text-end">Total (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1990</td>
                                <td>Inv549898</td>
                                <td>Trichy - 620019</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-success status-btn btn-sm">Delivered</button></td>
                                <td class="text-end">7000.00</td>
                            </tr>
                            <tr>
                                <td>1991</td>
                                <td>Inv659898</td>
                                <td>Madurai - 620001</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-success status-btn btn-sm">Delivered</button></td>
                                <td class="text-end">9800.00</td>
                            </tr>
                            <tr>
                                <td>1992</td>
                                <td>Inv239898</td>
                                <td>Salem - 630009</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-success status-btn btn-sm">Delivered</button></td>
                                <td class="text-end">600.00</td>
                            </tr>
                            <tr>
                                <td>1993</td>
                                <td>Inv498984</td>
                                <td>Trichy - 620200</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-primary status-btn btn-sm">Pending</button></td>
                                <td class="text-end">5700.00</td>
                            </tr>
                            <tr>
                                <td>1994</td>
                                <td>Inv909584</td>
                                <td>Trichy - 620345</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-success status-btn btn-sm">Delivered</button></td>
                                <td class="text-end">7670.00</td>
                            </tr>
                            <tr>
                                <td>1991</td>
                                <td>Inv659898</td>
                                <td>Madurai - 620001</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-success status-btn btn-sm">Delivered</button></td>
                                <td class="text-end">9800.00</td>
                            </tr>
                            <tr>
                                <td>1992</td>
                                <td>Inv239898</td>
                                <td>Salem - 630009</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-success status-btn btn-sm">Delivered</button></td>
                                <td class="text-end">600.00</td>
                            </tr>
                            <tr>
                                <td>1993</td>
                                <td>Inv498984</td>
                                <td>Trichy - 620200</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-success status-btn btn-sm">Delivered</button></td>
                                <td class="text-end">5700.00</td>
                            </tr>
                            <tr>
                                <td>1994</td>
                                <td>Inv909584</td>
                                <td>Trichy - 620345</td>
                                <td>25/04/2023 10.00 AM</td>
                                <td><button type="button" class="btn btn-success status-btn btn-sm">Delivered</button></td>
                                <td class="text-end">7670.00</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="container bg-white border pb-3">
                    <p class="mt-3"><b>Top Selling Products</b></p>
                      
                    <table id="example" class="table table-striped dataTable nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Product Name</th>
                                <th>Cost</th>
                                <th>Count</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>#667</td>
                                <td>Pepsi 500 ML</td>
                                <td>40</td>
                                <td>500</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
        <div class="row mb-6">           
            
            <div class="col-md-6">
                <div class="container bg-white border">
                    <div class="col-md-12 col-md-offset-0 mt-3">
                        <strong>Select Language: </strong>
                    </div>
                    <div class="col-md-12 mt-2">
                        <select class="form-select changeLang">
                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>
                            <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
                        </select>
                    </div> 
                    
                    <br>
                    <p>{{ __('messages.title') }}</p>
                </div>
            </div>
        </div>
       
       
      
    </div>
</div>
<script src="<?=url('/')?>/assets/datatable/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
var url = "<?=url('/')?>/changelang";
$(".changeLang").change(function() {
    window.location.href = url + "?lang=" + $(this).val();
});
</script>
@endsection