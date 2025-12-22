function initializeCommentTagging(inputId, postId) {
    const input = document.getElementById(inputId);
    if (!input) {
        console.error('Input not found:', inputId);
        return;
    }

    console.log('Initializing tagging for:', inputId); // Debug log

    let autocompleteDiv = null;
    let currentQuery = '';
    let selectedIndex = -1;
    let currentAtIndex = -1;

    input.addEventListener('input', function(e) {
        const text = e.target.value;
        const cursorPos = e.target.selectionStart;
        
        // Find @ symbol before cursor
        const textBeforeCursor = text.substring(0, cursorPos);
        const lastAtIndex = textBeforeCursor.lastIndexOf('@');
        
        if (lastAtIndex === -1) {
            hideAutocomplete();
            return;
        }
        
        // Get text after @ symbol
        const queryText = textBeforeCursor.substring(lastAtIndex + 1);
        
        // Check if there's a space after @
        if (queryText.includes(' ')) {
            hideAutocomplete();
            return;
        }
        
        currentQuery = queryText;
        currentAtIndex = lastAtIndex;
        
        console.log('Query:', queryText); // Debug log
        
        if (queryText.length >= 1) {
            fetchUsers(queryText);
        } else {
            hideAutocomplete();
        }
    });

    input.addEventListener('keydown', function(e) {
        if (!autocompleteDiv || autocompleteDiv.classList.contains('hidden')) return;
        
        const items = autocompleteDiv.querySelectorAll('.autocomplete-item');
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = Math.min(selectedIndex + 1, items.length - 1);
            updateSelection(items);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = Math.max(selectedIndex - 1, -1);
            updateSelection(items);
        } else if (e.key === 'Enter' && selectedIndex >= 0) {
            e.preventDefault();
            items[selectedIndex].click();
        } else if (e.key === 'Escape') {
            hideAutocomplete();
        }
    });

    function fetchUsers(query) {
        console.log('Fetching users for:', query); // Debug log
        fetch(`/users/autocomplete?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(users => {
                console.log('Users received:', users); // Debug log
                if (users.length > 0) {
                    showAutocomplete(users);
                } else {
                    hideAutocomplete();
                }
            })
            .catch(error => console.error('Error fetching users:', error));
    }

    function showAutocomplete(users) {
        if (!autocompleteDiv) {
            autocompleteDiv = document.createElement('div');
            autocompleteDiv.className = 'absolute bg-white border border-gray-300 rounded-lg shadow-lg max-h-48 overflow-y-auto z-[10001]';
            autocompleteDiv.style.width = input.offsetWidth + 'px';
            input.parentElement.style.position = 'relative';
            input.parentElement.appendChild(autocompleteDiv);
        }

        autocompleteDiv.innerHTML = users.map((user, index) => `
            <div class="autocomplete-item flex items-center gap-2 p-2 hover:bg-gray-100 cursor-pointer" data-username="${user.username}" data-index="${index}">
                <img src="${user.profile_picture}" alt="${user.username}" class="w-8 h-8 rounded-full object-cover">
                <div>
                    <div class="font-semibold text-sm">${user.username}</div>
                    <div class="text-xs text-gray-500">${user.name}</div>
                </div>
            </div>
        `).join('');

        selectedIndex = -1;
        autocompleteDiv.classList.remove('hidden');
        
        // Position above input (since input is at bottom of modal)
        autocompleteDiv.style.bottom = (input.offsetHeight + 5) + 'px';
        autocompleteDiv.style.top = 'auto';

        // Add click handlers
        autocompleteDiv.querySelectorAll('.autocomplete-item').forEach(item => {
            item.addEventListener('click', function() {
                const username = this.dataset.username;
                insertUsername(username);
            });
        });
    }

    function updateSelection(items) {
        items.forEach((item, index) => {
            if (index === selectedIndex) {
                item.classList.add('bg-blue-100');
            } else {
                item.classList.remove('bg-blue-100');
            }
        });
    }

    function insertUsername(username) {
        const text = input.value;
        const beforeAt = text.substring(0, currentAtIndex);
        const afterQuery = text.substring(currentAtIndex + currentQuery.length + 1);
        
        input.value = beforeAt + '@' + username + ' ' + afterQuery;
        input.focus();
        
        // Set cursor position after inserted username
        const newCursorPos = currentAtIndex + username.length + 2;
        input.setSelectionRange(newCursorPos, newCursorPos);
        
        hideAutocomplete();
    }

    function hideAutocomplete() {
        if (autocompleteDiv) {
            autocompleteDiv.classList.add('hidden');
            selectedIndex = -1;
        }
    }

    // Hide autocomplete when clicking outside
    document.addEventListener('click', function(e) {
        if (autocompleteDiv && !input.contains(e.target) && !autocompleteDiv.contains(e.target)) {
            hideAutocomplete();
        }
    });
}