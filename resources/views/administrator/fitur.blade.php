@extends('layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Administrator</a></li>
    <li class="breadcrumb-item active" aria-current="page">Kelola Fitur</li>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header bg-light">
                <div class="header-content">
                    <h4 class="card-title mb-1">Kelola Fitur Customer</h4>
                    <p class="mb-0 text-muted">Atur fitur yang akan aktif di halaman undangan publik untuk:</p>
                    <h5 class="mt-1 text-primary">{{ $user->name }}</h5>
                </div>
            </div>
            <div class="card-body">

                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Form Pengaturan Fitur --}}
                {{-- PENTING: Pastikan nama route Anda 'admin.fitur.update' sesuai di file routes/web.php --}}
                <form action="{{ route('administrator.fitur.update', $user->id) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        @foreach ($fiturList as $fitur)
                            @php
                                // Logika untuk menentukan status checkbox (default 'true' jika belum diatur)
                                $isActive = !$currentFitur->has($fitur) ? true : $currentFitur[$fitur];
                                // Mengubah nama internal (e.g., 'cerita_cinta') menjadi nama yang mudah dibaca ('Cerita Cinta')
                                $featureName = ucwords(str_replace('_', ' ', $fitur));
                            @endphp

                            <div class="col-md-4 col-6 col-sm-6">
                                <div class="feature-card p-3 border rounded">
                                    <div class="form-check form-switch fs-5">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="fitur-{{ $fitur }}" name="{{ $fitur }}" value="1"
                                            {{ $isActive ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="fitur-{{ $fitur }}">
                                            {{ $featureName }}
                                        </label>
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        Aktifkan fitur {{ $featureName }}.
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                        <a href="{{ route('order.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection

@push('styles')
    {{-- CSS khusus untuk halaman ini. Menggunakan @push lebih baik daripada tag <style> langsung --}}
    <style>
        .feature-card {
            transition: all 0.3s ease;
            height: 100%;
            background-color: #fff;
        }

        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            border-color: #0d6efd !important;
        }

        .card-header.bg-light {
            background-color: #f8f9fa !important;
            border-bottom: 1px solid #dee2e6;
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }
    </style>
@endpush
