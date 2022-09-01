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
                 <div class="mb-4">
                     <span
                         class="relative inline-block font-medium tracking-widest text-gray-900 uppercase date">Poliza</span>
                     <div class="flex mb-2">
                         <div class="w-3/12">
                             <span class="block text-sm text-gray-600">Nº:</span>
                             <span class="block text-sm text-gray-600">Creada:</span>
                             <span class="block text-sm text-gray-600">Actualizada:</span>
                             @if ($poliza->path)
                                 <span class="block text-sm text-gray-600">Poliza:</span>
                             @endif
                         </div>
                         <div class="w-9/12">
                             <span class="block text-sm font-semibold">{{ $poliza->n_poliza }}</span>
                             <span class="block text-sm">{{ $poliza->created_at->format('Y-m-d H:i:s') }}</span>
                             <span class="block text-sm">{{ $poliza->updated_at->format('Y-m-d H:i:s') }}</span>
                             @if ($poliza->path)
                                 <span class="block text-sm">{{ $poliza->name }}</span>
                             @endif
                         </div>
                     </div>
                 </div>
                 <a href="{{ route('polizas.edit', ['poliza' => $poliza->id]) }}"
                     class="px-4 py-2 font-medium text-white transition duration-300 bg-blue-500 rounded-md text-1xl hover:bg-blue-700">Agregr
                     poliza</a>
                 @if ($poliza->path)
                     <a href="{{ route('polizas.zipDownload', ['poliza' => $poliza->id]) }}"
                         class="px-4 py-2 font-medium text-white transition duration-300 bg-blue-500 rounded-md text-1xl hover:bg-blue-700">Descargar
                         todos</a>
                 @endif
                 <div class="mt-4 mb-8">
                     <span
                         class="relative inline-block font-medium tracking-widest text-gray-900 uppercase date">Soportes</span>
                     <div class="flex mb-2">
                         <div class="w-full">
                             @foreach ($poliza->soportes as $soporte)
                                 <div class="flex flex-row items-center justify-between align-middle border-y">
                                     <a href="{{ route('soportes.show', $soporte->id) }}"
                                         class="block text-sm font-semibold text-blue-500 cursor-pointer hover:text-blue-600 hover:underline">{{ $soporte->name }}</a>
                                     <form action="{{ route('soportes.destroy', $soporte->id) }}" method="post">
                                         @csrf
                                         @method('delete')
                                         <button type="submit"
                                             class="text-sm text-red-500 hover:underline hover:text-red-600">Eliminar</button>
                                     </form>
                                 </div>
                             @endforeach
                         </div>
                     </div>
                 </div>
                 <a href="{{ route('soportes.create', ['poliza' => $poliza->id]) }}"
                     class="px-4 py-2 font-medium text-white transition duration-300 bg-blue-500 rounded-md text-1xl hover:bg-blue-700">Agregar
                     soporte</a>
                 @if (count($poliza->soportes) > 0)
                     <a href="{{ route('soportes.zipDownload', ['poliza' => $poliza->id]) }}"
                         class="px-4 py-2 font-medium text-white transition duration-300 bg-blue-500 rounded-md text-1xl hover:bg-blue-700">Descargar
                         soportes</a>
                 @endif
             </div>

         </div>
     </div>
 </x-app-layout>
