<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketBundlingPajak_Child3 extends Model
{
    use HasFactory;
    protected $table = 'p_b_pajak_child_3';
    protected $guarded = ['id'];

    public function relasi_pb_pajak_child2()
    {
        return $this->belongsTo(PaketBundlingPajak_Child2::class, 'p_b_pajak_child_2_id', 'id');
    }

    public function relasi_pajak()
    {
        return $this->belongsTo(PaketPajak::class, 'p_pajak_id', 'id');
    }
}
