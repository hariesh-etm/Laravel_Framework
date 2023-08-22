<div class="nav-wrap sticky" id="navbar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="home-content">
                    <div class="menucontrol">
                        <i class="fa-solid fa-bars"></i>
                        <span class="text">
                            Workahr Admin
                        </span>
                    </div>

                    <div class="offcanvas-btn">
                        <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                            aria-controls="offcanvasExample">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" type="button" id="defaultDropdown" data-bs-toggle="dropdown"
                            data-bs-auto-close="true" aria-expanded="false">
                            <div class="text-wrap top-right-menu">
                                {{session('display_name')}} <span>Administrator</span>
                            </div>
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="defaultDropdown">
                            <li><a class="dropdown-item" href="#" style="color: #9e9e9e;">ACCOUNT</a></li>
                            <li><a class="dropdown-item" href="#">Visit Shop</a></li>
                            <li><a class="dropdown-item" href="#">My Account</a></li>
                            <li><a class="dropdown-item" href="<?=url('/')?>/sitemap.xml">Sitemap</a></li>
                            <li><a class="dropdown-item" href="<?=url('/')?>/logout">Logout</a></li>
                        </ul>
                    </div>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                        aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                                <div class="logo-details">
                                    <i class="fa-solid fa-house"></i>
                                    <span class="logo_name">LOGOSPACE 1</span>
                                </div>
                            </h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="nav-links">
                                <li>
                                    <a href="#">
                                        <i class="fa-solid fa-calendar"></i>
                                        <span class="link_name">Calendar</span>
                                    </a>
                                    <ul class="sub-menu blank">
                                        <li><a class="link_name" href="#">Calendar</a></li>
                                    </ul>
                                </li>
                                <li class="icon-link1">
                                    <div class="icon-link">
                                        <a href="#">
                                            <i class="fa-solid fa-certificate"></i>
                                            <span class="link_name">Rewards</span>
                                        </a>
                                        <i class="fa-solid fa-angle-down"></i>
                                    </div>
                                    <ul class="sub-menu">
                                        <li><a class="link_name" href="#">Rewards</a></li>
                                        <li><a href="#">Scored points</a></li>
                                        <li><a href="#">Saved gifts</a></li>
                                        <li><a href="#">New rewards</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa-solid fa-chart-pie"></i>
                                        <span class="link_name">Analytics</span>
                                    </a>
                                    <ul class="sub-menu blank">
                                        <li><a class="link_name" href="#">Analytics</a></li>
                                    </ul>
                                </li>
                                <li class="icon-link1">
                                    <div class="icon-link">
                                        <a href="#">
                                            <i class="fa-solid fa-credit-card"></i>
                                            <span class="link_name">Payments</span>
                                        </a>
                                        <i class="fa-solid fa-angle-down"></i>
                                    </div>
                                    <ul class="sub-menu">
                                        <li><a class="link_name" href="#">Payments</a></li>
                                        <li><a href="#">Transactions</a></li>
                                        <li><a href="#">Credits</a></li>
                                        <li><a href="#">Debits</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span class="link_name">Location</span>
                                    </a>
                                    <ul class="sub-menu blank">
                                        <li><a class="link_name" href="#">Location</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa-solid fa-gear"></i>
                                        <span class="link_name">Setting</span>
                                    </a>
                                    <ul class="sub-menu blank">
                                        <li><a class="link_name" href="#">Setting</a></li>
                                    </ul>
                                </li>
                                <!-- <li>
                                    <div class="profile-details">
                                        <div class="profile-content">
                                            <img src="assets/images/profile-img.png" alt="profileImg">
                                        </div>
                                        <div class="name-job">
                                            <div class="profile_name">User Name</div>
                                            <div class="job">Developer</div>
                                        </div>
                                        <i class="fa-solid fa-right-from-bracket" style="color: #fff;"></i>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
