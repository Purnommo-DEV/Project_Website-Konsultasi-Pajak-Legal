<div class="modal fade" id="modal-tambah-sub-jenis-pb-pajak-child-2" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-tambah-sub-jenis-pb-pajak-child-2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-sub-jenis-pb-pajak-child-2Label">Tambah Jenis
                    Sub {{ Str::title($data_paket_bundling_pajak->p_b_pajak) }} </h5>
                <button type="button" class="btn-close batal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-sub-jenis-pb-pajak-child-2" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="produk-variasi-id">
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <input class="form-control" type="hidden" id="pb-pajak-child-1-id"
                                    name="req_pb_pajak_child_1_id" hidden>

                                <label for="pb_pajak_child_1" class="col-form-label">Sub Jenis Paket</label>
                                <input class="form-control" id="p_b_pajak_child_2" name="p_b_pajak_child_2">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text p_b_pajak_child_2_error"></label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="path" class="col-form-label">Gambar</label>
                                    <input type="file" class="form-control" id="tambah-pb-c2-path" name="path"
                                        accept="image/png, image/jpeg, image/jpg">
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                            error-text path_error"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ml-1" id="button-tambah-pb-pajak-child2">
                        <i id="icon-button-tambah-pb-pajak-child2"></i>
                        <span id="text-tambah-pb-pajak-child2" class="d-none d-sm-block">
                            Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(document).ready(function(e) {
            $("#tambah-pb-c2-path").change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                var ext = $('#tambah-pb-c2-path').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                    $(document).find('label.error-text.path_error').html(
                        "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Format gambar yang diizinkan jpeg, jpg dan png</label>"
                    );
                    $("#tambah-pb-c2-path").val(null);
                } else {
                    if (file['size'] < 1111775) {
                        $(document).find('label.error-text.path_error').text('');
                        reader.readAsDataURL(this.files[0]);
                    } else if (file['size'] > 1111775) {
                        $(document).find('label.error-text.path_error').html(
                            "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Ukuran gambar maksimal 1MB</label>"
                        );
                        $("#tambah-pb-c2-path").val(null);
                    }
                }
            });
        });
        $(document).on('click', '.btn-tambah-sub-jenis-pb-pajak-child-2', function(event) {
            var id = $(event.currentTarget).attr('pb-pajak-child-1-id');
            $('#pb-pajak-child-1-id').val(id);
            $("#modal-tambah-sub-jenis-pb-pajak-child-2").modal('show')
        });

        $('#form-tambah-sub-jenis-pb-pajak-child-2').submit(function(e) {
            e.preventDefault();
            var $search = $("#icon-button-tambah-pb-pajak-child2")
            $("#icon-button-tambah-pb-pajak-child2").addClass("fa fa-spinner fa-spin")
            $("#text-tambah-pb-pajak-child2").html('')
            $("#button-tambah-pb-pajak-child2").prop('disabled', true);
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-tambah-pb-pajak-child2").html(
                            '<span id="text-tambah-pb-pajak-child2" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-pb-pajak-child2").prop('disabled', false);
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-tambah-pb-pajak-child2").html(
                            '<span id="text-tambah-pb-pajak-child2" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-pb-pajak-child2").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#daftar-jenis-pb-pajak").load(location.href +
                            " #daftar-jenis-pb-pajak>*", "");
                    }
                },
            });
        });
    </script>
@endpush
