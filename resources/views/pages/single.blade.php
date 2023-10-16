<div class="bg-black">
    <div class="container mx-auto py-10 md:py-16">
        <h1 class="text-white text-center font-bold text-3xl"> {{ $service->name }} </h1>
        <div class="mt-10 grid grid-cols-1 md:grid-cols-5 gap-10">
            <div class="col-span-3">
                <h3 class="bg-red-600 text-white text-xl  text-center py-2">Description</h3>
                <div class="bg-white p-5">
                    {!! $service->description !!}
                </div>
            </div>
            <div class="col-span-2">
                <div>
                    <h3 class="bg-red-600 text-white text-xl  text-center py-2">Price</h3>
                    <div class="bg-white p-5">
                        <h2 class="text-center text-2xl">$ {{ $service->price }}</h2>
                    </div>
                </div>

                <div class="mt-10 bg-white">
                    <h3 class="bg-red-600 text-white text-xl  text-center py-2">Information</h3>
                    <div class="bg-white p-5">
                        <div class="flow-root">
                            <dl class="-my-3 divide-y divide-gray-100 text-sm">
                              <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Delivery time</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $service->delivery_time }}</dd>
                              </div>

                              <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Bulk orders allowed</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $service->is_bulk_order_allowed }} </dd>
                              </div>

                              <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Order type</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $service->order_type }}</dd>
                              </div>

                              <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Submit to verified allowed</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $service->is_submit_to_verified_allowed }}</dd>
                              </div>

                              <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Service type</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                  {{ $service->service_type }}
                                </dd>
                              </div>

                              <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Cancellation allowed</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                  {{ $service->is_cancelation_allowed }}
                                </dd>
                              </div>
                            </dl>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
