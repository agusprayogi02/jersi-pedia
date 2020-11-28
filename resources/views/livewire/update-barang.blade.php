<div class="container row justify-content-end">
    <div class="col-md-9 card">
        <form enctype="multipart/form-data" wire:submit.prevent="update">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Barang</h5>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-md-4 col-form-label">Nama</label>

                    <div class="col-md-8">
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                            wire:model="nama" value="{{ old('nama') }}" autofocus>

                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="harga" class="col-md-4 col-form-label">Harga</label>

                    <div class="col-md-8">
                        <div class="input-group @error('harga') is-invalid @enderror">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="harga_nameset">Rp.</span>
                            </div>
                            <input id="harga" type="number" class="form-control" wire:model="harga"
                                value="{{ old('harga') }}">
                        </div>

                        @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="harga_nameset" class="col-md-4 col-form-label">Harga
                        nameset</label>

                    <div class="col-md-8">
                        <div class="input-group @error('harga_nameset') is-invalid @enderror">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="harga_nameset">Rp.</span>
                            </div>
                            <input id="harga_nameset" type="number" class="form-control" wire:model="harga_nameset"
                                value="{{ old('harga_nameset') }}">
                        </div>
                        @error('harga_nameset')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="liga_id" class="col-md-4 col-form-label">Liga</label>

                    <div class="col-md-8">
                        <select wire:model="liga_id" id="liga_id"
                            class="form-control @error('liga_id') is-invalid @enderror">
                            <option>Pilih Laga</option>
                            @foreach ($ligas as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>

                        @error('liga_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="berat" class="col-md-4 col-form-label">Berat</label>

                    <div class="col-md-8">
                        <div class="input-group @error('berat') is-invalid @enderror">
                            <input id="berat" type="number" class="form-control" wire:model="berat"
                                value="{{ old('berat') }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="berat">Gram</span>
                            </div>
                        </div>

                        @error('berat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="customFile" class="col-md-4 col-form-label">gambar</label>

                    <div class="col-md-8">
                        <div class="custom-file @error('gambar') is-invalid @enderror">
                            <input type="file" wire:model="gambar" class="form-control" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        @if ($gambar)
                        <img class="img-thumbnail mt-2" style="width: 16em" src="{{ $gambar->temporaryUrl() }}">
                        @else
                        <img class="img-thumbnail mt-2" style="width: 16em"
                            src="{{ asset('jersey/' . $product->gambar) }}">
                        @endif
                        <br>
                        <div wire:loading wire:target="gambar" class="text-danger">Uploading...</div>
                        @error('gambar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('products') }}" class="btn btn-secondary">Close</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>