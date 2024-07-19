@extends('main')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active h3" aria-current="page">Transaction Ticket Event</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                    Manage Event
                    <div>
                        <a href="{{ route('transaction.export-orders', ['periode' => request('periode') ?: null]) }}" type="button" class="btn btn-md btn-success">Download Excel</a>

                        <button class="btn btn-primary dropdown-toggle mx-3" type="button" data-mdb-dropdown-init
                            data-mdb-ripple-init aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu" style="width: 320px">
                            <form action="{{ route('transaction.index') }}" class="px-4 py-3" method="GET">
                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                <div class="dropdown-divider mb-3"></div>

                                <label class="form-label">Periode</label>
                                <input class="form-control mb-4" placeholder="Choose Periode" id="periode" name="periode"
                                    value="{{ request('periode') }}" autocomplete="off" />

                                <div class="d-flex justify-content-end mr-5">
                                    <button type="submit" class="btn btn-secondary mx-3" id="clear">Clear</button>
                                    <button type="submit" class="btn btn-primary fw-semibold px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="filter"
                                        id="apply">Apply</button>
                                </div>
                            </form>
                        </div>

                        <a href="{{ route('transaction.create') }}" type="button" class="btn btn-md btn-primary">Add Transaction</a>
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

    <script>
        $(function() {
            $('input[name="periode"]').daterangepicker({
                autoUpdateInput: false,
                autoApply: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="periode"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            document.getElementById("clear").addEventListener("click", function() {
                $("#periode").val('');
            });
        });

    </script>
@endsection
