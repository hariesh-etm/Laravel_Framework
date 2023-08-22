@extends('admin.main')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row  p-3">
                <div class="col-12 p-0">
                    <div class="d-sm-flex align-items-center justify-content-between">
                    <div>
                    <p class="mb-0">Product</p>
                    <h4>Manage Product</h4>
                    </div>
                        <div class="page-title-right">
                            <a href="<?= url('/') ?>/manage-products-grid" class="btn btn-primary" disabled><i
                                    class="fa-solid fa-table-cells"></i></a>
                            <a href="<?= url('/') ?>/manage-products-list" class="btn btn-primary"><i
                                    class="fa-solid fa-list"></i></a>
                            <a href="" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addCanvas"
                                aria-controls="offcanvasRight">Add Products</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row " id="feature-card-wrap">
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <img src="images/card-img-2.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h1 class="card-title">Hospital Template - Bootstrap 5 Single...</h1>
                                            <div class="template-info">
                                                <a href="#" class="template-type">Bootstrap Template</a>
                                                <span>in</span>
                                                <a href="#" class="template-category">Business</a>
                                            </div>
                                            <div class="card-footer">
                                                <div class="card-footer-flex">
                                                    <div class="sales-count">00 sales</div>
                                                    <div class="item-price">$459</div>
                                                </div>
                                                <div class="footer-last">
                                                    <button class="btn" id="preview">Preview</button>
                                                    <button class="btn" id="shop-icon"><i
                                                            class="fa fa-shopping-cart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <img src="images/card-img-2.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h1 class="card-title">Hospital Template - Bootstrap 5 Single...</h1>
                                            <div class="template-info">
                                                <a href="#" class="template-type">Bootstrap Template</a>
                                                <span>in</span>
                                                <a href="#" class="template-category">Business</a>
                                            </div>
                                            <div class="card-footer">
                                                <div class="card-footer-flex">
                                                    <div class="sales-count">00 sales</div>
                                                    <div class="item-price">$459</div>
                                                </div>
                                                <div class="footer-last">
                                                    <button class="btn" id="preview">Preview</button>
                                                    <button class="btn" id="shop-icon"><i
                                                            class="fa fa-shopping-cart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <img src="images/card-img-2.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h1 class="card-title">Hospital Template - Bootstrap 5 Single...</h1>
                                            <div class="template-info">
                                                <a href="#" class="template-type">Bootstrap Template</a>
                                                <span>in</span>
                                                <a href="#" class="template-category">Business</a>
                                            </div>
                                            <div class="card-footer">
                                                <div class="card-footer-flex">
                                                    <div class="sales-count">00 sales</div>
                                                    <div class="item-price">$459</div>
                                                </div>
                                                <div class="footer-last">
                                                    <button class="btn" id="preview">Preview</button>
                                                    <button class="btn" id="shop-icon"><i
                                                            class="fa fa-shopping-cart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card">
                                        <img src="images/card-img-2.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h1 class="card-title">Hospital Template - Bootstrap 5 Single...</h1>
                                            <div class="template-info">
                                                <a href="#" class="template-type">Bootstrap Template</a>
                                                <span>in</span>
                                                <a href="#" class="template-category">Business</a>
                                            </div>
                                            <div class="card-footer">
                                                <div class="card-footer-flex">
                                                    <div class="sales-count">00 sales</div>
                                                    <div class="item-price">$459</div>
                                                </div>
                                                <div class="footer-last">
                                                    <button class="btn" id="preview" data-bs-toggle="modal"
                                                        data-bs-target="#productModal">Preview</button>
                                                    <button class="btn" id="shop-icon"><i
                                                            class="fa fa-shopping-cart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addCanvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Add Product</h5>
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
                                        <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" name="product_name" class="form-control"
                                            placeholder="Enter Product Name" id="product_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Product Description <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="product_desc" class="form-control"
                                            placeholder="Enter Product Description" id="product_desc" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control"
                                            placeholder="Enter Price" id="price" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Offer Price <span class="text-danger">*</span></label>
                                        <input type="text" name="offer_price" class="form-control"
                                            placeholder="Enter Offer Price" id="offer_price" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select type="text" name="category_id" class="form-control"
                                            placeholder="Enter category" id="category_id" required
                                            onchange="subCategory()">
                                            <option value="">Select Category</option>
                                            <?php
                                                if(!empty($category)){
                                                foreach ($category as $item) { ?>
                                            <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                            <?php   }} ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sub Category <span class="text-danger">*</span></label>
                                        <select type="text" name="sub_category_id" class="form-control"
                                            placeholder="Enter sub_category_id" id="sub_category_id" required>
                                            <option value="">Select Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6"> <label class="form-label">Image <span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="media" class="form-control"
                                            placeholder="Enter image_url" id="media">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary" id="save_button" type="submit"
                                       >Submit</button>
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
            <h5 id="offcanvasRightLabel">Update Product</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" id="form" method="POST">
                                <input type="hidden" id="u_id" name="u_id">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" name="u_product_name" class="form-control"
                                            placeholder="Enter Product Name" id="u_product_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Product Description <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="u_product_desc" class="form-control"
                                            placeholder="Enter Product Description" id="u_product_desc" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" name="u_price" class="form-control"
                                            placeholder="Enter Price" id="u_price" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Offer Price <span class="text-danger">*</span></label>
                                        <input type="text" name="u_offer_price" class="form-control"
                                            placeholder="Enter Offer Price" id="u_offer_price" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select type="text" name="u_category_id" class="form-control"
                                            placeholder="Enter category" id="u_category_id" required
                                            onchange="subCategory1()">
                                            <option value="">Select Category</option>
                                            <?php
                                            if(!empty($category)){
                                            foreach ($category as $item) { ?>
                                            <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                            <?php   }} ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sub Category <span class="text-danger">*</span></label>
                                        <select type="text" name="u_sub_category_id" class="form-control"
                                            placeholder="Enter sub_category_id" id="u_sub_category_id" required>
                                            <option value="">Select Sub Category</option>
                                            <?php
                                                if(!empty($sub_category)){
                                                foreach ($sub_category as $item) { ?>
                                            <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                            <?php   }} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Image <span class="text-danger">*</span></label>
                                        <input type="file" name="umedia" class="form-control"
                                            placeholder="Enter image_url" id="umedia">
                                    </div>
                                </div>
                                <div class="row mb-3" id="updated_image"></div>
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
    <script>
        $(document).ready(function() {
            $.ajax({
                        type: 'GET',
                        url: '<?php echo url('/'); ?>/api/v1/products/get-allproductsdt',
                        success: function(data) {
                            console.log(data);
                            if (data.status == "SUCCESS") {
                            } else {
                                alert(data.message);
                            }
                        }
                    });
            });
        $(document).on("click", ".delete-value", function(e) {
            e.preventDefault();
            //var result = confirm("");
            Swal.fire({
                title: 'Are you sure?',
                text: "Are you sure, you want to delete this products?",
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
                        url: '<?php echo url('/'); ?>/api/v1/products/delete-products',
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
                var url = '<?php echo url('/'); ?>/api/v1/products/create-products';
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
                                title: 'Products Added Successfully',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= url('/') ?>/manage-products";
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
                    if (updateform[i].name == "umedia") {
                        const fileField = document.querySelector('input[name="umedia"]');
                        formData.append('umedia', fileField.files[0]);
                    } else {
                        formData.append(updateform[i].name, updateform[i].value);
                    }
                }
                var url = '<?php echo url('/'); ?>/api/v1/products/update-products';
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
                                title: 'Products Updated Successfully',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= url('/') ?>/manage-products";
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
                url: '<?php echo url('/'); ?>/api/v1/role/get-productsdt',
                data: {
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    document.getElementById('updated_image').innerHTML = "";
                    if (data.status == "SUCCESS") {
                        console.log(data.list);
                        $('#updateCanvas').offcanvas('show');
                        $('#u_id').val(data.list.id);
                        $('#u_product_name').val(data.list.product_name);
                        $('#u_product_desc').val(data.list.product_desc);
                        $('#u_price').val(data.list.price);
                        $('#u_offer_price').val(data.list.offer_price);
                        $('#u_category_id').val(data.list.category_id);
                        $('#u_sub_category_id').val(data.list.sub_category_id);
                        if (data.list.image_url != null) {
                            document.getElementById('updated_image').innerHTML =
                                "<img src='<?php echo url('/'); ?>/" + data.list.image_url +
                                "' style='width:50%;height:50%;'/>"
                        }
                    } else {
                        alert(data.message);
                    }
                }
            });
        });
        function subCategory() {
            var id = $("#category_id").val();
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/v1/sub_category/getSubcategoryByCategory',
                data: {
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == "SUCCESS") {
                        $("#sub_category_id").empty();
                        console.log(data.list.length);
                        for (var i = 0; i < data.list.length; i++) {
                            $("#sub_category_id").append("<option value='" + data.list[i].id + "'>" + data.list[
                                i].name + '</option>');
                        }
                    }
                }
            });
        }
        function subCategory1() {
            var id = $("#u_category_id").val();
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/v1/sub_category/getSubcategoryByCategory',
                data: {
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == "SUCCESS") {
                        $("#u_sub_category_id").empty();
                        console.log(data.list.length);
                        for (var i = 0; i < data.list.length; i++) {
                            $("#u_sub_category_id").append("<option value='" + data.list[i].id + "'>" + data
                                .list[i].name + '</option>');
                        }
                    }
                }
            });
        }
    </script>
@endsection
