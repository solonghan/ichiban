<tr data-id="{{ $item['id'] }}">
    @foreach ($item['data'] as $index => $obj)
    <td
        @if (isset($th_title[$index]) && $th_title[$index]['width'] != '')
        style = "max-width: {{ $th_title[$index]['width'] }}"
        @endif
    >{!! $obj !!}
    </td>
    @endforeach
    <td>
        @if (isset($item['other_btns']))
            @foreach ($item['other_btns'] as $btn)
            <button class="btn btn-sm {{ $btn['class'] }}" onclick="{{ $btn['action'] }}">{{ $btn['text'] }}</button>
            @endforeach
        @endif

        @if (!isset($item['priv_view']) || $item['priv_view'])
        <button type="button" class="btn btn-sm btn-success edit-item-btn">瀏覽</button>
        @endif

        @if (!isset($item['priv_edit']) || $item['priv_edit'])
        <button class="btn btn-sm btn-primary edit-item-btn">編輯</button>
        @endif
        
        @if (!isset($item['priv_del']) || $item['priv_del'])
        <button class="btn btn-sm btn-danger del-item-btn">刪除</button>
        @endif

    </td>
</tr>
<script>
    $(document).ready(function(e){

        $(".switch_toggle").off('change').on('change', function () {
            let status = 'on';
            if (!$(this).is(':checked')) status = 'off';
            console.log(status);
            console.log($(this).data());
            $.ajax({
                type: "POST",
                 url: '{{env('APP_URL')}}/mgr/{{$controller??''}}/switch_toggle',
                {{-- url: '{{env('APP_URL')}}/mgr/member/switch_toggle', --}}
                data: {
                    _token: '{{ csrf_token() }}',
                    id: $(this).data('id'),
                    status: status
                },
                dataType: "json",
                success: function(data){
                    // Uncomment if you want to show toast notifications
                     if (data.status){
                         if (status == 'on') {
                             Toastify({
                                 gravity: "top",
                                 position: "center",
                                 text: "已開啟",
                                 className: "success",
                             }).showToast();
                         } else {
                             Toastify({
                                 gravity: "top",
                                 position: "center",
                                 text: "已關閉",
                                 className: "danger",
                             }).showToast();
                         }
                    }
                },
                failure: function(errMsg) {
                    alert(errMsg);
                }
            });
        });
    });
</script>
