<section class="py-16 bg-black">
    <div class="container mx-auto">
        <h2 class="text-white text-3xl font-bold sm:text-4xl mb-10">Featured Services</h2>
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

            @foreach($services as $service)
                <a href="#" class="group relative block">
                    <div class="relative h-[350px] sm:h-[450px]">
                        <img
                        src="{{ $service->thumbnailUrl() }}"
                        alt=""
                        class="absolute inset-0 h-full w-full object-cover opacity-100"
                        />
                    </div>

                    <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                        <h3 class="bg-black text-xl font-bold text-white px-6 py-2">{{ $service->name }}</h3>

                        <span
                        class="mt-3 inline-block bg-black px-5 py-3 text-xs font-medium uppercase tracking-wide text-white"
                        >
                        $ {{ $service->price }}
                        </span>
                    </div>
                </a>
            @endforeach

            <div class="mt-10">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</section>
