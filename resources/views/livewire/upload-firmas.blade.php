<div>
    <form wire:submit="save">
        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
            x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress" class="flex flex-col space-y-3">
            <x-section-border />

            <x-input type="file" wire:model.blur="files" multiple />
            @error('files.*')
                <span class="error">{{ $message }}</span>
            @enderror

            @if ($files)
                <div wire:loading.remove class="flex w-full justify-end">
                    <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                        class="max-w-xs self-end">
                        {{ __('Firmar archivos') }}
                    </x-button>
                </div>
            @endif

            <x-section-border />

            <div x-show="uploading" class="flex w-full flex-col">
                <p class="animate-pulse">Cargando archivos...</p>
                <progress max="100" x-bind:value="progress" class="flex w-full"></progress>
            </div>
        </div>
    </form>
</div>
