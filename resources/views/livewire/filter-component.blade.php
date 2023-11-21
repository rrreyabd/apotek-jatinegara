<div>
    @foreach($filterOptions as $filter => $options)
    <div class="relative inline-block text-left">
        <button id="dropdown-button"
            class="inline-flex justify-center gap-2 items-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-2  focus:ring-mainColor">
            Filter
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div id="dropdown-menu"
            class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
            <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">
                <div>
                    <button id="{{ $filter }}"
                        class="inline-flex justify-center gap-2 items-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-2  focus:ring-mainColor">
                        {{ ucfirst($filter) }}
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div id="{{ $filter }}-menu"
                        class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="{{ $filter }}">

                            @foreach($options as $option)
                            <button wire:click="filter('{{ $filter }}', '{{ $option }}')"
                                class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                                role="menuitem">
                                {{ $option }}
                            </button>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- Show selected options and allow removal --}}
                <div class="mt-2">
                    @foreach($selectedOptions[$filter] ?? [] as $selectedOption)
                    <button wire:click="removeFilter('{{ $filter }}', '{{ $selectedOption }}')"
                        class="flex rounded-md px-4 py-2 text-sm text-gray-700 bg-blue-100 hover:bg-blue-200 cursor-pointer"
                        role="menuitem">
                        Remove {{ $selectedOption }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>