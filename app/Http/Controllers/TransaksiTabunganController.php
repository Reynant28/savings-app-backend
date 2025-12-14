<?php

namespace App\Http\Controllers;

use App\Models\TransaksiTabunganModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class TransaksiTabunganController extends Controller
{
    public function index()
    {
        $tabungan = TransaksiTabunganModel::all();

        return response()->json([
            'status' => 'success',
            'data' => $tabungan,
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_tabungan' => 'required|exists:tb_tabungan,id_tabungan',
            'nominal' => 'required',
            'tanggal' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ]);
        }

        $tabungan = TransaksiTabunganModel::create(request()->only([
            'id_tabungan',
            'nominal',
            'tanggal',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil disimpan',
            'data' => $tabungan,
        ]);
    }

    public function update(Request $request, $id_riwayat){

        $riwayat_tabungan = TransaksiTabunganModel::find($id_riwayat);

        if (!$riwayat_tabungan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data riwayat tabungan tidak ditemukan.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_tabungan' => 'required|exists:tb_tabungan,id_tabungan',
            'nominal' => 'required',
            'tanggal' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $riwayat_tabungan->id_tabungan = $request->id_tabungan;
        $riwayat_tabungan->nominal = $request->nominal;
        $riwayat_tabungan->tanggal = $request->tanggal;
        $riwayat_tabungan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil diupdate',
            'data' => $riwayat_tabungan,
        ]);
    }

    public function destroy($id_riwayat){
        $riwayat_tabungan = TransaksiTabunganModel::find($id_riwayat);

        if (!$riwayat_tabungan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data riwayat tabungan tidak ditemukan.',
            ], 404);
        }

        $riwayat_tabungan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil dihapus',
        ]);
    }
}
