<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'file_path'];

    // ความสัมพันธ์กับฟอร์ม
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
