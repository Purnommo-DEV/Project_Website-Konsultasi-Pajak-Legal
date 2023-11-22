<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketBundlingPajak_Child2 extends Model
{
    use HasFactory;
    protected $table = 'p_b_pajak_child_2';
    protected $guarded = ['id'];

    public function relasi_pb_pajak_child1()
    {
        return $this->belongsTo(PaketBundlingPajak_Child1::class, 'p_b_pajak_child_1_id');
    }
}
