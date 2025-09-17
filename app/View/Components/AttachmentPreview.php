<?php

namespace App\View\Components;

use Closure;
use App\Models\Attachment;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AttachmentPreview extends Component
{
    public Attachment $attachment;

    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.attachment-preview');
    }
}
