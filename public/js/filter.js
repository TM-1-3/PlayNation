document.addEventListener('DOMContentLoaded', function(){
    const btn = document.getElementById('filter-toggle');
    const panel = document.getElementById('filter-panel');
    const closeBtn = document.getElementById('filter-close');
    const clearBtn = document.getElementById('filter-clear');
    const form = document.getElementById('filter-form');
    const main = document.getElementById('main-container');
    if(!btn || !panel) return;

    function openPanel(){
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
        panel.setAttribute('aria-hidden','false');
        btn.setAttribute('aria-expanded','true');
        if(main) main.classList.add('with-filter-open');
    }
    function closePanel(){
        panel.classList.add('translate-x-full');
        panel.classList.remove('translate-x-0');
        panel.setAttribute('aria-hidden','true');
        btn.setAttribute('aria-expanded','false');
        if(main) main.classList.remove('with-filter-open');
    }

    btn.addEventListener('click', function(e){
        e.preventDefault();
        if(panel.classList.contains('translate-x-full')) openPanel(); else closePanel();
    });

    closeBtn.addEventListener('click', closePanel);

    if(clearBtn && form){
        clearBtn.addEventListener('click', function(){
            form.querySelectorAll('input').forEach(i => {
                if(i.type === 'checkbox' || i.type === 'radio') i.checked = false;
                else i.value = '';
            });
            form.querySelectorAll('select').forEach(s => s.selectedIndex = 0);
        });
    }

    // range input display for minimum likes
    var range = document.getElementById('min-likes-range');
    var current = document.getElementById('min-likes-current');
    var maxSpan = document.getElementById('min-likes-max');
    if(range && current && maxSpan){
        var max = range.getAttribute('max') || '100';
        maxSpan.textContent = max;
        // ensure initial value is shown
        if(range.value === undefined || range.value === null || range.value === '') range.value = 0;
        current.textContent = range.value;
        range.addEventListener('input', function(){
            current.textContent = this.value;
        });

        // when clearing the form, also reset the range to 0 and update display
        if(clearBtn){
            clearBtn.addEventListener('click', function(){
                range.value = 0;
                current.textContent = '0';
            });
        }
    }

    // range input display for minimum followers (user filter)
    var followersRange = document.getElementById('min-followers-range');
    var followersCurrent = document.getElementById('min-followers-current');
    var followersMax = document.getElementById('min-followers-max');
    if(followersRange && followersCurrent && followersMax){
        var max = followersRange.getAttribute('max') || '1000';
        followersMax.textContent = max;
        if(followersRange.value === undefined || followersRange.value === null || followersRange.value === '') followersRange.value = 0;
        followersCurrent.textContent = followersRange.value;
        followersRange.addEventListener('input', function(){
            followersCurrent.textContent = this.value;
        });
        if(clearBtn){
            clearBtn.addEventListener('click', function(){
                followersRange.value = 0;
                followersCurrent.textContent = '0';
            });
        }
    }

    // range input display for common friends (user filter)
    var commonFriendsRange = document.getElementById('min-common-friends-range');
    var commonFriendsCurrent = document.getElementById('min-common-friends-current');
    var commonFriendsMax = document.getElementById('min-common-friends-max');
    if(commonFriendsRange && commonFriendsCurrent && commonFriendsMax){
        var max = commonFriendsRange.getAttribute('max') || '50';
        commonFriendsMax.textContent = max;
        if(commonFriendsRange.value === undefined || commonFriendsRange.value === null || commonFriendsRange.value === '') commonFriendsRange.value = 0;
        commonFriendsCurrent.textContent = commonFriendsRange.value;
        commonFriendsRange.addEventListener('input', function(){
            commonFriendsCurrent.textContent = this.value;
        });
        if(clearBtn){
            clearBtn.addEventListener('click', function(){
                commonFriendsRange.value = 0;
                commonFriendsCurrent.textContent = '0';
            });
        }
    }

    // range input display for minimum members (group filter)
    var membersRange = document.getElementById('min-members-range');
    var membersCurrent = document.getElementById('min-members-current');
    var membersMax = document.getElementById('min-members-max');
    if(membersRange && membersCurrent && membersMax){
        var max = membersRange.getAttribute('max') || '50';
        membersMax.textContent = max;
        if(membersRange.value === undefined || membersRange.value === null || membersRange.value === '') membersRange.value = 0;
        membersCurrent.textContent = membersRange.value;
        membersRange.addEventListener('input', function(){
            membersCurrent.textContent = this.value;
        });
        if(clearBtn){
            clearBtn.addEventListener('click', function(){
                membersRange.value = 0;
                membersCurrent.textContent = '0';
            });
        }
    }
});
