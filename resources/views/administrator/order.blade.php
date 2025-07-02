@extends('layouts/master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="index.html">Administrator</a></li>
    <li class="breadcrumb-item active" aria-current="page">Order</li>
@endsection

@section('style')
    <style>
    </style>
@endsection

@section('content')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Order</h4>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="order-tab" data-bs-toggle="tab" href="#order" role="tab"
                                    aria-controls="order" aria-selected="true">Order</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="daftarorder-tab" data-bs-toggle="tab" href="#daftarorder"
                                    role="tab" aria-controls="daftarorder" aria-selected="false">Daftar Customer</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent" style="margin-top: 30px;">
                            <div class="tab-pane fade show active" id="order" role="tabpanel"
                                aria-labelledby="order-tab">
                                {{-- Form order tidak ada perubahan --}}
                                <form id="order-submit">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="basicInput">Nama</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Nama Customer" name="name">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Email" name="email">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    placeholder="Password" name="password">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput">Confirm Password</label>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    placeholder="Confirm Password" name="password_confirmation">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Paket</label>
                                                <select class="form-control select2" style="width: 100%;" id="paket"
                                                    name="paket">
                                                    <option disabled selected>Pilih Paket</option>
                                                    @foreach ($paket as $p)
                                                        <option data-harga="{{ $p->harga }}"
                                                            value="{{ $p->paket }}">
                                                            {{ $p->paket }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" class="form-control" id="harga" name="harga"
                                                    readonly="readonly">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Domain</label>
                                                <input type="text" class="form-control" id="domain" name="domain"
                                                    placeholder="Domain">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Expired</label>
                                                <input type="date" class="form-control" id="expired" name="expired">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary"
                                                        id="btn-save">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="daftarorder" role="tabpanel"
                                aria-labelledby="daftarorder-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{-- Form pencarian tidak ada perubahan --}}
                                        <form class="row mt-2" id="cari">
                                            <div class="col-lg-11 d-flex justify-content-end">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Tanggal Dari</label>
                                                            <input type="date" name="tanggaldariSearch"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Tanggal Sampai</label>
                                                            <input type="date" name="tanggalsampaiSearch"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" name="namaSearch" class="form-control"
                                                                placeholder="Nama Tamu">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" name="emailSearch" class="form-control"
                                                                placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <button type="button" class='btn btn-md btn-primary search-btn'
                                                    style="border-radius:8px; margin-top:22px" onclick="cari()"><i
                                                        class='fa fa-search'></i></button>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-striped display" id="order-table"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Domain</th>
                                                        <th>Expired</th>
                                                        <!-- ================= KOLOM BARU ================== -->
                                                        <th>Aksi</th>
                                                        <!-- ============================================= -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- Biarkan kosong, akan diisi oleh DataTables --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Bagian ini tidak ada perubahan
            $('.select2').select2()
            $('#order-submit').on('submit', function(e) {
                /* ... kode ... */
            })
            $('#paket').on('change', function() {
                /* ... kode ... */
            })
            $('#password').on('click', function() {
                /* ... kode ... */
            })

            function generateRandomPassword(length) {
                /* ... kode ... */
            }
            // ------------------------------------------------------------------

            showOrder()
        })

        const showOrder = () => {
            // === AWAL PERUBAHAN PADA KONFIGURASI DATATABLES ===
            const columns = [{
                    data: "tanggal_order"
                },
                {
                    data: "user.name" // Pastikan response AJAX Anda memiliki relasi user
                },
                {
                    data: "user.email" // Pastikan response AJAX Anda memiliki relasi user
                },
                {
                    data: "domain",
                },
                {
                    data: "expired"
                },
                {
                    // Kolom baru untuk tombol Aksi
                    data: null, // Tidak terikat pada satu kolom data
                    orderable: false, // Tidak bisa di-sort
                    searchable: false, // Tidak bisa di-search
                    render: function(data, type, row) {
                        // 'row' berisi seluruh data untuk baris saat ini
                        // row.user.id adalah ID customer yang kita butuhkan

                        // Membuat URL dengan route Blade dan mengganti placeholder
                        let url = '{{ route('administrator.fitur.edit', ['user' => ':id']) }}';
                        url = url.replace(':id', row.user.id);

                        // Mengembalikan HTML untuk tombol
                        return `<a href="${url}" class="btn btn-sm btn-info">Kelola Fitur</a>`;
                    }
                }
            ];
            // === AKHIR PERUBAHAN PADA KONFIGURASI DATATABLES ===

            var table = $('#order-table').DataTable({
                destroy: true,
                lengthChange: false,
                searching: false,
                pageLength: 10,
                ajax: {
                    url: "{{ route('order.get') }}",
                    // data: filterData
                },
                columns: columns // Menggunakan konfigurasi kolom yang sudah kita ubah
            });
        }
        OrderSelected = ''
        $("#order-table tbody").on("click", "tr", function() {
            OrderSelected = $("#order-table").DataTable().row(this).data();
            $("#order-table tbody")
                .find("tr")
                .each(function(i) {
                    $(this)
                        .find("td")
                        .each(function(i) {
                            $(this).removeClass("selected");
                        });
                });
            $(this)
                .find("td")
                .each(function(i) {
                    $(this).toggleClass("selected");
                });
        });
    </script>
@endsection
