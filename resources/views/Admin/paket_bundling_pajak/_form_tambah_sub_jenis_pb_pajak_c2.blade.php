<div class="modal fade" id="modal-tambah-sub-jenis-pb-pajak-child-2" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-tambah-sub-jenis-pb-pajak-child-2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-sub-jenis-pb-pajak-child-2Label">Tambah Jenis
                    Sub {{ Str::title($data_paket_bundling_pajak->p_b_pajak) }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-sub-jenis-pb-pajak-child-2" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="produk-variasi-id">
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <input class="form-control" id="pb-pajak-child-1-id" name="req_pb_pajak_child_1_id">
                                <label for="pb_pajak_child_1" class="col-form-label">Sub Jenis Paket</label>
                                <input class="form-control" id="p_b_pajak_child_2" name="p_b_pajak_child_2">
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text p_b_pajak_child_2_error"></label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="path" class="col-form-label">Gambar</label>
                                    <input type="file" class="form-control" id="path" name="path">
                                    <div class="input-group has-validation">
                                        <label class="text-danger error-text path_error"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(document).on('click', '.btn-tambah-sub-jenis-pb-pajak-child-2', function(event) {
            var id = $(event.currentTarget).attr('pb-pajak-child-1-id');
            $('#pb-pajak-child-1-id').val(id);
            $("#modal-tambah-sub-jenis-pb-pajak-child-2").modal('show')
        });

        $('#form-tambah-sub-jenis-pb-pajak-child-2').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.ProsesTambahSubJenisPBPajak_Child2') }}",
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
                    } else if (data.status_berhasil == 1) {
                        $("#modal-tambah-sub-jenis-pb-pajak-child-2").modal('hide');
                        $("#form-tambah-sub-jenis-pb-pajak-child-2").trigger('reset');
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
                        $("#daftar-jenis-pb-pajak").load(location.href +
                            " #daftar-jenis-pb-pajak>*", "");
                    }
                },
            });
        });
    </script>
@endpush
