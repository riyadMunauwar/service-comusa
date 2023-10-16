<section class="bg-gray-900 text-white" style="background-image: url('{{ $this->banner->bannerUrl() }}'); background-postition: center; background-repeat: no-repeate; background-attachment: fixed">
    <div
      class="mx-auto max-w-screen-xl px-4 py-32 lg:flex lg:h-screen lg:items-center"
    >
      <div class="mx-auto max-w-3xl text-center">
        <h1
          class="bg-gradient-to-r from-white via-gray-200 to-white bg-clip-text text-3xl font-extrabold text-transparent sm:text-5xl"
        >
          {{ $this->banner->title }}
          {{-- <span class="sm:block"> OUR DEDICATED TEAM SERVES YOU ROUND THE CLOCK </span> --}}
        </h1>

        <p class="mx-auto mt-4 max-w-xl sm:text-xl/relaxed">
          {{ $this->banner->sub_title_1 }} </br> {{ $this->banner->sub_title_2 }}
        </p>

        <div class="mt-8 flex flex-wrap justify-center gap-4">
          <a
            class="block w-full rounded border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
            href=""
          >
            LOGIN
          </a>

          <a
            class="block w-full rounded border border-blue-600 px-12 py-3 text-sm font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring active:bg-blue-500 sm:w-auto"
            href=""
          >
            REGISTER
          </a>
        </div>
      </div>
    </div>
  </section>
