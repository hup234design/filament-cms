<div>
    @if( $submitted )
        <div class="border-2 bg-green-100 border-green-300 text-green-800 p-8 text-center">
            THANK YOU FOR YOUR  MESSAGE
        </div>
    @else
        <form wire:submit="create" class="not-prose" disabled>
            <x-honeypot livewire-model="extraFields" />

{{--            {{ $this->form }}--}}

            <div class="space-y-4">
                <div>
                    <span for="data.name" class="block text-sm font-medium leading-6 text-gray-900">Name <span class="text-red-700">*</span></label>
                    <input type="text" wire:model="data.name" class="mt-2 w-full">
                    @if($errors->has('data.name'))
                        <p class="mt-2 text-sm text-red-600" id="name-error">{{ $errors->first('data.name') }}</p>
                        @enderror
                </div>
                <div>
                    <label for="data.email" class="block text-sm font-medium leading-6 text-gray-900">Email <span class="text-red-700">*</span></label>
                    <input type="email" wire:model="data.email" class="mt-2 w-full">
                    @if($errors->has('data.email'))
                        <p class="mt-2 text-sm text-red-600" id="email-error">{{ $errors->first('data.email') }}</p>
                        @enderror
                </div>
                <div>
                    <label for="data.telephone" class="block text-sm font-medium leading-6 text-gray-900">Telephone <span class="text-red-700">*</span></label>
                    <input type="tel" wire:model="data.telephone" class="mt-2 w-full">
                    @if($errors->has('data.telephone'))
                        <p class="mt-2 text-sm text-red-600" id="telephone-error">{{ $errors->first('data.telephone') }}</p>
                        @enderror
                </div>
                <div>
                    <label for="data.referral" class="block text-sm font-medium leading-6 text-gray-900">How did you hear about us?</label>
                    <select wire:model="data.referral" class="mt-2 w-full">
                        <option>Please choose an option.....</option>
                        <option value="Online Search">Online Search</option>
                        <option value="Social Media">Social Media</option>
                        <option value="Publication">Publication</option>
                        <option value="Advertising">Advertising</option>
                        <option value="Existing Client">Existing Client</option>
                        <option value="Family/Friends">Family/Friends</option>
                        <option value="Other">Other</option>
                    </select>
                    @if($errors->has('data.subject'))
                        <p class="mt-2 text-sm text-red-600" id="subject-error">{{ $errors->first('data.subject') }}</p>
                        @enderror
                </div>
                <div>
                    <label for="data.subject" class="block text-sm font-medium leading-6 text-gray-900">Subject <span class="text-red-700">*</span></label>
                    <input type="text" wire:model="data.subject" class="mt-2 w-full">
                    @if($errors->has('data.subject'))
                        <p class="mt-2 text-sm text-red-600" id="subject-error">{{ $errors->first('data.subject') }}</p>
                        @enderror
                </div>
                <div>
                    <label for="data.message" class="block text-sm font-medium leading-6 text-gray-900">Message <span class="text-red-700">*</span></label>
                    <textarea rows="5" wire:model="data.message" class="mt-2 w-full"></textarea>
                    @if($errors->has('data.message'))
                        <p class="mt-2 text-sm text-red-600" id="message-error">{{ $errors->first('data.message') }}</p>
                        @enderror
                </div>
                <div>
                    <label for="data.quiz" class="block text-sm font-medium leading-6 text-gray-900">{{ $question }} <span class="text-red-700">*</span></label>
                    <input type="text" wire:model="data.quiz" class="mt-2 w-full">
                    @if($errors->has('data.quiz'))
                        <p class="mt-2 text-sm text-red-600" id="quiz-error">{{ $errors->first('data.quiz') }}</p>
                    @enderror
                </div>
                <x-cms::button type="submit" label="Submit"/>
            </div>

        </form>
        <x-filament-actions::modals />
    @endif
</div>
