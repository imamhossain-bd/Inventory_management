@extends('backend.layouts.app')

@section('title','Create User')

@section('content')
<h2>Create User</h2>
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <input name="name" placeholder="Name" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="phone" placeholder="Phone" required>

    <select name="role_id" required>
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->label ?? $role->name }}</option>
        @endforeach
    </select>

    <input name="password" placeholder="Password (optional)">
    <input name="password_confirmation" placeholder="Confirm password">
    <button type="submit">Create</button>
</form>
@endsection
