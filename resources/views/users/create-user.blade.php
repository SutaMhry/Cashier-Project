@extends('layouts.index')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>User Management</h4>
            <h6>Add/Update User</h6>
        </div>
    </div>

    {{-- Pesan Alert --}}
    <x-alert-message type="danger" />

    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Employee Name</label>
                            <input type="text" name="name">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Password</label>
                            <div class="pass-group">
                                <input type="password" name="password" class="pass-input" />
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="select" name="role">
                                <option>Choose Role</option>
                                <option value="admin">Admin</option>
                                <option value="employee">Employee</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="notelp">
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
                        <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/file-uploader.js') }}"></script>
    @endpush
@endsection
