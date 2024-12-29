@extends('layouts.index')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Product Add Category</h4>
            <h6>Create new product Category</h6>
        </div>
    </div>

    {{-- Pesan Alert --}}
    <x-alert-message type="danger" />

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name">
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
                        <a href="categorylist.html" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form> 
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/file-uploader.js') }}"></script>
    @endpush
@endsection
