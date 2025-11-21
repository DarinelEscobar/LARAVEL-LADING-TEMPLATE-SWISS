@php
    $navItems = ['NEW', 'MEN', 'WOMEN', 'KIDS'];
    $projectCards = [
        ['number' => '01', 'title' => 'Typography Project', 'description' => 'Exploring grid systems and typographic hierarchy'],
        ['number' => '02', 'title' => 'Poster Design', 'description' => 'Minimalist approach to visual communication'],
        ['number' => '03', 'title' => 'Brand Identity', 'description' => 'Clean, systematic visual language for modern brands'],
    ];
    $featureCards = [
        ['icon' => 'cable', 'title' => 'Modular', 'description' => 'Component-driven structure for flexible, repeatable layouts.'],
        ['icon' => 'sparkles', 'title' => 'Animated', 'description' => 'Crisp, performant motion crafted with Anime.js and Tailwind.'],
        ['icon' => 'shield', 'title' => 'Reliable', 'description' => 'Accessible UI parts inspired by shadcn/ui patterns.'],
        ['icon' => 'zap', 'title' => 'Fast', 'description' => 'Lean markup and Vite-powered assets keep interactions instant.'],
    ];
    $showcaseCards = [
        ['number' => '01', 'title' => 'Typography System', 'description' => 'Exploring hierarchy and readability', 'tone' => 'bg-chart-1'],
        ['number' => '02', 'title' => 'Grid Layouts', 'description' => 'Systematic visual organization', 'tone' => 'bg-chart-2'],
        ['number' => '03', 'title' => 'Brand Identity', 'description' => 'Clean visual language', 'tone' => 'bg-chart-3'],
    ];
@endphp

<div data-landing-page class="bg-background text-foreground min-h-screen">
    <x-landing.header :nav-items="$navItems" />

    <main class="pt-28 md:pt-32">
        <x-landing.hero />
        <x-landing.work :project-cards="$projectCards" :feature-cards="$featureCards" />
        <x-landing.showcase :showcase-cards="$showcaseCards" />
        <x-landing.contact />
    </main>

    <x-landing.footer />
</div>

@push('scripts')
    @vite('resources/js/landing-page.js')
@endpush
