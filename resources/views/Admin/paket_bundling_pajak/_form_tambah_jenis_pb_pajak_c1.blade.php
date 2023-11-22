<div class="g-col-4">
    <a href="!#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
        data-bs-target="#modal-tambah-jenis-pb-pajak-child-1">+</a>
</div>
<div class="modal fade" id="modal-tambah-jenis-pb-pajak-child-1" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-tambah-jenis-pb-pajak-child-1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-jenis-pb-pajak-child-1Label">Tambah Jenis
                    {{ Str::title($data_paket_bundling_pajak->p_b_pajak) }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-jenis-pb-pajak-child-1">
                <div class="modal-body">
                    <div id="produk-variasi-id">
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <label for="pb_pajak_child_1" class="col-form-label">Jenis Paket</label>
                                <input class="form-control" id="p_b_pajak_child_1" name="p_b_pajak_child_1">
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text p_b_pajak_child_1_error"></label>
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
        var pb_pajak = @json($data_paket_bundling_pajak);
        $('#form-tambah-jenis-pb-pajak-child-1').on('submit', function(e) {
            e.preventDefault();
            var data = new FormData();

            // Form data (Input yang ada di FORM, kecuali type file)
            var form_data = $('#form-tambah-jenis-pb-pajak-child-1').serializeArray();
            $.each(form_data, function(key, input) {
                data.append(input.name, input.value);
            });

            // Form data (Input dengan type file)
            var file_data = $('input[name="path"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("path", file_data[i]);
            }

            // Form data (Input tambahan di luar dari Form)
            data.append('req_pb_pajak_id', pb_pajak.id);

            //Custom data
            data.append('key', 'value');
            $.ajax({
                url: "{{ route('admin.ProsesTambahJenisPBPajak_Child1') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
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
                        $("#modal-tambah-jenis-pb-pajak-child-1").modal('hide');
                        $("#form-tambah-jenis-pb-pajak-child-1").trigger('reset');
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
