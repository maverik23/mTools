 @include('navigation-menu')
 <x-app-layout>
     <x-slot name="header">
         <h2 class="text-xl font-semibold leading-tight text-gray-800">
             Editar Soporte
         </h2>
     </x-slot>

     <div class="container mx-auto mt-8">
         <div class="p-4 px-4 mb-6 bg-white rounded shadow-lg md:p-8">
             <div class="grid grid-cols-1 gap-4 text-sm gap-y-2 lg:grid-cols-3">
                 <div class="text-gray-600">
                     <p class="text-lg font-medium">Agregar Poliza</p>
                     <p>Complete los campos para agregar una nueva poliza</p>
                 </div>

                 <div class="lg:col-span-2">
                     <form class="grid grid-cols-1 gap-4 text-sm gap-y-2 md:grid-cols-5"
                         action="{{ route('polizas.update', $poliza->id) }}" method="post">
                         @csrf
                         @method('put')

                         <div class="md:col-span-5">
                             <label for="n_poliza">Numero de poliza</label>
                             <input type="text" name="n_poliza" id="n_poliza" required
                                 class="w-full h-10 px-4 mt-1 border rounded bg-gray-50"
                                 value="{{ old('n_poliza', $poliza->n_poliza) }}" />
                             @error('n_poliza')
                                 <span
                                     class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>
                             @enderror
                         </div>

                         <div class="text-right md:col-span-5">
                             <div class="inline-flex items-end">
                                 <button type="submit"
                                     class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Guardar</button>
                             </div>
                         </div>

                     </form>
                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>
