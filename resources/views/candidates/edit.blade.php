<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <x-header :text="$candidate->full_name" :link="url()->current() == url()->previous() ? route('candidates.index') : url()->previous()"
                              :linkText="'Back'"></x-header>

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
                                    <x-detail :title="'Full name'" :value="$candidate->full_name" class="bg-gray-50"></x-detail>
                                    <x-detail :title="'Application for'" :value="$candidate->position->name" class="bg-white"></x-detail>
                                    <x-detail :title="'E-mail address'" :value="$candidate->email" class="bg-gray-50"></x-detail>
                                    <x-detail :title="'Contact number'" :value="$candidate->phone_number" class="bg-white"></x-detail>
                                    <x-detail :title="'Salary expectations'" :value="$candidate->salary_range" class="bg-gray-50"></x-detail>
                                    <x-detail :title="'Description'" :value="$candidate->description" class="bg-white"></x-detail>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            {{ __('Skills') }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            @if ($candidate->skills()->count())
                                                @foreach ($candidate->skills as $skill)
                                                    <x-badge class="bg-pink-400 hover:bg-pink-500 md:mr-2 mb-2">
                                                        {{ $skill->name }}
                                                    </x-badge>
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
                                                <x-show-cv :filename="$candidate->cv_name"
                                                           :link="route('candidates.download.cv', $candidate->id)"
                                                           :linkName="'Download'"></x-show-cv>
                                            @endif
                                        </dd>
                                    </div>
                                    <form action="{{ route('candidates.status.update', $candidate->id) }}"
                                          method="POST" id="status-update">
                                        @csrf

                                        <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-md font-medium text-indigo-800 font-bold">
                                                {{ __('Status') }}
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                <select id="hiring_status_id" name="hiring_status_id"
                                                        class="block w-1/3 px-3 border {{ $errors->has('hiring_status_id') || $errors->has('current') ? 'border-red-500' : 'border-gray-300' }}
                                                            bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                            data-current_status="{{ $candidate->hiring_status_id }}">
                                                    @foreach($statuses as $id => $name)
                                                        <option value="{{ $id }}"
                                                                @if($id == $candidate->hiring_status_id) selected @endif>{{ $name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('hiring_status_id')
                                                <div class="mt-1">
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                </div>
                                                @enderror
                                                @error('current')
                                                <div class="mt-1">
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                </div>
                                                @enderror
                                            </dd>
                                        </div>
                                        <div class="bg-gray-50 px-4 pt-2 pb-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-md font-medium text-indigo-800 font-bold">
                                                {{ __('Comment') }}
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-textarea id="comment" name="comment"
                                                            class="bg-gray-100 {{ $errors->has('comment') ? 'border-red-500' : 'border-gray-300' }}" disabled
                                                            placeholder="What was the reason for status change?">{{ old('comment') }}</x-textarea>

                                                @error('comment')
                                                <x-error-message>{{ $message }}</x-error-message>
                                                @enderror
                                            </dd>
                                        </div>
                                        <div class="bg-gray-50 px-4 pb-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt></dt>
                                            <dd>
                                                <button type="submit"
                                                        class="w-1/2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    {{ __('Update') }}
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
                                    @if ($candidateStatuses->total())
                                        <span
                                            class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-bold leading-none text-indigo-100 bg-indigo-600 rounded-full">
                                        {{ $candidateStatuses->total() }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="border-t border-gray-200">
                                @if (!$candidateStatuses->total())
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
