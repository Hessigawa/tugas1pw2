<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = Ticket::with('event')->get();

        if ($ticket->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada ticket yang ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Ticket ditemukan.',
            'data' => $ticket
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'event_id' => 'required|exists:events,id',
            'type'     => 'required|string|max:50',
            'price'    => 'required|integer|min:0'
        ]);

        $ticket = Ticket::create($validate);

        if ($ticket) {
            return response()->json([
                'success' => true,
                'message' => 'Ticket berhasil ditambahkan.',
                'data'    => $ticket
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan ticket.'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with('event')->find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket tidak ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail ticket ditemukan.',
            'data'    => $ticket
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'event_id' => 'required|exists:events,id',
            'type'     => 'required|string|max:50',
            'harga'    => 'required|integer|min:0'
        ]);

        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket tidak ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        $ticket->update($validate);

        return response()->json([
            'success' => true,
            'message' => 'Ticket berhasil diperbarui.',
            'data'    => $ticket
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket tidak ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ticket berhasil dihapus.'
        ], Response::HTTP_OK);
    }
}