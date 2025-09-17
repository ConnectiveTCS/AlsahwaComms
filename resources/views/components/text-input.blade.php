@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-oldbrick dark:focus:border-oldbrick focus:ring-oldbrick dark:focus:ring-oldbrick rounded-md shadow-xs']) }}>
