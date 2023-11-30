@extends('Admin.layout.master', ['title' => 'Detail Layanan Satuan '])
@section('konten-admin')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                        <div class="card-body px-3 py-4-5">
                            <div class="row placeholder-glow">
                                <div class="col-md-2">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ asset('storage/' . $data_layanan_satuan->path) }}" alt="Face 1"
                                            style="aspect-ratio: 1/1; width: 100%; height: 100%; border-radius: 10%;">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <h6 class="font-extrabold mb-3" aria-hidden="true">
                                        {{ $data_layanan_satuan->layanan_satuan }}</h6>

                                    {{-- <h6 class="placeholder font-semibold" style="font-weight: 500;">
                                        {{ $data_program->tujuan }}
                                    </h6>
                                    <h6 class="placeholder font-semibold" style="font-weight: 500;">Kategori :
                                        {{ $data_paket_bundling_pajak->path }}</h6> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-12 col-md-12 placeholder-glow">
                    <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                        <div class="card-body" style="padding: 1.5rem; margin-top: -1rem;">
                            <div class="grid">
                                @include('Admin.layanan_satuan._form_tambah_layanan_satuan_c1')
                                @include('Admin.layanan_satuan._form_edit_layanan_satuan_c1')
                            </div>
                            @include('Admin.layanan_satuan._data_layanan_satuan')
                            @include('Admin.layanan_satuan._form_tambah_layanan_satuan_c2')
                            @include('Admin.layanan_satuan._form_edit_layanan_satuan_c2')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#form-tambah-layanan-satuan-child-1").trigger('reset');
            $("#form-edit-layanan-satuan-child-1").trigger('reset');

            $("#form-tambah-layanan-satuan-child-2").trigger('reset');
            $("#form-edit-layanan-satuan-child-2").trigger('reset');
        })
    </script>
@endsection
