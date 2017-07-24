<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@yield('title')</h4>
        </div>
        <div class="status"></div>
        <div class="modal-body">
        @section('modal-content')

        @show
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->