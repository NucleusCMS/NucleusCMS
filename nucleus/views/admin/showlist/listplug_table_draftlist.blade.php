@if ('HEAD' === $type)
    <th>{{ _LISTS_BLOG }}</th>
    <th>{{ _LISTS_TITLE }}</th>
    @if ($show_author)
    <th>{{ _LISTS_AUTHOR }}</th>
    @endif
    <th colspan='2'>{{ _LISTS_ACTIONS }}</th>
@endif
@if ('BODY' === $type)
    <td>{{ $current->bshortname }}</td>
    <td>{{ strip_tags($current->ititle) }}</td>
    @if ($show_author)
    <td>{{ $current->mname }}</td>
    @endif
    <td><a href='index.php?action=itemedit&amp;itemid={{ $current->inumber }}'>{{ _LISTS_EDIT }}</a></td>
    <td><a href='index.php?action=itemdelete&amp;itemid={{ $current->inumber }}'>{{ _LISTS_DELETE }}</a></td>
@endif
