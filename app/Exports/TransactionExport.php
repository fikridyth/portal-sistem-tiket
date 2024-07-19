<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class TransactionExport implements FromView, WithTitle
{
    public function __construct(public $periode)
    {
    }

    public function title(): string
    {
        return 'Transactions ' . $this->periode;
    }

    public function view(): View
    {
        $periode = $this->periode;
        if (isset($periode)) {
            $arrPeriode = explode(' - ', $periode);
            $transactions = Transaction::whereBetween('tanggal', $arrPeriode)->get();
        } else {
            $transactions = Transaction::all();
        }

        $total = $transactions->sum(function($transaction) {
            return $transaction->ticket->harga * $transaction->jumlah;
        });

        return view('exports/transaction', [
            'transactions' => $transactions,
            'total' => $total
        ]);
    }
}
