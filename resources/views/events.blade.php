<x-layouts.app :title="__('News Page')">
    @livewireScriptConfig()
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class'
      }
    </script>

    <div class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen flex flex-col items-center justify-start p-4 transition">
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 relative transition">
          <!-- Header -->
          <div class="flex items-center justify-between mb-6">
            <button id="prev" class="text-gray-500 dark:text-gray-300 hover:text-black dark:hover:text-white text-2xl">&larr;</button>
            <h2 id="monthYear" class="text-xl font-semibold">April 2025</h2>
            <button id="next" class="text-gray-500 dark:text-gray-300 hover:text-black dark:hover:text-white text-2xl">&rarr;</button>
          </div>
      
          <!-- Weekday Labels -->
          <div class="grid grid-cols-7 text-center text-gray-500 dark:text-gray-400 mb-2 font-medium">
            <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
          </div>
      
          <!-- Calendar Dates -->
          <div id="calendar" class="grid grid-cols-7 gap-2 text-center text-sm">
            <!-- Filled by JS -->
          </div>
      
          <!-- Event List -->
          <div id="eventList" class="mt-8 space-y-2">
            <!-- JS fills events here -->
          </div>
        </div>
      
        <!-- Modal -->
        <div id="modal" class="fixed inset-0 hidden bg-black bg-opacity-40 flex items-center justify-center z-50">
          <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-sm text-gray-800 dark:text-gray-100">
            <h3 class="text-lg font-semibold mb-2" id="modalTitle">Event</h3>
            <p id="modalBody" class="text-gray-700 dark:text-gray-300"></p>
            <button onclick="closeModal()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Close</button>
          </div>
        </div>
      
        <script>
            window.addEventListener('load', () => {
                executeAll();
            });

            function executeAll(){
                const events = [
                { label: "meeting 1", month: 4, day: 13, year: 2025 },
                { label: "meeting 2", month: 5, day: 5, year: 2025 },
                { label: "meeting 3", month: 6, day: 29, year: 2025 }
              ];
          
              const calendar = document.getElementById("calendar");
              const monthYear = document.getElementById("monthYear");
              const prev = document.getElementById("prev");
              const next = document.getElementById("next");
          
              const modal = document.getElementById("modal");
              const modalTitle = document.getElementById("modalTitle");
              const modalBody = document.getElementById("modalBody");
          
              const toggleTheme = document.getElementById("toggleTheme");
              const html = document.documentElement;
          
              let currentDate = new Date();
          
              function openModal(title, body) {
                modalTitle.textContent = title;
                modalBody.textContent = body;
                modal.classList.remove("hidden");
              }
          
              window.closeModal = function () {
                modal.classList.add("hidden");
              };
          
              function renderCalendar(date) {
                calendar.innerHTML = "";
                const year = date.getFullYear();
                const month = date.getMonth();
          
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const startDay = firstDay.getDay();
                const totalDays = lastDay.getDate();
          
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;
          
                monthYear.textContent = date.toLocaleString("default", {
                  month: "long",
                  year: "numeric",
                });
          
                for (let i = 0; i < startDay; i++) {
                  calendar.innerHTML += `<div></div>`;
                }
          
                for (let i = 1; i <= totalDays; i++) {
                  const hasEvent = events.find(e => e.day === i && e.month - 1 === month && e.year === year);
                  const isToday = isCurrentMonth && i === today.getDate();
          
                  const div = document.createElement("div");
                  div.className = `p-2 rounded-lg cursor-pointer relative transition ${
                    isToday ? "bg-blue-500 text-white font-bold" : "hover:bg-gray-200 dark:hover:bg-gray-700"
                  } ${hasEvent ? "bg-yellow-100 dark:bg-yellow-800 border border-yellow-400 dark:border-yellow-600" : ""}`;
          
                  div.textContent = i;
          
                  if (hasEvent) {
                    div.classList.add("font-semibold", "text-yellow-900", "dark:text-yellow-200");
                    div.addEventListener("click", () => {
                      openModal("Event", hasEvent.label);
                    });
          
                    const dot = document.createElement("span");
                    dot.className = "absolute bottom-1 left-1/2 transform -translate-x-1/2 h-1.5 w-1.5 rounded-full bg-yellow-500";
                    div.appendChild(dot);
                  }
                  calendar.appendChild(div);
                }
          
                renderEventList();
              }
          
              function renderEventList() {
                const list = document.getElementById("eventList");
                list.innerHTML = "<h3 class='text-lg font-semibold mb-2'>All Events</h3>";
          
                const today = new Date();
                today.setHours(0, 0, 0, 0);
          
                const sortedEvents = [...events].sort((a, b) => {
                  const da = new Date(a.year, a.month - 1, a.day);
                  const db = new Date(b.year, b.month - 1, b.day);
                  return da - db;
                });
          
                sortedEvents.forEach(event => {
                  const eventDate = new Date(event.year, event.month - 1, event.day);
                  const isPast = eventDate < today;
          
                  const div = document.createElement("div");
                  div.className = `p-4 rounded-lg shadow text-sm transition ${
                    isPast
                      ? "bg-red-100 dark:bg-red-800 border border-red-300 dark:border-red-600 text-red-800 dark:text-red-200"
                      : "bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-600 text-green-800 dark:text-green-200"
                  }`;
          
                  div.innerHTML = `
                    <div><strong>${event.label}</strong></div>
                    <div>${eventDate.toDateString()}</div>
                  `;
          
                  list.appendChild(div);
                });
              }
          
              // Navigation
              prev.addEventListener("click", () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate);
              });
          
              next.addEventListener("click", () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate);
              });
              renderCalendar(currentDate);
            }
          </script>
          
      
      
    </div>
    
</x-layouts.app>