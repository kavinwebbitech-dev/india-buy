@include('frontend.layouts.header-link')
@include('frontend.layouts.top_bar')
@include('frontend.layouts.main_header')
@include('frontend.layouts.navbar')

@php
    // Safe JSON Parsing allocations from schema arrays
    $images = json_decode($property->proerty_image ?? json_decode($property->property_image ?? '[]', true), true);
    $features = json_decode($property->features ?? '[]', true);
    $specifications = json_decode($property->specification ?? '[]', true);
    $datasheets = json_decode($property->datasheet ?? '[]', true);
    $documents = json_decode($property->documents ?? '[]', true);
@endphp

<div class="min-h-screen bg-slate-50/50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            
            {{-- HERO / COVER IMAGE BANNER --}}
            <div class="h-80 w-full bg-slate-200 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                     class="w-full h-full object-cover" alt="Cover Banner">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-transparent"></div>
                
                <div class="absolute top-6 right-6">
                    @if($property->status == 1)
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold bg-emerald-500 text-white shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span> Active Listing
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-amber-500 text-white shadow-sm">
                            Inactive
                        </span>
                    @endif
                </div>
            </div>

            {{-- PROFILE META HEADER --}}
            <div class="px-6 pb-8 relative flex flex-col items-center text-center -mt-20 border-b border-gray-100">
                <div class="w-36 h-36 rounded-3xl border-4 border-white bg-white shadow-xl overflow-hidden relative z-10 mb-4">
                    @if($vendor && $vendor->company_logo)
                        <img src="{{ asset('uploads/vendor_logo/'.$vendor->company_logo) }}" class="w-full h-full object-cover" alt="Logo">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($vendor->company_name ?? 'Property Info') }}&background=e64545&color=fff" class="w-full h-full object-cover" alt="Logo Placeholder">
                    @endif
                </div>

                <div class="flex items-center justify-center gap-2 mb-1">
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">
                        {{ $vendor->company_name ?? 'Independent Provider' }}
                    </h1>
                    @if(($vendor->status ?? 0) == 1)
                        <i data-lucide="shield-check" class="w-7 h-7 text-emerald-500 shrink-0" fill="currentColor"></i>
                    @endif
                </div>

                <p class="text-sm font-medium text-gray-500 mb-4">
                    {{ $vendorType->vendor_name ?? 'Real Estate Agent' }} &bull; {{ $business->business_name ?? 'Verified Partner' }}
                </p>

                <div class="inline-flex items-center px-6 py-2.5 bg-primary/10 text-primary rounded-full text-base font-bold shadow-sm">
                    {{ $property->property_title }}
                </div>
            </div>

            {{-- CORE SPEC METRICS GRID ROW --}}
            <div class="grid grid-cols-2 md:grid-cols-4 border-b border-gray-100 bg-slate-50/50">
                <div class="p-6 text-center border-r border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 block mb-1">Target Price</span>
                    <span class="text-2xl font-black text-primary">{{ $property->price ? '₹' . number_format($property->price) : 'On Request' }}</span>
                </div>
                <div class="p-6 text-center border-r border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 block mb-1">Total Plot Area</span>
                    <span class="text-xl font-bold text-gray-800">{{ $property->total_area ?? 'N/A' }} Sq.Ft.</span>
                </div>
                <div class="p-6 text-center border-r border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 block mb-1">Built-Up Footprint</span>
                    <span class="text-xl font-bold text-gray-800">{{ $property->built_up_area ?? 'N/A' }} Sq.Ft.</span>
                </div>
                <div class="p-6 text-center">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 block mb-1">Net Carpet Area</span>
                    <span class="text-xl font-bold text-gray-800">{{ $property->carpet_area ?? 'N/A' }} Sq.Ft.</span>
                </div>
            </div>

            {{-- DETAIL ANALYSIS VIEWPORT SPLIT LAYOUT --}}
            <div class="grid lg:grid-cols-3 gap-8 p-6 lg:p-8">
                
                <div class="lg:col-span-2 space-y-8">
                    
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-primary"></i> Property Structural Overview
                        </h3>
                        <p class="text-sm leading-7 text-gray-600 whitespace-pre-line">
                            {{ $property->description ?? 'No extensive description text provided for this listing asset.' }}
                        </p>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                            <i data-lucide="building-2" class="w-5 h-5 text-primary"></i> Extended Building Parameters
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <span class="text-xs text-gray-400 block mb-1">Classification Type</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $property->property_type }}</span>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <span class="text-xs text-gray-400 block mb-1">Listing Intention</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $property->property_for }}</span>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <span class="text-xs text-gray-400 block mb-1">Development Phase</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $property->project_status ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <span class="text-xs text-gray-400 block mb-1">Structural Framework</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $property->construction_type ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <span class="text-xs text-gray-400 block mb-1">Total Storeys / Floors</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $property->floors ?? 'N/A' }} Floors</span>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <span class="text-xs text-gray-400 block mb-1">Total Sub-Units</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $property->units ?? 'N/A' }} Available</span>
                            </div>
                        </div>
                    </div>

                    @if(!empty($specifications))
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i data-lucide="sliders" class="w-5 h-5 text-primary"></i> Complete Line Item Specifications
                        </h3>
                        <div class="grid md:grid-cols-2 gap-3.5">
                            @foreach($specifications as $spec)
                                <div class="flex items-center justify-between border border-gray-100 rounded-xl px-4 py-3 bg-slate-50/30">
                                    <span class="font-bold text-sm text-gray-600">{{ $spec['key'] ?? 'Parameter' }}</span>
                                    <span class="text-sm text-gray-800 font-medium bg-white px-2.5 py-1 rounded-lg border border-gray-100">{{ $spec['value'] ?? 'N/A' }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(!empty($features))
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-5 h-5 text-primary"></i> Included Premium Features
                        </h3>
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach($features as $feature)
                                <div class="flex items-start gap-3 p-3 rounded-xl border border-dashed border-gray-200 hover:bg-slate-50 transition">
                                    <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ $feature['key'] ?? '' }} : <span class="font-normal text-gray-600">{{ $feature['value'] ?? '' }}</span>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="space-y-6">
                    
                    <div class="bg-slate-900 text-white rounded-2xl p-6 shadow-md relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>
                        <h3 class="text-base font-bold mb-3 flex items-center gap-2">
                            <i data-lucide="info" class="w-4 h-4 text-primary"></i> About Corporate Entity
                        </h3>
                        <p class="text-xs leading-relaxed text-slate-300 line-clamp-4 mb-4">
                            {{ $vendor->about_us ?? 'No extended overview provided by this company profile.' }}
                        </p>
                        <div class="text-xs text-slate-400 border-t border-slate-800 pt-3">
                            <span class="block font-medium">Inbound Channels</span>
                            <span class="font-bold text-white text-sm break-all">{{ $vendor->email ?? 'Not Configured' }}</span>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i> Geographic Placement
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-primary pl-3">
                                <span class="text-xs text-gray-400 block font-medium">Verified Core Address</span>
                                <h4 class="font-bold text-gray-800 text-sm mt-0.5">{{ $property->address }}</h4>
                            </div>
                            <div class="border-l-4 border-slate-300 pl-3">
                                <span class="text-xs text-gray-400 block font-medium">Micro-Market Landmark</span>
                                <h4 class="font-bold text-gray-800 text-sm mt-0.5">{{ $property->landmark }}</h4>
                            </div>
                            <div class="bg-slate-50 text-center py-2.5 rounded-xl border border-gray-100 text-xs font-bold text-gray-600">
                                {{ $property->city }}, {{ $property->state }}
                            </div>
                        </div>
                    </div>

                    @if(!empty($datasheets) || !empty($documents))
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i data-lucide="folder-down" class="w-4 h-4 text-primary"></i> Asset Vault Attachments
                        </h3>
                        <div class="space-y-2.5">
                            @foreach($datasheets as $file)
                                <a href="{{ asset('uploads/relastate/documents/'.$file) }}" target="_blank"
                                   class="flex items-center justify-between bg-slate-50 hover:bg-primary/5 border border-gray-100 p-3 rounded-xl transition text-left group">
                                    <span class="text-xs font-bold text-gray-700 truncate max-w-[180px]">📄 {{ $file }}</span>
                                    <i data-lucide="download" class="w-4 h-4 text-gray-400 group-hover:text-primary transition-colors"></i>
                                </a>
                            @endforeach

                            @foreach($documents as $doc)
                                <a href="{{ asset('uploads/relastate/documents/'.$doc) }}" target="_blank"
                                   class="flex items-center justify-between bg-slate-50 hover:bg-primary/5 border border-gray-100 p-3 rounded-xl transition text-left group">
                                    <span class="text-xs font-bold text-gray-700 truncate max-w-[180px]">💼 Legal Doc: {{ $doc }}</span>
                                    <i data-lucide="download" class="w-4 h-4 text-gray-400 group-hover:text-primary transition-colors"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            {{-- FOOTER CONTAINER: FULL-WIDTH GRID IMAGE GALLERY --}}
            @if(!empty($images))
            <div class="px-6 lg:px-8 pb-8 pt-4 border-t border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                    <i data-lucide="images" class="w-5 h-5 text-primary"></i> Immersive Photographic Gallery
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($images as $image)
                    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm aspect-video bg-slate-50 relative group cursor-pointer">
                        <img src="{{ asset('uploads/relastate/images/'.$image) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Gallery Media Image">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@include('frontend.layouts.footer')

<script>
    // Initialize Uniform Lucide Framework Icons After Content Mount
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>