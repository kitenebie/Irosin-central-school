<x-layouts.app :title="__('News Page')">
    @livewireScriptConfig()
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    @livewire('event.event')

</x-layouts.app>
