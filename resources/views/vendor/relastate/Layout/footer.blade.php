   <div id="supplier-chat-widget"
        class="fixed bottom-0 right-4 sm:right-8 w-[calc(100%-2rem)] sm:w-[580px] bg-white rounded-t-2xl border border-gray-200 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-50 transform translate-y-[120%] transition-transform duration-300 ease-out flex flex-col opacity-0">

        <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between bg-white rounded-t-2xl cursor-pointer">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div
                        class="w-9 h-9 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-sm border border-blue-100">
                        M</div>
                    <div
                        class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full">
                    </div>
                </div>
                <div>
                    <h4 class="text-[14px] font-bold text-gray-900 leading-none mb-1">Mumbai Industrial Tech</h4>
                    <span class="text-[11px] text-emerald-600 font-medium flex items-center gap-1">Online <span
                            class="text-gray-400">• Local Time 16:03</span></span>
                </div>
            </div>
            <div class="flex items-center gap-1 text-gray-400">
                <button class="p-1.5 hover:bg-gray-50 hover:text-gray-600 rounded-md transition-colors"
                    title="Expand"><i data-lucide="maximize-2" class="w-4 h-4"></i></button>
                <button id="close-chat-btn"
                    class="p-1.5 hover:bg-red-50 hover:text-red-500 rounded-md transition-colors" title="Close"><i
                        data-lucide="x" class="w-5 h-5"></i></button>
            </div>
        </div>

        <div class="p-4 bg-slate-50 h-[320px] overflow-y-auto flex flex-col gap-4">

            <div class="flex items-center justify-center mt-2">
                <span
                    class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-medium px-3 py-1.5 rounded-full flex items-center gap-1.5 text-center">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> To secure your transactions, please
                    communicate via the platform.
                </span>
            </div>

            <div
                class="bg-white border border-gray-200 rounded-xl p-3 flex gap-3 shadow-[0_2px_10px_rgb(0,0,0,0.02)] mt-2">
                <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product"
                    class="w-16 h-16 object-contain bg-gray-50 rounded-lg p-1 border border-gray-100 shrink-0">
                <div class="flex-1 flex flex-col justify-between">
                    <h5 class="text-[12px] font-bold text-gray-900 line-clamp-2 leading-snug">Automatic High-Speed
                        Industrial Packaging Machine</h5>
                    <div class="flex items-end justify-between mt-2">
                        <div>
                            <span class="text-[14px] font-extrabold text-gray-900">₹4,50,000</span>
                            <span class="text-[10px] text-gray-500 block">Min Order: 1 Unit</span>
                        </div>
                        <button
                            class="bg-gray-900 text-white text-[11px] font-bold px-4 py-1.5 rounded-lg hover:bg-primary transition-colors shadow-sm">Send</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="p-3 bg-white border-t border-gray-100">
            <div class="flex items-center gap-1 mb-2 text-gray-400">
                <button class="p-1.5 hover:text-primary hover:bg-gray-50 rounded-md transition-colors"><i
                        data-lucide="smile" class="w-4 h-4"></i></button>
                <button class="p-1.5 hover:text-primary hover:bg-gray-50 rounded-md transition-colors"><i
                        data-lucide="folder" class="w-4 h-4"></i></button>
                <button class="p-1.5 hover:text-primary hover:bg-gray-50 rounded-md transition-colors"><i
                        data-lucide="image" class="w-4 h-4"></i></button>
                <button class="p-1.5 hover:text-primary hover:bg-gray-50 rounded-md transition-colors"><i
                        data-lucide="languages" class="w-4 h-4"></i></button>
            </div>
            <div class="flex items-end gap-2">
                <textarea rows="1" placeholder="Type a message..."
                    class="flex-1 max-h-24 bg-slate-50 border border-gray-200 rounded-xl px-3 py-2.5 text-[13px] text-gray-700 focus:outline-none focus:border-primary focus:bg-white transition-all resize-none"></textarea>
                <button
                    class="w-10 h-10 shrink-0 bg-primary text-white rounded-xl flex items-center justify-center hover:bg-primaryHover transition-colors shadow-sm">
                    <i data-lucide="send" class="w-4 h-4 ml-0.5"></i>
                </button>
            </div>
        </div>
    </div>
    
      <script>
        document.addEventListener('DOMContentLoaded', function () {

            const openChatBtn = document.getElementById('open-chat-btn');
            const closeChatBtn = document.getElementById('close-chat-btn');
            const chatWidget = document.getElementById('supplier-chat-widget');

            // Open Chat Function
            openChatBtn.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default link behavior if applicable

                // Make visible and slide up
                chatWidget.classList.remove('opacity-0', 'translate-y-[120%]');
                chatWidget.classList.add('opacity-100', 'translate-y-0');
            });

            // Close Chat Function
            closeChatBtn.addEventListener('click', () => {
                // Slide down and fade out
                chatWidget.classList.remove('opacity-100', 'translate-y-0');
                chatWidget.classList.add('opacity-0', 'translate-y-[120%]');
            });

        });
    </script>
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

    <script>
        lucide.createIcons();
    </script>