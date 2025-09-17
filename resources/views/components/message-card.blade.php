<div class="bg-white rounded-2xl shadow p-4 mb-4">
    <div class="flex justify-between items-center border-b pb-2 mb-2">
        <div>
            <h3 class="text-lg font-semibold">{{ $message->subject ?? 'No Subject' }}</h3>
            <p class="text-sm text-gray-500">
                From: {{ $message->sender->name }} 
                <span class="mx-1">•</span> 
                {{ $message->created_at->diffForHumans() }}
            </p>
        </div>
        <div>
            @can('delete', $message)
                <form method="POST" action="{{ route('messages.destroy', $message) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                </form>
            @endcan
        </div>
    </div>

    <div class="text-gray-700 mb-3">
        {!! nl2br(e($message->body)) !!}
    </div>

    @if($message->attachments->count())
        <div class="border-t pt-2 mt-2">
            <p class="text-sm font-semibold mb-1">Attachments:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($message->attachments as $attachment)
                    <x-attachment-preview :attachment="$attachment" />
                @endforeach
            </div>
        </div>
    @endif

    <div class="border-t mt-3 pt-2 text-xs text-gray-500">
        Recipients: 
        {{ $message->recipients->pluck('name')->join(', ') }}
    </div>
</div>
@props(['message'])