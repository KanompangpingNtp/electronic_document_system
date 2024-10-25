<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'message',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

}
