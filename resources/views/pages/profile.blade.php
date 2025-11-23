@extends('layouts.app') 

@section('title', 'Test Profile')

@section('content')
    <div style="background-color: white; padding: 50px; border-radius: 8px; text-align: center;">
        
        <h1>Hi, {{ $user->name }}! 👋</h1>
        <p>If you are reading this, its too late!</p>
        
        <hr>
        
        <p>⬆️ up? : see the header?</p>
        <p>⬇️ down? : see the footer?</p>

    </div>
@endsection