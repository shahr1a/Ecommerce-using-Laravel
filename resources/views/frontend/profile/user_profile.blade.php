@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                @include('frontend.profile.body.user_profile_sidebar')
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center">
                            <span class="text-danger">Hi....</span><strong>{{ Auth::user()->name }}</strong> Update
                            your profile
                        </h3>

                        <div class="card-body">
                            <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="email">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="phone_number">Phone </label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ $user->phone_number }}">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="profile_photo_path">User Image</label>
                                    <input type="file" name="profile_photo_path" class="form-control"
                                        value="{{ $user->phone_number }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
