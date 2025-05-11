<x-layouts.app :title="__('News Page')">
    @fluxAppearance
    @livewireStyles()
    {{-- @livewire('guardian.select-students') --}}
    {{-- @livewire('admin.admin-modal') --}}

    <!-- Main Tailwind Layout -->
    
    <!-- Bootstrap-loaded News Section via iframe -->
        @livewire('news.news')
    @livewireScripts()
    @fluxScripts
</x-layouts.app>
