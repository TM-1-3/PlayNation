{{-- Error Modal --}}
<div id="error-modal" class="hidden fixed inset-0 bg-black/60 z-[9999] flex items-center justify-center backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden transform transition-all mx-4 animate-fade-in-up">
        <div class="p-8 text-center">
            <div class="mx-auto w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Access Restricted</h3>
            
            <p id="error-modal-message" class="text-gray-600 text-sm leading-relaxed mb-6"></p>
            
            <button onclick="closeErrorModal()" class="w-full bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition-colors font-medium">
                Got it
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out;
    }
</style>

<script>
    function showErrorModal(message) {
        const modal = document.getElementById('error-modal');
        const messageElement = document.getElementById('error-modal-message');
        messageElement.textContent = message;
        modal.classList.remove('hidden');
    }

    function closeErrorModal() {
        const modal = document.getElementById('error-modal');
        modal.classList.add('hidden');
    }

    // Auto-show modal if error exists in session
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('form'))
            showErrorModal('{{ $errors->first('form') }}');
        @elseif($errors->has('msg'))
            showErrorModal('{{ $errors->first('msg') }}');
        @elseif($errors->has('error'))
            showErrorModal('{{ $errors->first('error') }}');
        @endif
    });

    // Close modal on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeErrorModal();
        }
    });

    // Close modal on backdrop click
    document.getElementById('error-modal')?.addEventListener('click', function(event) {
        if (event.target === this) {
            closeErrorModal();
        }
    });
</script>
