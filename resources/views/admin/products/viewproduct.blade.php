@extends('admin.main')
@section('content')

<div class="content">
    <div class="container-fluid">
        <h2><?=$record->product_name?></h2>
        <br>
        <div>
            <?=$record->product_desc?>
        </div>
    </div>
</div>
@endsection