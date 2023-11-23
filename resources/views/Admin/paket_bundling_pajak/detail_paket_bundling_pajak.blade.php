@extends('Admin.layout.master', ['title' => 'Data Paket Bundling Pajak'])
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
                                        <img src="{{ asset('storage/' . $data_paket_bundling_pajak->path) }}" alt="Face 1"
                                            style="aspect-ratio: 1/1; width: 100%; height: 100%; border-radius: 10%;">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <h6 class="font-extrabold mb-3" aria-hidden="true">
                                        {{ $data_paket_bundling_pajak->p_b_pajak }}</h6>

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
                                @include('Admin.paket_bundling_pajak._form_tambah_jenis_pb_pajak_c1')
                                @include('Admin.paket_bundling_pajak._form_edit_jenis_pb_pajak_c1')
                            </div>
                            @include('Admin.paket_bundling_pajak._data_pb_pajak')
                            @include('Admin.paket_bundling_pajak._form_tambah_sub_jenis_pb_pajak_c2')
                            @include('Admin.paket_bundling_pajak._form_edit_sub_jenis_pb_pajak_c2')
                            @include('Admin.paket_bundling_pajak._form_tambah_sub_jenis_pb_pajak_c3')
                            @include('Admin.paket_bundling_pajak._form_edit_sub_jenis_pb_pajak_c3')
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
            $("#form-tambah-jenis-pb-pajak-child-1").trigger('reset');
            $("#form-edit-jenis-pb-pajak-child-1").trigger('reset');

            $("#form-tambah-sub-jenis-pb-pajak-child-2").trigger('reset');
            $("#form-edit-sub-jenis-pb-pajak-child-2").trigger('reset');

            $("#form-tambah-sub-jenis-pb-pajak-child-3").trigger('reset');
            $("#form-edit-sub-jenis-pb-pajak-child-3").trigger('reset');
        })

        var tambah_tarif = document.getElementById(`tambah_tarif_pb_child3`);
        tambah_tarif.addEventListener('keyup', function(e) {
            tambah_tarif.value = formatRupiah(this.value, 'Rp. ');
        });

        var edit_tarif = document.getElementById(`edit_tarif_pb_child3`);
        edit_tarif.addEventListener('keyup', function(e) {
            edit_tarif.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
