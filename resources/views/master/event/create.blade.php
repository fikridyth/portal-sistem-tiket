@extends('main')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active h3" aria-current="page">Master Event</li>
                        <li class="breadcrumb-item active h3" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>

            <div class="mt-2">
                <a href="{{ route('master.event.index') }}" type="button" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <form action="{{ route('master.event.store') }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                            class="form-control @error('nama') is-invalid @enderror" autocomplete="off" />
                        <label class="form-label" for="nama">Nama</label>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="text" id="kategori" name="kategori" value="{{ old('kategori') }}"
                            class="form-control @error('kategori') is-invalid @enderror" autocomplete="off" />
                        <label class="form-label" for="kategori">Kategori</label>
                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            class="form-control @error('lokasi') is-invalid @enderror" autocomplete="off" />
                        <label class="form-label" for="lokasi">Lokasi</label>
                        @error('lokasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi') }}"
                            class="form-control @error('provinsi') is-invalid @enderror" autocomplete="off" />
                        <label class="form-label" for="provinsi">Provinsi</label>
                        @error('provinsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <textarea type="text" id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                            autocomplete="off" />{{ old('deskripsi') }}</textarea>
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <textarea type="text" id="informasi" name="informasi" class="form-control @error('informasi') is-invalid @enderror"
                            autocomplete="off" />{{ old('informasi') }}</textarea>
                        <label class="form-label" for="informasi">Informasi</label>
                        @error('informasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="form-control @error('tanggal_mulai') is-invalid @enderror" autocomplete="off" />
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="form-control @error('tanggal_selesai') is-invalid @enderror" autocomplete="off" />
                        <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div>
                    <div class="mb-2 d-flex justify-content-center">
                        <div data-mdb-ripple-init class="btn btn-success btn-rounded">
                            <label class="form-label text-white m-1" for="gambar">Pilih Gambar</label>
                            <input type="file" class="form-control d-none" id="gambar"
                                onchange="displaySelectedImage(event, 'selectedImage')" name="gambar"
                                accept=".jpg,.jpeg,.png" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img id="selectedImage" class="m-1"
                            src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder"
                            style="height: 250px; width: auto;" />
                    </div>
                </div>
            </div>

            <div class="mb-7">
                <button type="submit" class="btn btn-primary btn-block mt-4 mb-7">Tambah</button>
            </div>
        </form>
    </div>
@endsection

<script>
    function displaySelectedImage(event, elementId) {
        const selectedImage = document.getElementById(elementId);
        const fileInput = event.target;

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                selectedImage.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
