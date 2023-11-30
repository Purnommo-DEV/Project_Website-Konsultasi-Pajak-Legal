<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananSatuan_Child2 extends Model
{
    use HasFactory;
    protected $table = 'layanan_satuan_child_2';
    protected $guarded = ['id'];

    public function relasI_layanan_satuan_child_1()
    {
        return $this->belongsTo(LayananSatuan_Child1::class, 'layanan_satuan_child_1_id', 'id');
    }
}
