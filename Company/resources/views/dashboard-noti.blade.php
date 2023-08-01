<table class="table table-separate table-head-custom table-checkable" id="noti_table">
    <tbody>
    @foreach($notifications as $item)
        <tr class="{{$item['status'] == 0 ? 'color-red-tmp' : ''}}">
            <input type="hidden" value="{{$item['title']}}" class="title">
            <input type="hidden" value="{{date('Y/m/d H:i', strtotime($item['publish_time']))}}" class="publish_time">
            <input type="hidden" value="{{$item['content']}}" class="content">
            <td class="p-0 border text-start align-middle px-1">{{date('Y/m/d H:i', strtotime($item['publish_time']))}}</td>
            <td class="p-0 border text-start align-middle px-1">{{$item['title']}}</td>
            <td class="p-0 border text-center align-middle px-1">
                <button class="btn btn-outline-dark waves-effect show_noti {{$item['status'] == 0 ? 'color-red-tmp' : ''}}"
                        data-id="{{$item['id']}}" style="padding: 8px; margin: 5px;">{{__('detail')}}</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
