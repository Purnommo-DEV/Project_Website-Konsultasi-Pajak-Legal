<div class="modal fade" id="modal-tambah-sub-jenis-pb-pajak-child-3" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modal-tambah-sub-jenis-pb-pajak-child-3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-sub-jenis-pb-pajak-child-3Label">Tambah Jenis
                    Sub {{ Str::title($data_paket_bundling_pajak->p_b_pajak) }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-sub-jenis-pb-pajak-child-3" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="produk-variasi-id">
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <label for="pb_pajak_child_1" class="col-form-label">Isi</label>
                                <select class="form-control" id="p_pajak_id" name="p_pajak_id">
                                    <option value="" selected disabled>-- Pilih Paket --</option>
                                    @foreach ($data_paket_pajak as $paket_pajak)
                                        <option value="{{ $paket_pajak->id }}">{{ $paket_pajak->paket }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text p_pajak_id_error"></label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tarif" class="col-form-label">Tarif</label>
                                    <input type="text" class="form-control" id="tarif" name="tarif">
                                    <div class="input-group has-validation">
                                        <label class="text-danger error-text tarif_error"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(document).on('click', '.btn-tambah-sub-jenis-pb-pajak-child-3', function(event) {
            const id = $(event.currentTarget).attr('pb-pajak-child-2-id');

            $("#modal-tambah-sub-jenis-pb-pajak-child-3").modal('show')

            $('#form-tambah-sub-jenis-pb-pajak-child-3').on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);

                // Form data (Input tambahan di luar dari Form)
                data.append('req_pb_pajak_child_2_id', id);

                //Custom data
                data.append('key', 'value');
                $.ajax({
                    url: "{{ route('admin.ProsesTambahSubJenisPBPajak_Child3') }}",
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
                            $("#form-tambah-sub-jenis-pb-pajak-child-3")[0].reset();
                            $("#modal-tambah-sub-jenis-pb-pajak-child-3").modal('hide');
                            $("#daftar-jenis-pb-pajak").load(location.href +
                                " #daftar-jenis-pb-pajak>*", "");
                        }
                    },
                });
            });
        });

        var tarif = document.getElementById(`tarif`);
        tarif.addEventListener('keyup', function(e) {
            tarif.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endpush
