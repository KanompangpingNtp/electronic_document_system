<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // ความสัมพันธ์กับฟอร์ม
    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
