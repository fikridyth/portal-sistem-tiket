<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Exception;

class TicketController extends Controller
{
    public function index(String $id)
    {
        try {
            $tickets = Ticket::where('id_event', $id)->get();

            if ($tickets->isEmpty()) {
                throw new Exception("Tickets not found for ID Event: $id");
            }

            return response()->json([
                'success' => true,
                'data' => $tickets
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
