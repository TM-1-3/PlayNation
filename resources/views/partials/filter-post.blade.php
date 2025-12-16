<style>
@media (min-width: 768px){
    #main-container.with-filter-open{ margin-right:20rem; }
}
@media (max-width: 767px){
    #main-container.with-filter-open{ margin-right:0; }
}
</style>

<div id="filter-overlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-40"></div>

<aside id="filter-panel" class="fixed right-0 top-1/2 -translate-y-1/2 pr-6 h-auto content-center w-80 rounded-lg transform shadow-xl translate-x-full transition-transform duration-300 ease-in-out bg-white shadow-md z-50 p-4 overflow-auto" aria-hidden="true" role="dialog" aria-label="Filter posts">
    <div class="flex items-start justify-between mb-4">
        <h3 class="font-semibold text-lg">Filters</h3>
        <button id="filter-close" class="text-gray-600 hover:text-gray-800 cursor-pointer">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <form id="filter-form" method="GET" action="{{ route('home') }}">
        <input type="hidden" name="timeline" value="{{ request('timeline') }}">

        <div class="mb-4">
            <input name="username" type="text" placeholder="Filter by Username..." class="border-none rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 text-gray-900  bg-white outline-none w-full px-3 py-2 text-sm">
        </div>

        <div class="mb-4">
            <input name="tags" type="text" placeholder="Filter by Tag..." class="border-none rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 text-gray-900  bg-white outline-none w-full px-3 py-2 text-sm">
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">Minimum likes</label>
            <input name="min_likes" type="range" min="0" class="w-full h-2 rounded-lg cursor-pointer accent-blue-500 bg-gray-300">
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">Sort by</label>
            <select name="sort" class="appearance-none border-none rounded-lg cursor-pointer shadow-md hover:shadow-xl transition-shadow duration-300 text-gray-900 bg-white outline-none w-full px-3 py-2 text-sm">
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="most_liked">Most liked</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="with_images" value="1" class=" cursor-pointer appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white transition-all duration-200 mr-2 
                                                                            checked:bg-blue-500 checked:border-blue-500 
                                                                            checked:after:block checked:after:h-2.5 checked:after:w-1 
                                                                            checked:after:rotate-45 checked:after:border-2 checked:after:border-t-0 
                                                                            checked:after:border-l-0 checked:after:border-white 
                                                                            checked:after:ml-[0.25rem] checked:after:mt-[0.05rem]
                                                                            
                                                                            focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
                Only posts with images
            </label>
            <label class="flex items-center mt-2">
                <input type="checkbox" name="verified" value="1" class=" cursor-pointer appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white transition-all duration-200 mr-2 
                                                                            checked:bg-blue-500 checked:border-blue-500 
                                                                            checked:after:block checked:after:h-2.5 checked:after:w-1 
                                                                            checked:after:rotate-45 checked:after:border-2 checked:after:border-t-0 
                                                                            checked:after:border-l-0 checked:after:border-white 
                                                                            checked:after:ml-[0.25rem] checked:after:mt-[0.05rem]
                                                                            
                                                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                From verified users
            </label>
        </div>

        <div class="flex justify-between gap-2 mt-6">
            <button type="button" id="filter-clear" class="cursor-pointer w-1/2 border-none shadow-md rounded px-3 py-2 hover:shadow-xl transition-shadow duration-300 text-sm text-gray-700">Clear</button>
            <button type="submit" class="w-1/2 bg-blue-500 cursor-pointer text-white rounded px-3 py-2 shadow-md hover:shadow-xl transition-shadow duration-300 text-sm">Apply</button>
        </div>
    </form>
</aside>

