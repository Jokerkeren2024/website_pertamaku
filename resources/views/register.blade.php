@include('layout.templates.head')
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">NiceAdmin</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Register</h5>
                                    <p class="text-center small">Lengkapi data diri Anda</p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" id="nama"
                                            required>
                                        <span class="text-danger" id="namaError"></span>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            required>
                                        <span class="text-danger" id="emailError"></span>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>
                                        <span class="text-danger" id="passwordError"></span>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="button"
                                            onclick="register()">Register</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Apakah sudah punya Akun ? <a href="/">Log
                                                in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            <!-- All the links in the footer should remain intact. -->
                            <!-- You can delete the links only if you purchased the pro version. -->
                            <!-- Licensing information: https://bootstrapmade.com/license/ -->
                            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

@include('layout.templates.script')

<script>
    function addClassInput() {
        $('#namaError').addClass('d-none');
        $('#emailError').addClass('d-none');
        $('#passwordError').addClass('d-none');
    }

    function register() {
        var url = "{{ route('user.register_user') }}";
        var nama = $('#nama').val();
        var email = $('#email').val();
        var password = $('#password').val();

        addClassInput();

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                nama: nama,
                email: email,
                password: password,
            },
            success: (data) => {
                if (data.success) {
                    Swal.fire({
                        title: "Sukses",
                        text: "Akun berhasil didaftarkan",
                        type: "Success"
                    }).then((result) => {
                        //Reload the page
                        location.reload();
                    });
                }
            },
            error: function(data) {
                var errors = data.responseJSON;
                if ($.isEmptyObject(errors) == false) {
                    $.each(errors.errors, function(key, value) {
                        var ErrorID = '#' + key + 'Error';
                        $(ErrorID).removeClass('d-none');
                        $(ErrorID).text(value)
                    })
                }
            }

        });
    }
</script>
