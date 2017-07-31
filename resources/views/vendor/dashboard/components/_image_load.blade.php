<div class="form-group">
    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">{{$label}}</div>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <label for="{{$name}}" class="btn btn-box-tool bg-green" data-toggle="tooltip" title="Изменить"><i class="fa fa-edit"></i></label>
            </div>
        </div>
        <div class="box-body js_media-preview-{{$name}}  @if(gettype($current_img) === 'array')img-gallery @endif">
            @if(gettype($current_img) === 'string' )
                <img class="img-responsive" src="{{$current_img}}" alt="">
                @if($show_details)
                    <p class="text-muted text-center"><small style="word-break: break-all;">{{basename($current_img)}}</small></p>
                    {{--<p class="text-muted text-center"><small>{{$image_details[0]}}х{{$image_details[1]}}</small></p>--}}
                @endif
            @else
                @if(count($current_img) > 0)
                    @foreach($current_img as $key => $img)
                        <div class="img-blk">
                            <img class="img-responsive" src="{{$img}}" alt="">
                            @if($show_details)
                                <p class="text-muted text-center"><small style="word-break: break-all;">{{basename($img)}}</small></p>
                                {{--<p class="text-muted text-center"><small>{{$image_details[$key][0]}}х{{$image_details[$key][1]}}</small></p>--}}
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="img-blk">
                        <img class="img-responsive" src="{{url('webmagic/dashboard/img/img-placeholder.png')}}" alt="">
                    </div>
                @endif
            @endif
        </div>
        {!! $form_builder->hidden($name . '_update') !!}
        {!! $form_builder->label($name, $label, ['class' => 'hidden']) !!}
        {!! $form_builder->file($name, $options) !!}
    </div>
</div>