@extends('layouts.admin')
@section('title')
    Cập nhập sách
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Cập nhập sách</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('book.update',['id' => $book->id]) }}" method="post"
              enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Tiêu đề<span class="text-danger">(*)</span></label>
                                <input type="text" id="title" name="title" class="form-control"
                                       value="{{ $book->title }}">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" class="form-control"
                                       value="{{ $book->slug }}">
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh<span class="text-danger">(*)</span></label>
                                <input class="form-control" name="image_url" type="file" id="image_url"
                                       value="{{ old('image_url') }}">
                                <img
                                    src="{{ ($book->image_url == null) ? asset('images/image-not-found.jpg') : Storage::url($book->image_url) }}"
                                    width="130" id="image_preview" class="mt-2"
                                    alt="">
                            </div>
                            <div class="form-group">
                                <label for="price">Giá<span class="text-danger">(*)</span></label>
                                <input type="number" id="price" name="price" class="form-control"
                                       value="{{ $book->price }}">
                            </div>
                            <div class="form-group">
                                <label for="stock_quantity">Số lượng sách<span
                                        class="text-danger">(*)</span></label>
                                <input type="number" id="stock_quantity" name="stock_quantity"
                                       class="form-control" value="{{ $book->stock_quantity }}">
                            </div>
                            <div class="form-group">
                                <label for="page">Loại bìa<span class="text-danger">(*)</span></label>
                                <input type="text" id="page" name="page" class="form-control"
                                       value="{{ $book->page }}">
                            </div>
                            <div class="form-group">
                                <label for="publication_date">Ngày xuất bản<span class="text-danger">(*)</span></label>
                                <input type="date" id="publication_date" name="publication_date"
                                       class="form-control" value="{{ substr($book->publication_date, 0, 10) }}">
                            </div>
                            <div class="form-group">
                                <label for="page_count">Số trang<span class="text-danger">(*)</span></label>
                                <input type="number" name="page_count" id="page_count" class="form-control"
                                       value="{{ $book->page_count }}">
                            </div>
                            <div class="form-group">
                                <label for="book_image">Ảnh liên quan</label> <br>
                                <input name="book_image[]" type="file" id="image_url1" multiple
                                       class="form-control" accept="image/*" value="{{ old('book_image') }}">
                                <div id="imagePreview" class="row mt-2">
                                    @foreach($images as $image)
                                        <div class="col-md-3 mt-3 image-list">
                                            <img src="{{ Storage::url($image->book_image) }}" class="img-fluid">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="publisher">Nhà xuất bản<span class="text-danger">(*)</span></label>
                                <input type="text" name="publisher" id="publisher" class="form-control"
                                       value="{{ $book->publisher }}">
                            </div>
                            <div class="form-group">
                                <label for="language">Ngôn ngữ<span class="text-danger">(*)</span></label>
                                <input type="text" name="language" id="language" class="form-control"
                                       value="{{ $book->language }}">
                            </div>
                            <div class="form-group">
                                <label for="author_id">Tác giả<span class="text-danger">(*)</span></label>
                                <select id="author_id" class="form-control custom-select" name="author_id">
                                    <option selected="" disabled="">Chọn 1</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="featured">Đặc sắc<span class="text-danger">(*)</span></label>
                                <select id="featured" class="form-control custom-select" name="featured">
                                    <option selected="" disabled="">Chọn 1</option>
                                    <option value="1" {{ ($book->featured == 1 ? 'selected' : '') }}>Đặc sắc</option>
                                    <option value="0" {{ ($book->featured == 0 ? 'selected' : '') }}>Không đặc sắc</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="book_id">Danh mục<span class="text-danger">(*)</span></label>
                                <div class="container">
                                    <div class="row">
                                        @foreach($categories as $category)
                                            <div class="col-md-3">
                                                <label>
                                                    <input type="checkbox" name="category_id[]"
                                                           value="{{ $category->id }}"   {{ in_array($category->id, $book->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description_short">Mô tả ngắn</label>
                                <textarea id="description_short" name="description_short" class="form-control"
                                          rows="4">{{ $book->description_short }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description_short">Mô tả</label>
                                <textarea id="description" name="description" class="form-control"
                                          rows="4">{{ $book->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái<span class="text-danger">(*)</span></label>
                                <select id="status" class="form-control custom-select" name="status">
                                    <option selected="" disabled="">Chọn 1</option>
                                    <option value="1" {{ ($book->status == 1 ? 'selected' : '') }}>Kích hoạt</option>
                                    <option value="0" {{ ($book->status == 0 ? 'selected' : '') }}>Không kích hoạt</option>
                                </select>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="mb-1 mt-2 ml-2">
                    <button type="submit" class="btn btn-success">Cập nhập</button>
                    <a href="{{ route('book.index') }}" class="btn btn-info">Danh sách</a>
                    <button type="reset" class="btn btn-secondary">Nhập lại</button>
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
        $(document).ready(function () {
            $('#image_url1').on('change', function (event) {
                var files = event.target.files;

                $('#imagePreview').empty();

                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').append(
                            '<div class="col-md-3 mt-3 image-list"><img src="' + e.target.result + '" class="img-fluid" width="100" height="100" <div>'
                        );
                    }
                    reader.readAsDataURL(files[i]);
                }
            });
        });
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
