<?php

namespace App\Http\Controllers;

use App\DataTables\EventDataTable;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EventDataTable $dataTable)
    {
        $title = 'Master Event';

        return $dataTable->render('master.event.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Event';

        return view('master/event/create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $file = $request->gambar;
        if ($file) {
            $fileOriginal = str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('event-image', time() . '_' . $fileOriginal, 'public');
        }

        $data = [
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'provinsi' => $request->provinsi,
            'deskripsi' => $request->deskripsi,
            'informasi' => $request->informasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'created_by' => auth()->user()->id,
            'gambar' => $filePath ?? null,
        ];

        Event::create($data);

        return Redirect::route('master.event.index')
            ->with('alert.status', '00')
            ->with('alert.message', "Add Event Success!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Show Event';
        $event = Event::find($id);
        $tanggalMulai = Carbon::parse($event->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($event->tanggal_selesai);

        return view('master/event/show', compact('title', 'event', 'tanggalMulai', 'tanggalSelesai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Event';
        $event = Event::find($id);

        return view('master/event/edit', compact('title', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        $event = Event::find($id);

        if (isset($request->gambar)) {
            $file = $request->gambar;
            $fileOriginal = str_replace(' ', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('event-image', time() . '_' . $fileOriginal, 'public');
        }

        $data = [
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'provinsi' => $request->provinsi,
            'deskripsi' => $request->deskripsi,
            'informasi' => $request->informasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'gambar' => $filePath ?? $event->gambar
        ];

        $event->update($data);

        return Redirect::route('master.event.index')
            ->with('alert.status', '00')
            ->with('alert.message', "Update Event Success!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::find($id)->delete();

        return Redirect::route('master.event.index')
            ->with('alert.status', '01')
            ->with('alert.message', "Delete Event Success!");
    }
}
