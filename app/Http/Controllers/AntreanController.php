<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AntreanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('antrean.index');
    }

    public function getData()
    {
        $antrean = Pendaftaran::with('pasien')->orderBy('created_at');

        return datatables()->of($antrean)
            ->addIndexColumn()
            ->make(true);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['Dipanggil']),
            ],
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($pendaftaran->status !== 'Menunggu') {
            return response()->json([
                'message' => 'Antrean ini tidak lagi berstatus Menunggu.',
            ], 422);
        }

        $pendaftaran->status = $validated['status'];
        $pendaftaran->save();

        return response()->json([
            'message' => 'Status antrean berhasil diperbarui.',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
