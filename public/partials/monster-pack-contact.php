<?php
    $curr_site_url = site_url();
    $source = str_replace($curr_site_url,'',get_the_permalink());
    if($source == "/")  $source = "homepage";
    
    $varTest = get_query_var( 'iuyamlkj', 0 );
    if($varTest != '') $source = $varTest;
?>
<!--Section: Contact v.2-->
<section class="section cf-section"> 
    <div class="row row-small row-full-width align-middle align-center">
        <div class="col small-12 medium-8 large-8 cf-section1">
            <div class="col-inner" style="padding: 0px;">
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact_form" name="contact_form"  method="POST" novalidate>

                        <div class="row">
                            <div class="small-12">
                                <h2 class="cf-title">Send us a Message</h2>
                            </div>
                        </div>

                        <div class="row error">
                            <div class="small-12">
                                <span></span> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="small-6">
                                <div class="form-group md-radio">
                                    <input id="Product-Quote" type="radio" name="cf_customerservice" value="Product Quote" checked>
                                    <label for="Product-Quote">Product Quote</label>
                                </div>
                            </div>

                            <div class="small-6">
                                <div class="form-group md-radio">
                                    <input id="Complaints" type="radio" name="cf_customerservice" value="Complaints">
                                    <label for="Complaints">Complaints</label>
                                </div>
                            </div>

                            <div class="small-12">
                                <div class="form-group md-radio">
                                    <input id="Partner" type="radio" name="cf_customerservice" value="Interested Partner">
                                    <label for="Partner">Interested in becoming a Solar Partner</label>
                                </div>
                            </div> 
                            <div class="small-12">
                                &nbsp;
                            </div> 
                        </div>

                        <div class="row">
                            <div class="small-6">
                                <div class="form-group cf-group">
                                    <input type="text" id="cf_firstname" name="cf_firstname" class="form-control cf-control is-valid" required="">
                                    <label class="form-control-placeholder cf-control-placeholder" for="cf_firstname">First Name</label>
                                </div>
                            </div>

                            <div class="small-6">
                                <div class="form-group cf-group">
                                    <input type="text" id="cf_lastname" name="cf_lastname" class="form-control cf-control is-valid" required="">
                                    <label class="form-control-placeholder cf-control-placeholder" for="cf_lastname">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="small-12 switch1" >
                                <div class="form-group cf-group">
                                    <input type="text" id="cf_phone" name="cf_phone" class="form-control cf-control is-valid" required="">
                                    <label class="form-control-placeholder cf-control-placeholder" for="cf_phone">Phone Number</label>
                                </div>
                            </div>
                            <div class="small-6 switch2 d-none">
                                <div class="form-group cf-group">
                                    <input type="text" id="cf_company" name="cf_company" class="form-control cf-control is-valid" required="">
                                    <label class="form-control-placeholder cf-control-placeholder" for="cf_company">Company</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="small-12">
                                <div class="form-group cf-group">
                                    <input type="text" id="cf_email" name="cf_email" class="form-control cf-control is-valid" required="">
                                    <label class="form-control-placeholder cf-control-placeholder" for="cf_email">Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="small-12">
                                <div class="form-group cf-group">                                   
                                    <input id="cf_address" name="cf_address" type="text" class="form-control cf-control is-valid" required="" />
                                    <label class="form-control-placeholder cf-control-placeholder" for="cf_address">Address</label>

                                    <input type="hidden" name="cf_street_name" id="cf_street_name" />
                                    <input type="hidden" name="cf_suburb" id="cf_suburb" />
                                    <input type="hidden" name="cf_state" id="cf_state" />
                                    <input type="hidden" name="cf_country" id="cf_country" />
                                    <input type="hidden" name="cf_postcode" id="cf_postcode" /> 
                                    <input type="hidden" name="source" id="cf_source" value="contact-us" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="small-12">
                                <div class="form-group cf-group">
                                    <textarea type="text" id="cf_message" name="cf_message" class="form-control cf-control is-valid" required=""></textarea>
                                    <label class="form-control-placeholder cf-control-placeholder" for="cf_message">Message</label>
                                </div>
                            </div>
                            <!--
                            <div class="small-3">
                                <div class="form-group text-right align-middle align-center">
                                    <button id="cf_button" type="submit" class="btn cnfm_btn">
                                        SEND
                                    </button>
                                </div>
                            </div>
                            -->
                        </div>
                         
                        <div class="row">
                            <div class="small-12 text-right">
                                <button id="cf_button" type="submit" class="btn cnfm_btn">
                                    SEND
                                </button>
                            </div>
                        </div>
                         
                    </form>  

                    <div id="cf_response" name="cf_response" class="d-none" >
                        <div class="row">
                            <div class="col medium-12 small-12 large-12 normal text-center my-3">
                                <br>
                                <h3 class="fw-700 font-30 mb-0 mt-20">Thank you!</h3>
                                <br class="mt-10 mb-0" />
                                <p class="font-15 mt-20 mb-10 sel_msg">We will get in touch</p>
                                <br class="mt-0 mb-10" />
                                <div class="text-center mb-20">
                                    <img src="<?php echo plugin_dir_url(__DIR__) ?>images/cory-big.png" alt="cory" title="Cory" />
                                    <p>Solar Monster Team</p>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

           

        <div class="col small-12 medium-4 large-4 cf-section2">
            <div class="col-inner" style="padding: 0px;">
                <div class="col small-12 show-for-small mobile-spacer"> 
                    <br>
                    <hr> 
                </div> 
                <div class="small-12 medium-3 text-center">
                    <ul class="list-unstyled">
                        <li>
                            <strong>Contact Information</strong>
                        </li>
                        <li>
                            <a href="tel:1300 232 848" class="pad-0">
                                <i class="icon-phone icon-flip-x"></i>  
                                <span class="pad-1">1300 232 848</span>
                            </a>
                        </li>
                        <li>
                            <p class="pad-0">
                                <i class="icon-map-pin-fill"></i>                                 
                                <span class="pad-1">Top level</span>
                            </p>
                            <p class="pad-2">99 Creek Street</p>
                            <p class="pad-2">Brisbane</p>
                            <p class="pad-2">Queensland 4000</p>
                            <p class="pad-2">Australia</p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div> 
</section>
<div id="map-canvas" name="map-canvas"></div>
<script>loadGMAP('cf_address');</script>
<!--Section: Contact v.2-->