<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketPajak extends Model
{
    use HasFactory;

    protected $table = 'p_pajak';
    protected $guarded = ['id'];
}
