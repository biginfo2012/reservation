<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center">ID</th>
        <th class="text-center">{{__('publish-time')}}</th>
        <th class="text-center">{{__('title')}}</th>
        <th class="text-center">{{__('status')}}</th>
        <th class="text-center">{{__('action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$item['id']}}</td>
            <td class="p-0 border text-center align-middle">{{isset($item['publish_time']) ? date('Y/m/d H:i', strtotime($item['publish_time'])) : ""}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['title']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['status'] == 0 ? __('draft') : ($item['status'] == 1 ? __('stand') : __('published'))}}</td>
            <td class="p-0 border text-center align-middle">
                <input type="hidden" value="{{$item['title']}}" class="title">
                <input type="hidden" value="{{$item['publish_time']}}" class="publish_time">
                <input type="hidden" value="{{$item['content']}}" class="content">
                <button class="btn btn-outline-dark waves-effect ex_change edit-noti" style="padding: 8px; margin: 5px;"
                        data-id="{{$item['id']}}" data-status="{{$item['status']}}">{{__('edit')}}</button>
                <button class="btn btn-outline-dark waves-effect ex_change delete-noti" style="padding: 8px; margin: 5px;" data-id="{{$item['id']}}">{{__('delete')}}</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
