<div class="modal fade" id="modal-edit-layanan-satuan-child-2" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-edit-layanan-satuan-child-2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-layanan-satuan-child-2Label">Tambah Jenis Layanan </h5>
                <button type="button" class="btn-close batal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-layanan-satuan-child-2">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="req_layanan_satuan_child2_id" id="layanan_satuan_child_2_id"
                                hidden>
                            <label for="pb_pajak_child_1" class="col-form-label">Jenis Layanan</label>
                            <input class="form-control" name="layanan_satuan_child2" id="edit_layanan_satuan_child2">
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text layanan_satuan_child2_error"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="pb_pajak_child_1" class="col-form-label">Timeline</label>
                            <input class="form-control" id="edit_timeline_layanan_satuan" name="timeline">
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                error-text timeline_error"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="pb_pajak_child_1" class="col-form-label">Tarif</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input class="form-control" id="edit_tarif_layanan_satuan" name="tarif">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                error-text tarif_error"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ml-1" id="button-edit-layanan-satuan-child2">
                        <i id="icon-button-edit-layanan-satuan-child2"></i>
                        <span id="text-edit-layanan-satuan-child2" class="d-none d-sm-block">
                            Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#edit_tarif_layanan_satuan').mask('#.##0', {
            reverse: true
        });

        $(document).on('click', '.btn-edit-layanan-satuan-child-2', function(event) {
            const id = $(event.currentTarget).attr('layanan-satuan-child-2-id');
            $("#layanan_satuan_child_2_id").css('display', 'none');
            $.ajax({
                url: `/admin/tampil-data-layanan-satuan-child2/${id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#layanan_satuan_child_2_id').val(response.data.id);
                    $('#edit_layanan_satuan_child2').val(response.data.layanan_satuan_child_2);
                    $('#edit_timeline_layanan_satuan').val(response.data.timeline);
                    $('#edit_tarif_layanan_satuan').val(response.data.tarif);

                    //open modal
                    $('#modal-edit-layanan-satuan-child-2').modal('show');
                }
            });
        });

        $(document).on('click', '.btn-edit-layanan-satuan-child-2', function(event) {
            const id = $(event.currentTarget).attr('layanan-satuan-child-2-id');
            $("#layanan_satuan_child_2_id").val(id);
            $("#modal-edit-layanan-satuan-child-2").modal("show");
        });

        $('#form-edit-layanan-satuan-child-2').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-edit-layanan-satuan-child2")
            $("#icon-button-edit-layanan-satuan-child2").addClass("fa fa-spinner fa-spin")
            $("#text-edit-layanan-satuan-child2").html('')
            $("#button-edit-layanan-satuan-child2").prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.ProsesEditLayananSatuanChild2') }}",
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
                        $("#text-edit-layanan-satuan-child2").html(
                            '<span id="text-edit-layanan-satuan-child2" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-layanan-satuan-child2").prop('disabled', false);
                    } else if (data.status_berhasil == 1) {
                        $("#modal-edit-layanan-satuan-child-2").modal('hide');
                        $("#form-edit-layanan-satuan-child-2").trigger('reset');
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
                        $("#text-edit-layanan-satuan-child2").html(
                            '<span id="text-edit-layanan-satuan-child2" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-layanan-satuan-child2").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#daftar-layanan-satuan").load(location.href +
                            " #daftar-layanan-satuan>*", "");
                    }
                },
            });
        });
    </script>
@endpush
