<div class="w-full flex-col justify-end items-center space-x-2">
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

    @forelse ($Announcements as $Announcement)
            
        <div class="border px-2 py-2 lg-px-6 lg-py-12">
            <x-filament::section 
            aside
            >
            <x-slot name="heading">
                <p class="text-2xl bold px-2">{{ ucwords($Announcement->title) }}</p>
            </x-slot> 
            <x-slot name="description">
                <p class="text-sm px-2">{{ $Announcement->updated_at->diffForHumans() }}</p>
                <br>
                <div x-data="{ screen: window.innerWidth }" x-init="() => {
                    window.addEventListener('resize', () => screen = window.innerWidth);
                }">
                    {{-- Small screens --}}
                    <div x-show="screen < 768" class="h-80 px-2">
                        {!! \Illuminate\Support\Str::markdown(
                            \Illuminate\Support\Str::limit($Announcement->content, 120)
                        ) !!}
                    </div>
                
                    {{-- Medium and up --}}
                    <div x-show="screen >= 768" class="h-80 px-2">
                        {!! \Illuminate\Support\Str::markdown(
                            \Illuminate\Support\Str::limit($Announcement->content, 700)
                        ) !!}
                    </div>
                </div>

            </x-slot>
                    @php
                        $videos = collect($Announcement->images)->filter(fn($img) => Illuminate\Support\Str::endsWith($img, '.mp4'))->values();
                        $images = collect($Announcement->images)->filter(fn($img) => !Illuminate\Support\Str::endsWith($img, '.mp4'))->values();
                        $media = $videos->merge($images)->take(4);
                        $media2 = $images->merge($videos);
                    @endphp
                    <div class="container">
                        @forelse ($media as $item)
                            @if (Illuminate\Support\Str::endsWith($item, '.mp4'))
                                <!-- Top Banner -->
                                <div class="top-banner">
                                    <div class="image-box">
                                        <video class="h-full border w-full" controls>
                                            <source src="/storage/{{ $item }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                             @endif
                        @empty
                        @endforelse
                        
                        <div class="bottom-row">
                            @forelse ($media as $item)
                                @if (!Illuminate\Support\Str::endsWith($item, '.mp4'))
                                    <div class="bottom-box border">
                                        <!-- Three bottom images -->
                                        <div class="image-box border">
                                            <img class="h-full w-full" src="/storage/{{ $item }}">
                                        </div>
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        </div>
                    </div>
                <br>
                <div class="buttons border rounded bg-gray-800 dark:bg-white">
                    <x-filament::icon-button
                        color="secondary"
                        icon="heroicon-o-hand-thumb-up"
                        label="likes"
                        badge-color="secondary"
                        size="xl"
                    >
                        <x-slot name="badge" size="xl">
                            85
                        </x-slot>
                    </x-filament::icon-button>
                
                    <x-filament::icon-button
                        color="secondary"
                        icon="heroicon-o-chat-bubble-bottom-center-text"
                        label="comments"
                        badge-color="secondary"
                        size="xl"
                    >
                        <x-slot name="badge">
                            56
                        </x-slot>
                    </x-filament::icon-button>
                
                    <x-filament::icon-button
                        color="secondary"
                        icon="heroicon-o-bookmark-square"
                        label="save"
                        badge-color="secondary"
                        size="xl"
                    >
                    </x-filament::icon-button>
                    {{-- Full Information MOdal --}}
                    <x-filament::modal width="screen" slide-over alignment="center" :close-by-escaping="true">
                        <x-slot name="trigger">
                            <x-filament::link class="px-12"
                                tag="button"
                                size="xl">
                                read more
                            </x-filament::link>
                        </x-slot>
                        <x-slot name="heading">
                            <p class="text-2xl bold">{{ ucwords($Announcement->title) }}</p>
                            <p class="text-sm">{{ $Announcement->updated_at->diffForHumans() }}</p>
                        </x-slot>
                            
                            <swiper-container class="mySwiper" navigation="true" pagination="true" keyboard="true" mousewheel="true"
                            css-mode="true">
                            
                                @forelse ($media2 as $item)
                                    @if (Illuminate\Support\Str::endsWith($item, '.mp4'))
                                        <!-- Top Banner -->
                                        <swiper-slide>
                                            <video class="h-full w-full" controls>
                                                <source src="/storage/{{ $item }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                            </video>
                                        </swiper-slide>
                                    @else
                                        <swiper-slide>
                                            <img class="h-full w-full" src="/storage/{{ $item }}">
                                        </swiper-slide>
                                    @endif
                                @empty
                                @endforelse
                            </swiper-container>
                            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

                        {!! \Illuminate\Support\Str::markdown($Announcement->content) !!}
                        
                        {{-- Modal content --}}
                    </x-filament::modal>
                    {{-- End Full Information MOdal --}}
                </div>
            </x-filament::section>
        </div>
        <br>
    @empty
            <p class="text-2xl px-4 y-12 bg-grey-900 shadow-lg">No Announcement Found</p>
    @endforelse
    <style>
        .columns {
        column-count: 2;
        column-gap: 2px;
        }
        .buttons{
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 1rem;
        }
        .container {
        max-width: 1200px;
        margin: 0;
        padding: 0;
        }

        .top-banner {
        margin-bottom: 1px;
        }

        .top-banner .image-box {
        width: 100%;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: bold;
        }

        .bottom-row {
            display: flex;
            flex-wrap: wrap; /* allows children to wrap to next line */
            gap: 1px;
        }

        .bottom-box {
            flex: 1;
            width: 32%;
        }

        .bottom-box .image-box {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        }

        
    swiper-container {
      width: 100%;
      height: 400px;
    }

    swiper-slide {
      text-align: center;
      font-size: 18px;
      background: transparent;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
    </style>
</div>
