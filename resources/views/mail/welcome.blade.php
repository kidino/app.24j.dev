@extends('mail.layout') 

@section('content')
    <p>Dear {{ $user->name }},</p>
    <p>Thank you for registering with us! We're excited to have you as a member of our community.</p>
    <p>Best regards,<br>{{ config('app.name') }}</p>
@endsection