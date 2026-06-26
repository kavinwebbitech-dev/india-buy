<div id="supplier-chat-widget"
    class="fixed bottom-0 right-4 sm:right-8 w-[calc(100%-2rem)] sm:w-[580px] bg-white rounded-t-2xl border border-gray-200 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-50 transform translate-y-[120%] transition-transform duration-300 ease-out flex flex-col opacity-0">

    <div class="px-4 py-3 border-b border-gray-100 bg-white rounded-t-2xl">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl border border-gray-100 bg-white p-1 overflow-hidden">
                <img id="chat-item-image" src="" class="w-full h-full object-contain">
            </div>
            <div class="flex-1 min-w-0">
                <h4 id="chat-item-name" class="text-[14px] font-bold text-gray-900 truncate">Loading...</h4>
                <div class="flex items-center gap-2 mt-1">
                    <span id="chat-supplier-name" class="text-[12px] text-gray-500">Supplier</span>
                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                    <span class="text-[11px] text-emerald-600 font-medium">Online</span>
                </div>
            </div>
            <button id="close-chat-btn" class="p-1.5 hover:bg-red-50 hover:text-red-500 rounded-md transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    <div id="chat-messages" class="p-4 bg-slate-50 h-[350px] overflow-y-auto flex flex-col gap-3">
        <div class="flex justify-center">
            <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-medium px-3 py-1.5 rounded-full">
                Chat Loading...
            </span>
        </div>
    </div>

    <div class="p-3 bg-white border-t border-gray-100">
        <div class="flex items-end gap-2">
            @if (Auth::guard('vendor')->check())
                <button onclick="openQuotationModal()" type="button"
                    class="w-10 h-10 shrink-0 bg-amber-500 hover:bg-amber-600 text-white rounded-xl flex items-center justify-center transition-colors"
                    title="Send Quotation">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                </button>
            @endif

            <textarea id="chat-message" rows="1" placeholder="Type a message..."
                class="flex-1 max-h-24 bg-slate-50 border border-gray-200 rounded-xl px-3 py-2.5 text-[13px] text-gray-700 focus:outline-none focus:border-primary resize-none"></textarea>

            <button onclick="sendMessage()"
                class="w-10 h-10 shrink-0 bg-primary text-white rounded-xl flex items-center justify-center">
                <i data-lucide="send" class="w-4 h-4"></i>
            </button>
        </div>
    </div>
</div>

{{-- Quotation Modal Form --}}
@if (Auth::guard('vendor')->check())
    <div id="quotationModal" class="fixed inset-0 bg-black/50 z-[60] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl p-5 shadow-xl">
            <h3 class="text-sm font-bold text-gray-900 mb-4">Send New Quotation</h3>

            <form id="quotationForm" onsubmit="sendQuotation(event)" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Quotation Price (₹)</label>
                    <input type="number" id="q_price" required placeholder="Enter total price"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-900 focus:outline-none focus:border-amber-500">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Upload Quotation File (PDF/Image)</label>
                    <input type="file" id="q_file" required accept=".pdf,.jpg,.jpeg,.png"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-900 focus:outline-none">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeQuotationModal()"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-xs font-semibold">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-semibold">Submit Quotation</button>
                </div>
            </form>
        </div>
    </div>
@endif

<script>
    let currentEnquiryId = null;
    const loggedUserId = @json(Auth::guard('vendor')->id() ?? Auth::id());
    const isVendor = @json(Auth::guard('vendor')->check());

    function openChat(enquiryId, itemName, supplierName, imageUrl) {
        currentEnquiryId = enquiryId;
        document.getElementById('chat-item-name').textContent = itemName;
        document.getElementById('chat-supplier-name').textContent = supplierName;
        document.getElementById('chat-item-image').src = imageUrl;

        const chat = document.getElementById('supplier-chat-widget');
        chat.classList.remove('translate-y-[120%]', 'opacity-0');
        chat.classList.add('translate-y-0', 'opacity-100');

        loadMessages(enquiryId);
    }

    function loadMessages(enquiryId) {
        if (!enquiryId) return;
        let url = "{{ route('enquiries.messages', ['id' => '__ID__']) }}".replace('__ID__', enquiryId);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                let html = '';
                if (!data.length) {
                    html = `<div class="text-center text-gray-500 text-sm">No messages found</div>`;
                } else {
                    data.forEach(msg => {
                        let isMine = Number(msg.sender_id) === Number(loggedUserId);
                        
                        html += `<div class="flex ${isMine ? 'justify-end' : 'justify-start'} mb-2">
                            <div class="${isMine ? 'bg-blue-600 text-white' : 'bg-white border border-gray-200 text-gray-800'} px-4 py-2 rounded-2xl max-w-[75%] shadow-sm">
                                <div class="text-[13px] break-words">
                                    ${msg.message_type === 'quotation' && msg.quotation ? 
                                        `<div class="border-b pb-1 mb-1 font-bold text-amber-500 flex items-center gap-1">
                                            <i data-lucide="file-text" class="w-4 h-4"></i> Quotation Sent
                                         </div>
                                         <div class="text-sm font-extrabold mb-1">Price: ₹${Number(msg.quotation.price).toLocaleString('en-IN')}</div>
                                         <a href="/storage/${msg.quotation.file_path}" target="_blank" class="text-xs underline flex items-center gap-1 ${isMine ? 'text-white' : 'text-blue-600'}">
                                            View Document
                                         </a>` 
                                        : msg.message
                                    }
                                </div>
                            </div>
                        </div>`;
                    });
                }
                document.getElementById('chat-messages').innerHTML = html;
                lucide.createIcons();
                const box = document.getElementById('chat-messages');
                box.scrollTop = box.scrollHeight;
            })
            .catch(error => console.error(error));
    }

    function sendMessage() {
        const messageInput = document.getElementById('chat-message');
        const message = messageInput.value.trim();
        if (!message || !currentEnquiryId) return;

        let url = "{{ route('enquiries.messages.store', ['id' => '__ID__']) }}".replace('__ID__', currentEnquiryId);

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(() => {
            messageInput.value = '';
            loadMessages(currentEnquiryId);
        })
        .catch(error => console.error(error));
    }

    // Quotation Modal Logic
    function openQuotationModal() {
        document.getElementById('quotationModal').classList.remove('hidden');
    }

    function closeQuotationModal() {
        document.getElementById('quotationModal').classList.add('hidden');
        document.getElementById('quotationForm').reset();
    }

    function sendQuotation(event) {
        event.preventDefault();
        if (!currentEnquiryId) return;

        let url = "{{ route('enquiries.quotations.store', ['id' => '__ID__']) }}".replace('__ID__', currentEnquiryId);
        let formData = new FormData();
        formData.append('price', document.getElementById('q_price').value);
        formData.append('file', document.getElementById('q_file').files[0]);

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                closeQuotationModal();
                loadMessages(currentEnquiryId);
            }
        })
        .catch(error => console.error(error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('close-chat-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                const chat = document.getElementById('supplier-chat-widget');
                chat.classList.remove('translate-y-0', 'opacity-100');
                chat.classList.add('translate-y-[120%]', 'opacity-0');
                currentEnquiryId = null;
            });
        }
    });

    setInterval(() => {
        if (currentEnquiryId) {
            loadMessages(currentEnquiryId);
        }
    }, 3000);
</script>