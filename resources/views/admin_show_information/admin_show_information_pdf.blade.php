<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link
        href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 16px;
        }
    </style>

    <title>PDF Report</title>
</head>
<body>

    <!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลฟอร์ม {{ $form->id }}</title>


</head>
<body>

    <h1>ข้อมูลฟอร์ม</h1>

    <h3>ข้อมูลผู้ส่งฟอร์ม</h3>
    <p><strong>ชื่อ-สกุล:</strong> {{ $form->fullname }}</p>
    <p><strong>คำนำหน้า:</strong> {{ $form->salutation }}</p>
    <p><strong>อายุ:</strong> {{ $form->age }} ปี</p>
    <p><strong>อาชีพ:</strong> {{ $form->occupation }}</p>
    <p><strong>เบอร์โทรศัพท์:</strong> {{ $form->phone }}</p>

    <h3>ที่อยู่</h3>
    <p><strong>บ้านเลขที่:</strong> {{ $form->house_no }}</p>
    <p><strong>หมู่ที่:</strong> {{ $form->village_no }}</p>
    <p><strong>ตรอก/ซอย:</strong> {{ $form->alley }}</p>
    <p><strong>ถนน:</strong> {{ $form->road }}</p>
    <p><strong>ตำบล:</strong> {{ $form->sub_district }}</p>
    <p><strong>เขต/อำเภอ:</strong> {{ $form->district }}</p>
    <p><strong>จังหวัด:</strong> {{ $form->province }}</p>

    <h3>รายละเอียดคำร้อง</h3>
    <p>{{ $form->submission }}</p>

    {{-- <h3>การตอบกลับ</h3>
    @if($form->replyform->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>วันที่ตอบกลับ</th>
                    <th>ข้อความที่ตอบกลับ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($form->replyform as $reply)
                    <tr>
                        <td>{{ $reply->created_at->format('d/m/Y') }}</td>
                        <td>{{ $reply->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>ยังไม่มีการตอบกลับ</p>
    @endif

    <div class="footer">
        <p>วันที่: {{ now()->format('d/m/Y') }}</p>
    </div> --}}

</body>
</html>


</body>


</html>
