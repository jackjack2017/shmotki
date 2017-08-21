<div class="col-sm-5">
    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
        Показано {{$paginator->currentPage()}} из {{$paginator->lastPage()}}
    </div>
</div>

<div class="col-sm-7">
    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
        <ul class="pagination">
            <li class="paginate_button previous @if($paginator->currentPage() == 1) disabled @endif"
                id="example1_previous"><a
                        href="@if($paginator->previousPageUrl()){{$paginator->previousPageUrl()}}&size={{$paginator->perPage()}} @else # @endif"
                        aria-controls="example1"
                        data-dt-idx="0" tabindex="0">Предыдущая</a>
            </li>

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if($paginator->currentPage() == $i)
                    <li class="paginate_button active">
                        <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">{{$i}}</a>
                    </li>
                @else
                    @if($i == 1 || $i == $paginator->currentPage() - 1 || $i == $paginator->currentPage() + 1 || $i > $paginator->lastPage() - 1 || $i == $paginator->lastPage() - 1 || $i == 2 )
                        <li class="paginate_button ">
                            <a href="{{ $paginator->url($i) }}&size={{$paginator->perPage()}}"
                               aria-controls="example1" data-dt-idx="{{$i}}"
                               tabindex="0">{{$i}}</a>
                        </li>

                    @else
                        @if(($i == 3 && $i < $paginator->currentPage() - 1) || ($i == $paginator->currentPage() + 2 &&  $i <= $paginator->lastPage() - 2))
                            <li class="paginate_button disabled">
                                <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="{{$i}}" tabindex="0">…</a>
                            </li>
                        @endif
                    @endif

                @endif
            @endfor

            <li class="paginate_button next @if($paginator->lastPage() == $paginator->currentPage()) disabled @endif"
                id="example1_next">
                    <a href="@if($paginator->nextPageUrl()){{$paginator->nextPageUrl()}}&size={{$paginator->perPage()}}@else # @endif"
                        aria-controls="example1"
                        data-dt-idx="7"
                        tabindex="0">Следуюущая</a>
            </li>
        </ul>
    </div>
</div>

