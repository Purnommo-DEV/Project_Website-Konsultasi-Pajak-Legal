<div class="accordion" id="daftar-layanan-satuan">
    @foreach ($data_layanan_satuan_child_1 as $item_1)
        @php
            $data_layanan_satuan_child_2 = \App\Models\LayananSatuan_Child2::where('layanan_satuan_child_1_id', $item_1->id)->get();
        @endphp
        <div class="accordion-item my-3 shadow">
            <h2 class="accordion-header">
                <div class="btn-group col-md-12" role="group">
                    <button class="btn btn-sm btn-outline-warning btn-edit-layanan-satuan-child-1"
                        layanan-satuan-child-1-id="{{ $item_1->id }}"><i class="bi bi-pen"></i></button>
                    <button class="btn btn-sm btn-outline-danger btn-hapus-layanan-satuan-child-1"
                        layanan-satuan-child-1-id="{{ $item_1->id }}"><i class="bi bi-trash"></i></button>
                    <button class="btn btn-sm btn-outline-primary btn-tambah-layanan-satuan-child-2"
                        layanan-satuan-child-1-id="{{ $item_1->id }}"><i class="bi bi-plus"></i></button>

                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#konten-{{ $item_1->id }}">{{ $item_1->layanan_satuan_child_1 }}</button>
                </div>
            </h2>
            <div id="konten-{{ $item_1->id }}" class="accordion-collapse collapse" data-bs-parent="#daftar-materi"
                style="padding: 1rem;">


                <div class="col-md-12 col-md-12">
                    <div class="card border">
                        <div class="card-content">
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Isi</th>
                                            <th scope="col">Tarif</th>
                                            <th scope="col">Timeline</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_layanan_satuan_child_2 as $item_2)
                                            <tr>
                                                <td scope="row">{{ $item_2->layanan_satuan_child_2 }}</td>
                                                <td scope="row">{{ help_format_rupiah($item_2->tarif) }}</td>
                                                <td scope="row">{{ $item_2->timeline }}</td>
                                                <td scope="row">
                                                    <button
                                                        class="btn btn-sm btn-warning btn-edit-layanan-satuan-child-2"
                                                        layanan-satuan-child-2-id="{{ $item_2->id }}"><i
                                                            class="bi bi-pen"></i></button>
                                                    <button
                                                        class="btn btn-sm btn-danger btn-hapus-layanan-satuan-child-2"
                                                        layanan-satuan-child-2-id="{{ $item_2->id }}"><i
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
            </div>
        </div>
    @endforeach
</div>
@push('script')
    <script>
        $(document).on('click', '.btn-hapus-layanan-satuan-child-1', function(event) {
            const id = $(event.currentTarget).attr('layanan-satuan-child-1-id');
            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-layanan-satuan-child1/" + id,
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
                                    $("#daftar-layanan-satuan").load(location.href +
                                        " #daftar-layanan-satuan>*", "");
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });

        $(document).on('click', '.btn-hapus-layanan-satuan-child-2', function(event) {
            const id = $(event.currentTarget).attr('layanan-satuan-child-2-id');
            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-layanan-satuan-child2/" + id,
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
                                    $("#daftar-layanan-satuan").load(location.href +
                                        " #daftar-layanan-satuan>*", "");
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
