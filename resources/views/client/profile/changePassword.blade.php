@extends('client.profile.layout')
@section('profile')
<style>
    .info {
        margin-left: 100px;
        margin-top: 100px;
    }

    .update-form {
        width: 300px;
    }
</style>
<div class="row" style="width: 300px; margin-left: 400px; margin-top: 100px;">
    <form action="{{route('profile.changePassword')}}" method="post" class="" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif
        <div class="update-form">
            <h2>Đổi mật khẩu</h2>
            <div class="form-group">
                <label for="">Mật khẩu cũ</label>
                <input type="password" name="oldPassword" class="form-control" placeholder="nhập mật khẩu cũ">
            </div>
            <div class="form-group">
                <label for="">Mật khẩu mới</label>
                <input type="password" name="password" class="form-control" placeholder="nhập mật khẩu mới ">
            </div>
            <div class="form-group">
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="nhập lại mật khẩu mới">
            </div>

            <button type="submit" class="btn btn-success">Đổi mật khẩu</button>

        </div>
    </form>
</div>

@endsection