@extends('layouts.index')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/photo-edit.css') }}">
    @endpush

    <div class="page-header">
        <div class="page-title">
            <h4>User Edit</h4>
            <h6>Update user</h6>
        </div>
    </div>

    {{-- Pesan Alert --}}
    <x-alert-message type="danger" />

    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="name" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="name" value="{{ $user->address }}" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="name" value="{{ $user->phone }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Image</label>
                            @if ($user->image)
                                <div class="mt-3" id="currentImageContainer">
                                    <div class="image-preview">
                                        <div class="image-details">
                                            <img src="{{ asset('storage/image/' . $user->image) }}" alt="Current Image"
                                                id="currentImage">
                                            <div class="file-info">
                                                <div style="flex-grow: 1; overflow: hidden;">
                                                    <h2
                                                        style="font-size: 14px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ $user->image }}
                                                    </h2>
                                                    @php
                                                        $filePath = public_path('storage/image/' . $user->image);
                                                        $fileSizeFormatted = getFileSizeFormatted($filePath);
                                                    @endphp
                                                    <h3 style="font-size: 12px; color: #888; margin: 0;">
                                                        {{ $fileSizeFormatted }}
                                                    </h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="image-action">
                                            <label for="fileInput" class="btn btn-submit" id="changeImageBtn">
                                                Change Image
                                            </label>
                                            <input type="file" id="fileInput" class="hidden-input" name="image">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('menus.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/photo-edit.js') }}"></script>
    @endpush

@endsection
