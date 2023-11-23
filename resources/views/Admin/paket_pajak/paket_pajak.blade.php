@extends('Admin.layout.master', ['title' => 'Data Paket Pajak'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataPaketPajak"><i class="bi bi-plus"></i> Tambah Paket
                            Pajak</button>

                        <div class="modal fade text-left" id="modalTambahDataPaketPajak" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Paket Pajak</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.TambahDataPaketPajak') }}" id="formTambahDataPaketPajak"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col col-form-label" for="paket">Paket</label>
                                                    <input name="paket" class="form-control"
                                                        placeholder="Masukkan Nama Paket">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                error-text paket_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col col-form-label" for="tarif">Tarif</label>
                                                    <input name="tarif" id="tarif" class="form-control"
                                                        placeholder="Masukkan Tarif Paket" />
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                error-text tarif_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col col-form-label" for="isi">Isi</label>
                                                    <textarea name="isi" class="form-control" placeholder="Masukkan Isi Paket"></textarea>
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                error-text isi_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col col-form-label" for="keterangan">Keterangan</label>
                                                    <textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan Paket"></textarea>
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                error-text keterangan_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col col-form-label" for="path">Gambar</label>
                                                    <input type="file" accept="image/*" name="path"
                                                        class="form-control">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                error-text path_error"></label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary batal"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="table-data-paket-pajak">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Paket</th>
                                    <th>Isi</th>
                                    <th>Tarif</th>
                                    <th>Keterangan</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade text-left" id="modalEditDataPaketPajak" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Kategori</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditDataPaketPajak" enctype="multipart/form-data">
                    <input type="hidden" name="paket_pajak_id" id="paket_pajak_id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="col">
                            <div class="form-group">
                                <label class="col col-form-label" for="paket">Paket</label>
                                <input name="paket" id="paket" class="form-control"
                                    placeholder="Masukkan Nama Paket">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                            error-text paket_error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col col-form-label" for="tarif">Tarif</label>
                                <input name="tarif" id="tarif-ubah" class="form-control"
                                    placeholder="Masukkan Tarif Paket" />
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                            error-text tarif_error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col col-form-label" for="isi">Isi</label>
                                <textarea name="isi" id="isi" class="form-control" placeholder="Masukkan Isi Paket"></textarea>
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                            error-text isi_error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col col-form-label" for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Masukkan Keterangan Paket"></textarea>
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                            error-text keterangan_error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col col-form-label" for="path">Gambar</label>
                                <input type="file" accept="image/*" name="path" id="path"
                                    class="form-control">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                            error-text path_error"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let daftar_data_paket_pajak = [];
        const table_data_paket_pajak = $('#table-data-paket-pajak').DataTable({
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
                url: "{{ route('admin.DataPaketPajak') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // data: function(d) {
                //     d.role_pengguna = data_role_pengguna;
                //     d.jurusan_pengguna = data_filter_jurusan;
                //     return d
                // }
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
                        daftar_data_paket_pajak[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_pajak[row.id] = row;
                        return row.paket;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_pajak[row.id] = row;
                        return $.fn.dataTable.render.number('.', ',', 0, 'Rp ').display(row.tarif);
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_pajak[row.id] = row;
                        return row.isi;
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_pajak[row.id] = row;
                        return row.keterangan;
                    }
                },
                {
                    "targets": 5,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_pajak[row.id] = row;
                        return `<img src="/storage/${row.path}" width="100">`
                    }
                },
                {
                    "targets": 6,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-warning btn-sm edit_paket_pajak" data-id = "${row.id}" href="#!">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm hapus_paket_pajak" data-id = "${row.id}" href="#!">Hapus</button>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_paket_pajak" id-paket-pajak = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahDataPaketPajak').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $(document).find('label.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                    } else if (data.status == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        })
                        table_data_paket_pajak.draw();
                        $("#formTambahDataPaketPajak").trigger('reset');
                        $("#modalTambahDataPaketPajak").modal('hide')
                    }
                },
            });
        });

        $('body').on('click', '.edit_paket_pajak', function() {
            let paket_pajak_id = $(this).data('id');
            //fetch detail post with ajax
            $.ajax({
                url: `/admin/tampil-data-paket-pajak/${paket_pajak_id}`,
                type: "GET",
                cache: false,
                success: function(response) {

                    //fill data to form
                    $('#paket_pajak_id').val(response.data.id);
                    $('#paket').val(response.data.paket);
                    $('#tarif-ubah').val(response.data.tarif);
                    $('#isi').val(response.data.isi);
                    $('#keterangan').val(response.data.keterangan);

                    //open modal
                    $('#modalEditDataPaketPajak').modal('show');
                }
            });
        });

        $("#formEditDataPaketPajak").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: "{{ route('admin.ProsesEditPaketPajak') }}",
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status_form_kosong == 1) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                    } else if (data.status_berhasil_ubah == 1) {
                        $("#modalEditDataPaketPajak").modal('hide');
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        })
                        $("#formEditDataPaketPajak")[0].reset();
                        table_data_paket_pajak.ajax.reload(null, false);
                    }
                }
            });
        });

        $(document).on('click', '.hapus_paket_pajak', function(event) {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-paket-pajak/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status_berhasil_hapus == 1) {
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
                                table_data_paket_pajak.ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
        });

        var tarif = document.getElementById(`tarif`);
        tarif.addEventListener('keyup', function(e) {
            tarif.value = formatRupiah(this.value, 'Rp. ');
        });

        var tarif_ubah = document.getElementById(`tarif-ubah`);
        tarif_ubah.addEventListener('keyup', function(e) {
            tarif_ubah.value = formatRupiah(this.value, 'Rp. ');
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
