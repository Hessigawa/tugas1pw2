<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $event = Event::all();

        if ($event->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada event yang ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'event ditemukan.',
            'data' => $event
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
        'nama' => 'required|unique:event,nama',
        'singkatan' => 'required|max:4'
    ]);

    $event = Event::create($validate);

    if ($event) {
        return response()->json([
            'success' => true,
            'message' => 'Event berhasil ditambahkan.',
            'data'    => $event
        ], Response::HTTP_CREATED);
    }

    return response()->json([
        'success' => false,
        'message' => 'Gagal menambahkan event.'
    ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $event = Event::with('ticket')->find($id);

        if ($event) {
            return response()->json([
                'success' => false,
                'message' => 'Event tidak ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail event ditemukan.',
            'data'    => $event
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate(
            [
                'nama' => 'required',
                'kode' => 'required'
            ]
        );

        Event::where('id', $id)-> update($validate); 
        $event = Event::find($id);
        if($event){
            $data['success'] = true;
            $data['message'] = "Data event berhasil diperbarui";
            $data['data'] = $event;
            return response()->json($data, 201);
        }else {
             $data['success'] = false;
            $data['message'] = "Data event gagal diperbarui";
            return response()->json($data, 201);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $event = Event::where('id', $id);
    if(count($event->get())){
        $event->delete();
        $response['success'] = true;
        $response['message'] = 'Event berhasil dihapus.';
        return response()->json($response, Response::HTTP_OK);
    } else {
        $response['success'] = false;
        $response['message'] = 'Event tidak ditemukan.';
        return response()->json($response, Response::HTTP_NOT_FOUND);
    } 

    }
}
