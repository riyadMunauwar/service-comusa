<div class="bg-black">
    <div class="container mx-auto py-10 md:py-24">
    @if(count($category->services) > 0)
        <h1 class="text-center text-2xl font-bold mb-6 md:mt-16 text-white">{{ $category->name }}</h1>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table
                    class="text-white min-w-full border text-center text-sm font-light dark:border-neutral-500">
                    <thead class="border-b font-medium dark:border-neutral-500 bg-red-600">
                      <tr>
                        <th
                          scope="col"
                          class="border-r px-6 py-4 dark:border-neutral-500">
                          Services
                        </th>
                        <th
                          scope="col"
                          class="border-r px-6 py-4 dark:border-neutral-500">
                          Delivery Time
                        </th>
                        <th
                          scope="col"
                          class="border-r px-6 py-4 dark:border-neutral-500">
                          Price
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($category->services as $service)

                            <tr class="dark:border-neutral-500 bg-white text-gray-800">

                                    <td
                                    class="whitespace-nowrap border px-6 py-4 font-medium dark:border-neutral-500">
                                        <a href="{{ route('service', ['service_slug' => $service->slug, 'id' => $service->id]) }}">
                                            {{ $service->name }}
                                        </a>
                                    </td>
                                    <td
                                    class="border whitespace-nowrap border-r font-medium px-6 py-4 dark:border-neutral-500">
                                    {{ $service->delivery_time }}
                                    </td>
                                    <td
                                    class="border whitespace-nowrap border-r font-medium px-6 py-4 dark:border-neutral-500">
                                    $ {{ $service->price }}
                                    </td>

                            </tr>

                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        @endif

        @foreach($category->children as $child)
        <h1 class="text-center text-2xl font-bold mb-6 md:mt-16 text-white">{{ $child->name }}</h1>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table
                    class="text-white min-w-full border text-center text-sm font-light dark:border-neutral-500">
                    <thead class="border-b font-medium dark:border-neutral-500 bg-red-600">
                      <tr>
                        <th
                          scope="col"
                          class="border-r px-6 py-4 dark:border-neutral-500">
                          Services
                        </th>
                        <th
                          scope="col"
                          class="border-r px-6 py-4 dark:border-neutral-500">
                          Delivery Time
                        </th>
                        <th
                          scope="col"
                          class="border-r px-6 py-4 dark:border-neutral-500">
                          Price
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($child->services as $service)

                            <tr class="dark:border-neutral-500 bg-white text-gray-800">

                                    <td
                                    class="whitespace-nowrap border px-6 py-4 font-medium dark:border-neutral-500">
                                        <a href="{{ route('service', ['service_slug' => $service->slug, 'id' => $service->id]) }}">
                                            {{ $service->name }}
                                        </a>
                                    </td>
                                    <td
                                    class="border whitespace-nowrap border-r font-medium px-6 py-4 dark:border-neutral-500">
                                    {{ $service->delivery_time }}
                                    </td>
                                    <td
                                    class="border whitespace-nowrap border-r font-medium px-6 py-4 dark:border-neutral-500">
                                    $ {{ $service->price }}
                                    </td>

                            </tr>

                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
