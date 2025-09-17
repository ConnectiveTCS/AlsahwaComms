<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MessageController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $messages = Message::with(['sender', 'recipients', 'attachments'])
            ->whereHas('recipients', function ($q) {
                $q->where('users.id', Auth::id());
            })
            ->orWhere('sender_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipients'   => ['required', 'array'],
            'recipients.*' => ['exists:users,id'],
            'subject'      => ['nullable', 'string', 'max:255'],
            'body'         => ['required', 'string'],
            'attachments.*'=> ['file', 'max:5120'], // 5MB per file
        ]);

        DB::transaction(function () use ($request) {
            $message = Message::create([
                'subject'   => $request->subject,
                'body'      => $request->body,
                'sender_id' => Auth::id(),
            ]);

            $message->recipients()->attach($request->recipients);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('attachments', 'public');
                    $message->attachments()->create([
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'file_type' => $file->getClientMimeType(),
                        'file_size' => $file->getSize() / 1024, // KB
                    ]);
                }
            }
        });

        return redirect()->route('messages.index')->with('success', 'Message sent successfully.');
    }

    public function show(Message $message)
    {
        $this->authorize('view', $message);

        return view('messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);

        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
    }
    public function edit(Message $message)
    {
        $this->authorize('update', $message);

        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);

        $request->validate([
            'subject' => ['nullable', 'string', 'max:255'],
            'body'    => ['required', 'string'],
        ]);

        $message->update([
            'subject' => $request->subject,
            'body'    => $request->body,
        ]);

        return redirect()->route('messages.show', $message)->with('success', 'Message updated successfully.');
    }
}
