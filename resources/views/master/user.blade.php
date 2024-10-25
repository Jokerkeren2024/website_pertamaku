    @extends('layout.mainlayout')
    @section('content')
        <main id="main" class="main mb-5">

            <div class="pagetitle">
                <h1>Menu User</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{ $home }}</a></li>
                        <li class="breadcrumb-item">{{ $menu }}</li>
                        <li class="breadcrumb-item active">{{ $titleSubmenu }}</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card box-shadow">
                            <div class="card-body">
                                <h5 class="card-title">Data User</h5>
                                <a class="btn btn-sm btn-primary mb-2 box-shadow" href="javascript:;" onclick="addUser()"
                                    id="add-user"> <i class="bi-plus"></i> Tambah
                                    Data </a>
                                <!-- Table with stripped rows -->
                                <table class="table datatable table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Pekerjaan</th>
                                            <th>Alamat</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->nama }}</td>
                                                <td>{{ $user->pekerjaan }}</td>
                                                <td>{{ $user->alamat }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a href="javascript:;" onclick="editUser('{{ $user->id }}')"
                                                        id="edit-user" class="btn btn-sm btn-success mb-2 box-shadow"> <i
                                                            class="bi-pencil"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-sm btn-danger mb-2 box-shadow"
                                                        onclick="deleteUser('{{ $user->id }}', '{{ $user->nama }}')">
                                                        <i class="bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Modal Tambah-->
            <div class="modal fade" id="modal-add-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form {{ $titleSubmenu }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama">
                                    <span class="text-danger" id="namaError"></span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" id="pekerjaan">
                                    <span class="text-danger" id="pekerjaanError"></span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat">
                                    <span class="text-danger" id="alamatError"></span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                    <span class="text-danger" id="emailError"></span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                    <span class="text-danger" id="passwordError"></span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" onclick="saveUser()">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal fade" id="modal-edit-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form {{ $titleSubmenuEdit }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="e_nama">Nama</label>
                                    <input type="text" class="form-control" name="e_nama" id="e_nama">
                                    <span class="text-danger" id="e_namaError"></span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="e_pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" name="e_pekerjaan" id="e_pekerjaan">
                                    <span class="text-danger" id="e_pekerjaanError"></span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="e_alamat">Alamat</label>
                                    <input type="text" class="form-control" name="e_alamat" id="e_alamat">
                                    <span class="text-danger" id="e_alamatError"></span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="e_email">Email</label>
                                    <input type="email" class="form-control" name="e_email" id="e_email">
                                    <span class="text-danger" id="e_emailError"></span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="e_password">Password</label>
                                    <input type="password" class="form-control" name="e_password" id="e_password">
                                    <span class="text-danger" id="e_passwordError"></span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" onclick="updateUser()">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </main><!-- End #main -->
    @endsection

    <script>
        function addUser() {
            addClassInput();
            clearInput();
            $('#modal-add-user').modal('show');
        }

        function saveUser() {
            var url = "{{ route('user.store') }}";
            var nama = $('#nama').val();
            var pekerjaan = $('#pekerjaan').val();
            var alamat = $('#alamat').val();
            var email = $('#email').val();
            var password = $('#password').val();
            addClassInput();

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    nama: nama,
                    pekerjaan: pekerjaan,
                    alamat: alamat,
                    email: email,
                    password: password
                },
                success: (data) => {
                    //kalau berhasil gmn
                    if (data.success) {
                        $('#modal-add-user').modal('hide');
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    }

                },
                error: function(data) {
                    //kalau error gmn
                    var errors = data.responseJSON;
                    if ($.isEmptyObject(errors) == false) {
                        $.each(errors.errors, function(key, value) {
                            var ErrorID = '#' + key + 'Error';
                            $(ErrorID).removeClass('d-none');
                            $(ErrorID).text(value);
                        })
                    }

                }
            })
        }

        function addClassInput() {
            $('#namaError').addClass('d-none');
            $('#pekerjaanError').addClass('d-none');
            $('#alamatError').addClass('d-none');
            $('#emailError').addClass('d-none');
            $('#passwordError').addClass('d-none');
        }

        function clearInput() {
            $('#nama').val('');
            $('#pekerjaan').val('');
            $('#alamat').val('');
            $('#email').val('');
            $('#password').val('');
        }

        function deleteUser(id, nama) {
            var id = id;
            var nama = nama;

            Swal.fire({
                title: "Yakin ingin dihapus <strong class='text-danger'>" + nama + " </strong>?",
                // text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'GET',
                        url: 'user/destroy/' + id,
                        success: (data) => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Sukses",
                                    text: "Data user berhasil dihapus",
                                    type: "success",
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    // Reload the Page
                                    location.reload();
                                });
                            }
                        }
                    });

                }
            });
        }

        function editUser(id) {
            addClassInput();
            var id = id;

            $.ajax({
                url: 'user/edit/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response['data']);
                    $('#modal-edit-user').modal('show');
                    $('#id').val(response['data'].id);
                    $('#e_nama').val(response['data'].nama);
                    $('#e_pekerjaan').val(response['data'].pekerjaan);
                    $('#e_alamat').val(response['data'].alamat);
                    $('#e_email').val(response['data'].email);
                    $('#e_password').val(response['data'].password);
                }
            });
        }

        function updateUser() {
            var url = "{{ route('user.update') }}";
            var id = $('#id').val();
            var e_nama = $('#e_nama').val();
            var e_pekerjaan = $('#e_pekerjaan').val();
            var e_alamat = $('#e_alamat').val();
            var e_email = $('#e_email').val();
            var e_password = $('#e_password').val();

            addClassInput();

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: id,
                    e_nama: e_nama,
                    e_pekerjaan: e_pekerjaan,
                    e_alamat: e_alamat,
                    e_email: e_email,
                    e_password: e_password,
                },
                success: (data) => {
                    if (data.success) {
                        Swal.fire({
                            title: "Sukses",
                            text: "Data user berhasil disimpan",
                            type: "Success"
                        }).then((result) => {
                            // Reload the page
                            location.reload();
                        });
                    }
                },
                error: function(data) {
                    var errors = data.responseJSON;

                    //Jika inputanya tidak error
                    if ($.isEmptyObject(errors) == false) {

                        // Looping 1 per 1 inputan dan akan menghapus pesan error sebelumnya
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
