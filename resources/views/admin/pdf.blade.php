@extends('admin.main')

@section('content')

<a href="<?=url('/')?>/htmltopdf" target="_blank" class="btn btn-primary">generate PDF</a>

<script src="<?=url('/')?>/assets/datatable/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo url('/');?>/assets/datatable/js/sweetalert2@11.js"></script>
<script>
    function pdf(){
        $.ajax({
                type:'POST',
                url:'<?php echo url('/');?>/api/v1/htmltopdf',
                data:{},
                success:function(data) {
                    console.log(data);
                    if(data.status =="SUCCESS"){
                    }else{
                      alert(data.message);
                    }

                }
            });
    }
</script>
@endsection