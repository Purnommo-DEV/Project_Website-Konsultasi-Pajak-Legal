@extends('Admin.layout.master', ['title' => 'Data Paket Pelayanan Notaris'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataPaketPelayananNotaris"><i class="bi bi-plus"></i> Tambah
                            Pelayanan Notaris</button>

                        <div class="modal fade text-left" id="modalTambahDataPaketPelayananNotaris"
                            data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Pelayanan Notaris</h4>
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
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger                     error-text p_pel_notaris_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col col-form-label" for="path">Gambar</label>
                                                    <input type="file" accept="image/png, image/jpeg, image/jpg"
                                                        name="path" id="tambah_p_pel_notaris_path" class="form-control">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger                     error-text path_error"></label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary batal"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1"
                                                id="button-tambah-layanan-notaris">
                                                <i id="icon-button-tambah-layanan-notaris"></i>
                                                <span id="text-tambah-layanan-notaris" class="d-none d-sm-block">
                                                    Simpan</span>
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
                    <h4 class="modal-title" id="myModalLabel33">Ubah Pelayanan Notaris</h4>
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
                                    <label
                                        style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger error-text p_pel_notaris_error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col col-form-label" for="path">Gambar</label>
                                <input type="file" accept="image/png, image/jpeg, image/jpg" name="path"
                                    id="edit_p_pel_notaris_path" class="form-control">
                                <div class="input-group has-validation">
                                    <label
                                        style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger error-text path_error"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" id="button-edit-layanan-notaris">
                            <i id="icon-button-edit-layanan-notaris"></i>
                            <span id="text-edit-layanan-notaris" class="d-none d-sm-block">
                                Simpan</span>
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

        $(document).ready(function(e) {
            $("#edit_p_pel_notaris_path, #tambah_p_pel_notaris_path").change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                var ext = $('#edit_p_pel_notaris_path, #tambah_p_pel_notaris_path').val().split('.').pop()
                    .toLowerCase();
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                    $(document).find('label.error-text.path_error').html(
                        "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Format gambar yang diizinkan jpeg, jpg dan png</label>"
                    );
                    $("#edit_p_pel_notaris_path, #tambah_p_pel_notaris_path").val(null);
                } else {
                    if (file['size'] < 1111775) {
                        $(document).find('label.error-text.path_error').text('');
                        reader.readAsDataURL(this.files[0]);
                    } else if (file['size'] > 1111775) {
                        $(document).find('label.error-text.path_error').html(
                            "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Ukuran gambar maksimal 1MB</label>"
                        );
                        $("#edit_p_pel_notaris_path, #tambah_p_pel_notaris_path").val(null);
                    }
                }
            });
        });

        $('#formTambahDataPaketPelayananNotaris').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-tambah-layanan-notaris")
            $("#icon-button-tambah-layanan-notaris").addClass("fa fa-spinner fa-spin")
            $("#text-tambah-layanan-notaris").html('')
            $("#button-tambah-layanan-notaris").prop('disabled', true);
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
                    if (data.status_form_kosong == 1) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-tambah-layanan-notaris").html(
                            '<span id="text-tambah-layanan-notaris" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-layanan-notaris").prop('disabled', false);
                    } else if (data.status_berhasil == 1) {
                        $("#formTambahDataPaketPelayananNotaris").trigger('reset');
                        $("#modalTambahDataPaketPelayananNotaris").modal('hide')
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-tambah-layanan-notaris").html(
                            '<span id="text-tambah-layanan-notaris" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-layanan-notaris").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        table_data_paket_pelayanan_notaris.draw();
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
            var $search = $("#icon-button-edit-layanan-notaris")
            $("#icon-button-edit-layanan-notaris").addClass("fa fa-spinner fa-spin")
            $("#text-edit-layanan-notaris").html('')
            $("#button-edit-layanan-notaris").prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.ProsesEditPaketPelayananNotaris') }}",
                method: 'POST',
                data: new FormData(this),
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-edit-layanan-notaris").html(
                            '<span id="text-edit-layanan-notaris" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-layanan-notaris").prop('disabled', false);
                    } else if (data.status_berhasil_ubah == 1) {
                        $("#modalEditDataPaketPelayananNotaris").modal('hide');
                        $("#formEditDataPaketPelayananNotaris")[0].reset();
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-edit-layanan-notaris").html(
                            '<span id="text-edit-layanan-notaris" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-layanan-notaris").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        table_data_paket_pelayanan_notaris.draw();
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
