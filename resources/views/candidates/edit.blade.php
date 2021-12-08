<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center bg-custom-blue p-3">
                        <h2 class="text-md pl-3 font-bold text-white">
                            {{ $candidate->full_name }}
                        </h2>

                        <a href="{{ route('candidates.index') }}"
                                class="w-1/7 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Back') }}
                        </a>
                    </div>

                    <div class="w-full flex">
                        <div class="w-2/3 border-r-2">
                            <div class="flex justify-between items-center px-4 py-5 sm:px-6">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        {{ __('Candidate information') }}
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        {{ __('Personal details') }}
                                    </p>
                                </div>
                                <div>
                                    <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" id="delete-candidate">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                           class="w-1/7 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('Full name') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $candidate->full_name }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('Application for') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $candidate->position->name }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('E-mail address') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $candidate->email }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('Contact number') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $candidate->phone_number }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('Salary expectations') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $candidate->salary_range }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('Description') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $candidate->description }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('Skills') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            @if ($candidate->skills()->count())
                                                @foreach ($candidate->skills as $skill)
                                                    <span class="inline-block rounded-full text-white
                                                    bg-pink-400 hover:bg-pink-500 duration-300
                                                    text-xs font-bold
                                                    mr-1 md:mr-2 mb-2 px-2 md:px-4 py-1
                                                    opacity-90 hover:opacity-100">
                                                    {{ $skill->name }}
                                                </span>
                                                @endforeach
                                            @else
                                                {{ 'No skills'  }}
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('CV') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            @if (!$candidate->cv_url)
                                                {{ __('No file attached') }}
                                            @else
                                                <ul role="list"
                                                    class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                        <div class="w-0 flex-1 flex items-center">
                                                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                      d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>
                                                            <span class="ml-2 flex-1 w-0 truncate">
                                                      {{ $candidate->cv_name }}
                                                    </span>
                                                        </div>
                                                        <div class="ml-4 flex-shrink-0">
                                                            <a href="{{ route('candidates.download.cv', $candidate->id) }}"
                                                               class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                {{ __('Download') }}
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @endif
                                        </dd>
                                    </div>
                                    <form action="{{ route('candidates.status.update', $candidate->id) }}"
                                          method="POST">
                                        @csrf

                                        <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-md font-medium text-indigo-800 font-bold">
                                                {{ __('Status') }}
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                <select id="hiring_status_id" name="hiring_status_id"
                                                        class="block w-1/3 px-3 border {{ $errors->has('hiring_status_id') || $errors->has('current') ? 'border-red-500' : 'border-gray-300' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    @foreach($statuses as $id => $name)
                                                        <option value="{{ $id }}"
                                                                @if($id == $candidate->hiring_status_id) selected @endif>{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('hiring_status_id')
                                                <div class="mt-1">
                                                    <span class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                </div>
                                                @enderror
                                                @error('current')
                                                <div class="mt-1">
                                                    <span class="list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                </div>
                                                @enderror
                                            </dd>
                                        </div>
                                        <div class="bg-gray-50 px-4 pt-2 pb-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-md font-medium text-indigo-800 font-bold">
                                                {{ __('Comment') }}
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                <textarea id="comment" name="comment" rows="3"
                                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border {{ $errors->has('comment') ? 'border-red-500' : 'border-gray-300' }} rounded-md"
                                                          placeholder="What was the reason for status change?">{{ old('comment') }}</textarea>
                                                @error('comment')
                                                <span
                                                    class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                @enderror
                                            </dd>
                                        </div>
                                        <div class="bg-gray-50 px-4 pb-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt></dt>
                                            <dd>
                                                <button type="submit"
                                                        class="w-1/2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    {{ __('Save') }}
                                                </button>
                                            </dd>
                                        </div>
                                    </form>
                                </dl>
                            </div>
                        </div>
                        <div class="w-1/3">
                            <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        {{ __('Status timeline') }}
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        {{ __('Candidate status changes history') }}
                                    </p>
                                </div>
                                <div>
                                    @if ($candidateStatusesCount)
                                        <span
                                            class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-bold leading-none text-indigo-100 bg-indigo-600 rounded-full">
                                        {{ $candidateStatusesCount }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="border-t border-gray-200">
                                @if (!$candidateStatusesCount)
                                    <div class="px-4 py-5 sm:px-6">
                                        <div class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-20">
                                            {{ __('No status changes') }}
                                        </div>
                                    </div>
                                @else
                                    <dl class="mt-4 mx-4 border border-gray-200 rounded-3xl">
                                        @foreach($candidateStatuses as $status)
                                            <div
                                                class="bg-white px-3 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 {{ $loop->first ? 'rounded-t-3xl' : '' }} {{ $loop->last ? 'rounded-b-3xl' : '' }}">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    <span
                                                        class="inline-block w-2 h-2 mr-2 {{ $loop->first && $candidateStatuses->currentPage() == 1 ? 'bg-green-600' : 'bg-red-600' }} rounded-full"></span>
                                                    <span
                                                        class="text-xs">{{ $status->created_at->format('d.m.Y') }}</span>
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <div>{{ $status->name }}</div>
                                                    <div
                                                        class="max-w-2xl text-sm text-gray-500">{{ $status->pivot->comment }}</div>
                                                </dd>
                                            </div>
                                        @endforeach
                                    </dl>

                                    <div class="p-5">
                                        {{ $candidateStatuses->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
