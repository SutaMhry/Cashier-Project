@extends('layouts.sales')
@section('content')

<style>
    /* Modal */
.modal {
    display: none; /* Sembunyikan modal secara default */
    position: fixed; /* Tetap di tempat saat scroll */
    z-index: 1; /* Di atas semua konten lainnya */
    left: 0;
    top: 0;
    width: 100%; /* Lebar penuh */
    height: 100%; /* Tinggi penuh */
    overflow: auto; /* Tambahkan scroll jika dibutuhkan */
    background-color: rgb(0, 0, 0); /* Warna latar belakang */
    background-color: rgba(0, 0, 0, 0.4); /* Warna latar belakang dengan transparansi */
}

/* Konten Modal */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% dari atas dan di tengah */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Lebar */
}

/* Tombol Tutup */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>
    <div class="page-wrapper ms-0">
        <div class="content">
            <div class="row">
                <div class="col-lg-12 col-sm-12 tabs_wrapper">
                    {{-- <div class="page-header">
                        <div class="page-title">
                            <h4>Categories</h4>
                            <h6>Manage your purchases</h6>
                        </div>
                    </div> --}}
                    <ul class="tabs owl-carousel owl-theme owl-product border-0">
                        @foreach ($categories as $category)
                            <li id="{{ Str::slug($category->name) }}" class="{{ $loop->first ? 'active' : '' }}"
                                data-tab="{{ Str::slug($category->name) }}"
                                onclick="selectCategory('{{ Str::slug($category->name) }}')">
                                <div class="product-details">
                                    <h6>{{ $category->name }}</h6>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div id="itemList" class="tabs_container">
                        @foreach ($categories as $category)
                            <div class="tab_content {{ $loop->first ? 'active' : '' }}"
                                data-tab="{{ Str::slug($category->name) }}">
                                <div class="row">
                                    @foreach ($category->menus as $menu)
                                        <div class="col-lg-2 col-sm-6 d-flex">
                                            <div class="productset flex-fill active">
                                                <div class="productsetimg">
                                                    <img src="{{ asset('storage/image/' . $menu->image) }}" alt="image">
                                                    <h6>Stok: {{ $menu->stock }}</h6>
                                                </div>
                                                <div class="productsetcontent">
                                                    <h4>{{ $menu->name }}</h4>
                                                    <h6>{{ format_rupiah($menu->price) }}</h6>
                                                    <button class="btn orderButton" data-name="{{ $menu->name }}"
                                                        data-price="{{ $menu->price }}" data-stock="{{ $menu->stock }}"
                                                        onclick="handleOrder(this)">
                                                        Pesan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="footerCart" class="cart" onclick="openCartModal()">
                        <div class="cart-item-count">0 item</div>
                        <div class="price-amount">Rp 0</div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <!-- Kontainer Modal -->
<div id="cartModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Detail Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="modalCartDetails">
                <!-- Detail Pesanan akan diisi oleh JavaScript -->
            </tbody>
        </table>
        <h3 id="totalAmount">Total: Rp 0</h3>
    </div>
</div>


    @push('scripts')
        <script src="{{ asset('assets/js/pos.js') }}"></script>
    @endpush
@endsection
