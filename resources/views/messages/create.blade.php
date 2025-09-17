@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-biscay mb-4">New Message</h1>

    <form method="POST" action="{{ route('messages.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold text-gray-700">Recipients</label>
            <x-user-select name="recipients" />
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Subject</label>
            <input type="text" name="subject" class="w-full border-gray-300 rounded-lg shadow-xs">
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Message</label>
            <textarea name="body" rows="5" class="w-full border-gray-300 rounded-lg shadow-xs"></textarea>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Attachments</label>
            <input type="file" name="attachments[]" multiple class="block mt-1">
        </div>

        <div>
            <button class="bg-biscay hover:bg-matisse text-white px-4 py-2 rounded-lg shadow-sm">
                Send Message
            </button>
        </div>
    </form>
</div>
@endsection
