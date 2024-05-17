<section class="bg-white relative shadow-md rounded-lg p-4 h-full">
    <div class="flex">
        <h1 class="font-bold text-gray-700">{{$title}}</h1>
        <a href="{{$menu['baseURL'].$menu['route']['sellings']['root']}}" class="text-sm font-bold block ml-auto">Ver Más</a>
    </div>
    <hr class="mt-2"/>
    <table class="w-full text-sm text-left text-gray-700"> 
        <tbody>
            @if(count($data))
                @foreach ($data as $row) 
                    <tr class="border-b">
                        <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                            <a href="{{$menu['baseURL'].$menu['route']['users']['edit']($row->user_id)}}" class="font-bold text-[#526270] block">{{$row->fullname}}</a>
                            {{$row->username}}
                        </td>
                        <td scope="row" class="px-4 py-3 font-medium text-right whitespace-nowrap"><span class="rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">$ {{number_format((float)$row->total, 2, '.', '');}}</span></th>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="2"><h1 class="text-center py-4 text-4xl">Sin Citas Proximas</h1></td>
                </tr>
            @endif 
        </tbody>
    </table> 
</section>