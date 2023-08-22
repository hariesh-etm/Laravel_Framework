@inject ('permissioncontrol', 'App\Http\Controllers\Api\V1\Role_permission')
@php
    $user_permission = '1';
    $product_permission = '1';
    $permissionrecords = $permissioncontrol->getAllRole_permission(session('role'));
    if (!empty($permissionrecords)) {
        foreach ($permissionrecords as $key => $value) {
            if ($value->page_type == 'products' && $value->read_option == '0') {
                $product_permission = '0';
            }
            if ($value->page_type == 'users' && $value->read_option == '0') {
                $user_permission = '0';
            }
        }
    }
@endphp

<div class="sidebar close" style="opacity: inherit;">
    <ul class="nav-links">
        <?php  if(session('user_id') == 5 ){ ?>
        <li class="icon-link1">
            <div class="icon-link">
                <a href="<?= url('/') ?>/manage-trip">
                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa fa-car"></i>
                        <div class="shortmenu">Trip</div>
                    </div>

                    <span class="link_name">Trip</span>
                </a>
                {{-- <i class="fa-solid fa-angle-down"></i> --}}
            </div>
        </li>
        <?php }else{ ?>
        <li class="icon-link1">
            <div class="icon-link">
                <a href="<?= url('/') ?>">
                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-desktop"></i>
                        <div class="shortmenu">Home</div>
                    </div>
                    <span class="link_name">Dashboard</span>
                </a>
            </div>
        </li>

        <li class="icon-link1">
            <div class="icon-link">
                <a href="#">
                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-database"></i>
                        <div class="shortmenu">Master</div>
                    </div>
                    <span class="link_name">Masters</span>
                </a>
                <i class="fa-solid fa-angle-down"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="<?= url('/') ?>/manage-role">User Role</a></li>
                <li><a href="<?= url('/') ?>/manage-role_permission">User Role Permission</a></li>
                <?php if($user_permission == "1"){ ?> <li><a href="<?= url('/') ?>/manage-users">User</a></li> <?php } ?>
                <li><a href="<?= url('/') ?>/manage-city">City</a></li>
                <li><a href="<?= url('/') ?>/manage-state">State</a></li>
                <li><a href="<?= url('/') ?>/manage-country">Country</a></li>
                <li><a href="<?= url('/') ?>/manage-category">Category</a></li>
                <li><a href="<?= url('/') ?>/manage-sub_category">Sub Category</a></li>
                <li><a href="<?= url('/') ?>/form-validation">Form Validation</a></li>
                <li><a href="<?= url('/') ?>/pdf">PDF</a></li>
                <li><a href="<?= url('/') ?>/kanban-board">Kanban Board</a></li>
                <li><a href="<?= url('/') ?>/project">Project</a></li>
            </ul>
        </li>

        <?php if($product_permission == "1"){ ?>
        <li class="icon-link1">
            <div class="icon-link">
                <a href="<?= url('/') ?>/manage-products-list">
                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-barcode"></i>
                        <div class="shortmenu">Products</div>
                    </div>
                    <span class="link_name">Products</span>
                </a>
            </div>
        </li>
        <?php } ?>

        <li class="icon-link1">
            <div class="icon-link">
                <a href="<?= url('/') ?>">
                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-user"></i>
                        <div class="shortmenu">Customer</div>
                    </div>
                    <span class="link_name">Customer</span>
                </a>
            </div>
        </li>




        <li class="icon-link1">
            <div class="icon-link">
                <a href="#">
                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <div class="shortmenu">Orders</div>
                    </div>

                    <span class="link_name">Orders</span>
                </a>
                <i class="fa-solid fa-angle-down"></i>

            </div>
            <ul class="sub-menu">
                <li><a href="<?= url('/') ?>/stripe">New Orders</a></li>
                <li><a href="<?= url('/') ?>/razorpay">Cancelled Orders</a></li>
                <li><a href="<?= url('/') ?>/paypal">Delivered Orders</a></li>
            </ul>
        </li>


        <li class="icon-link1">
            <div class="icon-link">
                <a href="#">


                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-credit-card"></i>
                        <div class="shortmenu">Finance</div>
                    </div>

                    <span class="link_name">Finance</span>
                </a>
                <i class="fa-solid fa-angle-down"></i>

            </div>
            <ul class="sub-menu">

                <li><a href="<?= url('/') ?>/stripe">Stripe</a></li>
                <li><a href="<?= url('/') ?>/razorpay">Razorpay</a></li>
                <li><a href="<?= url('/') ?>/paypal">PayPal</a></li>
            </ul>
        </li>

        <li class="icon-link1">
            <div class="icon-link">
                <a href="#">


                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-chart-pie"></i>
                        <div class="shortmenu">Reports</div>
                    </div>

                    <span class="link_name">Reports</span>
                </a>
                <i class="fa-solid fa-angle-down"></i>

            </div>
            <ul class="sub-menu">

                <li><a href="<?= url('/') ?>/stripe">Visitors Details</a></li>
                <li><a href="<?= url('/') ?>/razorpay">User Activities</a></li>
                <li><a href="<?= url('/') ?>/paypal">Online Users</a></li>
            </ul>
        </li>


        <li class="icon-link1">
            <div class="icon-link">
                <a href="<?= url('/') ?>/setting">

                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-gear"></i>
                        <div class="shortmenu">Setting</div>
                    </div>

                    <span class="link_name">Setting</span>
                </a>
                <ul class="sub-menu">

                    <li><a href="<?= url('/') ?>/setting">Payment Gateways</a></li>
                    <li><a href="<?= url('/') ?>/razorpay">SMS Gateways</a></li>
                    <li><a href="<?= url('/') ?>/email_setting">Email Gateways</a></li>
                    <li><a href="<?= url('/') ?>/general_setting">General Setting</a></li>
                </ul>
            </div>
        </li>

        <li class="icon-link1">
            <div class="icon-link">
                <a href="<?= url('/') ?>">
                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-file-lines"></i>
                        <div class="shortmenu">CMS</div>
                    </div>
                    <span class="link_name">CMS</span>
                </a>
            </div>
        </li>
        <li class="icon-link1">
            <div class="icon-link">
                <a href="<?= url('/') ?>/apidetails">
                    <div class="d-flex" style="flex-direction: column;align-items:center;">
                        <i class="fa-solid fa-code"></i>
                        <div class="shortmenu">API</div>
                    </div>
                    <span class="link_name">API</span>
                </a>
            </div>
        </li>
        <?php } ?>

    </ul>
</div>
