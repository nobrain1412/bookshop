@extends('layouts.admin')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm Mới Bài Viết</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thêm mới bài viết</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu đề<span class="text-danger">(*)</span></label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image">Ảnh</label>
                        <input class="form-control" name="image" type="file" id="image_url">
                        <img src="" class="mt-2" width="100" id="image_preview" alt="">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Chọn danh mục bài viết<span class="text-danger">(*)</span></label>
                        <div class="container">
                            <div class="row p-3" style="border: 1px solid black">
                                @foreach($postTypes as $postType)
                                    <div class="col-md-4">
                                        <label>
                                            <input type="checkbox" name="post_type[]"
                                                   value="{{ $postType->id }}">
                                            {{ $postType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
                        <div class="row_content ">
                            <textarea name="content" id="content123" cols="30" rows="10" width="100%" height="1000px"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                    <a href="{{ route('post.index') }}" class="btn btn-info">Danh sách</a>
                    <button type="reset" class="btn btn-secondary">Nhập lại</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>

    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('node_modules/ckeditor4/ckeditor.js') }}"></script>
        <script>
            var editor = CKEDITOR.replace('content123');
            CKFinder.setupCKEditor(editor);
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script>
            $('[data-spy="scroll"]').each(function() {
                var $spy = $(this).scrollspy('refresh')
            })
        </script>
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
@endsection
