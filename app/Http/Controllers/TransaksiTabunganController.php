<?php

namespace App\Http\Controllers;

use App\Models\TabunganModel;
use App\Models\TransaksiTabunganModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class TransaksiTabunganController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id_user;

        $riwayat = TransaksiTabunganModel::whereHas('tabungan', function($query) use ($userId) {
            $query->where('id_user', $userId);
        })->get();

        return response()->json([
            'status' => 'success',
            'data' => $riwayat,
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

        $riwayat = TransaksiTabunganModel::create(request()->only([
            'id_tabungan',
            'nominal',
            'tanggal',
        ]));

        $goal = TabunganModel::with('riwayatTabungan')->find($request->id_tabungan);

        $totalDeposit = $goal->riwayatTabungan->sum('nominal');

        if ($totalDeposit >= $goal->target_nominal) {
            $goal->status = 'selesai';
            $goal->tanggal_selesai = now();
            $goal->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data riwayat tabungan berhasil disimpan',
            'data' => $riwayat,
        ]);
    }
}
