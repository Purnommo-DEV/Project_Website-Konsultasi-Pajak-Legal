<div class="modal fade" id="modal-edit-layanan-satuan-child-1" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-edit-layanan-satuan-child-1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-layanan-satuan-child-1Label">Ubah Jenis Layanan</h5>
                <button type="button" class="btn-close batal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-layanan-satuan-child-1">
                <div class="modal-body">
                    <div id="produk-variasi-id">
                        <div class="row align-items-end">
                            <input type="hidden" id="layanan_satuan_child1_id" name="layanan_satuan_child1_id" hidden>
                            <div class="col-md-12">
                                <label for="pb_pajak_child_1" class="col-form-label">Nama Layanan</label>
                                <input type="text" class="form-control" id="edit_layanan_satuan_child1"
                                    name="layanan_satuan_child_1">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text layanan_satuan_child_1_error"></label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="path" class="col-form-label">Gambar</label>
                                    <input type="file" class="form-control" id="edit-layanan-satuan-c1"
                                        name="path" accept="image/png, image/jpeg, image/jpg">
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
                    <button type="submit" class="btn btn-primary ml-1" id="button-edit-layanan-satuan-child-1">
                        <i id="icon-button-edit-layanan-satuan-child-1"></i>
                        <span id="text-edit-layanan-satuan-child-1" class="d-none d-sm-block">
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
            $("#edit-layanan-satuan-c1").change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                var ext = $('#edit-layanan-satuan-c1').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {

                    $(document).find('label.error-text.path_error').html(
                        "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Format gambar yang diizinkan jpeg, jpg dan png</label>"
                    )
                    $("#edit-layanan-satuan-c1").val(null);
                } else {
                    if (file['size'] < 1111775) {
                        $(document).find('label.error-text.path_error').text('');
                        reader.readAsDataURL(this.files[0]);
                    } else if (file['size'] > 1111775) {
                        $(document).find('label.error-text.path_error').html(
                            "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Ukuran gambar maksimal 1MB</label>"
                        )
                        $("#edit-layanan-satuan-c1").val(null);
                    }
                }
            });
        });

        $(document).on('click', '.btn-edit-layanan-satuan-child-1', function(event) {
            const layanan_satuan_child1_id = $(event.currentTarget).attr('layanan-satuan-child-1-id');
            $("#layanan_satuan_child1_id").css('display', 'none');
            $.ajax({
                url: `/admin/tampil-data-layanan-satuan-child1/${layanan_satuan_child1_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#layanan_satuan_child1_id').val(response.data.id);
                    $('#edit_layanan_satuan_child1').val(response.data.layanan_satuan_child_1);

                    //open modal
                    $('#modal-edit-layanan-satuan-child-1').modal('show');
                }
            });
        });

        $("#form-edit-layanan-satuan-child-1").submit(function(e) {
            e.preventDefault();
            var $search = $("#icon-button-edit-layanan-satuan-child-1")
            $("#icon-button-edit-layanan-satuan-child-1").addClass("fa fa-spinner fa-spin")
            $("#text-edit-layanan-satuan-child-1").html('')
            $("#button-edit-layanan-satuan-child-1").prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.ProsesEditLayananSatuanChild1') }}",
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
                        $("#text-edit-layanan-satuan-child-1").html(
                            '<span id="text-edit-layanan-satuan-child-1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-layanan-satuan-child-1").prop('disabled', false);
                    } else if (data.status_berhasil == 1) {
                        $("#modal-edit-layanan-satuan-child-1").modal('hide');
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
                        $("#text-edit-layanan-satuan-child-1").html(
                            '<span id="text-edit-layanan-satuan-child-1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#form-edit-layanan-satuan-child-1")[0].reset();
                        $("#button-edit-layanan-satuan-child-1").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#daftar-layanan-satuan").load(location.href +
                            " #daftar-layanan-satuan>*", "");
                    }
                }
            });
        });
    </script>
@endpush
