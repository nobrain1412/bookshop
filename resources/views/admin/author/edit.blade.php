@extends('layouts.admin')
@section('title')
    Cập nhập tác giả
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Cập nhập tác giả</h1>
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
                <form action="{{ route('author.update',['id' => $author->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên tác giả<span class="text-danger">(*)</span></label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $author->name }}">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="{{ $author->slug  }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Ảnh tác giả</label>
                        <input class="form-control" name="image" type="file" id="image_url">
                        <img width="100" height="140" src="{{ ($author->image == null) ? asset('images/image-not-found.jpg') : Storage::url($author->image) }}" id="image_preview" class="mt-2 img-fluid"
                             alt="">
                    </div>
                    <div class="form-group">
                        <label for="nationality">Quốc tịch<span class="text-danger">(*)</span></label>
                        <input type="text" id="nationality" name="nationality" class="form-control" value="{{ $author->nationality }}">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" id="facebook" name="facebook" class="form-control" value="{{ $author->facebook }}">
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" id="instagram" name="instagram" class="form-control" value="{{ $author->instagram }}">
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" id="twitter" name="twitter" class="form-control" value="{{ $author->twitter }}">
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Ngày sinh</label>
                        <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ substr($author->birth_date, 0, 10) }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="number" id="phone" name="phone" class="form-control" value="{{ $author->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span class="text-danger">(*)</span></label>
                        <input type="text" id="email" name="email" class="form-control" value="{{ $author->email }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select id="status" class="form-control custom-select" name="status">
                            <option selected="" disabled="">Chọn 1</option>
                            <option value="1" {{ ($author->status == 1 ? 'selected' : '') }}>Kích hoạt</option>
                            <option value="0" {{ ($author->status == 0 ? 'selected' : '') }}>Không kích hoạt</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="biography">Tiểu sử</label>
                        <textarea id="biography" name="biography" class="form-control" rows="4">{{ $author->biography }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Cập nhập</button>
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
