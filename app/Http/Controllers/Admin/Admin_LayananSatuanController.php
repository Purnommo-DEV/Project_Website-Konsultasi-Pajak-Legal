<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LayananSatuan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LayananSatuan_Child1;
use App\Models\LayananSatuan_Child2;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Admin_LayananSatuanController extends Controller
{
    public function halaman_layanan_satuan()
    {
        return view('Admin.layanan_satuan.layanan_satuan');
    }

    public function data_layanan_satuan(Request $request)
    {
        $data = LayananSatuan::select([
            'layanan_satuan.*'
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

    public function tambah_layanan_satuan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'layanan_satuan' => 'required'
        ], [
            'layanan_satuan.required' => 'Wajib diisi',
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
                $path = $request->file('path')->store('gambar_layanan_satuan', 'public');
            }
            $tambah_layanan_satuan = LayananSatuan::create([
                'layanan_satuan' => help_hapus_spesial_karakter($request->layanan_satuan),
                'slug' => Str::slug($request->layanan_satuan),
                'path' => $path ?? null
            ]);

            if (!$tambah_layanan_satuan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambahkan Data'
                ]);
            } else {
                return response()->json([
                    'status_berhasil' => 1,
                    'msg' => 'Berhasil Menambahkan Data'
                ]);
            }
        }
    }

    public function tampil_data_layanan_satuan($layanan_satuan_id)
    {
        $data_layanan_satuan = LayananSatuan::where('id', $layanan_satuan_id)->first();
        return response()->json([
            'data' => $data_layanan_satuan
        ]);
    }

    public function proses_edit_data_layanan_satuan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'layanan_satuan' => 'required'
        ], [
            'layanan_satuan.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_layanan_satuan = LayananSatuan::where('id', $request->req_layanan_satuan_id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_layanan_satuan', 'public');
                $posisi_file = 'storage/' . $data_layanan_satuan->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            }
            $ubah_layanan_satuan = $data_layanan_satuan->update([
                'layanan_satuan' => help_hapus_spesial_karakter($request->layanan_satuan),
                'slug' => Str::slug($request->layanan_satuan),
                'path' => $path ?? $data_layanan_satuan->path
            ]);

            if (!$ubah_layanan_satuan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Data'
                ]);
            } else {
                return response()->json([
                    'status_berhasil' => 1,
                    'msg' => 'Berhasil Mengubah Data'
                ]);
            }
        }
    }

    public function hapus_data_layanan_satuan($layanan_satuan_id)
    {
        $hapus_layanan_satuan = LayananSatuan::find($layanan_satuan_id);
        $path = 'storage/' . $hapus_layanan_satuan->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_layanan_satuan->delete();
        return response()->json([
            'status_berhasil' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    // DETAIL LAYANAN SATUAN
    public function halaman_detail_layanan_satuan($slug)
    {
        $data_layanan_satuan = LayananSatuan::where('slug', $slug)->first();
        $data_layanan_satuan_child_1 = LayananSatuan_Child1::where('layanan_satuan_id', $data_layanan_satuan->id)->get();
        return view('Admin.layanan_satuan.detail_layanan_satuan', compact('data_layanan_satuan', 'data_layanan_satuan_child_1'));
    }

    // CHILD 1
    public function tambah_layanan_satuan_child1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'layanan_satuan_child1' => 'required',
            'tipe_id' => 'required',
            'path' => 'mimes:jpeg,png,jpg|max:1024'
        ], [
            'layanan_satuan_child1.required' => 'Wajib berisi',
            'tipe_id.required' => 'Wajib diisi',
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
                $path = $request->file('path')->store('gambar_layanan_satuan/child_1', 'public');
            }

            DB::beginTransaction();
            $tambah_layanan_satuan = LayananSatuan_Child1::create([
                'layanan_satuan_id' => $request->req_layanan_satuan_child1_id,
                'layanan_satuan_child_1' => help_hapus_spesial_karakter($request->layanan_satuan_child1),
                'slug' => Str::slug($request->layanan_satuan_child1),
                'tipe_id' => $request->tipe_id,
                'path' => $path ?? '',
            ]);

            $req_sub_layanan_satuan_child1 = $request->input('sub_layanan_satuan_child1');
            $req_tarif = $request->input('tarif_multiple');
            $req_timeline = $request->input('timeline_multiple');

            if ($request->tipe_id == 1) {
                LayananSatuan_Child2::create([
                    'layanan_satuan_child_1_id' => $tambah_layanan_satuan->id,
                    'layanan_satuan_child_2' => help_hapus_spesial_karakter($request->layanan_satuan_child1),
                    'tarif' => help_hapus_format_rupiah($request->tarif_single),
                    'timeline'  => $request->timeline_single
                ]);
            } else if ($request->tipe_id == 2) {
                for ($x = 0; $x < count($req_sub_layanan_satuan_child1); $x++) {
                    $tampung_sub_layanan_satuan_c1 = $req_sub_layanan_satuan_child1[$x];
                    $tampung_tarif_sub_layanan_satuan_c1 = $req_tarif[$x];
                    $tampung_timeline_sub_layanan_satuan_c1 = $req_timeline[$x];
                    LayananSatuan_Child2::create([
                        'layanan_satuan_child_1_id' => $tambah_layanan_satuan->id,
                        'layanan_satuan_child_2' => help_hapus_spesial_karakter($tampung_sub_layanan_satuan_c1),
                        'tarif' => help_hapus_format_rupiah($tampung_tarif_sub_layanan_satuan_c1),
                        'timeline'  => $tampung_timeline_sub_layanan_satuan_c1
                    ]);
                }
            }
            DB::commit();

            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil Menambahkan Produk'
            ]);
        }
    }

    public function tampil_data_layanan_satuan_child1($layanan_satuan_child1)
    {
        $data_layanan_satuan_child1 = LayananSatuan_Child1::where('id', $layanan_satuan_child1)->first();
        return response()->json([
            'data' => $data_layanan_satuan_child1
        ]);
    }

    public function proses_edit_data_layanan_satuan_child1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'layanan_satuan_child_1' => 'required'
        ], [
            'layanan_satuan_child_1.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_layanan_satuan_child1 = LayananSatuan_Child1::where('id', $request->layanan_satuan_child1_id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_layanan_satuan/child_1', 'public');
                $posisi_file = 'storage/' . $data_layanan_satuan_child1->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            }
            $ubah_layanan_satuan = $data_layanan_satuan_child1->update([
                'layanan_satuan_child_1' => help_hapus_spesial_karakter($request->layanan_satuan_child_1),
                'path' => $path ??  $data_layanan_satuan_child1->path
            ]);

            if (!$ubah_layanan_satuan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Data'
                ]);
            } else {
                return response()->json([
                    'status_berhasil' => 1,
                    'msg' => 'Berhasil Mengubah Data'
                ]);
            }
        }
    }

    public function hapus_data_layanan_satuan_child1($layanan_satuan_child1_id)
    {
        $hapus_layanan_satuan_child1 = LayananSatuan_Child1::find($layanan_satuan_child1_id);
        $path = 'storage/' . $hapus_layanan_satuan_child1->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_layanan_satuan_child1->delete();
        return response()->json([
            'status_berhasil' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    // CHILD 2
    public function tambah_layanan_satuan_child2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'req_layanan_satuan_child1_id' => 'required',
            'layanan_satuan_child2' => 'required',
            'tarif' => 'required',
            'timeline' => 'required'
        ], [
            'req_layanan_satuan_child1_id.required' => 'Wajib berisi',
            'layanan_satuan_child2.required' => 'Wajib diisi',
            'tarif.required' => 'Wajib diisi',
            'timeline.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            LayananSatuan_Child2::create([
                'layanan_satuan_child_1_id' => $request->req_layanan_satuan_child1_id,
                'layanan_satuan_child_2' => help_hapus_spesial_karakter($request->layanan_satuan_child2),
                'tarif' => help_hapus_format_rupiah($request->tarif),
                'timeline' => help_hapus_spesial_karakter($request->timeline),
            ]);
            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil Menambahkan Data'
            ]);
        }
    }

    public function tampil_data_layanan_satuan_child2($layanan_satuan_child1)
    {
        $data_layanan_satuan_child2 = LayananSatuan_Child2::where('id', $layanan_satuan_child1)->first();
        return response()->json([
            'data' => $data_layanan_satuan_child2
        ]);
    }

    public function proses_edit_data_layanan_satuan_child2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'req_layanan_satuan_child2_id' => 'required',
            'layanan_satuan_child2' => 'required',
            'tarif' => 'required',
            'timeline' => 'required'
        ], [
            'layanan_satuan_child2.required' => 'Wajib diisi',
            'tarif.required' => 'Wajib diisi',
            'timeline.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_layanan_satuan_child2 = LayananSatuan_Child2::where('id', $request->req_layanan_satuan_child2_id)->first();
            $data_layanan_satuan_child2->update([
                'layanan_satuan_child_2' => help_hapus_spesial_karakter($request->layanan_satuan_child2),
                'tarif' => help_hapus_format_rupiah($request->tarif),
                'timeline' => help_hapus_spesial_karakter($request->timeline),
            ]);
            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil Mengubah Data'
            ]);
        }
    }

    public function hapus_data_layanan_satuan_child2($layanan_satuan_child2_id)
    {
        $hapus_layanan_satuan_child2 = LayananSatuan_Child2::find($layanan_satuan_child2_id);
        $hapus_layanan_satuan_child2->delete();
        return response()->json([
            'status_berhasil' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
}
