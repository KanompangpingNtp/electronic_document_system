<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'day', // เพิ่ม field วัน
        'month', // เพิ่ม field เดือน
        'year', // เพิ่ม field ปี
        'location', // ใช้ location จาก writeAt
        'salutation', // เพิ่ม field คำนำหน้า
        'fullname',
        'age',
        'occupation',
        'house_no', // เปลี่ยนจาก address เป็น house_no
        'village_no', // เพิ่ม field หมู่ที่
        'alley',
        'road',
        'sub_district', // เพิ่ม field แขวง/ตำบล
        'district',
        'province',
        'phone',
        'submission_name',
        'submission', // ใช้ submission จาก complaintDetails
        'document_count', // จำนวนเอกสาร
        'status', // เพิ่ม field สถานะ
    ];


    // ความสัมพันธ์กับผู้ใช้
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ความสัมพันธ์กับไฟล์แนบ (ฟอร์มหนึ่งมีไฟล์แนบหลายไฟล์)
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    // public function replyform()
    // {
    //     return $this->hasMany(Replyform::class);
    // }
    // ความสัมพันธ์กับการตอบกลับ (ฟอร์มหนึ่งมีหลายการตอบกลับ)
    public function replyforms()
    {
        return $this->hasMany(ReplyForm::class);
    }
}
