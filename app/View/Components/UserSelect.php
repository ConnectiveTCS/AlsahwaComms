<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UserSelect extends Component
{
    public string $name;
    public $users;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->users = User::orderBy('name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-select');
    }
}
