<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Transaction;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $user = User::where('id', auth()->user()->id)->first();
        $events = Event::orderBy('created_at', 'desc')->paginate(3);
        foreach ($events as $event) {
            $event->tanggal_mulai = Carbon::parse($event->tanggal_mulai);
            $event->tanggal_selesai = Carbon::parse($event->tanggal_selesai);
        }
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(3);

        return view('dashboard', compact('title', 'user', 'events', 'transactions'));
    }
}
