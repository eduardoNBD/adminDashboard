<section class="bg-white relative shadow-md rounded-lg p-4 h-full">
    <div class="flex">
        <h1 class="font-bold text-gray-700">{{$title}}</h1>
        <a href={{$menu['baseURL'].$menu['route']['appointments']['root']}} class="text-sm font-bold block ml-auto">Ver Más</a>
    </div>
    <hr class="mt-2"/>
    <table class="w-full text-sm text-left text-gray-700"> 
        <tbody>
            @if(count($data))
                @foreach ($data as $row) 
                    <tr class="border-b">
                        <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                            <a href="{{$menu['baseURL'].$menu['route']['appointments']['edit']($row->id)}}" class="font-bold text-[#526270] flex block">
                                <span title="{{App\Http\Controllers\Controller::differenceInHours($row->begin) > 0 ? "Proximamente" : "Tarde"}}" class="{{App\Http\Controllers\Controller::differenceInHours($row->begin) > 0 ? "" : "text-red-800"}}"><svg  xmlns="http://www.w3.org/2000/svg" class="mr-1" width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg></span>
                                {{$row->client_id}}
                            </a>
                            {{$row->service_id}}
                        </td>
                        <td scope="row" class="px-4 py-3 font-medium text-right whitespace-nowrap"><span class="rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">{{App\Http\Controllers\Controller::parseDate($row->date." ".$row->begin)}}</span></td>
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