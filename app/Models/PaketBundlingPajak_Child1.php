<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketBundlingPajak_Child1 extends Model
{
    use HasFactory;
    protected $table = 'p_b_pajak_child_1';
    protected $guarded = ['id'];

    public function relasi_pb_pajak()
    {
        return $this->belongsTo(PaketBundlingPajak::class, 'p_b_pajak_id');
    }
}
