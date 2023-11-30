<div class="modal fade text-left" id="modal-edit-jenis-pelayanan-notaris-child-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Jenis Layanan</h4>
                <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="form-edit-jenis-pelayanan-notaris-child-1" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col">
                        <div class="form-group">
                            <label class="col col-form-label" for="paket">Jenis Layanan</label>
                            <input type="text" id="p_pel_notaris_child1_id" name="req_p_pel_notaris_child_1_id">
                            <input name="p_pel_notaris_child_1" class="form-control"
                                placeholder="Masukkan Nama Jenis Layanan" id="edit_p_pel_notaris_child1">
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                    error-text p_pel_notaris_child_1_error"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col col-form-label" for="isi">Isi</label>
                            <textarea name="isi" class="form-control" id="edit_isi" placeholder="Masukkan Isi Paket"></textarea>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                    error-text isi_error"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col col-form-label" for="tarif">Tarif</label>
                            <input name="tarif" id="edit_tarif_pb_child1" class="form-control"
                                placeholder="Masukkan Tarif Paket" />
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                    error-text tarif_error"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col col-form-label" for="path">Gambar</label>
                            <input type="file" accept="image/png, image/jpeg, image/jpg" name="path"
                                id="edit-pl-notaris-c1-path" class="form-control">
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                                    error-text path_error"></label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" id="button-edit-pelayanan-notaris-child1">
                        <i id="icon-button-edit-pelayanan-notaris-child1"></i>
                        <span id="text-edit-pelayanan-notaris-child1" class="d-none d-sm-block">
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
            const p_pel_notaris_child1 = $(event.currentTarget).attr('p-pel-notaris-child-1-id');
            $("#p_pel_notaris_child1_id").css('display', 'none');
            $.ajax({
                url: `/admin/tampil-data-paket-pelayanan-notaris-child1/${p_pel_notaris_child1}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    $('#p_pel_notaris_child1_id').val(p_pel_notaris_child1);
                    $('#edit_p_pel_notaris_child1').val(response.data.p_pel_notaris_child_1);
                    $('#edit_isi').val(response.data.isi);
                    $('#edit_tarif_pb_child1').val(formatRupiah(`Rp. ${response.data.tarif}`));
                    $("#modal-edit-jenis-pelayanan-notaris-child-1").modal('show')
                }
            });
        });

        $('#form-edit-jenis-pelayanan-notaris-child-1').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-edit-pelayanan-notaris-child1")
            $("#icon-button-edit-pelayanan-notaris-child1").addClass("fa fa-spinner fa-spin")
            $("#text-edit-pelayanan-notaris-child1").html('')
            $("#button-edit-pelayanan-notaris-child1").prop('disabled', true);
            var data = new FormData(this);
            data.append('req_p_pel_notaris_id', p_notaris);
            data.append('key', 'value');
            $.ajax({
                url: "{{ route('admin.ProsesEditPaketPelayananNotarisChild1') }}",
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-edit-pelayanan-notaris-child1").html(
                            '<span id="text-edit-pelayanan-notaris-child1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-pelayanan-notaris-child1").prop('disabled', false);
                    } else if (data.status_berhasil_ubah == 1) {
                        $("#modal-edit-jenis-pelayanan-notaris-child-1").modal('hide');
                        $("#form-edit-jenis-pelayanan-notaris-child-1").trigger('reset');
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
                        $("#text-edit-pelayanan-notaris-child1").html(
                            '<span id="text-edit-pelayanan-notaris-child1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-pelayanan-notaris-child1").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#daftar-jenis-pelayanan-notaris").load(location.href +
                            " #daftar-jenis-pelayanan-notaris>*", "");
                        table_data_pelayanan_notaris_child1.draw();
                    } else if (data.status_pelayanan_tidak_ada == 1) {
                        $("#modal-edit-jenis-pelayanan-notaris-child-1").modal('hide');
                        $("#form-edit-jenis-pelayanan-notaris-child-1").trigger('reset');
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
                        $("#text-edit-pelayanan-notaris-child1").html(
                            '<span id="text-edit-pelayanan-notaris-child1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-edit-pelayanan-notaris-child1").prop('disabled', false);
                        $(document).find('label.error-text').text('');

                    }
                },
            });
        });

        $(document).ready(function(e) {
            $("#edit-pl-notaris-c1-path").change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                var ext = $('#edit-pl-notaris-c1-path').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                    $(document).find('label.error-text.path_error').html(
                        "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Format gambar yang diizinkan jpeg, jpg dan png</label>"
                    );
                    $("#edit-pl-notaris-c1-path").val(null);
                } else {
                    if (file['size'] < 1111775) {
                        $(document).find('label.error-text.path_error').text('');
                        reader.readAsDataURL(this.files[0]);
                    } else if (file['size'] > 1111775) {
                        $(document).find('label.error-text.path_error').html(
                            "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Ukuran gambar maksimal 1MB</label>"
                        );
                        $("#edit-pl-notaris-c1-path").val(null);
                    }
                }
            });
        });
    </script>
@endpush
