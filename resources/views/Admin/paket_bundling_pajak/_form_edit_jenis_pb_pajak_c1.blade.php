<div class="modal fade" id="modal-edit-jenis-pb-pajak-child-1" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-edit-jenis-pb-pajak-child-1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-jenis-pb-pajak-child-1Label">Tambah Jenis
                    {{ Str::title($data_paket_bundling_pajak->p_b_pajak) }} </h5>
                <button type="button" class="btn-close batal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-jenis-pb-pajak-child-1">
                <div class="modal-body">
                    <div id="produk-variasi-id">
                        <div class="row align-items-end">
                            <input type="hidden" id="p_b_pajak_child_1_id" name="p_b_pajak_child_1_id" hidden>
                            <div class="col-md-12">
                                <label for="pb_pajak_child_1" class="col-form-label">Jenis Paket</label>
                                <input type="text" class="form-control" id="edit_p_b_pajak_child_1"
                                    name="p_b_pajak_child_1">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text p_b_pajak_child_1_error"></label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="path" class="col-form-label">Gambar</label>
                                    <input type="file" class="form-control" id="edit-pb-c1-path" name="path"
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
                    <button type="submit" class="btn btn-primary ml-1" id="button-edit-pb-pajak-child1">
                        <i id="icon-button-edit-pb-pajak-child1"></i>
                        <span id="text-edit-pb-pajak-child1" class="d-none d-sm-block">
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
            $("#edit-pb-c1-path").change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                var ext = $('#edit-pb-c1-path').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {

                    $(document).find('label.error-text.path_error').html(
                        "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Format gambar yang diizinkan jpeg, jpg dan png</label>"
                    )
                    $("#edit-pb-c1-path").val(null);
                } else {
                    if (file['size'] < 1111775) {
                        $(document).find('label.error-text.path_error').text('');
                        reader.readAsDataURL(this.files[0]);
                    } else if (file['size'] > 1111775) {
                        $(document).find('label.error-text.path_error').html(
                            "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Ukuran gambar maksimal 1MB</label>"
                        )
                        $("#edit-pb-c1-path").val(null);
                    }
                }
            });
        });

        $(document).on('click', '.btn-ubah-detail-pb-pajak-child-1', function(event) {
            const pb_pajak_child1 = $(event.currentTarget).attr('pb-pajak-child-1-id');
            $("#p_b_pajak_child_1_id").css('display', 'none');
            $.ajax({
                url: `/admin/tampil-data-paket-bundling-pajak-child1/${pb_pajak_child1}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#p_b_pajak_child_1_id').val(response.data.id);
                    $('#edit_p_b_pajak_child_1').val(response.data.p_b_pajak_child_1);

                    //open modal
                    $('#modal-edit-jenis-pb-pajak-child-1').modal('show');
                }
            });
        });

        $("#form-edit-jenis-pb-pajak-child-1").submit(function(e) {
            e.preventDefault();
            var $search = $("#icon-button-edit-pb-pajak-child1")
            $("#icon-button-edit-pb-pajak-child1").addClass("fa fa-spinner fa-spin")
            $("#text-edit-pb-pajak-child1").html('')
            $("#button-edit-pb-pajak-child1").prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.ProsesEditPaketBundlingPajak_Child1') }}",
                method: 'POST',
                data: new FormData(this),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
                        $("#text-edit-pb-pajak-child1").html(
                            '<span id="text-edit-pb-pajak-child1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-pb-pajak-child1").prop('disabled', false);
                    } else if (data.status_berhasil_ubah == 1) {
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
                        $("#text-edit-pb-pajak-child1").html(
                            '<span id="text-edit-pb-pajak-child1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#form-edit-jenis-pb-pajak-child-1")[0].reset();
                        $("#modal-edit-jenis-pb-pajak-child-1").modal('hide');
                        $("#button-edit-pb-pajak-child1").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#daftar-jenis-pb-pajak").load(location.href +
                            " #daftar-jenis-pb-pajak>*", "");
                    }
                }
            });
        });
    </script>
@endpush
