@extends('layout.admin_layout')
@section('admin_layout')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

<div class="container">

    <h2 class="text-center">ข้อมูลการส่งแบบฟอร์ม</h2>
    <br>

    <table class="table table-bordered table-striped" id="data_table">
        <thead style="text-align: center; ">
            <tr>
                <th>ลำดับ</th>
                <th>วันที่ส่งแบบฟอร์ม</th>
                <th>ผู้ส่งแบบฟอร์ม</th>
                <th>ผู้ส่งตอบรับฟอร์ม</th>
                <th>การกระทำ</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $form)
            <tr class="text-center">
                <td>{{ $form->id }}</td>
                <td>{{ $form->created_at->format('d/m/Y') }}</td>
                <td>{{ $form->user ? $form->user->fullname : 'ผู้ใช้งานทั่วไป' }}</td>
                <td>{{ $form->user_name_verifier}}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#submitModal-{{ $form->id }}">
                        <i class="bi bi-filetype-pdf"></i>
                    </button>
                    {{-- <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal-{{ $form->id }}">
                    <i class="bi bi-reply"></i>
                    </button> --}}
                    @if(!is_null($form->user_id))
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal-{{ $form->id }}">
                        <i class="bi bi-reply"></i>
                    </button>
                    @endif
                    <a href="{{ route('showinformationEdit', $form->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                </td>
                <td>
                    @if($form->status == 1)
                    <p> - </p>
                    @elseif($form->status == 2)
                    <p style="font-size: 20px; color:blue;"><i class="bi bi-check-circle"></i></p>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @foreach($forms as $form)
    <!-- Modal -->
    <div class="modal fade" id="replyModal-{{ $form->id }}" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">ตอบกลับฟอร์ม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><span style="color: black;">ชื่อผู้ส่งฟอร์ม : </span>{{ $form->user ? $form->user->fullname : 'ผู้ใช้งานทั่วไป' }}</p>
                    <p>ข้อความตอบกลับก่อนหน้า</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>วันที่ตอบกลับ</th>
                                <th>ข้อความที่ตอบกลับ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($form->replyforms as $reply)
                            <tr class="text-center">
                                <td>
                                    {{ $reply->created_at->timezone('Asia/Bangkok')->translatedFormat('d F') }} {{ $reply->created_at->year + 543 }}
                                    {{ $reply->created_at->format('H:i') }} น.
                                </td>
                                <td>{{ $reply->message }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">ยังไม่มีการตอบกลับ</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <form action="{{ route('forms.reply', $form->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">ข้อความตอบกลับ</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">ส่งตอบกลับ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end replyModal -->

    <!-- Modal -->
    <div class="modal fade" id="submitModal-{{ $form->id }}" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="submitModalLabel">แสดงข้อมูล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span style="color: black;">preview</span> <a href="{{ route('exportPDF', $form->id) }}" class="btn btn-danger btn-sm" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                    <br>
                    <br>
                    <span style="color: black;">ไฟล์แนบ </span>
                    @foreach($form->attachments as $attachment)
                    <span class="d-inline me-2">
                        <a href="{{ asset($attachment->file_path) }}" target="_blank">{{ basename($attachment->file_path) }}</a>
                    </span>
                    @endforeach

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <span class="text-start" style="color: black;">รับฟอร์ม</span>
                    <form action="{{ route('updateStatus', $form->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" @if($form->status == 2) disabled @endif>
                            กดรับแบบฟอร์ม
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


</div>

<script src="{{asset('js/admin_show_information.js')}}"></script>

@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
