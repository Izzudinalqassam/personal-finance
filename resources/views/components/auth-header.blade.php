@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center mb-8">
    <h1 class="text-3xl md:text-4xl font-bold text-white mb-3 leading-tight">
        {{ $title }}
    </h1>
    <p class="text-white/80 text-lg leading-relaxed">
        {{ $description }}
    </p>
</div>
