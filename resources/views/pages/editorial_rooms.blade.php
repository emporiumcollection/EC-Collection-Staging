@if (array_key_exists('typedata', $propertyDetail))

<ul class="image-slider">
    {{--*/ $k=1; $tottyp = count($propertyDetail['roomimgs']); /*--}}
    @foreach($propertyDetail['typedata'] as $key=>$type)
    @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
    {{--*/ $nextkey = false; $totimg = count($propertyDetail['roomimgs'][$type->id]['imgs']); /*--}}
    @if($k==1) {{--*/ $ftky = $type->id; $ftkey = $key; /*--}} @endif

    @if(end($propertyDetail['typedata'])!=$type)
    {{--*/ $nxtkey = $propertyDetail['typedata'][$key+1]->id; /*--}}
    @for($nk=2;$nextkey!=true;$nk++)
    @if (array_key_exists($nxtkey, $propertyDetail['roomimgs']))
    {{--*/ $nxtkey = $nxtkey; $nextkey=true; /*--}}
    @else
    {{--*/ $nxtkey = $propertyDetail['typedata'][$key+$nk]->id; /*--}}
    @endif
    @endfor
    @endif

    <li class="{{($propertyDetail['typedata'][$ftkey]==$type) ? 'active' : ''}}">
        <a href="#">
            <img class="img-responsive" src="{{\ImageCache::make($propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgsrc_dir'].$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgs'][0]->file_name,100,1050,null)}}" alt="{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgs'][0]->file_name}}" style="height:580px; width: 100%;">
        </a>
        <div class="col-md-12 col-sm-12">
            <div class="col-md-6 col-sm-6">
                <div class="row">
                    <div class="image-slider-btns-bg">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="row">
                        <div class="slider-sec-side-text-bg">
                            <div class="slider-side-sec-alignment">
                                <div class="expeience-small-text">Experience {{$propertyDetail['data']->property_name}}</div>
                                <div class="slider-side-text-tittle">{{$type->category_name}}</div>
                                <div class="slider-side-description-text">
                                    {{(strlen($type->room_desc) > 300) ? substr($type->room_desc,0,300).'...':$type->room_desc}}
                                </div>
                            </div>
                            <div>
                                @if(end($propertyDetail['typedata'])==$type)
                                <img class="slider-next-image-btn img-responsive" src="{{\ImageCache::make($propertyDetail['roomimgs'][$ftky]['imgsrc_dir'].$propertyDetail['roomimgs'][$ftky]['imgs'][0]->file_name,100,200,null)}}" alt=""/>
                                @else
                                <img class="slider-next-image-btn img-responsive" src="{{\ImageCache::make($propertyDetail['roomimgs'][$nxtkey]['imgsrc_dir'].$propertyDetail['roomimgs'][$nxtkey]['imgs'][0]->file_name,100,200,null)}}" alt=""/>
                                @endif
                                <a href="#" style="margin-left:100px;" rel="{{$type->id}}" class="book-button open-show_more-page hotel-btn">Show More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    {{--*/ $k++; /*--}}
    @endif
    @endforeach
</ul>
<div class="clearfix"></div>
<div class=" editorial-images-count images-count">1 / {{$tottyp}}</div>
<div class="editorial-image-slider-btns image-slider-btns">
    <a class="editorial-image-slider-previous-btn image-slider-previous-btn" href="#">
        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""/>
    </a>
    <a class="image-slider-next-btn editorial-image-slider-next-btn" href="#">
        <img src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""/>
    </a>
</div>
@endif
<script>
    $(".editorial-image-slider-previous-btn").click(function ( event ) {
        event.preventDefault();
        
        var index = $(this).parent().parent().find(".image-slider li.active").index();
		$(this).parent().parent().find(".image-slider li.active").removeClass("active");
        if (index == 0) {
			var lindex = $(this).parent().parent().find(".image-slider li:last-child").index() +1;
            $(this).parent().parent().find(".image-slider li:nth-child("+lindex+")").addClass("active");
			$(this).parent().parent().find(".images-count").html( lindex + " / " + $(this).parent().parent().find(".image-slider li").length);
        }
		else
		{
			var rlindex = index - 1;
			$(this).parent().parent().find(".image-slider li:eq("+rlindex+")").addClass("active");
			$(this).parent().parent().find(".images-count").html( index + " / " + $(this).parent().parent().find(".image-slider li").length);
		}
		
        
    });
    
    $(".editorial-image-slider-next-btn").click(function ( event ) {
        event.preventDefault();

        var index = $(this).parent().parent().find(".image-slider li.active").index();
        if (index == $(this).parent().parent().find(".image-slider li:last-child").index()) {
            index = -1;
        }
        $(this).parent().parent().find(".image-slider li.active").removeClass("active");
        $(this).parent().parent().find(".image-slider li:nth-child(" + (+index + 2) + ")").addClass("active");
        
        $(this).parent().parent().find(".images-count").html( (+index + 2) + " / " + $(this).parent().parent().find(".image-slider li").length);
        
    });

    setInterval(function () {
        var index = $(".auto-slider ul.image-slider > li.active").index();
        if (index == $(".auto-slider ul.image-slider > li:last-child").index()) {
            index = -1;
        }

        $(".auto-slider ul.image-slider > li.active").removeClass("active");
        $(".auto-slider ul.image-slider > li:nth-child(" + (+index + 2) + ")").addClass("active");
        $(".auto-slider .images-count").html((+index + 2) + " / " + $(".auto-slider ul.image-slider > li").length);

    }, 40000);
</script>