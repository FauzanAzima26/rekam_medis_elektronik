<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasien = Pasien::select('id', 'no_rm', 'nama_lengkap')->get();

        return view('pendaftaran.index', compact('pasien'));
    }

    public function getData()
    {
        $pendaftaran = Pendaftaran::with('pasien')->orderBy('created_at');

        return datatables()->of($pendaftaran)
            ->addIndexColumn()
            ->make(true);
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
        $validated = $request->validate([
            'no_antrean'         => 'required|string|max:255',
            'pasien_id' => 'required|exists:pasiens,id',
            'tanggal_kunjungan'  => 'required|date',
            'jenis_kunjungan'    => 'required|string|max:255',
            'keluhan'       => 'required|string',
        ]);

        $pendaftaran = Pendaftaran::create($validated);

        return response()->json(['success' => true, 'data' => $pendaftaran]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pendaftaran = Pendaftaran::with('pasien')->findOrFail($id);

        return response()->json(['success' => true, 'data' => $pendaftaran]);
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
        $validated = $request->validate([
            'no_antrean' => 'required',
            'pasien_id' => 'required|exists:pasiens,id',
            'tanggal_kunjungan' => 'required|date',
            'jenis_kunjungan' => 'required|string|max:255',
            'keluhan' => 'required|string',
        ]);

        // Simpan perubahan
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Pendaftaran berhasil diperbarui',
            'data' => $pendaftaran
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data pendaftaran berhasil dihapus'
        ]);
    }
}
