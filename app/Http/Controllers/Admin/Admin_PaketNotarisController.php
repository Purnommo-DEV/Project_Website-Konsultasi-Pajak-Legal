<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\PaketNotaris;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Admin_PaketNotarisController extends Controller
{
    public function halaman_paket_pelayanan_notaris()
    {
        return view('Admin.paket_pelayanan_notaris.paket_pelayanan_notaris');
    }

    public function data_paket_pelayanan_notaris(Request $request)
    {
        $data = PaketNotaris::select([
            'p_pel_notaris.*'
        ])->orderBy('created_at', 'desc');

        $rekamFilter = $data->get()->count();
        if ($request->input('length') != -1)
            $data = $data->skip($request->input('start'))->take($request->input('length'));
        $rekamTotal = $data->count();
        $data = $data->get();
        return response()->json([
            'draw' => $request->input('draw'),
            'data' => $data,
            'recordsTotal' => $rekamTotal,
            'recordsFiltered' => $rekamFilter
        ]);
    }

    public function tambah_paket_pelayanan_notaris(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_pel_notaris' => 'required',
            'path' => 'required',
        ], [
            'p_pel_notaris.required' => 'Wajib diisi',
            'path.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_pelayanan_notaris', 'public');
            }
            $tambah_paket_pelayanan_notaris = PaketNotaris::create([
                'p_pel_notaris' => $request->p_pel_notaris,
                'slug' => Str::slug($request->p_pel_notaris),
                'path' => $path
            ]);

            if (!$tambah_paket_pelayanan_notaris) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambahkan Paket Pelayanan Notaris'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Paket Pelayanan Notaris'
                ]);
            }
        }
    }

    public function tampil_data_paket_pelayanan_notaris($paket_pelayanan_notaris_id)
    {
        $data_paket_pelayanan_notaris = PaketNotaris::where('id', $paket_pelayanan_notaris_id)->first();
        return response()->json([
            'data' => $data_paket_pelayanan_notaris
        ]);
    }

    public function proses_edit_data_paket_pelayanan_notaris(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_pel_notaris' => 'required'
        ], [
            'p_pel_notaris	.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_paket_pelayanan_notaris = PaketNotaris::where('id', $request->paket_pelayanan_notaris_id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_pelayanan_notaris', 'public');
                $posisi_file = 'storage/' . $data_paket_pelayanan_notaris->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            } else {
                $path = $data_paket_pelayanan_notaris->path;
            }
            $ubah_paket_pelayanan_notaris = $data_paket_pelayanan_notaris->update([
                'p_pel_notaris' => $request->p_pel_notaris,
                'slug' => Str::slug($request->p_pel_notaris),
                'path' => $path
            ]);

            if (!$ubah_paket_pelayanan_notaris) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Paket Pelayanan Notaris'
                ]);
            } else {
                return response()->json([
                    'status_berhasil_ubah' => 1,
                    'msg' => 'Berhasil Mengubah Paket Pelayanan Notaris'
                ]);
            }
        }
    }

    public function hapus_data_paket_pelayanan_notaris($paket_pelayanan_notaris_id)
    {
        $hapus_paket_pelayanan_notaris = PaketNotaris::find($paket_pelayanan_notaris_id);
        $path = 'storage/' . $hapus_paket_pelayanan_notaris->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_paket_pelayanan_notaris->delete();
        return response()->json([
            'status_berhasil_hapus' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
}
