<div class="g-col-4">
    <a href="!#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
        data-bs-target="#modal-tambah-layanan-satuan-child-1">+</a>
</div>
<div class="modal fade" id="modal-tambah-layanan-satuan-child-1" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-tambah-layanan-satuan-child-1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-layanan-satuan-child-1Label">Tambah Jenis Layanan </h5>
                <button type="button" class="btn-close batal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-layanan-satuan-child-1">
                <div class="modal-body">
                    <div id="produk-variasi-id">
                        <div class="row">
                            <div class="col-md-9">
                                <label for="pb_pajak_child_1" class="col-form-label">Jenis Layanan</label>
                                <input class="form-control" name="layanan_satuan_child1">
                                <div class="input-group has-validation">
                                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text layanan_satuan_child1_error"></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="pb_pajak_child_1" class="col-form-label">Tipe Layanan</label>
                                <select class="form-control" name="tipe_id" id="pilih-tipe">
                                    <option value="" disabled selected>-- Pilih Tipe --</option>
                                    <option value="1">Single</option>
                                    <option value="2">Multiple</option>
                                </select>
                                <div class="input-group has-validation">
                                    <label
                                        style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger error-text tipe_id_error">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="path" class="col-form-label">Gambar</label>
                                    <input type="file" class="form-control" id="tambah-layanan-satuan-c1-path"
                                        name="path" accept="image/png, image/jpeg, image/jpg">
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                    error-text path_error"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="data-single">
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <label for="pb_pajak_child_1" class="col-form-label">Timeline</label>
                                        <input class="form-control" name="timeline_single">
                                        <div class="input-group has-validation">
                                            <label
                                                style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text layanan_satuan_error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pb_pajak_child_1" class="col-form-label">Tarif</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                            <input class="form-control" id="tarif_single" name="tarif_single">
                                            <div class="input-group has-validation">
                                                <label
                                                    style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text layanan_satuan_error"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="data-multiple">
                                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                                    <div class="row" style="padding: 1rem;">
                                        <div class="col-md-12">
                                            <label for="pb_pajak_child_1" class="col-form-label">Sub Jenis
                                                Layanan</label>
                                            <input class="form-control" name="sub_layanan_satuan_child1[0]">
                                            <div class="input-group has-validation">
                                                <label
                                                    style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text layanan_satuan_error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="pb_pajak_child_1" class="col-form-label">Timeline</label>
                                            <input class="form-control" name="timeline_multiple[0]">
                                            <div class="input-group has-validation">
                                                <label
                                                    style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text layanan_satuan_error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="pb_pajak_child_1" class="col-form-label">Tarif</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                                <input class="form-control" id="tarif_multiple"
                                                    name="tarif_multiple[0]">
                                                <div class="input-group has-validation">
                                                    <label
                                                        style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                        error-text layanan_satuan_error"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2 mb-3">
                                            <div class="mb-3">
                                                <button class="btn btn-block btn-primary" type="button"
                                                    onclick="tambah_form_data_multiple()">+</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="div-data-multiple"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ml-1" id="button-tambah-layanan-satuan-child1">
                        <i id="icon-button-tambah-layanan-satuan-child1"></i>
                        <span id="text-tambah-layanan-satuan-child1" class="d-none d-sm-block">
                            Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        $("#data-single").hide();
        $("#data-multiple").hide();
        $(function() {
            $formSingle = $("#data-single");
            $formMultiple = $("#data-multiple");
            $('#pilih-tipe').on('change', function() {
                if (this.value === '1') {
                    $formSingle.show();
                    $formMultiple.hide();
                } else if (this.value === '2') {
                    $formMultiple.show();
                    $formSingle.hide();
                }
            });
        });

        var newId = 1;
        var data_multiple = jQuery.validator.format(`
        <div id="div-data-multiple">
            <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
            <div class="row" style="padding: 1rem;">
                <div class="col-md-12">
                    <label for="pb_pajak_child_1" class="col-form-label">Sub Jenis Layanan</label>
                    <input class="form-control" name="sub_layanan_satuan_child1[{0}]">
                    <div class="input-group has-validation">
                        <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger error-text layanan_satuan_error"></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="pb_pajak_child_1" class="col-form-label">Timeline</label>
                    <input class="form-control" name="timeline_multiple[{0}]">
                    <div class="input-group has-validation">
                        <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                    error-text layanan_satuan_error"></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="pb_pajak_child_1" class="col-form-label">Tarif</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                        <input class="form-control"  id="tarif_multiple{0}" name="tarif_multiple[{0}]>
                        <div class="input-group has-validation">
                            <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-dangererror-text layanan_satuan_error"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2 mb-3" style="padding: 1rem;">
                    <div class="mb-3">
                        <button class="btn btn-block btn-danger hapus-form-data-multiple">-</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        `);

        function tambah_form_data_multiple() {
            $('#div-data-multiple').append(data_multiple(newId));
            $('#tarif_multiple' + newId).mask('#.##0', {
                reverse: true
            });
            newId++;
        }

        $('#tarif_multiple, #tarif_single').mask('#.##0', {
            reverse: true
        });

        $('#div-data-multiple').on('click', '.hapus-form-data-multiple', function(e) {
            e.preventDefault();
            newId--;
            $(this).parent().parent().parent().remove();
        });

        $(document).ready(function(e) {
            $("#tambah-layanan-satuan-c1-path").change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                var ext = $('#tambah-layanan-satuan-c1-path').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                    $(document).find('label.error-text.path_error').html(
                        "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Format gambar yang diizinkan jpeg, jpg dan png</label>"
                    );
                    $("#tambah-layanan-satuan-c1-path").val(null);
                } else {
                    if (file['size'] < 1111775) {
                        $(document).find('label.error-text.path_error').text('');
                        reader.readAsDataURL(this.files[0]);
                    } else if (file['size'] > 1111775) {
                        $(document).find('label.error-text.path_error').html(
                            "<label style='margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; 'class='text-danger error-text path_error'>Ukuran gambar maksimal 1MB</label>"
                        );
                        $("#tambah-layanan-satuan-c1-path").val(null);
                    }
                }
            });
        });

        var layanan_satuan_id = @json($data_layanan_satuan->id);
        $('#form-tambah-layanan-satuan-child-1').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-tambah-layanan-satuan-child1")
            $("#icon-button-tambah-layanan-satuan-child1").addClass("fa fa-spinner fa-spin")
            $("#text-tambah-layanan-satuan-child1").html('')
            $("#button-tambah-layanan-satuan-child1").prop('disabled', true);

            var data = new FormData(this);
            data.append('req_layanan_satuan_child1_id', layanan_satuan_id);
            data.append('key', 'value');
            $.ajax({
                url: "{{ route('admin.ProsesTambahDataLayananSatuanChild1') }}",
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
                        $("#text-tambah-layanan-satuan-child1").html(
                            '<span id="text-tambah-layanan-satuan-child1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-layanan-satuan-child1").prop('disabled', false);
                    } else if (data.status_berhasil == 1) {
                        $("#modal-tambah-layanan-satuan-child-1").modal('hide');
                        $("#form-tambah-layanan-satuan-child-1").trigger('reset');
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
                        $("#text-tambah-layanan-satuan-child1").html(
                            '<span id="text-tambah-layanan-satuan-child1" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-layanan-satuan-child1").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#daftar-layanan-satuan").load(location.href +
                            " #daftar-layanan-satuan>*", "");
                    }
                },
            });
        });
    </script>
@endpush
