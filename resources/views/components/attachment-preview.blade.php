@php
    $isImage = str_starts_with($attachment->file_type, 'image/');
@endphp

<div class="border rounded-lg p-2 w-32 text-center bg-gray-50 hover:bg-gray-100">
    @if($isImage)
        <img src="{{ asset('storage/' . $attachment->file_path) }}" 
             alt="{{ $attachment->file_name }}" 
             class="w-full h-20 object-cover rounded mb-1">
    @else
        <div class="h-20 flex items-center justify-center bg-gray-200 rounded mb-1">
            📎
        </div>
    @endif
    <a href="{{ asset('storage/' . $attachment->file_path) }}" 
       download="{{ $attachment->file_name }}" 
       class="block text-xs text-blue-600 truncate">
        {{ $attachment->file_name }}
    </a>
</div>
@props(['attachment'])