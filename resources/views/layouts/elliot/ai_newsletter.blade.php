<!DOCTYPE html>
<!--Pop Start Here-->
<div id="newsletter-pop-up" class="modal fade">
    <div class="modal-dialog dl_newsletter-pop">
        <div class="modal-content dl_newsletter-pop-content">
            <div class="modal-header dl_newsletter-pop-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a href="{{url('')}}"> <img alt="" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" class="img-responsive dl_logo-on-newsletter"></a>
            </div>
            <div class="modal-body">
                <div class="dl_newsletter-pop-body-content">
                    <div class="dl_newsletter-pop-body-des">
                        <p>Already a member? <span><a href="javascript:void(0)">Log in</a></span> 
                            to access <br>
                            special rates, exclusive offers, and more!<br>
                            Not a member?<br>
                            Join now for immediate access:
                        </p>
                    </div>
                    <div class="dl_newsletter-pop-up-form">
                        <form>
                            <div class="">
                                <input type="checkbox">
                                <label class="agree-check-box-label">I agree with the <span><a href="#">Terms and Conditions</a></span></label>
                            </div>
                            <div class="form-group dl_newsletter-subscription-input">
                                <input type="email" placeholder="Email Address">
                                <button type="submit" class="btn btn-primary">Join For Free</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer dl_newsletter-subscription-footer">
                <p>You may opt out of email communications about services from EMPORIUM VOYAGE at any time. </p>
            </div>
        </div>
    </div>
</div>
<!--Pop End Here-->
<script type="text/javascript">
    $(document).ready(function () {
        $(window).scroll(function () {
            var screenwidth = $("body").height() * (40 / 100);
            if( $(window).scrollTop() > screenwidth){
                checkCookie();
            }
        });
    });
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function checkCookie() {
        var username = getCookie("news-letter-pop-up");
        if (username == "") {
            setCookie('news-letter-pop-up', '1', 1);
            $("#newsletter-pop-up").modal('show');
        }
    }
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
</script>