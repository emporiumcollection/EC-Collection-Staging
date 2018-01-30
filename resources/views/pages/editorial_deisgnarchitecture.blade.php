@if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
<div class="container">
    @if($propertyDetail['data']->architecture_image!='')
    <img class="architecture-sec-top-img" src="{{\ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->architecture_image),100,1050,null)}}" alt=""/>
    @else
    <img class="architecture-sec-top-img" src="{{\ImageCache::make(public_path('sximo/assets/images/Architecture-&-Design.png'),100,1050,null)}}" alt=""/>
    @endif
</div>
<div class="col-md-12 ">
    <div class=" bottom-sec-bg container">
        <div class="col-md-4 col-sm-6 smallMediaBox">
            <div class="small-box-bg">
                <div>
                    <p class="small-box-text">
                        {{$propertyDetail['data']->architecture_title}}
                    </p> 
                </div>
                <div><img class="arcgitecture-sec-testinomilas-align" src="{{ asset('sximo/assets/images/comma.png')}}" alt=""/></div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6">
            <div class="architecture-sec-heading">
                <h1>Architecture & Design</h1>
                <p>
                    {{$propertyDetail['data']->architecture_desciription}}
                </p>
            </div>
        </div>
    </div>
</div>
@endif