<?php
    global $prd_prm;
    $curr_site_url = site_url();
    $source = str_replace($curr_site_url,'',get_the_permalink());
    if($source == "/")  $source = "homepage";
    
    $varTest = get_query_var( 'iuyamlkj', 0 );
    if($varTest != '') $source = $varTest;
?>
<section style="background:#cdfaff;">
    <!-- USER DETAILS -->
    <div id="PRD1" class="row row-large d-none" style="display:none;">
        <div class="col hide-for-small medium-3 small-12 large-3 pb-0">
            <div class="col-inner"></div>
        </div>

        <div class="col medium-6 small-12 large-6 pb-0">
            <form id="prd_form" name="prd_form" method="POST" class="col-inner text-center" style="padding-top:25px;">
                <div class="row">
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner text-center">
                            <h4><?php echo $prd_prm['step1_title']; ?></h4  >
                            <p><?php echo $prd_prm['step1_subtitle'] ?></p>
                        </div>
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col medium-6 small-6 large-6">
                        <input id="prd_firstname" name="prd_firstname" type="text" class="form-control" placeholder="First name" required="" />
                    </div>
                    <div class="col medium-6 small-6 large-6">
                        <input id="prd_lastname" name="prd_lastname" type="text" class="form-control" placeholder="Last name" required="" />
                    </div>
                </div>
                -->
                <div class="row">
                    <div class="col small-12 large-12">
                        <input id="prd_firstname" name="prd_firstname" type="text" class="form-control" placeholder="First name" required="" />
                    </div> 
                </div>
                <div class="row">
                    <div class="col medium-6 small-6 large-6">
                        <input type="text" id="prd_contact" name="prd_contact" class="form-control" placeholder="Contact Number" required="" />
                    </div>
                    <div class="col medium-6 small-6 large-6">
                        <input type="text" id="prd_postcode" name="prd_postcode" required="" pattern="[0-9]{4}" class="form-control" placeholder="Post Code"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col small-12 large-12">
                        <input type="text" id="prd_email" name="prd_email" class="form-control" placeholder="Email Address" required="" />
                    </div>
                </div>
                <div class="row">
                    <div class="col medium-12 small-12 large-12">  
                        <select id="prd_quarter_bill" name="prd_quarter_bill" class="form-control" 
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
                
                <div class="row">
                    <div class="col medium-12 small-12 large-12 d-none" id="prd_form_error" name="prd_form_error">
                        <span class="error">
                            Please provide the required information.
                        </span>
                    </div>
                    <div class="col small-12 large-12 pb-0">
                        <small class="d-inline-block" style="padding-bottom:10px;">
                            By clicking submit you are agreeing to the
                            <a href="/terms-and-conditions">terms</a>
                        </small>
                    </div>
                    <div class="col small-12 large-12 pb-0">
                        <input type="hidden" name="source" id="prd_source" value="<?php echo $source; ?>" />
                        <input type="hidden" name="book_appt_id" id="book_appt_id" value="" />
                        <button id="prd_button" type="submit" class="btn btn-warning btn-block cnfm_btn">
                            <?php echo $prd_prm['step1_button'] ?>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col small-12 large-12 pb-0">
                        <small class="d-inline-block">
                            <i>* We do not compare all solar providers</i>
                        </small>
                    </div>
                </div>
            </form>
        </div>

        <div class="col hide-for-small medium-3 small-12 large-3 pb-0">
            <div class="col-inner"></div>
        </div>

    </div>

    <!-- PRD 2ND STEP -->
    <div id="PRD2" class="row row-large d-none" style="display:none;">
        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>

        <div class="col medium-6 small-12 large-6">
            <form id="prd_step2" name="prd_step2" method="POST" class="col-inner text-center" style="padding-top:25px;">
                <div class="row">
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner text-center">
                            <strong><?php echo $prd_prm['step2_title']; ?></strong>
                            <p><?php echo $prd_prm['step2_subtitle']; ?></p>
                        </div>
                    </div>
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner text-center">
                            <input id="prd_step_address" name="prd_step_address" type="text" class="form-control" placeholder="Full Address" required=""
                            />
                            <input type="hidden" name="prd_step_street_name" id="prd_step_street_name" />
                            <input type="hidden" name="prd_step_suburb" id="prd_step_suburb" />
                            <input type="hidden" name="prd_step_state" id="prd_step_state" />
                            <input type="hidden" name="prd_step_country" id="prd_step_country" />
                            <input type="hidden" name="prd_step_postcode" id="prd_step_postcode" />
                        </div>
                    </div>
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner text-center">
                            <select id="prd_step_retailer" name="prd_step_retailer" class="form-control" placeholder="My Retailer" required="">
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

                    <div class="col medium-12 small-12 large-12 d-none" id="prd_step_error" name="prd_step_error">
                        <span class="error">
                            Please provide the required information.
                        </span>
                    </div>

                    <div class="col medium-12 small-12 large-12">
                        <small class="d-inline-block">By clicking submit you are agreeing to the
                            <a href="/terms-and-conditions">terms</a>
                        </small>
                    </div>
                    <div class="col medium-12 small-12 large-12 pb-0">
                        <input type="hidden" value="" id="prd_step_shifting_date" name="prd_step_shifting_date" value="" />
                        <input type="hidden" name="prd_step_lead_id" id="prd_step_lead_id" value="" />
                        <input type="hidden" name="prd_step_user_id" id="prd_step_user_id" value="" />  
                        <button id="prd_step_button" type="submit" class="btn btn-warning btn-block cnfm_btn">
                            <?php echo $prd_prm['step2_button']; ?>
                        </button>
                    </div>



                </div>
            </form>
        </div>

        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>
    </div>

    <!-- PRD FORM CONFIRMATION -->
    <div id="PRD3" class="row row-large d-none">
        <div class="col hide-for-small medium-3 small-12 large-3">
            <div class="col-inner"></div>
        </div>

        <div class="col medium-6 small-12 large-6">
            <div class="max-width-form normal text-center my-3" style="padding-top:25px;">
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
</section>