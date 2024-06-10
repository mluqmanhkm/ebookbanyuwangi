<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahBaca extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_ebook',
    ];
    
    public function ebook()
    {
        return $this->belongsTo(Ebook::class, 'id_ebook');
    }
}
