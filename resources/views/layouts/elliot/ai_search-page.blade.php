<script src="{{ asset('sximo/js/typeahead.bundle.js')}}"></script>
<link href="{{ asset('sximo/assets/css/custom_ps.css')}}" rel="stylesheet" type="text/css"/>
<!--Search popup start-->
<div id="search-page" class="popup">
    <div class="popup-inner">
        <a href="#" class="popup-close-btn">&times;</a>
        <div class="popup-content">
            <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                <div class="">
                    <input  class="bh-search-input typeahead search-navbar" name="s" id="search-navbar" placeholder="Search …" type="text">
                </div>
                <h1>Search For Hotel or Destination</h1>
                <p>Press Enter / Return to being your search.</p>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--Search popup end-->
<script>
var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};

var states = [{!! TagsFinder::tags() !!}];

$('.searchform-navbar .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});

var substringDestination = function(strs) {
  return function findDestination(q, cb) {
    var dests, substringRegex;
    dests = [];
	substrRegex = new RegExp(q, 'i');

    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        dests.push(str);
      }
    });

    cb(dests);
  };
};

var dests = [{!! TagsFinder::finddestinations() !!}];

$('.destinationsearchform-navbar .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'destinations',
  source: substringDestination(dests)
});

$('.search-navbar').on('typeahead:selected', function (e, datum) {
	var propname = $(this);
//        propname.parents('.searchform-navbar').submit();
//        return;
var sname = propname.val();
	$.ajax({    
	  url: "{{ URL::to('find_property_by_name')}}",
	  type: "post",
	  data: 'pname='+propname.val(),
	  dataType: "json",
	  success: function(data){
		if(data.status=='error') {
					window.location.href = "{{URL::to('luxury_hotels')}}/" + sname.replace(' ', '_');
                    //propname.parents('.searchform-navbar').submit();
                    return;
					window.location.href = "{{URL::to('luxury_hotels')}}/" + sname.replace(' ', '_');
                    //propname.parents('.searchform-navbar').submit();
		}
		else {
                    var obj = JSON.parse(data.property);
                    window.location.href = "{{URL::to('')}}/" + obj.property_slug;
		}
	  }
	});
});
</script>
