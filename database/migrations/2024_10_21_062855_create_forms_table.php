<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('location'); // เขียนที่
            $table->string('salutation'); // คำนำหน้า (เพิ่มคอลัมน์นี้)
            $table->string('fullname'); // ชื่อ - สกุล
            $table->integer('age'); // อายุ
            $table->string('occupation'); // อาชีพ
            $table->string('house_no'); // บ้านเลขที่
            $table->string('village_no')->nullable(); // หมู่ที่
            $table->string('alley')->nullable(); // ตรอก/ซอย
            $table->string('road')->nullable(); // ถนน
            $table->string('sub_district'); // แขวง/ตำบล
            $table->string('district'); // เขต/อำเภอ
            $table->string('province'); // จังหวัด
            $table->string('phone'); // โทรศัพท์
            $table->string('submission_name');//ชื่อหัวเรื่อง
            $table->text('submission'); // ขอยื่นคำร้อง
            $table->integer('document_count')->default(0); // จำนวนเอกสาร
            $table->integer('day'); // วัน
            $table->integer('month'); // เดือน
            $table->integer('year'); // ปี
            $table->string('status')->default(1); // เพิ่มคอลัมน์ status และตั้งค่าเริ่มต้นเป็น 1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
