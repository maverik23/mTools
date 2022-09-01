<form class="grid grid-cols-1 gap-4 text-sm gap-y-2 md:grid-cols-5" wire:submit.prevent="submit">
    @csrf

    <div class="md:col-span-5">
        <label for="estacion">Estacion</label>
        <select wire:model="estacion" wire:change="name()" name="estacion" id="estacion"
            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50">
            <option selected value> -- Seleccione una opción -- </option>
            <option value="CUN">Cancun</option>
            <option value="PVR">Puerto Vallarta</option>
        </select>
        @error('estacion')
            <span
                class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-5">
        <label for="cuenta">Cuenta</label>
        <select wire:model="cuenta" wire:change="name()" name="cuenta" id="cuenta"
            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50">
            <option selected value> -- Seleccione una opción -- </option>
            <option value="PP">Pago a proveedores</option>
            <option value="FF">Fondo fijo</option>
        </select>
        @error('cuenta')
            <span
                class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-5">
        <label for="name">Nombre</label>
        <input wire:model="name" type="text" name="name" id="name" required
            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" />
        @error('name')
            <span
                class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-5">
        <label for="file">Documento</label>
        <input wire:model="file" type="file" name="file[]" id="file" multiple required
            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" />
        @error('file')
            <span
                class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
        @enderror
        @error('file.*')
            <span
                class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
        @enderror
        <div wire:loading wire:target="file" class="text-blue-500 animate-pulse">Subiendo documento...</div>
    </div>

    <div class="text-right md:col-span-5">
        <div class="inline-flex items-end">
            <button type="submit"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Guardar</button>
        </div>
    </div>

</form>
