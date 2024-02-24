<tr>
    <th>{{ $label }}</th>
    <th>:</th>
    <td>
        @if($wrapped)
        
                @if($escape)
                    {{ $content }}&nbsp;
                @else
                    {!! $content !!}&nbsp;
                @endif
                   
        @else
            @if($escape)
                {{ $content }}
            @else
                {!! $content !!}
            @endif
        @endif
    </td>
</tr>
