<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabunganModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'nama_tabungan' => 'required',
            'photo_file' => 'nullable',
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

        $photo_file = null;
        if ($request->hasFile('photo_file')) {
            $photo_file = $request->file('photo_file')->store('tabungan_images', 'public');
        }

        $tabungan_data = $request->only(['nama_tabungan', 'target_nominal', 'status', 'target_tanggal']);

        $tabungan_data['id_user'] = Auth::id();

        $tabungan_data['photo_file'] = $photo_file;

        $tabungan = TabunganModel::create($tabungan_data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil disimpan',
            'data' => $tabungan,
        ]);
    }

    public function update(Request $request, $id_tabungan)
    {
        $tabungan = TabunganModel::find($id_tabungan);

        if (!$tabungan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tabungan tidak ditemukan.',
            ], 404);
        }

        if ($tabungan->id_user !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized.',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama_tabungan'   => 'required',
            'photo_file'      => 'nullable',
            'target_nominal'  => 'required',
            'status'          => 'required',
            'target_tanggal'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        if ($request->hasFile('photo_file')) {
            if ($tabungan->photo_file && Storage::disk('public')->exists($tabungan->photo_file)) {
                Storage::disk('public')->delete($tabungan->photo_file);
            }

            $tabungan->photo_file = $request->file('photo_file')
                ->store('tabungan_images', 'public');
        }

        $tabungan->nama_tabungan  = $request->nama_tabungan;
        $tabungan->target_nominal = $request->target_nominal;
        $tabungan->status         = $request->status;
        $tabungan->target_tanggal = $request->target_tanggal;

        $tabungan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tabungan berhasil diperbarui',
            'data' => $tabungan,
        ]);
    }


    public function destroy($id_tabungan){
        $tabungan = TabunganModel::find($id_tabungan);

        if (!$tabungan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data riwayat tabungan tidak ditemukan.',
            ], 404);
        }

        if ($tabungan->photo_file && Storage::disk('public')->exists($tabungan->photo_file)) {
            Storage::disk('public')->delete($tabungan->photo_file);
        }

        $tabungan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil dihapus',
        ]);
    }
}
