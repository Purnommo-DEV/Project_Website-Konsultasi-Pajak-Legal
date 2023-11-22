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
                            </div>
                            @include('Admin.paket_bundling_pajak._data_pb_pajak')
                            @include('Admin.paket_bundling_pajak._form_tambah_sub_jenis_pb_pajak_c2')
                            @include('Admin.paket_bundling_pajak._form_tambah_sub_jenis_pb_pajak_c3')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                                    <button type="button" class="btn btn-success btn-sm" href="/admin/detail-paket-bundling-pajak/${row.slug}">Detail</button>
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

        $('#formTambahDataPaketBundlingPajak').on('submit', function(e) {
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
                    if (data.status_form_kosong == 1) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                    } else if (data.status_berhasil_tambah == 1) {
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
                        table_data_paket_bundling_pajak.draw();
                        $("#formTambahDataPaketBundlingPajak").trigger('reset');
                        $("#modalTambahDataPaketBundlingPajak").modal('hide')
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
                    } else if (data.status_berhasil_ubah == 1) {
                        $("#modalEditDataPaketBundlingPajak").modal('hide');
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
                        $("#formEditDataPaketBundlingPajak")[0].reset();
                        table_data_paket_bundling_pajak.ajax.reload(null, false);
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

        // function loader() {
        //     let card = document.querySelectorAll('.placeholder');
        //     card.forEach(checkcard => {
        //         checkcard.classList.remove('placeholder');
        //     })
        // }
    </script>
@endsection
