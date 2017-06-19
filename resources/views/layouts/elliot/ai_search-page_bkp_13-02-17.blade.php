<!--Search popup start-->
<div id="search-page" class="popup">
    <div class="popup-inner">
        <a href="#" class="popup-close-btn">&times;</a>
        <div class="popup-content">
            <form class="bh-search-form" autocomplete="off" method="get" id="searchform-navbar" action="{{URL::to('search')}}">
                <div class="">
                    <input class="bh-search-input typeahead" name="s" id="search-navbar" placeholder="Search …" type="text">
                </div>
                <h1>Enter Keywords</h1>
                <p>Press Enter / Return to being your search.</p>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--Search popup end-->