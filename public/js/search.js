const searchUserAdmin = document.getElementById('search-user-admin');
if (searchUserAdmin) {
    searchUserAdmin.addEventListener('submit', searchRequest);
}

const searchPost = document.getElementById('search-home');
if (searchPost) {
  searchPost.addEventListener('input', searchRequest);
}

const searchUser = document.getElementById('search-user');
if (searchUser) {
  searchUser.addEventListener('input', searchRequest);
}

/**
 * Encode a data object into URL-encoded form data.
 * Example: {a: 1, b: 2} → "a=1&b=2"
 */
function encodeForAjax(data) {
  return data ? new URLSearchParams(data).toString() : null;
}

/**
 * Get human-readable time ago from a date
 */
function getTimeAgo(date) {
  const seconds = Math.floor((new Date() - date) / 1000);
  
  const intervals = {
    year: 31536000,
    month: 2592000,
    week: 604800,
    day: 86400,
    hour: 3600,
    minute: 60
  };
  
  for (const [unit, secondsInUnit] of Object.entries(intervals)) {
    const interval = Math.floor(seconds / secondsInUnit);
    if (interval >= 1) {
      return `${interval} ${unit}${interval === 1 ? '' : 's'} ago`;
    }
  }
  
  return 'just now';
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
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center p-8 text-gray-500 italic">No users found</td></tr>';
      } else {
        response.users.forEach(user => {
          const row = document.createElement('tr');
          row.className = 'border-b border-gray-200 transition-colors hover:bg-gray-50';
          row.innerHTML = `
            <td class="p-4 text-gray-800 text-sm font-medium"><a href="/profile/${user.id_user}" class="no-underline text-gray-800 hover:text-blue-600">${user.name}</a></td>
            <td class="p-4 text-gray-800 text-sm font-medium"><a href="/profile/${user.id_user}" class="no-underline text-gray-800 hover:text-blue-600">${user.username}</a></td>
            <td class="p-4 text-gray-800 text-sm">${user.email}</td>
            <td class="p-4 text-gray-800 text-sm">${user.is_public ? 'Public' : 'Private'}</td>
            <td class="p-4">
              <div class="flex items-center gap-4">
                <a href="/admin/edit/${user.id_user}" class="bg-none text-blue-500 text-sm font-medium no-underline">Edit</a>
                <form action="/admin/user/${user.id_user}" method="POST" class="m-0" onsubmit="return confirm('Are you sure you want to delete this user?')">
                  <input type="hidden" name="_token" value="${document.querySelector('meta[name=\"csrf-token\"]').content}">
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="bg-none text-red-500 text-sm font-medium cursor-pointer border-none pb-1">
                    Delete
                  </button>
                </form>
              </div>
            </td>
          `;
          tableBody.appendChild(row);
        });
      }
    }
  } else if (searchType === 'search-home') {
    // Handle home page search (posts, users, etc.)
    const timeline = document.getElementById('timeline');

    if (response.posts && timeline) {
      timeline.innerHTML = '';
      if (response.posts.length === 0) {
        timeline.innerHTML = '<div class="text-center py-10 text-gray-500"><p>No posts found</p></div>';
      } else {
        response.posts.forEach(post => {
          const postElement = document.createElement('div');
          postElement.className = 'bg-white border border-gray-200 rounded-lg mb-5 text-left flex flex-col';
          postElement.id = `post-${post.id_post}`;
          
          const userProfilePic = post.user?.profile_picture || 'img/default_avatar.png';
          const username = post.user?.username || 'Unknown User';
          const userId = post.user?.id_user;
          const postDate = new Date(post.date);
          const timeAgo = getTimeAgo(postDate);
          
          let postHTML = `
            <div class="flex items-center p-3.5">
              ${userId ? `<a href="/profile/${userId}">` : ''}
                <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" src="${userProfilePic}" alt="avatar">
              ${userId ? '</a>' : ''}
              ${userId ? `<a href="/profile/${userId}" class="font-semibold text-sm text-gray-800 no-underline">${username}</a>` : `<span class="font-semibold text-sm text-gray-800">${username}</span>`}
              <span class="ml-auto text-xs text-gray-500">${timeAgo}</span>
          `;
          
          if (post.is_owner) {
            postHTML += `
              <button class="bg-transparent border-none cursor-pointer text-red-600 p-1 text-sm transition-colors hover:text-red-800 ml-2" data-id="${post.id_post}" title="Delete Post">
                <i class="fa-solid fa-trash"></i>
              </button>
            `;
          }
          
          postHTML += '</div>';
          
          if (post.image) {
            postHTML += `<img class="w-full block border-t border-gray-200" src="${post.image}" alt="Post Content">`;
          }
          
          postHTML += '<div class="py-3 px-4 text-sm leading-relaxed">';
          if (userId) {
            postHTML += `<a href="/profile/${userId}" class="font-semibold mr-1 text-gray-800 no-underline">${username}</a> `;
          }
          postHTML += `${post.description}</div>`;
          
          if (post.labels && post.labels.length > 0) {
            postHTML += '<div class="px-4 pb-4 flex gap-1 flex-wrap">';
            post.labels.forEach(label => {
              postHTML += `<span class="bg-blue-500 text-white text-xs py-1 px-2 rounded font-semibold">${label.designation}</span>`;
            });
            postHTML += '</div>';
          }
          
          postElement.innerHTML = postHTML;
          timeline.appendChild(postElement);
        });
      }
    }
  } else if (searchType === 'search-user') {
    const userList = document.getElementById('users-list');
    if (response.users && userList) {
      userList.innerHTML = '';
      if (response.users.length === 0) {
        const noResults = document.createElement('div');
        noResults.className = 'text-center py-10 text-gray-500';
        noResults.innerHTML = '<i class="fa-solid fa-user-slash text-4xl mb-4"></i><p>No users found</p>';
        userList.appendChild(noResults);
      } else {
        response.users.forEach(user => {
          const userDiv = document.createElement('div');
          userDiv.className = 'flex bg-white border border-gray-200 rounded-lg p-5 transition-all hover:shadow-md hover:border-blue-400';
          
          const profileUrl = `/profile/${user.id_user}`;
          const profileImage = user.profile_image || '/img/default_avatar.png';
          
          userDiv.innerHTML = `
            <a href="${profileUrl}" class="mt-2 mr-1">
                <img class="w-8 h-8 rounded-full object-cover border border-gray-200 mr-2.5" 
                    src="${profileImage}" 
                    alt="avatar">
            </a>
            <div class="flex-col">
              <a href="${profileUrl}" class="block text-lg font-semibold text-gray-800 no-underline transition-colors hover:text-blue-600">${user.name}</a>
              <a href="${profileUrl}" class="block text-sm text-gray-500 no-underline transition-colors hover:text-blue-500">${user.username}</a>
            </div>
          `;
          userList.appendChild(userDiv);
        });
      }
    }
  }
  
  console.log('Search results updated via AJAX.');
}