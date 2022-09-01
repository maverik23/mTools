<form class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5" wire:submit.prevent="submit">
    @csrf

    <div class="md:col-span-5">
        <label for="n_poliza">Numero de poliza</label>
        <label for="n_poliza"
            class="h-10 px-4 w-full bg-gray-50 block font-semibold text-lg">{{ $poliza->n_poliza }}</label>
        @error('n_poliza')
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-5">
        <label for="name">Nombre</label>
        <input type="text" wire:model="name" name="name" id="name" required
            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
        @error('name')
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-5">
        <label for="file">Documento</label>
        <input wire:model="file" type="file" name="file" id="file" required
            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
        @error('file')
            <span
                class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
        @enderror
        <div wire:loading wire:target="file" class="text-blue-500 animate-pulse">Subiendo documento...</div>
    </div>

    <div class="md:col-span-5 text-right">
        <div class="inline-flex items-end">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
        </div>
    </div>

</form>
