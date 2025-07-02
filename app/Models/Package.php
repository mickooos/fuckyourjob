<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'unit',
        'pengirim',
        'penerima',
        'deskripsi',
        'kategori',
        'posisi',
        'kurir',
        'catatan',
        'taken_by',
        'dateandtime_taken',
        'petugas'
    ];

    protected $casts = [
        'dateandtime_taken' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'unit', 'no_unit');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'posisi', 'id');
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'kurir', 'id');
    }

    public function handler()
    {
        return $this->belongsTo(Handler::class, 'petugas', 'id');
    }
}

