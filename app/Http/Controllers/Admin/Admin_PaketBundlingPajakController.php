<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaketBundlingPajak;
use App\Http\Controllers\Controller;
use App\Models\PaketBundlingPajak_Child1;
use App\Models\PaketBundlingPajak_Child2;
use App\Models\PaketBundlingPajak_Child3;
use App\Models\PaketPajak;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Admin_PaketBundlingPajakController extends Controller
{
    public function halaman_paket_bundling_pajak()
    {
        return view('Admin.paket_bundling_pajak.paket_bundling_pajak');
    }

    // (MASTER) PAKET BUNDLING PAJAK
    public function data_paket_bundling_pajak(Request $request)
    {
        $data = PaketBundlingPajak::select([
            'p_b_pajak.*'
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

    public function tambah_paket_bundling_pajak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_b_pajak' => 'required',
            'path' => 'required',
        ], [
            'p_b_pajak.required' => 'Wajib diisi',
            'path.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_bundling_pajak', 'public');
            }
            $tambah_paket_bundling_pajak = PaketBundlingPajak::create([
                'p_b_pajak' => $request->p_b_pajak,
                'slug' => Str::slug($request->p_b_pajak),
                'path' => $path
            ]);

            if (!$tambah_paket_bundling_pajak) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambahkan Paket Bundling Pajak'
                ]);
            } else {
                return response()->json([
                    'status_berhasil_tambah' => 1,
                    'msg' => 'Berhasil Menambahkan Paket Bundling Pajak'
                ]);
            }
        }
    }

    public function tampil_data_paket_bundling_pajak($pb_pajak_id)
    {
        $data_paket_bundling_pajak = PaketBundlingPajak::where('id', $pb_pajak_id)->first();
        return response()->json([
            'data' => $data_paket_bundling_pajak
        ]);
    }

    public function proses_edit_data_paket_bundling_pajak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_b_pajak' => 'required',
        ], [
            'p_b_pajak.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_paket_bundling_pajak = PaketBundlingPajak::where('id', $request->paket_bundling_pajak_id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_bundling_pajak', 'public');
                $posisi_file = 'storage/' . $data_paket_bundling_pajak->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            } else {
                $path = $data_paket_bundling_pajak->path;
            }
            $ubah_paket_bundling_pajak = $data_paket_bundling_pajak->update([
                'p_b_pajak' => $request->p_b_pajak,
                'path' => $path
            ]);

            if (!$ubah_paket_bundling_pajak) {
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

    public function hapus_data_paket_bundling_pajak($pb_pajak_id)
    {
        $hapus_paket_bundling_pajak = PaketBundlingPajak::find($pb_pajak_id);
        $path = 'storage/' . $hapus_paket_bundling_pajak->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_paket_bundling_pajak->delete();
        return response()->json([
            'status_berhasil_hapus' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    // DETAIL PAKET BUNDLING PAJAK
    public function halaman_detail_paket_bundling_pajak($slug)
    {
        $data_paket_pajak = PaketPajak::get(['id', 'paket']);
        $data_paket_bundling_pajak = PaketBundlingPajak::where('slug', $slug)->first();
        $data_paket_bundling_pajak_child_1 = PaketBundlingPajak_Child1::where('p_b_pajak_id', $data_paket_bundling_pajak->id)->get();
        return view('Admin.paket_bundling_pajak.detail_paket_bundling_pajak', compact('data_paket_bundling_pajak', 'data_paket_bundling_pajak_child_1', 'data_paket_pajak'));
    }

    public function proses_tambah_jenis_pb_pajak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_b_pajak_child_1' => 'required',
            'path' => 'required'
        ], [
            'p_b_pajak_child_1.required' => 'Wajib diisi',
            'path.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_bundling_pajak', 'public');
            }
            PaketBundlingPajak_Child1::create([
                'p_b_pajak_id' => $request->req_pb_pajak_id,
                'p_b_pajak_child_1' => $request->p_b_pajak_child_1,
                'slug' => Str::slug($request->p_b_pajak_child_1),
                'path' => $path,
            ]);
            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil, Data Berhasil Disimpan',
                // 'view'=>(String)View::make('Back.materi._data_materi')
                // ->with(compact('data_materi'))
            ]);
        }
    }

    public function proses_tambah_sub_jenis_pb_pajak_child2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_b_pajak_child_2' => 'required',
            'path' => 'required'
        ], [
            'p_b_pajak_child_2.required' => 'Wajib diisi',
            'path.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_bundling_pajak', 'public');
            }
            PaketBundlingPajak_Child2::create([
                'p_b_pajak_child_1_id' => $request->req_pb_pajak_child_1_id,
                'p_b_pajak_child_2' => $request->p_b_pajak_child_2,
                'path' => $path,
            ]);
            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil, Data Berhasil Disimpan',
                // 'view'=>(String)View::make('Back.materi._data_materi')
                // ->with(compact('data_materi'))
            ]);
        }
    }

    public function proses_tambah_sub_jenis_pb_pajak_child3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_pajak_id' => 'required',
            'tarif' => 'required'
        ], [
            'p_pajak_id.required' => 'Wajib diisi',
            'tarif.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            PaketBundlingPajak_Child3::create([
                'p_b_pajak_child_2_id' => $request->req_pb_pajak_child_2_id,
                'p_pajak_id' => $request->p_pajak_id,
                'tarif' => $request->tarif
            ]);
            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil, Data Berhasil Disimpan',
                // 'view'=>(String)View::make('Back.materi._data_materi')
                // ->with(compact('data_materi'))
            ]);
        }
    }
}
