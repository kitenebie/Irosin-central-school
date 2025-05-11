<x-layouts.custome.header>
    @livewireStyles()
        @livewire('announcement.main')
        <script src="/build/js/announcement.js"></script>
        {{-- @livewire('announcement.comments') --}}
    @livewireScripts()

</x-layouts.custome.header>
