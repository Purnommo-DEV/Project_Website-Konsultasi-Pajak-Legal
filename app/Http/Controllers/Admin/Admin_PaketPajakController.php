<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaketPajak;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Admin_PaketPajakController extends Controller
{
    public function halaman_paket_pajak()
    {
        return view('Admin.paket_pajak.paket_pajak');
    }

    public function data_paket_pajak(Request $request)
    {
        $data = PaketPajak::select([
            'p_pajak.*'
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

    public function tambah_paket_pajak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paket' => 'required',
            'isi' => 'required',
            'tarif' => 'required',
            'path' => 'required',
        ], [
            'paket.required' => 'Wajib diisi',
            'isi.required' => 'Wajib diisi',
            'tarif.required' => 'Wajib diisi',
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
                $path = $request->file('path')->store('gambar_paket_pajak', 'public');
            }
            $tambah_paket_pajak = PaketPajak::create([
                'paket' => $request->paket,
                'slug' => Str::slug($request->paket),
                'isi' => $request->isi,
                'tarif' => str_replace(['Rp. ', '.', '.'], ['', '', ''], $request->tarif),
                'keterangan' => $request->keterangan,
                'path' => $path
            ]);

            if (!$tambah_paket_pajak) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambahkan Paket Pajak'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Paket Pajak'
                ]);
            }
        }
    }

    public function tampil_data_paket_pajak($paket_pajak_id)
    {
        $data_paket_pajak = PaketPajak::where('id', $paket_pajak_id)->first();
        return response()->json([
            'data' => $data_paket_pajak
        ]);
    }

    public function proses_edit_data_paket_pajak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paket' => 'required',
            'isi' => 'required',
            'tarif' => 'required',
        ], [
            'paket.required' => 'Wajib diisi',
            'isi.required' => 'Wajib diisi',
            'tarif.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_paket_pajak = PaketPajak::where('id', $request->paket_pajak_id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_pajak', 'public');
                $posisi_file = 'storage/' . $data_paket_pajak->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            } else {
                $path = $data_paket_pajak->path;
            }
            $ubah_paket_pajak = $data_paket_pajak->update([
                'paket' => $request->paket,
                'slug' => Str::slug($request->paket),
                'isi' => $request->isi,
                'tarif' => str_replace(['Rp. ', '.', '.'], ['', '', ''], $request->tarif),
                'keterangan' => $request->keterangan,
                'path' => $path
            ]);

            if (!$ubah_paket_pajak) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Paket Pajak'
                ]);
            } else {
                return response()->json([
                    'status_berhasil_ubah' => 1,
                    'msg' => 'Berhasil Mengubah Paket Pajak'
                ]);
            }
        }
    }

    public function hapus_data_paket_pajak($paket_pajak_id)
    {
        $hapus_paket_pajak = PaketPajak::find($paket_pajak_id);
        $path = 'storage/' . $hapus_paket_pajak->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_paket_pajak->delete();
        return response()->json([
            'status_berhasil_hapus' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
}
