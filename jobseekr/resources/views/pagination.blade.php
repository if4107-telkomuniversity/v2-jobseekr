<?php
    $current = $obj->currentPage();
    $next = $current+1;
    $prev = $current-1;
    $last = $obj->lastPage();
    $get_params = '?';
    if (!isset($request_param)) $request_param = [];
    foreach ($request_param as $r) {
        $get_params = $get_params.$r['key'].'='.$r['value'].'&';
    }
?>

<nav class="pagination" role="navigation" aria-label="pagination">
    @if ($current > 1)
    <a class="button pagination-previous" href="{{$get_params.'page='.$prev}}">Previous page</a>
    @endif
    @if ($obj->hasMorePages())
    <a class="button pagination-next" href="{{$get_params.'page='.$next}}">Next page</a>
    @endif

    <ul class="pagination-list">
        <!-- first -->
        @if ($current > 1)
        <li>
            <a class="button pagination-link" aria-label="Goto page 1" href="{{$get_params.'page=1'}}">1</a>
        </li>
        @endif
        <!-- ellipsis -->
        @if ($current > 3)
        <li>
            <span class="pagination-ellipsis">&hellip;</span>
        </li>
        @endif
        <!-- 1 before -->
        @if ($current > 2)
        <li>
            <a class="button pagination-link" aria-label="Goto page {{$prev}}" href="{{$get_params.'page='.$prev}}">{{$prev}}</a>
        </li>
        @endif
        <!-- current -->
        <li>
            <a class="button pagination-link is-current" aria-label="Page {{$current}}" aria-current="page">{{$current}}</a>
        </li>
        <!-- 1 next -->
        @if ($obj->hasMorePages())
        @if ($next < $last)
        <li>
            <a class="button pagination-link" aria-label="Goto page {{$next}}" href="{{$get_params.'page='.$next}}">{{$next}}</a>
        </li>
        @endif
        <!-- ellipsis -->
        @if ($obj->currentPage()+2 < $obj->lastPage())
        <li>
            <span class="pagination-ellipsis">&hellip;</span>
        </li>
        @endif
        <!-- last -->
        <li>
            <a class="button pagination-link" aria-label="Goto page {{$last}}" href="{{$get_params.'page='.$last}}">{{$last}}</a>
        </li>
        @endif
    </ul>
</nav>