@extends('layout.admin_layout')
@section('admin_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

<div class="container">

    <a href="{{ route('showinformationIndex')}}"> กลับหน้าเดิม </a><br><br>

    <h2 class="text-center">แก้ไขข้อมูลฟอร์ม</h2><br>

    <form action="{{ route('admin.form.update', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="day" name="day" value="{{ old('day', $form->day) }}">
        <input type="hidden" id="month" name="month" value="{{ old('month', $form->month) }}">
        <input type="hidden" id="year" name="year" value="{{ old('year', $form->year) }}">


        <div class="row">
            <div class="mb-3 col-md-3">
                <label for="writeAt" class="form-label">เขียนที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="writeAt" name="writeAt" value="{{ old('writeAt', $form->location) }}" placeholder="โปรดระบุ" required>
            </div>
        </div>

        @php
            // สร้างอาร์เรย์ชื่อเดือนในภาษาไทย
            $months = [
                1 => 'มกราคม',
                2 => 'กุมภาพันธ์',
                3 => 'มีนาคม',
                4 => 'เมษายน',
                5 => 'พฤษภาคม',
                6 => 'มิถุนายน',
                7 => 'กรกฎาคม',
                8 => 'สิงหาคม',
                9 => 'กันยายน',
                10 => 'ตุลาคม',
                11 => 'พฤศจิกายน',
                12 => 'ธันวาคม',
            ];
        @endphp
        <p>{{ date('j', strtotime(now())) }} {{ $months[date('n', strtotime(now()))] }} พ.ศ.{{ date('Y') + 543 }}</p>

        <br>

        <h4>ข้าพเจ้า</h4>

        <div class="row">
            <div class="col-md-2 mb-3">
                <label for="salutation" class="form-label">คำนำหน้า <span class="text-danger">*</span></label>
                <select class="form-select" id="salutation" name="salutation" required>
                    <option value="นาย" {{ $form->salutation == 'นาย' ? 'selected' : '' }}>นาย</option>
                    <option value="นาง" {{ $form->salutation == 'นาง' ? 'selected' : '' }}>นาง</option>
                    <option value="นางสาว" {{ $form->salutation == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="fullname" class="form-label">ชื่อ - สกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname', $form->fullname) }}" placeholder="ชื่อ - นามสกุล" required>
            </div>
            <div class="col-md-1 mb-3">
                <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="age" name="age" value="{{ old('age', $form->age) }}" placeholder="โปรดระบุ" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="occupation" class="form-label">อาชีพ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation', $form->occupation) }}" placeholder="โปรดระบุ" required>
            </div>
        </div>

        <br>

        <h5>ที่อยู่</h5>
        <div class="row">
            <div class="col-md-2 mb-3">
                <label for="houseNo" class="form-label">บ้านเลขที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="houseNo" name="houseNo" value="{{ old('houseNo', $form->house_no) }}" placeholder="โปรดระบุ" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="villageNo" class="form-label">หมู่ที่ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="villageNo" name="villageNo" value="{{ old('villageNo', $form->village_no) }}" placeholder="โปรดระบุ" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="alley" class="form-label">ตรอก/ซอย</label>
                <input type="text" class="form-control" id="alley" name="alley" value="{{ old('alley', $form->alley) }}" placeholder="โปรดระบุ">
            </div>
            <div class="col-md-2 mb-3">
                <label for="road" class="form-label">ถนน</label>
                <input type="text" class="form-control" id="road" name="road" value="{{ old('road', $form->road) }}" placeholder="โปรดระบุ">
            </div>
            <div class="col-md-2 mb-3">
                <label for="subDistrict" class="form-label">แขวง/ตำบล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subDistrict" name="subDistrict" value="{{ old('subDistrict', $form->sub_district) }}" placeholder="โปรดระบุ" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="district" class="form-label">เขต/อำเภอ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $form->district) }}" placeholder="โปรดระบุ" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="province" class="form-label">จังหวัด <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $form->province) }}" placeholder="โปรดระบุ" required>
            </div>
            <div class="mb-3 col-md-3">
                <label for="phone" class="form-label">โทรศัพท์ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $form->phone) }}" placeholder="โปรดระบุ" required maxlength="15">
            </div>
        </div>

        <br>

        <div class="row">
            <div class="mb-3 col-md-4">
                <label for="complaintName" class="form-label">ชื่อเรื่องคำขอ</label>
                <input type="text" class="form-control" id="complaintName" name="complaintName" value="{{ old('complaintName', $form->submission_name) }}" placeholder="โปรดระบุ" required>
            </div>
        </div>
        <div class="col-md-7">
            <label for="complaintDetails" class="form-label">ขอยื่นคำร้องต่อหน่วยงาน <span class="text-danger">*</span></label>
            <textarea class="form-control" id="complaintDetails" name="complaintDetails" rows="3" placeholder="โปรดระบุ" required>{{ old('complaintDetails', $form->submission) }}</textarea>
        </div>

        <br>

        {{-- <div class="row">
            <div class="col-md-2 mb-3">
                <label for="documentNumber" class="form-label">จำนวนเอกสาร <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="documentNumber" name="documentNumber" value="{{ old('documentNumber', $form->document_count) }}" placeholder="โปรดระบุ" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="fileUpload" class="form-label">ไฟล์แนบ</label>
                <input type="file" class="form-control" id="fileUpload" name="fileUpload" >
            </div>
        </div> --}}

        <div class="row">
            <div class="col-md-2 mb-3">
                <label for="documentNumber" class="form-label">จำนวนเอกสาร</label>
                <input type="number" class="form-control" id="documentNumber" name="documentNumber" placeholder="โปรดระบุ" required oninput="updateFileInputs()">
            </div>
        </div>

        <div class="col-md-4" id="fileInputsContainer">
            <label for="fileUpload" class="form-label">ไฟล์แนบ</label>
            <div id="fileInputs">
                <!-- Inputs for file uploads will be added here -->
            </div>
        </div>

        <script>
            function updateFileInputs() {
                const container = document.getElementById('fileInputs');
                const documentNumber = document.getElementById('documentNumber').value;

                // Clear existing file inputs
                container.innerHTML = '';

                // Create file inputs based on the number provided
                for (let i = 0; i < documentNumber; i++) {
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.className = 'form-control mb-2';
                    fileInput.name = `fileUpload[]`; // Use array notation to handle multiple files
                    fileInput.id = `fileUpload-${i + 1}`; // Optional: give each input a unique id
                    container.appendChild(fileInput);
                }
            }
        </script>

        <br>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
        </div>
        <br>
    </form>
</div>

<script>
    // Get current date
    const currentDate = new Date();

    // Set hidden input values
    document.getElementById('day').value = currentDate.getDate(); // วัน
    document.getElementById('month').value = currentDate.getMonth() + 1; // เดือน (January is 0)
    document.getElementById('year').value = currentDate.getFullYear(); // ปี

</script>

@endsection
