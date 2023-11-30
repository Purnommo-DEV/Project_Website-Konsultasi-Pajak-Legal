<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\PaketNotaris;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaketNotaris_Child1;
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
            'p_pel_notaris' => 'required'
        ], [
            'p_pel_notaris.required' => 'Wajib diisi'
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
                $path = $request->file('path')->store('gambar_paket_pelayanan_notaris', 'public');
            }
            PaketNotaris::create([
                'p_pel_notaris' => $request->p_pel_notaris,
                'slug' => Str::slug($request->p_pel_notaris),
                'path' => $path ?? null
            ]);

            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil Menambahkan Paket Pelayanan Notaris'
            ]);
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

    // DETAIL PELAYANAN NOTARIS
    public function halaman_detail_paket_pelayanan_notaris($slug)
    {
        $data_pelayanan_notaris = PaketNotaris::where('slug', $slug)->first();
        return view('Admin.paket_pelayanan_notaris.detail_paket_pelayanan_notaris', compact('data_pelayanan_notaris'));
    }

    public function data_paket_pelayanan_notaris_child1(Request $request)
    {
        $data = PaketNotaris_Child1::select([
            'p_pel_notaris_child_1.*'
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

    public function tambah_paket_pelayanan_notaris_child1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'req_p_pel_notaris_id' => 'required|numeric',
            'p_pel_notaris_child_1' => 'required',
            'tarif' => 'required',
            'path' => 'mimes:jpeg,png,jpg|max:1024'
        ], [
            'p_pel_notaris_child_1.required' => 'Wajib diisi',
            'tarif.required' => 'Wajib diisi',
            'req_p_pel_notaris_id.numeric' => 'Wajib berisi angka',
            'path.mimes' => 'Format gambar yang diizinkan jpeg, jpg dan png',
            'path.max' => 'Ukuran gambar maksimal 1MB'
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
                $path = $request->file('path')->store('gambar_paket_pelayanan_notaris/child_1', 'public');
            }
            $data_pelayanan_notaris = PaketNotaris::where('id', $request->req_p_pel_notaris_id)->count();
            if ($data_pelayanan_notaris != 0) {
                PaketNotaris_Child1::create([
                    'p_pel_notaris_id' => $request->req_p_pel_notaris_id,
                    'p_pel_notaris_child_1' => help_hapus_spesial_karakter($request->p_pel_notaris_child_1),
                    'isi' => help_hapus_spesial_karakter($request->isi),
                    'tarif' => help_hapus_format_rupiah($request->tarif),
                    'path' => $path ?? null
                ]);
                return response()->json([
                    'status_berhasil_tambah' => 1,
                    'msg' => 'Berhasil Menambahkan Paket Pelayanan Notaris'
                ]);
            } else {
                return response()->json([
                    'status_pelayanan_tidak_ada' => 1,
                    'msg' => 'Jenis layanan notaris yang anda masukkan tidak ada'
                ]);
            }
        }
    }

    public function tampil_data_paket_pelayanan_notaris_child1($p_pel_notaris_child1)
    {
        $data_paket_pelayanan_notaris_child1 = PaketNotaris_Child1::where('id', $p_pel_notaris_child1)->first();
        return response()->json([
            'data' => $data_paket_pelayanan_notaris_child1
        ]);
    }

    public function proses_edit_data_paket_pelayanan_notaris_child1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_pel_notaris_child_1' => 'required',
            'tarif' => 'required'
        ], [
            'p_pel_notaris_child_1	.required' => 'Wajib diisi',
            'tarif.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_paket_pelayanan_notaris_child1 = PaketNotaris_Child1::where('id', $request->req_p_pel_notaris_child_1_id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_pelayanan_notaris/child_1', 'public');
                $posisi_file = 'storage/' . $data_paket_pelayanan_notaris_child1->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            }
            $ubah_paket_pelayanan_notaris = $data_paket_pelayanan_notaris_child1->update([
                'p_pel_notaris_child_1' => help_hapus_spesial_karakter($request->p_pel_notaris_child_1),
                'isi' => help_hapus_spesial_karakter($request->isi),
                'tarif' => help_hapus_format_rupiah($request->tarif),
                'path' => $path ?? null
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

    public function hapus_data_paket_pelayanan_notaris_child1($p_pel_notaris_child1_id)
    {
        $hapus_paket_pelayanan_notaris_child1 = PaketNotaris_Child1::find($p_pel_notaris_child1_id);
        $path = 'storage/' . $hapus_paket_pelayanan_notaris_child1->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_paket_pelayanan_notaris_child1->delete();
        return response()->json([
            'status_berhasil' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
}
