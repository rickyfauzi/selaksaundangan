@extends('layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="#">Welcome !</a></li>
@endsection

@push('styles')
    {{-- CSS khusus untuk halaman ini, dipindahkan ke @push untuk best practice --}}
    <style>
        .info-card .list-group-item,
        .settings-card .list-group-item {
            border-left: 0;
            border-right: 0;
        }

        .info-card .list-group-item:first-child,
        .settings-card .list-group-item:first-child {
            border-top: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .feature-card {
            box-shadow: 0px 0px 3px 1px rgba(129, 129, 129, 0.15);
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            color: #165D99;
            margin-bottom: 10px;
        }

        .feature-card a {
            text-decoration: none;
            color: inherit;
        }
    </style>
@endpush

@section('content')
    <section class="content">
        <div class="row">
            {{-- KOLOM KIRI: INFORMASI UTAMA & PENGATURAN --}}
            <div class="col-lg-5 mb-4">
                {{-- KARTU INFORMASI UTAMA --}}
                <div class="card info-card">
                    <div class="card-body">
                        <h4 class="card-title fw-bold">{{ optional($mempelai)->namalaki ?? 'Nama Pria' }} &
                            {{ optional($mempelai)->namaperempuan ?? 'Nama Wanita' }}</h4>
                        <p class="text-muted">Paket Anda: <span
                                class="badge bg-primary">{{ optional($order)->paket ?? 'N/A' }}</span></p>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Link Undangan Anda:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="link-undangan-input"
                                    value="{{ optional($order)->domain ? url('/wedding/' . optional($order)->domain) : 'Domain belum diatur' }}"
                                    readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copyPesan()"><i
                                        class="fa-solid fa-copy"></i></button>
                                <a href="{{ optional($order)->domain ? url('/wedding/' . optional($order)->domain) : '#' }}"
                                    target="_blank" class="btn btn-outline-secondary"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i></a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary w-100" id="btn-edit-domain">
                            <i class="fa-solid fa-pen-to-square me-2"></i> Ubah Domain
                        </button>
                    </div>
                </div>

                {{-- KARTU PENGATURAN CEPAT --}}
                <div class="card settings-card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0"><i class="bi bi-sliders me-2"></i>Pengaturan Cepat</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fa-regular fa-eye me-2"></i> Publikasi Undangan</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="publikasi-checkbox"
                                    @if (optional($order)->status == 1) checked @endif>
                            </div>
                        </li>
                        {{-- Tampilkan Opsi Protokol HANYA JIKA Fiturnya Aktif --}}
                        @if (in_array('protokol', $fiturAktif))
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-shield-fill-check me-2"></i> Tampilkan Protokol</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="protocol-checkbox"
                                        @if (optional($data)->is_protokol == 1) checked @endif>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- KOLOM KANAN: MENU FITUR --}}
            <div class="col-lg-7">
                <div class="row row-cols-2 row-cols-md-3 g-3">
                    {{-- 1. FITUR: Tema --}}
                    @if (in_array('tema', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('informasiacara.tema') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-palette fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Tema</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 2. FITUR: Musik --}}
                    @if (in_array('musik', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('informasiacara.musik') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-music fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Musik</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 3. FITUR: Mempelai --}}
                    @if (in_array('mempelai', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('mempelai.index') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-user-group fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Mempelai</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 4. FITUR: Informasi Acara --}}
                    @if (in_array('informasi_acara', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('informasiacara.informasiacara') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-calendar-check fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Informasi Acara</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 5. FITUR: Galeri --}}
                    @if (in_array('galeri', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('galeri.index') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-images fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Galeri</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 6. FITUR: Cerita Cinta --}}
                    @if (in_array('cerita_cinta', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('ceritacinta.index') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-heart fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Cerita Cinta</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 7. FITUR: Video Prewedding --}}
                    @if (in_array('video_prewedd', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('vidio.index') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-video fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Video Prewedding</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 8. FITUR: Quotes --}}
                    @if (in_array('quotes', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('quotes.index') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-quote-left fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Quotes</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 9. FITUR: Buku Tamu --}}
                    @if (in_array('buku_tamu', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="{{ route('bukutamu.index') }}">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-book-open fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Buku Tamu</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 10. FITUR: Amplop Digital --}}
                    @if (in_array('amplop_digital', $fiturAktif))
                        <div class="col">
                            <div class="card feature-card">
                                <a href="#" id="amplopdigital">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                        <i class="fa-solid fa-gift fa-2x feature-icon"></i>
                                        <p class="m-0 fw-bold">Amplop Digital</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL UNTUK EDIT DOMAIN --}}
    <form id='form-domain-edit'>
        @csrf
        <div class="modal fade" id="modal-domain" tabindex="-1" role="dialog" aria-labelledby="modalDomainLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDomainLabel">Edit Domain</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Domain</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ url('/wedding/') }}/</span>
                                <input type="text" name="domain" class="form-control" placeholder="andi-dan-bunga"
                                    value="{{ optional($order)->domain ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal"><span>Tutup</span></button>
                        <button type="submit" class="btn btn-primary"><span>Simpan</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- MODAL UNTUK AMPLOP DIGITAL --}}
    <form id='amplopdigital-store'>
        @csrf
        <div class="modal fade" id="modal-amplop" tabindex="-1" role="dialog" aria-labelledby="modalAmplopLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalAmplopLabel">Amplop Digital</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaakun" class="form-label fw-bold">Nama Pemilik <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="namaakun" class="form-control" name="namaakun"
                                value="{{ optional($pvcustomer)->namaakun ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="noakun" class="form-label fw-bold">Nomor Rekening / No. HP <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="noakun" class="form-control" name="noakun"
                                value="{{ optional($pvcustomer)->noakun ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="paymentvendor" class="form-label fw-bold">Bank <span
                                    class="text-danger">*</span></label>
                            <select name="paymentvendor" class="select2-modal" id="paymentvendor" style="width: 100%">
                                <option selected disabled>--Pilih--</option>
                                @foreach ($paymentvendor as $pv)
                                    <option value="{{ $pv->paymentvendor }}"
                                        @if (optional($pvcustomer)->paymentvendor == $pv->paymentvendor) selected @endif>
                                        {{ $pv->paymentvendor }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal"><span>Tutup</span></button>
                        <button type="submit" class="btn btn-primary"><span>Simpan</span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const domainModal = new bootstrap.Modal(document.getElementById('modal-domain'));
            const amplopModal = new bootstrap.Modal(document.getElementById('modal-amplop'));

            $('.select2-modal').select2({
                dropdownParent: $("#modal-amplop")
            });

            $('#amplopdigital').on('click', function(e) {
                e.preventDefault();
                amplopModal.show();
            });
            $('#btn-edit-domain').on('click', function() {
                domainModal.show();
            });

            function sendAjaxRequest(url, data, successMessages) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    processData: (data instanceof FormData),
                    contentType: (data instanceof FormData) ? false :
                        'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(response) {
                        let message = successMessages.default || 'Aksi berhasil.';
                        if (response.code === 1) message = successMessages.code1 || message;
                        else if (response.code === 2) message = successMessages.code2 || message;

                        let options = {
                            title: 'Berhasil!',
                            icon: 'success',
                            text: message
                        };
                        if (successMessages.reload) options.didClose = () => location.reload();
                        Swal.fire(options);
                    },
                    error: (res) => {
                        console.error("AJAX Error:", res.responseText);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                            icon: 'error'
                        });
                    }
                });
            }

            $('#protocol-checkbox').on('change', function() {
                sendAjaxRequest(`{{ route('protokol.store') }}`, {
                    protocol: this.checked ? 1 : 0
                }, {
                    code1: 'Protokol diaktifkan.',
                    code2: 'Protokol dimatikan.'
                });
            });

            $('#publikasi-checkbox').on('change', function() {
                sendAjaxRequest(`{{ route('publikasi.store') }}`, {
                    publikasi: this.checked ? 1 : 0
                }, {
                    code1: 'Undangan berhasil dipublikasikan.',
                    code2: 'Publikasi undangan dibatalkan.'
                });
            });

            $('#form-domain-edit').on('submit', function(e) {
                e.preventDefault();
                sendAjaxRequest(`{{ route('domain.update') }}`, new FormData(this), {
                    code1: 'Domain telah diperbarui.',
                    reload: true
                });
            });

            $('#amplopdigital-store').on('submit', function(e) {
                e.preventDefault();
                sendAjaxRequest(`{{ route('amplopdigital.store') }}`, new FormData(this), {
                    code1: 'Amplop Digital telah disimpan.',
                    reload: true
                });
            });
        });

        function copyPesan() {
            const textToCopy = $('#link-undangan-input').val();
            const validUrlPattern = /^https?:\/\//i;

            if (textToCopy && validUrlPattern.test(textToCopy)) {
                navigator.clipboard.writeText(textToCopy).then(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersalin!',
                        text: 'Link undangan berhasil disalin.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }, function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Tidak dapat menyalin link.'
                    });
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Link undangan tidak valid atau belum diatur.'
                });
            }
        }
    </script>
@endsection
