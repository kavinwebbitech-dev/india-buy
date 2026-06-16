 <!-- Footer -->
    <footer class="bg-secondary text-gray-300 pt-12 pb-6 text-sm">
        <div class="max-w-full mx-auto px-2">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 border-b border-gray-700 pb-10">

                <div class="col-span-2 lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-bold text-white tracking-tight mb-4">
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

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // 1. Trending Products Swiper
        const productSwiper = new Swiper('.trendingSwiper', {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: true, // Enable infinite loop for services
            
            // --- NEW: Autoplay Configuration ---
            autoplay: {
                delay: 3000, // 3000ms = 3 seconds delay before moving to next slide
                disableOnInteraction: false, // Keeps auto-scrolling even after user clicks/swipes
                pauseOnMouseEnter: true, // Pauses scroll when user hovers over a product
            },
            // -----------------------------------

            navigation: {
                nextEl: '.trending-next',
                prevEl: '.trending-prev',
            },
            breakpoints: {
                480: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 4 },
                1280: { slidesPerView: 5 }
            }
        });

        // 2. Trending Services Swiper
        const serviceSwiper = new Swiper('.trendingService', {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: true, // Enable infinite loop for services
            
            // --- NEW: Autoplay Configuration ---
            autoplay: {
                delay: 4000, // 4000ms = 4 seconds (slightly different so they don't slide at the exact same time)
                disableOnInteraction: false,
                pauseOnMouseEnter: true, 
            },
            // -----------------------------------

            navigation: {
                /* IMPORTANT: Ensure your Service section buttons use unique classes 
                   like '.services-next' instead of '.trending-next' so the two 
                   sliders don't conflict with each other! */
                nextEl: '.services-next',
                prevEl: '.services-prev',
            },
            breakpoints: {
                480: { slidesPerView: 2 },
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 }
            }
        });

        // Re-initialize lucide icons after swiper loads
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });

    // Supplier Swiper Initialization
const supplierSwiper = new Swiper('.supplierSwiper', {
    slidesPerView: 1,
    spaceBetween: 16,
    loop: true, // Enable infinite loop for services
    
    // Autoplay Configuration
    autoplay: {
        delay: 3500, // 3.5 seconds
        disableOnInteraction: false,
        pauseOnMouseEnter: true, 
    },

    // Navigation arrows
    navigation: {
        nextEl: '.supplier-next',
        prevEl: '.supplier-prev',
    },
    
    // Responsive breakpoints
    breakpoints: {
        480: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 },
        1280: { slidesPerView: 5 } // Shows 5 compact cards on large screens
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
</body>

</html>