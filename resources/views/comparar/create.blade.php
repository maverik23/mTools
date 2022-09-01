 @include('navigation-menu')
 <x-app-layout>
     <x-slot name="header">
         <h2 class="text-xl font-semibold leading-tight text-gray-800">
             Planilla Base
         </h2>
     </x-slot>

     <div class="container mx-auto mt-8">
         <div class="p-4 px-4 mb-6 bg-white rounded shadow-lg md:p-8">
             <div class="grid grid-cols-1 gap-4 text-sm gap-y-2 lg:grid-cols-3">
                 <div class="text-gray-600">
                     <p class="text-lg font-medium">Planilla Base</p>
                     <p>Importe la planilla base para comparar</p>
                 </div>

                 <div class="lg:col-span-2">
                     <form class="grid grid-cols-1 gap-4 text-sm gap-y-2 md:grid-cols-5"
                         action="{{ route('comparar.store') }}" method="post" enctype="multipart/form-data">
                         @csrf
                         <div class="md:col-span-5">
                             <label for="file">Planilla Excel</label>
                             <input type="file" name="file" id="file" required
                                 class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="{{ old('file') }}" />
                             @error('file')
                                 <span
                                     class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
                             @enderror
                         </div>

                         <div class="text-right md:col-span-5">
                             <div class="inline-flex items-end">
                                 <button type="submit"
                                     class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Importar</button>
                             </div>
                         </div>

                     </form>
                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>
