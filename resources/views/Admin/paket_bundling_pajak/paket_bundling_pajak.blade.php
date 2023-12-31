@extends('Admin.layout.master', ['title' => 'Data Paket Bundling Pajak'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataPaketBundlingPajak"><i class="bi bi-plus"></i> Tambah Paket
                            Bundling Pajak</button>

                        <div class="modal fade text-left" id="modalTambahDataPaketBundlingPajak" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Paket Bundling Pajak</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form id="formTambahDataPaketBundlingPajak" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col col-form-label" for="pb_pajak">Paket Bunling
                                                        Pajak</label>
                                                    <input name="p_b_pajak" class="form-control"
                                                        placeholder="Masukkan Nama Paket Bunling Pajak">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                                                                        error-text p_b_pajak_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col col-form-label" for="path">Gambar</label>
                                                    <input type="file" accept="image/png, image/jpeg, image/jpg"
                                                        name="path" id="tambah_paket_bundling_pajak_path"
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
                                            <button type="submit" class="btn btn-primary ml-1"
                                                id="button-tambah-paket-bundling-pajak">
                                                <i id="icon-button-tambah-paket-bundling-pajak"></i>
                                                <span id="text-tambah-paket-bundling-pajak" class="d-none d-sm-block">
                                                    Simpan</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="table-data-paket-bundling-pajak">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Paket Bundling Pajak</th>
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

    <div class="modal fade text-left" id="modalEditDataPaketBundlingPajak" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Paket Bundling Pajak</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditDataPaketBundlingPajak" enctype="multipart/form-data">
                    <input type="hidden" name="paket_bundling_pajak_id" id="paket_bundling_pajak_id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="col">
                            <div class="form-group">
                                <label class="col col-form-label" for="p_b_pajak">Paket Bundling Pajak</label>
                                <input name="p_b_pajak" id="pb_pajak" class="form-control"
                                    placeholder="Masukkan Nama Paket Bundling Pajak">
                                <div class="input-group has-validation">
                                    <label
                                        style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                                                    error-text p_b_pajak_error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col col-form-label" for="path">Gambar</label>
                                <input type="file" accept="image/png, image/jpeg, image/jpg" name="path"
                                    id="edit_paket_bundling_pajak_path" class="form-control">
                                <div class="input-group has-validation">
                                    <label
                                        style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                                                    error-text path_error"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" id="button-edit-paket-bundling-pajak">
                            <i id="icon-button-edit-paket-bundling-pajak"></i>
                            <span id="text-edit-paket-bundling-pajak" class="d-none d-sm-block">
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
        let daftar_data_paket_bundling_pajak = [];
        const table_data_paket_bundling_pajak = $('#table-data-paket-bundling-pajak').DataTable({
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
                url: "{{ route('admin.DataPaketBundlingPajak') }}",
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
                        daftar_data_paket_bundling_pajak[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_bundling_pajak[row.id] = row;
                        return row.p_b_pajak;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_paket_bundling_pajak[row.id] = row;
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
                                    <a class="btn btn-success btn-sm" href="/admin/detail-paket-bundling-pajak/${row.slug}">Detail</a>
                                    <button type="button" class="btn btn-warning btn-sm edit_paket_bundling_pajak" data-id = "${row.id}" href="#!">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm hapus_paket_bundling_pajak" data-id = "${row.id}" href="#!">Hapus</button>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_paket_bundling_pajak" id-paket-pajak = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#formTambahDataPaketBundlingPajak").trigger('reset');
            $("#formEditDataPaketBundlingPajak").trigger('reset');
        })

        $(document).ready(function(e) {
            $("#edit_paket_bundling_pajak_path, #tambah_paket_bundling_pajak_path").change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                var ext = $('#edit_paket_bundling_pajak_path, #tambah_paket_bundling_pajak_path').val()
                    .split('.').pop()
                    .toLowerCase();
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                    $(document).find('label.error-text.path_error').html(
                        "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Format gambar yang diizinkan jpeg, jpg dan png</label>"
                    );
                    $("#edit_paket_bundling_pajak_path, #tambah_paket_bundling_pajak_path").val(null);
                } else {
                    if (file['size'] < 1111775) {
                        $(document).find('label.error-text.path_error').text('');
                        reader.readAsDataURL(this.files[0]);
                    } else if (file['size'] > 1111775) {
                        $(document).find('label.error-text.path_error').html(
                            "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Ukuran gambar maksimal 1MB</label>"
                        );
                        $("#edit_paket_bundling_pajak_path, #tambah_paket_bundling_pajak_path").val(null);
                    }
                }
            });
        });

        $('#formTambahDataPaketBundlingPajak').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-tambah-paket-bundling-pajak")
            $("#icon-button-tambah-paket-bundling-pajak").addClass("fa fa-spinner fa-spin")
            $("#text-tambah-paket-bundling-pajak").html('')
            $("#button-tambah-paket-bundling-pajak").prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.TambahDataPaketBundlingPajak') }}",
                method: "POST",
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
                        $("#text-tambah-paket-bundling-pajak").html(
                            '<span id="text-tambah-paket-bundling-pajak" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-paket-bundling-pajak").prop('disabled', false);
                    } else if (data.status_berhasil_tambah == 1) {
                        $("#formTambahDataPaketBundlingPajak").trigger('reset');
                        $("#modalTambahDataPaketBundlingPajak").modal('hide')
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
                        $("#text-tambah-paket-bundling-pajak").html(
                            '<span id="text-tambah-paket-bundling-pajak" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-paket-bundling-pajak").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        table_data_paket_bundling_pajak.draw();

                    }
                },
            });
        });

        $('body').on('click', '.edit_paket_bundling_pajak', function() {

            let paket_bundling_pajak_id = $(this).data('id');
            //fetch detail post with ajax
            $.ajax({
                url: `/admin/tampil-data-paket-bundling-pajak/${paket_bundling_pajak_id}`,
                type: "GET",
                cache: false,
                success: function(response) {

                    //fill data to form
                    $('#paket_bundling_pajak_id').val(response.data.id);
                    $('#pb_pajak').val(response.data.p_b_pajak);

                    //open modal
                    $('#modalEditDataPaketBundlingPajak').modal('show');
                }
            });
        });

        $("#formEditDataPaketBundlingPajak").submit(function(e) {
            e.preventDefault();
            var $search = $("#icon-button-edit-paket-bundling-pajak")
            $("#icon-button-edit-paket-bundling-pajak").addClass("fa fa-spinner fa-spin")
            $("#text-edit-paket-bundling-pajak").html('')
            $("#button-edit-paket-bundling-pajak").prop('disabled', true);
            const fd = new FormData(this);
            $.ajax({
                url: "{{ route('admin.ProsesEditPaketBundlingPajak') }}",
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-edit-paket-bundling-pajak").html(
                            '<span id="text-edit-paket-bundling-pajak" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-paket-bundling-pajak").prop('disabled', false);
                    } else if (data.status_berhasil_ubah == 1) {
                        $("#modalEditDataPaketBundlingPajak").modal('hide');
                        $("#formEditDataPaketBundlingPajak")[0].reset();
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
                        $("#text-edit-paket-bundling-pajak").html(
                            '<span id="text-edit-paket-bundling-pajak" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-paket-bundling-pajak").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        table_data_paket_bundling_pajak.draw();
                    }
                }
            });
        });

        $(document).on('click', '.hapus_paket_bundling_pajak', function(event) {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-paket-bundling-pajak/" + id,
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
                                table_data_paket_bundling_pajak.ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
