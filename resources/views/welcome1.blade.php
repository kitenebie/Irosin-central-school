<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Featured News Card
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#f0f4f9] p-6">
  <main class="max-w-6xl mx-auto">
   <section class="flex flex-col md:flex-row bg-white rounded-xl shadow-md overflow-hidden" style="min-height: 280px">
    <div class="relative flex-1 flex items-center justify-center" style="background: linear-gradient(90deg, #4a90e2 0%, #8e44fd 100%)">
     <span class="absolute top-4 left-4 text-xs font-semibold text-white bg-[#e03e2f] rounded-full px-3 py-1 tracking-wide select-none">
      FEATURED
     </span>
     <img alt="Icon of a newspaper in white on a blue to purple gradient background" aria-hidden="true" class="opacity-30 w-24 h-24" height="96" src="https://storage.googleapis.com/a1aa/image/e55c2198-f331-4308-9aec-1846007583c6.jpg" width="96"/>
    </div>
    <div class="flex-1 p-6 md:p-8 flex flex-col justify-center">
     <span class="text-[#0066ff] font-semibold text-xs tracking-wide uppercase mb-2">
      Technology
     </span>
     <h2 class="font-extrabold text-black text-xl md:text-2xl leading-tight mb-4">
      Breakthrough in Quantum Computing Promises to Revolutionize Data Processing
     </h2>
     <p class="text-gray-600 text-sm md:text-base mb-6 max-w-md leading-relaxed">
      Scientists have achieved a major milestone in quantum computing that could transform everything from medicine to climate modeling. The new technology processes complex calculations in seconds that would take traditional supercomputers years to complete.
     </p>
     <div class="flex items-center space-x-3 mb-6">
      <div aria-hidden="true" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600">
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
     <button class="bg-[#0066ff] text-white text-sm font-semibold rounded-md px-4 py-2 w-max hover:bg-[#0051cc] transition-colors">
      Read Full Story
     </button>
    </div>
   </section>
  </main>
 </body>
</html>
