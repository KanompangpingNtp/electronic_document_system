@extends('layout.users_account_layout')
@section('account_layout')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<div class="container">
    <h3 class="text-center">ข้อมูลการส่งแบบฟอร์ม</h3>
    <br>
    <table class="table table-bordered table-striped" id="data_table">
        <thead style="text-align: center;">
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
                <td>{{ $loop->iteration }}</td> <!-- แสดงลำดับที่ใช้ $loop->iteration -->
                <td>{{ $form->created_at->format('d/m/Y') }}</td>
                <td>{{ $form->user ? $form->user->fullname : 'ผู้ใช้งานทั่วไป' }}</td>
                <td>{{ $form->user_name_verifier }}</td>
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#submitModal-{{ $form->id }}">
                        <i class="bi bi-filetype-pdf"></i>
                    </button>
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
    <div class="modal fade" id="submitModal-{{ $form->id }}" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="submitModalLabel">แสดงข้อมูล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <span style="color: black;">preview</span> <a href="{{ route('exportPDF', $form->id) }}" class="btn btn-danger btn-sm" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a> --}}
                    <span style="color: black;">ไฟล์แนบ </span>
                    @foreach($form->attachments as $attachment)
                    <span class="d-inline me-2">
                        <a href="{{ asset($attachment->file_path) }}" target="_blank">{{ basename($attachment->file_path) }}</a>
                    </span>
                    @endforeach

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
