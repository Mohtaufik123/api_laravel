<?php

namespace App\Http\Controllers\Api;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PegawaiController;

class PegawaiController extends Controller
{
    public function index()
    {
        return response()->json(Pegawai::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:pegawais,email',
        ]);

        $pegawai = Pegawai::create($validatedData);

        return response()->json($pegawai, 201);
    }

    public function show($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai not found'], 404);
        }

        return response()->json($pegawai, 200);
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai not found'], 404);
        }

        $validatedData = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nomor_telepon' => 'sometimes|required|string|max:15',
            'email' => 'sometimes|required|email|unique:pegawais,email,' . $pegawai->id,
        ]);

        $pegawai->update($validatedData);

        return response()->json($pegawai, 200);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai not found'], 404);
        }

        $pegawai->delete();

        return response()->json(['message' => 'Pegawai deleted successfully'], 200);
    }
}

