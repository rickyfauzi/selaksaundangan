<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiturUndangan extends Model
{
    use HasFactory;
    protected $table = 'fitur_undangan'; // Opsional, tapi baik untuk kejelasan
    protected $fillable = ['user_id', 'nama_fitur', 'is_active'];
}
