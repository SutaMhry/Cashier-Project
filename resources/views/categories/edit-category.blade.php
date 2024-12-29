@extends('layouts.index')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Product Edit Category</h4>
            <h6>Edit a product Category</h6>
        </div>
    </div>

    {{-- Pesan Alert --}}
    <x-alert-message type="danger" />

    <div class="card">
        <div class="card-body">
            <form action="{{ route('category.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" value="{{ $menu->name }}" name="name"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Product Image</label>
                            @if ($menu->image)
                                <div class="mt-3" id="currentImageContainer">
                                    <div class="image-preview">
                                        <div class="image-details">
                                            <img src="{{ asset('storage/image/' . $menu->image) }}" alt="Current Image"
                                                id="currentImage">
                                            <div class="file-info">
                                                <div style="flex-grow: 1; overflow: hidden;">
                                                    <h2
                                                        style="font-size: 14px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ $menu->image }}
                                                    </h2>
                                                    @php
                                                        $filePath = public_path('storage/image/' . $menu->image);
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
                        <a href="javascript:void(0);" class="btn btn-submit me-2">Submit</a>
                        <a href="categorylist.html" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
