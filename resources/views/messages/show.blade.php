@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <x-message-card :message="$message" />
</div>
@endsection
