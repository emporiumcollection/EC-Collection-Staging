                </div>
            </div>
        </div>

        @include('layouts/elliot/ai_search-page')
        
        <!--HTML for book now page start here-->

        <div class="book-now-page">
            <div class="book-now-page-content">
                <div class="headings">
                    <h2>Book now & get our best rate!</h2>
                    <p>Exclusively for our hotel guests: Experience the 7132 Thermal Bath by night on Wednesday, Friday & Sunday</p>
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
                    <a href="#">BOOK NOW</a>
                </div>
                <div class="view-modify-cancel-booking">
                    <a href="#">View, Modify or Cancel your Booking</a>
                </div>
                <ul class="booking-page-footer-section">
                    <li>
                        <a href="#" target="_blank">
                            <span>7132 SILVER Restaurant</span>
                            <h6 class="center">Reserve table</h6>
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
                            <span>Art of Alpine Luxury as a gift</span>
                            <h6 class="center">Voucher</h6>
                        </a>
                        <div class="white-border-bottom"></div>
                    </li>
                    <div class="clearfix"></div>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--JS funcitons-->
        <!--Social share start-->

<!--        <div style="position:relative;">
            <div class="social-share">
                <a class="trigger-click-on-share" href="#">SHARE</a>
                <div class="open-social-share">
                    <a class="social-share-btn" href="#">FOLLOW</a>
                    <ul style="display: none;">
                        <li>
                            <a href="#">Twitter</a>
                        </li>
                        <li>
                            <a href="#">Instagram</a>
                        </li>
                        <li>
                            <a href="#">Facebook</a>
                        </li>
                        <li>
                            <a href="#">Pintrest</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>-->

        <!--Social share end-->
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" >Top</a>
        <script>
            $(document).ready(function () {
                $(".open-social-share").click(function (event) {
                    event.preventDefault();
                    $(this).find("ul").toggle();
                    $(this).toggleClass("open");
                });
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 50) {
                        $('#back-to-top').fadeIn();
                    } else {
                        $('#back-to-top').fadeOut();
                    }
                });
                $("#back-to-top").click(function (event) {
                    event.preventDefault();
                    $("html, body").animate({scrollTop: 0}, "slow");
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $("header .menu > a").click(function (event) {
                    event.preventDefault();
                    $(this).parent().find("ul").toggle("slow");
                });
                $(".trigger-click-on-book-now").click(function (event) {
                    event.preventDefault();
                    $(".open-book-now-page").trigger("click");
                });
            });
        </script>
       <script>
            $('#two-inputs').dateRangePicker(
                    {

                        selectForward: (Boolean),
                        stickyMonths: (Boolean),
                        startDate: "<?php echo date("d-m-Y") ?>",
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
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </body>
</html>