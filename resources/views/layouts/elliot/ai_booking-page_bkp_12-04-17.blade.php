<script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('sximo/assets/js/combodate.js')}}" type="text/javascript"></script>
<div class="book-now-page desktop-show-hide">
    <div class="book-now-page-content">
        <div class="headings">
            <h2>Design Location is your ideal, vogue vacation planner!</h2>
            <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Design Locations ensure the ultimate luxury experience</p>
        </div>
        <ul class="dates" id="two-inputs">
            <li>
                <div class="heading">Arrive</div>
                <input id="date-range-arrive" size="20" value="12-01-2017">
            </li>
            <li>
                <div class="heading">Departure</div>
                <input id="date-range-destination" size="20" value="">
            </li>
        </ul>
        <ul class="dates">
            <li>
                <div class="heading">Adults</div>
                <select>
                    <option>01</option>
                    <option selected="">02</option>
                    <option>03</option>
                </select>
            </li>
            <li>
                <div class="heading">Children</div>
                <select>
                    <option>00</option>
                    <option>01</option>
                    <option>02</option>
                </select>
            </li>
            <div class="clearfix"></div>
        </ul>
        <div class="clearfix"></div>
        <div class="submit-btn">
            <a data-popup-id="booking-form-pop-up" class="booking-form-pop-up-btn" href="#">BOOK NOW</a>
        </div>
        <div class="view-modify-cancel-booking">
            <a href="#">View, Modify or Cancel your Booking</a>
        </div>
        <ul class="booking-page-footer-section">
            <li>
                <a href="#" target="_blank">
                    <span>Join the worlds leading luxury club</span>
                    <h6 class="center">Enjoy exclusive members only benefits</h6>
                </a>
                <div class="white-border-bottom"></div>
            </li>
            <li>
                <a href="#" target="_blank">
                    <span>Spa Treatment</span>
                    <h6 class="center">Book</h6>
                </a>
                <div class="white-border-bottom"></div>
            </li>
            <li>
                <a href="#" target="_blank">
                    <span>View or Modify Reserveration</span>
                    <h6 class="center">Login to Support Center</h6>
                </a>
                <div class="white-border-bottom"></div>
            </li>
            <div class="clearfix"></div>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!--Mobile-->

<div class="book-now-page mobile-show-hide">
    <div class="book-now-page-content">
        <div class="headings">
            <h2>Mobile Design Location is your ideal, vogue vacation planner!</h2>
            <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Design Locations ensure the ultimate luxury experience</p>
        </div>
        <ul class="dates">
            <li>
                <div class="heading">Arrive</div>
                <input id="date-mobile" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="date" value="25-02-2017" type="text">

            </li>
            <li>
                <div class="heading">Departure</div>
                <input id="date-mobile-departure" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="date" value="30-03-2017" type="text">
            </li>
            <li>
                <div class="heading">Adults</div>
                <select>
                    <option>01</option>
                    <option selected="">02</option>
                    <option>03</option>
                </select>
            </li>
            <li>
                <div class="heading">Children</div>
                <select>
                    <option>00</option>
                    <option>01</option>
                    <option>02</option>
                </select>
            </li>
            <div class="clearfix"></div>
        </ul>
        <div class="clearfix"></div>
        <div class="submit-btn">
            <a href="#">BOOK NOW</a>
        </div>
        <div class="view-modify-cancel-booking">
            <a href="#">View, Modify or Cancel your Booking</a>
        </div>
        <ul class="booking-page-footer-section">
            <li>
                <a href="#" target="_blank">
                    <span>Join the worlds leading luxury club</span>
                    <h6 class="center">Enjoy exclusive members only benefits</h6>
                </a>
                <div class="white-border-bottom"></div>
            </li>
            <li>
                <a href="#" target="_blank">
                    <span>Spa Treatment</span>
                    <h6 class="center">Book</h6>
                </a>
                <div class="white-border-bottom"></div>
            </li>
            <li>
                <a href="#" target="_blank">
                    <span>View or Modify Reserveration</span>
                    <h6 class="center">Login to Support Center</h6>
                </a>
                <div class="white-border-bottom"></div>
            </li>
            <div class="clearfix"></div>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
@include('layouts/elliot/ai_booking-form2')
<script>
$('#two-inputs').dateRangePicker(
        {
            selectForward: (Boolean),
            stickyMonths: (Boolean),
            startDate: "12-01-2017",
            format: ' DD.MM.YYYY',
            separator: ' to ',
            getValue: function ()
            {
                if ($('#date-range-destination').val() && $('#date-range-arrive').val())
                    return $('#date-range-destination').val() + ' to ' + $('#date-range-arrive').val();
                else
                    return '';
            },
            setValue: function (s, s1, s2)
            {
                $('#date-range-arrive').val(s1);
                $('#date-range-destination').val(s2);
            }
        }
).bind('datepicker-first-date-selected', function (event, obj) {
    $("#date-range-destination").val('');
});
</script>
<script>
    $(function () {
        $('#date-mobile').combodate();
    });
        $('#date-mobile').combodate({
            minYear: 2016,
            maxYear: 2017,
        });
        $(function () {
            $('#date-mobile-departure').combodate();
        });
        $('#date-mobile-departure').combodate({
            minYear: 2016,
            maxYear: 2017,
        });
</script>