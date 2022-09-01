 @include('navigation-menu')
 <x-app-layout>
     <x-slot name="header">
         <h2 class="text-xl font-semibold leading-tight text-gray-800">
             Firmar docuemntos
         </h2>
     </x-slot>

     <div class="container mx-auto mt-8">
         <div class="p-4 px-4 mb-6 bg-white rounded shadow-lg md:p-8">
             <div class="grid grid-cols-1 gap-4 text-sm gap-y-2 lg:grid-cols-3">
                 <div class="text-gray-600">
                     <p class="text-lg font-medium">Firmar PDF</p>
                     <p>Seleccione el o los archivos que desea firmar</p>
                 </div>

                 <div class="lg:col-span-2">
                     <form class="grid grid-cols-1 gap-4 text-sm gap-y-2 md:grid-cols-5"
                         action="{{ route('firmas-PDF.store') }}" method="post" enctype="multipart/form-data">
                         @csrf

                         <div class="md:col-span-5">
                             <div class="flex items-center mb-4">
                                 <input checked id="primera_pagina" name="primera_pagina" type="checkbox"
                                     value="primera_pagina"
                                     class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                 <label for="primera_pagina"
                                     class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Firmar solo
                                     primera pagina</label>
                             </div>
                             <div class="flex items-center mb-4">
                                 <input checked id="nombre" name="nombre" type="checkbox" value="nombre"
                                     class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                 <label for="nombre"
                                     class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre</label>
                             </div>
                             <div class="flex items-center mb-4">
                                 <input id="imagen" name="imagen" type="checkbox" value="imagen"
                                     class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                 <label for="imagen"
                                     class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Digital</label>
                             </div>
                         </div>


                         <div class="md:col-span-5">
                             <label for="files">Documentos en PDF</label>
                             <input type="file" name="files[]" id="files" required multiple
                                 class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="{{ old('files') }}" />
                             @error('files')
                                 <span
                                     class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
                             @enderror
                         </div>

                         <div class="text-right md:col-span-5">
                             <div class="inline-flex items-end">
                                 <button type="submit"
                                     class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Firmar</button>
                             </div>
                         </div>

                     </form>

                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>
