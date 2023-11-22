<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketNotaris_Child1 extends Model
{
    use HasFactory;
    protected $table = 'p_pel_notaris_child_1';
    protected $guarded = ['id'];

    public function relasi_pb_pajak_child2()
    {
        return $this->belongsTo(PaketNotaris::class, 'p_pel_notaris_id', 'id');
    }
}
