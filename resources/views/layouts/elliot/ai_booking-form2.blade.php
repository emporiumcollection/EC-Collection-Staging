<link href="{{ asset('sximo/assets/css/jasor-slider.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/crousal-book-form.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/booking-form.css')}}" rel="stylesheet" type="text/css"/> 
<script src="{{ asset('sximo/assets/js/jasor.js')}}" type="text/javascript"></script>
<script src="{{ asset('sximo/assets/js/jssor.slider-22.2.10.mini.js')}}" type="text/javascript"></script>

<!--Booking-form Html-->
<div id="booking-form-pop-up" class="popup">
    <div class="popup-inner">
        <a href="#" class="popup-close-btn">&times;</a>
        <div class="popup-content">
            <div class="booking-form-bg">
                <div class="container">
                    <div class="form-custom-width">
                        <a href="#"><img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" alt="" class="img-responsive new-book-form-hotel-logo"/></a>
                        <div class="panel-group booking-form-villa" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a  data-toggle="collapse" data-parent="#accordion" href="#collapse1">YOUR STAY</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <h2 class="form-field-tittle">Your Stay</h2>
                                        <form id="step-first" class="form-group">
                                            <div class="booking-form-all-fields">
                                                <div>
                                                    <ul class="booking-form-dates" id="two-inputs">
                                                        <li>
                                                            <div class="booking-form-heading">Arrival Date</div>
                                                            <input  id="date-range-arrive" size="20" value="12-01-2017">
                                                        </li>
                                                        <li>
                                                            <div class="booking-form-heading">Departure Date</div>
                                                            <input  id="date-range-destination" size="20" value="">
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="right-input-align">
                                                    <div class="booking-form-heading">Number of Nights(s)</div>
                                                    <select class="booking-form-select-inputs-style">
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                        <option>13</option>
                                                        <option>14</option>
                                                        <option>15</option>
                                                        <option>16</option>
                                                        <option>18</option>
                                                        <option>19</option>
                                                        <option>21</option>
                                                        <option>22</option>
                                                        <option>23</option>
                                                        <option>24</option>
                                                        <option>25</option>
                                                        <option>26</option>
                                                        <option>27</option>
                                                        <option>28</option>
                                                        <option>29</option>
                                                        <option>30</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="booking-form-all-fields-row-2">
                                                <div class="input-field1">
                                                    ROOMS
                                                </div>
                                                <div class="input-field2">
                                                    <div class="booking-form-heading">Number of adults(s)</div>
                                                    <select class="booking-form-select-inputs-style">
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                    </select>
                                                </div>
                                                <div class="right-input-align2">
                                                    <div class="booking-form-heading">Number of Children</div>
                                                    <select class="booking-form-select-inputs-style">
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>
                                                </div>
                                                <a href="#" class="booking-add-room">ADD ROOM</a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div id="accordion-speical-code">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a  data-toggle="collapse" data-parent="#accordion-speical-code" href="#collapse-special1">Special Code</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse-special1" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <input class="custom-booking-input-field"  type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a  data-toggle="collapse" data-parent="#accordion-speical-code" href="#collapse-special2">Special Offer</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse-special2" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            Emporium Voyage Special Offer
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input  type="submit" class="validate-btn" value="BOOK YOUR STAY">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="click1" data-prevent-click="1" data-toggle="collapse" data-parent="#accordion" href="#collapse2">YOUR VILLA</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#crousal-tab-1" data-toggle="tab">HOTELS</a></li>
                                            <li><a href="#crousal-tab-2" data-toggle="tab">VILLAS</a></li>
                                            <li><a href="#crousal-tab-3" data-toggle="tab">YACHTS</a></li>
                                            <li> <a class="btn btn-primary btnNext crousal-btn-style" ><img src="{{asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""></a></li>
                                            <li> <a class="btn btn-primary btnPrevious crousal-btn-style" ><img src="{{asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""></a></li>
                                        </ul>
                                        <div class="tab-content crousal-tab-aligned">
                                            <div class="tab-pane active" id="crousal-tab-1">
                                                <div class="carousel slide ai-custom-crousal-alignment" id="ai-custom-villa-booking-Carousel">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <ul class="thumbnails ai-custom-corusal-style">
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="{{asset('sximo/assets/images/pic.ashx.jpeg')}}" alt=""/></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Miss Clara</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Water Velly</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>JW Marriot</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>The Taj Hotel</h4>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="item">
                                                            <ul class="thumbnails ai-custom-corusal-style">
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Hotel Name 1</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Hotel Name 2</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Hotel Name 3</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Hotel Name 4</h4>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="control-box">                            
                                                        <a data-slide="prev" href="#ai-custom-villa-booking-Carousel" class="carousel-control left villa-tab-inner-crousal-nxt-pre-btn"><img src="{{asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""></a>
                                                        <a data-slide="next" href="#ai-custom-villa-booking-Carousel" class="carousel-control right villa-tab-inner-crousal-nxt-pre-btn"><img src="{{asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""></a>
                                                    </div>  

                                                </div>

                                            </div>
                                            <div class="tab-pane" id="crousal-tab-2">
                                                <div class="carousel slide ai-custom-crousal-alignment" id="ai-custom-villa-booking-Carousel-tab-2">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <ul class="thumbnails ai-custom-corusal-style">
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Villa 1</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Villa 2</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Villa 3</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Villa 4</h4>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="item">
                                                            <ul class="thumbnails ai-custom-corusal-style">
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Villa 5</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Villa 6</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Villa 7</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Villa 8</h4>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="control-box">                            
                                                        <a data-slide="prev" href="#ai-custom-villa-booking-Carousel-tab-2" class="carousel-control left villa-tab-inner-crousal-nxt-pre-btn"><img src="{{asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""></a>
                                                        <a data-slide="next" href="#ai-custom-villa-booking-Carousel-tab-2" class="carousel-control right villa-tab-inner-crousal-nxt-pre-btn"><img src="{{asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""></a>
                                                    </div>  

                                                </div>
                                            </div>
                                            <div class="tab-pane" id="crousal-tab-3">
                                                <div class="carousel slide ai-custom-crousal-alignment" id="ai-custom-villa-booking-Carousel-tab-3">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <ul class="thumbnails ai-custom-corusal-style">
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Yachts 1</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Yachts 2</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Yachts 3</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Yachts 4</h4>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="item">
                                                            <ul class="thumbnails ai-custom-corusal-style">
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Yachts 5</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Yachts 6</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Yachts 7</h4>
                                                                    </div>
                                                                </li>
                                                                <li class="span3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        <h4>Yachts 8</h4>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="control-box">                            
                                                        <a data-slide="prev" href="#ai-custom-villa-booking-Carousel-tab-3" class="carousel-control left villa-tab-inner-crousal-nxt-pre-btn"><img src="{{asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""></a>
                                                        <a data-slide="next" href="#ai-custom-villa-booking-Carousel-tab-3" class="carousel-control right villa-tab-inner-crousal-nxt-pre-btn"><img src="{{asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""></a>
                                                    </div>  

                                                </div>
                                            </div>
                                        </div>
                                        <a class="booking-add-room margin-bottom-45 compare-villa-show-btn" href="javascript:void(0);">COMPARE HOTELS</a>
                                        <!-- Compare Villa -->
                                        <div class="clearfix"></div>
                                        <div class="compare-villa-show-hide">
                                            <div class="compare-villa-close-btn">
                                                Please drag and drop the villas that you wish to compare below
                                            </div>
                                            <div>
                                                <div class="col-md-3 col-sm-3 compare-villa-box">
                                                    <div class="row">
                                                        <div class="compare-villa-box-inner-text">Drop the Villa of your choice in this space</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 compare-villa-box">
                                                    <div class="row">
                                                        <div class="compare-villa-box-inner-text">Drop the Villa of your choice in this space</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 compare-villa-box">
                                                    <div class="row">
                                                        <div class="compare-villa-box-inner-text">Drop the Villa of your choice in this space</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Compare Villa -->
                                        <div id="jssor_1"  style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:400px;overflow:hidden;visibility:hidden;">
                                            <!-- Loading Screen -->
                                            <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
                                            <div data-u="slides" class="custom-thum-style" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
                                                <div>
                                                    <img src="{{asset('sximo/assets/images/pic.ashx.jpeg')}}" alt=""/>
                                                    <div data-u="thumb">
                                                        <img src="{{asset('sximo/assets/images/pic.ashx.jpeg')}}" alt=""/>
                                                        <div class="title_back"></div>
                                                        <div class="title">
                                                            Luxury Lobby
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <img src="{{asset('sximo/assets/images/pic.ashx2.jpeg')}}" alt=""/>
                                                    <div data-u="thumb">
                                                        <img src="{{asset('sximo/assets/images/pic.ashx2.jpeg')}}" alt=""/>
                                                        <div class="title_back"></div>
                                                        <div class="title">
                                                            Pool
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <img src="{{asset('sximo/assets/images/pic.ashx3.jpeg')}}" alt=""/>
                                                    <div data-u="thumb">
                                                        <img src="{{asset('sximo/assets/images/pic.ashx3.jpeg')}}" alt=""/>
                                                        <div class="title_back"></div>
                                                        <div class="title">
                                                            Outdoor Views
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <img src="{{asset('sximo/assets/images/Miss-Clara-by-Nobis-Stockholm-Sweden (2).jpg')}}" alt=""/>
                                                    <div data-u="thumb">
                                                        <img src="{{asset('sximo/assets/images/Miss-Clara-by-Nobis-Stockholm-Sweden (2).jpg')}}" alt=""/>
                                                        <div class="title_back"></div>
                                                        <div class="title">
                                                            Rooms
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Thumbnail Navigator -->
                                            <div data-u="thumbnavigator" class="jssort16" style="position:absolute;left:0px;bottom:0px;width:600px;height:100px;" data-autocenter="1">
                                                <!-- Thumbnail Item Skin Begin -->
                                                <div data-u="slides" style="cursor: default;">
                                                    <div data-u="prototype" class="p">
                                                        <div data-u="thumbnailtemplate" class="t"></div>
                                                    </div>
                                                </div>
                                                <!-- Thumbnail Item Skin End -->
                                            </div>
                                            <!-- Bullet Navigator -->
                                            <div data-u="navigator" class="jssorb03" style="bottom:116px;right:16px;">
                                                <!-- bullet navigator item prototype -->
                                                <div data-u="prototype" style="width:21px;height:21px;">
                                                    <div data-u="numbertemplate"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Jssor Slider -->
                                        <div class="below-slider-text">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <h4>Water Villa (1 bedr.)</h4>
                                                    <p>
                                                        Perched on traditional stilts, the fifteen Water Villas offer
                                                        an unforgettable seaside living experience.
                                                        <br>
                                                        Inside, the villa features lavish interiors with a beautifully appointed
                                                        living room and adjoining powder room, a spacious master bedroom with lagoon
                                                        or sea views, a double dressing room, a light-flooded bathroom with bathtub,
                                                        in and out rain showers and separated toilets.
                                                        <br>
                                                        Multiple overwater decks offer a dining table with sunken benches and an outdoor lounge
                                                        with deckchairs, welcoming armchairs as well as a refreshing rain shower and a 12.5-metre-long private infinity pool.
                                                        The Water Villa is undoubtedly an idyllic option for romantic getaways.
                                                        <br>
                                                        Guests traveling with young children are encouraged to book Island Villas.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="below-villa-slider-list">
                                                    <li>240 sqm one-bedroom stilt villa (2,583 sqft)</li>
                                                    <li>12.5-metre private infinity pool</li>
                                                    <li>Generous overwater decks with ocean or lagoon views</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="villa-see-more-details-btn">
                                            <a class ="villa-see-more-toggle" href="javascript:void(0);">See more details</a>
                                            <div class="clearfix"></div>
                                            <div class="villa-see-more-list">
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li>King size bed</li>
                                                        <li>Bathroom with his and her part, bathtub and separate shower </li>
                                                        <li>Cheval Blanc bath amenities, hair amenities by Leonor Greyl</li>
                                                        <li>Separate dressing room</li>
                                                        <li>Independent toilet</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li>12.5-metre-long private infinity pool</li>
                                                        <li>Outdoor dining pergola</li>
                                                        <li>Outdoor shower</li>
                                                        <li>TV, music, lighting and air-conditioning controlled through iPad</li>
                                                        <li>DVD player and airplay system</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li>Wi-fi and cable internet</li>
                                                        <li>In-room safe </li>
                                                        <li>Private bar</li>
                                                        <li>Pillow menu</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form  id="step-2" class="form-group">
                                            <input type="submit" class="margin-top-25 validate-btn" value="SUBMIT YOUR VILLA">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="click2" data-prevent-click="1" data-toggle="collapse" data-parent="#accordion" href="#collapse3">YOUR PREFERENCES</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <h2 class="form-field-tittle">Your Wishes</h2>
                                        <form  id="step-3" class="form-group">
                                            <div class="your-preferences-des-text">
                                                <p>Kindly specify any preferences or special requests you may have in
                                                    order to help us best prepare for your coming stay with us.
                                                </p>
                                                <div>
                                                    <p>Have you already stayed in one of our Maisons?
                                                        <span class="float-right-text">
                                                            <input type="radio">
                                                            <label>Yes</label>
                                                            <input type="radio">
                                                            <label>No</label>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="show-hide-preferences-sec">
                                                <p>Your Villa<span class="arrival-time-show-hide"><a class="pre-show-btn" href="javascript:void(0)">Please specify your arrival time</a></span></p>
                                                <div class="preferences-hide-area margin-bottom-10 margin-top-10">
                                                    <div>
                                                        <label>Expected arrival time</label>
                                                        <select class="two-inputs-style1 booking-form-select-inputs-style">
                                                            <option>hh</option>
                                                            <option>0</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                            <option>13</option>
                                                            <option>14</option>
                                                            <option>15</option>
                                                            <option>16</option>
                                                            <option>18</option>
                                                            <option>19</option>
                                                            <option>21</option>
                                                            <option>22</option>
                                                            <option>23</option>
                                                        </select>
                                                        <select class="two-inputs-style1 booking-form-select-inputs-style">
                                                            <option>mm</option>
                                                            <option>0</option>
                                                            <option>15</option>
                                                            <option>30</option>
                                                            <option>45</option>
                                                        </select>
                                                    </div>
                                                    <div class="margin-top-25">
                                                        <label>We would like assistance organizing our transfers  <input type="checkbox"></label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="margin-top-25">
                                                    <label>Family Name</label>
                                                    <input type="text" class="input-style-2" placeholder="First Name">
                                                    <input type="text" class="input-style-2" placeholder="Last Name">
                                                    <a class="specify-preferences-tooggle" href="javascript:void(0)">Specify preferences</a>
                                                </div>
                                                <div class="box-inner-bg margin-top-25 specify-preferences-list-hide">
                                                    <p>Preferences of </p>
                                                    <div>
                                                        <label class="single-label-width">Relationship</label>
                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                            <option></option>
                                                            <option>Self</option>
                                                            <option>Child</option>
                                                            <option>Family</option>
                                                            <option>Partner</option>
                                                            <option>Friend</option>
                                                        </select>
                                                    </div>
                                                    <div id="accordion-preferences-of-inner">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne1">Purpose of stay</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne1" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div>
                                                                        <label class="single-label-width">Purpose of your stay</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option>Annual holiday</option>
                                                                            <option>Anniversary</option>
                                                                            <option>Honeymoon</option>
                                                                            <option>Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-25">
                                                                        <div class=""><label>Do you want to provide us with further details regarding your stay?</label></div>
                                                                        <textarea class="form-control margin-top-10" rows="5"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed"  data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne2">Villa preferences</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne2" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div>
                                                                        <label class="single-label-width">Desired room temperature</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Standard (20-21°)</option>
                                                                            <option>Warm (22-23°)</option>
                                                                            <option>Cold (18-19°)</option>
                                                                            <option>No Air-conditionning please</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Smoking preference</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Smoking</option>
                                                                            <option>Non Smoking</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Rollaway bed</label>
                                                                        <input type="checkbox" class="single-check-box">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Crib</label>
                                                                        <input type="checkbox" class="single-check-box">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Wheelchair accessible</label>
                                                                        <input type="checkbox" class="single-check-box">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Generally I am size</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Extra Small</option>
                                                                            <option>Small</option>
                                                                            <option>Medium</option>
                                                                            <option>Large</option>
                                                                            <option>Extra Large</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne3">Bedding preferences</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne3" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div>
                                                                        <label class="single-label-width">Pillow firmness</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Firm</option>
                                                                            <option>Soft</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Pillow type</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Feather</option>
                                                                            <option>Foam</option>
                                                                            <option>Hypoallergenic</option>
                                                                            <option>Synthetic</option>
                                                                            <option>Orthopedic</option>
                                                                            <option>Pregnancy pillow</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Bed style</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Sheet only</option>
                                                                            <option>Duvet</option>
                                                                            <option>Sheet & Duvet</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Generally I sleep on the</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Right side of the bed</option>
                                                                            <option>Left side of the bed</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne4">Lifestyle preferences</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne4" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <p>Cultural Interests</p>
                                                                    <div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Art</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Architecture & Interior Design</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Cigars</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Dance</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Fashion</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Gastronomy</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Literature</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Dance</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Music</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Nature</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Photography</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Science</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Technology</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Travel</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Watches</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Wines & Spirits</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Other, please specify :</label>
                                                                        <input class="single-input-style" type="text">
                                                                    </div>
                                                                    <p class="margin-top-25">Sports</p>
                                                                    <div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Snorkeling</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Diving</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Sailing</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Tennis</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Golf</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Motorized water sports</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <p class="margin-top-25">Wellbeing</p>
                                                                    <div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Spa treatments</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Hair treatments</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Fitness</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Yoga</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Pilates</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Meditation</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">I would prefer my in-room language settings to be:</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>English</option>
                                                                            <option>French</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-preferences-of-inner" href="#collapse-preferences-of-inne5">Eating & Drinking preferences</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse-preferences-of-inne5" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <p>Dietary regime</p>
                                                                    <div class="col-md-12 checkbox-options-line-height">
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Vegetarian</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Halal</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Kosher</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Gluten-free</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Ovo-lactarian</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Favourite dishes</label>
                                                                        <input class="single-input-style" type="text">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Food allergies</label>
                                                                        <input class="single-input-style" type="text">
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Known allergies</label>
                                                                        <input class="single-input-style" type="text">
                                                                    </div>
                                                                    <p class="margin-top-25">Snacks</p>
                                                                    <div class="col-md-12 checkbox-options-line-height">
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Savory snacks</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Any sweet snacks</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Chocolate based pastries</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Fruit based pastries</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <p class="margin-top-25">Fruits</p>
                                                                    <div class="col-md-12 checkbox-options-line-height">
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Seasonal fruits</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Exotic fruits</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Dried fruits and nuts</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <p class="margin-top-25">Hot beverages</p>
                                                                    <div class="col-md-12 checkbox-options-line-height">
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Espresso</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Café au Lait</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Tea</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Herbal tea</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox">
                                                                            <label>Hot chocolate</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div>
                                                                        <p  class="margin-top-25">Sodas</p>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Coca</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Diet Coke</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Pepsi</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Diet Pepsi</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 checkbox-options-line-height">
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Orange Soda</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Lemon Soda</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Served with lemon</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox">
                                                                                <label>Served with ice cubes</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Preferred aperitif:</label>
                                                                        <select class="single-inputs-style1 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>Red wine</option>
                                                                            <option>White wine</option>
                                                                            <option>Champagne</option>
                                                                            <option>Cocktails</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="margin-top-10">
                                                                        <label class="single-label-width">Other remarks for our upcoming visit:</label>
                                                                        <input class="single-input-style" type="text">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="margin-top-25 validate-btn" value="SUBMIT YOUR PREFERENCES">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-prevent-click="1" class="click3" data-toggle="collapse" data-parent="#accordion" href="#collapse4">YOUR CONTACT DETAILS</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <h2 class="form-field-tittle">Your Contact Details</h2>
                                        <div class="break-border-bottom">
                                            <form  id="step-4" class="your-contact-detail-form">
                                                <div class="contact-form-alignment">
                                                    <div>
                                                        <input type="radio" name="our-contact-details" class="reserving-for-my-self-radio-btn">
                                                        <label>I am reserving for myself</label>
                                                        <div class="reveal-if-active">
                                                            <div class="reserving-myself-inner">
                                                                <p>If you already have an account, please <span class="login-bold-text">login</span> to use the existing contact details </p>
                                                                <ul class="contact-form-input-list">
                                                                    <li>
                                                                        <div class="booking-form-heading">Arrival Date</div>
                                                                        <input size="20" value="12-01-2017">
                                                                    </li>
                                                                    <li>
                                                                        <div class="booking-form-heading">Departure Date</div>
                                                                        <input size="20" value="">
                                                                    </li>
                                                                    <li>
                                                                        <a class="btn-ok-contact-submit" href="#">Ok</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="align-with-radio">
                                                        <input type="radio" name="our-contact-details" class="guest-reserve-radio-btn">
                                                        <label>I am reserving on behalf of someone else</label>
                                                        <div class="reveal-if-active">
                                                            <div class="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="your-contact-detail-sec-show-hide">
                                                    <h3 class="">Your Contact Details</h3>
                                                    <div class="margin-top-10 display-inline-block">
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">Title *</div>
                                                            <select class="select-width-88 booking-form-select-inputs-style">
                                                                <option></option>
                                                                <option>Mr.</option>
                                                                <option>Mrs.</option>
                                                                <option>Miss</option>
                                                            </select>
                                                        </div>
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">Last name *</div>
                                                            <input class="default-input-style margin-right-26" type="text">
                                                        </div>
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">First Name *</div>
                                                            <input class="default-input-style margin-right-26" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <div>Birthday </div>
                                                        <div class="margin-right-15 display-inline-block">
                                                            <select class="select-width-88 booking-form-select-inputs-style">
                                                                <option>dd</option>
                                                                <option>01</option>
                                                                <option>02</option>
                                                            </select>
                                                        </div>
                                                        <div class="margin-right-15 display-inline-block">
                                                            <select class="select-width-88 booking-form-select-inputs-style">
                                                                <option>mm</option>
                                                                <option>01</option>
                                                                <option>02</option>
                                                            </select>
                                                        </div>
                                                        <div class="margin-right-15 display-inline-block">
                                                            <select class="select-width-88 booking-form-select-inputs-style">
                                                                <option>yyyy</option>
                                                                <option>2017</option>
                                                                <option>2016</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="fields-end-border"></div>
                                                    <div>
                                                        <a class="secondry-address-toggle" href="javascript:void(0);">Secondary Address</a>
                                                        <div class="secondry-class-list">
                                                            <div class="margin-top-10">
                                                                <label class="margin-right-15">Address *</label>
                                                                <select class="display-inline-block select-width-200 booking-form-select-inputs-style">
                                                                    <option>00</option>
                                                                    <option>01</option>
                                                                    <option>02</option>
                                                                </select>
                                                                <div class="margin-top-25">
                                                                    <input class="form-control default-input-style margin-right-26" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10 display-inline-block">
                                                                <div class="display-inline-block">
                                                                    <div class="">City *</div>
                                                                    <input class="default-input-style margin-right-10 width-285" type="text">
                                                                </div>
                                                                <div class="display-inline-block">
                                                                    <div class="">Zip Code *</div>
                                                                    <input class="default-input-style margin-right-26 select-width-88" type="text">
                                                                </div>
                                                                <div class="display-inline-block">
                                                                    <div class="">Country *</div>
                                                                    <select class="select-width-161 booking-form-select-inputs-style">
                                                                        <option>00</option>
                                                                        <option>01</option>
                                                                        <option>02</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="fields-end-border"></div>
                                                        </div>
                                                        <div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="margin-top-10 display-inline-block">
                                                                        <div class="display-inline-block">
                                                                            <div class="">Land Line *</div>
                                                                            <input class="default-input-style margin-right-15 width-68" type="text">
                                                                        </div>
                                                                        <div class="display-inline-block">
                                                                            <input class="default-input-style  select-width-200" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="margin-top-10 display-inline-block">
                                                                        <div class="display-inline-block">
                                                                            <div class="">Mobile *</div>
                                                                            <input class="default-input-style margin-right-10 width-68" type="text">
                                                                        </div>
                                                                        <div class="display-inline-block">
                                                                            <input class="default-input-style   select-width-200" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="">Email **</div>
                                                                <input class="default-input-style margin-right-10 width-285" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="margin-top-25 display-inline-block">
                                                            <div class="margin-bottom-10">Your preferred means of communication</div>
                                                            <div class="display-inline-block">
                                                                <input type="radio">
                                                                <label>mailing address</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input type="radio">
                                                                <label>email</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input type="radio">
                                                                <label>land line</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input type="radio">
                                                                <label>mobile</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Account Details -->
                                                    <div class="your-account-sec">
                                                        <h4 class="account-tittle">Your account&nbsp;<span class="optional">(optional)</span></h4>
                                                        <p>To facilitate future bookings, we invite you to create a 
                                                            personal account by entering a password.
                                                        </p>
                                                        <div class="margin-top-10">
                                                            <label class="single-label-width">Password</label>
                                                            <input class="single-input-style" type="text">
                                                        </div>
                                                        <div class="margin-top-10">
                                                            <label class="single-label-width">Confirm the password</label>
                                                            <input class="single-input-style" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="partition-border-bottom"></div>
                                                    <!--Account Details -->
                                                    <!-- Guest Contact Details -->
                                                    <div class="guest-contact-detail-sec">
                                                        <h3 class="">Your Guest Details</h3>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="single-label-width">Title *</div>
                                                                <select class="select-width-88 booking-form-select-inputs-style">
                                                                    <option>00</option>
                                                                    <option>01</option>
                                                                    <option>02</option>
                                                                </select>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <div class="single-label-width">Last name *</div>
                                                                <input class="default-input-style margin-right-26" type="text">
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <div class="single-label-width">First Name *</div>
                                                                <input class="default-input-style margin-right-26" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="margin-top-10">
                                                            <div>Birthday </div>
                                                            <div class="margin-right-15 display-inline-block">
                                                                <select class="select-width-88 booking-form-select-inputs-style">
                                                                    <option>00</option>
                                                                    <option>01</option>
                                                                    <option>02</option>
                                                                </select>
                                                            </div>
                                                            <div class="margin-right-15 display-inline-block">
                                                                <select class="select-width-88 booking-form-select-inputs-style">
                                                                    <option>00</option>
                                                                    <option>01</option>
                                                                    <option>02</option>
                                                                </select>
                                                            </div>
                                                            <div class="margin-right-15 display-inline-block">
                                                                <select class="select-width-88 booking-form-select-inputs-style">
                                                                    <option>00</option>
                                                                    <option>01</option>
                                                                    <option>02</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="fields-end-border"></div>
                                                        <div>
                                                            <a class="secondry-address-toggle" href="javascript:void(0);">secondary address</a>
                                                            <div class="secondry-class-list">
                                                                <div class="margin-top-10">
                                                                    <label class="margin-right-15">Address *</label>
                                                                    <select class="display-inline-block select-width-200 booking-form-select-inputs-style">
                                                                        <option></option>
                                                                        <option>personal</option>
                                                                        <option>professional</option>
                                                                    </select>
                                                                    <div class="margin-top-25">
                                                                        <input class="form-control default-input-style margin-right-26" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="margin-top-10 display-inline-block">
                                                                    <div class="display-inline-block">
                                                                        <div class="">City *</div>
                                                                        <input class="default-input-style margin-right-10 width-285" type="text">
                                                                    </div>
                                                                    <div class="display-inline-block">
                                                                        <div class="">Zip Code *</div>
                                                                        <input class="default-input-style margin-right-26 select-width-88" type="text">
                                                                    </div>
                                                                    <div class="display-inline-block">
                                                                        <div class="">Country *</div>
                                                                        <select class="select-width-161 booking-form-select-inputs-style">
                                                                            <option></option>
                                                                            <option>America</option>
                                                                            <option>India</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="fields-end-border"></div>
                                                            </div>
                                                            <div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="margin-top-10 display-inline-block">
                                                                            <div class="display-inline-block">
                                                                                <div class="">Land Line *</div>
                                                                                <input class="default-input-style margin-right-15 width-68" type="text">
                                                                            </div>
                                                                            <div class="display-inline-block">
                                                                                <input class="default-input-style  select-width-200" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="row">
                                                                        <div class="margin-top-10 display-inline-block">
                                                                            <div class="display-inline-block">
                                                                                <div class="">Mobile *</div>
                                                                                <input class="default-input-style margin-right-10 width-68" type="text">
                                                                            </div>
                                                                            <div class="display-inline-block">
                                                                                <input class="default-input-style   select-width-200" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10 display-inline-block">
                                                                <div class="display-inline-block">
                                                                    <div class="">Email **</div>
                                                                    <input class="default-input-style margin-right-10 width-285" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Guest Contact Details -->
                                                    <!-- Credit card details section-->
                                                    <div class="credit-card-details-sec">
                                                        <h4>Your credit card details</h4>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="">Type of card</div>
                                                                <select class="display-inline-block width-285 booking-form-select-inputs-style">
                                                                    <option></option>
                                                                    <option>American Express</option>
                                                                    <option>MasterCard</option>
                                                                    <option>Visa</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="">Credit card number *</div>
                                                                <input class="default-input-style margin-right-10 width-285" type="text">
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <div class="">Expiry date *</div>
                                                                <select class="select-width-88  margin-right-26 booking-form-select-inputs-style">
                                                                    <option></option>
                                                                    <option>January</option>
                                                                    <option>February</option>
                                                                    <option>March</option>
                                                                    <option>April</option>
                                                                    <option>May</option>
                                                                    <option>June</option>
                                                                    <option>July</option>
                                                                    <option>August</option>
                                                                    <option>September</option>
                                                                    <option>October</option>
                                                                    <option>November</option>
                                                                    <option>December</option>
                                                                </select>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <select class="select-width-88 booking-form-select-inputs-style">
                                                                    <option></option>
                                                                    <option>2017</option>
                                                                    <option>2016</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <p class="margin-top-25">This credit card will be charged applicable deposit fees 
                                                            as described in Terms & Conditions and may be used in 
                                                            the event of late cancellation or no-show.
                                                        </p>
                                                    </div>
                                                    <!-- Credit card details section-->
                                                    <!--Terms and conditions-->
                                                    <div class="margin-top-25 terms-conditiond-sec">
                                                        <h4 class="margin-bottom-15">Terms And Conditions</h4>
                                                        <input type="checkbox">
                                                        <label>
                                                            By checking this box, I accept and acknowledge <a href="#">EMPORIUM VOYAGE</a> 
                                                        </label>
                                                    </div>
                                                    <!--Terms and conditions-->
                                                    <div class="partition-border-bottom"></div>
                                                    <div class="tam-below-txt">
                                                        <p>It is a long established fact that a reader will
                                                            be distracted by the readable content of a page when looking at its layout.
                                                            The point of using Lorem Ipsum is that
                                                            it has a more-or-less normal distribution of letters,
                                                            as opposed to using 'Content here, content here',
                                                            making it look like readable English. Many desktop
                                                            publishing packages and web page editors now use Lorem
                                                            Ipsum as their default model text, and a search for 
                                                            'lorem ipsum' will uncover many web sites still in
                                                            their infancy. Various versions have evolved over
                                                            the years, sometimes by accident, sometimes on purpose
                                                            <br>
                                                            <br>
                                                            It is a long established fact that a reader will
                                                            be distracted by the readable content of a page when looking at its layout.
                                                            The point of using Lorem Ipsum is that
                                                            it has a more-or-less normal distribution of letters,
                                                            as opposed to using 'Content here, content here.
                                                            <br>
                                                            <br>
                                                            It is a long established fact that a reader will
                                                            be distracted by the readable content of a page when looking at its layout.
                                                            The point of using Lorem Ipsum is that
                                                            it has a more-or-less normal distribution of letters,
                                                            as opposed to using 'Content here, content here.
                                                        </p>
                                                    </div>
                                                </div>
                                                <input type="submit" class="margin-top-25 validate-btn" value="SUBMIT CONTACT DETAILS">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-prevent-click="1" class="click4" data-toggle="collapse" data-parent="#accordion" href="#collapse5">CONFIRMATION</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <form action="javascript:void(0)" id="step-5" class="form-group">
                                            <!--Terms and conditions-->
                                            <div class="margin-top-25 terms-conditiond-sec">
                                                <h4 class="margin-bottom-15">Terms And Conditions</h4>
                                                <input type="checkbox">
                                                <label>
                                                    By checking this box, I accept and acknowledge <a href="#">EMPORIUM VOYAGE</a> 
                                                </label>
                                            </div>
                                            <!--Terms and conditions-->
                                            <input type="submit" class="margin-top-25 validate-btn" value="SUBMIT CONFIRMATION">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--Booking End Html End Here-->
    <script>
        $(document).ready(function () {
            $(".booking-form-pop-up-btn").on("click", function (event) {
                event.preventDefault();
                var popup_id = $(this).data("popup-id");
                $("#" + popup_id).fadeIn("slow");
                $("body").addClass("fixed");
            });
            $(".popup-close-btn").click(function (event) {
                event.preventDefault();
                $(this).parent().parent().fadeOut("slow");
                $("body").removeClass("fixed");
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".pre-show-btn").click(function () {
                $(".preferences-hide-area").stop().toggle(1000);
            });
            $(".specify-preferences-tooggle").click(function () {
                $(".specify-preferences-list-hide").toggle(1000);
            });
            $(".villa-see-more-list").hide(1000);
            $('.villa-see-more-toggle').click(function () {
                var link = $(this);
                $('.villa-see-more-list').slideToggle('slow', function () {
                    if ($(this).is(':visible')) {
                        link.text('Hide Details');
                    } else {
                        link.text('Show Details');
                    }
                });
            });
            $(".secondry-class-list").hide(1000);
            $('.secondry-address-toggle').click(function () {
                $(".secondry-class-list").stop().toggle(1000);
            });

            $(".your-contact-detail-sec-show-hide").hide(1000);
            $(".guest-reserve-radio-btn").click(function () {
                $(".your-contact-detail-sec-show-hide").show(1000);
                $(".guest-contact-detail-sec").show(1000);
            });
            $(".reserving-for-my-self-radio-btn").click(function () {
                $(".your-contact-detail-sec-show-hide").show(1000);
                $(".guest-contact-detail-sec").hide(1000);
            });
            $('.btnNext').click(function () {
                $('.nav-tabs > .active').next('li').find('a').trigger('click');
            });

            $('.btnPrevious').click(function () {
                $('.nav-tabs > .active').prev('li').find('a').trigger('click');
            });
            $(".compare-villa-show-btn").click(function () {
                $(".compare-villa-show-hide").show(1000);
                $(".compare-villa-show-btn").hide(1000);
                $("#jssor_1").hide(1000);
                $(".below-slider-text").hide(1000);
            });
            $(".compare-villa-close-btn").click(function () {
                $(".compare-villa-show-hide").hide(1000);
                $(".compare-villa-show-btn").show(1000);
                $("#jssor_1").show(1000);
                $(".below-slider-text").show(1000);
            });
            $("#step-first").submit(function (event) {
                event.preventDefault();
                $(".click1").data("prevent-click", "0");
                $(".click1").trigger("click");
            });

            $(".click1").click(function (event) {
                if ($(this).data('prevent-click') == '1') {
                    event.stopPropagation();
                    event.preventDefault();
                    alert("Please Fill Up The Fields Above Frist");
                }
            });

            $("#step-2").submit(function (event) {
                event.preventDefault();
                $(".click2").data("prevent-click", "0");
                $(".click2").trigger("click");
            });

            $(".click2").click(function (event) {
                if ($(this).data('prevent-click') == '1') {
                    event.stopPropagation();
                    event.preventDefault();
                    alert("Please Fill Up The Fields Above Frist");
                }
            });

            $("#step-3").submit(function (event) {
                event.preventDefault();
                $(".click3").data("prevent-click", "0");
                $(".click3").trigger("click");
            });

            $(".click3").click(function (event) {
                if ($(this).data('prevent-click') == '1') {
                    event.stopPropagation();
                    event.preventDefault();
                    alert("Please Fill Up The Fields Above Frist");
                }
            });

            $("#step-4").submit(function (event) {
                event.preventDefault();
                $(".click4").data("prevent-click", "0")
                $(".click4").trigger("click");
            });

            $(".click4").click(function (event) {
                if ($(this).data('prevent-click') == '1') {
                    event.stopPropagation();
                    event.preventDefault();
                    alert("Please Fill Up The Fields Above Frist");
                }
            });
        });
        var FormStuff = {
            init: function () {
                this.applyConditionalRequired();
                this.bindUIActions();
            },
            bindUIActions: function () {
                $("input[type='radio'], input[type='checkbox']").on("change", this.applyConditionalRequired);
            },
            applyConditionalRequired: function () {
                $(".require-if-active").each(function () {
                    var el = $(this);
                    if ($(el.data("require-pair")).is(":checked")) {
                        el.prop("required", true);
                    } else {
                        el.prop("required", false);
                    }
                });
            }
        };
        FormStuff.init();
    </script>