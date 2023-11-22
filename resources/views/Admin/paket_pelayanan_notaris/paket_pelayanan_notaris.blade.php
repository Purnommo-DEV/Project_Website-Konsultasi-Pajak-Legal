@extends('Admin.layout.master', ['title' => 'Data Paket Pelayanan Notaris'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataPaketPelayananNotaris"><i class="bi bi-plus"></i> Tambah Paket
                            Pelayanan Notaris</button>

                        <div class="modal fade text-left" id="modalTambahDataPaketPelayananNotaris"
                            data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Paket Pelayanan Notaris</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.TambahDataPaketPelayananNotaris') }}"
                                        id="formTambahDataPaketPelayananNotaris" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col col-form-label" for="paket">Paket</label>
                                                    <input name="p_pel_notaris" class="form-control"
                                                        placeholder="Masukkan Nama Paket Pelayanan Notaris">
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text p_pel_notaris_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col col-form-label" for="path">Gambar</label>
                                                    <input type="file" accept="image/*" name="path"
                                                        class="form-control">
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text path_error"></label>
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
                        <table class="table table-striped" id="table-data-paket-pelayanan-notaris">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Paket</th>
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

    <div class="modal fade text-left" id="modalEditDataPaketPelayananNotaris" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Kategori</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditDataPaketPelayananNotaris" enctype="multipart/form-data">
                    <input type="hidden" name="paket_pelayanan_notaris_id" id="paket_pelayanan_notaris_id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="col">
                            <div class="form-group">
                                <label class="col col-form-label" for="paket">Paket</label>
                                <input name="p_pel_notaris" id="p_pel_notaris" class="form-control"
                                    placeholder="Masukkan Nama Pelayanan Notaris">
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text p_pel_notaris_error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col col-form-label" for="path">Gambar</label>
                                <input type="file" accept="image/*" name="path" id="path" class="form-control">
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text path_error"></label>
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
        let daftar_data_paket_pelayanan_notaris = [];
        const table_data_paket_pelayanan_notaris = $('#table-data-paket-pelayanan-notaris').DataTable({
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
                url: "{{ route('admin.DataPaketPelayananNotaris') }}",
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
                        daftar_data_paket_pelayanan_notaris[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_pelayanan_notaris[row.id] = row;
                        return row.p_pel_notaris;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_pelayanan_notaris[row.id] = row;
                        return `<img src="/storage/${row.path}" width="100">`
                    }
                },
                {
                    "targets": 3,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                                <div class="ms-auto">
                                    <a class="btn btn-success btn-sm" href="/admin/detail-paket-pelayanan-notaris/${row.slug}">Detail</a>
                                    <button type="button" class="btn btn-warning btn-sm edit_paket_pelayanan_notaris" data-id = "${row.id}" href="#!">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm hapus_paket_pelayanan_notaris" data-id = "${row.id}" href="#!">Hapus</button>
                                </div>
                                `
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahDataPaketPelayananNotaris').on('submit', function(e) {
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
                        table_data_paket_pelayanan_notaris.draw();
                        $("#formTambahDataPaketPelayananNotaris").trigger('reset');
                        $("#modalTambahDataPaketPelayananNotaris").modal('hide')
                    }
                },
            });
        });

        $('body').on('click', '.edit_paket_pelayanan_notaris', function() {
            let paket_pelayanan_notaris_id = $(this).data('id');
            //fetch detail post with ajax
            $.ajax({
                url: `/admin/tampil-data-paket-pelayanan-notaris/${paket_pelayanan_notaris_id}`,
                type: "GET",
                cache: false,
                success: function(response) {

                    //fill data to form
                    $('#paket_pelayanan_notaris_id').val(response.data.id);
                    $('#p_pel_notaris').val(response.data.p_pel_notaris);

                    //open modal
                    $('#modalEditDataPaketPelayananNotaris').modal('show');
                }
            });
        });

        $("#formEditDataPaketPelayananNotaris").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: "{{ route('admin.ProsesEditPaketPelayananNotaris') }}",
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
                        $("#modalEditDataPaketPelayananNotaris").modal('hide');
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
                        $("#formEditDataPaketPelayananNotaris")[0].reset();
                        table_data_paket_pelayanan_notaris.ajax.reload(null, false);
                    }
                }
            });
        });

        $(document).on('click', '.hapus_paket_pelayanan_notaris', function(event) {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-paket-pelayanan-notaris/" + id,
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
                                table_data_paket_pelayanan_notaris.ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
