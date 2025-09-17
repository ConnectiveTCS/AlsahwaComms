<div x-data="{ search: '', open: false }" class="relative">
    <input type="text"
           x-model="search"
           @focus="open = true"
           @click.away="open = false"
           placeholder="Search users..."
           class="w-full border-gray-300 rounded-lg shadow-xs">

    <div x-show="open" class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-lg max-h-60 overflow-y-auto">
        @foreach($users as $user)
            <div x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase())"
                 class="px-3 py-2 hover:bg-blue-50 cursor-pointer"
                 @click="$refs.input.value = '{{ $user->name }}'; open = false;">
                <label class="flex items-center">
                    <input type="checkbox" name="{{ $name }}[]" value="{{ $user->id }}" class="mr-2">
                    <span>{{ $user->name }} ({{ $user->roles->pluck('name')->join(', ') }})</span>
                </label>
            </div>
        @endforeach
    </div>
</div>
@props(['name' => 'users'])