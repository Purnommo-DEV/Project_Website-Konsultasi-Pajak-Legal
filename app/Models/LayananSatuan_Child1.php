<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananSatuan_Child1 extends Model
{
    use HasFactory;
    protected $table = 'layanan_satuan_child_1';
    protected $guarded = ['id'];

    public function relasI_layanan_satuan()
    {
        return $this->belongsTo(LayananSatuan::class, 'layanan_satuan_id', 'id');
    }
}
