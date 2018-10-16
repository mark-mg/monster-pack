<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/mark-mg
 * @since      1.0.0
 *
 * @package    Monster_forms
 * @subpackage Monster_forms/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<section>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
                <button id="cta1-btn" type="button" class="btn btn-primary btn-lg btn-block">ORDER NOW</button>
            </div>
            <div class="col-md-3">
                <button id="cta2-btn" type="button" class="btn btn-secondary btn-lg btn-block">REQUEST A CALL</button>
            </div>
            <div class="col-md-3"> 
            </div>
        </div>
        <div id="CTA0" class="row d-none">
            <div class="col-md-3"></div>
            <div class="col-md-6 my-3 py-2" style="border-top: 3px solid gray;border-bottom: 3px solid gray;"> 
                <div class="max-width-form normal text-center my-3">
                    <div class="clearfix"></div>
                    <h3 class="fw-700 font-30 mb-0 mt-20">Thank you!</h3>
                    <p class="font-15 mt-10 mb-10 sel_msg">We will call you on appointment window</p>
                    <hr class="mt-0 mb-10 black-border"/>
                    <p class="fw-700 font-17 color-light-blue mt-0 mb-10 sel_date">12 May 2018, Friday</p>
                    <p class="fw-700 font-17 color-light-blue mt-0 mb-0 sel_session">Afternoon - 12pm to 5pm</p>
                    <hr class="mt-10 black-border"/>
                    <div class="clearfix"></div>
                    <div class="text-center mb-20">
                        <img src="<?php echo $template_url; ?>/assets/images/cory-big.png" alt="cory" title="Cory"/>
                        <p>Solar Monster Team</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div id="CTA1" class="row d-none">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 my-3 py-2" style="border-top: 3px solid gray;border-bottom: 3px solid gray;">
                <form id="cta_form" method="POST" style="width:400px;text-align:center;margin:auto;padding-top:20px;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" id="cta_firstname" placeholder="First name" required="" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" id="cta_lastname" placeholder="Last name" required="" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <input type="text" class="form-control" id="cta_email" placeholder="Email Address" required="" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" id="cta_contact" placeholder="Contact Number" required="" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" id="cta_postcode" placeholder="Post Code" required="" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <input type="hidden" name="book_appt_id" id="book_appt_id" value="" />
                            <button id="cta_button" type="submit" class="btn btn-warning btn-block">Get My Custom Quote</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <small class="d-inline-block">By clicking submit you are agreeing to the
                                <a href="/terms-and-conditions">terms</a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <div id="CTA2" class="row d-none">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 my-3 py-2" style="border-top: 3px solid gray;border-bottom: 3px solid gray;">
                <form id="booking_form" method="POST" style="width:400px;text-align:center;margin:auto;padding-top:20px;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="date" class="form-control" id="booking_date" name="booking_date" placeholder="Preffered Date" required="" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-control" id="booking_time" name="booking_time" placeholder="Preffered Time" required="">
                                <option value="">Preferred Time</option>
                                <option value="morning">Mornings - 8am to 12pm</option>
                                <option value="afn">Afternoon - 12pm to 5pm</option>
                                <option value="evening">Evenings - 5pm to 8.30pm</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-warning btn-block">Book Appointment</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <small class="d-inline-block">By clicking submit you are agreeing to the
                                <a href="/terms-and-conditions">terms</a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
            </div>
        </div> 
    </div>
</section>