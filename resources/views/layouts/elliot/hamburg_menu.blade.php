 <!-- my popup hamburg menu -->
        <div id="ev-primary-navigation" class="popup personlized-service-pop-up-outer">
            <div class="popup-inner personlized-service-pop-up EVpopService">
                <a href="#" class="popup-close-btn personlized-service-pop-up-close-btn">&times;</a>
                <div class="popup-content personlized-service-content EVhamburgService">
                    <!-- code here-->
                    <div class="col-md-12">
            <div id="" class="">
                <div class="popup-inner personlized-service-pop-up EVpopService">
                    <!--<a href="#" class="popup-close-btn personlized-service-pop-up-close-btn">&times;</a>-->
                    <div class="popup-content personlized-service-content">
                        <div class="popup-form-center EVcenterPOP">

                                       
                                                <?php 
                                                //Start Popup Menu 
                                                    $popup      = SiteHelpers::menus( 'popup' ,'all'); 
                                                     
                                                ?>
                                            <ul class="EVMenu">
                                                @foreach ($popup as $keyMenu=>$menu)
                                                  <li class="{{($keyMenu==0)?'first':''}} {{(count($menu['childs']) > 0)?'expanded':''}}  menu-depth-1 menu-item-{{$menu['menu_id']}}">
                                                    <a href="<?php echo ($menu['menu_type'] =='external')? URL::to($menu['url']) : URL::to($menu['module']); ?>">{{$menu['menu_name']}}</a>
                                                    @if(count($menu['childs']) > 0)
                                                        <ul class="sub-menu">
                                                            @foreach ($menu['childs'] as $keyMenu2=>$menu2)
                                                             <li class="{{($keyMenu2==0)?'first':''}} {{(count($menu2['childs']) > 0)?'expanded':''}}  leaf menu-depth-2 menu-item-{{$menu['menu_id']}}">
                                                                    <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu2['menu_name']}}</a>
                                                                @if(count($menu2['childs']) > 0)
                                                                <ul class="sub-menu">
                                                                    @foreach($menu2['childs'] as $keyMenu3=>$menu3)
                                                                        <li class="{{($keyMenu3==0)?'first':''}} leaf menu-depth-3 menu-item-{{$menu['menu_id']}}">
                                                                            <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu3['menu_name']}}</a>
                                                                        </li>   
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </li>                           
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach          
        



                                             <?php 
                                                    //Start Popup 2 Menu                     
                                                    $popup2      = SiteHelpers::menus( 'popup_2' ,'all'); 
                                                ?> 
                                            @foreach ($popup2 as $key2Menu=>$menu)
                                                  <li class="smallEV {{($key2Menu==0)?'little-first':''}}  {{(count($menu['childs']) > 0)?'expanded':''}}  menu-depth-1 menu-item-{{$menu['menu_id']}}">
                                                    <a href="<?php echo ($menu['menu_type'] =='external')? URL::to($menu['url']) : URL::to($menu['module']); ?>">{{$menu['menu_name']}}</a>
                                                    @if(count($menu['childs']) > 0)
                                                        <ul class="menusk1 clearfix">
                                                            @foreach ($menu['childs'] as $key2Menu2=>$menu2)
                                                             <li class="smallEV {{($key2Menu2==0)?'little-first':''}} {{(count($menu2['childs']) > 0)?'expanded':''}}  leaf menu-depth-2 menu-item-{{$menu['menu_id']}}">
                                                                    <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu2['menu_name']}}</a>
                                                                @if(count($menu2['childs']) > 0)
                                                                <ul class="menusk1 clearfix">
                                                                    @foreach($menu2['childs'] as $key2Menu3=>$menu3)
                                                                        <li class="smallEV {{($key2Menu3==0)?'little-first':''}} menu-depth-3 menu-item-{{$menu['menu_id']}}">
                                                                            <a href="<?php echo ($menu3['menu_type'] =='external')? URL::to($menu3['url']) : URL::to($menu3['module']); ?>">{{$menu3['menu_name']}}</a>
                                                                        </li>   
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </li>                           
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                               </li>
                                            @endforeach
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
         </div>
                    <!-- code here-->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--my popup hamburg menu End Here-->