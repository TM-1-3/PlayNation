const searchUserAdmin = document.getElementById('search-user-admin');
if (searchUserAdmin) {
    searchUserAdmin.addEventListener('submit', searchRequest);
}

const searchPost = document.getElementById('search-home');
if (searchPost) {
  searchPost.addEventListener('input', searchRequest);
}

const searchUser = document.getElementById('search-user-input');
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
    const timeline = document.getElementById('timeline');

    if (response.posts && timeline) {
      timeline.innerHTML = '';
      if (response.posts.length === 0) {
        timeline.innerHTML = '<p style="text-align:center;">No posts found</p>';
      } else {
        response.posts.forEach(post => {
          const postElement = document.createElement('div');
          postElement.className = 'post';
          postElement.id = `post-${post.id_post}`;
          
          const userProfilePic = post.user?.profile_picture || 'img/default_avatar.png';
          const username = post.user?.username || 'Unknown User';
          const userId = post.user?.id_user;
          const postDate = new Date(post.date);
          const timeAgo = getTimeAgo(postDate);
          
          let postHTML = `
            <div class="post-header">
              ${userId ? `<a href="/profile/${userId}">` : ''}
                <img class="author" src="${userProfilePic}" alt="avatar">
              ${userId ? '</a>' : ''}
              ${userId ? `<a href="/profile/${userId}" class="username">${username}</a>` : `<span class="username">${username}</span>`}
              <span class="post-time">${timeAgo}</span>
          `;
          
          if (post.is_owner) {
            postHTML += `
              <button class="button-delete" data-id="${post.id_post}" title="Delete Post">
                <i class="fa-solid fa-trash"></i>
              </button>
            `;
          }
          
          postHTML += '</div>';
          
          if (post.image) {
            postHTML += `<img class="post-image" src="${post.image}" alt="Post Content">`;
          }
          
          postHTML += '<div class="caption">';
          if (userId) {
            postHTML += `<a href="/profile/${userId}" class="caption-user">${username}</a> `;
          }
          postHTML += `${post.description}</div>`;
          
          if (post.labels && post.labels.length > 0) {
            postHTML += '<div class="post-tags">';
            post.labels.forEach(label => {
              postHTML += `<span class="tag">${label.designation}</span>`;
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
        noResults.className = 'no-results';
        noResults.innerHTML = '<i class="fa-solid fa-user-slash"></i><p>No users found</p>';
        searchContainer.appendChild(noResults);
      } else {
        response.users.forEach(user => {
          const userDiv = document.createElement('div');
          userDiv.className = 'user-search';
          userDiv.innerHTML = `
            <a href="/profile/${user.id_user}" class="search-name">${user.name}</a>
            <a href="/profile/${user.id_user}" class="search-username">${user.username}</a>
          `;
          searchContainer.appendChild(userDiv);
        });
      }
    }
  }
  
  console.log('Search results updated via AJAX.');
}