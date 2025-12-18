<div id="share-modal" class="fixed inset-0 bg-black/50 hidden z-[9999] flex items-center justify-center backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 overflow-hidden transform transition-all scale-100">
        
        <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-800">Share Post</h3>
            <button onclick="closeShareModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-4">
            <div class="mb-4 relative">
                <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                <input type="text" id="share-search" placeholder="Search friends or groups..." 
                       class="w-full bg-gray-100 border-none rounded-lg py-2 pl-9 pr-4 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div id="share-targets-list" class="max-h-60 overflow-y-auto custom-scrollbar space-y-1 mb-4">
                <div class="text-center py-8 text-gray-400">
                    <i class="fa-solid fa-spinner fa-spin text-xl"></i> Loading...
                </div>
            </div>

            <textarea id="share-message" rows="2" placeholder="Write a message (optional)..." 
                      class="w-full border border-gray-200 rounded-lg p-2 text-sm focus:border-blue-500 outline-none resize-none"></textarea>
            
            <input type="hidden" id="selected-target-id">
            <input type="hidden" id="selected-target-type"> <input type="hidden" id="share-post-id">

            <button onclick="sendShare()" id="btn-share-send" disabled
                    class="w-full mt-3 bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                Send
            </button>
        </div>
    </div>
</div>

<script>
    let allTargets = { friends: [], groups: [] };

    // open modal
    function openShareModal(postId) {
        document.getElementById('share-modal').classList.remove('hidden');
        document.getElementById('share-post-id').value = postId;
        document.getElementById('share-message').value = '';
        document.getElementById('btn-share-send').disabled = true;
        document.getElementById('btn-share-send').innerText = 'Send';
        
        // get contacts
        fetch('/api/share/targets')
            .then(res => res.json())
            .then(data => {
                allTargets = data;
                renderTargets(data);
            });
    }

    // close modal
    function closeShareModal() {
        document.getElementById('share-modal').classList.add('hidden');
    }

    // render list
    function renderTargets(data) {
        const container = document.getElementById('share-targets-list');
        container.innerHTML = '';

        // helper to create html for items
        const createItem = (item, type) => `
            <div onclick="selectTarget(this, '${item.id}', '${type}')" 
                 class="target-item flex items-center gap-3 p-2 rounded-lg cursor-pointer hover:bg-blue-50 transition border border-transparent">
                <img src="${item.image}" class="w-10 h-10 rounded-full object-cover bg-gray-200">
                <div class="flex-1">
                    <p class="font-bold text-sm text-gray-800">${item.name}</p>
                    <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">${type}</p>
                </div>
                <div class="selection-check hidden text-blue-600">
                    <i class="fa-solid fa-check-circle text-lg"></i>
                </div>
            </div>
        `;

        // Friends
        if (data.friends.length > 0) {
            container.innerHTML += `<p class="text-xs font-bold text-gray-400 mb-1 mt-2">FRIENDS</p>`;
            data.friends.forEach(f => container.innerHTML += createItem(f, 'user'));
        }

        // Groups
        if (data.groups.length > 0) {
            container.innerHTML += `<p class="text-xs font-bold text-gray-400 mb-1 mt-2">GROUPS</p>`;
            data.groups.forEach(g => container.innerHTML += createItem(g, 'group'));
        }
        
        if (data.friends.length === 0 && data.groups.length === 0) {
            container.innerHTML = '<p class="text-center text-gray-500 py-4">No contacts found.</p>';
        }
    }

    // select receiver
    function selectTarget(el, id, type) {
        // remove active class from all
        document.querySelectorAll('.target-item').forEach(i => {
            i.classList.remove('bg-blue-100', 'border-blue-200');
            i.querySelector('.selection-check').classList.add('hidden');
        });

        // add to selected
        el.classList.add('bg-blue-100', 'border-blue-200');
        el.querySelector('.selection-check').classList.remove('hidden');

        // store
        document.getElementById('selected-target-id').value = id;
        document.getElementById('selected-target-type').value = type;
        document.getElementById('btn-share-send').disabled = false;
    }

    // send
    function sendShare() {
        const id = document.getElementById('selected-target-id').value;
        const type = document.getElementById('selected-target-type').value;
        const postId = document.getElementById('share-post-id').value;
        const messageText = document.getElementById('share-message').value;
        
        const btn = document.getElementById('btn-share-send');
        btn.innerText = 'Sending...';
        btn.disabled = true;

        // buids msg with post tag
        const finalMessage = `${messageText} [post:${postId}]`.trim();

        // decides url based in groups ag
        const url = type === 'user' 
            ? `/messages/${id}`             // DMs
            : `/groups/${id}/messages`;     // groups

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ text: finalMessage })
        })
        .then(res => res.json())
        .then(data => {
            closeShareModal();
            // Show toast/alert success
            alert('Post shared successfully!'); 
        })
        .catch(err => {
            console.error(err);
            btn.innerText = 'Error';
            btn.disabled = false;
        });
    }

    // search filter
    document.getElementById('share-search').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const filtered = {
            friends: allTargets.friends.filter(f => f.name.toLowerCase().includes(term)),
            groups: allTargets.groups.filter(g => g.name.toLowerCase().includes(term))
        };
        renderTargets(filtered);
    });
</script>