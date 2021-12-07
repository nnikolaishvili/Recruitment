<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pb-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center bg-custom-blue p-3">
                        <h2 class="text-md pl-3 font-bold text-white">
                            {{ __('Candidates') }}
                        </h2>

                        <x-link :href="route('candidates.create')">
                            {{ __('Add Candidate') }}
                        </x-link>
                    </div>

                    <table class="table-fixed min-w-full divide-y divide-gray-200 mt-6">
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
                                <td class="py-2 px-6 whitespace-nowrap text-sm text-gray-900">
                                    <div>
                                        {{ $candidate->first_name . ' ' . $candidate->last_name }}
                                    </div>
                                    <div class="text-gray-500">
                                        {{ $candidate->seniority->name . ' | ' . ($candidate->current_employer ?? 'Unemployed') }}
                                    </div>
                                </td>
                                <td class="py-2 px-6 whitespace-nowrap text-sm text-gray-900">
                                    <div>
                                        {{ $candidate->phone_number }}
                                    </div>
                                    <div class="text-gray-500">
                                        {{ $candidate->email }}
                                    </div>
                                </td>
                                <td class="py-2 px-6 whitespace-nowrap">
                                    @if (!$candidate->skills()->count())
                                        {{ __('No skills') }}
                                    @else
                                        <div style="max-width: 250px; display: flex; flex-wrap: wrap;">
                                            @foreach ($candidate->skills as $skill)
                                                <span class="inline-block rounded-full text-white
                                            bg-pink-400 hover:bg-pink-500 duration-300
                                            text-xs font-bold
                                            mr-1 md:mr-1 mb-1 px-2 md:px-4 py-1
                                            opacity-90 hover:opacity-100">
                                            {{ $skill->name }}
                                        </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td class="py-2 px-6 whitespace-nowrap text-sm text-gray-900">
                                    @if (!$candidate->min_salary && !$candidate->max_salary)
                                        {{ __('No information') }}
                                    @else
                                        {{ ($candidate->min_salary ?? 0) . ' - ' . ($candidate->max_salary ?? 999999) }}
                                    @endif
                                </td>
                                <td class="py-2 px-6 whitespace-nowrap text-sm text-gray-900">
                                    <span class="inline-block rounded-full text-white
                                        bg-indigo-400 hover:bg-indigo-500 duration-300
                                        text-xs font-bold
                                        mr-1 md:mr-2 mb-2 px-2 md:px-4 py-1
                                        opacity-90 hover:opacity-100">
                                        {{ $candidate->hiringStatus->name }}
                                    </span>
                                </td>
                                <td class="py-2 px-6 whitespace-nowrap text-sm text-gray-900">
                                    <a href="{{ route('candidates.edit', $candidate->id) }}">
                                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                    {{ __('No data available yet') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="py-2 px-6">
                        {{ $candidates->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
