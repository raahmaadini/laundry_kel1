@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-200 bg-white px-4 py-2 placeholder-gray-400 text-sm transition-shadow focus:shadow-md focus:border-blue-300 focus:ring-0']) }}>
