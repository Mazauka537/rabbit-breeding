<div class="pagination__wrapper">
    <div class="pagination">

        <div class="side-pagination-buttons">
            <div class="page-button @if($pagination['currentPage'] <= 1){{ 'disabled' }}@endif">
                <a @if($pagination['currentPage'] > 1){{ 'href=' . $pagination['route'] . '?page=1' . $pagination['arguments'] }}@endif title="первая страница"><<</a>
            </div>
            <div class="page-button next-prev-page-button @if($pagination['currentPage'] <= 1){{ 'disabled' }}@endif">
                @if($pagination['currentPage'] <= 1)
                    <a title="предыдущая страница"><</a>
                @else
                    <a title="предыдущая страница" href="{{ $pagination['route'] . '?page=' . ($pagination['currentPage'] - 1) . $pagination['arguments'] }}"><</a>
                @endif
            </div>
        </div>

        <ul class="middle-pagination-buttons">
            @if($pagination['currentPage'] > $pagination['size'] + 1)
                <li class="page-button page-overflow">
                    <a>...</a>
                </li>
            @endif
            @for($i = $pagination['currentPage'] - $pagination['size']; $i < $pagination['currentPage']; $i++)
                @if($i >= 1)
                    <li class="page-button {{ 'page-button-' . ($pagination['currentPage'] - $i) }}">
                        <a href="{{ $pagination['route'] . '?page=' . $i . $pagination['arguments'] }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            <li class="page-button page-button-0">
                <a>{{ $pagination['currentPage'] }}</a>
            </li>
            @for($i = $pagination['currentPage'] + 1; $i <= $pagination['currentPage'] + $pagination['size']; $i++)
                @if($i <= $pagination['pageCount'])
                    <li class="page-button {{ 'page-button-' . ($i - $pagination['currentPage']) }}">
                        <a href="{{ $pagination['route'] . '?page=' . $i . $pagination['arguments'] }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            @if($pagination['currentPage'] < $pagination['pageCount'] - $pagination['size'])
                <li class="page-button page-overflow">
                    <a>...</a>
                </li>
            @endif
        </ul>

        <div class="side-pagination-buttons">
            <div class="page-button next-prev-page-button @if($pagination['currentPage'] >= $pagination['pageCount']){{ 'disabled' }}@endif">
                @if($pagination['currentPage'] >= $pagination['pageCount'])
                    <a title="следующая страница">></a>
                @else
                    <a title="следующая страница" href="{{ $pagination['route'] . '?page=' . ($pagination['currentPage'] + 1) . $pagination['arguments'] }}">></a>
                @endif
            </div>
            <div class="page-button @if($pagination['currentPage'] >= $pagination['pageCount']){{ 'disabled' }}@endif">
                <a title="последняя страница" @if($pagination['currentPage'] < $pagination['pageCount']){{ 'href=' . $pagination['route'] . '?page=' . $pagination['pageCount'] . $pagination['arguments'] }}@endif>>></a>
            </div>
        </div>

    </div>
</div>
