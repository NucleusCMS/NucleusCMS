<!DOCTYPE html>
<html lang="{{ _LANG_CODE }}">
<head>
{!! $head !!}
</head>
<body>
    <div id="adminwrapper">
        <div class="header">
            <h1>{{ $SiteName }}</h1>
        </div>
        <div id="container">
            <div id="content">
                @php $oAdmin->loginname(); @endphp
                @if ($oAdmin->hasSystemInfoMessages())
                    <div class="system-info-messages">
                        @foreach ($oAdmin->getSystemInfoMessages() as $info)
                            <div class="system-info-message system-info-{{ $info[0] }}">{!! $info[1] !!}</div>
                        @endforeach
                    </div>
                @endif
                {!! $content !!}
            </div>
            {!! $foot !!}
        </div>
    </div>
</body>
</html>
