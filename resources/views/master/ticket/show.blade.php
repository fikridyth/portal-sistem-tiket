@extends('main')
@section('styles')
    <style>
        .form-group {
            display: flex;
            align-items: center;
        }

        .form-label {
            flex: 1;
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active h3" aria-current="page">Master Ticket</li>
                        <li class="breadcrumb-item active h3" aria-current="page">Show</li>
                    </ol>
                </nav>
            </div>

            <div class="mt-2">
                <a href="{{ route('master.ticket.index') }}" type="button" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <hr class="heading-space">
        <div class="text-center">
            <img class="mb-4" src="/storage/{{ $ticket->event->gambar }}" width="400" alt="Gambar Event">
            <h4 class="me-4 mb-4"><u>{{ $ticket->event->nama }} - {{ $ticket->nama }}</u></h4>
        </div>

        <div class="row d-flex justify-content-center mx-5">
            <div class="col-4 text-end"><label class="form-label">Harga :</label></div>
            <div class="col-4 mx-n3"><span>{{ number_format($ticket->harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="row d-flex justify-content-center mx-5">
            <div class="col-4 text-end"><label class="form-label">Kuota :</label></div>
            <div class="col-4 mx-n3"><span>{{ $ticket->kuota }}</span>
            </div>
        </div>

        <div class="row d-flex justify-content-center mx-5">
            <div class="col-4 text-end"><label class="form-label">Keterangan :</label></div>
            <div class="col-4 mx-n3"><span>{{ $ticket->keterangan ?? '-' }}</span>
            </div>
        </div>

        <div class="row d-flex justify-content-center mx-5">
            <div class="col-4 text-end"><label class="form-label">Lokasi :</label></div>
            <div class="col-4 mx-n3"><span>{{ $ticket->event->lokasi }}</span>
            </div>
        </div>

        <div class="row d-flex justify-content-center mx-5">
            <div class="col-4 text-end"><label class="form-label">Provinsi :</label></div>
            <div class="col-4 mx-n3"><span>{{ $ticket->event->provinsi }}</span>
            </div>
        </div>

        <div class="row d-flex justify-content-center mx-5">
            <div class="col-4 text-end"><label class="form-label">Kategori :</label></div>
            <div class="col-4 mx-n3"><span>{{ $ticket->event->kategori }}</span>
            </div>
        </div>

        <div class="row d-flex justify-content-center mx-5">
            <div class="col-4 text-end"><label class="form-label">Deskripsi :</label></div>
            <div class="col-4 mx-n3"><span>{{ $ticket->event->deskripsi }}</span>
            </div>
        </div>

        <div class="row d-flex justify-content-center mx-5">
            <div class="col-4 text-end"><label class="form-label">Informasi :</label></div>
            <div class="col-4 mx-n3"><span>{{ $ticket->event->informasi }}</span>
            </div>
        </div>

        <div class="row d-flex justify-content-center mx-5 mb-4">
            <div class="col-4 text-end"><label class="form-label">Waktu Event :</label></div>
            <div class="col-4 mx-n3"><span>{{ $tanggalMulai->setTimezone('Asia/Jakarta')->format('d F Y') }} -
                {{ $tanggalSelesai->setTimezone('Asia/Jakarta')->format('d F Y') }}</span>
            </div>
        </div>
    </div>
@endsection
