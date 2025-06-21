<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/tema1/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/tema1/css/main.css">
    <title>Online Invitation</title>
    <link rel="stylesheet" href="/assets/vendors/jquery-toast-plugin-master/src/jquery.toast.css">
</head>

<body>
    <!-- Section 1: Cover Section -->
    <div style="overflow-x: hidden !important;" class="section-one">
        @if(isset($informasiacara) && $informasiacara->sampul)
        <div style="overflow-x: hidden !important; background-image: url('{{ asset('images/sampul/' . $informasiacara->sampul) }}');"
            class="background"></div>
        @else
        <div style="overflow-x: hidden !important; background-image: url('/tema1/img/default-cover.jpg');"
            class="background"></div>
        @endif
        
        <div style="overflow-x: hidden !important;" class="container my-2">
            <div style="overflow-x: hidden !important;" class="center-content">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <input type="hidden" name="user_id" id="user_id" value="{{ $getUser->user_id ?? '' }}">
                            <h1 id="welcoming-sentences-sec1" class="text-light">The Wedding Of</h1>
                            <h1 id="user-name" class="mb-0 pb-0">
                                {{ $mempelai->namalaki ?? 'Groom' }} & {{ $mempelai->namaperempuan ?? 'Bride' }}
                            </h1>
                            <h3 id="wedding-date-sec1" class="text-light" style="z-index: 9999;">
                                {{ $afterConvertDay ?? 'Saturday' }}, {{ $tanggalAcara ?? date('d F Y') }}
                            </h3>
                            <h5 style="z-index: 9999; font-family: 'PlayBall', serif; opacity: 0;"
                                class="text-center text-light" id="coupleWeddingSubtext">
                                To: <br> {{ $namaTamu ?? 'Dear Guest' }}
                            </h5>
                        </div>
                        <div style="padding: 10% 0;" class="row">
                            <!-- Optional ornament can be placed here -->
                        </div>
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-center mt-3">
                                <a href="#" id="save-date-button"
                                    class="text-center text-light p-2 px-4 btn border border-2 rounded-5 fw-semibold">Open
                                    Invitation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section (hidden by default) -->
    <div class="other-section" id="other-section-target" style="display: none; position: relative; overflow-x: hidden !important;">

        <!-- Couple Information Section -->
        <div class="couple-information">
            <!-- Bible Verse -->
            <div class="bible-verse py-4">
                <h4 id="bible-verses-sec2" class="text-center w-75 d-block mx-auto">
                    {{ $quotes->quotes ?? 'Love is patient, love is kind...' }}
                </h4>
            </div>

            <!-- Couple Profile -->
            <div class="couple-profile py-3 mb-5">
                <div class="row">
                    <!-- Groom Section -->
                    <div class="col-md mb-5">
                        <div style="position: relative;" class="groom-wrapper">
                            <div style="position: relative;" class="image-container overlay-container mb-3">
                                <img id="groomProfileImage" class="d-block mx-auto rounded img-fluid" style="opacity: 0;"
                                    src="{{ isset($mempelai) && $mempelai->fotolaki ? asset('images/mempelai/laki/' . $mempelai->fotolaki) : '/tema1/img/default-groom.jpg' }}"
                                    alt="Groom">
                                <div class="overlayImage">
                                    <img src="/tema1/ornament/Group 1.svg" alt="" class="ornament">
                                </div>
                            </div>
                            <div class="groom-information p-3 px-5">
                                <h3 id="groom" class="text-light">The Groom</h3>
                                <hr class="mb-2 border-3 rounded horizontalLineSec2"
                                    style="background-color: #EBB760; border: 1.5% solid #EBB760; color: #EBB760; width: 0%;">
                                <br>
                                <h1 id="groom-name" class="mb-2">
                                    {{ $mempelai->namalengkaplaki ?? 'John Doe' }}
                                </h1>
                                <h4 id="groom-parent-name">
                                    Son of Mr. {{ $mempelai->namabapaklaki ?? 'Father' }} & Mrs. {{ $mempelai->namaibulaki ?? 'Mother' }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bride Section -->
                    <div class="col-md">
                        <div style="position: relative;" class="bride-wrapper">
                            <div style="position: relative;" class="image-container overlay-container mb-3">
                                <img id="brideProfileImage" class="d-block mx-auto rounded img-fluid" style="opacity: 0;"
                                    src="{{ isset($mempelai) && $mempelai->fotoperempuan ? asset('images/mempelai/perempuan/' . $mempelai->fotoperempuan) : '/tema1/img/default-bride.jpg' }}"
                                    alt="Bride">
                                <div class="overlayImage">
                                    <img src="/tema1/ornament/Group 1.svg" alt="" class="ornament">
                                </div>
                            </div>
                            <div class="bride-information p-3 px-5">
                                <h3 id="bride" class="text-light text-end">The Bride</h3>
                                <hr class="mb-2 border-3 rounded horizontalLineSec2"
                                    style="background-color: #EBB760; border: 1.5% solid #EBB760; color: #EBB760; width: 0%;">
                                <br>
                                <h1 id="bride-name" class="text-end mb-2">
                                    {{ $mempelai->namalengkapperempuan ?? 'Jane Doe' }}
                                </h1>
                                <h4 id="bride-parent-name" class="text-end">
                                    Daughter of Mr. {{ $mempelai->namabapakperempuan ?? 'Father' }} & Mrs. {{ $mempelai->namaibuperempuan ?? 'Mother' }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Details Section -->
        <div class="event-detail">
            <!-- Countdown -->
            <h2 id="save-date-text" class="text-light text-center">Save The Date</h2>
            <h2 id="event-date" class="text-center mb-5">
                {{ $afterConvertDay ?? 'Saturday' }}, {{ $tanggalAcara ?? date('d F Y') }}
            </h2>
            
            <div class="countdown-box mb-5">
                <div class="d-flex align-items-center justify-content-center">
                    <div id="countdown" class="countdown text-light row px-1">
                        <input type="hidden" name="tglacara" id="tglacara" value="{{ $oriTanggalAcara ?? date('Y-m-d') }}">
                        <!-- Countdown elements -->
                        <div class="countdown-item col days">
                            <span>
                                <h2 id="days" class="text-light text-center"></h2>
                                <h4 class="text-light text-center">Hari</h4>
                            </span>
                        </div>
                        <!-- Repeat for hours, minutes, seconds -->
                    </div>
                </div>
            </div>

            @if(isset($informasiacara) && $informasiacara->livestream)
            <!-- Live Streaming Section -->
            <h2 id="liveStreamingText" class="text-center">Live Streaming</h2>
            <h4 id="liveStreamingSubText" class="text-center">Tak semua bisa hadir secara fisik di hari
                pernikahan kami, tapi Anda masih bisa ikut merayakan lewat livestreaming.</h4>
            <iframe style="opacity: 0;" class="d-block mx-auto mb-5 liveStreamingVid" width="560"
                height="315"
                src="{{ $informasiacara->livestream ?? 'https://www.youtube.com/embed/jfKfPfyJRdk?si=EbCkkUA-HuNzEAUs' }}"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
            @endif

            <!-- Event Details -->
            <div class="event-detail-box">
                <h1 id="wedding-day-text-sec4" class="text-center text-light">Wedding Day</h1>
                <h1 id="wedding-days-text-sec4" class="text-center text-light">
                    {{ $afterConvertDay ?? 'Saturday' }}
                </h1>
                <h3 style="color: #EBB760 !important;" id="wedding-date-text-sec4" class="text-center mb-5">
                    {{ $tanggalAcara ?? date('d F Y') }}
                </h3>

                <div class="row my-4 mb-5">
                    <!-- Wedding Ceremony -->
                    <div class="col-md">
                        <h3 id="akad-nikah-event-text" class="text-center text-light">Akad Nikah</h3>
                        <h3 style="color: #EBB760 !important;" id="event-time-text"
                            class="text-center event-time-text">
                            {{ $informasiacara->jamakadnikah ?? '08.00' }} - Selesai
                        </h3>
                        <h2 id="event-location-text" class="text-center text-light w-75 d-block mx-auto">
                            {{ $informasiacara->lokasiakadnikah ?? 'Venue to be announced' }}
                        </h2>
                        <a href="{{ $informasiacara->googlemapspernikahan ?? '#' }}"
                            style="font-family: 'Playball', serif; opacity: 0; font-size: 2.4vh; color: #EBB760 !important; border: 0.5vh solid #EBB760;"
                            class="viewMapButton viewMapButtonAkadNikah btn bg-transparent mt-4 fw-semibold w-50 d-block mx-auto">View
                            Map</a>
                    </div>

                    <!-- Reception (only shown if location exists) -->
                    @if(isset($informasiacara) && $informasiacara->lokasiresepsi)
                    <div class="col-md">
                        <h3 id="resepsi-event-text" class="text-center text-light">Resepsi</h3>
                        <h3 style="color: #EBB760 !important;" id="event-time-text"
                            class="text-center event-time-text">
                            {{ $informasiacara->jamresepsi ?? '11.00' }} - Selesai
                        </h3>
                        <h2 id="event-location-text" class="text-center text-light w-75 d-block mx-auto">
                            {{ $informasiacara->lokasiresepsi }}
                        </h2>
                        <a href="{{ $informasiacara->googlemapsresepsi ?? '#' }}"
                            style="font-family: 'Playball', serif; opacity: 0; font-size: 2.4vh; color: #EBB760 !important; border: 0.5vh solid #EBB760;"
                            class="viewMapButton btn bg-transparent mt-4 fw-semibold w-50 d-block mx-auto">View
                            Map</a>
                    </div>
                    @endif
                </div>

                <!-- Health Protocol Section -->
                @if(isset($protokol) && $protokol != null)
                <div class="health-protocol">
                    <h1 id="health-protocol-text-sec4" class="text-center text-light mb-5">Protokol Kesehatan</h1>
                    <!-- Protocol cards -->
                </div>
                @endif
            </div>
        </div>

        <!-- Gallery Section -->
        @if(isset($galeri) && count($galeri) > 0)
        <div class="couple-gallery px-5">
            <h1 id="coupleGalleryText" class="text-center mb-5">Our Gallery</h1>
            <div class="container-fluid">
                <div class="row">
                    <!-- Gallery images with null checks -->
                    @foreach($galeri as $index => $item)
                        @if($index < 8) <!-- Limit to 8 images -->
                        <div class="column">
                            <img src="{{ asset('images/galeri/' . $item->foto) }}" alt="Gallery Image {{ $index+1 }}">
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Love Story Section -->
        @if(isset($ceritacinta))
        <div class="couple-stories m-0">
            <h1 style="padding: 3.5% 0;" id="love-story-text-sec6" class="text-center text-light">Love Story</h1>
            
            @if($ceritacinta->cover1)
            <!-- Story Part 1 -->
            <div class="d-flex align-items-center justify-content-center" style="margin-bottom: 5%;">
                <div id="coupleStory1" class="row w-75">
                    <div class="col-md">
                        <img style="width: 432.38px; height: 288.83px; opacity: 0;" id="coupleStoryImage1"
                            class="d-block mx-auto rounded"
                            src="{{ asset('images/ceritacinta/' . $ceritacinta->cover1) }}"
                            alt="Love Story Part 1">
                    </div>
                    <div class="col-md">
                        <h2 id="love-story-head-sec6" class="coupleStoryHeading1"
                            style="color: #EBB760 !important;">
                            {{ $ceritacinta->judulcerita1 ?? 'Our First Meeting' }}
                        </h2>
                        <hr style="width: 0; background-color: #EBB760 !important; color: #EBB760 !important; border: 0.3vh solid #EBB760 !important;"
                            class="rounded coupleStoryLine1">
                        <p id="love-story-desc-sec6" class="text-light loveStory1">
                            {{ $ceritacinta->cerita1 ?? 'The story of how we first met...' }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Repeat for other story parts with null checks -->
        </div>
        @endif

        <!-- Pre-Wedding Video Section -->
        @if(isset($prewed))
        <div class="coupleFootage">
            <h1 style="color: #EBB760 !important; font-family: 'Playball', serif; opacity: 0;" id="footageText"
                class="text-center mb-5">Our Footage</h1>
            <div class="row">
                <div class="col-md">
                    <video width="560" height="315" id="footageVideo" class="d-block mx-auto mb-5"
                        controls>
                        <source src="{{ asset('video/prewedding/' . $prewed->vidio) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
        @endif

        <!-- Gift and Wishes Section -->
        <div class="digiEnve">
            <!-- Wedding Gift Section -->
            @if(isset($amplopdigital))
            <div class="amdg">
                <h1 style="color: #EBB760 !important; opacity: 6;" id="wedding-gift-text-sec7" class="text-center">
                    Wedding Gift</h1>
                <h5 id="wedding-gift-subtext-sec7" class="text-center text-light w-75 d-block mx-auto">
                    Berkat dan kedatangan Anda ke pernikahan kami sudah cukup bagi kami.
                </h5>
                <div style="padding: 4% 0;" class="d-flex align-items-center justify-content-center">
                    <div class="row d-block mx-auto weddingGiftWrappersz">
                        <div style="opacity: 0;" id="paymentSelection" class="col-md mb-5">
                            <label class="form-label text-light">Pilih Bank</label>
                            <select class="form-select form-select mb-3 text-light bg-dark border-0"
                                aria-label="Large select example">
                                <option class="text-light" selected>
                                    {{ $amplopdigital->paymentvendor ?? 'Bank Transfer' }}
                                </option>
                            </select>
                            <h3 style="font-family: 'Playball', serif; font-size: 2.8vh;" class="text-light">
                                Account Number: {{ $amplopdigital->noakun ?? '1234567890' }}
                            </h3>
                            <h3 style="font-family: 'Playball', serif; font-size: 2.8vh;" class="text-light">
                                Account Name: {{ $amplopdigital->namaakun ?? 'Bride & Groom' }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- RSVP Section -->
            @if(isset($kodeTamu))
            <div class="rsvp">
                <div class="rsvpWrapper">
                    <input type="hidden" name="kdtamu" id="kdtamu"
                    value="{{ $kodeTamu->kode_tamu ?? null }}">
                    <h1 class="rsvpHeadingText">RSVP</h1>
                    <h1 class="rsvpSubHeadingText">Please let us know if you can attend</h1>
                    <!-- RSVP form elements -->
                </div>
            </div>
            @endif

            <!-- Wedding Wishes Section -->
            <div class="d-flex align-items-center justify-content-center">
                <div class="row w-75 weddingWishContainer">
                    <div class="col-md">
                        <div style="padding-bottom: 6%; opacity: 0;" class="weddingWish">
                            <h1 id="wedding-wish-text-sec7" class="text-center text-light mb-3">Wedding Wish</h1>
                            <!-- Wish form elements -->
                        </div>
                    </div>
                    <div class="col-md mb-4">
                        <h1 style="opacity: 0;" id="weddingWishTextSec7" class="text-center text-light mb-3">
                            Latest Wedding Wishes</h1>
                        <div class="weddingWishLogWrapper">
                            <div class="weddingWishLog">
                                <!-- Wishes will be loaded via AJAX -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Closing Section -->
            <div class="coupleQuote mt-4">
                <h3 id="couple-quote-sec7" class="text-light text-center mt-5">
                    Thank you for being part of our special day
                </h3>
                <h3 style="color: #EBB760 !important;" id="coupleName">
                    {{ $mempelai->namalaki ?? 'Groom' }} & {{ $mempelai->namaperempuan ?? 'Bride' }}
                </h3>
                <h3 id="coupleWeddingDate">{{ $tanggalAcara ?? date('d F Y') }}</h3>
            </div>

            <!-- Footer -->
            <div class="licensePart">
                <h3 id="licenseText">Powered By Cukurukuk</h3>
            </div>
        </div>

        <!-- Music Player -->
        <section style="position: fixed; bottom: 0; left: 0; z-index: 9999;" class="music-outer">
            <img class="music-box" src="/tema1/img/musicPlayer.png" alt="Music Player">
        </section>
        <audio id="musicPlayer" class="d-none"
            src="{{ isset($musik) && isset($musik->musikMaster) ? asset('musik/' . $musik->musikMaster->musik) : '/tema1/music/sample-music.mp3' }}">
        </audio>
    </div>

    <!-- Scripts -->
    <script src="/tema1/jquery/jquery-3.6.3.min.js"></script>
    <script src="https://unpkg.com/gsap@3.9.0/dist/gsap.min.js"></script>
    <script src="/tema1/js/index.js"></script>
    <script src="/assets/vendors/jquery-toast-plugin-master/src/jquery.toast.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize functions
        ucapanUndangan();

        // Handle wish submission
        $('#kirim-ucapan').on('click', function(e) {
            e.preventDefault();
            const id = $('#user_id').val();
            const nama = $('#nama-ucapan').val();
            const ucapan = $('#pesan-ucapan').val();

            if (nama && ucapan) {
                $.ajax({
                    url: `{{ route('ucapan.store', ['id' => ':id']) }}`.replace(':id', id),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { nama: nama, ucapan: ucapan },
                    success: function(data) {
                        if (data.code === 1) {
                            ucapanUndangan();
                            $('#nama-ucapan').val('');
                            $('#pesan-ucapan').val('');
                            $.toast({
                                heading: 'Success',
                                text: 'Your wish has been submitted',
                                position: 'top-right',
                                icon: 'success'
                            });
                        }
                    },
                    error: function(res) {
                        console.error('Error:', res.responseText);
                    }
                });
            } else {
                $.toast({
                    heading: 'Error',
                    text: 'Please fill all fields',
                    position: 'top-right',
                    icon: 'error'
                });
            }
        });

        // Handle RSVP submission
        $('#kirim-rsvp').on('click', function(e) {
            e.preventDefault();
            const id = $('#user_id').val();
            const kodetamu = $('#kdtamu').val();
            const jumlahtamu = $('#qty').val();

            if (kodetamu && jumlahtamu > 0) {
                $.ajax({
                    url: `{{ route('rsvp.store', ['id' => ':id']) }}`.replace(':id', id),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { kodetamu: kodetamu, jumlahtamu: jumlahtamu },
                    success: function(data) {
                        if (data.code === 1) {
                            $.toast({
                                heading: 'Success',
                                text: 'RSVP updated successfully',
                                position: 'top-right',
                                icon: 'success'
                            });
                        }
                    },
                    error: function(res) {
                        console.error('Error:', res.responseText);
                    }
                });
            } else {
                $.toast({
                    heading: 'Error',
                    text: 'Please select attendance and at least 1 guest',
                    position: 'top-right',
                    icon: 'error'
                });
            }
        });
    });

    // Function to load wishes
    function ucapanUndangan() {
        const id = $('#user_id').val();
        if (!id) return;

        $.ajax({
            url: `{{ route('ucapan.show', ['id' => ':id']) }}`.replace(':id', id),
            type: 'GET',
            success: function(res) {
                const weddingLog = $('.weddingWishLog');
                weddingLog.html('');
                
                if (res.ucapan && res.ucapan.length > 0) {
                    res.ucapan.forEach(item => {
                        const wishHtml = `
                            <div class="wishMessage p-3">
                                <h2 class="text-light">${item.nama || 'Guest'}</h2>
                                <h3 class="text-light">${item.ucapan || 'Best wishes'}</h3>
                                <h4>${item.created_at || ''}</h4>
                                <hr class="bg-light border-light border-3 rounded w-75 float-start pt-0 my-0">
                            </div>`;
                        weddingLog.append(wishHtml);
                    });
                } else {
                    weddingLog.html('<p class="text-light text-center">No wishes yet</p>');
                }
            },
            error: function(res) {
                console.error('Error loading wishes:', res.responseText);
            }
        });
    }
    </script>
</body>
</html>