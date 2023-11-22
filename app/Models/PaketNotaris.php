<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketNotaris extends Model
{
    use HasFactory;
    protected $table = 'p_pel_notaris';
    protected $guarded = ['id'];
}
