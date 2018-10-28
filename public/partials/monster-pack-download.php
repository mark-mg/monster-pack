<style>
    .download-section{
    background-color: #EFF5F7;
    }
    #download-call-now:hover{
        color: #1ec8dc; 
        cursor: pointer;
    }
    #download-right li:first-child {
        width: 200px;
        margin: auto;
        padding-top: 10px;
    }
    #download_form {
        display: inline-block;
        margin-bottom: 0px;
        width: 100%;
    }

    #download_button,
    #download_notify {
        border-radius: 0px 15px 15px 0px;
        margin: 0px;
        text-transform: none;
        font-weight: 700;
        font-size: 16px;
    }

    #download_email {
        border-radius: 15px 0px 0px 15px;
        top: auto;
        padding-top: 0px;
        height: 40px;
        font-size: 16px;
    }

    #download-right {
        padding-left: 20px;
        display: table;
        width: 100%;
        margin: 0 !important;
        height: 100px;
    }

    ul#download-right li {
        display: table-cell;
        font-size: 24px;
        letter-spacing: 0.1em;
        font-weight: 500;
        margin: 5px;
    }

    #download-left {
        padding-right: 20px;
        margin: 0 !important;
        display: block;
        height: 100px;
    }

    ul#download-left li {
        display: inline-block;
        font-size: 24px;
        letter-spacing: 0.1em;
        font-weight: 500;
        margin: 5px; 
    }

    #download-left a {
        font-weight: 700;
        text-decoration: none !important
    }

    #download-left .dashicons-phone {
        font-size: 30px !important;
        margin-right: 10px;
    }

    .download-vr {
        border-left: 3px solid lightgrey;
        padding-right: 0px !important;
        margin-top: auto !important;
        margin-bottom: auto !important;
        padding-bottom: 0px !important;
        padding-top: 40px !important;
    }

    .download-vl {
        padding-left: 0px !important;
        margin-top: auto !important;
        margin-bottom: auto !important;
        padding-bottom: 0px !important;
        padding-top: 50px !important;
    }

    #download_notify {
        border-radius: 15px; 
        text-transform: none;
        font-weight: 700;
    }
    @media (max-width: 769px) { 
        ul#download-right li {
            display: inline-block;
            font-size: 24px;
            letter-spacing: 0.1em;
            font-weight: 500;
            margin: 5px;
        } 
        .download-vl,
        .download-vr{
            padding-top: 0px !important;
        }
        #download-right li:first-child {
            padding-top: 0px !important;
            padding-bottom: 10px !important;
        }
    }
    @media (max-width: 375px) { 
        .download-ct{
            padding-bottom: 0px;
        }
        #download-right{
            display: block;
        }
        ul#download-right li {
            display: inline-block;
            font-size: 24px;
            letter-spacing: 0.1em;
            font-weight: 500;
            margin: 5px;
        } 
        .download-vl .col-inner{
            text-align:center !important;
        }
        .download-vr .col-inner,
        .download-vl .col-inner{
            text-align:center !important;
        }
        #download-left, #download-right{
            padding:0px;
        }
    }
</style>
<section class="section download-section align-middle align-center">
    <div class="section-content relative">
        <div class="row">
            <div class="col download-vl medium-6 small-12 large-6">
                <div class="col-inner align-middle text-right">

                    <ul id="download-left">
                        <li>
                            <i class="icon-phone icon-sx icon-flip-x" style="color:#1EC8DC"></i>
                            <span> CALL NOW</span>
                        </li>
                        <li>
                            <a href="tel:1300 383 031" id="download-call-now" title="Call Now" style="">1300 383 031
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col download-ct show-for-small small-12">
                <hr />
            </div>
            <div class="col download-vr medium-6 small-12 large-6">
                <div class="col-inner align-middle text-left">

                    <ul id="download-right">
                        <li>
                            <span style="font-size: 18px;line-height: normal;">GET FREE QUOTE</span>
                        </li>
                        <li>
                            <button id="download_notify" name="download_notify" class="btn btn-warning" type="button"
                                style="margin-top: 0px;">
                                Download Now
                            </button>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>