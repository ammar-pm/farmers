@extends('layouts.site')
@section('content')

<div class="page-cover contact-cover">
  
  <div class="container">
    
    <div class="cover-content">
      
        <h1> {{ __('common.request_suggest') }} </h1>
        <div class="breadcrumbs">
            <a href="/"> {{ __('common.home') }} </a> / <span> {{ __('common.request_suggest') }} </span>
        </div>
          
    </div>

  </div>

</div>

    <div class="container">
        <div class="page page-box nopadding">

          <!-- <div class="video-wrapper">
            <div class="video">
              
            </div>
          </div> -->

          <div class="page-box white-box">

            <div>
              <h5> {{ __('common.data_request_form') }} </h5>
              <p> {{ __('common.data_request_form_text') }} </p>
            </div>

            <form action="/contact_us" method="POST" class="request-form">

              {{ csrf_field() }}

              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">{{ __('common.name') }} *</label>
                    <input id="name" type="text" name="name" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="org_name">{{ __('common.org_name') }}</label>
                    <input name="org_name" type="text" class="form-control" id="org_name">
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>{{ __('common.data_use') }} *</label><br>
                    <input type="radio" id="personal-use" name="data_use" value="personal" checked><label for="personal-use">{{ __('common.personal_use') }} </label>
                    <input type="radio" id="org-use" name="data_use" value="organisation"><label for="org-use">{{ __('common.organization_use') }} </label>
                  </div>
                </div>
                <div class="col-md-12 orgz-type" style="display: none">
                  <div class="form-group mt-3">
                    <label>{{ __('common.type_of_org') }} *</label><br>
                    <input type="radio" id="gov-org" name="type_of_org" value="governmental" checked> <label for="gov-org">{{ __('common.governmental') }} </label>
                    <input type="radio" id="civil-org" name="type_of_org" value="non-governmental"><label for="civil-org"> {{ __('common.non_governmental') }} </label>
                    <input type="radio" id="private-org" name="type_of_org" value="private_sector"> <label for="private-org">{{ __('common.private_sector') }} </label>
                    <input type="radio" id="int-org" name="type_of_org" value="international"> <label for="int-org">{{ __('common.international') }}</label>
                    <input type="radio" id="st-org" name="type_of_org" value="studies_research"> <label for="st-org">{{ __('common.studies_research') }}</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                  <label>{{ __('common.data_use_field') }} *</label><br>
                  <input id="sc-use" type="radio" name="field_of_use_data" value="scientific_research_purposes" checked><label for="sc-use"> {{ __('common.scientific_research') }}</label>
                  <input id="com-use" type="radio" name="field_of_use_data" value="commerical_use"> <label for="com-use">{{ __('common.commercial_use') }}</label>
              </div>

              <div class="form-group">
                  <label>{{ __('common.response_receive') }} *</label><br>
                  <input id="via-fax" type="radio" name="response_type" value="via_fax" checked> <label for="via-fax">{{ __('common.via_fax') }}</label>
                  <input id="via-post" type="radio" name="response_type" value="via_postal_address"> <label for="via-post">{{ __('common.via_post') }}</label>
                  <input id="via-email" type="radio" name="response_type" value="via_email"> <label for="via-email">{{ __('common.via_email') }}</label>
              </div>

              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address">{{ __('common.address') }} <i></i></label>
                    <input name="address" type="text" class="form-control" id="address">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tel">{{ __('common.tel') }}</label>
                    <input name="tel" type="text" class="form-control" id="tel">
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fax">{{ __('common.fax') }} <i>*</i></label>
                    <input required="required" name="fax" type="text" class="form-control" id="fax">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">{{ __('common.email') }} * <i></i></label>
                    <input name="email" type="email" class="form-control" id="email" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                  <label>{{ __('common.request_detail') }} *</label>
                  <textarea name="comments" class="form-control" required></textarea>
              </div>

              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="signature">{{ __('common.signature') }} *</label><br/>
                    <input name="signature" type="text" class="form-control" required="required" id="signature">
                  </div>
                </div>

                <?php 
                  $currentDate = date("Y-m-d"); 
                  $currentTime = date("H:i");
                ?>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="signature_date">{{ __('common.signature_date') }}</label><br/>
                    <input type="date" id="signature_date" name="signature_date"
                           value="<?php echo $currentDate; ?>"
                           min="2019-01-01">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="signature_time">{{ __('common.signature_time') }}</label><br/>
                    <input type="time" id="signature_time" name="signature_time"
                        value="<?php echo $currentTime; ?>">
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col"></div>
                <div class="col"><button type="submit" class="btn btn-primary btn-block">{{ __('common.send') }}</button></div>
                <div class="col"></div>
              </div>

            </form>
          </div>
                
        </div><!--page-->
    </div><!--container-->

@endsection


