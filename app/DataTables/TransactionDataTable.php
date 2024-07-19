<?php

namespace App\DataTables;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query->filter(request(['periode']))->orderBy('created_at', 'desc')))
            ->addIndexColumn()
            ->addColumn('event', function ($row) {
                return $row->ticket->event->nama;
            })
            ->addColumn('ticket', function ($row) {
                return $row->ticket->nama;
            })
            ->addColumn('harga', function ($row) {
                return number_format($row->ticket->harga);
            })
            ->addColumn('total', function ($row) {
                return number_format($row->ticket->harga * $row->jumlah);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->setTimezone('Asia/Jakarta')->format('d F Y, H:i:s');
            })
            ->addColumn('action', function ($row) {
                $btnShow = '<a href="' . route('transaction.show', $row->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye "></i></a>';
                $btnEdit = '<a href="' . route('transaction.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="fa fa-pen "></i></a>';
                $btnDelete = '<a href="#" class="btn btn-danger btn-sm" onclick="deleteData(' . $row->id . ')" ><i class="fa fa-trash"></i></a>';

                $button = '<form id="delete-form-' . $row->id . '" action="' . route('transaction.destroy', $row->id) . '" method="POST" style="display: none;">';
                $button .= csrf_field();
                $button .= method_field('DELETE');
                $button .= '</form>';
                $button .= '<div class="d-flex justify-content-center">';
                $button .= '<div style="margin-right: 5px;">' . $btnShow . '</div>';
                $button .= '<div style="margin-right: 5px;">' . $btnEdit . '</div>';
                $button .= $btnDelete . '</div>';
                return $button;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaction $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transaction-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->language(['processing' => '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'])
            ->parameters([
                "lengthMenu" => [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100]
                ]
            ])
            ->buttons([''])
            ->addTableClass('table align-middle table-rounded table-striped table-row-gray-300 fs-6 gy-5');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No.')->searchable(false)->orderable(false)->addClass('text-center'),
            Column::make('created_at')->title('Tanggal')->addClass('text-center'),
            Column::make('event')->addClass('text-center'),
            Column::make('ticket')->addClass('text-center'),
            Column::make('harga')->addClass('text-center'),
            Column::make('jumlah')->addClass('text-center'),
            Column::make('total')->addClass('text-center'),
            Column::make('nama')->addClass('text-center'),
            Column::make('email')->addClass('text-center'),
            Column::make('telepon')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaction_' . date('YmdHis');
    }
}
