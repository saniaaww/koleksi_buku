@extends('layouts.app')

@section('content')
<div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                
                <h4>Verifikasi OTP</h4>
                <h6 class="font-weight-light">Masukkan kode yang dikirim ke email Anda.</h6>

                @if(session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="pt-3" method="POST" action="{{ route('otp.verify') }}">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="otp" class="form-control form-control-lg"
                               placeholder="Masukkan 6 digit OTP" required>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                            VERIFIKASI
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection