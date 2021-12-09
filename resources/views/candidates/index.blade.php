<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <x-header :text="'Candidates'" :link="route('candidates.create')"
                              :linkText="'New Candidate'"></x-header>

                    <div class="w-full grid grid-cols-2 gap-4 py-4 px-2 bg-gray-50">
                        <div></div>
                        <div>
                            <form action="" class="w-full flex">
                                <input type="text" name="search" id="search"
                                       class="mt-1 w-full shadow-sm sm:text-sm rounded-md mr-2 border-gray-100 focus:none"
                                       placeholder="Search by name, email or phone number..."
                                       value="{{ $searchValue }}">
                                <button type="submit"
                                        class="py-2 px-4 border border-transparent
                                                    shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <table class="table-fixed min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <x-table-th>{{ __('Candidate') }}</x-table-th>
                            <x-table-th>{{ __('Contact Info') }}</x-table-th>
                            <x-table-th>{{ __('Skills') }}</x-table-th>
                            <x-table-th>{{ __('Salary Range') }}</x-table-th>
                            <x-table-th>{{ __('Status') }}</x-table-th>
                            <x-table-th></x-table-th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($candidates as $candidate)
                            <tr>
                                <x-table-td>
                                    <div>
                                        {{ $candidate->full_name }}
                                    </div>
                                    <div class="text-gray-500 mt-1">
                                        {{ $candidate->seniority->name . ' | ' . $candidate->current_employer }}
                                    </div>
                                </x-table-td>
                                <x-table-td>
                                    <div>
                                        {{ $candidate->phone_number }}
                                    </div>
                                    <div class="text-gray-500 mt-1">
                                        {{ $candidate->email }}
                                    </div>
                                </x-table-td>
                                <td class="py-2 px-6">
                                    @if (!$candidate->skills->count())
                                        <span class="text-sm">{{ __('No skills') }}</span>
                                    @else
                                        <div style="max-width: 250px; display: flex; flex-wrap: wrap;">
                                            @foreach ($candidate->skills as $skill)
                                                <x-badge class="bg-pink-400 hover:bg-pink-500">
                                                    {{ $skill->name }}
                                                </x-badge>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <x-table-td>
                                    {{ $candidate->salary_range }}
                                </x-table-td>
                                <x-table-td>
                                    <x-badge
                                        class="{{ $candidate->isRejected() ? 'bg-red-400 hover:bg-red-500' : 'bg-green-400 hover:bg-green-500' }}">
                                        {{ $candidate->hiringStatus->name }}
                                    </x-badge>
                                </x-table-td>
                                <x-table-td>
                                    <a href="{{ route('candidates.edit', $candidate->id) }}">
                                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                </x-table-td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                    {{ __('No candidates yet') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="pt-2 pb-4 px-6">
                        {{ $candidates->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
