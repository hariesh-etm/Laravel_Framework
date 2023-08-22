@extends('admin.main')

@section('content')
    <div class="kanban">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="kanban_header">
                        <h4>Projects </h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="kanban_main_header">
                        <div class="kanban_tittle">
                            <h3>LetmacCV <span><i class="fa-solid fa-ellipsis"></i></span></h3>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Client: Self</h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <h4>Team Members :</h4>
                            <ul>
                                <li>John</li>
                                <li>Vicky</li>
                                <li>Ram</li>
                            </ul>
                           <div class="text-end">
                            <a  href="<?=url('/')?>/kanban-board" class="btn btn_viewtask">View Task</a>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="kanban_main_header">
                        <div class="kanban_tittle">
                            <h3>Suntext <span><i class="fa-solid fa-ellipsis"></i></span></h3>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Client: Self</h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <h4>Team Members :</h4>
                            <ul>
                                <li>John</li>
                                <li>Vicky</li>
                                <li>Ram</li>
                            </ul>
                           <div class="text-end">
                             <a  href="<?=url('/')?>/kanban-board" class="btn btn_viewtask">View Task</a>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="kanban_main_header">
                        <div class="kanban_tittle">
                            <h3>Workhra <span><i class="fa-solid fa-ellipsis"></i></span></h3>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Client: Self</h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <h4>Team Members :</h4>
                            <ul>
                                <li>John</li>
                                <li>Vicky</li>
                                <li>Ram</li>
                            </ul>
                           <div class="text-end">
                             <a  href="<?=url('/')?>/kanban-board" class="btn btn_viewtask">View Task</a>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="kanban_main_header">
                        <div class="kanban_tittle">
                            <h3>LetmacCV <span><i class="fa-solid fa-ellipsis"></i></span></h3>
                        </div>
                        <div class="kanban_wrap">
                            <h3>Client: Self</h3>
                            <h6>Create Date : 28/07/2023</h6>
                            <h4>Team Members :</h4>
                            <ul>
                                <li>John</li>
                                <li>Vicky</li>
                                <li>Ram</li>
                            </ul>
                           <div class="text-end">
                             <a  href="<?=url('/')?>/kanban-board" class="btn btn_viewtask">View Task</a>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
