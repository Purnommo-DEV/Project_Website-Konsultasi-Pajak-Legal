@extends('Admin.layout.master', ['title' => 'Data Jenis Pelayanan Notaris'])
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
                                        <img src="{{ asset('storage/' . $data_pelayanan_notaris->path) }}" alt="Face 1"
                                            style="aspect-ratio: 1/1; width: 100%; height: 100%; border-radius: 10%;">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <h6 class="font-extrabold mb-3" aria-hidden="true">
                                        {{ $data_pelayanan_notaris->p_pel_notaris }}</h6>

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
                            <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="!#"
                                data-bs-toggle="modal" data-bs-target="#modal-tambah-jenis-pelayanan-notaris-child-1"><i
                                    class="bi bi-plus"></i> Tambah Jenis Layanan
                                Pajak</button>
                            @include('Admin.paket_pelayanan_notaris._form_tambah_paket_pelayanan_notaris_c1')
                            <table class="table table-striped" id="table-data-jenis-pelayanan-notaris">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Jenis Paket</th>
                                        <th>Isi</th>
                                        <th>Tarif</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                            @include('Admin.paket_pelayanan_notaris._form_edit_paket_pelayanan_notaris_c1')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        let daftar_data_pelayanan_notaris_child1 = [];
        const table_data_pelayanan_notaris_child1 = $('#table-data-jenis-pelayanan-notaris').DataTable({
            "destroy": true,
            "pageLength": 10,
            "lengthMenu": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "responsive": false,
            "sScrollX": '100%',
            "sScrollXInner": "100%",
            ajax: {
                url: "{{ route('admin.DataPaketPelayananNotarisChild1') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columnDefs: [{
                    targets: '_all',
                    visible: true
                },
                {
                    "targets": 0,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let i = 1;
                        daftar_data_pelayanan_notaris_child1[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pelayanan_notaris_child1[row.id] = row;
                        return row.p_pel_notaris_child_1;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pelayanan_notaris_child1[row.id] = row;
                        return row.isi;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pelayanan_notaris_child1[row.id] = row;
                        return $.fn.dataTable.render.number('.', ',', 0, 'Rp ').display(row.tarif);
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pelayanan_notaris_child1[row.id] = row;
                        return `<img src="/storage/${row.path}" width="100">`
                    }
                },
                {
                    "targets": 5,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-warning btn-sm btn-edit-sub-jenis-pb-pajak-child-3" p-pel-notaris-child-1-id = "${row.id}" href="#!">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus-sub-jenis-pb-pajak-child-3" p-pel-notaris-child-1-id = "${row.id}" href="#!">Hapus</button>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_paket_pajak" id-paket-pajak = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        var p_notaris = @json($data_pelayanan_notaris->id);

        $(document).on('click', '.btn-hapus-sub-jenis-pb-pajak-child-3', function(event) {
            const id = $(event.currentTarget).attr('p-pel-notaris-child-1-id');
            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-paket-pelayanan-notaris-child1/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status_berhasil == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })
                                Toast.fire({
                                    icon: 'success',
                                    title: data.msg
                                })
                                table_data_pelayanan_notaris_child1.draw();
                            }
                        }
                    });
                }
            });
        });

        var tambah_tarif_pb_child1 = document.getElementById(`tambah_tarif_pb_child1`);
        tambah_tarif_pb_child1.addEventListener('keyup', function(e) {
            tambah_tarif_pb_child1.value = formatRupiah(this.value, 'Rp. ');
        });

        var edit_tarif_pb_child1 = document.getElementById(`edit_tarif_pb_child1`);
        edit_tarif_pb_child1.addEventListener('keyup', function(e) {
            edit_tarif_pb_child1.value = formatRupiah(this.value, 'Rp. ');
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
