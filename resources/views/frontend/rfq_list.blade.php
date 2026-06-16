@include('frontend.layouts.header-link')


    @include('frontend.layouts.top_bar')

    @include('frontend.layouts.main_header')

    @include('frontend.layouts.navbar')

    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- PAGE TITLE --}}
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-8">

            <h1 class="text-[22px] font-bold text-center text-gray-900">
                All RFQ
            </h1>

        </div>

        <section class="mb-8">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-xl font-bold text-gray-900">
                    RFQ List
                </h2>

                <span class="text-sm text-gray-500">
                    {{ $rfqs->total() }} Requirements
                </span>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($rfqs as $rfq)
                    <div
                        class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all duration-300 flex flex-col group">

                        {{-- Header --}}
                        <div class="bg-primary/5 p-5 border-b border-gray-100">

                            <div class="flex justify-between items-start">

                                <div>

                                    <h3 class="text-lg font-bold text-gray-900 line-clamp-1">
                                        {{ $rfq->product_name }}
                                    </h3>

                                    <p class="text-xs text-gray-500 mt-1">
                                        RFQ #{{ $rfq->id }}
                                    </p>

                                </div>

                                <button type="button" onclick="deleteRfq({{ $rfq->id }})"
                                    class="text-red-500 hover:text-red-700">

                                    <i data-lucide="trash-2" class="w-5 h-5"></i>

                                </button>

                            </div>

                        </div>

                        {{-- Content --}}
                        <div class="p-5 flex flex-col flex-1">

                            <div class="space-y-3 mb-4">

                                {{-- Category --}}
                                <div class="flex justify-between">
                                    <span class="text-gray-500 text-sm">
                                        Category
                                    </span>

                                    <span class="font-semibold text-gray-800 text-right">
                                        {{ $rfq->categorydetails?->category_name ?? '-' }}
                                    </span>
                                </div>

                                {{-- Sub Category --}}
                                <div class="flex justify-between">
                                    <span class="text-gray-500 text-sm">
                                        Sub Category
                                    </span>

                                    <span class="font-semibold text-gray-800 text-right">
                                        {{ $rfq->subCategory?->sub_category_name ?? '-' }}
                                    </span>
                                </div>

                                {{-- Quantity --}}
                                <div class="flex justify-between">
                                    <span class="text-gray-500 text-sm">
                                        Quantity
                                    </span>

                                    <span class="font-semibold text-gray-800">
                                        {{ $rfq->quantity }} {{ $rfq->unit }}
                                    </span>
                                </div>

                            </div>

                            {{-- Details --}}
                            <div class="border-t border-gray-100 pt-4">

                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ $rfq->details }}
                                </p>

                            </div>

                            {{-- Footer --}}
                            <div class="mt-auto pt-5">

                                <div class="flex items-center justify-between">

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-600">
                                        Active
                                    </span>

                                    <span class="text-xs text-gray-400">
                                        {{ $rfq->created_at?->format('d M Y') }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-3 text-center py-12">

                        <h3 class="text-lg font-semibold text-gray-700">
                            No RFQs Found
                        </h3>

                        <p class="text-gray-500 mt-2">
                            No requirements available at the moment.
                        </p>

                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $rfqs->links() }}
            </div>

        </section>




    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteRfq(id) {
            Swal.fire({
                title: 'Delete RFQ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete'
            }).then((result) => {

                if (result.isConfirmed) {

                    let url = "{{ route('rfq.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {

                            if (data.status) {

                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }

                        });

                }

            });
        }
    </script>
    @include('frontend.layouts.footer')
