<?php

namespace App\Http\Controllers;

use App\Models\TabunganModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TabunganController extends Controller
{
    public function index()
    {
        $tabungan = TabunganModel::all();

        return response()->json([
            'status' => 'success',
            'data' => $tabungan,
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'nama_tabungan' => 'required',
            'photo_url' => 'nullable',
            'target_nominal' => 'required',
            'status' => 'required',
            'target_tanggal' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ]);
        }

        $tabungan = TabunganModel::create(request()->only([
            'id_user',
            'nama_tabungan',
            'photo_url',
            'target_nominal',
            'status',
            'target_tanggal',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil disimpan',
            'data' => $tabungan,
        ]);
    }

    public function update(Request $request, $id_tabungan){
        $tabungan = TabunganModel::find($id_tabungan);

        if (!$id_tabungan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data riwayat tabungan tidak ditemukan.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'nama_tabungan' => 'required',
            'photo_url' => 'nullable',
            'target_nominal' => 'required',
            'status' => 'required',
            'target_tanggal' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $tabungan->update(request()->only([
            'id_user',
            'nama_tabungan',
            'photo_url',
            'target_nominal',
            'status',
            'target_tanggal',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil diupdate',
            'data' => $tabungan,
        ]);
    }

    public function destroy($id_tabungan){
        $tabungan = TabunganModel::find($id_tabungan);

        if (!$id_tabungan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data riwayat tabungan tidak ditemukan.',
            ], 404);
        }

        $tabungan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil dihapus',
        ]);
    }
}
