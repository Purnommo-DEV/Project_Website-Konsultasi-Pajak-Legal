@extends('Front.layout.master', ['title' => 'Login'])
@section('konten')
    <div class="container-fluid appointment my-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-5 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="border-start border-5 border-primary ps-4 mb-5">
                        <h6 class="text-white text-uppercase mb-2">Log In</h6>
                        <h1 class="display-6 text-white mb-0">
                            Silahkan Masuk Dengan Akun Anda
                        </h1>
                    </div>
                    <p class="text-white mb-0">
                        Jika anda belum memiliki akun, anda dapat menekan tombol berikut untuk mendaftar.
                    </p>
                    <a href="{{ route('HalamanRegister') }}">
                        Daftar Akun
                    </a>
                </div>
                <div class="col-lg-7 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <form id="form-login-pengguna">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-dark border-0" id="nik-id"
                                        placeholder="Nomor Induk Kependudukan" name="nik" />
                                    <label for="nik-id">Nomor Induk Kependudukan</label>
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                error-text nik_error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control bg-dark border-0" id="password-id"
                                        placeholder="Password" name="password" />
                                    <label for="password-id">Kata Sandi</label>
                                    <div class="input-group has-validation">
                                        <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600; "class="text-danger
                                                error-text password_error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3">
                                    Masuk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        if ($("#form-login-pengguna").length > 0) {
            $("#form-login-pengguna").validate({
                rules: {
                    nik: {
                        required: true,
                        maxlength: 16,
                    },
                    password: {
                        required: true,
                        maxlength: 50,
                    }
                },
                messages: {
                    nik: {
                        required: "<label class='text-danger error-text' style='margin-top:1.6rem !important; font-weight: 500; font-size: 0.7rem;'>Wajib diisi</label>",
                        maxlength: "The email name should less than or equal to 16 characters",
                    },
                    password: {
                        required: "<label class='text-danger error-text' style='margin-top:1.6rem !important; font-weight: 500; font-size: 0.7rem;'>Wajib diisi</label>",
                        maxlength: "The email name should less than or equal to 50 characters",
                    }

                },
                submitHandler: function(form) {
                    var data = new FormData();
                    // Form data (Input yang ada di FORM, kecuali type file)
                    var form_data = $('#form-login-pengguna').serializeArray();
                    $.each(form_data, function(key, input) {
                        data.append(input.name, input.value);
                    });

                    //KASUS : Jika id tidak ditemukan maka ketika menekan tombol submit maka halaman akan reload
                    // data.append('pengguna_id', id);

                    //Custom data
                    data.append('key', 'value');

                    // AJAX request
                    $.ajax({
                        url: "{{ route('ProsesLogin') }}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: data,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        beforeSend: function() {
                            $(document).find('label.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status_form_kosong == 1) {
                                $.each(data.error, function(prefix, val) {
                                    $('label.' + prefix + '_error').text(val[
                                        0]);
                                    // $('span.'+prefix+'_error').text(val[0]);
                                });
                            } else if (data.status_berhasil_login == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: data.msg
                                })
                                window.location.href = `${data.route}`;
                            } else if (data.status_user_pass_salah == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'error',
                                    title: data.msg
                                })
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection
