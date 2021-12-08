<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center bg-custom-blue p-3">
                        <h2 class="text-md pl-3 font-bold text-white">
                            {{ __('New Candidate') }}
                        </h2>

                        <a href="{{ url()->current() == url()->previous() ? route('candidates.index') : url()->previous() }}"
                           class="w-1/7 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm
                           font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Back') }}
                        </a>
                    </div>

                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900 pt-5 pl-5">
                                        {{ __('Personal Information') }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-600 pl-5">
                                        {{ __('Candidate\'s information will be provided for application') }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{ route('candidates.store') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="first_name"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('First name *') }}
                                                    </label>
                                                    <input type="text" name="first_name" id="first_name"
                                                           autocomplete="given-name"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block
                                                           w-full shadow-sm sm:text-sm {{ $errors->has('first_name') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md" required value="{{ old('first_name') }}">
                                                    @error('first_name')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="last_name"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('Last name *') }}
                                                    </label>
                                                    <input type="text" name="last_name" id="last_name"
                                                           autocomplete="family-name"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500
                                                           block w-full shadow-sm sm:text-sm {{ $errors->has('last_name') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md"
                                                           required value="{{ old('last_name') }}">
                                                    @error('last_name')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                                        {{ __('E-mail address *') }}
                                                    </label>
                                                    <input type="text" name="email" id="email" autocomplete="email"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block
                                                           w-full shadow-sm sm:text-sm {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md" required value="{{ old('email') }}">
                                                    @error('email')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="phone_number"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('Phone number *') }}
                                                    </label>
                                                    <input type="text" name="phone_number" id="phone_number"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block
                                                           w-full shadow-sm sm:text-sm {{ $errors->has('phone_number') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md" required value="{{ old('phone_number') }}">
                                                    @error('phone_number')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="min_salary"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('Min salary') }}
                                                    </label>
                                                    <input type="number" min="0" step="1" name="min_salary" id="min_salary"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block
                                                           w-full shadow-sm sm:text-sm {{ $errors->has('min_salary') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md" value="{{ old('min_salary') }}">
                                                    @error('min_salary')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="max_salary"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('Max salary') }}
                                                    </label>
                                                    <input type="number" min="0" step="1" name="max_salary" id="max_salary"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full
                                                           shadow-sm sm:text-sm {{ $errors->has('max_salary') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md" value="{{ old('max_salary') }}">
                                                    @error('max_salary')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="current_employer"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('Current employer') }}
                                                    </label>
                                                    <input type="text" name="current_employer" id="current_employer"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full
                                                           shadow-sm sm:text-sm {{ $errors->has('current_employer') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md" value="{{ old('current_employer') }}">
                                                    @error('current_employer')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="position_id"
                                                           class="block text-sm font-medium text-gray-700">{{ __('Position *') }}</label>
                                                    <select id="position_id" name="position_id"
                                                            class="mt-1 block w-full py-2 px-3 border {{ $errors->has('position_id') ? 'border-red-500' : 'border-gray-300' }}
                                                                bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                            required>
                                                        <option value="" disabled
                                                                selected>{{ __('-- Choose --') }}</option>
                                                        @foreach($positions as $id => $name)
                                                            <option value="{{ $id }}"
                                                                    @if($id == old('position_id')) selected @endif>{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('position_id')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="seniority_id"
                                                           class="block text-sm font-medium text-gray-700">{{ __('Seniority *') }}</label>
                                                    <select id="seniority_id" name="seniority_id"
                                                            class="mt-1 block w-full py-2 px-3 border {{ $errors->has('seniority_id') ? 'border-red-500' : 'border-gray-300' }}
                                                                bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                            required>
                                                        <option value="" disabled
                                                                selected>{{ __('-- Choose --') }}</option>
                                                        @foreach($seniorities as $id => $name)
                                                            <option value="{{ $id }}"
                                                                    @if($id == old('seniority_id')) selected @endif>{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('seniority_id')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="education"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('Education') }}
                                                    </label>
                                                    <input type="text" name="education" id="education"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block
                                                           w-full shadow-sm sm:text-sm {{ $errors->has('education') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md" value="{{ old('education') }}">
                                                    @error('education')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="skills"
                                                           class="block mb-1.5 text-sm font-medium text-gray-700">{{ __('Skills') }}</label>
                                                    <select id="skills" name="skills[]" multiple
                                                            class="skills-select mt-1 w-full" data-ids="{{ old('skills') ? json_encode(old('skills')) : json_encode([]) }}">
                                                        @foreach($skills as $id => $name)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('skills')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-3 sm:col-span-3">
                                                    <label for="linkedin_url"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('LinkedIn URL') }}
                                                    </label>
                                                    <input type="text" name="linkedin_url" id="linkedin_url"
                                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block
                                                           w-full shadow-sm sm:text-sm {{ $errors->has('linkedin_url') ? 'border-red-500' : 'border-gray-300' }}
                                                               rounded-md" value="{{ old('linkedin_url') }}">
                                                    @error('linkedin_url')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-6">
                                                    <label for="description"
                                                           class="block text-sm font-medium text-gray-700">
                                                        {{ __('Description / Comment') }}
                                                    </label>
                                                    <div class="mt-1">
                                                        <textarea id="description" name="description" rows="3"
                                                                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1
                                                                  block w-full sm:text-sm border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}
                                                                      rounded-md"
                                                                  placeholder="A sincere impression of the candidate">{{ old('description') }}</textarea>
                                                    </div>
                                                    @error('description')
                                                    <span
                                                        class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-6">
                                                    <div class="flex flex-wrap -mx-3 mb-4">
                                                        <div class="w-full md:w-full px-3">
                                                            <label for="cv"
                                                                   class="block mb-1.5 text-sm font-medium text-gray-700">
                                                                {{ __('Upload CV') }}
                                                            </label>
                                                            <input
                                                                class="block w-full cursor-pointer bg-gray-50 border {{ $errors->has('cv') ? 'border-red-500' : 'border-gray-300' }}
                                                                    text-gray-900 dark:text-gray-400 focus:outline-none focus:border-transparent
                                                                    text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                                id="cv" name="cv" type="file" accept="application/pdf">
                                                            @error('cv')
                                                            <span
                                                                class="mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit"
                                                    class="w-1/6 inline-flex justify-center py-2 px-4 border border-transparent
                                                    shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Save') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
