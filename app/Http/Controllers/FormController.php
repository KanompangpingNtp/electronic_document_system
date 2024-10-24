<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\ReplyForm;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;


class FormController extends Controller
{
    //
    public function userForms()
    {
        // $statuses = Status::all();
        // return view('ีusers_form.users_form', compact('statuses'));
        return view('users.users_form');
    }

    public function userAccount()
    {
        $user = Auth::user(); // รับข้อมูลผู้ใช้ที่ล็อกอิน
        return view('users_account.users_account_index', compact('user'));
    }

    public function formsCreate(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'day' => 'required|integer|between:1,31',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer',
            'writeAt' => 'required|string|max:255',
            'salutation' => 'required|string',
            'fullname' => 'required|string|max:255',
            'age' => 'required|integer',
            'occupation' => 'required|string|max:255',
            'houseNo' => 'required|string|max:255',
            'villageNo' => 'nullable|string|max:255',
            'alley' => 'nullable|string|max:255',
            'road' => 'nullable|string|max:255',
            'subDistrict' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'complaintName' => 'required|string|max:255',
            'complaintDetails' => 'required|string',
            'documentNumber' => 'required|integer',
            // 'fileUpload' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png|max:2048',
            'fileUpload.*' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png|max:2048', // ใช้ .* เพื่อรองรับไฟล์หลายไฟล์
        ]);

        // $filePath = null;
        // if ($request->hasFile('fileUpload')) {
        //     // Define the file name and path
        //     $filePath = $request->file('fileUpload')->storeAs('files', $request->file('fileUpload')->getClientOriginalName(), 'public');
        // }

        // Create a new form entry
        $form = Form::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'status' => 1,
            'day' => $validatedData['day'],
            'month' => $validatedData['month'],
            'year' => $validatedData['year'],
            'location' => $validatedData['writeAt'],
            'salutation' => $validatedData['salutation'],
            'fullname' => $validatedData['fullname'],
            'age' => $validatedData['age'],
            'occupation' => $validatedData['occupation'],
            'house_no' => $validatedData['houseNo'],
            'village_no' => $validatedData['villageNo'],
            'alley' => $validatedData['alley'],
            'road' => $validatedData['road'],
            'sub_district' => $validatedData['subDistrict'],
            'district' => $validatedData['district'],
            'province' => $validatedData['province'],
            'phone' => $validatedData['phone'],
            'submission_name' => $validatedData['complaintName'],
            'submission' => $validatedData['complaintDetails'],
            'document_count' => $validatedData['documentNumber'],
        ]);

        // if ($filePath) {
        //     Attachment::create([
        //         'form_id' => $form->id,
        //         'file_path' => 'storage/files/' . $request->file('fileUpload')->getClientOriginalName(), // Store the path in the database
        //     ]);
        // }

        // Handle file uploads
        if ($request->hasFile('fileUpload')) {
            foreach ($request->file('fileUpload') as $file) {
                if ($file) {
                    $filePath = $file->storeAs('files', $file->getClientOriginalName(), 'public');

                    Attachment::create([
                        'form_id' => $form->id,
                        'file_path' => 'storage/files/' . $file->getClientOriginalName(), // Store the path in the database
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกส่งสำเร็จ');
    }

    public function formsEdit(Request $request, $id)
    {
        // ค้นหาฟอร์มที่ต้องการอัปเดต
        $form = Form::findOrFail($id);

        // ตรวจสอบความถูกต้องของข้อมูลฟอร์ม
        $validatedData = $request->validate([
            'day' => 'required|integer|between:1,31',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer',
            'writeAt' => 'required|string|max:255',
            'salutation' => 'required|string',
            'fullname' => 'required|string|max:255',
            'age' => 'required|integer',
            'occupation' => 'required|string|max:255',
            'houseNo' => 'required|string|max:255',
            'villageNo' => 'nullable|string|max:255',
            'alley' => 'nullable|string|max:255',
            'road' => 'nullable|string|max:255',
            'subDistrict' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'complaintName' => 'required|string|max:255',
            'complaintDetails' => 'required|string',
            'documentNumber' => 'required|integer',
            // 'fileUpload' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png|max:2048',
            'fileUpload.*' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png|max:2048', // รองรับหลายไฟล์
        ]);

        // // จัดการการอัปโหลดไฟล์ถ้ามีการอัปโหลดไฟล์ใหม่
        // if ($request->hasFile('fileUpload')) {
        //     // ลบการแนบไฟล์เก่าก่อนที่จะอัปโหลดไฟล์ใหม่ (optional)
        //     $existingAttachment = Attachment::where('form_id', $form->id)->first();
        //     if ($existingAttachment) {
        //         Storage::disk('public')->delete($existingAttachment->file_path);
        //         $existingAttachment->delete();
        //     }

        //     // จัดเก็บไฟล์ใหม่
        //     $filePath = $request->file('fileUpload')->storeAs('files', uniqid() . '_' . $request->file('fileUpload')->getClientOriginalName(), 'public');

        //     // สร้างบันทึกการแนบใหม่
        //     Attachment::create([
        //         'form_id' => $form->id,
        //         'file_path' => 'storage/' . $filePath,
        //     ]);
        // }

        // อัปเดตข้อมูลฟอร์ม
        $form->update([
            'day' => $validatedData['day'],
            'month' => $validatedData['month'],
            'year' => $validatedData['year'],
            'location' => $validatedData['writeAt'],
            'salutation' => $validatedData['salutation'],
            'fullname' => $validatedData['fullname'],
            'age' => $validatedData['age'],
            'occupation' => $validatedData['occupation'],
            'house_no' => $validatedData['houseNo'],
            'village_no' => $validatedData['villageNo'],
            'alley' => $validatedData['alley'],
            'road' => $validatedData['road'],
            'sub_district' => $validatedData['subDistrict'],
            'district' => $validatedData['district'],
            'province' => $validatedData['province'],
            'phone' => $validatedData['phone'],
            'submission_name' => $validatedData['complaintName'],
            'submission' => $validatedData['complaintDetails'],
            'document_count' => $validatedData['documentNumber'],
        ]);

        // จัดการการอัปโหลดไฟล์ถ้ามีการอัปโหลดไฟล์ใหม่
        if ($request->hasFile('fileUpload')) {
            // ลบการแนบไฟล์เก่าทั้งหมด
            $existingAttachments = Attachment::where('form_id', $form->id)->get();
            foreach ($existingAttachments as $existingAttachment) {
                Storage::disk('public')->delete($existingAttachment->file_path);
                $existingAttachment->delete();
            }

            // จัดเก็บไฟล์ใหม่
            foreach ($request->file('fileUpload') as $file) {
                if ($file) {
                    $filePath = $file->storeAs('files', uniqid() . '_' . $file->getClientOriginalName(), 'public');

                    // สร้างบันทึกการแนบใหม่
                    Attachment::create([
                        'form_id' => $form->id,
                        'file_path' => 'storage/' . $filePath,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'ข้อมูลฟอร์มถูกอัปเดตสำเร็จ');
    }

    public function reply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        ReplyForm::create([
            'form_id' => $formId,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }
    // public function reply(Request $request, $formId)
    // {
    //     $request->validate([
    //         'message' => 'required|string|max:1000',
    //     ]);

    //     // ตรวจสอบว่ามีการตอบกลับอยู่แล้วหรือไม่
    //     $reply = ReplyForm::where('form_id', $formId)->first();

    //     if ($reply) {
    //         // ถ้ามีการตอบกลับอยู่แล้ว ให้ทำการอัปเดต
    //         $reply->update([
    //             'message' => $request->message,
    //         ]);
    //     } else {
    //         // ถ้ายังไม่มี ให้สร้างการตอบกลับใหม่
    //         ReplyForm::create([
    //             'form_id' => $formId,
    //             'message' => $request->message,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    // }


    // public function updateStatus($id)
    // {
    //     $form = Form::findOrFail($id);
    //     $form->status = 2;
    //     $form->save();

    //     return redirect()->back()->with('success', 'สถานะฟอร์มอัปเดตเรียบร้อยแล้ว');
    // }
    public function updateStatus(Request $request, $id)
    {
        $form = Form::findOrFail($id);

        // อัปเดตสถานะ
        $form->status = 2; // หรือค่าที่คุณต้องการ
        $form->user_name_verifier = Auth::user()->fullname; // เก็บ fullname ของผู้ล็อกอิน
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}
