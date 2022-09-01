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


                 <table class="w-full text-sm text-left text-gray-500">
                     <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b">
                         <tr>
                             <th scope="col" class="px-6 py-3">
                                 Poliza
                             </th>
                             <th scope="col" class="px-6 py-3">
                                 Documento
                             </th>
                             <th scope="col" class="px-6 py-3">
                             </th>
                         </tr>
                     </thead>
                     <tbody>
                         @if ($soportes->isNotEmpty())
                             @foreach ($soportes as $soporte)
                                 <tr class="border-b hover:bg-gray-200">
                                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                         {{ $soporte->poliza->n_poliza }}
                                     </td>
                                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                         {{ $soporte->name }}
                                     </td>
                                     <td class="px-6 py-4">
                                         <div class="flex flex-row space-x-2">
                                             <a href="{{ route('soportes.show', $soporte->id) }}">Ver</a>
                                             <span>|</span>
                                             <a href="{{ route('soportes.edit', $soporte->id) }}">Editar</a>
                                             <span>|</span>
                                             <form action="{{ route('soportes.destroy', $soporte->id) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('delete')
                                                 <button type="submit">Eliminar</button>
                                             </form>
                                         </div>
                                     </td>
                                 </tr>
                             @endforeach
                         @endif
                     </tbody>
                 </table>

             </div>
         </div>
     </div>
 </x-app-layout>
