@extends('mobile.layouts.fimobile')
@section('content')
@include('layouts.notification')
<div class="row mb-3">
    <div class="col">
        <h6>Change Password</h6>
    </div>
</div>
<form action="/mobile/{{ Crypt::encrypt(Auth::user()->npp) }}/updatepassword" method="POST">
    @csrf
    <div class="row h-100 mb-4">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-floating  mb-3">
                <input type="password" name="password_lama" class="form-control" placeholder="Password Lama" id="password" required>
                <label for="password">Password Lama</label>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="form-floating ">
                <input type="password" name="password_baru" class="form-control" placeholder="Password Baru" id="passwordbaru" required>
                <label for="confirmpassword">Password Baru</label>
            </div>
        </div>
    </div>
    <div class="row h-100 ">
        <div class="col-12 mb-4">
            <button type="submit" target="_self" class="btn btn-default btn-lg w-100">Update</button>
        </div>
    </div>
</form>
@endsection
