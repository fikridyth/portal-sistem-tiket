<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use App\DataTables\TicketDataTable;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TicketDataTable $dataTable)
    {
        $title = 'Master Ticket';

        return $dataTable->render('master.ticket.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Ticket';
        $events = Event::all();

        return view('master/ticket/create', compact('title', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $data = [
            'id_event' => $request->id_event,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kuota' => $request->kuota,
            'keterangan' => $request->keterangan,
            'created_by' => auth()->user()->id,
        ];

        Ticket::create($data);

        return Redirect::route('master.ticket.index')
            ->with('alert.status', '00')
            ->with('alert.message', "Add Ticket Success!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Show Ticket';
        $ticket = Ticket::find($id);
        $tanggalMulai = Carbon::parse($ticket->event->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($ticket->event->tanggal_selesai);

        return view('master/ticket/show', compact('title', 'ticket', 'tanggalMulai', 'tanggalSelesai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Ticket';
        $ticket = Ticket::find($id);
        $events = Event::whereNotIn('id', [$ticket->event->id])->get();

        return view('master/ticket/edit', compact('title', 'ticket', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, string $id)
    {
        $ticket = Ticket::find($id);

        $data = [
            'id_event' => $request->id_event,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kuota' => $request->kuota,
            'keterangan' => $request->keterangan
        ];

        $ticket->update($data);

        return Redirect::route('master.ticket.index')
            ->with('alert.status', '00')
            ->with('alert.message', "Update Ticket Success!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ticket::find($id)->delete();

        return Redirect::route('master.ticket.index')
            ->with('alert.status', '01')
            ->with('alert.message', "Delete Ticket Success!");
    }
}
