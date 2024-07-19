<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionDataTable;
use App\Http\Requests\TransactionRequest;
use App\Exports\TransactionExport;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TransactionDataTable $dataTable)
    {
        $title = 'Transaction Ticket Event';

        return $dataTable->render('transaction.index', compact('title'));
    }

    public function exportTransactions(Request $request)
    {
        $periode = $request->periode ? preg_replace('/[\/\s]/', '', $request->periode) : 'all_periode';
        $export = new TransactionExport($request->periode);

        return Excel::download($export, "Transactions-{$periode}.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Transaction';
        $tickets = Ticket::orderBy('id_event', 'asc')->get();

        return view('transaction/create', compact('title', 'tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        $data = [
            'id_ticket' => $request->id_ticket,
            'tanggal' => now()->format('m/d/Y'),
            'jumlah' => $request->jumlah,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'created_by' => auth()->user()->id,
        ];

        Transaction::create($data);

        return Redirect::route('transaction.index')
            ->with('alert.status', '00')
            ->with('alert.message', "Add Transaction Success!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Show Transaction';
        $transaction = Transaction::find($id);
        $tanggalMulai = Carbon::parse($transaction->ticket->event->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($transaction->ticket->event->tanggal_selesai);

        return view('transaction/show', compact('title', 'transaction', 'tanggalMulai', 'tanggalSelesai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Transaction';
        $transaction = Transaction::find($id);
        $tickets = Ticket::whereNotIn('id', [$transaction->ticket->id])->orderBy('id_event', 'asc')->get();

        return view('transaction/edit', compact('title', 'transaction', 'tickets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, string $id)
    {
        $transaction = Transaction::find($id);

        $data = [
            'id_ticket' => $request->id_ticket,
            'jumlah' => $request->jumlah,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'created_by' => auth()->user()->id,
        ];

        $transaction->update($data);

        return Redirect::route('transaction.index')
            ->with('alert.status', '00')
            ->with('alert.message', "Update Transaction Success!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::find($id)->delete();

        return Redirect::route('transaction.index')
            ->with('alert.status', '01')
            ->with('alert.message', "Delete Transaction Success!");
    }
}
