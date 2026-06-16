 {{-- TOP MENU --}}
            <div
    class="bg-white rounded-2xl border border-gray-100 p-2 mb-8 flex items-center gap-2 overflow-x-auto shadow-sm">

    {{-- DASHBOARD --}}
    <a href="{{ route('manufacturer.dashboard') }}"
        class="px-5 py-2.5 rounded-xl text-[14px] font-medium whitespace-nowrap
        {{ request()->routeIs('manufacturer.dashboard')
            ? 'bg-primary text-white'
            : 'text-gray-500 hover:bg-slate-50' }}">

        Dashboard

    </a>

    {{-- PRODUCTS --}}
    <a href="{{ route('manufacturer.product.list') }}"
        class="px-5 py-2.5 rounded-xl text-[14px] font-medium whitespace-nowrap
        {{ request()->routeIs('manufacturer.product.*')
            ? 'bg-primary text-white'
            : 'text-gray-500 hover:bg-slate-50' }}">

        Products Management

    </a>

    {{-- PROFILE --}}
    <a href="{{ route('manufacturer.profile') }}"
        class="px-5 py-2.5 rounded-xl text-[14px] font-medium whitespace-nowrap
        {{ request()->routeIs('manufacturer.profile')
            ? 'bg-primary text-white'
            : 'text-gray-500 hover:bg-slate-50' }}">

        Profile Management

    </a>

</div>

            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">

                    {{ session('success') }}

                </div>

            @endif

            {{-- ERROR --}}
            @if(session('error'))

                <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">

                    {{ session('error') }}

                </div>

            @endif