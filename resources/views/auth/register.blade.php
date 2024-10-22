@extends('layout.users_layout')
@section('user_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

{{-- <h2>Register</h2><br>
    <form action="{{ route('register.submit') }}" method="POST">
@csrf
<div>
    <label for="fullname">Full Name</label>
    <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
</div>
<br>
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
<div>
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>
</div>
<br>
<div>
    <label for="phone">Phone (Optional)</label>
    <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
</div>
<br>
<button type="submit">Register</button>
</form> --}}

<div class="container">
    <h4>Register</h4><br>
    <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <div class="mb-3 col-md-4">
            <label for="fullname" class="form-label">ชื่อ-นามสกุล</label>
            <input type="text" id="fullname" name="fullname" class="form-control" value="{{ old('fullname') }}" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="phone" class="form-label">โทรศัพท์</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

</div>
@endsection
