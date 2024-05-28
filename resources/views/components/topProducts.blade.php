<section class="bg-white relative shadow-md rounded-lg p-4 h-full">
    <div class="flex">
        <h1 class="font-bold text-gray-700">{{$title}}</h1>
        <a href="{{$menu['baseURL'].$menu['route']['products']['root']}}" class="text-sm font-bold block ml-auto">Ver Más</a>
    </div>
    <hr class="mt-2"/>
    <table class="w-full text-sm text-left text-gray-700"> 
        <tbody>
            @if(count($data))
                @foreach ($data as $row) 
                    <tr class="border-b">
                        <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                            <a href="{{$menu['baseURL'].$menu['route']['products']['edit']($row->product_id)}}" class="font-bold text-[#526270] block">{{$row->product_name }}</a>
                            {!! $row->product_qty ? "Restan ".$row->product_qty : '<small class="block text-red-600"><i>Se termino</i></small>'!!}
                        </td>
                        <td scope="row" class="px-4 py-3 font-medium text-right whitespace-nowrap"><span class="rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">{{$row->total_sold}}</span></th>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="2"><h1 class="text-center py-4 text-4xl">Sin Productos vendidos</h1></td>
                </tr>
            @endif 
        </tbody>
    </table> 
</section>