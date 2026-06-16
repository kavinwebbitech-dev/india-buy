   {{-- <div id="supplier-chat-widget"
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
    </div> --}}

        <!-- chat -->
    <div id="supplier-chat-widget"
        class="fixed bottom-0 right-4 sm:right-8 w-[calc(100%-2rem)] sm:w-[580px] bg-white rounded-t-2xl border border-gray-200 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-50 transform translate-y-[120%] transition-transform duration-300 ease-out flex flex-col opacity-0">

        <!-- Header -->
         <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-100 bg-white rounded-t-2xl">

            <!-- Enquiry Product / Service -->
            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-xl border border-gray-100 bg-white p-1 overflow-hidden">
                    <img id="chat-item-image" src="" class="w-full h-full object-contain">
                </div>

                <div class="flex-1 min-w-0">

                    <h4 id="chat-item-name" class="text-[14px] font-bold text-gray-900 truncate">
                        Loading...
                    </h4>

                    <div class="flex items-center gap-2 mt-1">

                        <span id="chat-supplier-name" class="text-[12px] text-gray-500">
                            Supplier
                        </span>

                        <span class="w-1 h-1 rounded-full bg-gray-300">
                        </span>

                        <span class="text-[11px] text-emerald-600 font-medium">
                            Online
                        </span>

                    </div>

                </div>

                <button id="close-chat-btn"
                    class="p-1.5 hover:bg-red-50 hover:text-red-500 rounded-md transition-colors">

                    <i data-lucide="x" class="w-5 h-5"></i>

                </button>

            </div>

        </div>

        <!-- Messages -->
        <div id="chat-messages" class="p-4 bg-slate-50 h-[350px] overflow-y-auto flex flex-col gap-3">

            <div class="flex justify-center">
                <span
                    class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-medium px-3 py-1.5 rounded-full">
                    Chat Loading...
                </span>
            </div>

        </div>

        <!-- Footer -->
        <div class="p-3 bg-white border-t border-gray-100">

            <div class="flex items-end gap-2">

                <textarea id="chat-message" rows="1" placeholder="Type a message..."
                    class="flex-1 max-h-24 bg-slate-50 border border-gray-200 rounded-xl px-3 py-2.5 text-[13px] text-gray-700 focus:outline-none focus:border-primary resize-none"></textarea>

                <button onclick="sendMessage()"
                    class="w-10 h-10 shrink-0 bg-primary text-white rounded-xl flex items-center justify-center">
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>

            </div>

        </div>

    </div>
    

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
let currentEnquiryId = null;
const loggedUserId = @json(Auth::guard('vendor')->id());

function openChat(enquiryId, itemName, supplierName, imageUrl) {

    currentEnquiryId = enquiryId;

    document.getElementById('chat-item-name').textContent = itemName;
    document.getElementById('chat-supplier-name').textContent = supplierName;
    document.getElementById('chat-item-image').src = imageUrl;

    const chat = document.getElementById('supplier-chat-widget');

    chat.classList.remove('translate-y-[120%]');
    chat.classList.remove('opacity-0');

    loadMessages(enquiryId);
}

function loadMessages(enquiryId)
{
    let url = "{{ route('enquiries.messages', ['id' => '__ID__']) }}";
    url = url.replace('__ID__', enquiryId);

    fetch(url)
    .then(response => response.json())
    .then(data => {

        let html = '';

        if (!data.length) {

            html = `
                <div class="text-center text-gray-500 text-sm">
                    No messages found
                </div>
            `;

        } else {

            data.forEach(msg => {

                let isMine = Number(msg.sender_id) === Number(loggedUserId);

                html += `
                    <div class="flex ${isMine ? 'justify-end' : 'justify-start'} mb-2">

                        <div class="
                            ${isMine
                                ? 'bg-blue-600 text-white'
                                : 'bg-white border border-gray-200 text-gray-800'}
                            px-4 py-2 rounded-2xl max-w-[75%]
                        ">

                            <div class="text-[13px] break-words">
                                ${msg.message}
                            </div>

                        </div>

                    </div>
                `;
            });
        }

        document.getElementById('chat-messages').innerHTML = html;

        const box = document.getElementById('chat-messages');
        box.scrollTop = box.scrollHeight;
    })
    .catch(error => {
        console.error(error);
    });
}

function sendMessage()
{
    const message = document.getElementById('chat-message').value.trim();

    if (!message || !currentEnquiryId) {
        return;
    }

    let url = "{{ route('enquiries.messages.store', ['id' => '__ID__']) }}";
    url = url.replace('__ID__', currentEnquiryId);

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            message: message
        })
    })
    .then(response => response.json())
    .then(() => {

        document.getElementById('chat-message').value = '';

        loadMessages(currentEnquiryId);
    })
    .catch(error => {
        console.error(error);
    });
}

document.addEventListener('DOMContentLoaded', function () {

    const closeBtn = document.getElementById('close-chat-btn');

    if (closeBtn) {

        closeBtn.addEventListener('click', function () {

            const chat = document.getElementById('supplier-chat-widget');

            chat.classList.remove('translate-y-0', 'opacity-100');
            chat.classList.add('translate-y-[120%]', 'opacity-0');
        });
    }
});

setInterval(() => {

    if (currentEnquiryId) {
        loadMessages(currentEnquiryId);
    }

}, 3000);
</script>
    <script>
        lucide.createIcons();
    </script>
    