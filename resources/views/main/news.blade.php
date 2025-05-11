<x-layouts.custome.header>
    {{-- FEATURED --}}
    <main class="mt-4 max-w-6xl mx-auto">
        <section class="flex flex-col md:flex-row bg-white rounded-xl border shadow-md overflow-hidden"
            style="min-height: 280px">
            <div class="relative flex-1 flex items-center justify-center"
                style="background-image: linear-gradient(90deg, rgb(34, 197, 94) 0%, rgb(21, 128, 61) 100%)">
                <span
                    class="absolute top-4 left-4 text-xs font-semibold text-white bg-[#e03e2f] rounded-full px-3 py-1 tracking-wide select-none">
                    FEATURED
                </span>
                <img alt="Icon of a newspaper in white on a green gradient background" aria-hidden="true"
                    class="opacity-30 w-24 h-24" height="96"
                    src="https://storage.googleapis.com/a1aa/image/e55c2198-f331-4308-9aec-1846007583c6.jpg"
                    width="96" />
            </div>
            <div class="flex-1 p-6 md:p-8 flex flex-col justify-center">
                <span class="text-[#2CAC5B] font-semibold text-xs tracking-wide uppercase mb-2">
                    Technology
                </span>
                <h2 class="font-extrabold text-black text-xl md:text-2xl leading-tight mb-4">
                    Breakthrough in Quantum Computing Promises to Revolutionize Data Processing
                </h2>
                <p class="text-gray-600 text-sm md:text-base mb-6 max-w-md leading-relaxed">
                    Scientists have achieved a major milestone in quantum computing that could transform everything from
                    medicine to climate modeling. The new technology processes complex calculations in seconds that
                    would take traditional supercomputers years to complete.
                </p>
                <div class="flex items-center space-x-3 mb-6">
                    <div aria-hidden="true"
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600">
                        <i class="fas fa-user text-lg">
                        </i>
                    </div>
                    <div class="text-xs text-gray-700">
                        <p class="font-semibold text-gray-900 leading-none">
                            Dr. Sarah Chen
                        </p>
                        <p class="text-gray-500 leading-none">
                            Science Correspondent • 2 hours ago
                        </p>
                    </div>
                </div>
                <a href="/read/1"
                    class="bg-[#2CAC5B] text-white text-sm font-semibold rounded-md px-4 py-2 w-max hover:bg-[#3C7647] transition-colors">
                    Read Full Story
                </a>
            </div>
        </section>
    </main>

    {{-- OTHER NEWS --}}
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-xl font-extrabold leading-6">
                Latest News
            </h2>
            <nav class="flex space-x-3 mt-4 md:mt-0">
                <button class="text-[#2CAC5B] bg-[#EFF8F2] text-sm font-medium rounded-full px-3 py-1" type="button">
                    All
                </button>
                <button class="text-[#475569] bg-[#EFF8F2] text-sm font-normal rounded-full px-3 py-1" type="button">
                    Politics
                </button>
                <button class="text-[#475569] bg-[#EFF8F2] text-sm font-normal rounded-full px-3 py-1" type="button">
                    Tech
                </button>
                <button class="text-[#475569] bg-[#EFF8F2] text-sm font-normal rounded-full px-3 py-1" type="button">
                    Business
                </button>
            </nav>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <article class="bg-white rounded-lg shadow-sm border">
                <div class="bg-[#D7DEFF] rounded-t-lg flex justify-center items-center p-12">
                    <img alt="green document icon representing politics news" class="w-12 h-12 text-[#4F6BED]"
                        height="48"
                        src="https://storage.googleapis.com/a1aa/image/a99312c0-ae8d-431d-3a23-66adec5d198b.jpg"
                        width="48" />
                </div>
                <div class="p-6">
                    <p class="text-[#4F6BED] text-xs font-semibold uppercase mb-1">
                        Politics
                    </p>
                    <h3 class="font-extrabold text-base leading-6 mb-3">
                        Global Leaders Gather for Climate Summit
                    </h3>
                    <p class="text-[#64748B] text-sm leading-5 mb-6">
                        World leaders from over 190 countries convene to discuss ambitious new targets for reducing
                        carbon emissions and combating climate change.
                    </p>
                    <div class="flex justify-between items-center text-[#64748B] text-xs">
                        <span>
                            45 minutes ago
                        </span>
                        <a class="text-[#2CAC5B] font-medium hover:underline" href="#">
                            Read More →
                        </a>
                    </div>
                </div>
            </article>
            <!-- Card 2 -->
            <article class="bg-white rounded-lg shadow-sm border">
                <div class="bg-[#D9F7DD] rounded-t-lg flex justify-center items-center p-12">
                    <img alt="Green dollar sign icon representing business news" class="w-12 h-12 text-[#22C55E]"
                        height="48"
                        src="https://storage.googleapis.com/a1aa/image/a86dfbc0-7cdd-42fd-eacb-a44d38970dd2.jpg"
                        width="48" />
                </div>
                <div class="p-6">
                    <p class="text-[#22C55E] text-xs font-semibold uppercase mb-1">
                        Business
                    </p>
                    <h3 class="font-extrabold text-base leading-6 mb-3">
                        Markets Surge Following Economic Report
                    </h3>
                    <p class="text-[#64748B] text-sm leading-5 mb-6">
                        Global markets responded positively to better-than-expected economic data, with major indices
                        reaching new all-time highs.
                    </p>
                    <div class="flex justify-between items-center text-[#64748B] text-xs">
                        <span>
                            2 hours ago
                        </span>
                        <a class="text-[#2CAC5B] font-medium hover:underline" href="#">
                            Read More →
                        </a>
                    </div>
                </div>
            </article>
            <!-- Card 3 -->
            <article class="bg-white rounded-lg shadow-sm border">
                <div class="bg-[#F3E8FF] rounded-t-lg flex justify-center items-center p-12">
                    <img alt="Purple computer monitor icon representing technology news"
                        class="w-12 h-12 text-[#A67CFF]" height="48"
                        src="https://storage.googleapis.com/a1aa/image/57f08202-7e76-4045-f5a9-4c1a6eab0514.jpg"
                        width="48" />
                </div>
                <div class="p-6">
                    <p class="text-[#A67CFF] text-xs font-semibold uppercase mb-1">
                        Technology
                    </p>
                    <h3 class="font-extrabold text-base leading-6 mb-3">
                        New AI Tool Helps Detect Early Signs of Disease
                    </h3>
                    <p class="text-[#64748B] text-sm leading-5 mb-6">
                        Researchers have developed an artificial intelligence system that can identify early indicators
                        of serious health conditions from routine medical scans.
                    </p>
                    <div class="flex justify-between items-center text-[#64748B] text-xs">
                        <span>
                            5 hours ago
                        </span>
                        <a class="text-[#2CAC5B] font-medium hover:underline" href="#">
                            Read More →
                        </a>
                    </div>
                </div>
            </article>
            <!-- Card 4 -->
            <article class="bg-white rounded-lg shadow-sm border">
                <div class="bg-[#D7DEFF] rounded-t-lg flex justify-center items-center p-12">
                    <img alt="green document icon representing politics news" class="w-12 h-12 text-[#4F6BED]"
                        height="48"
                        src="https://storage.googleapis.com/a1aa/image/a99312c0-ae8d-431d-3a23-66adec5d198b.jpg"
                        width="48" />
                </div>
                <div class="p-6">
                    <p class="text-[#4F6BED] text-xs font-semibold uppercase mb-1">
                        Politics
                    </p>
                    <h3 class="font-extrabold text-base leading-6 mb-3">
                        Senate Passes New Environmental Bill
                    </h3>
                    <p class="text-[#64748B] text-sm leading-5 mb-6">
                        The Senate has passed a comprehensive environmental bill aimed at reducing pollution and
                        promoting renewable energy sources.
                    </p>
                    <div class="flex justify-between items-center text-[#64748B] text-xs">
                        <span>
                            1 hour ago
                        </span>
                        <a class="text-[#2CAC5B] font-medium hover:underline" href="#">
                            Read More →
                        </a>
                    </div>
                </div>
            </article>
            <!-- Card 5 -->
            <article class="bg-white rounded-lg shadow-sm border">
                <div class="bg-[#D9F7DD] rounded-t-lg flex justify-center items-center p-12">
                    <img alt="Green dollar sign icon representing business news" class="w-12 h-12 text-[#22C55E]"
                        height="48"
                        src="https://storage.googleapis.com/a1aa/image/a86dfbc0-7cdd-42fd-eacb-a44d38970dd2.jpg"
                        width="48" />
                </div>
                <div class="p-6">
                    <p class="text-[#22C55E] text-xs font-semibold uppercase mb-1">
                        Business
                    </p>
                    <h3 class="font-extrabold text-base leading-6 mb-3">
                        Startup Secures $50M in Series B Funding
                    </h3>
                    <p class="text-[#64748B] text-sm leading-5 mb-6">
                        A tech startup focused on sustainable energy solutions has secured $50 million in Series B
                        funding to expand its operations.
                    </p>
                    <div class="flex justify-between items-center text-[#64748B] text-xs">
                        <span>
                            3 hours ago
                        </span>
                        <a class="text-[#2CAC5B] font-medium hover:underline" href="#">
                            Read More →
                        </a>
                    </div>
                </div>
            </article>
            <!-- Card 6 -->
            <article class="bg-white rounded-lg shadow-sm border">
                <div class="bg-[#F3E8FF] rounded-t-lg flex justify-center items-center p-12">
                    <img alt="Purple computer monitor icon representing technology news"
                        class="w-12 h-12 text-[#A67CFF]" height="48"
                        src="https://storage.googleapis.com/a1aa/image/57f08202-7e76-4045-f5a9-4c1a6eab0514.jpg"
                        width="48" />
                </div>
                <div class="p-6">
                    <p class="text-[#A67CFF] text-xs font-semibold uppercase mb-1">
                        Technology
                    </p>
                    <h3 class="font-extrabold text-base leading-6 mb-3">
                        Breakthrough in Quantum Computing Announced
                    </h3>
                    <p class="text-[#64748B] text-sm leading-5 mb-6">
                        Scientists have announced a major breakthrough in quantum computing that could revolutionize
                        data processing speeds.
                    </p>
                    <div class="flex justify-between items-center text-[#64748B] text-xs">
                        <span>
                            6 hours ago
                        </span>
                        <a class="text-[#2CAC5B] font-medium hover:underline" href="#">
                            Read More →
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </div>

    {{-- {trends} --}}
    <main class="max-w-6xl mx-auto p-6">
        <h2 class="text-xl font-extrabold mb-6 text-slate-900">Trending Topics</h2>
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Most Read -->
            <section class="bg-white border rounded-lg p-6 flex-1 shadow-sm">
                <h3 class="font-extrabold mb-4 text-slate-900">Most Read</h3>
                <ul class="space-y-6">
                    <li>
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 font-extrabold text-lg min-w-[2rem]">01</span>
                            <div>
                                <p class="font-semibold leading-tight">Space Tourism Company Announces First Civilian
                                    Mission to Mars</p>
                                <p class="text-xs text-gray-400 mt-1">12.5K reads &bull; 3 hours ago</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 font-extrabold text-lg min-w-[2rem]">02</span>
                            <div>
                                <p class="font-semibold leading-tight">Renewable Energy Now Cheaper Than Fossil Fuels
                                    in Most Countries</p>
                                <p class="text-xs text-gray-400 mt-1">10.2K reads &bull; 5 hours ago</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 font-extrabold text-lg min-w-[2rem]">03</span>
                            <div>
                                <p class="font-semibold leading-tight">Major Breakthrough in Alzheimer's Research
                                    Offers Hope for Treatment</p>
                                <p class="text-xs text-gray-400 mt-1">9.7K reads &bull; 8 hours ago</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 font-extrabold text-lg min-w-[2rem]">04</span>
                            <div>
                                <p class="font-semibold leading-tight">Global Supply Chain Issues Expected to Ease by
                                    Year End</p>
                                <p class="text-xs text-gray-400 mt-1">8.3K reads &bull; 12 hours ago</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>

            <!-- Editor's Picks -->
            <section class="bg-white border rounded-lg p-6 flex-1 shadow-sm">
                <h3 class="font-extrabold mb-4 text-slate-900">Editor's Picks</h3>
                <ul class="space-y-6">
                    <li>
                        <div class="flex items-center gap-4">
                            <div class="bg-yellow-50 rounded-lg p-4 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <circle cx="12" cy="12" r="10" />
                                    <polygon points="10 8 16 12 10 16 10 8" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-yellow-600 uppercase mb-1">Documentary</p>
                                <p class="font-semibold leading-tight">Inside the World's Most Sustainable City</p>
                            </div>
                        </div>
                        <hr class="mt-4 border-t border-gray-200" />
                    </li>
                    <li>
                        <div class="flex items-center gap-4">
                            <div class="bg-emerald-100 rounded-lg p-4 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <path d="M6 3v12" />
                                    <path d="M18 3v12" />
                                    <path d="M6 15h12" />
                                    <path d="M12 15v6" />
                                    <path d="M9 21h6" />
                                    <path d="M9 3h6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-emerald-600 uppercase mb-1">Science</p>
                                <p class="font-semibold leading-tight">The Future of Clean Water Technology</p>
                            </div>
                        </div>
                        <hr class="mt-4 border-t border-gray-200" />
                    </li>
                    <li>
                        <div class="flex items-center gap-4">
                            <div class="bg-pink-100 rounded-lg p-4 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-pink-600 uppercase mb-1">Health</p>
                                <p class="font-semibold leading-tight">Mindfulness: The Science Behind the Wellness
                                    Trend</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </main>
</x-layouts.custome.header>
