<?php

namespace App\DataTables;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class EventDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query->orderBy('created_at', 'desc')))
            ->addIndexColumn()
            ->editColumn('gambar', function ($row) {
                return "<img width='200' src='/storage/" . $row->gambar . "' />";
            })
            ->editColumn('tanggal_mulai', function ($row) {
                $startDate = Carbon::parse($row->tanggal_mulai);
                return $startDate->setTimezone('Asia/Jakarta')->format('d F Y');
            })
            ->editColumn('tanggal_selesai', function ($row) {
                $endDate = Carbon::parse($row->tanggal_selesai);
                return $endDate->setTimezone('Asia/Jakarta')->format('d F Y');
            })
            ->addColumn('action', function ($row) {
                $btnShow = '<a href="' . route('master.event.show', $row->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye "></i></a>';
                $btnEdit = '<a href="' . route('master.event.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="fa fa-pen "></i></a>';
                $btnDelete = '<a href="#" class="btn btn-danger btn-sm" onclick="deleteData(' . $row->id . ')" ><i class="fa fa-trash"></i></a>';

                $button = '<form id="delete-form-' . $row->id . '" action="' . route('master.event.destroy', $row->id) . '" method="POST" style="display: none;">';
                $button .= csrf_field();
                $button .= method_field('DELETE');
                $button .= '</form>';
                $button .= '<div class="d-flex justify-content-center">';
                $button .= '<div style="margin-right: 5px;">' . $btnShow . '</div>';
                $button .= '<div style="margin-right: 5px;">' . $btnEdit . '</div>';
                $button .= $btnDelete . '</div>';
                return $button;
            })
            ->rawColumns(['gambar' ,'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Event $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('event-table')
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
            Column::make('nama')->addClass('text-center'),
            Column::make('lokasi')->addClass('text-center'),
            Column::make('provinsi')->addClass('text-center'),
            Column::make('kategori')->addClass('text-center'),
            Column::make('deskripsi')->addClass('text-center'),
            Column::make('informasi')->addClass('text-center'),
            Column::make('gambar')->addClass('text-center'),
            Column::make('tanggal_mulai')->addClass('text-center'),
            Column::make('tanggal_selesai')->addClass('text-center'),
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
        return 'Event_' . date('YmdHis');
    }
}
