<script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('sximo/assets/js/combodate.js')}}" type="text/javascript"></script>
<div class="book-now-page desktop-show-hide">
    <div class="book-now-page-content">
        <div class="headings">
            <h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>
            <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
        </div>
        <form action="{{url()}}/search/" method="get">
            <input type="hidden" name="s" value="" />
            <ul class="dates" id="two-inputs">
                <li>
                    <div class="heading">Arrive</div>
                    <input id="date-range-arrive" name="arrive" size="20" value="{{ ($arrive_date!='') ? $arrive_date : date('d.m.Y') }}">
                </li>
                <li>
                    <div class="heading">Departure</div>
                    <input id="date-range-departure" size="20" name="destination" value="{{ ($destination_date!='') ? $destination_date : '' }}">
                </li>
            </ul>
            <ul class="dates">
                <li>
                    <div class="heading">Adults</div>
                    <select name="adult">
                        <option {{ ($adults!='' && $adults==1) ? 'selected' : '' }}>1</option>
                        <option {{ ($adults!='' && $adults==2) ? 'selected' : '' }}>2</option>
                        <option {{ ($adults!='' && $adults==3) ? 'selected' : '' }}>3</option>
                        <option {{ ($adults!='' && $adults==4) ? 'selected' : '' }}>4</option>
                        <option {{ ($adults!='' && $adults==5) ? 'selected' : '' }}>5</option>
                        <option {{ ($adults!='' && $adults==6) ? 'selected' : '' }}>6</option>
                        <option {{ ($adults!='' && $adults==7) ? 'selected' : '' }}>7</option>
                        <option {{ ($adults!='' && $adults==8) ? 'selected' : '' }}>8</option>
                        <option {{ ($adults!='' && $adults==9) ? 'selected' : '' }}>9</option>
                        <option {{ ($adults!='' && $adults==10) ? 'selected' : '' }}>10</option>
                    </select>
                </li>
                <li>
                    <div class="heading">Children</div>
                    <select name="childs">
                        <option {{ ($childs!='' && $childs==0) ? 'selected' : '' }}>0</option>
                        <option {{ ($childs!='' && $childs==1) ? 'selected' : '' }}>1</option>
                        <option {{ ($childs!='' && $childs==2) ? 'selected' : '' }}>2</option>
                        <option {{ ($childs!='' && $childs==3) ? 'selected' : '' }}>3</option>
                        <option {{ ($childs!='' && $childs==4) ? 'selected' : '' }}>4</option>
                        <option {{ ($childs!='' && $childs==5) ? 'selected' : '' }}>5</option>
                        <option {{ ($childs!='' && $childs==6) ? 'selected' : '' }}>6</option>
                        <option {{ ($childs!='' && $childs==7) ? 'selected' : '' }}>7</option>
                        <option {{ ($childs!='' && $childs==8) ? 'selected' : '' }}>8</option>
                        <option {{ ($childs!='' && $childs==9) ? 'selected' : '' }}>9</option>
                        <option {{ ($childs!='' && $childs==10) ? 'selected' : '' }}>10</option>
                    </select>
                </li>
                <div class="clearfix"></div>
            </ul>
            <div class="clearfix"></div>
            <div class="submit-btn editorial-submit-btn">
                <button class="booking-form-pop-up-btn-" data-popup-id="booking-form-pop-up" type="submit">BOOK NOW</button>
            </div>
        </form>
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
            <h2>Mobile Emporium Voyage is your ideal, vogue vacation planner!</h2>
            <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, EMPORIUM VOYAGE ensure the ultimate luxury experience</p>
        </div>
        <ul class="dates">
            <li>
                <div class="heading">Arrive</div>
                <input id="date-mobile" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="booking_arrive" value="{{ ($arrive_date!='') ? $arrive_date : date('d.m.Y') }}" type="text">

            </li>
            <li>
                <div class="heading">Departure</div>
                <input id="date-mobile-departure" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="booking_destination" value="{{ ($destination_date!='') ? $destination_date : '' }}" type="text">
            </li>
            <li>
                <div class="heading">Adults</div>
                <select name="booking_adults">
                    <option {{ ($adults!='' && $adults==1) ? 'selected' : '' }}>1</option>
                    <option {{ ($adults!='' && $adults==2) ? 'selected' : '' }}>2</option>
                    <option {{ ($adults!='' && $adults==3) ? 'selected' : '' }}>3</option>
                </select>
            </li>
            <li>
                <div class="heading">Children</div>
                <select name="booking_children">
                    <option {{ ($childs!='' && $childs==0) ? 'selected' : '' }}>0</option>
                    <option {{ ($childs!='' && $childs==1) ? 'selected' : '' }}>1</option>
                    <option {{ ($childs!='' && $childs==2) ? 'selected' : '' }}>2</option>
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
    $(document).ready(function () {
        $('#two-inputs').dateRangePicker({
            selectForward: (Boolean),
            stickyMonths: (Boolean),
            startDate: "<?php echo date("d-m-Y") ?>",
            format: 'DD.MM.YYYY',
            autoClose: true,
            separator: ' to ',
            getValue: function () {
                if ($('#date-range-departure').val() && $('#date-range-arrive').val())
                    return $('#date-range-departure').val() + ' to ' + $('#date-range-arrive').val();
                else
                    return '';
            },
            setValue: function (s, s1, s2) {
                $('#date-range-arrive').val(s1);
                $('#date-range-departure').val(s2);
            }
        }).bind('datepicker-first-date-selected', function (event, obj) {
            $("#date-range-departure").val('');
        });
        $('#date-mobile').combodate({
            minYear: 2016,
            maxYear: <?php echo date("Y") ?>,
        });
        $(function () {
            $('#date-mobile-departure').combodate();
        });
        $('#date-mobile-departure').combodate({
            minYear: 2016,
            maxYear: <?php echo date("Y") ?>,
        });
        $('#date-mobile').combodate();
    });
</script>