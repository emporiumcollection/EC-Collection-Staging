<div class="header-navigation-menu">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
               <!-- <ul class="nav navbar-nav">
                    <li class="active"><a  href="{{url('luxurytravel/Hotel')}}">HOTELS</a></li>
                    <!--<li><a  href="#">EXPERIENCE</a></li>
                    <li><a  href="{{url()}}/content-grid-shuffle">MAGAZINE</a></li>
                    <li><a  href="{{url('luxurytravel/Villas')}}">VILLAS</a></li>
                    <li><a  href="{{url('luxurytravel/Yachts')}}">YACHTS</a></li>
					<li><a  href="{{url('luxurytravel/Spas')}}">Spas</a></li>
                    <li><a  data-popup-id="search-page" class="video-popup-btn" href="#"><i class="fa fa-search"></i></a></li>
                </ul>-->
				<ul class="nav navbar-nav">
                                    <?php
                                    if(isset($slug) && strtolower($slug) == 'yachts') {
                                        $grid_menus = SiteHelpers::menus('yacht_grid');
                                        if(!empty($grid_menus)) {
                                            foreach ($grid_menus as $gmenu) {
                                                ?>
                                                <li class="<?php echo (isset($type) && $type == $gmenu['menu_name'])? '' : ''; ?>">
                                                    <a href="<?php echo ($gmenu['menu_type'] =='external')? URL::to($gmenu['url']) : URL::to($gmenu['module']); ?>" >
                                                    <?php
                                                    if(CNF_MULTILANG ==1 && isset($gmenu['menu_lang']['title'][Session::get('lang')])) {
                                                        echo $gmenu['menu_lang']['title'][Session::get('lang')];
                                                    }
                                                    else {
                                                        echo $gmenu['menu_name'];
                                                    }
                                                    ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    else {
                                        $grid_menus = SiteHelpers::menus('grid');
                                        if(!empty($grid_menus)) {
                                            foreach ($grid_menus as $gmenu) {
                                                ?>
                                                <li >
                                                    <a href="<?php echo ($gmenu['menu_type'] =='external')? URL::to($gmenu['url']) : URL::to($gmenu['module']); ?>" >
                                                    <?php
                                                    if(CNF_MULTILANG ==1 && isset($gmenu['menu_lang']['title'][Session::get('lang')])) {
                                                        echo $gmenu['menu_lang']['title'][Session::get('lang')];
                                                    }
                                                    else {
                                                        echo $gmenu['menu_name'];
                                                    }
                                                    ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
				</ul>
            </div>
        </div>
    </nav>
</div>