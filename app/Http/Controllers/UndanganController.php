<?php

namespace App\Http\Controllers;

use App\Models\AmplopDigitalModel;
use App\Models\BukuTamuModel;
use App\Models\CeritaCintaModel;
use App\Models\FiturUndangan;
use App\Models\GaleriModel;
use App\Models\InformasiAcaraModel;
use App\Models\InstagramFilterModel;
use App\Models\MempelaiModel;
use App\Models\MusikTransaksiModel;
use App\Models\OrderModel;
use App\Models\PaketModel;
use App\Models\PaymentVendorModel;
use App\Models\ProtokolModel;
use App\Models\QuotesModel;
use App\Models\TemaTransaksiModel;
use App\Models\UcapanModel;
use App\Models\VidioModel;
use App\Models\VisitorModel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class UndanganController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $idUser = $user->id;

        // === LOGIKA BARU: Ambil fitur yang aktif untuk customer ini ===
        $fiturAktif = FiturUndangan::where('user_id', $idUser)
            ->where('is_active', true)
            ->pluck('nama_fitur')
            ->toArray();

        // Fallback: Jika admin belum mengatur fitur untuk user ini, anggap semua fitur aktif.
        if (!FiturUndangan::where('user_id', $idUser)->exists()) {
            $fiturAktif = [
                'tema',
                'musik',
                'galeri',
                'mempelai',
                'informasi_acara',
                'video_prewedd',
                'cerita_cinta',
                'quotes',
                'buku_tamu',
                'amplop_digital',
                'protokol',
                'rsvp'
            ];
        }
        // === AKHIR LOGIKA BARU ===

        // Data yang sudah ada sebelumnya
        $data = ProtokolModel::where('user_id', $idUser)->first();
        $order = OrderModel::where('user_id', $idUser)->first();
        $mempelai = MempelaiModel::where('user_id', $idUser)->first();
        $paymentvendor = PaymentVendorModel::all();
        $pvcustomer = AmplopDigitalModel::where('user_id', $idUser)->first();

        // Kirim semua data, TERMASUK '$fiturAktif' ke view
        return view('undangan.index', compact('data', 'mempelai', 'paymentvendor', 'pvcustomer', 'order', 'fiturAktif'));
    }

    public function protokolStore(Request $request)
    {
        $user = Auth::user();
        $idUser = $user->id;

        $checkData = ProtokolModel::where('user_id', $idUser)->first();

        if ($checkData != null) {
            $query = ProtokolModel::where('user_id', $idUser)->update([
                'is_protokol' => $request->protocol,
            ]);

            $codeResponse = 1;

            if ($request->protocol == 0) {
                $codeResponse = 2;
            }

            if ($query) {
                return response()->json(['code' => $codeResponse]);
            } else {
                return response()->json(['code' => 0]);
            }
        } else {
            $query = ProtokolModel::create([
                'user_id' => $idUser,
                'is_protokol' => $request->protocol,
            ]);

            if ($query) {
                return response()->json(['code' => 1]);
            } else {
                return response()->json(['code' => 0]);
            }
        }
    }

    public function domainUpdate(Request $request)
    {
        $user = Auth::user();
        $idUser = $user->id;
        $checkData = OrderModel::where('user_id', $idUser)->first();

        if ($checkData != null) {
            $query = OrderModel::where('user_id', $idUser)->update(['domain' => $request->domain]);
            if ($query) {
                return response()->json(['code' => 1]);
            } else {
                return response()->json(['code' => 0]);
            }
        }
    }

    public function publikasiStore(Request $request)
    {
        $user = Auth::user();
        $idUser = $user->id;

        $checkData = OrderModel::where('user_id', $idUser)->first();

        if ($checkData != null) {
            $query = OrderModel::where('user_id', $idUser)->update([
                'status' => $request->publikasi,
            ]);

            $codeResponse = 1;

            if ($request->publikasi == 0) {
                $codeResponse = 2;
            }

            if ($query) {
                return response()->json(['code' => $codeResponse]);
            } else {
                return response()->json(['code' => 0]);
            }
        }
    }

    public function undanganShow(Request $request, $domain)
    {
        $getUser = OrderModel::where('domain', $domain)->first();

        // Pengecekan Keamanan: Jika domain tidak ditemukan atau tidak ada data user, tampilkan 404
        if (!$getUser) {
            abort(404);
        }

        if ($getUser->status != '0') {

            $getIP = geoip()->getLocation($_SERVER['REMOTE_ADDR']);

            $checkIp = VisitorModel::where('user_id', $getUser->user_id)->where('alamatip', $getIP->ip)->first();

            if ($checkIp === null) {
                VisitorModel::create([
                    'user_id' => $getUser->user_id,
                    'alamatip' => $getIP->ip
                ]);
            }

            // BARU: Ambil daftar fitur yang aktif untuk undangan ini
            $fiturAktif = \App\Models\FiturUndangan::where('user_id', $getUser->user_id)
                ->where('is_active', true)
                ->pluck('nama_fitur')
                ->toArray();

            // BARU: Fallback jika admin belum mengatur fitur, anggap semua aktif
            if (!\App\Models\FiturUndangan::where('user_id', $getUser->user_id)->exists()) {
                $fiturAktif = ['galeri', 'cerita_cinta', 'amplop_digital', 'protokol', 'video_prewedd', 'quotes', 'buku_tamu', 'rsvp', 'wedding_filter'];
            }

            //Tema (Wajib, tidak perlu if)
            $tema = TemaTransaksiModel::where('user_id', $getUser->user_id)->with('temaMaster')->first();

            //Musik (Wajib, tidak perlu if)
            $musik = MusikTransaksiModel::where('user_id', $getUser->user_id)->with('musikMaster')->first();

            //Mempelai (Wajib, tidak perlu if)  
            $mempelai = MempelaiModel::where('user_id', $getUser->user_id)->first();

            // Pengecekan Keamanan Data Inti
            if (!$tema || !$mempelai) {
                return response("Data undangan inti belum lengkap.", 404);
            }

            // BARU: Inisialisasi semua variabel fitur opsional ke null/kosong
            $quotes = null;
            $informasiacara = null;
            $galeri = collect();
            $count = 0;
            $ceritacinta = null;
            $amplopdigital = null;
            $protokol = null;
            $prewed = null;
            $weddingfilter = null;
            $tanggalAcara = null;
            $oriTanggalAcara = null;
            $afterConvertDay = null;


            // BARU: Bungkus query dengan pengecekan fitur
            if (in_array('quotes', $fiturAktif)) {
                $quotes = QuotesModel::where('user_id', $getUser->user_id)->first();
            }

            //Informasi Acara dan Logika Tanggal (Dianggap sebagai satu fitur)
            $informasiacara = InformasiAcaraModel::where('user_id', $getUser->user_id)->first();
            if ($informasiacara) {
                // Kode tanggal Anda yang sudah ada, tidak diubah
                $tanggalPernikahan = $informasiacara->tanggalpernikahan;
                $datetime = new DateTime($tanggalPernikahan);
                $oriTanggalAcara = $datetime->format('Y-m-d');
                $day = Carbon::instance($datetime)->locale('id')->format('l');
                $convertDay = [
                    'Sunday' => 'Minggu',
                    'Monday' => 'Senin',
                    'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis',
                    'Friday' => 'Jumat',
                    'Saturday' => 'Sabtu',
                ];
                $convertMonth = [
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember',
                ];
                $afterConvertDay = $convertDay[$day];
                $day = $datetime->format('d');
                $month = $datetime->format('m');
                $year = $datetime->format('Y');
                $afterConvertMonth = $convertMonth[$month];
                $tanggalAcara =  $day . ' ' . $afterConvertMonth . ' ' . $year;
            }

            // BARU: Bungkus query dengan pengecekan fitur
            if (in_array('galeri', $fiturAktif)) {
                $galeri = GaleriModel::where('user_id', $getUser->user_id)->get();
                $count = $galeri->count();
            }

            // BARU: Bungkus query dengan pengecekan fitur
            if (in_array('cerita_cinta', $fiturAktif)) {
                $ceritacinta = CeritaCintaModel::where('user_id', $getUser->user_id)->first();
            }

            // BARU: Bungkus query dengan pengecekan fitur
            if (in_array('amplop_digital', $fiturAktif)) {
                $amplopdigital = AmplopDigitalModel::where('user_id', $getUser->user_id)->first();
            }

            //Nama Tamu (Tidak diubah)
            $kodeTamu = null;
            $namaTamu = 'Tamu Undangan';
            if ($request->to != null) {
                $namaTamu = str_replace(['+', '_'], ' ', $request->to);
                $kodeTamu = BukuTamuModel::where('nama', $namaTamu)->where('user_id', $getUser->user_id)->first();
            }

            // BARU: Bungkus query dengan pengecekan fitur
            if (in_array('protokol', $fiturAktif)) {
                $protokol = ProtokolModel::where('user_id', $getUser->user_id)->where('is_protokol', '1')->first();
            }

            // BARU: Bungkus query dengan pengecekan fitur
            if (in_array('video_prewedd', $fiturAktif)) {
                $prewed = VidioModel::where('user_id', $getUser->user_id)->first();
            }

            // BARU: Bungkus query dengan pengecekan fitur
            if (in_array('wedding_filter', $fiturAktif)) {
                $weddingfilter = InstagramFilterModel::where('user_id', $getUser->user_id)->first();
            }

            // BARU: Kirim $fiturAktif ke view
            return view($tema->temaMaster->url_tema, compact(
                'getUser',
                'namaTamu',
                'mempelai',
                'quotes',
                'informasiacara',
                'afterConvertDay',
                'tanggalAcara',
                'oriTanggalAcara',
                'galeri',
                'count',
                'ceritacinta',
                'amplopdigital',
                'protokol',
                'prewed',
                'weddingfilter',
                'musik',
                'kodeTamu',
                'fiturAktif' // <--- Tambahan
            ));
        } else {
            return view('errors.404');
        }
    }

    public function ucapanShow($id)
    {
        $ucapan = UcapanModel::where('user_id', $id)->get();
        $profile = InformasiAcaraModel::where('user_id', $id)->get();

        return response()->json(compact('ucapan', 'profile'));
    }

    public function ucapanStore(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ucapan' => 'required|string',
            'attendance' => ['required', Rule::in(['hadir', 'tidak-hadir', 'ragu'])],
        ]);

        $query = UcapanModel::create([
            'user_id' => $id,
            'nama' => $request->nama,
            'ucapan' => $request->ucapan,
            'attendance' => $request->attendance,
        ]);

        if ($query) {
            return response()->json(['code' => 1]);
        } else {
            return response()->json(['code' => 0]);
        }
    }

    public function rsvpStore(Request $request, $id)
    {
        $query = BukuTamuModel::where('kode_tamu', $request->kodetamu)->update([
            'kode_tamu' => $request->kodetamu,
            'jumlahkehadiran' => $request->jumlahtamu,
            'status' => 'Hadir'
        ]);

        if ($query) {
            return response()->json(['code' => 1]);
        } else {
            return response()->json(['code' => 0]);
        }
    }
}
