 @extends('admin.main')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
{{--<button class="btn btn-primary" onclick="pay()">pay 10</button>
<a href="{{ route('make.payment') }}" class="btn btn-primary mt-3">Pay $224 via Paypal</a>
<script src="<?=url('/')?>/assets/js/jquery/jquery-3.6.1.min.js"></script>
<script>
    // email : consult.sundhar@gmail.com
    // pasword : 1Etmpro@2525
    // client_id : AQd7bZEpIALGqVmbh09aIiWnaTSp77VJv7chJBVXnN-nbWLQlNc_QwXYZitCoQ8mW_ghW_70rohtWGvH
    //sceret: EFJHKGZTvsooOBPgxxMUVbOaefTArvtpCok60pmI5MDHJNOR8XwESbeybcYSTAfwjUQFepNdk-IvUepw
     // sandbox : sb-le6zn25384450@business.example.com
    function pay(){
    }
</script>
@endsection --}}
{{-- <html>
<head>
	<meta charset="utf-8">
	<title>How to integrate paypal payment</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body> --}}
  <?php if(session()->has('paypal_payment_id')){
    echo session('paypal_payment_id');
  } ?>
	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<h3 class="text-center" style="margin-top: 90px;"></h3>
            <div class="panel panel-default" style="margin-top: 60px;">
                    <div class="panel-heading"><b>Paywith Paypal</b></div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="amount" class="col-md-4 control-label">Enter Amount</label>
                                <div class="col-md-6">
                                    <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>
                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Paywith Paypal
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- </body>
=======
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
{{-- </head>
<body>
</body>
>>>>>>> Stashed changes
</html> --}}
