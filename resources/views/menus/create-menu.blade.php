@extends('layouts.index')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Product Add</h4>
            <h6>Create new product</h6>
        </div>
    </div>

    {{-- Pesan Alert --}}
    <x-alert-message type="danger" />

    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="select" name="category_id">
                                <option>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> Avatar</label>
                            <div class="image-upload">
                                <input type="file" id="fileInput" name="image">
                                <div class="image-uploads">
                                    <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pindahkan #menuListContainer keluar dari form-group -->
                    <div class="col-lg-12">
                        <div id="menuListContainer" class="custom-upload-container">
                            <ul class="row" id="menuList">
                                <!-- List of uploaded images will appear here -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                        <a href="productlist.html" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/file-uploader.js') }}"></script>
    @endpush
@endsection
