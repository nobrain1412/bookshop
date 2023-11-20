@extends('layouts.admin')
@section('title')
    Thêm mới tác giả
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm mới tác giả</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @csrf
            <!-- DataTales Example -->
            <div class="card card-primary">
                <div class="card-body">
                    <form action="{{ route('author.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên tác giả<span class="text-danger">(*)</span></label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh tác giả</label>
                            <input class="form-control" name="image" type="file" id="image_url">
                            <img src="" class="mt-2" width="100" id="image_preview" alt="">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Quốc tịch<span class="text-danger">(*)</span></label>
                            <input type="text" id="nationality" name="nationality" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" id="facebook" name="facebook" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" id="instagram" name="instagram" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" id="twitter" name="twitter" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Ngày sinh</label>
                            <input type="date" id="birth_date" name="birth_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="number" id="phone" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">(*)</span></label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select id="status" class="form-control custom-select" name="status">
                                <option selected="" disabled="">Chọn 1</option>
                                <option value="1" selected>Kích hoạt</option>
                                <option value="0">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="biography">Tiểu sử</label>
                            <textarea id="biography" name="biography" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <a href="{{ route('author.index') }}" class="btn btn-info">Danh sách</a>
                        <button type="reset" class="btn btn-secondary">Nhập lại</button>
                    </form>
                </div>
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

        $(function () {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image_url").change(function () {
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
        // Add an event listener to select/deselect all checkboxes
        document.getElementById('select-all-checkboxes').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('input[name="parent_id[]"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });

    </script>
@endpush
