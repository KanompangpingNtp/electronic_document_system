<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\ReplyForm;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;

class ShowinformationController extends Controller
{
    //
    public function showinformationIndex()
    {
        $forms = Form::with(['user', 'replyforms'])->get(); // เพิ่ม 'replyform' เพื่อดึงข้อมูลตอบกลับ

        return view('admin_show_information.admin_show_information', compact('forms'));
    }

    public function showinformationEdit($id)
    {
        // ค้นหาฟอร์มโดย ID
        $form = Form::findOrFail($id);
        return view('admin_show_information.admin_show_information_edit', compact('form'));
    }

    public function showinformationUser()
    {
        // ดึงข้อมูลแบบฟอร์มเฉพาะของผู้ใช้ที่เข้าสู่ระบบ
        $forms = Form::with(['user', 'replyforms'])
                    ->where('user_id', Auth::id()) // กรองเฉพาะแบบฟอร์มของผู้ใช้ที่เข้าสู่ระบบ
                    ->get();

        return view('users_account_form_follow.users_account_form_follow', compact('forms'));
    }


    public function exportPDF($id)
    {
        $form = Form::find($id);
        if (!$form) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลฟอร์ม');
        }

        // กำหนด Options สำหรับ Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // สร้าง instance ของ Dompdf
        $dompdf = new Dompdf($options);

        // โหลด view ที่ต้องการสร้าง PDF
        $html = view('admin_show_information.admin_show_information_pdf', compact('form'))->render();

        // โหลด HTML ลงใน Dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // ส่งไฟล์ PDF ไปยังเบราว์เซอร์
        return $dompdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf');
    }
}
