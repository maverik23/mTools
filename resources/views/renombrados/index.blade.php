 @include('navigation-menu')
 <x-app-layout>
     <x-slot name="header">
         <h2 class="text-xl font-semibold leading-tight text-gray-800">
             Soportes
         </h2>
     </x-slot>

     <div class="py-12">
         <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
             <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">


                 <form class="grid grid-cols-1 gap-4 text-sm gap-y-2 md:grid-cols-5" method="POST"
                     enctype="multipart/form-data" action="{{ route('renombrado.store') }}">
                     @csrf

                     <div class="md:col-span-5">
                         <label for="name">Nombre</label>
                         <input type="text" name="name" id="name" required
                             value="{{ old('name', 'MAM_$nombre$_CUN_PP_202206') }}"
                             class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" />
                         <p class="text-xs">Utilice $nombre$ para usar el nombre original del archivo</p>
                         @error('name')
                             <span
                                 class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="md:col-span-5">
                         <label for="docs">Documentos</label>
                         <input type="file" name="docs[]" id="docs" multiple required
                             value="{{ old('docs') }}" class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" />
                         @error('file')
                             <span
                                 class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
                         @enderror
                         @error('file.*')
                             <span
                                 class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
                         @enderror
                         <div wire:loading wire:target="file" class="text-blue-500 animate-pulse">Subiendo documento...
                         </div>
                     </div>

                     <div class="text-right md:col-span-5">
                         <div class="inline-flex items-end">
                             <button type="submit"
                                 class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Renombrar</button>
                         </div>
                     </div>

                     @if ($errors->any())
                         {!! implode('', $errors->all('<div>:message</div>')) !!}
                     @endif

                 </form>

             </div>
         </div>
     </div>
 </x-app-layout>
