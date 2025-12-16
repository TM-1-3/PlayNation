document.addEventListener('DOMContentLoaded', function(){
    const btn = document.getElementById('filter-toggle');
    const panel = document.getElementById('filter-panel');
    const overlay = document.getElementById('filter-overlay');
    const closeBtn = document.getElementById('filter-close');
    const clearBtn = document.getElementById('filter-clear');
    const form = document.getElementById('filter-form');
    const main = document.getElementById('main-container');
    if(!btn || !panel || !overlay) return;

    function openPanel(){
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
        panel.setAttribute('aria-hidden','false');
        btn.setAttribute('aria-expanded','true');
        if(window.innerWidth < 768){
            overlay.classList.remove('opacity-0','pointer-events-none');
            overlay.classList.add('opacity-100');
        } else {
            overlay.classList.add('opacity-0','pointer-events-none');
            overlay.classList.remove('opacity-100');
            if(main) main.classList.add('with-filter-open');
        }
    }
    function closePanel(){
        panel.classList.add('translate-x-full');
        panel.classList.remove('translate-x-0');
        panel.setAttribute('aria-hidden','true');
        overlay.classList.add('opacity-0','pointer-events-none');
        overlay.classList.remove('opacity-100');
        btn.setAttribute('aria-expanded','false');
        if(main) main.classList.remove('with-filter-open');
    }

    btn.addEventListener('click', function(e){
        e.preventDefault();
        if(panel.classList.contains('translate-x-full')) openPanel(); else closePanel();
    });

    overlay.addEventListener('click', closePanel);
    if(closeBtn) closeBtn.addEventListener('click', closePanel);

    if(clearBtn && form){
        clearBtn.addEventListener('click', function(){
            form.querySelectorAll('input').forEach(i => {
                if(i.type === 'checkbox' || i.type === 'radio') i.checked = false;
                else i.value = '';
            });
            form.querySelectorAll('select').forEach(s => s.selectedIndex = 0);
        });
    }
});
