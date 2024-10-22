@extends('layout.users_layout')
@section('user_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , });

</script>
@endif

@if ($message = Session::get('error'))
<script>
    Swal.fire({
        icon: 'error'
        , title: '{{ $message }}'
    , });

</script>
@endif

{{-- <h2>Login</h2><br>
<form action="{{ route('login.submit') }}" method="POST">
@csrf
<div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
</div>
<br>
<div>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
</div>
<br>
<button type="submit">Login</button>
</form> --}}

<div class="container">
    <div class="d-flex align-items-center mb-3">
        <h4 class="me-2">Login</h4>
        <a href="{{ route('showRegisterForm') }}" class="btn btn-secondary btn-sm">สมัครเข้าใช้งานระบบ</a>
    </div>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="mb-3 col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

@endsection
