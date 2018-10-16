<?php 
    $curr_site_url = site_url();
    $source = str_replace($curr_site_url,'',get_the_permalink());
    if($source == "/")  $source = "homepage";
    
    $varTest = get_query_var( 'iuyamlkj', 0 );
    if($varTest != '') $source = $varTest;
?>

<section>
    <div class="row">   
        <div class="col medium-12 small-12 large-12" style="padding-top: 30px;padding-right: 0px;padding-bottom: 10px;text-align:center;color: rgb(251,184,50) !important;;"> 
            <strong>How our service works?</strong>
        </div>
        <div class="col medium-6 small-5 large-6" style="padding-right: 0px;padding-bottom: 0px;text-align: center;"> 
            <img src="<?php echo plugin_dir_url(__DIR__) ?>images/pdf-quote-compressor.png" alt="Download Quote" title="Download Quote" class="skewed" />
        </div>
        <div  class="col medium-6 small-7 large-6" style="padding-left: 0px;padding-bottom: 0px;text-align: left;font-size: 14px;">
            <ol>
                <li>Reccomend System Size</li>
                <li>Provide Estimated Savings</li>
                <li>Provide 3 Solar Quotes</li>
                <li>Compare Feed In Tariffs</li>
                <li>Arrange Finance & Install</li>
            </ol>    
        </div> 
    </div>
</section>