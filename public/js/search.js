const searchUserAdmin = document.getElementById('search-user-admin');
if (searchUserAdmin) {
    searchUserAdmin.addEventListener('submit', searchRequest);
}

const searchHome = document.getElementById('search-home');
if (searchHome) {
  searchHome.addEventListener('input', searchRequest);
}

/**
 * Encode a data object into URL-encoded form data.
 * Example: {a: 1, b: 2} → "a=1&b=2"
 */
function encodeForAjax(data) {
  return data ? new URLSearchParams(data).toString() : null;
}
  
/**
 * Send an AJAX request using the Fetch API.
 * Handles CSRF tokens and common headers.
 */
async function sendAjaxRequest(method, url, data, handler) {
  try {
    const response = await fetch(url, {
      method,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json',
      },
      body: data ? encodeForAjax(data) : null,
    });

    if (!response.ok) {
      // If the server returns an error, refresh the page as fallback
      console.error('Response error:', response.status, response.statusText);
      window.location = '/';
      return;
    }

    // Parse JSON response and pass it to the handler
    const json = await response.json();
    handler(json);
  } catch (err) {
    console.error('Request failed:', err);
    window.location = '/';
  }
}

function searchRequest(event) {
  event.preventDefault();
  event.stopPropagation();
  
  const str = this.querySelector('input[name=search]').value.trim();
  const baseUrl = this.action;
  const searchType = this.id; // 'search-user-admin' or 'search-home'
  
  const url = str ? `${baseUrl}?search=${encodeURIComponent(str)}` : baseUrl;

  sendAjaxRequest('GET', url, null, (response) => searchHandler(response, searchType));
  
  return false;
}

function searchHandler(response, searchType) {
  if (searchType === 'search-user-admin') {
    // Handle admin user search
    const tableBody = document.getElementById('admin-users-body');
    
    if (response.users && tableBody) {
      tableBody.innerHTML = '';
      
      if (response.users.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="5" style="text-align:center;">No users found</td></tr>';
      } else {
        response.users.forEach(user => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td><a href="" class="action-link" style="text-decoration:none; color:black">${user.name}</a></td>
            <td><a href="" class="action-link" style="text-decoration:none; color:black">${user.username}</a></td>
            <td>${user.email}</td>
            <td>${user.is_public ? 'Public' : 'Private'}</td>
            <td>
              <a href="" class="action-link">Edit</a>
              <a href="" class="action-link" style="color: #e74c3c;">Delete</a>
            </td>
          `;
          tableBody.appendChild(row);
        });
      }
    }
  } else if (searchType === 'search-home') {
    // Handle home page search (posts, users, etc.)
    console.log('Home search results:', response);
  }
  
  console.log('Search results updated via AJAX.');
}