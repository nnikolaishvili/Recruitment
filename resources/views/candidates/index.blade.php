<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pb-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center bg-custom-blue p-3">
                        <h2 class="text-xl pl-3 font-bold text-white">
                            {{ __('Candidates') }}
                        </h2>

                        <x-link :href="route('candidates.create')">
                            {{ __('Add Candidate') }}
                        </x-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
