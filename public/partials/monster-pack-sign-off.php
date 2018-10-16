
		
<?php
    global $site_url, $hero_prm;
    $curr_site_url = site_url();

    $varTest = base64_decode(get_query_var('leadID', 0));
    $lead_id = 0;
    $filename = "";
    //echo get_query_var('leadID', 0);

    if ($varTest != "" || isset($_COOKIE['emLeadID'])) {
        if (isset($_COOKIE['emLeadID'])) {
            $filename = trim($_COOKIE['emLeadID']);
        } else {
            $filename = $varTest;
        }

        if ($filename == "") {
            wp_redirect($site_url);
            exit();
        }
    } 
?>

<section id="loader" class="section align-middle align-center">
    <div class="section-content relative">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p style="font-size: 36px;margin-bottom: 100px;margin-top: 100px;">
                        <img src="<?php echo plugin_dir_url(__DIR__) ?>images/oval.svg" width="100" alt="">
                    </p>
                    <form id="signoff_check" name="signoff_check">
                        <input type="hidden" name="leadIDCheck" id="leadIDCheck" value="<?php echo $filename; ?>" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="addLeadID" id="addLeadID" value="<?php echo $filename; ?>" />

<section class="section align-middle align-center">  
    <div id="sign-off-part" class="section-content relative d-none">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p style="font-size: 36px;margin-bottom: 30px;margin-top: 20px;">Going Solar Has Never Been So Easy</p>
                    <p style="margin-bottom: 0px;margin-top: 20px;font-weight: bolder;">Congratulations on choosing to go solar!</p>
                    <p style="margin-bottom: 0px;margin-top: 20px;">Please click on the below to review your order form.</p>
                    <p style="margin-bottom: 30px;margin-top: 20px;">Once you have completed reviewing, please click on sign off to complete the order.</p>
                </div>
            </div>
            <div class="col large-4 medium-2 hide-for-small">
                &nbsp;
            </div>
            <div class="col large-2 medium-4 small-6 align-middle text-center">
                <a id="dwnld1" href="#" class="button lp-btn review-order-btn align-middle">
                    <span>Review Order</span>
                </a> 
            </div>
            <div class="col large-2 medium-4 small-6 align-middle text-center">
                <a id="lp2-btn" href="#" class="button lp-btn sign-off-btn align-middle">
                    <span>Sign Off</span>
                </a>  
            </div> 
            <div class="col large-4 medium-2 hide-for-small">
                &nbsp;
            </div>
        </div> 
    </div>

    <div id="congratulations" class="section-content relative d-none">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p style="font-size: 36px;margin-bottom: 20px;margin-top: 20px;">Congratulations!</p>
                    <style>
                        .svg-class{
                            height: 50px;
                            fill: yellowgreen;
                        }
                    </style>

                    <p class="text-center" style="margin-bottom: 20px;">
                        <img class="svg-class" src="<?php echo plugin_dir_url(__DIR__) ?>images/check-circle-light.svg"

                        alt="Order Confirmed" title="Order Confirmed" />
                    </p>
                    <p style="margin-bottom: 0px;margin-top: 20px;font-weight: bolder;">Your order has been completed!</p>
                    <p style="margin-bottom: 0px;margin-top: 20px;">Your Broker will now review your paper work and will be in contact if any</p>
                    <p>additional information is required.</p>
                    <p style="margin-bottom: 30px;margin-top: 20px;">If you have any questions relating to your order feel free to call us on.</p>

                </div>
            </div>
        </div>
    </div>

    <div id="review" class="section-content relative d-none">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p style="font-size: 36px;margin-bottom: 20px;margin-top: 20px;">You have already Signed-off!</p>
                    <style>
                        .svg-class{
                            height: 50px;
                            fill: yellowgreen;
                        }
                    </style>

                    <p class="text-center" style="margin-bottom: 20px;">
                        <img class="svg-class" src="<?php echo plugin_dir_url(__DIR__) ?>images/check-circle-light.svg"

                        alt="Order Confirmed" title="Order Confirmed" />
                    </p>

                    <p style="margin-bottom: 0px;margin-top: 20px;">Click on the button below</p>
                    <p>to review / download again.</p>


                </div>
                <div class="row row-collapse">
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner align-middle text-center">
                            <a id="dwnld2" href="#">
                                <button id="lp2-btn" type="button" class="button secondary lp2 lp-btn review-order-btn">
                                    <span>Review Order</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="unauthorized" class="section-content relative d-none">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p style="font-size: 36px;margin-bottom: 20px;margin-top: 20px;">Unauthorized Access</p> 

                    <p class="text-center" style="margin-bottom: 20px;">
                        <img class="svg-class" src="<?php echo plugin_dir_url(__DIR__) ?>images/times-circle-light.svg" 
                        alt="Unauthorized Access" title="Unauthorized Access" style='height: 150px;fill: red;'/>  
                    </p> 

                    <p id='api-err-msg' style="font-size: 18px;margin-bottom: 20px;margin-top: 20px;">&nbsp;</p> 
                </div>
                
            </div>
        </div>
    </div>

</section>

<section id='signature-section' class="section align-middle align-center" style="padding:0px;background:lightblue;display: none;">
    <div class="section-content relative signature-section" style="padding-bottom:20px;padding-top:20px;margin:0">
        <div class="row row-full-width row-collapse">
            <div class="col medium-1 hide-for-small large-3">&nbsp;</div>
            <div class="col medium-10 small-12 large-6">
                <div class="col-inner align-middle text-center"> 
                    <form id="signoff_form" name="signoff_form" method="POST" style="margin-top: 30px;margin-bottom:0px !important;">
                        <p style="font-size: 24px;margin-bottom: 20px;margin-top: 20px;color:blue;">Confirm Your Details & Sign Off</p>
                        <p style="margin-bottom: 0px;margin-top: 20px;">By entering the details below you are agreeing to the terms and conditions as per the order from.</p>
                        <p style="margin-bottom: 20px;margin-top: 20px;">To review these terms and conditions again please click on the ‘Review Order’ button above.</p>                   
                        <input type="hidden" name="addLeadID" id="addLeadID" value="<?php echo $filename; ?>" />     
                        <div class="row">   
                            <div class="col medium-2 small-4 large-2 text-center pr-5 pb-20">
                                Full Name: 
                            </div> 
                            <div class="col medium-10 small-8 large-10 pl-5 pb-20"> 
                                <input type="text" class="form-control" id="so_fullname" name="so_fullname" placeholder="Full Name" required="" />
                            </div>
                            <div class="col medium-2 small-4 large-2 text-center pr-5 pb-0">
                                Signature: 
                            </div> 
                            <div class="col medium-10 small-8 large-10 pl-5 pb-0"> 
                                &nbsp;
                            </div>
                            <div class="col medium-12 small-12 large-12 text-left"> 
                                <div id="signature"></div> 
                                <canvas id='blank' style='display:none'></canvas>
                            </div> 
                            <div class="col medium-6 small-6 large-6">
                                <button id="clr-btn" type="button" class="button primary lp1 lp-btn">
                                    <span>CLEAR SIGNATURE</span>
                                </button>
                            </div>
                            <div class="col medium-6 small-6 large-6">
                                <button id="sbmt-btn" type="submit" class="button secondary lp1 lp-btn sign-off-btn" disabled>
                                    <span id='sbmt-btn-txt'>SUBMIT</span>
                                    <span id='sbmt-btn-icon' class="d-none">
                                        <img src="<?php echo plugin_dir_url(__DIR__) ?>images/three-dots.svg" alt="" style='height: 15px;'>
                                    </span>
                                </button>
                            </div> 
                        </div>
                    </form>                    
                </div>
            </div>
            <div class="col medium-1 hide-for-small large-3">&nbsp;</div>
        </div>
    </div>
</section>

<section class="section align-middle align-center" style="padding:0px;">
    <div class="section-content relative subscribe-section" style="padding-bottom:20px;padding-top:20px;margin:0">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p style="margin-bottom: 0px;margin-top: 20px;">Got a question?</p>
                    <p style="font-size: 24px;">
                        <i class="icon-phone icon-sx icon-flip-x"></i>
                        <span> CALL NOW</span>
                        <a href="tel:1300 383 031" id="subscribe-call-now" title="Call Now" style="">1300 383 031 </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    //console.log('#signoff_check submit'); 
     
	function checkUserSignOff(form) {
        //console.log('Call signoff_check form php: ' + JSON.stringify('leadorder_form_idID=' + jQuery( "#leadIDCheck" ).val() + '&subs=check&action=CheckUserSignOff'));
        //console.log('Call ajax signoff_check form php: ' + jQuery.trim(monster_pack_ajax_script.ajaxurl));
        //console.log('window.location.pathname : ' + window.location.pathname);

        jQuery.ajax({
            url: jQuery.trim(monster_pack_ajax_script.ajaxurl),
            type: "POST",
            data: jQuery(form).serialize() + '&action=CheckUserSignOff&subs=check&order_form_id=' + jQuery( "#leadIDCheck" ).val(),
            success: function (response) {
                response = JSON.parse(response);
                //console.log(' checkSignOff Success:|' + JSON.stringify(response.id) + '|', JSON.stringify(response).indexOf("null")); 
               
                jQuery('#loader').addClass('d-none');    
                if(response.is_ok){
                    if(response.done == null){
                        //console.log('#sign-off'); 
                        jQuery('#sign-off-part').removeClass('d-none');
                        jQuery('#so_fullname').val(response.fname);
                    }else{
                        //console . log('#review'); 
                        jQuery('#review').removeClass('d-none'); 
                    }
                    jQuery('#dwnld1').attr('href',response.link);
                    jQuery('#dwnld2').attr('href',response.link);
                }else{
                    jQuery('#unauthorized').removeClass('d-none'); 
                } 
                
            },
            error: function (response) {
                console.log('checkSignOff Error:' + JSON.stringify(response));
                jQuery('#unauthorized').removeClass('d-none'); 
                jQuery('#loader').addClass('d-none');     
            }
        }); 
    } 
     
    jQuery( document ).ready(function() {
        //console.log( "ready!" );
        checkUserSignOff(); 
    });
   
		

</script>