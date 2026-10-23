<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pasien.index');
    }

    public function getData()
    {
        $pasien = Pasien::orderByDesc('created_at');

        return DataTables::of($pasien)
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
            'no_rm'         => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'gender'        => 'required|in:L,P',
            'usia'       => 'required|integer|min:0',
            'no_hp'         => 'required|string|regex:/^[0-9]{10,13}$/',
            'jenis_pasien'  => 'required|string|max:255',
            'alamat'        => 'required|string|max:255',
        ]);

        $pasien = Pasien::create([
            'no_rm'         => $validated['no_rm'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'tanggal_lahir'  => $validated['tanggal_lahir'],
            'gender'        => $validated['gender'],
            'usia'       => $validated['usia'],
            'no_hp'         => $validated['no_hp'],
            'jenis_pasien'  => $validated['jenis_pasien'],
            'alamat'        => $validated['alamat'],
        ]);

        return response()->json(['success' => true, 'data' => $pasien]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        return response()->json([
            'success' => true,
            'data' => $pasien
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'no_rm' => 'required',
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required',
            'usia' => 'required|integer',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jenis_pasien' => 'required',
        ]);

        // Simpan perubahan
        $pasien->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Pasien berhasil diperbarui',
            'data' => $pasien
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pasien = Pasien::findOrFail($id);
            $pasien->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data pasien berhasil dihapus.'
            ]);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1451) {
                return response()->json([
                    'status' => false,
                    'message' => 'Pasien tidak dapat dihapus karena masih memiliki riwayat kunjungan/pendaftaran di sistem.'
                ], 422);
            }
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan pada database saat menghapus data.'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data pasien tidak ditemukan atau terjadi kesalahan sistem.'
            ], 404);
        }
    }
}
