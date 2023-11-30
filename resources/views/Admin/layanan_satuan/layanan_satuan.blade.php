@extends('Admin.layout.master', ['title' => 'Data Layanan Satuan'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah-layanan-satuan"><i class="bi bi-plus"></i>Tambah Layanan
                            Satuan</button>

                        <div class="modal fade text-left" id="modal-tambah-layanan-satuan" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Layanan Satuan</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form id="form-tambah-layanan-satuan" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col col-form-label" for="layanan_satuan">Nama
                                                        Layanan</label>
                                                    <input name="layanan_satuan" class="form-control"
                                                        placeholder="Masukkan Nama Layanan">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text layanan_satuan_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col col-form-label" for="path">Gambar</label>
                                                    <input type="file" accept="image/png, image/jpeg, image/jpg"
                                                        name="path" id="tmb-layanan-satuan-path" class="form-control">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text path_error"></label>
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
                                                id="button-tambah-layanan-satuan">
                                                <i id="icon-button-tambah-layanan-satuan"></i>
                                                <span id="text-tambah-layanan-satuan" class="d-none d-sm-block">
                                                    Simpan</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="table-data-layanan-satuan">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Layanan</th>
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

    <div class="modal fade text-left" id="modal-edit-layanan-satuan" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Layanan Satuan</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="form-edit-layanan-satuan" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col">
                            <div class="form-group">
                                <input name="req_layanan_satuan_id" type="hidden" id="layanan_satuan_id" hidden readonly>
                                <label class="col col-form-label" for="layanan_satuan">Nama Layanan</label>
                                <input name="layanan_satuan" id="layanan_satuan" class="form-control"
                                    placeholder="Masukkan Nama Layanan">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600;"
                                        class="text-danger error-text layanan_satuan_error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col col-form-label" for="path">Gambar</label>
                                <input type="file" accept="image/png, image/jpeg, image/jpg" name="path"
                                    id="tmb-layanan-satuan-path" class="form-control">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600;"
                                        class="text-danger error-text path_error"></label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" id="button-edit-layanan-satuan">
                            <i id="icon-button-edit-layanan-satuan"></i>
                            <span id="text-edit-layanan-satuan" class="d-none d-sm-block">
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
        let daftar_layanan_satuan = [];
        const table_layanan_satuan = $('#table-data-layanan-satuan').DataTable({
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
                url: "{{ route('admin.DataLayananSatuan') }}",
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
                        daftar_layanan_satuan[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_layanan_satuan[row.id] = row;
                        return row.layanan_satuan;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_layanan_satuan[row.id] = row;
                        if (row.path == null) {
                            return `<img src="/All/img/no_image.jpg" width="100" style="aspect-ratio:1/1;">`;
                        } else {
                            return `<img src="/storage/${row.path}" width="100" style="aspect-ratio:1/1;">`;
                        }
                    }
                },
                {
                    "targets": 3,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                                <div class="ms-auto">
                                    <a class="btn btn-success btn-sm" href="/admin/detail-layanan-satuan/${row.slug}">Detail</a>
                                    <button type="button" class="btn btn-warning btn-sm edit_layanan_satuan" data-id = "${row.id}" href="#!">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm hapus_layanan_satuan" data-id = "${row.id}" href="#!">Hapus</button>
                                </div>
                                `
                        return tampilan;
                    }
                },
            ]
        });

        $(document).ready(function(e) {
            $("#tmb-layanan-satuan-path").change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                var ext = $('#tmb-layanan-satuan-path').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                    $(document).find('label.error-text.path_error').html(
                        "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Format gambar yang diizinkan jpeg, jpg dan png</label>"
                    );
                    $("#tmb-layanan-satuan-path").val(null);
                } else {
                    if (file['size'] < 1111775) {
                        $(document).find('label.error-text.path_error').text('');
                        reader.readAsDataURL(this.files[0]);
                    } else if (file['size'] > 1111775) {
                        $(document).find('label.error-text.path_error').html(
                            "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Ukuran gambar maksimal 1MB</label>"
                        );
                        $("#tmb-layanan-satuan-path").val(null);
                    }
                }
            });
        });

        $('#form-tambah-layanan-satuan').submit(function(e) {
            e.preventDefault();
            var $search = $("#icon-button-tambah-layanan-satuan")
            $("#icon-button-tambah-layanan-satuan").addClass("fa fa-spinner fa-spin")
            $("#text-tambah-layanan-satuan").html('')
            $("#button-tambah-layanan-satuan").prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.ProsesTambahDataLayananSatuan') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
                        $("#text-tambah-layanan-satuan").html(
                            '<span id="text-tambah-layanan-satuan" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-layanan-satuan").prop('disabled', false);
                    } else if (data.status_berhasil == 1) {
                        $("#modal-tambah-layanan-satuan").modal('hide');
                        $("#form-tambah-layanan-satuan").trigger('reset');
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
                        $search.removeClass("fa fa-spinner fa-spin");
                        $("#text-tambah-layanan-satuan").html(
                            '<span id="text-tambah-layanan-satuan" class="d-none d-sm-block">Simpan</span>'
                        );
                        $("#button-tambah-layanan-satuan").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        table_layanan_satuan.draw();
                    }
                },
            });
        });

        $('body').on('click', '.edit_layanan_satuan', function() {
            let layanan_satuan_id = $(this).data('id');
            //fetch detail post with ajax
            $.ajax({
                url: `/admin/tampil-data-layanan-satuan/${layanan_satuan_id}`,
                type: "GET",
                cache: false,
                success: function(response) {

                    //fill data to form
                    $('#layanan_satuan_id').val(response.data.id);
                    $('#layanan_satuan').val(response.data.layanan_satuan);

                    //open modal
                    $('#modal-edit-layanan-satuan').modal('show');
                }
            });
        });

        $("#form-edit-layanan-satuan").submit(function(e) {
            e.preventDefault();
            var $search = $("#icon-button-edit-layanan-satuan")
            $("#icon-button-edit-layanan-satuan").addClass("fa fa-spinner fa-spin")
            $("#text-edit-layanan-satuan").html('')
            $("#button-edit-layanan-satuan").prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.ProsesEditLayananSatuan') }}",
                method: 'post',
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
                        $("#text-edit-layanan-satuan").html(
                            '<span id="text-edit-layanan-satuan" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-layanan-satuan").prop('disabled', false);
                    } else if (data.status_berhasil == 1) {
                        $("#modal-edit-layanan-satuan").modal('hide');
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
                        $search.removeClass("fa fa-spinner fa-spin");
                        $("#text-edit-layanan-satuan").html(
                            '<span id="text-edit-layanan-satuan" class="d-none d-sm-block">Simpan</span>'
                        );
                        $("#button-edit-layanan-satuan").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#form-edit-layanan-satuan")[0].reset();
                        table_layanan_satuan.draw();
                    }
                }
            });
        });

        $(document).on('click', '.hapus_layanan_satuan', function(event) {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-layanan-satuan/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 0) {
                                alert("Gagal Hapus")
                            } else if (data.status_berhasil == 1) {
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
                                    }),
                                    table_layanan_satuan.draw();
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });
    </script>
@endsection
