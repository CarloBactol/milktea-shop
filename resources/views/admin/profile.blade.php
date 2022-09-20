@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name">Firstname</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="status">Role</label>
                            <input type="text" value="{{ Auth::user()->role_as == '1' ? 'Admin' : '' }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="email">Email</label>
                            <input type="text" value="{{ Auth::user()->email }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="date">Date Created</label>
                            <input type="text" value="{{ date("D, d M Y", strtotime(Auth::user()->created_at)) ?? '' }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ url('password/reset')}}" class="btn btn-md btn-warning">Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection