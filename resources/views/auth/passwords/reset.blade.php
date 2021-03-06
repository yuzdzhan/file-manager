@extends('app')
@section('content')
<center>
<h3>Reset Password</h3>
<div class="section"></div>
<div class="container">
    <div class="z-depth-1 grey lighten-5 row main-form">
        <form class="col s12" role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="row">
                <div class="col s12"></div>
            </div>
            <div class="row left-align">
                <div class="input-field col s12">
                    <input
                    id="email"
                    type="email"
                    class="validate"
                    name="email"
                    value="{{ $email or old('email') }}"
                    required
                    autofocus>
                    <label for="email">E-Mail Address</label>
                </div>
            </div>
            <div class="row left-align">
                <div class="input-field col s12">
                    <input
                    id="password"
                    type="password"
                    class="validate"
                    name="password"
                    required>
                    <label for="email">Password</label>
                </div>
            </div>
            <div class="row left-align">
                <div class="input-field col s12">
                    <input
                    id="password-confirm"
                    type="password"
                    class="validate"
                    name="password_confirmation"
                    required>
                    <label for="email">Confirm Password</label>
                </div>
            </div>
            <br>
            <center>
            <div class="row">
                <button type="submit" name="btn_login" class="col s12 btn btn-large waves-effect">Reset Password</button>
            </div>
            </center>
        </form>
    </div>
</div>
</center>
@endsection
@section('scripts')
<script type="text/javascript">
    @if($errors->has('email'))
        Materialize.toast("{{ $errors->first('email') }}", 4000, 'red darken-4');
        $('#email').addClass("invalid");
        $('#email').prop("aria-invalid", "true");
    @endif
     @if($errors->has('password'))
        Materialize.toast("{{ $errors->first('password') }}", 4000, 'red darken-4');
        $('#password').addClass("invalid");
        $('#password').prop("aria-invalid", "true");
    @endif
     @if($errors->has('password_confirmation'))
        Materialize.toast("{{ $errors->first('password_confirmation') }}", 4000, 'red darken-4');
        $('#password-confirm').addClass("invalid");
        $('#password-confirm').prop("aria-invalid", "true");
    @endif
</script>
@endsection
