@include('frontend.layouts.header-link')


    <!-- 1. Top Bar -->
      @include('frontend.layouts.top_bar')


    <!-- 2. Main Header (Sticky) -->
   @include('frontend.layouts.main_header')

    <!-- Main Content -->
    <section
        class="max-w-4xl mx-auto my-14 bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
        <form id="rfqForm">
            <div
                class="bg-white p-6 lg:p-8 rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] max-w-4xl mx-auto">

                <h2 class="text-[18px] font-bold text-gray-900 mb-6 pb-4 border-b border-gray-50">
                    Product Information
                </h2>

                <div class="space-y-5">

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                            <span class="text-red-500">*</span> Product Name:
                        </label>
                        <input type="text" id="product_name" placeholder="Enter a specific product name."
                            class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                Category:
                            </label>
                            <div class="relative">
                                <select name="category_id" id="category_id"
                                    class="w-full h-11 pl-4 pr-8 bg-slate-50 border border-gray-200 rounded-xl">
                                    <option value="">Please select</option>

                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i data-lucide="chevron-down"
                                    class="w-4 h-4 text-gray-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>
                        </div>
                         <div>
                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                Sub Category:
                            </label>
                            <div class="relative">
                                <select name="sub_category_id" id="sub_category_id"
                                    class="w-full h-11 pl-4 pr-8 bg-slate-50 border border-gray-200 rounded-xl">
                                    <option value="">Select Sub Category</option>
                                </select>
                                <i data-lucide="chevron-down"
                                    class="w-4 h-4 text-gray-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                <span class="text-red-500">*</span> Purchase Quantity:
                            </label>
                            <div class="flex gap-2">
                                <input type="number"  id="quantity"
                                    class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">
                                <div class="relative w-32 shrink-0">
                                    <select   id="unit"
                                        class="w-full h-11 pl-4 pr-8 bg-slate-50 border border-gray-200 rounded-xl text-[13px] text-gray-600 focus:outline-none focus:border-primary focus:bg-white transition-colors appearance-none cursor-pointer">
                                        <option>Piece(s)</option>
                                        <option>Set(s)</option>
                                        <option>Kilogram(s)</option>
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                            <span class="text-red-500">*</span> Details:
                        </label>

                        <div
                            class="border border-gray-200 rounded-xl overflow-hidden bg-slate-50 focus-within:border-primary focus-within:bg-white transition-colors shadow-sm">
                            <textarea rows="4"  id="details"
                                placeholder="Describe the product you want to source.&#10;You may include: Color, Material, Size, Weight, Packaging and certificate requirements and/or others."
                                class="w-full p-4 bg-transparent text-[13px] focus:outline-none resize-y placeholder-gray-400 leading-relaxed"></textarea>

                        </div>
                    </div>
                    <div class="pt-6 mt-2 border-t border-gray-100 flex items-center justify-end gap-3">
                        <button type="button"
                            class="px-6 py-3 text-[13px] font-bold text-gray-500 hover:text-gray-900 bg-white hover:bg-gray-50 border border-gray-200 rounded-xl transition-colors cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white hover:bg-primaryHover rounded-xl text-[13px] font-bold shadow-md shadow-primary/20 transition-all flex items-center gap-2 cursor-pointer">
                            <i data-lucide="send" class="w-4 h-4"></i> Submit Requirement
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary text-gray-300 pt-12 pb-6 text-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 border-b border-gray-700 pb-10">

                <div class="col-span-2 lg:col-span-1">
                    <a href="{{ route('home') }}"  class="flex items-center gap-2 text-2xl font-bold text-white tracking-tight mb-4">
                        <i data-lucide="globe" class="text-primary w-8 h-8"></i>
                        <span>India Buy</span>
                    </a>
                    <p class="text-gray-400 mb-4">The leading B2B e-commerce platform connecting global buyers with
                        Indian suppliers and manufacturers.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i data-lucide="facebook"
                                class="w-5 h-5"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i data-lucide="twitter"
                                class="w-5 h-5"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i data-lucide="linkedin"
                                class="w-5 h-5"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i data-lucide="youtube"
                                class="w-5 h-5"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-4">Discover</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition">Categories</a></li>
                        <li><a href="#" class="hover:text-primary transition">Sourcing Requests</a></li>
                        <li><a href="#" class="hover:text-primary transition">Ready to Ship</a></li>
                        <li><a href="#" class="hover:text-primary transition">Trade Shows</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-4">About Us</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition">About India Buy</a></li>
                        <li><a href="#" class="hover:text-primary transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-primary transition">Site Map</a></li>
                        <li><a href="#" class="hover:text-primary transition">Careers</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-4">Help</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition">Customer Service</a></li>
                        <li><a href="#" class="hover:text-primary transition">Submit a Dispute</a></li>
                        <li><a href="#" class="hover:text-primary transition">Policies & Rules</a></li>
                        <li><a href="#" class="hover:text-primary transition">Get Paid for Your Feedback</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-4">For Suppliers</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition">Supplier Memberships</a></li>
                        <li><a href="#" class="hover:text-primary transition">Learning Center</a></li>
                        <li><a href="#" class="hover:text-primary transition">Partner Program</a></li>
                    </ul>
                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between items-center pt-6 text-xs text-gray-500">
                <p>&copy; 2026 India Buy. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-gray-300">Terms of Use</a>
                    <a href="#" class="hover:text-gray-300">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-300">Cookies</a>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {

    $('#category_id').change(function () {

    let category_id = $(this).val();

    $.ajax({
        url: "{{ url('/get-subcategories') }}",
        type: "GET",
        data: {
            category_id: category_id
        },
        success: function (response) {

            $('#sub_category_id').html(
                '<option value="">Select Sub Category</option>'
            );

            $.each(response, function (index, item) {

                $('#sub_category_id').append(
                    '<option value="' + item.id + '">' +
                    item.sub_category_name +
                    '</option>'
                );

            });

        }
    });

});

});
</script>
    <script>
        
        // Initialize Swiper after DOM is loaded
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.trendingSwiper', {
                slidesPerView: 1,
                spaceBetween: 16,
                // Link custom buttons to Swiper's navigation
                navigation: {
                    nextEl: '.trending-next',
                    prevEl: '.trending-prev',
                },
                // Responsive breakpoints
                breakpoints: {
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 2,
                    },
                    // when window width is >= 768px
                    768: {
                        slidesPerView: 3,
                    },
                    // when window width is >= 1024px
                    1024: {
                        slidesPerView: 4,
                    },
                    // when window width is >= 1280px
                    1280: {
                        slidesPerView: 5,
                    }
                }
            });

            // Re-initialize lucide icons if needed after swiper loads
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>

    <!-- Simple JavaScript for Carousel & Icons -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const totalSlides = slides.length;

        function updateSlider() {
            slides.forEach((slide, index) => {
                slide.style.opacity = index === currentSlide ? '1' : '0';
            });
            dots.forEach((dot, index) => {
                dot.style.opacity = index === currentSlide ? '1' : '0.5';
            });
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        // Auto slide every 5 seconds
        setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }, 5000);
    </script>
    <script>

document.getElementById('rfqForm')
.addEventListener('submit', function(e){

    e.preventDefault();

    fetch("{{ route('rfq.store') }}", {

        method: "POST",

        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },

        body: JSON.stringify({

            product_name : document.getElementById('product_name').value,

            category_id : document.getElementById('category_id').value,

            sub_category_id : document.getElementById('sub_category_id').value,

            quantity : document.getElementById('quantity').value,

            unit : document.getElementById('unit').value,

            details : document.getElementById('details').value

        })

    })
    .then(res => res.json())
    .then(data => {

        if (data.login) {

            Swal.fire({
                icon: 'warning',
                title: 'Login Required',
                text: data.message
            }).then(() => {

                window.location.href = "{{ route('login') }}";

            });

            return;
        }

        if (data.status) {

            Swal.fire({
                icon: 'success',
                title: data.message
            });

            document.getElementById('rfqForm').reset();
        }

    })
    .catch(error => {

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Something went wrong',
            showConfirmButton: false,
            timer: 2000
        });

        console.log(error);

    });

});


</script>

