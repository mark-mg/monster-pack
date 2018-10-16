<?php
    $curr_site_url = site_url();
    $source = str_replace($curr_site_url,'',get_the_permalink());
    if($source == "/")  $source = "homepage";
    
    $varTest = get_query_var( 'iuyamlkj', 0 );
    if($varTest != '') $source = $varTest;
?>
<section id="call-to-action">
    <div class="row row-large cta-section-button">
        <div class="col hide-for-small medium-2 small-6 large-2">
            <div class="col-inner"></div>
        </div>
        <div class="col medium-4 small-6 large-4">
            <div class="col-inner text-center">
                <button id="cta1-btn" type="button" class="button secondary expand cta1 cta-btn" style="color:black;background-color:white;">
                    <span>SOLAR QUOTES</span>
                </button>
            </div>
        </div>
        <div class="col medium-4 small-6 large-4">
            <div class="col-inner text-center">
                <button id="cta2-btn" type="button" class="button primary expand cta2 cta-btn" style="color:black;background-color:white;">
                    <span>REQUEST A CALL</span>
                </button>
            </div>
        </div>
        <div class="col hide-for-small medium-2 small-6 large-2">
            <div class="col-inner"></div>
        </div>

    </div>

    <!-- USER DETAILS -->
    <div id="CTA1" class="row row-large d-none" style="display:none;">
        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>

        <div class="col medium-6 small-12 large-6">
            <form id="cta_form" name="cta_form" method="POST" class="col-inner text-center">
                <div class="row">
                    <div class="col medium-12 small-12 large-12">
                        <input id="cta_firstname" name="cta_firstname" type="text" class="form-control" placeholder="First name" required="" />
                    </div> 
                </div>
                <!--
                <div class="row">
                    <div class="col medium-6 small-6 large-6">
                        <input id="cta_firstname" name="cta_firstname" type="text" class="form-control" placeholder="First name" required="" />
                    </div>
                    <div class="col medium-6 small-6 large-6">
                        <input id="cta_lastname" name="cta_lastname" type="text" class="form-control" placeholder="Last name" required="" />
                    </div>
                </div>
                -->
                <div class="row">
                    <div class="col medium-6 small-6 large-6">
                        <input type="text" id="cta_contact" name="cta_contact" class="form-control" placeholder="Contact Number" required="" />
                    </div>
                    <div class="col medium-6 small-6 large-6">
                        <input type="text" id="cta_postcode" name="cta_postcode" required="" pattern="[0-9]{4}"
                        class="form-control" placeholder="Post Code"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col small-12 large-12">
                        <input type="text" id="cta_email" name="cta_email" class="form-control" placeholder="Email Address" required="" />
                    </div>
                </div> 
                <div class="row bill-estimate">
                    <div class="col medium-12 small-12 large-12">
                        <select id="cta_quarter_bill" name="cta_quarter_bill" class="form-control" 
                        style="border-radius: 10px;" placeholder="How Much is Your Quaterly Electricity Bill?" required="">
                            <option value="">How Much is Your Quaterly Electricity Bill?</option>
                            <option value="< $200">&lt; $200</option>
                            <option value="$200 - $349">$200 - $349</option>
                            <option value="$350 - $599">$350 - $599</option>
                            <option value="$600 - $799">$600 - $799</option>
                            <option value="$800 - $999">$800 - $999</option>
                            <option value="> $1000">&gt; $1000</option>
                        </select>
                    </div> 
                </div>
                <div class="col medium-12 small-12 large-12 d-none" id="cta_form_error" name="cta_form_error">
                        <span class="error">
                            Please provide the required information.
                        </span> 
                    </div> 
                <div class="row">
                    <div class="col small-12 large-12 pb-0">
                        <input type="hidden" name="source" id="cta_source" value="<?php echo $source; ?>" />
                        <input type="hidden" name="book_appt_id" id="book_appt_id" value="" /> 
                        <small class="d-inline-block pb-2" style="padding-bottom: 10px;color:white;">
                            By clicking submit you are agreeing to the
                            <a href="/terms-and-conditions">terms</a>
                        </small>
                        <button id="cta_button" type="submit" class="btn btn-warning btn-block cnfm_btn">
                            Get My Custom Quote
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col small-12 large-12"> 
                        <small class="d-inline-block" style="color:white;">
                            <i>* We do not compare all solar providers</i>
                        </small>
                    </div>
                </div>
            </form>
        </div>

        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>

    </div>

    <!-- BOOKING FORM -->
    <div id="CTA2" class="row row-large d-none" style="display:none;">
        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>

        <div class="col medium-6 small-12 large-6">
            <form id="booking_form" name="booking_form" method="POST" class="col-inner text-center">
                <div class="row">
                    <div class="col medium-6 small-6 large-6">
                        <div class="col-inner text-center">
                            <input type="text" class="form-control datepicker-here" id="booking_date" name="booking_date" placeholder="Preferred Date"
                                required="" data-language='en' />
                        </div>
                    </div>
                    <div class="col medium-6 small-6 large-6">
                        <div class="col-inner text-center">
                            <select class="form-control" id="booking_time" name="booking_time" placeholder="Preferred Time" required="">
                                <option value="">Preferred Time</option>
                                <option value="morning">Mornings - 8am to 12pm</option>
                                <option value="afternoon">Afternoon - 12pm to 5pm</option>
                                <option value="evening">Evenings - 5pm to 8.30pm</option>
                            </select>
                        </div>
                    </div>
                    <div class="col medium-12 small-12 large-12 d-none" id="booking_form_error" name="booking_form_error">
                        <span class="error">
                            Please provide the required information.
                        </span> 
                    </div> 
                    <div class="col medium-12 small-12 large-12 pb-0">
                        <input type="hidden" id="booking_time_range" name="booking_time_range" />
                        <small class="d-inline-block pb-2" style="padding-bottom: 10px;color:white;">
                            By clicking submit you are agreeing to the
                            <a href="/terms-and-conditions">terms</a>
                        </small>
                        <button id="appt_button" type="submit" class="btn btn-warning btn-block cnfm_btn">
                            Book Appointment
                        </button>
                    </div> 
                </div>
            </form>


        </div>

        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>
    </div> 

    <!-- BOOKING FORM CONFIRMATION -->
    <div id="CTA3" class="row row-large d-none">
        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>

        <div class="col medium-6 small-12 large-6">
            <div class="max-width-form normal text-center my-3">
                <div class="clearfix"></div>
                <h3 class="fw-700 font-30 mb-0 mt-20">Thank you!</h3>
                <p class="font-15 mt-10 mb-10 sel_msg">We will call you on appointment window</p>
                <br/>
                <p class="fw-700 font-17 color-light-blue mt-0 mb-10 sel_date">12 May 2018, Friday</p>
                <p class="fw-700 font-17 color-light-blue mt-0 mb-0 sel_session">Afternoon - 12pm to 5pm</p>
                <br/>
                <div class="clearfix"></div>
                <div class="text-center mb-20">
                    <img src="<?php echo plugin_dir_url(__DIR__) ?>images/cory-big.png" alt="cory" title="Cory" />
                    <p>Solar Monster Team</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>
    </div> 

    <!-- CTA FORM CONFIRMATION -->
    <div id="CTA4" class="row row-large d-none">
        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>

        <div class="col medium-6 small-12 large-6">
            <div class="max-width-form normal text-center my-3">
                <div class="clearfix"></div>
                <h3 class="fw-700 font-30 mb-10 mt-20">Thank you!</h3>
                <br/>
                <p class="font-15 mt-10 mb-10 sel_msg">We will get in touch</p>
                <br/>
                <div class="clearfix"></div>
                <div class="text-center mb-20">
                    <img src="<?php echo plugin_dir_url(__DIR__) ?>images/cory-big.png" alt="cory" title="Cory" />
                    <p>Solar Monster Team</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>
    </div>

    <!-- CTA 2ND STEP -->
    <div id="CTA5" class="row row-large d-none" style="display:none;">  
        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>

        <div class="col medium-6 small-12 large-6">
            <form id="cta_step2" name="cta_step2" method="POST" class="col-inner text-center">
                <div class="row">
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner text-center">
                            <strong>Discover the solar difference</strong>
                            <p>One last thing, we need to know your retailer so we can give you an accurate quote</p>
                        </div>
                    </div>
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner text-center">
                            <input id="cta_step_address" name="cta_step_address" type="text" class="form-control" placeholder="Full Address" required="" />
                            <input type="hidden" name="cta_step_street_name" id="cta_step_street_name" />
                            <input type="hidden" name="cta_step_suburb" id="cta_step_suburb" />
                            <input type="hidden" name="cta_step_state" id="cta_step_state" />
                            <input type="hidden" name="cta_step_country" id="cta_step_country" />
                            <input type="hidden" name="cta_step_postcode" id="cta_step_postcode" />
                        </div>
                    </div>
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner text-center">
                            <select id="cta_step_retailer" name="cta_step_retailer" class="form-control"  placeholder="My Retailer" required="">
                                <option value="">My Retailer</option>
                                <option value="Energy Australia">Energy Australia</option>
                                <option value="Origin Energy">Origin Energy</option>
                                <option value="AGL Energy">AGL Energy</option>
                                <option value="Simply Energy">Simply Energy</option>
                                <option value="Alinta Energy">Alinta Energy</option>
                                <option value="Red Energy">Red Energy</option>
                                <option value="Lumo Energy">Lumo Energy</option>
                                <option value="">--------------------------</option>
                                <option value="Click Energy">Click Energy</option>
                                <option value="Power Direct">Power Direct</option>
                                <option value="Ergon Energy">Ergon Energy</option>
                                <option value="Sumo Power">Sumo Power</option>
                                <option value="Powershop">Powershop</option>
                                <option value="Dodo Power & Gas">Dodo Power & Gas</option>
                                <option value="Momentum Energy">Momentum Energy</option>
                                <option value="ActewAGL">ActewAGL</option>
                                <option value="Other">Other</option>
                                <option value="Not Sure">Not Sure</option>
                            </select>
                        </div>
                    </div>

                    <div class="col medium-12 small-12 large-12 d-none" id="cta_step_error" name="cta_step_error">
                        <span class="error">
                            Please provide the required information.
                        </span> 
                    </div>

                    <div class="col medium-12 small-12 large-12 pb-0">  
                        <input type="hidden" value="" id="cta_step_shifting_date" name="cta_step_shifting_date" value=""/>
                        <input type="hidden" name="cta_step_user_id" id="cta_step_user_id" value="" />
                        <input type="hidden" name="cta_step_lead_id" id="cta_step_lead_id" value="" />                  
                        <button id="cta_step_button" type="submit" class="btn btn-warning btn-block cnfm_btn">
                            GET MY QUOTE
                        </button>
                    </div>

                    <div class="col medium-12 small-12 large-12">
                        <small class="d-inline-block" style="color:white;">By clicking submit you are agreeing to the
                            <a href="/terms-and-conditions">terms</a>
                        </small>
                    </div>
                </div>
            </form>  
        </div>

        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>
    </div>
</section>
<div id="map-canvas" name="map-canvas"></div>
