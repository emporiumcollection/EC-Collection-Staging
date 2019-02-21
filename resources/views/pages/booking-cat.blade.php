
        
        @if(!empty($propertyDetail['typedata']))
        {{--*/ $first_index = true; /*--}}
        {{--*/ $row_index = 0; /*--}}
        <div class="item active">
            <ul class="thumbnails ai-custom-corusal-style">
                @foreach($propertyDetail['typedata'] as $key => $type)
                @if (isset($propertyDetail['roomimgs'][$type->id][0]))
                {{--*/ $row_index = $row_index + 1; /*--}}
                <li class="span3">
                    <label class="draggable-room-node draggable" for="roomType{{$type->id}}">
                        <div class="thumbnail">
                            <img class="img-responsive" src="{{$propertyDetail['roomimgs'][$type->id][0]->imgsrc.$propertyDetail['roomimgs'][$type->id][0]->file_name}}" alt=""/>
                        </div>
                        <div class="caption">
                            <h4>{{$type->category_name}}</h4>
                            @if($type->price!='')
                            <div class="hotel-slider-price">
                                @if($discount_apply!='')
                                    {{($currency->content!='') ? $currency->content : '$'}} {{$type->price}}
                                    <br />Discount 10% {{($currency->content!='') ? $currency->content : '$'}} {{ ($type->price) * 10 / 100 }}
                                    <br /> {{($currency->content!='') ? $currency->content : '$'}} {{ $type->price - (($type->price) * 10 / 100) }}
                                @else
                                    {{($currency->content!='') ? $currency->content : '$'}} {{$type->price}}         
                                @endif
                            </div>
                            @endif
                            <div class="description">{{$type->room_desc}}</div>
                        </div>
                    </label>
                    <input id="roomType{{$type->id}}" onclick="$('.roomTypeName').html('{{$type->category_name}}');" type="radio" {{(($_REQUEST['roomType'] == $type->id) || $first_index === true)? 'checked' : ''}} name="roomType" value="{{$type->id}}" />
                           {{--*/ $first_index = false; /*--}}
                </li>
                @if(($key % 3) == 0 && $key != 0 && count($propertyDetail['typedata']) > $row_index)
            </ul>
        </div>
        <div class="item">
            <ul class="thumbnails ai-custom-corusal-style">
                @endif
                @endif
                @endforeach
            </ul>
        </div>
        @endif
    