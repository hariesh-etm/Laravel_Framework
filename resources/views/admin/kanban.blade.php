@extends('admin.main')

@section('content')
    <div class="kanban">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="kanban_header">
                        <h4>Project Name : <span>LetMacCv</span></h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="kanban_main_header">
                        <div class="kanban_tittle">
                            <h3 class="color_green">Assigned</h3>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%">
                            <div class="skill-element">
                                <div class="skill-title">In Process</div>
                                <div class="clearfix">
                                    <div style="color:#03cc88" class="skill-amount">30%</div>
                                    <div class="skill-line">
                                        <div data-amount="30" style="width: 30%; background: #03cc88;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div class="download"><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            {{-- <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%"> --}}
                            <div class="skill-element">
                                <div class="skill-title">In Process</div>
                                <div class="clearfix">
                                    <div style="color:#03cc88" class="skill-amount">30%</div>
                                    <div class="skill-line">
                                        <div data-amount="30" style="width: 30%; background: #03cc88;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%">
                            <div class="skill-element">
                                <div class="skill-title">In Process</div>
                                <div class="clearfix">
                                    <div style="color:#03cc88" class="skill-amount">30%</div>
                                    <div class="skill-line">
                                        <div data-amount="30" style="width: 30%; background: #03cc88;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div class="download"><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="kanban_main_header">
                        <div class="kanban_tittle">
                            <h3 class="color_yellow">In Process</h3>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%">
                            <div class="skill-element">
                                <div class="skill-title">In Process</div>
                                <div class="clearfix">
                                    <div style="color:#ffc107" class="skill-amount">70%</div>
                                    <div class="skill-line">
                                        <div data-amount="70" style="width: 70%; background: #ffc107;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div class="download"><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            {{-- <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%"> --}}
                            <div class="skill-element">
                                <div class="skill-title">In Process</div>
                                <div class="clearfix">
                                    <div style="color:#ffc107" class="skill-amount">70%</div>
                                    <div class="skill-line">
                                        <div data-amount="70" style="width: 70%; background: #ffc107;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%">
                            <div class="skill-element">
                                <div class="skill-title">In Process</div>
                                <div class="clearfix">
                                    <div style="color:#ffc107" class="skill-amount">70%</div>
                                    <div class="skill-line">
                                        <div data-amount="70" style="width: 70%; background: #ffc107;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div class="download"><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="kanban_main_header">
                        <div class="kanban_tittle">
                            <h3 class="color_yellow">Pending</h3>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%">
                            <div class="skill-element">
                                <div class="skill-title">Pending</div>
                                <div class="clearfix">
                                    <div style="color:#ffc107" class="skill-amount">80%</div>
                                    <div class="skill-line">
                                        <div data-amount="80" style="width: 80%; background: #ffc107;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div class="download"><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            {{-- <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%"> --}}
                            <div class="skill-element">
                                <div class="skill-title">Pending</div>
                                <div class="clearfix">
                                    <div style="color:#ffc107" class="skill-amount">80%</div>
                                    <div class="skill-line">
                                        <div data-amount="80" style="width: 80%; background: #ffc107;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%">
                            <div class="skill-element">
                                <div class="skill-title">Pending</div>
                                <div class="clearfix">
                                    <div style="color:#ffc107" class="skill-amount">80%</div>
                                    <div class="skill-line">
                                        <div data-amount="80" style="width: 80%; background: #ffc107;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div class="download"><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="kanban_main_header">
                        <div class="kanban_tittle">
                            <h3 class="color_red">Close</h3>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%">
                            <div class="skill-element">
                                <div class="skill-title">close</div>
                                <div class="clearfix">
                                    <div style="color:#dc3545" class="skill-amount">100%</div>
                                    <div class="skill-line">
                                        <div data-amount="100" style="width: 100%; background: #dc3545; border-radius: 10px" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div class="download"><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            {{-- <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%"> --}}
                            <div class="skill-element">
                                <div class="skill-title">close</div>
                                <div class="clearfix">
                                    <div style="color:#dc3545" class="skill-amount">100%</div>
                                    <div class="skill-line">
                                        <div data-amount="100" style="width: 100%; background: #dc3545; border-radius: 10px;" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Get another day full of work done! <span><i class="fa-solid fa-ellipsis-vertical"></i></span>
                            </h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <img src="<?= url('/') ?>/assets/images/kanban.jpg" alt="kanban" width="100%">
                            <div class="skill-element">
                                <div class="skill-title">close</div>
                                <div class="clearfix">
                                    <div style="color:#dc3545" class="skill-amount">100%</div>
                                    <div class="skill-line">
                                        <div data-amount="100" style="width: 100%; background: #dc3545; border-radius: 10px" class="animation"></div>
                                    </div>
                                </div>
                            </div>
                            <h6>update 3 hour ago</h6>
                            <div class="user_details">
                                <div class="user_details_comments d-flex">
                                    <div><i class="fa-regular fa-comments"></i> 18</div>
                                    <div><i class="fa-solid fa-users"></i> 7</div>
                                    <div class="download"><i class="fa-solid fa-download"></i></div>
                                </div>
                                <div class="user_img">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                    <img src="<?= url('/') ?>/assets/images/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
