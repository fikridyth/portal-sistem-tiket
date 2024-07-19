@extends('main')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active h3" aria-current="page">Master Event</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                    Manage Event
                    <div>
                        <a href="{{ route('master.event.create') }}" type="button" class="btn btn-md btn-primary">Add Event</a>
                    </div>
                </div>

                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts() }}
@endsection
