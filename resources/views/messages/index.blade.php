@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-biscay mb-4">Inbox & Sent Messages</h1>

    @foreach($messages as $message)
        <x-message-card :message="$message" />
    @endforeach

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection
