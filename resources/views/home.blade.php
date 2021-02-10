@extends('layouts.site')

@section('content')

<div style="height: 350px">
<div class="login_box d-flex align-items-center justify-content-center" style="height: 300px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <h3 style="margin: auto">شما ثبت نام کرده اید!!</h3>
</div>
</div>
@endsection
