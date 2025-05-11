<nav class="border-b z-50 sticky top-0 bg-white border-gray-200">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img alt="Green book icon representing Irosin Central School logo" class="w-6 h-6"
                src="https://storage.googleapis.com/a1aa/image/496df554-c03f-4d0f-b627-889d928b8201.jpg" />
            <span class="font-semibold text-gray-900 text-sm sm:text-base">
                Irosin Central School
            </span>
        </div>

        <!-- Hamburger button (mobile only) -->
        <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Desktop Nav Links -->
        <ul class="hidden md:flex space-x-6 text-sm text-gray-600">
            <li><a href="/" class="{{ request()->routeIs('home') ? 'font-semibold text-gray-900' : 'hover:text-gray-900' }}">Home</a></li>
            <li><a href="/news" class="{{ request()->routeIs('news') ? 'font-semibold text-gray-900' : 'hover:text-gray-900' }}">News</a></li>
            <li><a href="/announcements" class="{{ request()->routeIs('announcements') ? 'font-semibold text-gray-900' : 'hover:text-gray-900' }}">Announcements</a></li>
            <li><a href="/events" class="{{ request()->routeIs('events') ? 'font-semibold text-gray-900' : 'hover:text-gray-900' }}">Events</a></li>
            <li><a href="/gallery" class="{{ request()->routeIs('gallery') ? 'font-semibold text-gray-900' : 'hover:text-gray-900' }}">Gallery</a></li>
            <li><a href="/about" class="{{ request()->routeIs('about') ? 'font-semibold text-gray-900' : 'hover:text-gray-900' }}">About Us</a></li>
        </ul>
        @if (!auth()->check()) 
            <!-- Login Button -->
            <a class="hidden md:inline-block bg-green-800 text-white text-xs sm:text-sm font-semibold px-4 py-2 rounded-md hover:bg-green-900"
                href="/">Login</a>
        @endif
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden px-6 pb-4 space-y-2 text-sm text-gray-600">
        <a href="/" class="{{ request()->routeIs('home') ? 'font-semibold text-gray-900 block' : 'hover:text-gray-900 block' }}">Home</a>
        <a href="/news" class="{{ request()->routeIs('news') ? 'font-semibold text-gray-900 block' : 'hover:text-gray-900 block' }}">News</a>
        <a href="/announcements" class="{{ request()->routeIs('announcements') ? 'font-semibold text-gray-900 block' : 'hover:text-gray-900 block' }}">Announcements</a>
        <a href="/events" class="{{ request()->routeIs('events') ? 'font-semibold text-gray-900 block' : 'hover:text-gray-900 block' }}">Events</a>
        <a href="/gallery" class="{{ request()->routeIs('gallery') ? 'font-semibold text-gray-900 block' : 'hover:text-gray-900 block' }}">Gallery</a>
        <a href="/about" class="{{ request()->routeIs('about') ? 'font-semibold text-gray-900 block' : 'hover:text-gray-900 block' }}">About Us</a>
        @if (!auth()->check()) 
            <div class="flex">
                <a href="/" class="mt-4 bg-green-800 text-white font-semibold px-4 py-2 rounded-md">Login</a>
            </div>
        @endif
       
    </div>
    <script src="/build/js/header.js"></script>

</nav>
