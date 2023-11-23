<div class="modal fade" id="modal-edit-sub-jenis-pb-pajak-child-3" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-edit-sub-jenis-pb-pajak-child-3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-sub-jenis-pb-pajak-child-3Label">Tambah Jenis
                    Sub {{ Str::title($data_paket_bundling_pajak->p_b_pajak) }} </h5>
                <button type="button" class="btn-close batal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-edit-sub-jenis-pb-pajak-child-3" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="produk-variasi-id">
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <input class="form-control" type="hidden" id="pb-pajak-child-3-id"
                                    name="req_pb_pajak_child_3_id" hidden>
                                <label for="pb_pajak_child_1" class="col-form-label">Paket Pajak</label>
                                <input class="form-control" id="paket_pajak_pilihan_id" readonly>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tarif" class="col-form-label">Tarif</label>
                                    <input type="text" class="form-control" id="edit_tarif_pb_child3" name="tarif">
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                            error-text tarif_error"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ml-1" id="button-edit-pb-pajak-child3">
                        <i id="icon-button-edit-pb-pajak-child3"></i>
                        <span id="text-edit-pb-pajak-child3" class="d-none d-sm-block">
                            Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(document).on('click', '.btn-edit-sub-jenis-pb-pajak-child-3', function(event) {
            const pb_pajak_child3 = $(event.currentTarget).attr('pb-pajak-child-3-id');
            $("#pb-pajak-child-3-id").css('display', 'none');
            $.ajax({
                url: `/admin/tampil-data-paket-bundling-pajak-child3/${pb_pajak_child3}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    $('#pb-pajak-child-3-id').val(response.data.id);
                    $('#paket_pajak_pilihan_id').val(response.data.relasi_pajak.paket);
                    $('#edit_tarif_pb_child3').val(formatRupiah(`Rp. ${response.data.tarif}`));
                    $("#modal-edit-sub-jenis-pb-pajak-child-3").modal('show')
                }
            });
        });

        $('#form-edit-sub-jenis-pb-pajak-child-3').submit(function(e) {
            e.preventDefault();
            var $search = $("#icon-button-edit-pb-pajak-child3")
            $("#icon-button-edit-pb-pajak-child3").addClass("fa fa-spinner fa-spin")
            $("#text-edit-pb-pajak-child3").html('')
            $("#button-edit-pb-pajak-child3").prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.ProsesEditPaketBundlingPajak_Child3') }}",
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
                        $("#text-edit-pb-pajak-child3").html(
                            '<span id="text-edit-pb-pajak-child3" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-pb-pajak-child3").prop('disabled', false);
                    } else if (data.status_data_tidak_ada == 1) {
                        $("#form-edit-sub-jenis-pb-pajak-child-3")[0].reset();
                        $("#modal-edit-sub-jenis-pb-pajak-child-3").modal('hide');
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
                            icon: 'error',
                            title: data.msg
                        })
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-edit-pb-pajak-child3").html(
                            '<span id="text-edit-pb-pajak-child3" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-pb-pajak-child3").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                    } else if (data.status_berhasil_ubah == 1) {
                        $("#form-edit-sub-jenis-pb-pajak-child-3")[0].reset();
                        $("#modal-edit-sub-jenis-pb-pajak-child-3").modal('hide');
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
                        $("#text-edit-pb-pajak-child3").html(
                            '<span id="text-edit-pb-pajak-child3" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-pb-pajak-child3").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#daftar-jenis-pb-pajak").load(location.href +
                            " #daftar-jenis-pb-pajak>*", "");
                    }
                },
            });
        });
    </script>
@endpush
