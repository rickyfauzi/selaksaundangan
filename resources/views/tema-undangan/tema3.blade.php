<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- =================================================================== --}}
    {{-- PERBAIKAN DIMULAI DI SINI: META TAG UNTUK PREVIEW MEDIA SOSIAL --}}
    {{-- =================================================================== --}}

    {{-- Judul Utama Halaman --}}
    <title>The Wedding of {{ $mempelai->namalaki ?? 'Pria' }} & {{ $mempelai->namaperempuan ?? 'Wanita' }}</title>

    {{-- Meta Tags Standar & SEO --}}
    <meta name="description"
        content="{{ $afterConvertDay ?? 'Hari Acara' }}, {{ $tanggalAcara ?? 'Tanggal Acara' }}. Kami mengundang Anda untuk merayakan hari bahagia kami.">
    <meta name="author" content="Selaksa Digital">

    {{-- Open Graph Meta Tags (Untuk WhatsApp, Facebook, dll) --}}
    <meta property="og:title"
        content="The Wedding of {{ $mempelai->namalaki ?? 'Pria' }} & {{ $mempelai->namaperempuan ?? 'Wanita' }}" />
    <meta property="og:description"
        content="{{ $afterConvertDay ?? 'Hari Acara' }}, {{ $tanggalAcara ?? 'Tanggal Acara' }}" />
    <meta property="og:image"
        content="{{ $informasiacara && $informasiacara->pembuka ? asset('images/pembuka/' . $informasiacara->pembuka) : asset('images/default/default_couple.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="Undangan Pernikahan Digital" />
    <meta property="og:type" content="website" />

    {{-- Twitter Card Meta Tags (Untuk Twitter) --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="The Wedding of {{ $mempelai->namalaki ?? 'Pria' }} & {{ $mempelai->namaperempuan ?? 'Wanita' }}">
    <meta name="twitter:description"
        content="{{ $afterConvertDay ?? 'Hari Acara' }}, {{ $tanggalAcara ?? 'Tanggal Acara' }}">
    <meta name="twitter:image"
        content="{{ $informasiacara && $informasiacara->pembuka ? asset('images/pembuka/' . $informasiacara->pembuka) : asset('images/default/default_couple.jpg') }}">

    {{-- Favicon (Logo Website di Tab Browser) - Ganti dengan path logo Anda --}}
    <link rel="icon" href="{{ asset('assets/images/logo/logo.png') }}" type="image/png">
    {{-- Untuk kompatibilitas lebih baik di perangkat Apple --}}
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo/logo.png') }}">

    {{-- =================================================================== --}}
    {{-- AKHIR DARI PERBAIKAN --}}
    {{-- =================================================================== --}}


    {{-- (Sisa dari link CSS Anda biarkan seperti semula) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Playfair+Display:wght@400;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Photograph&display=swap" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="/assets/vendors/jquery-toast-plugin-master/src/jquery.toast.css" />
    <style>
        html {
            font-size: 90%;
            /* Global font size adjustment */
        }

        :root {
            --primary-color: #2e4053;
            --accent-color-1: #aab7b8;
            --app-bg-light: #d5d8dc;
            --app-bg-soft: #ffffff;
            --text-on-dark: #ffffff;
            --text-on-light: #495057;
            --text-on-primary: #ffffff;
            --warning-color: #ffc107;
            --font-primary: "Poppins", sans-serif;
            --font-decorative: "Great Vibes", cursive;
            --font-script: "Dancing Script", cursive;
            --font-heading: "Photograph", cursive;
            --font-serif-display: "Playfair Display", serif;
            --cover-gradient-start: #f8f0f2;
            --cover-gradient-end: #e9dce0;
            --cover-text-color: #5d534a;
            --cover-names-color: #2e4053;
            --cover-button-bg: #2e4053;
            --cover-button-text: #ffffff;
            --cover-button-hover-bg: #1a2633;
        }

        /* --- FONT FACES (from template - adjust paths if hosting locally) --- */
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap');

        @font-face {
            font-family: 'OCRAStd';
            /*
      src: url('{{ asset('fonts/OCRAStd.eot') }}');
      src: url('{{ asset('fonts/OCRAStd.eot?#iefix') }}') format('embedded-opentype'),
           url('{{ asset('fonts/OCRAStd.woff2') }}') format('woff2'),
           url('{{ asset('fonts/OCRAStd.woff') }}') format('woff'),
           url('{{ asset('fonts/OCRAStd.ttf') }}') format('truetype'),
           url('{{ asset('fonts/OCRAStd.svg#OCRAStd') }}') format('svg');
      */
            src: local('Courier New'), local('Courier'), monospace;
            /* Fallback */
            font-weight: normal;
            font-style: normal;
        }


        body {
            margin: 0;
            font-family: var(--font-primary);
            background-color: var(--app-bg-light);
            color: var(--text-on-light);
            line-height: 1.6;
            overflow-x: hidden;
            padding-bottom: 70px;
            scroll-behavior: smooth;
            overflow-y: hidden;
        }

        .container,
        .container-fluid {
            max-width: 768px;
            margin-left: auto;
            margin-right: auto;
        }

        /* --- STYLING COVER --- */
        #cover-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            /* Konten di bagian bawah */
            align-items: center;
            z-index: 2000;
            transition: top 1s ease-in-out, opacity 1s ease-in-out;
            overflow: hidden;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
            opacity: 1;
        }

        /* Background Image */
        .cover-background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ $informasiacara && $informasiacara->sampul ? asset('images/sampul/' . $informasiacara->sampul) : asset('images/default/default_couple_illustration_transparent.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -2;
        }

        /* Overlay Gradient dari bawah ke tengah */
        .bottom-gradient-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 70%;
            /* Menutupi 70% dari bawah */
            background: linear-gradient(to top,
                    var(--primary-color) 0%,
                    rgba(46, 64, 83, 0.8) 30%,
                    rgba(46, 64, 83, 0.4) 60%,
                    transparent 100%);
            z-index: -1;
        }

        #cover-container.hidden {
            top: -100vh;
            opacity: 0;
            pointer-events: none;
        }

        .cover-content-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 450px;
            margin-bottom: 30px;
            /* Jarak dari bawah */
            position: relative;
            z-index: 2;
        }

        .cover-image-and-frame-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .cover-couple-illustration {
            display: block;
            max-width: 60%;
            max-height: 35vh;
            height: auto;
            object-fit: contain;
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }

        .rotating-frame-overlay-cover {
            position: absolute;
            top: 50%;
            left: 50%;
            width: clamp(240px, 80vw, 350px);
            height: clamp(240px, 80vw, 350px);
            transform: translate(-50%, -50%);
            object-fit: contain;
            animation: spin-frame 35s linear infinite;
            z-index: 1;
            pointer-events: none;
            opacity: 0.8;
        }

        @keyframes spin-frame {
            from {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .cover-text-content {
            width: 100%;
            color: var(--text-on-dark);
            /* Warna teks terang untuk kontras */
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .cover-intro-text {
            font-family: var(--font-primary);
            font-size: 0.9em;
            letter-spacing: 2px;
            margin-bottom: 5px;
            text-transform: uppercase;
            color: var(--text-on-dark);
            font-weight: 500;
        }

        .cover-couple-names {
            font-family: var(--font-decorative);
            font-size: 2.8rem;
            font-weight: normal;
            line-height: 1.2;
            margin-top: 0;
            margin-bottom: 15px;
            color: var(--text-on-dark);
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
        }

        .cover-couple-names span {
            font-size: 0.9em;
            color: var(--accent-color-1);
        }

        .cover-guest-name {
            font-family: var(--font-primary);
            font-size: 0.95em;
            line-height: 1.6;
            color: var(--text-on-dark);
            margin-bottom: 25px;
            word-break: break-word;
        }

        .cover-guest-name strong {
            font-weight: 600;
            display: block;
            margin-top: 4px;
            color: var(--text-on-dark);
        }

        #open-invitation.open-invitation-button {
            background-color: var(--accent-color-1);
            color: var(--primary-color);
            font-family: var(--font-primary);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-size: 1em;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        #open-invitation.open-invitation-button i {
            margin-right: 8px;
        }

        #open-invitation.open-invitation-button:hover {
            background-color: var(--text-on-dark);
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .cover-content-wrapper {
                max-width: 90%;
                margin-bottom: 20px;
            }

            .cover-couple-names {
                font-size: 2.2rem;
            }

            .cover-couple-illustration {
                max-width: 70%;
                max-height: 30vh;
            }

            .rotating-frame-overlay-cover {
                width: clamp(200px, 85vw, 300px);
                height: clamp(200px, 85vw, 300px);
            }

            .bottom-gradient-overlay {
                height: 80%;
                /* Lebih banyak overlay di mobile */
            }
        }

        /* --- MAIN CONTENT STYLING --- */
        .section {
            position: relative;
            overflow: hidden;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .section>.container,
        .section>.container-fluid {
            position: relative;
            z-index: 2;
        }

        .section-bg-light {
            background-color: var(--app-bg-light);
            color: var(--text-on-light);
        }

        .section-bg-dark {
            background-color: var(--primary-color);
            color: var(--text-on-dark);
        }

        .section-title-custom {
            font-family: var(--font-heading);
            font-size: 2.8rem;
            color: var(--primary-color);
            margin-bottom: 2.5rem;
            position: relative;
            padding-bottom: 10px;
            text-align: center;
        }

        .section-title-custom::after {
            content: '';
            display: block;
            width: 70px;
            height: 3px;
            background-color: var(--accent-color-1);
            margin: 10px auto 0;
        }

        .section-bg-dark .section-title-custom {
            color: var(--text-on-dark);
        }

        .section-bg-dark .section-title-custom::after {
            background-color: var(--primary-color);
        }

        .message-box {
            background-color: var(--app-bg-soft);
            padding: 25px;
            border-radius: 12px;
            border-left: 5px solid var(--primary-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin: 1.5rem auto;
            text-align: center;
            color: var(--primary-color);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* --- HEADER SECTION (Home) --- */
        .header-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--accent-color-1);
            position: relative;
            z-index: 1;
            background-color: var(--app-bg-light);
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .header-section .container {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        @keyframes float-subtle {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-6px)
            }
        }

        @keyframes float-subtle-rotated {

            0%,
            100% {
                transform: rotate(180deg) translateY(0)
            }

            50% {
                transform: rotate(180deg) translateY(-6px)
            }
        }

        .header-ornament {
            position: absolute;
            background-repeat: no-repeat;
            background-size: contain;
            opacity: 0.5;
            pointer-events: none;
            z-index: 0;
        }

        .cover-ornament {
            opacity: 0.2 !important;
        }

        .ornament-top-left {
            top: 5px;
            left: 0;
            width: 250px;
            height: 250px;
            background-image: url("{{ asset('tema3/img/left.png') }}");
            animation: float-subtle 6s ease-in-out infinite;
        }

        .ornament-bottom-right {
            bottom: 0px;
            right: 0px;
            width: 250px;
            height: 250px;
            background-image: url("{{ asset('tema3/img/left.png') }}");
            /* transform: rotate(180deg); */
            animation: float-subtle-rotated 6s ease-in-out infinite .5s;
        }

        .wedding-title {
            font-family: var(--font-primary);
            font-weight: 500;
            letter-spacing: 1.5px;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 0.9em;
            text-transform: uppercase;
        }

        .couple-frame-container {
            position: relative;
            width: 220px;
            height: 220px;
            margin: 15px auto 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .rotating-frame-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            animation: spin-frame-header 30s linear infinite;
            z-index: 1;
        }

        @keyframes spin-frame-header {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .couple-circle {
            width: 160px;
            height: 160px;
            border: 5px solid var(--primary-color);
            border-radius: 50%;
            background: var(--app-bg-light);
            position: relative;
            overflow: hidden;
            z-index: 2;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .couple-illustration {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
        }

        .couple-illustration img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-section .couple-names-display {
            font-family: var(--font-heading);
            font-size: 3rem;
            color: var(--primary-color);
            margin-top: 10px;
            margin-bottom: 10px;
            text-shadow: none;
        }

        .hope-text {
            font-family: var(--font-primary);
            color: var(--primary-color);
            font-size: .95rem;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .countdown-container {
            margin: 25px 0;
        }

        .countdown-flex {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .countdown-box {
            background: var(--primary-color);
            color: var(--text-on-dark);
            border-radius: 12px;
            padding: 12px 10px;
            min-width: 60px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: transform .3s ease;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .countdown-box:hover {
            transform: translateY(-3px);
        }

        .countdown-number {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .countdown-label {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .wedding-date {
            font-family: var(--font-primary);
            color: var(--primary-color);
            font-size: 1em;
            margin-top: 15px;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .save-date-btn {
            background: var(--primary-color);
            color: var(--text-on-dark);
            border: none;
            border-radius: 25px;
            padding: 10px 28px;
            font-family: var(--font-primary);
            font-weight: 500;
            letter-spacing: 1px;
            transition: all .3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            font-size: .9em;
        }

        .save-date-btn:hover {
            background: var(--accent-color-1);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* --- INVITATION MESSAGE & COUPLE DETAILS --- */
        .invitation-message .subtitle {
            font-family: var(--font-script);
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .couple-details .person-detail .bride-illustration {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px;
            border: 4px solid var(--primary-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .couple-details .person-detail .bride-illustration img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .couple-details .person-name {
            font-family: var(--font-decorative);
            font-size: 2.2rem;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .couple-details .parents {
            font-size: .9rem;
            color: var(--text-on-light);
            margin-bottom: 12px;
        }

        .couple-details .ampersand {
            font-family: var(--font-decorative);
            font-size: 3.5rem;
            color: var(--primary-color);
            margin: 1rem 0;
            line-height: 1;
        }

        .btn-instagram {
            font-family: var(--font-primary);
            background-color: var(--primary-color);
            border-color: var(--accent-color-1);
            color: white;
            border-radius: 20px;
            padding: 6px 15px;
            font-size: .85rem;
            text-decoration: none;
        }

        .btn-instagram:hover {
            background-color: var(--accent-color-1);
            color: var(--text-on-dark);
        }

        /* --- SEMI-TRANSPARENT CARDS & BACKGROUND ELEMENTS --- */
        .semi-transparent-card {
            position: relative;
            z-index: 2;
        }

        .quran-verse .verse-box.semi-transparent-card {
            background-color: var(--primary-color);
        }

        .quran-verse .verse-box {
            color: var(--text-on-dark);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin: 20px auto;
            max-width: 90%;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .quran-verse .verse-text {
            font-family: var(--font-serif-display);
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .quran-verse .verse-ref {
            font-size: .9rem;
            font-weight: 500;
        }

        .section-bg-dark .event-box.semi-transparent-card {
            background-color: rgba(255, 255, 255, 0.15);
            color: var(--text-on-dark);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section-bg-dark .event-box.semi-transparent-card .event-date,
        .section-bg-dark .event-box.semi-transparent-card .event-time,
        .section-bg-dark .event-box.semi-transparent-card .event-location {
            color: var(--text-on-dark);
        }

        .event-details .event-box {
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            margin-top: 1.5rem;
            text-align: center;
        }

        .event-details .event-date,
        .event-details .event-time,
        .event-details .event-location {
            font-size: 1rem;
            margin-bottom: 10px;
            font-family: var(--font-primary);
        }

        .event-details .event-date {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .event-details .event-location {
            font-style: italic;
        }

        .closing-message .message-box.semi-transparent-card,
        #digital-gift-dropdown-section .message-box.semi-transparent-card {
            background-color: rgba(253, 250, 247, 0.85);
        }

        .background-element-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .background-element-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            opacity: .15;
        }

        .element-quran-verse-bg img {
            width: clamp(200px, 40%, 300px);
        }

        .element-akad-bg img {
            width: clamp(150px, 25%, 200px);
            transform: translate(-30%, -25%) rotate(-20deg);
        }

        .element-resepsi-bg img {
            width: clamp(150px, 25%, 200px);
            transform: translate(30%, 25%) rotate(20deg);
        }

        .element-closing-bg img {
            width: clamp(250px, 50%, 350px);
            opacity: .1;
            align-self: flex-end;
            margin-bottom: 1rem;
        }

        /* --- OTHER SECTIONS --- */
        .love-story-section .story-card,
        .love-story-section .story-icon {
            display: none;
        }

        .love-story-section {
            background-color: var(--app-bg-soft);
        }

        .love-story-section .story-item {
            margin-bottom: 3.5rem;
            align-items: center;
        }

        .love-story-section .story-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .love-story-section .story-item .text-content {
            padding: 0 1rem;
        }

        .love-story-section .story-title {
            font-family: var(--font-serif-display);
            font-size: 1rem;
            color: var(--accent-color-1);
            margin-bottom: 0.5rem;
        }

        .love-story-section .story-date {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 1rem;
            font-style: italic;
        }

        .love-story-section .story-description {
            font-size: 0.95rem;
            line-height: 1.7;
            color: var(--text-on-light);
        }

        @media (max-width: 767px) {
            .love-story-section .story-item {
                text-align: center;
            }

            .love-story-section .story-item .text-content {
                margin-top: 1.5rem;
            }
        }

        .btn-custom-primary {
            background-color: var(--primary-color);
            color: var(--text-on-primary);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-family: var(--font-primary);
            font-weight: 500;
            transition: all .3s ease;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            display: inline-block;
        }

        .btn-custom-primary:hover {
            background-color: var(--accent-color-1);
            color: var(--text-on-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .section-bg-dark .btn-custom-primary {
            background-color: var(--primary-color);
            color: var(--text-on-primary);
        }

        .section-bg-dark .btn-custom-primary:hover {
            background-color: #8a9798;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform .3s ease, box-shadow .3s ease;
            aspect-ratio: 1 / 1;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        #galleryModal .modal-content {
            background-color: transparent;
            border: none;
        }

        #galleryModal .modal-body {
            padding: 0;
        }

        #galleryModal .btn-close {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            opacity: .9;
            padding: .5em;
        }

        #galleryModal .btn-close:hover {
            opacity: 1;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .video-container {
            max-width: 100%;
            margin: 0 auto;
        }

        .video-container video {
            width: 100%;
            max-height: 70vh;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            background-color: #000;
        }

        .ig-filter-section .filter-box strong {
            color: var(--accent-color-1);
            font-family: var(--font-serif-display);
            font-size: 1.1rem;
            display: block;
            margin: 5px 0;
        }

        /* --- GIFT CARD STYLES --- */
        #digital-gift-dropdown-section .message-box p {
            margin-bottom: 1rem;
        }

        #digital-gift-dropdown-section .btn-custom-primary .toggle-icon {
            transition: transform .3s ease;
            display: inline-block;
        }

        #digital-gift-dropdown-section .btn-custom-primary[aria-expanded=true] .toggle-icon {
            transform: rotate(180deg);
        }

        .gift-card-wrapper {
            background-color: var(--app-bg-soft);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            margin-top: -1px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .gift-card-item {
            margin: 10px auto;
            border: 1px solid #ddd;
            padding: 15px 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            font-family: 'Open Sans', sans-serif;
            color: #666;
            transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
        }

        .gift-card-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .gift-card-item .gift-card-bank-info {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 35px;
        }

        .gift-card-item .gift-card-bank-info .bank-vendor-name {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.1rem;
            line-height: 1.5;
            font-weight: 600;
            margin: 0;
            color: #555;
        }

        .gift-card-item .bank-logo-placeholder {
            font-size: 1.8rem;
            color: #ccc;
        }

        .gift-card-item.bca .bank-logo-placeholder {
            color: #0060ac;
        }

        .gift-card-item.mandiri .bank-logo-placeholder {
            color: #00366d;
        }

        .gift-card-item.bri .bank-logo-placeholder {
            color: #00529c;
        }

        .gift-card-item.bni .bank-logo-placeholder {
            color: #ff6600;
        }

        .gift-card-item .bank-logo {
            max-height: 30px;
            width: auto;
        }

        .gift-card-item .gift-card-account-number {
            margin-bottom: 20px;
            text-align: left;
        }

        .gift-card-item .gift-card-account-number span {
            font-size: 1.2rem;
            line-height: 1.5;
            letter-spacing: 3px;
            font-family: 'OCRAStd', 'Courier New', Courier, monospace;
            color: #333;
            display: block;
        }

        .gift-card-item .gift-card-holder-details {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gift-card-item .gift-card-holder-details .account-holder-name h5 {
            font-family: 'Open Sans', sans-serif;
            font-size: .7rem;
            line-height: 1.2;
            text-transform: uppercase;
            font-weight: 400;
            color: #aaa;
            margin-bottom: 3px;
        }

        .gift-card-item .gift-card-holder-details .account-holder-name span {
            font-family: 'Open Sans', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            color: #555;
            display: block;
        }

        .gift-card-item .gift-card-holder-details .btn-copy-account {
            background-color: var(--primary-color);
            color: var(--text-on-primary);
            border: none;
            border-radius: 15px;
            padding: 4px 10px;
            font-size: .7rem;
            font-weight: 600;
            line-height: 1.2;
            transition: background-color .2s ease;
            white-space: nowrap;
        }

        .gift-card-item .gift-card-holder-details .btn-copy-account:hover {
            background-color: var(--accent-color-1);
        }

        .gift-card-item .gift-card-holder-details .btn-copy-account i {
            margin-right: 3px;
        }

        .gift-card-item .gift-card-dummy-validity {
            margin-bottom: 15px;
        }

        .gift-card-item .gift-card-dummy-validity .item-valid-content {
            display: flex;
            align-items: baseline;
        }

        .gift-card-item .gift-card-dummy-validity .item-valid-content h5 {
            width: auto;
            font-size: .65rem;
            line-height: 1;
            text-align: left;
            text-transform: uppercase;
            font-weight: 400;
            color: #aaa;
            margin-right: 5px;
            margin-bottom: 0;
        }

        .gift-card-item .gift-card-dummy-validity .item-valid-content span {
            font-size: .8rem;
            line-height: 1;
            letter-spacing: 2px;
            font-family: 'OCRAStd', 'Courier New', Courier, monospace;
            color: #666;
        }

        .gift-card-item .gift-card-type-info {
            margin-top: 10px;
            margin-bottom: 0;
            padding-top: 10px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gift-card-item .gift-card-type-info h6 {
            font-family: 'OCRAStd', 'Courier New', Courier, monospace;
            font-size: .75rem;
            line-height: 1.5;
            text-transform: uppercase;
            font-weight: 400;
            margin: 0;
            letter-spacing: 1.5px;
            color: #888;
        }

        .gift-card-item .gift-card-type-info .generic-card-icon {
            font-size: 1.8rem;
            color: #bbb;
        }

        .gift-card-item .gift-card-qr {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ddd;
            text-align: center;
        }

        .gift-card-item .gift-card-qr p {
            font-size: .7rem;
            color: #888;
            margin-bottom: 5px;
            font-family: 'Open Sans', sans-serif;
        }

        .gift-card-item .gift-card-qr .qr-code-image {
            max-width: 80px;
            height: auto;
            border-radius: 4px;
            border: 1px solid #eee;
            padding: 3px;
            background: white;
        }

        @media (max-width:576px) {
            .gift-card-item {
                padding: 15px
            }

            .gift-card-item .gift-card-bank-info .bank-vendor-name {
                font-size: 1rem
            }

            .gift-card-item .gift-card-bank-info .bank-logo-placeholder {
                font-size: 1.5rem
            }

            .gift-card-item .gift-card-account-number span {
                font-size: 1rem;
                letter-spacing: 2px;
                word-spacing: 4px
            }

            .gift-card-item .gift-card-holder-details {
                align-items: flex-start
            }

            .gift-card-item .gift-card-holder-details .account-holder-name span {
                font-size: .85rem
            }

            .gift-card-item .gift-card-holder-details .btn-copy-account {
                padding: 3px 8px;
                font-size: .65rem
            }

            .gift-card-item .gift-card-dummy-validity .item-valid-content h5 {
                font-size: .6rem
            }

            .gift-card-item .gift-card-dummy-validity .item-valid-content span {
                font-size: .7rem;
                letter-spacing: 1.5px
            }

            .gift-card-item .gift-card-type-info h6 {
                font-size: .65rem
            }

            .gift-card-item .gift-card-type-info .generic-card-icon {
                font-size: 1.5rem
            }

            .gift-card-item .gift-card-qr .qr-code-image {
                max-width: 70px
            }
        }

        /* --- COMMENTS SECTION --- */
        .rsvp-summary {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0 30px;
            color: var(--text-on-dark);
        }

        .rsvp-summary>div {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 8px;
            min-width: 90px;
            text-align: center;
        }

        .rsvp-summary span:first-child {
            display: block;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .rsvp-summary span:last-child {
            font-size: .75rem;
            text-transform: uppercase;
        }

        .comment-form-box {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .comment-form-box .form-control,
        .comment-form-box .form-select {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--text-on-dark);
            font-size: .9rem;
        }

        .comment-form-box .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .comment-form-box .form-select option {
            color: var(--text-on-light);
            background-color: var(--app-bg-light);
        }

        .comment-form-box label {
            color: rgba(255, 255, 255, 0.8);
        }



        padding: 8px .btn-send-comment {
            background-color: var(--primary-color);
            color: var(--text-on-primary);
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 500;
            font-size: .9rem;
            transition: background-color .3s ease;
        }

        .btn-send-comment:hover {
            background-color: #A08F7B;
        }

        .comment-list-container {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 5px;
            color: var(--text-on-dark);
        }

        .comment-list-container::-webkit-scrollbar {
            width: 6px;
        }

        .comment-list-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .comment-list-container::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 3px;
        }

        .comment-item-layout {
            background-color: rgba(255, 255, 255, 0.07);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 3px solid var(--primary-color);
        }

        .comment-item-layout .comment-name {
            font-weight: 600;
            font-size: 1rem;
            color: #fff;
        }

        .comment-item-layout .attendance-badge {
            font-size: .7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 8px;
            font-weight: 500;
            vertical-align: middle;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .attendance-hadir {
            background-color: #28a745;
            color: white;
        }

        .attendance-tidak-hadir {
            background-color: #dc3545;
            color: white;
        }

        .comment-item-layout .comment-date {
            font-size: .75rem;
            color: rgba(255, 255, 255, 0.6);
            display: block;
            margin-bottom: 5px;
        }

        .comment-item-layout .comment-message p {
            font-size: .9rem;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 0;
            word-wrap: break-word;
        }

        #pagination-container .pagination {
            margin-bottom: 0;
        }

        #pagination-container .page-item .page-link {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: var(--text-on-dark);
            margin: 0 3px;
            border-radius: 5px;
            cursor: pointer;
        }

        #pagination-container .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--text-on-primary);
        }

        #pagination-container .page-item.disabled .page-link {
            background-color: transparent;
            border-color: rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.4);
            cursor: default;
        }

        #pagination-container .page-item:not(.disabled) .page-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .closing-message .subtitle {
            font-family: var(--font-script);
            font-size: 1.8rem;
            color: var(--primary-color);
        }

        .closing-message .couple-names-display {
            font-family: var(--font-heading);
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-top: 1rem;
            margin-bottom: 0;
        }

        .footer {
            background-color: var(--app-bg-soft);
            padding: 25px 0;
            margin-top: 30px;
            border-top: 1px solid #e7e7e7;
            font-size: .9rem;
            color: var(--text-on-light);
        }

        .footer .made-with i {
            color: var(--primary-color);
        }

        .footer .social-icons a {
            color: var(--accent-color-1);
            margin: 0 8px;
            font-size: 1.3rem;
            transition: color .3s ease;
        }

        .footer .social-icons a:hover {
            color: var(--primary-color);
        }

        .music-button-container {
            position: fixed;
            bottom: 80px;
            right: 15px;
            z-index: 1001;
        }

        .music-button {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            font-size: 1.2em;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color .3s ease, transform .3s ease;
        }

        .music-button:hover {
            background-color: var(--primary-color);
        }

        .music-button.playing i::before {
            content: "\f04c";
        }

        .music-button i::before {
            content: "\f001";
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: var(--primary-color);
            color: var(--text-on-primary);
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 60px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .bottom-nav .nav-item {
            color: var(--text-on-primary);
            text-decoration: none;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 5px 0;
            font-size: .78em;
            transition: color .3s ease;
            flex-grow: 1;
        }

        .bottom-nav .nav-item i {
            font-size: 1.1em;
            margin-bottom: 3px;
        }

        .bottom-nav .nav-item:hover,
        .bottom-nav .nav-item.active {
            color: var(--warning-color);
        }

        .bottom-nav .nav-item span {
            display: block;
        }

        [data-aos] {
            visibility: hidden;
        }

        .aos-animate {
            visibility: visible;
        }
    </style>
</head>

<body>

    <div id="cover-container">
        <!-- Background Image -->
        <div class="cover-background-image"></div>

        <!-- Overlay Gradient dari bawah ke setengah layar -->
        <div class="bottom-gradient-overlay"></div>

        <!-- Konten Utama -->
        <div class="cover-content-wrapper">
            <!-- Gambar Pasangan dengan Bingkai -->


            <!-- Teks Undangan -->
            <div class="cover-text-content">
                <p class="cover-intro-text" data-aos="fade-down" data-aos-delay="200">THE WEDDING OF</p>
                <h1 class="cover-couple-names" data-aos="zoom-in" data-aos-delay="300">
                    {{ $mempelai ? $mempelai->namalaki ?? 'Nama Pria' : 'Nama Pria' }}
                    <span>&</span>
                    {{ $mempelai ? $mempelai->namaperempuan ?? 'Nama Wanita' : 'Nama Wanita' }}
                </h1>

                <div class="cover-guest-name" data-aos="fade-up" data-aos-delay="400">
                    <p>Kepada Yth.<br>Bapak/Ibu/Saudara/i</p>
                    @if (isset($namaTamu) && $namaTamu !== 'Tamu Undangan')
                        <p><strong>{{ $namaTamu ?? 'Tamu' }}</strong></p>
                    @else
                        <p>di Tempat</p>
                    @endif
                </div>

                <button id="open-invitation" class="btn open-invitation-button" data-aos="zoom-in" data-aos-delay="500">
                    <i class="fas fa-envelope-open-text"></i> Buka Undangan
                </button>
            </div>
        </div>
    </div>

    <main>
        <section class="section header-section py-5" id="home">
            <div class="header-ornament ornament-top-left" data-aos="fade-down-right" data-aos-delay="150"></div>
            <div class="header-ornament ornament-bottom-right" data-aos="fade-up-left" data-aos-delay="150"></div>
            <div class="container">
                <p class="wedding-title" data-aos="fade-up" data-aos-delay="50">THE WEDDING OF</p>
                <div class="couple-frame-container" data-aos="zoom-in" data-aos-delay="100">
                    {{-- <img src="{{ asset('tema2/img/bingkai.png') }}" alt="Decorative Frame"
                        class="rotating-frame-image" /> --}}
                    <div class="couple-circle">
                        <div class="couple-illustration">
                            <img src="{{ $informasiacara && $informasiacara->pembuka ? asset('images/pembuka/' . $informasiacara->pembuka) : asset('images/default/default_couple_photo.jpg') }}"
                                alt="Foto Pasangan" />
                        </div>
                    </div>
                </div>
                <h1 class="couple-names-display" data-aos="fade-up" data-aos-delay="150">
                    {{ $mempelai ? $mempelai->namalaki ?? 'Nama Pria' : 'Nama Pria' }} &
                    {{ $mempelai ? $mempelai->namaperempuan ?? 'Nama Wanita' : 'Nama Wanita' }}
                </h1>
                <p class="hope-text" data-aos="fade-up" data-aos-delay="200">Kami berharap Anda menjadi bagian dari
                    hari istimewa kami!</p>
                @if ($oriTanggalAcara)
                    <div class="countdown-container" data-aos="zoom-in" data-aos-delay="250">
                        <div class="countdown-flex">
                            <div class="countdown-box">
                                <div class="countdown-number" id="days">0</div>
                                <div class="countdown-label">Hari</div>
                            </div>
                            <div class="countdown-box">
                                <div class="countdown-number" id="hours">0</div>
                                <div class="countdown-label">Jam</div>
                            </div>
                            <div class="countdown-box">
                                <div class="countdown-number" id="minutes">0</div>
                                <div class="countdown-label">Menit</div>
                            </div>
                            <div class="countdown-box">
                                <div class="countdown-number" id="seconds">0</div>
                                <div class="countdown-label">Detik</div>
                            </div>
                        </div>
                    </div>
                    <p class="wedding-date" data-aos="fade-up" data-aos-delay="300">
                        {{ $tanggalAcara ?? 'Tanggal Acara' }}</p>
                @else
                    <p class="wedding-date" data-aos="fade-up" data-aos-delay="300">Tanggal Akan Segera Diumumkan</p>
                @endif
                <input type="hidden" id="ori_tanggal_acara" value="{{ $oriTanggalAcara ?? '' }}" />
                @if ($oriTanggalAcara)
                    <button class="btn save-date-btn mt-3" data-aos="zoom-in" data-aos-delay="350"><i
                            class="fas fa-calendar-alt me-2"></i>Save The Date</button>
                @endif
            </div>
        </section>

        <section class="section invitation-message section-bg-light py-5">
            <div class="container text-center">
                <p class="subtitle" data-aos="fade-down">Assalamu'alaikum Wr. Wb.</p>
                <div class="message-box" data-aos="fade-up" data-aos-delay="200">
                    <p>Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i serta kerabat sekalian untuk
                        menghadiri acara pernikahan kami:</p>
                </div>
            </div>
        </section>

        <section class="section couple-details section-bg-light py-5">
            <div class="container">
                <div class="person-detail text-center mb-4" data-aos="fade-left">
                    <div class="bride-illustration" data-aos="zoom-in" data-aos-delay="100"><img
                            src="{{ $mempelai && $mempelai->fotolaki ? asset('images/mempelai/laki/' . $mempelai->fotolaki) : asset('images/default/default_male.jpg') }}"
                            alt="Mempelai Pria" class="img-fluid" /></div>
                    <h3 class="person-name" data-aos="fade-up" data-aos-delay="200">
                        {{ $mempelai ? $mempelai->namalaki ?? 'Nama Pria' : 'Nama Pria' }}</h3>
                    <p class="parents" data-aos="fade-up" data-aos-delay="300">Putra
                        {{ $mempelai->anakke_laki ?? '' }} dari Bapak {{ $mempelai->namabapaklaki ?? 'Ayah Pria' }} &
                        Ibu {{ $mempelai->namaibulaki ?? 'Ibu Pria' }}</p>
                    @if ($mempelai && $mempelai->instagram_laki)<a
                            href="{{ $mempelai->instagram_laki }}" class="btn-instagram mt-2" target="_blank"
                            data-aos="zoom-in" data-aos-delay="400"><i
                                class="fab fa-instagram me-1"></i>Instagram</a>@endif
                </div>
                <div class="ampersand text-center" data-aos="zoom-in" data-aos-delay="300">&</div>
                <div class="person-detail text-center mt-4" data-aos="fade-right">
                    <div class="bride-illustration" data-aos="zoom-in" data-aos-delay="100"><img
                            src="{{ $mempelai && $mempelai->fotoperempuan ? asset('images/mempelai/perempuan/' . $mempelai->fotoperempuan) : asset('images/default/default_female.jpg') }}"
                            alt="Mempelai Wanita" class="img-fluid" /></div>
                    <h3 class="person-name" data-aos="fade-up" data-aos-delay="200">
                        {{ $mempelai ? $mempelai->namaperempuan ?? 'Nama Wanita' : 'Nama Wanita' }}</h3>
                    <p class="parents" data-aos="fade-up" data-aos-delay="300">Putri
                        {{ $mempelai->anakke_perempuan ?? '' }} dari Bapak
                        {{ $mempelai->namabapakperempuan ?? 'Ayah Wanita' }} & Ibu
                        {{ $mempelai->namaibuperempuan ?? 'Ibu Wanita' }}</p>
                    @if ($mempelai && $mempelai->instagram_perempuan)<a
                            href="{{ $mempelai->instagram_perempuan }}" class="btn-instagram mt-2" target="_blank"
                            data-aos="zoom-in" data-aos-delay="400"><i
                                class="fab fa-instagram me-1"></i>Instagram</a>@endif
                </div>
            </div>
        </section>

        @if ($quotes && $quotes->quotes)
            <section class="section quran-verse section-bg-light py-5">
                <div class="background-element-container element-quran-verse-bg">
                    {{-- <img src="{{ asset('images/elements/your-quran-verse-bg-element.png') }}" alt="Quran Verse Background"> --}}
                </div>
                <div class="container">
                    <div class="verse-box semi-transparent-card" data-aos="fade-up">
                        <p class="verse-text">"{{ $quotes->quotes }}"</p>
                        @if ($quotes->source_quotes)
                            <p class="verse-ref">- ({{ $quotes->source_quotes }}) -</p>
                        @endif
                    </div>
                </div>
            </section>
        @else
            <section class="section quran-verse section-bg-light py-5">
                <div class="background-element-container element-quran-verse-bg">
                    {{-- <img src="{{ asset('images/elements/your-quran-verse-bg-element.png') }}" alt="Quran Verse Background"> --}}
                </div>
                <div class="container">
                    <div class="verse-box semi-transparent-card" data-aos="fade-up">
                        <p class="verse-text">"Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan
                            pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram
                            kepadanya, dan Dia menjadikan di antarmu rasa kasih dan sayang. Sesungguhnya pada yang
                            demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir."
                        </p>
                        <p class="verse-ref">- (Qs. Ar-Rum : 21) -</p>
                    </div>
                </div>
            </section>
        @endif



        @if ($ceritacinta && ($ceritacinta->judulcerita1 || $ceritacinta->judulcerita2 || $ceritacinta->judulcerita3))
            <section class="section love-story-section py-5" id="love-story" style="background-color: #f9f9f9;">
                <div class="container">
                    <h2 class="section-title-custom text-center" data-aos="fade-down">Kisah Cinta Kami</h2>
                    <div class="timeline-container mt-5">

                        @if ($ceritacinta->judulcerita1 && $ceritacinta->cover1)
                            <div class="row story-item align-items-center mb-5" data-aos="fade-right">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/ceritacinta/' . $ceritacinta->cover1) }}"
                                        alt="Cerita Cinta 1" class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <h3 class="story-title">{{ $ceritacinta->judulcerita1 }}</h3>
                                    <p class="story-description">{{ $ceritacinta->cerita1 }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($ceritacinta->judulcerita2 && $ceritacinta->cover2)
                            <div class="row story-item align-items-center mb-5 flex-md-row-reverse"
                                data-aos="fade-left">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/ceritacinta/' . $ceritacinta->cover2) }}"
                                        alt="Cerita Cinta 2" class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <h3 class="story-title">{{ $ceritacinta->judulcerita2 }}</h3>
                                    <p class="story-description">{{ $ceritacinta->cerita2 }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($ceritacinta->judulcerita3 && $ceritacinta->cover3)
                            <div class="row story-item align-items-center mb-5" data-aos="fade-right">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/ceritacinta/' . $ceritacinta->cover3) }}"
                                        alt="Cerita Cinta 3" class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <h3 class="story-title">{{ $ceritacinta->judulcerita3 }}</h3>
                                    <p class="story-description">{{ $ceritacinta->cerita3 }}</p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </section>
        @endif



        <section class="section event-details section-bg-dark py-5" id="akad">
            <div class="background-element-container element-akad-bg">
                <img src="https://cdn.pixabay.com/photo/2016/07/19/10/20/flowers-1527920_960_720.png"
                    alt="Akad Background">
            </div>
            <div class="container text-center">
                <div>
                    <h2 class="event-title-custom" data-aos="fade-down">Akad Nikah</h2>
                    <div class="event-box semi-transparent-card" data-aos="fade-up" data-aos-delay="200">
                        <p class="event-date">{{ $tanggalAcara ?? 'Segera Hadir' }}</p>
                        <p class="event-time">Pukul : {{ $informasiacara->jamakadnikah ?? 'TBA' }}</p>
                        <p class="event-location">{{ $informasiacara->lokasiakadnikah ?? 'Lokasi TBA' }}</p>
                        @if ($informasiacara && $informasiacara->googlemapspernikahan)<a
                                href="{{ $informasiacara->googlemapspernikahan }}" target="_blank"
                                class="btn btn-custom-primary btn-sm mt-2" data-aos="zoom-in" data-aos-delay="300"><i
                                    class="fas fa-map-marker-alt me-1"></i> View Map</a>@endif
                    </div>
                </div>
            </div>
        </section>

        <section class="section event-details section-bg-dark py-5" id="resepsi">
            <div class="background-element-container element-resepsi-bg">
                <img src="https://png.pngtree.com/png-clipart/20230913/original/pngtree-jasmine-flower-vector-png-image_11061240.png"
                    alt="Resepsi Background">
            </div>
            <div class="container text-center">
                <h2 class="event-title-custom" data-aos="fade-down">Resepsi</h2>
                <div class="event-box semi-transparent-card" data-aos="fade-up" data-aos-delay="200">
                    <p class="event-date">{{ $tanggalAcara ?? 'Segera Hadir' }}</p>
                    <p class="event-time">Pukul : {{ $informasiacara->jamresepsi ?? 'TBA' }}</p>
                    <p class="event-location">{{ $informasiacara->lokasiresepsi ?? 'Lokasi TBA' }}</p>
                    @if ($informasiacara && $informasiacara->googlemapsresepsi)<a
                            href="{{ $informasiacara->googlemapsresepsi }}" target="_blank"
                            class="btn btn-custom-primary btn-sm mt-2" data-aos="zoom-in" data-aos-delay="300"><i
                                class="fas fa-map-marker-alt me-1"></i> View Map</a>@endif
                </div>
            </div>
        </section>

        @if (isset($galeri) && $galeri->count() > 0)
            <section class="section gallery-section section-bg-light py-5" id="gallery">
                <div class="container">
                    <h2 class="section-title-custom text-center" data-aos="fade-down">Gallery</h2>
                    <div class="gallery-container">
                        @foreach ($galeri as $item)
                            <div class="gallery-item" data-aos="zoom-in"
                                data-aos-delay="{{ ($loop->index % 6) * 50 }}" data-bs-toggle="modal"
                                data-bs-target="#galleryModal"
                                data-img-src="{{ asset('images/galeri/' . $item->foto) }}">
                                <img src="{{ asset('images/galeri/' . $item->foto) }}"
                                    alt="Wedding Gallery Image {{ $loop->iteration }}" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($prewed && $prewed->vidio)
            <section class="section video-section section-bg-light py-5" id="video">
                <div class="container text-center">
                    <h2 class="section-title-custom" data-aos="fade-down">Video Prewedding</h2>
                    <div class="video-container mt-3" data-aos="fade-up" data-aos-delay="200">
                        <video controls preload="metadata" class="rounded shadow-sm"
                            poster="{{ $prewed->poster ? asset('images/poster/' . $prewed->poster) : '' }}">
                            <source src="{{ asset('video/prewedding/' . $prewed->vidio) }}" type="video/mp4">Your
                            browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </section>
        @endif


        @if ($weddingfilter && $weddingfilter->link)
            <section class="section ig-filter-section section-bg-light py-5" id="ig-filter">
                <div class="container text-center">
                    <h2 class="section-title-custom" data-aos="fade-down">Wedding Filter</h2>
                    <div class="filter-box message-box" data-aos="fade-up" data-aos-delay="200">
                        <p>Capture your moment while attending our wedding by using the Instagram filter below.</p>
                        @if ($weddingfilter->judul)
                            <p><strong>{{ $weddingfilter->judul }}</strong></p>
                        @endif
                        <a href="{{ $weddingfilter->link }}" target="_blank" class="btn btn-custom-primary mt-2"
                            data-aos="zoom-in" data-aos-delay="300"><i class="fab fa-instagram me-1"></i> Coba
                            Filter</a>
                    </div>
                </div>
            </section>
        @endif

        @if ($amplopdigital)
            <section class="section section-bg-light py-5" id="digital-gift-dropdown-section">
                <div class="container text-center">
                    <h2 class="section-title-custom" data-aos="fade-down">Kirim Kado</h2>
                    <div class="message-box semi-transparent-card" data-aos="fade-up" data-aos-delay="100">
                        <p>Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Jika memberi adalah ungkapan
                            tanda kasih, Anda dapat memberikan kado secara cashless melalui opsi di bawah ini.</p>
                        <button class="btn btn-custom-primary mt-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#giftCardCollapse" aria-expanded="false" aria-controls="giftCardCollapse"
                            data-aos="zoom-in" data-aos-delay="200">
                            <i class="fas fa-gift me-2"></i>Kirim Hadiah
                        </button>
                    </div>

                    <div class="collapse mt-4" id="giftCardCollapse">
                        <div class="gift-card-wrapper" data-aos="fade-up" data-aos-delay="50">
                            <div class="row justify-content-center g-3">
                                {{-- Card 1 (Primary Account) --}}
                                @if ($amplopdigital->paymentvendor && $amplopdigital->namaakun && $amplopdigital->noakun)
                                    <div class="col-md-8 col-lg-6">
                                        <div
                                            class="gift-card-item @if (strtolower($amplopdigital->paymentvendor) == 'bca') bca @elseif(strtolower($amplopdigital->paymentvendor) == 'mandiri') mandiri @elseif(strtolower($amplopdigital->paymentvendor) == 'bri') bri @elseif(strtolower($amplopdigital->paymentvendor) == 'bni') bni @endif">
                                            <div class="gift-card-bank-info">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png"
                                                    style="width:50px;"
                                                    @if (file_exists(public_path('images/default/logo_' . strtolower(str_replace(' ', '_', $amplopdigital->paymentvendor)) . '.png'))) <img src="{{ asset('images/default/logo_' . strtolower(str_replace(' ', '_', $amplopdigital->paymentvendor)) . '.png') }}" alt="{{ $amplopdigital->paymentvendor }} Logo" class="bank-logo">
                                        @else
                                            <i class="fas fa-landmark bank-logo-placeholder @if (strtolower($amplopdigital->paymentvendor) == 'bca') bca @elseif(strtolower($amplopdigital->paymentvendor) == 'mandiri') mandiri @elseif(strtolower($amplopdigital->paymentvendor) == 'bri') bri @elseif(strtolower($amplopdigital->paymentvendor) == 'bni') bni @endif"></i>
                                @endif
                            </div>
                            <div class="gift-card-account-number">
                                @php
                                    $noAkun1 = $amplopdigital->noakun;
                                    $noAkun1Formatted = '';
                                    for ($i = 0; $i < strlen($noAkun1); $i++) {
                                        if ($i > 0 && $i % 4 == 0) {
                                            $noAkun1Formatted .= ' ';
                                        }
                                        $noAkun1Formatted .= $noAkun1[$i];
                                    }
                                @endphp
                                <span>{{ $noAkun1Formatted }}</span>
                            </div>
                            <div class="gift-card-holder-details">
                                <div class="account-holder-name">
                                    <h5>Atas Nama</h5><span>{{ $amplopdigital->namaakun }}</span>
                                </div>
                                <div class="copy-action"><button class="btn btn-sm btn-copy-account"
                                        data-text="{{ $amplopdigital->noakun }}"><i class="fas fa-copy"></i>
                                        Salin</button></div>
                            </div>
                            <div class="gift-card-dummy-validity">
                                <div class="row">
                                    <div class="col-6 item-valid-col">
                                        <div class="item-valid-content">
                                            <h5>Valid From</h5><span>12/23</span>
                                        </div>
                                    </div>
                                    <div class="col-6 item-valid-col">
                                        <div class="item-valid-content">
                                            <h5>Valid Thru</h5><span>12/28</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gift-card-type-info">
                                <h6>Digital Gift</h6><i class="fas fa-credit-card generic-card-icon"></i>
                            </div>
                            @if ($amplopdigital->qrcode)
                                <div class="gift-card-qr">
                                    <p>Scan QR Code</p>
                                    <img src="{{ asset('qrcodes/' . $amplopdigital->qrcode) }}"
                                        alt="QR Code {{ $amplopdigital->paymentvendor }}" class="qr-code-image">
                                </div>
                            @endif
                        </div>
                    </div>
        @endif

        {{-- Card 2 (Secondary Account, if exists) --}}
        @if ($amplopdigital->paymentvendor_dua && $amplopdigital->namaakun_dua && $amplopdigital->noakun_dua)
            <div class="col-md-8 col-lg-6">
                <div
                    class="gift-card-item @if (strtolower($amplopdigital->paymentvendor_dua) == 'bca') bca @elseif(strtolower($amplopdigital->paymentvendor_dua) == 'mandiri') mandiri @elseif(strtolower($amplopdigital->paymentvendor_dua) == 'bri') bri @elseif(strtolower($amplopdigital->paymentvendor_dua) == 'bni') bni @endif">
                    <div class="gift-card-bank-info">
                        <h3 class="bank-vendor-name">{{ $amplopdigital->paymentvendor_dua }}</h3>
                        @if (file_exists(public_path(
                                    'images/default/logo_' . strtolower(str_replace(' ', '_', $amplopdigital->paymentvendor_dua)) . '.png')))
                            <img src="{{ asset('images/default/logo_' . strtolower(str_replace(' ', '_', $amplopdigital->paymentvendor_dua)) . '.png') }}"
                                alt="{{ $amplopdigital->paymentvendor_dua }} Logo" class="bank-logo">
                        @else
                            <i
                                class="fas fa-landmark bank-logo-placeholder @if (strtolower($amplopdigital->paymentvendor_dua) == 'bca') bca @elseif(strtolower($amplopdigital->paymentvendor_dua) == 'mandiri') mandiri @elseif(strtolower($amplopdigital->paymentvendor_dua) == 'bri') bri @elseif(strtolower($amplopdigital->paymentvendor_dua) == 'bni') bni @endif"></i>
                        @endif
                    </div>
                    <div class="gift-card-account-number">
                        @php
                            $noAkun2 = $amplopdigital->noakun_dua;
                            $noAkun2Formatted = '';
                            for ($i = 0; $i < strlen($noAkun2); $i++) {
                                if ($i > 0 && $i % 4 == 0) {
                                    $noAkun2Formatted .= ' ';
                                }
                                $noAkun2Formatted .= $noAkun2[$i];
                            }
                        @endphp
                        <span>{{ $noAkun2Formatted }}</span>
                    </div>
                    <div class="gift-card-holder-details">
                        <div class="account-holder-name">
                            <h5>Atas Nama</h5><span>{{ $amplopdigital->namaakun_dua }}</span>
                        </div>
                        <div class="copy-action"><button class="btn btn-sm btn-copy-account"
                                data-text="{{ $amplopdigital->noakun_dua }}"><i class="fas fa-copy"></i>
                                Salin</button></div>
                    </div>
                    <div class="gift-card-dummy-validity">
                        <div class="row">
                            <div class="col-6 item-valid-col">
                                <div class="item-valid-content">
                                    <h5>Valid From</h5><span>01/24</span>
                                </div>
                            </div>
                            <div class="col-6 item-valid-col">
                                <div class="item-valid-content">
                                    <h5>Valid Thru</h5><span>01/29</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gift-card-type-info">
                        <h6>Digital Gift</h6><i class="fas fa-credit-card generic-card-icon"></i>
                    </div>
                    @if ($amplopdigital->qrcode_dua)
                        <div class="gift-card-qr">
                            <p>Scan QR Code</p>
                            <img src="{{ asset('qrcodes/' . $amplopdigital->qrcode_dua) }}"
                                alt="QR Code {{ $amplopdigital->paymentvendor_dua }}" class="qr-code-image">
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if (
            !($amplopdigital->paymentvendor && $amplopdigital->namaakun && $amplopdigital->noakun) &&
                !($amplopdigital->paymentvendor_dua && $amplopdigital->namaakun_dua && $amplopdigital->noakun_dua))
            <p class="text-center col-12" style="color: var(--text-on-light);">Informasi kado digital belum tersedia.
            </p>
        @endif
        </div>
        <p class="text-center mt-4" style="font-size: 0.85rem; color: #555;">Terima kasih atas niat baik dan doa restu
            Anda.</p>
        </div>
        </div>
        </div>
        </section>
        @endif

        <section class="section comments-section section-bg-dark py-5" id="guestbook">
            <div class="container container-inner-dark">
                <input type="hidden" id="user_id" value="{{ $getUser->user_id ?? '' }}">
                <input type="hidden" id="kdtamu" value="{{ $kodeTamu->kode_tamu ?? '' }}">
                <input type="hidden" id="default_avatar_url"
                    value="{{ asset('images/default/default_avatar.png') }}">
                <h2 class="section-title-custom text-center" data-aos="fade-down"><span id="comment-count">0</span>
                    Ucapan & Doa</h2>
                <div class="rsvp-summary" data-aos="fade-up" data-aos-delay="100">
                    <div class="rsvp-hadir"><span id="rsvp-hadir-count">0</span><span>Hadir</span></div>
                    <div class="rsvp-tidak-hadir"><span id="rsvp-tidak-hadir-count">0</span><span>Tidak Hadir</span>
                    </div>
                </div>
                <div class="comment-form-box" data-aos="fade-up" data-aos-delay="200">
                    <form id="guestbookForm">
                        @csrf
                        <div class="mb-3" data-aos="fade-up" data-aos-delay="250"><input type="text"
                                id="nama-ucapan" name="nama" class="form-control" placeholder="Nama Anda"
                                value="{{ $kodeTamu->nama_tamu ?? '' }}" /></div>
                        <div class="mb-3" data-aos="fade-up" data-aos-delay="300">
                            <textarea id="pesan-ucapan" name="ucapan" class="form-control" rows="3"
                                placeholder="Tulis Ucapan & Doa Anda" required></textarea>
                        </div>
                        <div class="mb-3" data-aos="fade-up" data-aos-delay="350">
                            <label for="attendance" class="form-label">Konfirmasi Kehadiran:</label>
                            <select name="attendance" id="attendance" class="form-select" required>
                                <option value="" disabled selected>Apakah Anda akan hadir?</option>
                                <option value="hadir">Insya Allah, Hadir</option>
                                <option value="tidak-hadir">Maaf, Tidak Bisa Hadir</option>
                            </select>
                        </div>
                        <button type="submit" id="kirim-ucapan" class="btn btn-send-comment float-end"
                            data-aos="zoom-in" data-aos-delay="400">KIRIM</button>
                    </form>
                </div>
                <div class="comment-list-container mt-5 pt-3" id="dynamic-comment-list"></div>
                <div id="pagination-container" class="d-flex justify-content-center mt-4">

                </div>
            </div>
        </section>

        <section class="section closing-message section-bg-light py-5">
            <div class="background-element-container element-closing-bg">
                <img src="https://png.pngtree.com/png-clipart/20230913/original/pngtree-jasmine-flower-vector-png-image_11061240.png"
                    alt="Closing Background">
            </div>
            <div class="container text-center">
                <div class="couple-frame-container" data-aos="zoom-in" data-aos-delay="100"> {{-- Added Frame for Closing --}}
                    <img src="{{ asset('tema2/img/bingkai.png') }}" alt="Decorative Frame"
                        class="rotating-frame-image" />
                    <div class="couple-circle">
                        <div class="couple-illustration">
                            <img src="{{ $informasiacara && $informasiacara->pembuka ? asset('images/pembuka/' . $informasiacara->pembuka) : asset('images/default/default_couple_photo.jpg') }}"
                                alt="Foto Pasangan" />
                        </div>
                    </div>
                </div>
                <div class="message-box semi-transparent-card" data-aos="fade-up">
                    <p>Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir
                        dan memberikan doa restu. Atas kehadiran dan doa restunya, kami mengucapkan terima kasih.</p>
                </div>
                <p class="subtitle mt-4" data-aos="fade-up" data-aos-delay="200">Wassalamu'alaikum Wr. Wb.</p>
                <p class="couple-names-display mt-3" data-aos="zoom-in" data-aos-delay="300">
                    {{ $mempelai ? $mempelai->namalaki ?? 'Nama Pria' : 'Nama Pria' }} &
                    {{ $mempelai ? $mempelai->namaperempuan ?? 'Nama Wanita' : 'Nama Wanita' }}
                </p>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container text-center">
            <p class="made-with mb-2" data-aos="fade-up">Made with <i class="fas fa-heart"></i> by Selaksa Digital
            </p>
            <div class="social-icons" data-aos="fade-up" data-aos-delay="100">
                @if ($mempelai && $mempelai->instagram_laki)<a
                        href="{{ $mempelai->instagram_laki }}" target="_blank" title="Instagram Pria"><i
                            class="fab fa-instagram"></i></a>@endif
                @if ($mempelai && $mempelai->instagram_perempuan)<a
                        href="{{ $mempelai->instagram_perempuan }}" target="_blank" title="Instagram Wanita"><i
                            class="fab fa-instagram"></i></a>@endif
                @if ($informasiacara && $informasiacara->nomorwhatsapp)
                    @php
                        if (!function_exists('formatNomorWhatsapp')) {
                            function formatNomorWhatsapp($n)
                            {
                                $n = preg_replace('/\D/', '', $n);
                                if (str_starts_with($n, '08')) {
                                    $n = '628' . substr($n, 2);
                                } elseif (!str_starts_with($n, '62')) {
                                    if (str_starts_with($n, '8')) {
                                        $n = '62' . $n;
                                    }
                                }
                                return ltrim($n, '+');
                            }
                        }
                    @endphp
                    <a href="https://wa.me/{{ formatNomorWhatsapp($informasiacara->nomorwhatsapp) }}?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20undangan%20pernikahan%20Anda."
                        target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                @endif
            </div>
        </div>
    </footer>

    <div class="music-button-container">
        <button class="music-button" id="music-toggle-button"><i class="fas fa-music"></i></button>
        <audio id="musicPlayer" loop
            src="{{ $musik ? ($musik->musikMaster->musik ? asset('musik/' . $musik->musikMaster->musik) : '/tema5/music/sample-music.mp3') : '/tema5/music/sample-music.mp3' }}">
        </audio>
    </div>



    <nav class="bottom-nav">
        <a href="#home" class="nav-item active"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="#akad" class="nav-item"><i class="fas fa-calendar-check"></i><span>Acara</span></a>



        @if ($weddingfilter && $weddingfilter->link)<a href="#ig-filter" class="nav-item"><i
                    class="fab fa-instagram"></i><span>Filter</span></a>@endif
        <a href="#guestbook" class="nav-item"><i class="fas fa-comments"></i><span>Ucapan</span></a>
        @if ($amplopdigital)
            <a href="#digital-gift-dropdown-section" class="nav-item">
                <i class="fas fa-gift"></i><span>Kado</span>
            </a>
        @endif
    </nav>

    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <img src="" id="galleryModalImage" class="img-fluid" alt="Gallery Image Large">
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/assets/vendors/jquery-toast-plugin-master/src/jquery.toast.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Music Setup - Updated Version
            var musicPlayer = $("#musicPlayer")[0];
            var musicToggleButton = $("#music-toggle-button");

            // Set volume to 50% by default to prevent loud surprises
            musicPlayer.volume = 0.5;

            // Function to toggle music with improved handling
            function toggleMusic() {
                if (musicPlayer.paused) {
                    // Try to play with promise handling
                    var playPromise = musicPlayer.play();

                    if (playPromise !== undefined) {
                        playPromise.then(_ => {
                                // Successfully started playback
                                musicToggleButton.find('i').removeClass('fa-music').addClass('fa-pause');
                                console.log("Music playback started successfully");
                            })
                            .catch(error => {
                                // Auto-play was prevented, show user feedback
                                console.error("Playback prevented:", error);
                                $.toast({
                                    heading: 'Info',
                                    text: 'Klik tombol musik lagi untuk memulai audio',
                                    position: 'top-right',
                                    loaderBg: 'var(--warning-color)',
                                    icon: 'info',
                                    hideAfter: 3000
                                });
                            });
                    }
                } else {
                    musicPlayer.pause();
                    musicToggleButton.find('i').removeClass('fa-pause').addClass('fa-music');
                }
            }

            // Click handler for music button
            musicToggleButton.on('click', function(e) {
                e.preventDefault();
                toggleMusic();
            });

            // Event listeners for player state changes
            $(musicPlayer).on('play playing', function() {
                musicToggleButton.find('i').removeClass('fa-music').addClass('fa-pause');
            });

            $(musicPlayer).on('pause ended', function() {
                musicToggleButton.find('i').removeClass('fa-pause').addClass('fa-music');
            });

            // Auto-play when invitation is opened (if user interacts)
            const openButton = $('#open-invitation');
            const coverContainer = $('#cover-container');

            if (openButton.length && coverContainer.length) {
                openButton.on('click', function() {
                    // Try to play music when opening invitation
                    if (musicPlayer.paused) {
                        var playPromise = musicPlayer.play();

                        if (playPromise !== undefined) {
                            playPromise.catch(error => {
                                console.log("Auto-play prevented, will require button click");
                            });
                        }
                    }

                    coverContainer.css('top', '-100vh');
                    setTimeout(() => {
                        coverContainer.hide();
                        $('body').css('overflow-y', 'auto');
                        AOS.refresh();
                        $(window).trigger('scroll');
                    }, 1000);
                });
            }

            // Rest of your existing code (AOS, countdown, navigation, guestbook, etc.)
            AOS.init({
                duration: 800,
                once: false,
                mirror: false,
                offset: 30
            });

            const targetDateString = $('#ori_tanggal_acara').val();
            if (targetDateString) {
                const targetDate = new Date(targetDateString.replace(/-/g, '/')).getTime();
                if (!isNaN(targetDate)) {
                    const countdownInterval = setInterval(() => {
                        const now = new Date().getTime();
                        const gap = targetDate - now;
                        if (gap > 0) {
                            $('#days').text(Math.floor(gap / (1000 * 60 * 60 * 24)));
                            $('#hours').text(Math.floor((gap % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                            $('#minutes').text(Math.floor((gap % (1000 * 60 * 60)) / (1000 * 60)));
                            $('#seconds').text(Math.floor((gap % (1000 * 60)) / 1000));
                        } else {
                            $('#days, #hours, #minutes, #seconds').text(0);
                            $('.countdown-container').html(
                                "<p class='text-center my-2' style='font-size:1.1em; color: var(--accent-color-1);'>Acara Telah Selesai</p>"
                            );
                            clearInterval(countdownInterval);
                        }
                    }, 1000);
                } else {
                    $('.countdown-container').hide();
                }
            } else {
                $('.countdown-container').hide();
            }

            var lastId;
            const bottomNav = $(".bottom-nav");
            const navMenuItemsForScroll = bottomNav.find("a[href^='#']").not('[data-bs-toggle="collapse"]');
            let navScrollItems = [];
            if (navMenuItemsForScroll.length > 0) {
                navScrollItems = navMenuItemsForScroll.map(function() {
                    var item = $($(this).attr("href"));
                    if (item.length) {
                        return item;
                    }
                    return undefined;
                }).get().filter(item => item !== undefined);
            }

            bottomNav.on('click', 'a[href^="#"]', function(e) {
                if ($(this).data('bs-toggle') === 'collapse') {
                    return;
                }
                e.preventDefault();
                var targetId = $(this).attr("href");
                var targetElement = $(targetId);
                if (targetElement.length) {
                    $('html, body').animate({
                        scrollTop: targetElement.offset().top - 30
                    }, 800);
                }
            });

            $(window).scroll(function() {
                let fromTop = $(this).scrollTop() + (bottomNav.is(':visible') ? bottomNav.outerHeight() :
                    0) + 75;
                let currentSectionId = "home";
                if (navScrollItems.length > 0) {
                    let activeItems = navScrollItems.filter(function(item) {
                        return $(item).offset().top < fromTop;
                    });
                    if (activeItems.length > 0) {
                        currentSectionId = $(activeItems[activeItems.length - 1]).attr("id");
                    } else {
                        if ($(this).scrollTop() < ($(navScrollItems[0]).offset().top - ((bottomNav.is(
                                ':visible') ? bottomNav.outerHeight() : 0) + 75))) {
                            currentSectionId = "home";
                        } else {
                            currentSectionId = $(navScrollItems[0]).attr("id");
                        }
                    }
                    if ($(this).scrollTop() < 50) {
                        currentSectionId = "home";
                    }
                }
                if (lastId !== currentSectionId) {
                    lastId = currentSectionId;
                    bottomNav.find("a[href^='#']").removeClass("active");
                    bottomNav.find("a[href='#" + currentSectionId + "']").addClass("active");
                }
            }).trigger('scroll');

            function copyToClipboard(text) {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(text).then(() => {
                        $.toast({
                            heading: 'Berhasil',
                            text: 'Nomor rekening disalin!',
                            position: 'top-right',
                            loaderBg: 'var(--primary-color)',
                            icon: 'success',
                            hideAfter: 2000,
                            stack: 5
                        });
                    }).catch(err => {
                        console.warn('Copy fallback: ', err);
                        fallbackCopyTextToClipboard(text);
                    });
                } else {
                    fallbackCopyTextToClipboard(text);
                }
            }

            function fallbackCopyTextToClipboard(text) {
                var textArea = document.createElement("textarea");
                textArea.value = text;
                Object.assign(textArea.style, {
                    position: "fixed",
                    top: 0,
                    left: 0,
                    width: "2em",
                    height: "2em",
                    padding: 0,
                    border: "none",
                    outline: "none",
                    boxShadow: "none",
                    background: "transparent"
                });
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    if (document.execCommand('copy')) {
                        $.toast({
                            heading: 'Berhasil',
                            text: 'Nomor rekening disalin!',
                            position: 'top-right',
                            loaderBg: 'var(--primary-color)',
                            icon: 'success',
                            hideAfter: 2000,
                            stack: 5
                        });
                    } else {
                        $.toast({
                            heading: 'Gagal',
                            text: 'Gagal menyalin.',
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 5
                        });
                    }
                } catch (err) {
                    $.toast({
                        heading: 'Gagal',
                        text: 'Gagal menyalin.',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 5
                    });
                }
                document.body.removeChild(textArea);
            }
            $('body').on('click', '.btn-copy-account', function(e) {
                e.preventDefault();
                copyToClipboard($(this).data('text'));
            });

            $('#galleryModal').on('show.bs.modal', function(event) {
                $(this).find('#galleryModalImage').attr('src', $(event.relatedTarget).data('img-src'));
            });

            const ucapanUndangan = () => {
                const userId = $('#user_id').val();
                if (!userId) {
                    $('#guestbookForm').hide();
                    $('#dynamic-comment-list').html(
                        '<p class="text-center" style="color: rgba(255,255,255,0.7);">Fitur ucapan tidak tersedia.</p>'
                    ).css('max-height', '60px');
                    $('#comment-count, #rsvp-hadir-count, #rsvp-tidak-hadir-count').text(0);
                    $('.rsvp-summary').hide();
                    return;
                }
                $('#guestbookForm').show();
                $('.rsvp-summary').show();
                const showUrl = `{{ route('ucapan.show', ['id' => ':id']) }}`.replace(':id', userId);
                $.ajax({
                    url: showUrl,
                    type: 'GET',
                    success: function(res) {
                        const commentListContainer = $('#dynamic-comment-list');
                        commentListContainer.html('');
                        const comments = res.ucapan;
                        let totalCount = 0,
                            hadirCount = 0,
                            tidakHadirCount = 0;
                        if (comments && Array.isArray(comments) && comments.length > 0) {
                            totalCount = comments.length;
                            comments.forEach(item => {
                                if (item.attendance === 'hadir') hadirCount++;
                                else if (item.attendance === 'tidak-hadir')
                                    tidakHadirCount++;
                            });
                            comments.sort((a, b) => new Date(b.created_at) - new Date(a
                                .created_at));
                            comments.forEach((item, index) => {
                                let attendanceBadge = '';
                                if (item.attendance === 'hadir') {
                                    attendanceBadge =
                                        '<span class="attendance-badge attendance-hadir">Hadir</span>';
                                } else if (item.attendance === 'tidak-hadir') {
                                    attendanceBadge =
                                        '<span class="attendance-badge attendance-tidak-hadir">Tidak Hadir</span>';
                                }
                                let formattedDate = item.created_at ? new Date(item
                                    .created_at).toLocaleString('id-ID', {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }) : '';
                                commentListContainer.append(
                                    `<div class="comment-item-layout"><div class="row"><div class="col comment-details-col"><p class="comment-name mb-0">${item.nama || 'Anonim'} ${attendanceBadge}</p><small class="comment-date">${formattedDate} WIB</small><div class="comment-message mt-1"><p>${item.ucapan || ''}</p></div></div></div></div>`
                                );
                            });
                        } else {
                            commentListContainer.html(
                                '<p class="text-center" style="color: rgba(255,255,255,0.7); padding: 10px 0;">Belum ada ucapan.</p>'
                            );
                        }
                        const numRenderedComments = commentListContainer.children(
                            '.comment-item-layout').length;
                        if (numRenderedComments === 0) {
                            commentListContainer.css('max-height', '70px');
                        } else if (numRenderedComments <= 3) {
                            commentListContainer.css('max-height', 'none');
                        } else {
                            commentListContainer.css('max-height', '400px');
                        }
                        $('#comment-count').text(totalCount);
                        $('#rsvp-hadir-count').text(hadirCount);
                        $('#rsvp-tidak-hadir-count').text(tidakHadirCount);
                    },
                    error: function(xhr) {
                        console.error("Error fetching comments:", xhr.responseText);
                        $('#dynamic-comment-list').html(
                            '<p class="text-center" style="color: rgba(255,255,255,0.7);">Gagal memuat ucapan.</p>'
                        ).css('max-height', '60px');
                    }
                });
            };
            $('#guestbookForm').on('submit', function(e) {
                e.preventDefault();
                const userId = $('#user_id').val(),
                    nama = $('#nama-ucapan').val().trim(),
                    ucapan = $('#pesan-ucapan').val().trim(),
                    attendance = $('select[name="attendance"]').val();
                if (!userId) {
                    $.toast({
                        heading: 'Error',
                        text: 'User ID tidak ditemukan.',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    return;
                }
                if (!nama) {
                    $.toast({
                        heading: 'Perhatian',
                        text: 'Nama tidak boleh kosong.',
                        position: 'top-right',
                        loaderBg: 'var(--warning-color)',
                        icon: 'warning',
                        hideAfter: 3000
                    });
                    return;
                }
                if (!ucapan) {
                    $.toast({
                        heading: 'Perhatian',
                        text: 'Ucapan tidak boleh kosong.',
                        position: 'top-right',
                        loaderBg: 'var(--warning-color)',
                        icon: 'warning',
                        hideAfter: 3000
                    });
                    return;
                }
                if (!attendance) {
                    $.toast({
                        heading: 'Perhatian',
                        text: 'Pilih status kehadiran.',
                        position: 'top-right',
                        loaderBg: 'var(--warning-color)',
                        icon: 'warning',
                        hideAfter: 3000
                    });
                    return;
                }
                const storeUrl = `{{ route('ucapan.store', ['id' => ':id']) }}`.replace(':id', userId);
                $.ajax({
                    url: storeUrl,
                    method: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: () => $('#kirim-ucapan').prop('disabled', true).html(
                        '<span class="spinner-border spinner-border-sm"></span> Mengirim...'),
                    success: function(response) {
                        if (response.code === 1) {
                            $('#guestbookForm')[0].reset();
                            const prefilledName = "";
                            if (prefilledName) $('#nama-ucapan').val(prefilledName);
                            ucapanUndangan();
                        } else {
                            $.toast({
                                heading: 'Gagal',
                                text: response.message || 'Gagal mengirim ucapan.',
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 3500,
                                stack: 5
                            });
                        }
                    },
                    error: (xhr) => {
                        let errMsg = 'Gagal mengirim ucapan.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        } else if (xhr.status === 419) {
                            errMsg = 'Sesi berakhir. Segarkan halaman.';
                        }
                        $.toast({
                            heading: 'Error',
                            text: errMsg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 4500,
                            stack: 5
                        });
                    },
                    complete: () => $('#kirim-ucapan').prop('disabled', false).text('KIRIM')
                });
            });
            ucapanUndangan();

            $('.save-date-btn').on('click', function() {
                const eventName =
                    "Pernikahan {{ $mempelai ? ($mempelai->namalaki ?? 'Pria') . ' & ' . ($mempelai->namaperempuan ?? 'Wanita') : 'Pasangan Mempelai' }}";
                const eventDateVal = $('#ori_tanggal_acara').val();
                if (!eventDateVal) {
                    $.toast({
                        heading: 'Info',
                        text: 'Tanggal acara belum ditentukan.',
                        position: 'top-right',
                        loaderBg: 'var(--warning-color)',
                        icon: 'info',
                        hideAfter: 3000
                    });
                    return;
                }
                const formattedDateVal = eventDateVal.replace(/-/g, '/');
                const eventDate = new Date(formattedDateVal);
                if (isNaN(eventDate.getTime())) {
                    $.toast({
                        heading: 'Error',
                        text: 'Format tanggal tidak valid.',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3000
                    });
                    return;
                }
                const startTime = eventDate.toISOString().replace(/-|:|\.\d{3}/g, '');
                const endDate = new Date(eventDate.getTime() + (2 * 60 * 60 * 1000));
                const endTime = endDate.toISOString().replace(/-|:|\.\d{3}/g, '');
                const location =
                    "{{ $informasiacara->lokasiakadnikah ?? ($informasiacara->lokasiresepsi ?? 'Detail Lokasi Menyusul') }}";
                const description =
                    "Jangan lupa datang ke acara pernikahan kami! {{ $mempelai ? ($mempelai->namalaki ?? 'Pria') . ' & ' . ($mempelai->namaperempuan ?? 'Wanita') : 'Pasangan Mempelai' }}.";
                const icsContent =
                    `BEGIN:VCALENDAR\nVERSION:2.0\nPRODID:-//SelaksaDigital//WeddingInvitation//EN\nBEGIN:VEVENT\nUID:${new Date().getTime()}@selaksadigital.com\nDTSTAMP:${new Date().toISOString().replace(/-|:|\.\d{3}/g, '')}\nDTSTART:${startTime}\nDTEND:${endTime}\nSUMMARY:${eventName}\nDESCRIPTION:${description}\nLOCATION:${location}\nEND:VEVENT\nEND:VCALENDAR`;
                const blob = new Blob([icsContent], {
                    type: 'text/calendar;charset=utf-8'
                });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'save-the-date-pernikahan.ics';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                $.toast({
                    heading: 'Berhasil',
                    text: 'File kalender (ICS) telah diunduh.',
                    position: 'top-right',
                    loaderBg: 'var(--primary-color)',
                    icon: 'success',
                    hideAfter: 3000
                });
            });

            var giftCardCollapseElement = document.getElementById('giftCardCollapse');
            if (giftCardCollapseElement) {
                giftCardCollapseElement.addEventListener('shown.bs.collapse', function() {
                    AOS.refresh();
                });
            }

            let allComments = []; // Variabel global untuk menyimpan SEMUA komentar dari server
            const commentsPerPage = 10; // Atur jumlah komentar per halaman
            let currentPage = 1; // Halaman yang sedang aktif

            // Fungsi untuk menampilkan komentar pada halaman tertentu
            function displayComments(page) {
                currentPage = page;
                const commentListContainer = $('#dynamic-comment-list');
                const paginationContainer = $('#pagination-container');
                commentListContainer.html(''); // Kosongkan daftar sebelum diisi
                paginationContainer.html(''); // Kosongkan tombol paginasi

                if (!allComments || allComments.length === 0) {
                    commentListContainer.html(
                        '<p class="text-center" style="color: rgba(255,255,255,0.7);">Belum ada ucapan.</p>');
                    return;
                }

                // Memotong array `allComments` sesuai halaman yang aktif
                const startIndex = (page - 1) * commentsPerPage;
                const endIndex = startIndex + commentsPerPage;
                const paginatedComments = allComments.slice(startIndex, endIndex);

                // Menampilkan komentar yang sudah dipotong
                paginatedComments.forEach(item => {
                    let attendanceBadge = item.attendance === 'hadir' ?
                        '<span class="attendance-badge attendance-hadir">Hadir</span>' : (item
                            .attendance === 'tidak-hadir' ?
                            '<span class="attendance-badge attendance-tidak-hadir">Tidak Hadir</span>' : ''
                        );
                    let formattedDate = new Date(item.created_at).toLocaleString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    commentListContainer.append(
                        `<div class="comment-item-layout"><p class="comment-name mb-0">${item.nama || 'Anonim'} ${attendanceBadge}</p><small class="comment-date">${formattedDate} WIB</small><div class="comment-message mt-1"><p>${item.ucapan || ''}</p></div></div>`
                    );
                });

                // Membuat dan menampilkan tombol-tombol paginasi
                displayPagination();
            }

            // Fungsi untuk membuat tombol-tombol paginasi berdasarkan jumlah total komentar
            function displayPagination() {
                const paginationContainer = $('#pagination-container');
                const pageCount = Math.ceil(allComments.length / commentsPerPage);

                if (pageCount <= 1) return; // Jangan tampilkan paginasi jika hanya 1 halaman

                let paginationHTML = '<nav><ul class="pagination">';
                // Tombol "Previous"
                paginationHTML +=
                    `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${currentPage - 1}">«</a></li>`;

                // Tombol nomor halaman
                for (let i = 1; i <= pageCount; i++) {
                    paginationHTML +=
                        `<li class="page-item ${i === currentPage ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                }

                // Tombol "Next"
                paginationHTML +=
                    `<li class="page-item ${currentPage === pageCount ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${currentPage + 1}">»</a></li>`;
                paginationHTML += '</ul></nav>';

                paginationContainer.html(paginationHTML);
            }

            // Fungsi untuk mengambil SEMUA data ucapan dari server SEKALI SAJA
            const fetchInitialData = () => {
                const userId = $('#user_id').val();
                if (!userId) {
                    /* ... handle no user id ... */
                    return;
                }

                const showUrl = `{{ route('ucapan.show', ['id' => ':id']) }}`.replace(':id', userId);

                $.ajax({
                    url: showUrl,
                    type: 'GET',
                    success: function(res) {
                        // Simpan SEMUA ucapan ke variabel global
                        allComments = res.ucapan || [];

                        // Mengurutkan komentar dari yang terbaru
                        allComments.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                        // Menghitung total hadir/tidak hadir dari semua data
                        const totalCount = allComments.length;
                        const hadirCount = allComments.filter(c => c.attendance === 'hadir').length;
                        const tidakHadirCount = allComments.filter(c => c.attendance ===
                            'tidak-hadir').length;

                        $('#comment-count').text(totalCount);
                        $('#rsvp-hadir-count').text(hadirCount);
                        $('#rsvp-tidak-hadir-count').text(tidakHadirCount);

                        // Setelah semua data didapat, tampilkan halaman pertama
                        displayComments(1);
                    },
                    error: (xhr) => console.error("Error fetching comments:", xhr.responseText)
                });
            };

            // Event listener untuk klik pada tombol paginasi
            $('body').on('click', '#pagination-container .page-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                const pageCount = Math.ceil(allComments.length / commentsPerPage);
                if (page && page > 0 && page <= pageCount) {
                    displayComments(page);
                }
            });

            // Panggilan awal untuk memulai semuanya
            fetchInitialData();
        });
    </script>
</body>

</html>
