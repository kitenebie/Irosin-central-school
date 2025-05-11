<div class="w-full flex-col justify-end items-center space-x-2">
    <x-filament-actions::modals />
    <!-- Modal Trigger -->
    <x-filament::modal width="2xl" slide-over :close-by-clicking-away="false">
        <x-slot name="trigger">
            <x-filament::button>
                Post New Announcement
            </x-filament::button>
        </x-slot>
        <div>
            <x-slot name="heading">
                Post New Announcement
            </x-slot>
            <form wire:submit="create">
                {{ $this->form }}
                <br><br>
                <x-filament::button type="submit">
                    Post Announcement
                </x-filament::button>
            </form>

            <x-filament-actions::modals />
        </div>
    </x-filament::modal>
    
    <br> <br>
    {{ $this->table }}
</div>
