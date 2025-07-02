<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\FiturUndangan;
use App\Models\User;
use Illuminate\Http\Request;

class FiturController extends Controller
{
    protected $fiturList = [
        // Fitur Utama & Wajib (biasanya selalu aktif)
        'tema',
        'musik',
        'mempelai',
        'informasi_acara',  // <-- BARIS INI YANG DITAMBAHKAN

        // Fitur Tambahan (bisa di on/off)
        'galeri',
        'cerita_cinta',
        'amplop_digital',
        'protokol',
        'video_prewedd',
        'quotes',
        'buku_tamu',
        'rsvp',
        'wedding_filter',
    ];


    public function edit(User $user)
    {
        // Ambil pengaturan fitur yang sudah ada dari DB
        $currentFitur = FiturUndangan::where('user_id', $user->id)
            ->pluck('is_active', 'nama_fitur');

        return view('administrator.fitur', [
            'user' => $user,
            'fiturList' => $this->fiturList,
            'currentFitur' => $currentFitur
        ]);
    }

    public function update(Request $request, User $user)
    {
        foreach ($this->fiturList as $fitur) {
            FiturUndangan::updateOrCreate(
                ['user_id' => $user->id, 'nama_fitur' => $fitur],
                ['is_active' => $request->has($fitur)] // Cek apakah checkbox dicentang
            );
        }

        return redirect()->back()->with('success', 'Pengaturan fitur berhasil diperbarui!');
    }
}
