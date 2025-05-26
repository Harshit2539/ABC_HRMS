<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Dashboard</title>
  </head>
  <body class="bg-[#F9FAFC] text-[#1E293B] min-h-screen">
    <header class="flex items-center justify-between px-4 sm:px-6 md:px-10 py-3">
      <div class="flex items-center space-x-2"></div>
      <nav class="flex items-center space-x-6">
        <button id="welcomeBtn" class="text-xs px-3 py-1 rounded-full border border-[#CBD5E1] text-[#64748B] bg-white hover:bg-[#F1F5F9] transition">
          Welcome
        </button>
        <button id="dashboardBtn" class="text-xs px-3 py-1 rounded-full border border-[#CBD5E1] text-[#64748B] bg-white hover:bg-[#F1F5F9] transition">
          Dashboard
        </button>
      </nav>
      <div class="flex items-center space-x-4 text-[#64748B] text-lg"></div>
    </header>
 
    <main class="welcomeSection px-4 sm:px-6 md:px-10 pb-10 max-w-[1440px] mx-auto">
      <section class="relative bg-white rounded-b-[40px] shadow-md overflow-visible pt-8 pb-12 px-6 sm:px-10 mb-8">
        <img alt="Illustration of a city skyline" class="w-full h-[120px] object-cover rounded-b-[40px] absolute top-0 left-0 right-0" src="https://storage.googleapis.com/a1aa/image/c68e866b-75ff-4b67-5db0-5e21486357d3.jpg" style="z-index:0; pointer-events:none;" />
        <div class="relative z-10">
          <h2 class="text-lg font-normal text-[#1E293B] mb-1">{{$greeting}}</h2>
          <p class="text-sm text-[#475569] flex items-center gap-1">
            Let's do great things together.
            <span class="text-[#EF4444] text-base">✍️</span>
            <span class="text-[#FACC15] text-base">🌟</span>
          </p>
        </div>
      </section>
     
      <section class="mb-8">
        <h3 class="text-sm font-semibold text-[#334155] mb-2">My Favourites</h3>
        <div class="flex space-x-2 overflow-x-auto scrollbar-hide pb-2" style="scrollbar-width:none;-ms-overflow-style:none;">
          <div class="flex-shrink-0 w-28 h-20 rounded-md bg-[#E0E7FF] border border-[#CBD5E1] flex flex-col items-center justify-center space-y-1 px-2">
            <a href="{{route('employees.list')}}" aria-label="Add Employee" class="w-6 h-6 rounded bg-[#CBD5E1] flex items-center justify-center text-[#64748B] text-xs">
              <i class="fa fa-user-plus"></i>
            </a>
            <p class="text-xs text-[#475569] text-center leading-tight font-normal">Add Employee</p>
          </div>
 
          <div class="flex-shrink-0 w-28 h-20 rounded-md bg-[#FDE68A] border border-[#FCD34D] flex flex-col items-center justify-center space-y-1 px-2">
            <a href="{{route('payroll.list')}}" aria-label="Process Payroll" class="w-6 h-6 rounded bg-[#FCD34D] flex items-center justify-center text-[#92400E] text-xs">
              <i class="fa fa-file"></i>
            </a>
            <p class="text-xs text-[#92400E] text-center leading-tight font-normal">Process Payroll</p>
          </div>
        </div>
      </section>
     
      <section class="flex flex-col lg:flex-row gap-6 items-stretch">
        <!-- Main Card -->
        <div class="flex bg-white rounded-md shadow border border-gray-300 p-6 w-full lg:max-w-4xl">
          <!-- Left Panel -->
          <div class="flex flex-col items-center justify-center rounded-md border border-gray-300 bg-gray-50 w-28 p-4 text-center">
            <img src="https://storage.googleapis.com/a1aa/image/8c3a2867-fb06-4b22-b82f-e01b2477a128.jpg" alt="Icon" class="mb-2 w-10 h-10" />
            <!-- <p class="text-yellow-500 font-bold text-3xl">0</p>
            <p class="text-xs text-slate-600">Things to review</p> -->
            <p class="text-yellow-500 font-bold text-2xl mt-2">{{$helpDeskCount + $leaveCount + $travelCount}}</p>
            <p class="text-xs text-slate-600">Things to monitor</p>
          </div>
 
          <!-- Right Panel -->
          <div class="ml-6 flex-1 flex flex-col justify-between p-10">
            <div class="space-y-6">
              <h3 class="text-lg font-semibold text-slate-800">My Tasks</h3>
              <!-- Task Items -->
              <div class="space-y-4">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-semibold text-slate-800">Help Desk</p>
                    <p class="text-xs text-slate-500">{{$helpDeskCount}} Helpdesk details you can monitor.</p>
                  </div>
                  <a href="{{route('active.help_request')}}" class="text-blue-600 text-sm hover:underline">Monitor</a>
                </div>
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-semibold text-slate-800">Leave</p>
                    <p class="text-xs text-slate-500">{{$leaveCount}} Leave details you can monitor.</p>
                  </div>
                  <a href="{{route('leave.request.listing')}}" class="text-blue-600 text-sm hover:underline">Monitor</a>
                </div>
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm font-semibold text-slate-800">Travel</p>
                    <p class="text-xs text-slate-500">{{$travelCount}} Travel details you can monitor.</p>
                  </div>
                  <a href="{{route('travel.request.listing')}}" class="text-blue-600 text-sm hover:underline">Monitor</a>
                </div>
              </div>
            </div>
          </div>
        </div>
 
        <!-- Updates Panel -->
        <aside class="w-full lg:w-80 bg-[#F3E8FF] rounded-md shadow border border-[#E9D5FF] p-4 flex flex-col justify-between">
          <h3 class="text-sm font-semibold text-[#6B21A8] mb-3">Latest Updates</h3>
          <div class="space-y-4 text-xs text-[#6B21A8] font-semibold">
            <article>
              <p class="text-[10px] font-normal text-[#6B21A8] mb-1">30 Apr 2023</p>
              <p><span class="text-[#EF4444]">✍️</span> Transform Your Workplace: New Ways to Engage and Grow Your Team!</p>
            </article>
            <article>
              <p class="text-[10px] font-normal text-[#6B21A8] mb-1">06 Feb 2023</p>
              <p><span class="text-[#EF4444]">✍️</span> Update on Greater Chennai Corporation (GCC) Professional Tax Slabs</p>
            </article>
            <article>
              <p class="text-[10px] font-normal text-[#6B21A8] mb-1">23 Feb 2023</p>
              <p>Stay on Track: IT & FBP Declarations Just Got Easier! <span class="text-[#EF4444]">✍️</span></p>
            </article>
            <article>
              <p class="text-[10px] font-normal text-[#6B21A8] mb-1">04 Dec 2024</p>
              <p>Customize Attendance Calendars to Adjust Different Employees' Work Schedules</p>
            </article>
          </div>
        </aside>
      </section>
    </main>
  </body>