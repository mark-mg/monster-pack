<?php
    global $hero_prm;
    $curr_site_url = site_url();
    $source = str_replace($curr_site_url,'',get_the_permalink());
    if($source == "/")  $source = "homepage";
    
    $varTest = get_query_var( 'iuyamlkj', 0 );
    if($varTest != '') $source = $varTest;
?>
<style>
    #HERO-SECTION{
        margin-top: -5px;
    }
    .frm-title{
        font-size: 20px;
        margin-bottom: 0px;
    }
    #HERO-1{
        height: auto;
        padding-top: 30px;
    }
    #DNW-1{
        padding-top: 45px;
        height: auto;
    } 
    #DNW-2, #DNW-3{
        width: 350px !important;
        margin: auto 40px !important;
    }
    .skewed {
        position: relative;
        height: 150px;
        transform: skew(2deg) rotate(-2deg);
        -webkit-transform: skew(2deg) rotate(-2deg);
        -moz-transform: skew(2deg) rotate(-2deg);
        overflow: hidden;
    }
    #DNW-2 ol{
        text-align:left;
    }
    #DNW-2 li{
        font-size: 12px;
        color: white; 
        text-align:left;
    }
    #DNW-2{
        border-style: solid;
        border-width: 1px 0px 1px 0px;
        border-color: white; 
        padding-top: 10px;
        padding-bottom: 20px;
    }

    #DNW-2 strong{
        color: #FBB832;
    }
    @media (max-width: 375px) { 
        #hero_form, #hero_response, #hero_step2{
            height: 400px !important;
        }
        .bannertext h1,
        .bannertext p{
            color:white !important;
        }
        .hero-calss .section-content{
            position: initial !important;
        }
        .hero-calss {
            height: 600px !important;
        }
    }

    @media (max-width: 500px) {
        #hero_form, #hero_response, #hero_step2 {
            padding: 10px !important;
            margin: auto 0px auto 30px !important;
            border-radius: 10px;
            background-color: rgba(0, 58, 77, 0.7) !important;
            height: 450px;
        }
    }
</style>

<section id="HERO-SECTION">
    <div id="HERO-1" class="row">  
        <form id="hero_form" name="hero_form" method="POST" >
            <div class="row">
                <div class="col medium-12 small-12 large-12 text-center">
                    <h3 class="frm-title"><?php echo $hero_prm['step1_title']; ?></h3>
                    <b class="frm-stitle"><?php echo $hero_prm['step1_subtitle'] ?></b>
                </div>
            </div> 

            <div class="row">
                <div class="col medium-12 small-12 large-12">
                    <input type="text" class="form-control" id="hero_firstname" name="hero_firstname" placeholder="First name" required="" />
                </div>  

                <div class="col medium-6 small-6 large-6">
                    <input type="text" class="form-control" id="hero_contact" name="hero_contact" placeholder="Contact Number" required="" />
                </div>
                <div class="col medium-6 small-6 large-6">
                    <input type="text" class="form-control" id="hero_postcode" name="hero_postcode" placeholder="Post Code" required="" />
                </div>

                <div class="col medium-12 small-12 large-12">
                    <input type="text" class="form-control" id="hero_email" name="hero_email" placeholder="Email Address" required="" />
                </div>

                <div class="col medium-12 small-12 large-12">  
                    <select id="hero_quarter_bill" name="hero_quarter_bill" class="form-control" 
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

                <div class="col medium-12 small-12 large-12 d-none" id="hero_form_error" name="hero_form_error">
                    <span class="error">
                        Please provide the required information.
                    </span> 
                </div> 

                <div class="col medium-6 small-6 large-6">
                    <p class="terms">
                        <span>By clicking submit you are agreeing to the &nbsp;</span>
                        <a href="/terms-and-conditions">terms</a>
                    </p>
                </div>
                <div class="col medium-6 small-6 large-6">
                    <input type="hidden" name="source" id="hero_source" value="<?php echo $source; ?>" />
                    <button id="hero_button" name="hero_button" class="btn btn-warning" type="submit">
                        <?php echo $hero_prm['step1_button'] ?>
                    </button>
                </div>
               
                <div class="col medium-12 small-12 large-12 show-for-small" style="margin-bottom:50px;">
                    <small class="d-inline-block terms">
                        <i>* We do not compare all solar providers</i>
                        <br>
                    </small>
                </div>
        
            </div> 
        </form>

        <form id="hero_step2" name="hero_step2" method="POST" class="d-none">
            <div class="row">
                <div class="col medium-12 small-12 large-12 text-center mb-3">
                    <strong class="frm-title"><?php echo $hero_prm['step2_title']; ?></strong>
                    <p class="frm-stitle"><?php echo $hero_prm['step2_subtitle']; ?></p>
                </div>
            </div>
            <div class="row">

                <div class="col medium-12 small-12 large-12">
                    <input id="hero_step_address" name="hero_step_address" type="text" class="form-control" placeholder="Full Address (Need to look at roof space)" required=""
                    />
                    <input type="hidden" name="hero_step_street_name" id="hero_step_street_name" />
                    <input type="hidden" name="hero_step_suburb" id="hero_step_suburb" />
                    <input type="hidden" name="hero_step_state" id="hero_step_state" />
                    <input type="hidden" name="hero_step_country" id="hero_step_country" />
                    <input type="hidden" name="hero_step_postcode" id="hero_step_postcode" />
                </div>

                <div class="col medium-12 small-12 large-12">
                    <select id="hero_step_retailer" name="hero_step_retailer" class="form-control" placeholder="My Retailer" required="">
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

                <div class="col medium-12 small-12 large-12 d-none" id="hero_step_error" name="hero_step_error">
                    <span class="error">
                        Please provide the required information.
                    </span> 
                </div>

                <div class="col medium-12 small-12 large-12">
                    <input type="hidden" value="" id="hero_step_shifting_date" name="hero_step_shifting_date" value="" />
                    <input type="hidden" name="hero_step_user_id" id="hero_step_user_id" value="" />
                    <input type="hidden" name="hero_step_lead_id" id="hero_step_lead_id" value="" />
                    <button id="hero_step_button" type="submit" class="btn btn-warning btn-block cnfm_btn"  style="margin-top:10px;">
                        <?php echo $hero_prm['step2_button']; ?>
                    </button>
                </div>

            </div>
            <div class="row show-for-small" style="margin-bottom:50px;">
                <div class="col medium-12 small-12 large-12">
                    <small class="d-inline-block terms">
                        <i>* We do not compare all solar providers</i> 
                        <br>
                    </small>
                </div>
            </div>
        </form>

        <div id="hero_response" name="hero_response" class="d-none">
            <div class="row">
                <div class="col medium-12 small-12 large-12 normal text-center my-3"> 
                    <h3 class="fw-700 font-30 mb-0">Thank you!</h3> 
                    <p class="font-15 sel_msg mb-0">We will call you up when your quote is ready</p> 
                    <div class="text-center mb-0">
                        <img src="<?php echo plugin_dir_url(__DIR__) ?>images/cory-big.png" alt="cory" title="Cory" />
                        <p>Solar Monster Team</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="DNW-1" class="row hide-for-small"> 
        <div id="DNW-2" class="row "> 
            <div class="col medium-12 small-12 large-12" style="padding-right: 0px;padding-bottom: 10px;"> 
                <strong>How our service works?</strong>
            </div>
            <div class="col medium-6 small-6 large-6" style="padding-right: 0px;padding-bottom: 0px;"> 
                <img src="<?php echo plugin_dir_url(__DIR__) ?>images/pdf-quote-compressor.png" alt="Download Quote" title="Download Quote" class="skewed" />
            </div>
            <div id="DNW-2a" class="col medium-6 small-6 large-6" style="padding-left: 0px;padding-bottom: 0px;text-align: left;">
                <ol>
                    <li>Reccomend System Size</li>
                    <li>Provide Estimated Savings</li>
                    <li>Provide 3 Solar Quotes</li>
                    <li>Compare Feed In Tariffs</li>
                    <li>Arrange Finance & Install</li>
                </ol>    
            </div>
        </div>
        <div id="DNW-3" class="row"> 
            <div class="col medium-12 small-12 large-12">
                <small class="d-inline-block terms">
                    <i>* We do not compare all solar providers</i>
                </small>
            </div>
        </div>
    </div> 
</section>