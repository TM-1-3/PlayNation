<div id="{{ $modalId }}" class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-100 mx-4 relative z-[10000]">
        <div class="p-4 border-b flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-flag text-red-500"></i> {{ $title }}
            </h3>
            <button onclick="toggleReport('{{ $target_type ?? 'unknown' }}', {{ $target_id ?? 0 }})" class="text-gray-400 hover:text-gray-600 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
                <i class="fa-solid fa-times text-lg"></i>
            </button>
        </div>

        <div class="p-4">
            <form action="{{ route('report.submit') }}" method="POST">
                @csrf
                @if($target_type)
                    <input type="hidden" name="target_type" value="{{ $target_type }}">
                @endif
                @if($target_id)
                    <input type="hidden" name="target_id" value="{{ $target_id }}">
                @endif

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for reporting:</label>
                    <select name="reason" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <option value="">Select a reason</option>
                        <option value="spam">Spam</option>
                        <option value="harassment">Harassment or hate speech</option>
                        <option value="inappropriate">Inappropriate content</option>
                        <option value="misinformation">Misinformation</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Additional details (optional):</label>
                    <textarea name="details" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Provide more information..."></textarea>
                </div>
                <div class="flex gap-2 justify-end">
                    <button type="button" onclick="toggleReport('{{ $target_type ?? 'unknown' }}', {{ $target_id ?? 0 }})" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition font-medium">Cancel</button>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition font-medium" title="Submit the report">Submit Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
