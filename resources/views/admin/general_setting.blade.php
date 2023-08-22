@extends('admin.main') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row p-3">
            <div class="col-12 p-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-0">Setting</p>
                        <h4>General Settings</h4>
                    </div>
                    <div class="page-title-right"></div>
                </div>
            </div>
        </div>
        <form action="#" id="form" method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Site Name (Meta Title)</label>
                                <input type="text" name="site_name" class="form-control" placeholder="Enter name"
                                    id="site_name" value="<?=$site_name?>" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Site Description (Meta Description)</label>
                                <input type="text" name="site_description" class="form-control"
                                    placeholder="Enter description" id="site_description"
                                    value="<?=$site_description?>" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Site Keywords (Meta Keywords)</label>
                                <input type="text" name="site_keywords" class="form-control"
                                    placeholder="flutterappz, flutter themes, flutter" id="site_keywords"
                                    value="" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Canonical URL</label>
                                <input type="text" name="canonical_url" class="form-control"
                                    placeholder="" id="canonical_url"
                                    value="" />
                            </div>
                           
                            <div class="mb-3">
                                <label class="form-label">Oraganization Schema</label>
                                <input type="text" name="oraganization_schema" class="form-control"
                                    placeholder="" id="oraganization_schema"
                                    value="" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sitemap Path</label>
                                <input type="text" name="xml_site_map" class="form-control"
                                    placeholder="https://www.flutterappz.com/sitemap.xml" id="xml_site_map"
                                    value="" />
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Curreny Symbol</label>
                                <input type="text" name="currency_symbol" class="form-control" placeholder="$"
                                    id="currency_symbol" value="" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Currency Code</label>
                                <input type="text" name="currency_code" class="form-control"
                                    placeholder="USD" id="currency_code"
                                    value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-center pt-3">
                    <button class="btn btn-primary" id="save_button" type="submit">
                        Submit
                    </button>
                    <button type="button" style="display: none" id="save_button_loading" class="btn">
                        Storing the data please wait ...
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="<?=url('/')?>/assets/datatable/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo url('/');?>/assets/datatable/js/sweetalert2@11.js"></script>
<script type="text/javascript">
    window.onload = function () {
        var updateform = document.getElementById("form");
        updateform.addEventListener("submit", function (event) {
            var headers = new Headers();
            headers.set("Accept", "application/json");
            $("#save_button").hide();
            $("#save_button_loading").show();
            var formData = new FormData();
            for (var i = 0; i < updateform.length; ++i) {
                if (updateform[i].name == "media") {
                    const fileField = document.querySelector(
                        'input[name="media"]'
                    );
                    formData.append("media", fileField.files[0]);
                } else if (updateform[i].name == "razorpaycheck") {
                    if ($("#razorpaycheck").is(":checked")) {
                        formData.append("razorpay_option", "1");
                    } else {
                        formData.append("razorpay_option", "0");
                    }
                } else if (updateform[i].name == "stripecheck") {
                    if ($("#stripecheck").is(":checked")) {
                        formData.append("stripe_option", "1");
                    } else {
                        formData.append("stripe_option", "0");
                    }
                } else if (updateform[i].name == "paypalcheck") {
                    if ($("#paypalcheck").is(":checked")) {
                        formData.append("paypal_option", "1");
                    } else {
                        formData.append("paypal_option", "0");
                    }
                } else {
                    formData.append(
                        updateform[i].name,
                        updateform[i].value
                    );
                }
            }
            var url = "<?php echo url(" / ");?>/api/v1/updategeneralsetting";
            var fetchOptions = {
                method: "POST",
                headers,
                body: formData,
            };
            var responsePromise = fetch(url, fetchOptions);
            responsePromise
                .then((response) => response.json())
                .then((data) => {
                    $("#save_button").show();
                    $("#save_button_loading").hide();
                    if (data.status == "SUCCESS") {
                        // console.log(data);
                        Swal.fire({
                            title: "Setting Updated Successfully",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire("Failed!", data.message, "error");
                    }
                });
            event.preventDefault();
        });
    };
    function showpaymenttype() {
        var type = $("#type").val();
        if (type == "Razorpay") {
            $("#razorpay_show").show();
            $("#stripe_show").hide();
            $("#paypal_show").hide();
        } else if (type == "Stripe") {
            $("#razorpay_show").hide();
            $("#stripe_show").show();
            $("#paypal_show").hide();
        } else if (type == "Paypal") {
            $("#razorpay_show").hide();
            $("#stripe_show").hide();
            $("#paypal_show").show();
        } else {
            $("#razorpay_show").hide();
            $("#stripe_show").hide();
            $("#paypal_show").hide();
        }
    }
</script>
@endsection