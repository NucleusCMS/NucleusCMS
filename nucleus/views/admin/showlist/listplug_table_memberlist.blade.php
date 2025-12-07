@if ('HEAD' === $type)
<th>&nbsp;</th>
<th>{{ _LIST_MEMBER_NAME }}</th>
<th>{{ _LIST_MEMBER_RNAME }}</th>
<th>{{ _LIST_MEMBER_URL }}</th>
<th>{{ _LIST_MEMBER_ADMIN }} {!! helpHtml('superadmin') !!}</th>
<th>{{ _LIST_MEMBER_LOGIN }} {!! helpHtml('canlogin') !!}</th>
<th>{{ _LISTS_ACTIONS }}</th>
@endif
@if ('BODY' === $type)
    @php
        $id = listplug_nextBatchId();
    @endphp
    <td class="memberlist-cell"><input type="checkbox" id="batch{{ $id }}" name="batch[{{ $id }}]" value="{{ $current->mnumber }}" /></td>
    <td><div class="memberlist-inline memberlist-break"><label for="batch{{ $id }}">{{ $current->mname }}</label></div></td>
    <td><div class="memberlist-inline memberlist-break">{{ $current->mrealname }}</div></td>
    <td><div class="memberlist-inline memberlist-break">email: <a href='mailto:{{$current->memail}}' tabindex='{{ ADMIN::getTabIndex() }}'>{{ $current->memail }}</a></div><br />
        @if( ! empty($current->murl) && preg_match('#^https?://[^/\s]+[^\s]+$#', trim($current->murl)))
            <div class="memberlist-inline memberlist-break">Website: <a href='{{ trim($current->murl) }}' tabindex='{{ ADMIN::getTabIndex() }}' target='_blank' rel='noreferrer' title='{{ trim($current->murl) }}'>URL</a></div>
        @endif
    </td>
    <td>{{ $current?->madmin ? _YES : _NO }}</td>
    <td>{{ $current?->mcanlogin ? _YES : _NO }}</td>

    <!-- actions -->
    <td>
        <div class="memberlist-inline memberlist-nowrap"><a href='{{ ADMIN::createActionLink('memberedit', ['memberid' => $current->mnumber]) }}'
           tabindex='{{ ADMIN::getTabIndex() }}'>{{ _LISTS_EDIT }}</a></div>
        <div class="memberlist-inline memberlist-nowrap"><a href='{{ ADMIN::createActionLink('memberdelete', ['memberid' => $current->mnumber]) }}'
           tabindex='{{ ADMIN::getTabIndex() }}'>{{ _LISTS_DELETE }}</a></div>
    @if ($member->id !== $current->mnumber)
        <div class="memberlist-inline memberlist-nowrap">
            @if (isset($current->mhalt) && ($current->mhalt))
                {{ _LISTS_HALTING }}
            @else
                <a href='{{ ADMIN::createActionLink('memberhalt', ['memberid' => $current->mnumber]) }}'
                   tabindex='{{ ADMIN::getTabIndex() }}'>{{ _LISTS_HALT }}</a>
            @endif
        </div>
    @endif
    </td>
@endif
