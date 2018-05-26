<!-- conatct us form -->
<div class="termAndConditionPopUp fullWidthPopup">
  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
  <div class="searchDateInnerContent text-center">
    <div class="container-fluid">
     <div class="row">
          <div class="col-xs-12 text-center">
              <div class="gallyPopupHeader">
                  <a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage" class="img-responsive logo"></a>
              </div>
          </div>
          <div class="col-xs-12">
              <p>{{--*/ $abouttext = CommonHelper::getAboutInfo(); /*--}}
                        {{$abouttext['about_text']->content}}</p>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
			<div id="formerrors"></div>
            <form method="POST" action="{{URL::to('save_query')}}" accept-charset="UTF-8" class="form-horizontal" id="conatctform" parsley-validate="" novalidate=" " enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Department *</label>
                    <div class="col-sm-9">
                          <select name="department" class="form-control" required="required">
                            <option value="Info">Info</option>
                            <option value="Sales">Sales</option>
                            <option value="Reservations/Cancelations">Reservations/Cancelations</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Legal">Legal</option>
                            <option value="Accounting">Accounting </option>
                            <option value="Management">Management  </option>
                          </select>
                    </div>
                </div>
            <div class="form-group row">
                <label for="first_name" class="col-sm-3 col-form-label">First Name *</label>
                <div class="col-sm-9">
                    <input type="text" name="first_name" required="required" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-3 col-form-label">Lastname *</label>
                <div class="col-sm-9">
                    <input type="text" name="last_name" required="required" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="company" class="col-sm-3 col-form-label">Company</label>
                <div class="col-sm-9">
                    <input type="text" name="company" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-3 col-form-label">Street</label>
                <div class="col-sm-9">
                    <input type="text" name="address" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="postal_code" class="col-sm-3 col-form-label">Postal Code *</label>
                <div class="col-sm-9">
                    <input type="text" name="postal_code" required="required" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-3 col-form-label">City *</label>
                <div class="col-sm-9">
                    <input type="text" name="city" required="required" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-sm-3 col-form-label">Country</label>
                <div class="col-sm-9">
                    <input type="text" name="country" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-9">
                    <input type="text" name="phone" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="fax" class="col-sm-3 col-form-label">Fax</label>
                <div class="col-sm-9">
                    <input type="text" name="fax" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">E-Mail *</label>
                <div class="col-sm-9">
                    <input type="email" name="email" required="required" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="message" class="col-sm-3 col-form-label">Message</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="message" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="send" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <input type="submit" class="btn btn-cstmBtn" onclick="submit_contact_request();" value="Send">
                </div>
            </div>
            </form>
			
          </div>

          <div class="col-sm-6">
              <div class="tremPopupContactInfo">
                  <p>emporium-voyage</p>
                  <p>Central reservations :</p>
                  <p>+1 934 451 1317</p>
                  <br/>
                  <p>Email :</p>
                  <a href="mailto:sales@emporium-voyage.com">sales@emporium-voyage.com</a>
                  <a href="mailto:marketing@emporium-voyage.com">marketing@emporium-voyage.com</a>
                  <a href="mailto:reservations@emporium-voyage.com">reservations@emporium-voyage.com</a>
                  <a href="mailto:legal@emporium-voyage.com">legal@emporium-voyage.com</a>
                  <a href="mailto:accounting@emporium-voyage.com">accounting@emporium-voyage.com</a>
                  <a href="mailto:management@emporium-voyage.com">management@emporium-voyage.com</a>
                  <a href="mailto:info@emporium-voyage.com">info@emporium-voyage.com</a>
                  <ul class="list-inline vegasSocialUl" style="margin-left:0px;">
                    <li><a href="https://www.facebook.com/emporiumvoyage/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="https://fr.linkedin.com/company/emporiumvoyage"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.pinterest.cl/emporiumvoyage/?redirected=1"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.instagram.com/emporiumvoyage/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  </ul>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>