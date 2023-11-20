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
<div class="row" style="width: 300px; margin-left: 400px;">
    <form action="{{route('profile.update')}}" method="post" class="" enctype="multipart/form-data">
        @csrf
        <div class="info">

            <img id="image_preview" style="border-radius: 50%; width: 100px;" src="{{ ($user->image == null) ? asset('images/users/img-01.jpg') : Storage::url($user->image) }}" alt="" srcset="">
            <input name="image" type="file" id="image_url" style="display: none">
            <h3 style="margin-top: 30px;">{{Auth::user()->name}}</h3>
        </div>
        <div class="update-form">

            <div class="form-group">
                <label for="">Tên người dùng</label>
                <input type="text" name="name" class="form-control" placeholder="" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" placeholder="" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" placeholder="" value="{{$user->phone}}">
            </div>
            <div class="form-group">
                <label for="Giới tính"></label>
                <select name="gender" id="" class="form-control">
                    @if($user->gender == 1)
                    <option selected value="1">Nam</option>
                    <option value="2">Nữ</option>
                    @elseif($user->gender == 2)
                    <option value="1">Nam</option>
                    <option selected value="2">Nữ</option>
                    @else
                    <option value="" selected disabled>Chọn giới tính</option>
                    <option value="1">Nam</option>
                    <option value="2">Nữ</option>
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>

        </div>
    </form>
</div>

@endsection
@push('scripts')
<script src="{{ asset('upload_file/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('upload_file/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('upload_file/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script>
    const imagePreview = document.getElementById('image_preview');
    const imageUrlInput = document.getElementById('image_url');

    $(function() {
        function readURL(input, selector) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $(selector).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_url").change(function() {
            readURL(this, '#image_preview');
        });

    });
    imagePreview.addEventListener('click', function() {
        imageUrlInput.click();
    });

    imageUrlInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endpush