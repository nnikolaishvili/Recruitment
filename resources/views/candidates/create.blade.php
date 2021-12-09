<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <x-header :text="'New Candidate'" :link="url()->current() == url()->previous() ? route('candidates.index') : url()->previous()"
                              :linkText="'Back'"></x-header>

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
                                                    <x-custom-label for="first_name">{{ __('First name *') }}</x-custom-label>
                                                    <x-input type="text" name="first_name" id="first_name" :value="old('first_name')"
                                                             class="{{ $errors->has('first_name') ? 'border-red-500' : 'border-gray-300' }}"
                                                             required/>

                                                    @error('first_name')
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <x-custom-label for="last_name">{{ __('Last name *') }}</x-custom-label>
                                                    <x-input type="text" name="last_name" id="last_name" :value="old('last_name')"
                                                             class="{{ $errors->has('last_name') ? 'border-red-500' : 'border-gray-300' }}"
                                                             required/>

                                                    @error('last_name')
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <x-custom-label for="email">{{ __('E-mail address *') }}</x-custom-label>
                                                    <x-input type="text" name="email" id="email" :value="old('email')"
                                                             class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                                                             required/>

                                                    @error('email')
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <x-custom-label for="phone_number">{{ __('Phone number *') }}</x-custom-label>
                                                    <x-input type="text" name="phone_number" id="phone_number" :value="old('phone_number')"
                                                             class="{{ $errors->has('phone_number') ? 'border-red-500' : 'border-gray-300' }}"
                                                             required/>

                                                    @error('phone_number')
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <x-custom-label for="min_salary">{{ __('Min salary') }}</x-custom-label>
                                                    <x-input type="number" name="min_salary" id="min_salary" :value="old('min_salary')"
                                                             class="{{ $errors->has('min_salary') ? 'border-red-500' : 'border-gray-300' }}"
                                                             min="0" step="1"/>

                                                    @error('min_salary')
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <x-custom-label for="max_salary">{{ __('Max salary') }}</x-custom-label>
                                                    <x-input type="number" name="max_salary" id="max_salary" :value="old('max_salary')"
                                                             class="{{ $errors->has('max_salary') ? 'border-red-500' : 'border-gray-300' }}"
                                                             min="0" step="1"/>

                                                    @error('max_salary')
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <x-custom-label for="current_employer">{{ __('Current employer') }}</x-custom-label>
                                                    <x-input type="text" name="current_employer" id="current_employer" :value="old('current_employer')"
                                                             class="{{ $errors->has('current_employer') ? 'border-red-500' : 'border-gray-300' }}"/>

                                                    @error('current_employer')
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <x-custom-label for="position_id">{{ __('Position *') }}</x-custom-label>
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
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <x-custom-label for="seniority_id">{{ __('Seniority *') }}</x-custom-label>
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
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <x-custom-label for="education">{{ __('Education') }}</x-custom-label>
                                                    <x-input type="text" name="education" id="education" :value="old('education')"
                                                             class="{{ $errors->has('education') ? 'border-red-500' : 'border-gray-300' }}"/>

                                                    @error('education')
                                                    <x-error-message>{{ $message }}</x-error-message>
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
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-3 sm:col-span-3">
                                                    <x-custom-label for="linkedin_url">{{ __('LinkedIn URL') }}</x-custom-label>
                                                    <x-input type="text" name="linkedin_url" id="linkedin_url" :value="old('linkedin_url')"
                                                             class="{{ $errors->has('linkedin_url') ? 'border-red-500' : 'border-gray-300' }}"/>

                                                    @error('linkedin_url')
                                                    <x-error-message>{{ $message }}</x-error-message>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-6">
                                                    <x-custom-label for="description">{{ __('Description / Comment') }}</x-custom-label>
                                                    <div class="mt-1">
                                                        <x-textarea id="description" name="description"
                                                                    class="{{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}"
                                                                    placeholder="A sincere impression of the candidate">{{ old('description') }}</x-textarea>
                                                    </div>

                                                    @error('description')
                                                    <x-error-message>{{ $message }}</x-error-message>
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
                                                            <x-error-message>{{ $message }}</x-error-message>
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
