 @include('navigation-menu')
 <x-app-layout>
     <x-slot name="header">
         <h2 class="text-xl font-semibold leading-tight text-gray-800">
             Polizas
         </h2>
     </x-slot>

     <div class="py-12">
         <div class="p-16 mx-auto bg-white rounded">

             <div class="p-4">
                 <div>
                     <span
                         class="relative inline-block font-medium tracking-widest text-gray-900 uppercase date">Poliza</span>
                     <div class="flex mb-2">
                         <div class="w-3/12">
                             <span class="block text-sm text-gray-600">Nº:</span>
                             <span class="block text-sm text-gray-600">Creada:</span>
                             <span class="block text-sm text-gray-600">Actualizada:</span>
                         </div>
                         <div class="w-9/12">
                             <span class="block text-sm font-semibold">{{ $poliza->n_poliza }}</span>
                             <span class="block text-sm">{{ $poliza->created_at->format('Y-m-d H:i:s') }}</span>
                             <span class="block text-sm">{{ $poliza->updated_at->format('Y-m-d H:i:s') }}</span>
                         </div>
                     </div>
                 </div>
                 <div>
                     <span
                         class="relative inline-block font-medium tracking-widest text-gray-900 uppercase date">Soportes</span>
                     <div class="flex mb-2">
                         <div class="w-3/12">
                             <span class="block text-sm text-gray-600">Nº:</span>
                             <span class="block text-sm text-gray-600">Creada:</span>
                             <span class="block text-sm text-gray-600">Actualizada:</span>
                         </div>
                         <div class="w-9/12">
                             <span class="block text-sm font-semibold">{{ $poliza->n_poliza }}</span>
                             <span class="block text-sm">{{ $poliza->created_at->format('Y-m-d H:i:s') }}</span>
                             <span class="block text-sm">{{ $poliza->updated_at->format('Y-m-d H:i:s') }}</span>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 </x-app-layout>
