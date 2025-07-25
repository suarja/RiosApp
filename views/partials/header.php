    <header class="inset-x-0 z-50 top-0 absolute">
      <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
          <a href="/" class="-m-1.5 p-1.5 cursor-pointer">
            <span class="sr-only">
              <p class="text-black"><?php $riosName; ?></p>
            </span>
            <img class="h-16 w-auto rounded-full" src="/public/rios-logo.png" alt="" />
          </a>
        </div>
        <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
          <!-- <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Rios</a> -->
          <a href="/player" class="text-sm font-semibold leading-6 text-gray-900">Player Stats</a>
          <a href="/players" class="text-sm font-semibold leading-6 text-gray-900">La Team</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <?php if ($isLogged) : ?>
            <a href="/logout" class="text-sm font-semibold leading-6 text-gray-900">Logout <span aria-hidden="true">&rarr;</span></a>
          <?php else : ?>
            <a href="/login" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
          <?php endif; ?>
        </div>
        </div>
      </nav>
      <!-- Mobile menu, show/hide based on menu open state. -->
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <!-- <div class="lg:hidden" role="dialog" aria-modal="true">
     
    <div class="fixed inset-0 z-50"></div>
    <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
      <div class="flex items-center justify-between">
        <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
        </a>
        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Close menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="mt-6 flow-root">
        <div class="-my-6 divide-y divide-gray-500/10">
          <div class="space-y-2 py-6">
            <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Rios</a>
            <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">La Team</a>
            <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base
              font-semibold
            </div>
            <div class=" py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
          </div>
        </div>
      </div>
    </div>
</div> -->
    </header>