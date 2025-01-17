<div class="container">
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Jersey</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h2>{{ $title }}</h2>
        </div>
        <div class="col-md-3 text-right">
            @auth
            @if (Auth::user()->role == 1)
            <a href="{{ route('tambah.barang') }}" class="btn btn-primary">Tambah Barang</a>
            @endif
            @endauth
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input wire:model="search" type="text" class="form-control" placeholder="Search . . ."
                    aria-label="Search" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <section class="products mb-5">
        <div class="row mt-4">
            @foreach($products as $product)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('jersey/' . $product->gambar) }}" class="img-fluid">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <h5><strong>{{ $product->nama }}</strong> </h5>
                                <h5>Rp. {{ number_format($product->harga) }}</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                @guest
                                <a href="{{ route('products.detail', $product->id) }}" class="btn btn-dark btn-block"><i
                                        class="fas fa-eye"></i>
                                    Detail</a>
                                @else
                                @if (Auth::user()->role == 1)
                                <a href="{{ route('update.barang', ['id'=>$product->id]) }}"
                                    class="btn btn-warning mr-3">Edit</a>
                                <button wire:click="delete({{ $product->id }})" class="btn btn-danger">Delete</button>
                                @else
                                <a href="{{ route('products.detail', $product->id) }}" class="btn btn-dark btn-block"><i
                                        class="fas fa-eye"></i>
                                    Detail</a>
                                @endif
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</div>