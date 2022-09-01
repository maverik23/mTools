 @include('navigation-menu')
 <x-app-layout>
     <x-slot name="header">
         <h2 class="text-xl font-semibold leading-tight text-gray-800">
             Comparar
         </h2>
     </x-slot>

     <div class="py-12">
         <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
             <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">


                 <table class="w-full text-sm text-left text-gray-500">
                     <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b">
                         <tr>
                             <th scope="col" class="px-6 py-3">
                                 Planilla Base
                             </th>
                             <th scope="col" class="px-6 py-3">
                                 <a href="{{ route('comparar.create') }}"
                                     class="px-4 py-2 font-medium text-white transition duration-300 bg-blue-500 rounded-md text-1xl hover:bg-blue-700">Importar</a>
                             </th>
                         </tr>
                     </thead>
                     <tbody>
                         @if ($bases->isNotEmpty())
                             @foreach ($bases as $base)
                                 <tr class="border-b hover:bg-gray-200">
                                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                         {{ $base->id }}
                                     </td>
                                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                         {{ $base->row }}
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
