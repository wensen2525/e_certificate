<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BOM30th extends Model
{
    use HasFactory;

    protected $table = 'bom30ths';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
}
