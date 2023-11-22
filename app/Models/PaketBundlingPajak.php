<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketBundlingPajak extends Model
{
    use HasFactory;
    protected $table = 'p_b_pajak';
    protected $guarded = ['id'];
}
