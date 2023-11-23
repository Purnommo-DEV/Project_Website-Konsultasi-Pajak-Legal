<div class="accordion" id="daftar-jenis-pb-pajak">
    @foreach ($data_paket_bundling_pajak_child_1 as $item_1)
        @php
            $data_paket_bundling_pajak_child_2 = \App\Models\PaketBundlingPajak_Child2::where('p_b_pajak_child_1_id', $item_1->id)->get();
        @endphp
        <div class="accordion-item my-3 shadow">
            <h2 class="accordion-header">
                <div class="btn-group col-md-12" role="group">
                    <button class="btn btn-sm btn-outline-warning btn-ubah-detail-pb-pajak-child-1"
                        pb-pajak-child-1-id="{{ $item_1->id }}"><i class="bi bi-pen"></i></button>
                    <button class="btn btn-sm btn-outline-danger btn-hapus-detail-pb-pajak-child-1"
                        pb-pajak-child-1-id="{{ $item_1->id }}"><i class="bi bi-trash"></i></button>
                    <button class="btn btn-sm btn-outline-primary btn-tambah-sub-jenis-pb-pajak-child-2"
                        pb-pajak-child-1-id="{{ $item_1->id }}"><i class="bi bi-plus"></i></button>

                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#konten-{{ $item_1->id }}">{{ $item_1->p_b_pajak_child_1 }}</button>
                </div>
            </h2>
            <div id="konten-{{ $item_1->id }}" class="accordion-collapse collapse" data-bs-parent="#daftar-materi"
                style="padding: 1rem;">

                @foreach ($data_paket_bundling_pajak_child_2 as $item_2)
                    @php
                        $data_paket_bundling_pajak_child_3 = \App\Models\PaketBundlingPajak_Child3::with('relasi_pajak')
                            ->where('p_b_pajak_child_2_id', $item_2->id)
                            ->get();

                    @endphp
                    <div class="col-md-12 col-md-12">
                        <div class="card border">
                            <div class="card-header">
                                <div class="d-flex w-100 bd-highlight">
                                    <div class="p-2 bd-highlight" style="width: 85%!important;">
                                        <h5 class="mb-1">{{ $item_2->p_b_pajak_child_2 }}</h5>
                                    </div>
                                    <div class="p-2 flex-shrink-1 bd-highlight">
                                        <button
                                            class="btn btn-sm btn-outline-primary btn-tambah-sub-jenis-pb-pajak-child-3"
                                            pb-pajak-child-2-id="{{ $item_2->id }}"><i
                                                class="bi bi-plus"></i></button>
                                        <button
                                            class="btn btn-sm btn-outline-warning btn-edit-sub-jenis-pb-pajak-child-2"
                                            pb-pajak-child-2-id="{{ $item_2->id }}"><i class="bi bi-pen"></i></button>
                                        <button
                                            class="btn btn-sm btn-outline-danger btn-hapus-sub-jenis-pb-pajak-child-2"
                                            pb-pajak-child-2-id="{{ $item_2->id }}"><i
                                                class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Isi</th>
                                                <th scope="col">Tarif</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_paket_bundling_pajak_child_3 as $item_3)
                                                <tr>
                                                    <td scope="row">{{ $item_3->relasi_pajak->paket }}</td>
                                                    <td scope="row">{{ help_format_rupiah($item_3->tarif) }}</td>
                                                    <td scope="row">
                                                        <button
                                                            class="btn btn-sm btn-warning btn-edit-sub-jenis-pb-pajak-child-3"
                                                            pb-pajak-child-3-id="{{ $item_3->id }}"><i
                                                                class="bi bi-pen"></i></button>
                                                        <button
                                                            class="btn btn-sm btn-danger btn-hapus-sub-jenis-pb-pajak-child-3"
                                                            pb-pajak-child-3-id="{{ $item_3->id }}"><i
                                                                class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@push('script')
    <script>
        $(document).on('click', '.btn-hapus-detail-pb-pajak-child-1', function(event) {
            const id = $(event.currentTarget).attr('pb-pajak-child-1-id');
            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-paket-bundling-pajak-child1/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 0) {
                                alert("Gagal Hapus")
                            } else if (data.status_berhasil_hapus == 1) {
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
                                    $("#daftar-jenis-pb-pajak").load(location.href +
                                        " #daftar-jenis-pb-pajak>*", "");
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });

        $(document).on('click', '.btn-hapus-sub-jenis-pb-pajak-child-2', function(event) {
            const id = $(event.currentTarget).attr('pb-pajak-child-2-id');
            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-paket-bundling-pajak-child2/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 0) {
                                alert("Gagal Hapus")
                            } else if (data.status_berhasil_hapus == 1) {
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
                                    $("#daftar-jenis-pb-pajak").load(location.href +
                                        " #daftar-jenis-pb-pajak>*", "");
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });

        $(document).on('click', '.btn-hapus-sub-jenis-pb-pajak-child-3', function(event) {
            const id = $(event.currentTarget).attr('pb-pajak-child-3-id');
            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-paket-bundling-pajak-child3/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 0) {
                                alert("Gagal Hapus")
                            } else if (data.status_berhasil_hapus == 1) {
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
                                    $("#daftar-jenis-pb-pajak").load(location.href +
                                        " #daftar-jenis-pb-pajak>*", "");
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
@endpush
