<x-layouts.custome.header>
    <!-- Hero Section -->
    <section class="bg-green-700 text-white px-6 py-12 sm:py-16 md:py-20 lg:py-24">
        <div class="max-w-7xl mx-auto flex flex-col-reverse md:flex-row items-center justify-between gap-10 md:gap-20">
            <div class="max-w-xl">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold leading-tight">
                    Welcome to
                    <span class="font-extrabold"> Irosin Central School </span>
                </h1>
                <p class="mt-3 text-sm sm:text-base max-w-md">
                    Nurturing minds, building character, and shaping the future leaders
                    of tomorrow.
                </p>
                @if (!auth()->check())
                    <div class="mt-6 flex space-x-3">
                        <a href="/"
                            class="bg-white text-green-800 font-bold text-xs sm:text-sm px-4 py-2 rounded-md hover:bg-gray-100">
                            Create an account
                        </a>
                        <a href="#"
                            class="border border-white text-white font-semibold text-xs sm:text-sm px-4 py-2 rounded-md hover:bg-white hover:text-green-700 transition">
                            Learn More
                        </a>
                    </div>
                @endif
            </div>
            <div class="bg-white rounded-lg p-6 shadow-lg max-w-[320px] sm:max-w-[360px] md:max-w-[400px] w-full">
                <div class="bg-gray-300 rounded-md p-6">
                    <img alt="Green and white stylized school icon graphic on gray background"
                        class="w-full h-auto rounded" height="180"
                        src="https://storage.googleapis.com/a1aa/image/e1fce618-5246-45d1-e9ee-dcfa7139ace0.jpg"
                        width="320" />
                </div>
            </div>
        </div>
    </section>

    @livewire('main.news')


    <section class="max-w-7xl mx-auto px-6 pb-12">
        <h2 class="text-center font-bold text-lg sm:text-xl mb-2">Events</h2>
        <p class="text-center text-gray-600 text-xs sm:text-sm mb-8 max-w-md mx-auto">
            Stay updated with the latest happenings at Irosin Central School.
        </p>

        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl p-6 shadow-md border">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-[#d9f0e1] rounded-md text-[#2f7a4e] font-semibold text-center w-14">
                        <div class="text-xl leading-none pt-1 font-bold">28</div>
                        <div class="text-sm pb-1">May</div>
                    </div>
                    <div class="bg-[#0b6b2f] text-white text-xs rounded-full px-3 py-1 font-semibold self-start">
                        Academic
                    </div>
                </div>
                <h3 class="font-bold text-[#0a1f3f] text-lg mb-1">Science Fair 2023</h3>
                <p class="text-[#4a5568] mb-4 text-sm leading-relaxed">
                    Annual science fair showcasing student projects and innovations across all grade levels.
                </p>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2 mb-1">
                    <i class="far fa-clock"></i>
                    <span>9:00 AM – 4:00 PM</span>
                </div>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>School Gymnasium</span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl p-6 shadow-md border">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-[#d9f0e1] rounded-md text-[#2f7a4e] font-semibold text-center w-14">
                        <div class="text-xl leading-none pt-1 font-bold">05</div>
                        <div class="text-sm pb-1">Jun</div>
                    </div>
                    <div class="bg-[#0b6b2f] text-white text-xs rounded-full px-3 py-1 font-semibold self-start">
                        Cultural
                    </div>
                </div>
                <h3 class="font-bold text-[#0a1f3f] text-lg mb-1">Arts &amp; Culture Festival</h3>
                <p class="text-[#4a5568] mb-4 text-sm leading-relaxed">
                    A celebration of arts, music, and cultural performances by our talented students.
                </p>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2 mb-1">
                    <i class="far fa-clock"></i>
                    <span>1:00 PM – 5:00 PM</span>
                </div>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>School Auditorium</span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl p-6 shadow-md border">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-[#d9f0e1] rounded-md text-[#2f7a4e] font-semibold text-center w-14">
                        <div class="text-xl leading-none pt-1 font-bold">12</div>
                        <div class="text-sm pb-1">Jun</div>
                    </div>
                    <div class="bg-[#0b6b2f] text-white text-xs rounded-full px-3 py-1 font-semibold self-start">
                        Sports
                    </div>
                </div>
                <h3 class="font-bold text-[#0a1f3f] text-lg mb-1">Annual Sports Meet</h3>
                <p class="text-[#4a5568] mb-4 text-sm leading-relaxed">
                    Inter-class sports competition featuring various athletic events and team sports.
                </p>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2 mb-1">
                    <i class="far fa-clock"></i>
                    <span>8:00 AM – 5:00 PM</span>
                </div>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>School Sports Field</span>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-xl p-6 shadow-md border">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-[#d9f0e1] rounded-md text-[#2f7a4e] font-semibold text-center w-14">
                        <div class="text-xl leading-none pt-1 font-bold">20</div>
                        <div class="text-sm pb-1">Jun</div>
                    </div>
                    <div class="bg-[#0b6b2f] text-white text-xs rounded-full px-3 py-1 font-semibold self-start">
                        Community
                    </div>
                </div>
                <h3 class="font-bold text-[#0a1f3f] text-lg mb-1">Community Outreach Day</h3>
                <p class="text-[#4a5568] mb-4 text-sm leading-relaxed">
                    Students and teachers will participate in various community service activities around Irosin.
                </p>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2 mb-1">
                    <i class="far fa-clock"></i>
                    <span>7:00 AM – 3:00 PM</span>
                </div>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Various Locations</span>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="bg-white rounded-xl p-6 shadow-md border">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-[#d9f0e1] rounded-md text-[#2f7a4e] font-semibold text-center w-14">
                        <div class="text-xl leading-none pt-1 font-bold">25</div>
                        <div class="text-sm pb-1">Jun</div>
                    </div>
                    <div class="bg-[#0b6b2f] text-white text-xs rounded-full px-3 py-1 font-semibold self-start">
                        Academic
                    </div>
                </div>
                <h3 class="font-bold text-[#0a1f3f] text-lg mb-1">Math Olympiad</h3>
                <p class="text-[#4a5568] mb-4 text-sm leading-relaxed">
                    Annual mathematics competition for elementary and junior high school students.
                </p>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2 mb-1">
                    <i class="far fa-clock"></i>
                    <span>9:00 AM – 12:00 PM</span>
                </div>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>School Library</span>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="bg-white rounded-xl p-6 shadow-md border">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-[#d9f0e1] rounded-md text-[#2f7a4e] font-semibold text-center w-14">
                        <div class="text-xl leading-none pt-1 font-bold">30</div>
                        <div class="text-sm pb-1">Jun</div>
                    </div>
                    <div class="bg-[#0b6b2f] text-white text-xs rounded-full px-3 py-1 font-semibold self-start">
                        Special
                    </div>
                </div>
                <h3 class="font-bold text-[#0a1f3f] text-lg mb-1">School Foundation Day</h3>
                <p class="text-[#4a5568] mb-4 text-sm leading-relaxed">
                    Celebration of the school's founding anniversary with various activities and programs.
                </p>
                <div class="flex items-center text-[#6b7280] text-xs space-x-2">
                    <i class="far fa-clock"></i>
                    <span>All Day</span>
                </div>
            </div>
        </div>
        <div class="mt-8 flex justify-center">
            <button
                class="bg-green-800 text-white text-xs sm:text-sm font-semibold px-4 py-2 rounded-md hover:bg-green-900">
                View All Events
            </button>
        </div>
    </section>

</x-layouts.custome.header>
