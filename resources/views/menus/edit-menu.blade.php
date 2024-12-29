@extends('layouts.index')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/photo-edit.css') }}">
    @endpush

    <div class="page-header">
        <div class="page-title">
            <h4>Product Edit</h4>
            <h6>Update your product</h6>
        </div>
    </div>

    {{-- Pesan Alert --}}
    <x-alert-message type="danger" />

    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name" value="{{ $menu->name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="select" name="category" required>
                                <option value="" disabled>Choose Category</option>
                                <option value="makanan" {{ $menu->category === 'makanan' ? 'selected' : '' }}>Food</option>
                                <option value="minuman" {{ $menu->category === 'minuman' ? 'selected' : '' }}>Drink</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" value="{{ $menu->price }}" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" value="{{ $menu->stock }}" required>
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
