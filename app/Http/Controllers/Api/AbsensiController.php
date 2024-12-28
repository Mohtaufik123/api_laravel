<?php

// app/Http/Controllers/Api/AbsensiController.php

namespace App\Http\Controllers\Api;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\AbsensiController;

class AbsensiController extends Controller
{
    public function index()
    {
        return response()->json(Absensi::with('pegawai')->get(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable',
            'jam_istirahat' => 'nullable',
            'shift' => 'required|string',
        ]);

        $absensi = Absensi::create($validatedData);

        return response()->json($absensi, 201);
    }

    public function show($id)
    {
        $absensi = Absensi::with('pegawai')->find($id);

        if (!$absensi) {
            return response()->json(['message' => 'Absensi not found'], 404);
        }

        return response()->json($absensi, 200);
    }

    public function update(Request $request, $id)
    {
        $absensi = Absensi::find($id);

        if (!$absensi) {
            return response()->json(['message' => 'Absensi not found'], 404);
        }

        $validatedData = $request->validate([
            'pegawai_id' => 'sometimes|required|exists:pegawais,id',
            'tanggal' => 'sometimes|required|date',
            'jam_masuk' => 'sometimes|required',
            'jam_keluar' => 'nullable',
            'jam_istirahat' => 'nullable',
            'shift' => 'sometimes|required|string',
        ]);

        $absensi->update($validatedData);

        return response()->json($absensi, 200);
    }

    public function destroy($id)
    {
        $absensi = Absensi::find($id);

        if (!$absensi) {
            return response()->json(['message' => 'Absensi not found'], 404);
        }

        $absensi->delete();

        return response()->json(['message' => 'Absensi deleted successfully'], 200);
    }
}

