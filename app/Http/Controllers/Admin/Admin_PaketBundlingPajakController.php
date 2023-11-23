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
    // ========================================================================

    // DETAIL PAKET BUNDLING PAJAK
    public function halaman_detail_paket_bundling_pajak($slug)
    {
        $data_paket_pajak = PaketPajak::get(['id', 'paket']);
        $data_paket_bundling_pajak = PaketBundlingPajak::where('slug', $slug)->first();
        $data_paket_bundling_pajak_child_1 = PaketBundlingPajak_Child1::where('p_b_pajak_id', $data_paket_bundling_pajak->id)->get();
        return view('Admin.paket_bundling_pajak.detail_paket_bundling_pajak', compact('data_paket_bundling_pajak', 'data_paket_bundling_pajak_child_1', 'data_paket_pajak'));
    }
    // =======================================================================


    // CHILD 1
    public function proses_tambah_jenis_pb_pajak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_b_pajak_child_1' => 'required',
            'req_pb_pajak_id' => 'required|numeric',
            'path' => 'mimes:jpeg,png,jpg|max:1024'
        ], [
            'p_b_pajak_child_1.required' => 'Wajib diisi',
            'req_pb_pajak_id.numeric' => 'Wajib berisi angka',
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
                $path = $request->file('path')->store('gambar_paket_bundling_pajak', 'public');
            }
            PaketBundlingPajak_Child1::create([
                'p_b_pajak_id' => $request->req_pb_pajak_id,
                'p_b_pajak_child_1' => help_hapus_spesial_karakter($request->p_b_pajak_child_1),
                'slug' => Str::slug($request->p_b_pajak_child_1),
                'path' => $path ?? null,
            ]);
            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil, Data Berhasil Disimpan',
                // 'view'=>(String)View::make('Back.materi._data_materi')
                // ->with(compact('data_materi'))
            ]);
        }
    }

    public function tampil_data_paket_bundling_pajak_child1($pb_child1_id)
    {
        $data_paket_bundling_pajak_child1 = PaketBundlingPajak_Child1::where('id', $pb_child1_id)->first();
        return response()->json([
            'data' => $data_paket_bundling_pajak_child1
        ]);
    }

    public function proses_edit_data_paket_bundling_pajak_child1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_b_pajak_child_1' => 'required',
            'path' => 'mimes:jpeg,png,jpg|max:1024'
        ], [
            'p_b_pajak_child_1.required' => 'Wajib diisi',
            'path.mimes' => 'Format gambar yang diizinkan jpeg, jpg dan png',
            'path.max' => 'Ukuran gambar maksimal 1MB'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_paket_bundling_pajak_child1 = PaketBundlingPajak_Child1::where('id', $request->p_b_pajak_child_1_id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_bundling_pajak', 'public');
                $posisi_file = 'storage/' . $data_paket_bundling_pajak_child1->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            }
            $edit_paket_bundling_pajak_child1 = $data_paket_bundling_pajak_child1->update([
                'p_b_pajak_child_1' => help_hapus_spesial_karakter($request->p_b_pajak_child_1),
                'path' => $path ?? $data_paket_bundling_pajak_child1->path
            ]);

            if (!$edit_paket_bundling_pajak_child1) {
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

    public function hapus_data_paket_bundling_pajak_child_1($pb_child1_id)
    {
        $hapus_pb_pajak_child1 = PaketBundlingPajak_Child1::find($pb_child1_id);
        $path = 'storage/' . $hapus_pb_pajak_child1->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_pb_pajak_child1->delete();
        return response()->json([
            'status_berhasil_hapus' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
    // ===================================================================


    // CHILD 2
    public function proses_tambah_sub_jenis_pb_pajak_child2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_b_pajak_child_2' => 'required',
            'path' => 'mimes:jpeg,png,jpg|max:1024',
            'req_pb_pajak_child_1_id' => 'required|numeric'
        ], [
            'p_b_pajak_child_2.required' => 'Wajib diisi',
            'path.mimes' => 'Format gambar yang diizinkan jpeg, jpg dan png',
            'req_pb_pajak_child_1_id.numeric' => 'Wajib berisi angka',
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
                $path = $request->file('path')->store('gambar_paket_bundling_pajak', 'public');
            }
            PaketBundlingPajak_Child2::create([
                'p_b_pajak_child_1_id' => $request->req_pb_pajak_child_1_id,
                'p_b_pajak_child_2' => help_hapus_spesial_karakter($request->p_b_pajak_child_2),
                'path' => $path ?? null,
            ]);
            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil, Data Berhasil Disimpan',
                // 'view'=>(String)View::make('Back.materi._data_materi')
                // ->with(compact('data_materi'))
            ]);
        }
    }

    public function tampil_data_paket_bundling_pajak_child2($pb_child2_id)
    {
        $data_paket_bundling_pajak_child2 = PaketBundlingPajak_Child2::where('id', $pb_child2_id)->first();
        return response()->json([
            'data' => $data_paket_bundling_pajak_child2
        ]);
    }

    public function proses_edit_data_paket_bundling_pajak_child2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_b_pajak_child_2' => 'required',
            'path' => 'mimes:jpeg,png,jpg|max:1024'
        ], [
            'p_b_pajak_child_2.required' => 'Wajib diisi',
            'path.mimes' => 'Format gambar yang diizinkan jpeg, jpg dan png',
            'path.max' => 'Ukuran gambar maksimal 1MB'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_paket_bundling_pajak_child1 = PaketBundlingPajak_Child2::where('id', $request->p_b_pajak_child_2_id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_paket_bundling_pajak', 'public');
                $posisi_file = 'storage/' . $data_paket_bundling_pajak_child1->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            }
            $edit_paket_bundling_pajak_child1 = $data_paket_bundling_pajak_child1->update([
                'p_b_pajak_child_2' => help_hapus_spesial_karakter($request->p_b_pajak_child_2),
                'path' => $path ?? $data_paket_bundling_pajak_child1->path
            ]);

            if (!$edit_paket_bundling_pajak_child1) {
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

    public function hapus_data_paket_bundling_pajak_child2($pb_child2_id)
    {
        $hapus_pb_pajak_child2 = PaketBundlingPajak_Child2::find($pb_child2_id);
        $path = 'storage/' . $hapus_pb_pajak_child2->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_pb_pajak_child2->delete();
        return response()->json([
            'status_berhasil_hapus' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
    // ============================================================================


    // CHILD 3
    public function proses_tambah_sub_jenis_pb_pajak_child3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_pajak_id' => 'required|numeric',
            'tarif' => 'required'
        ], [
            'p_pajak_id.required' => 'Wajib diisi',
            'p_pajak_id.numeric' => 'Data harus berisi angka',
            'tarif.required' => 'Wajib diisi'
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_paket_pajak = PaketPajak::where('id', $request->p_pajak_id)->count();
            if ($data_paket_pajak == 0) {
                return response()->json([
                    'status_pajak_tidak_ada' => 1,
                    'msg' => 'Gagal, Periksa kembali pilihan paket anda'
                ]);
            } else {
                $data_pb_pajak_child_3 = PaketBundlingPajak_Child3::query()
                    ->where([['p_b_pajak_child_2_id', $request->req_pb_pajak_child_2_id], ['p_pajak_id', $request->p_pajak_id]])
                    ->exists();

                if ($data_pb_pajak_child_3) {
                    return response()->json([
                        'status_telah_ada_data' => 1,
                        'msg' => 'Gagal, Tidak dapat menambahkan paket, paket telah ditambahkan sebelumnya'
                    ]);
                } else {
                    PaketBundlingPajak_Child3::create([
                        'p_b_pajak_child_2_id' => $request->req_pb_pajak_child_2_id,
                        'p_pajak_id' => $request->p_pajak_id,
                        'tarif' => help_hapus_format_rupiah($request->tarif)
                    ]);
                    return response()->json([
                        'status_berhasil' => 1,
                        'msg' => 'Berhasil, Data Berhasil Disimpan'
                    ]);
                }
            }
        }
    }

    public function tampil_data_paket_bundling_pajak_child3($pb_child3_id)
    {
        $data_paket_bundling_pajak_child3 = PaketBundlingPajak_Child3::with('relasi_pajak')->where('id', $pb_child3_id)->first();
        return response()->json([
            'data' => $data_paket_bundling_pajak_child3
        ]);
    }

    public function proses_edit_data_paket_bundling_pajak_child3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tarif' => 'required'
        ], [
            'tarif.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_paket_bundling_pajak_child3 = PaketBundlingPajak_Child3::where('id', $request->req_pb_pajak_child_3_id)->first();
            if ($data_paket_bundling_pajak_child3 == null) {
                return response()->json([
                    'status_data_tidak_ada' => 1,
                    'msg' => 'Gagal, Silahkan periksa kembali data inputan anda'
                ]);
            } else {
                $data_paket_bundling_pajak_child3->update([
                    'tarif' => help_hapus_format_rupiah($request->tarif)
                ]);

                return response()->json([
                    'status_berhasil_ubah' => 1,
                    'msg' => 'Berhasil Mengubah Paket Pajak'
                ]);
            }
        }
    }

    public function hapus_data_paket_bundling_pajak_child3($pb_child3_id)
    {
        $hapus_pb_pajak_child3 = PaketBundlingPajak_Child3::find($pb_child3_id);
        $hapus_pb_pajak_child3->delete();
        return response()->json([
            'status_berhasil_hapus' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    // =============================================================================
}
