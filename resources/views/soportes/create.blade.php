 @include('navigation-menu')
 <x-app-layout>
     <x-slot name="header">
         <h2 class="text-xl font-semibold leading-tight text-gray-800">
             Agregar Soporte
         </h2>
     </x-slot>

     <div class="container mx-auto mt-8">
         <div class="p-4 px-4 mb-6 bg-white rounded shadow-lg md:p-8">
             <div class="grid grid-cols-1 gap-4 text-sm gap-y-2 lg:grid-cols-3">
                 <div class="text-gray-600">
                     <p class="text-lg font-medium">Agregar soporte a la poliza {{ $poliza->n_poliza }}</p>
                     <p>Complete los campos para agregar un nuevo documento de soporte</p>
                 </div>

                 <div class="lg:col-span-2">
                     @livewire('add-soporte', ['poliza' => $poliza])
                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>
