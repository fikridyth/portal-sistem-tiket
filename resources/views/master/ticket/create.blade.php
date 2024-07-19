@extends('main')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active h3" aria-current="page">Master Ticket</li>
                        <li class="breadcrumb-item active h3" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>

            <div class="mt-2">
                <a href="{{ route('master.ticket.index') }}" type="button" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <form action="{{ route('master.ticket.store') }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="row mb-4">
                <div class="col">
                    <select class="form-select @error('id_event') is-invalid @enderror" id="id_event" name="id_event" data-control="select">
                        <option value="">---Select Event---</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" >{{ $event->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_event')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

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
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="number" id="harga" name="harga" value="{{ old('harga') }}"
                            class="form-control @error('harga') is-invalid @enderror" autocomplete="off" />
                        <label class="form-label" for="harga">Harga</label>
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <input type="number" id="kuota" name="kuota" value="{{ old('kuota') }}"
                            class="form-control @error('kuota') is-invalid @enderror" autocomplete="off" />
                        <label class="form-label" for="kuota">Kuota</label>
                        @error('kuota')
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
                        <textarea type="text" id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                            autocomplete="off" />{{ old('keterangan') }}</textarea>
                        <label class="form-label" for="keterangan">Keterangan</label>
                        @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-7">
                <button type="submit" class="btn btn-primary btn-block mt-4 mb-7">Tambah</button>
            </div>
        </form>
    </div>
@endsection
