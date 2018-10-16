<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/mark-mg
 * @since      1.0.0
 *
 * @package    Monster_Pack
 * @subpackage Monster_Pack/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Monster_Pack
 * @subpackage Monster_Pack/public
 * @author     Mark Anthony Adriano <mark.anthony@monstergroup.com.au>
 */


class Monster_Pack_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.2
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name; 

    /**
     * The version of this plugin.
     *
     * @since    1.0.2
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.2
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */

    private $api_url; 
    private $pdf_url; 
    private $auth; 
    private $headers; 
   

    

    public function __construct($plugin_name, $version)
    {
        
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        
        $auth = base64_encode('ImMonster40K@:h6onIgQRg16dOC5R');
        $this->headers = array(
                "Authorization: Basic  $auth",
                'Content-Type: application/json',
                "accept:application/json",
            ); 
        
        
        if($_SERVER["HTTP_HOST"] == 'localhost'){
           $this->api_url = "http://localhost/electricitymonster/services/webservices.php";
           $this->pdf_url = "http://localhost/electricitymonster/documents/order_forms/";           
        }else{
            if(count($_POST) && isset($_POST['source'])) {
                mail('anvesh@monstergroup.com.au, augusto@monstergroup.com.au, mark.anthony@monstergroup.com.au', 'Data Posted to SM', print_r($_POST, true));
            }  
            //$this->api_url = "https://staging.electricitymonster.com.au/services/webservices.php"; //----> STG
            $this->api_url = "https://mga.electricitymonster.com.au/services/webservices.php";   //----> PRD

            //$this->pdf_url = "https://staging.electricitymonster.com.au/documents/order_forms/"; //----> STG
            $this->pdf_url = "https://mga.electricitymonster.com.au/documents/order_forms/";   //----> PRD
        }  

        add_shortcode('cta_form',       array($this, 'cta_form'));
        add_shortcode('hero_form',      array($this, 'hero_form'));
        add_shortcode('hero_file',      array($this, 'hero_file'));
        add_shortcode('trust_pilot',    array($this, 'trust_pilot'));
        add_shortcode('product_form',   array($this, 'product_form'));
        add_shortcode('contact_form',   array($this, 'contact_form'));
        add_shortcode('subscribe_form', array($this, 'subscribe_form'));
        add_shortcode('download_form',  array($this, 'download_form'));
        add_shortcode('order_signoff',  array($this, 'order_signoff'));  
        add_shortcode('site_map',       array($this, 'site_map'));

        add_action('wp_print_scripts', array($this, 'monster_pack_ajax_load_request'));

        add_action("wp_ajax_SubscribeForm", array($this, "SubscribeForm"));
        add_action("wp_ajax_nopriv_SubscribeForm", array($this, "SubscribeForm"));

        add_action("wp_ajax_SaveAppointment", array($this, "SaveAppointment"));
        add_action("wp_ajax_nopriv_SaveAppointment", array($this, "SaveAppointment"));

        add_action("wp_ajax_SaveUserDetails", array($this, "SaveUserDetails"));
        add_action("wp_ajax_nopriv_SaveUserDetails", array($this, "SaveUserDetails"));

        add_action("wp_ajax_SaveStep2", array($this, "SaveStep2"));
        add_action("wp_ajax_nopriv_SaveStep2", array($this, "SaveStep2"));

        add_action("wp_ajax_SaveContactDetails", array($this, "SaveContactDetails"));
        add_action("wp_ajax_nopriv_SaveContactDetails", array($this, "SaveContactDetails"));

        add_action("wp_ajax_CheckUserSignOff", array($this, "CheckUserSignOff"));
        add_action("wp_ajax_nopriv_CheckUserSignOff", array($this, "CheckUserSignOff"));  
    }

    public function wpd_catalogueitem_rewrites()
	{
		add_rewrite_rule('order-signoff/([a-zA-Z0-9-=]+)', 'index.php?pagename=order-signoff&leadID=$matches[1]', 'top');
	}
	

	public function flush_rules()
	{
		flush_rewrite_rules();
	} 

	public function wpd_query_vars($query_vars)
	{
		$query_vars[] = 'leadID'; 
		return $query_vars;
	}

    public function monster_pack_ajax_load_request()
    {
        wp_localize_script($this->plugin_name, 'monster_pack_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

    public function load_resources()
    {
        /* 
        wp_register_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/monster-pack-public.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name);

        wp_register_style('DatePicker', plugin_dir_url(__FILE__) . 'css/datepicker.min.css', array(), $this->version, 'all');
        wp_enqueue_style('DatePicker');

        wp_register_script('DatePicker', plugin_dir_url(__FILE__) . 'js/datepicker.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script('DatePicker');

        wp_register_script('jQueryValidate', plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script('jQueryValidate');
 
        wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/monster-pack-public.js', array('jquery'), $this->version, true);
        wp_enqueue_script($this->plugin_name);  
        */
        
        wp_register_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/mp-plugin-styles.min.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name);

        wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/mp-plugin-scripts.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script($this->plugin_name); 

        if(is_page('order-signoff')){
            wp_register_script('jSignature', plugin_dir_url(__FILE__) . 'js/jSignature.min.noconflict.js', array('jquery'), $this->version, true);
            wp_enqueue_script('jSignature');

            wp_register_script('flashcanvas', plugin_dir_url(__FILE__) . 'js/flashcanvas.js', array('jquery'), $this->version, true);
            wp_enqueue_script('flashcanvas');
        }
    }

    public function get_metabox_meta()
    {

        $css_field_content = get_post_meta(get_the_ID(), '_monster_pack_content', true);

        // Check if set
        if (!empty($css_field_content)) {
            echo '<!-- Monster Pack --><style type="text/css">' . $css_field_content . '</style><!-- End Monster Pack -->';
        }

    }

    public function cta_form($atts, $content = null)
    {
        //[cta_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'cta_form'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-cta.php';
        return ob_get_clean();
    }

    public function site_map($atts, $content = null)
    {
        //[hero_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'site_map'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-sitemap.php';
        return ob_get_clean();
    }

    public function hero_form($atts, $content = null)
    {
        global $hero_prm;
        //[hero_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(  
                'step1_title'     =>  '',
                'step1_subtitle'  =>  '',
                'step1_button'    =>  '',
                'step2_title'     =>  '',
                'step2_subtitle'  =>  '',
                'step2_button'    =>  '',
            ),
            $atts,
            'hero_form'
        );

        $hero_prm = $atts;
        //return HTML
        ob_start();
        include 'partials/monster-pack-hero-form.php';
        return ob_get_clean();
    }

    public function base30_to_jpeg($base30_string, $output_file) {

        $data = str_replace('image/jsignature;base30,', '', $base30_string);
        $converter = new jSignature_Tools_Base30();
        $raw = $converter->Base64ToNative($data);
        //Calculate dimensions
        $width = 0;
        $height = 0;
        foreach($raw as $line)
        {
            if (max($line['x'])>$width)$width=max($line['x']);
            if (max($line['y'])>$height)$height=max($line['y']);
        }
        
        // Create an image
            $im = imagecreatetruecolor($width+20,$height+20);
        
        
        // Save transparency for PNG
            imagesavealpha($im, true);
        // Fill background with transparency
            $trans_colour = imagecolorallocatealpha($im, 255, 255, 255, 127);
            imagefill($im, 0, 0, $trans_colour);
        // Set pen thickness
            imagesetthickness($im, 2);
        // Set pen color to black
            $black = imagecolorallocate($im, 0, 0, 0);   
        // Loop through array pairs from each signature word
            for ($i = 0; $i < count($raw); $i++)
            {
                // Loop through each pair in a word
                for ($j = 0; $j < count($raw[$i]['x']); $j++)
                {
                    // Make sure we are not on the last coordinate in the array
                    if ( ! isset($raw[$i]['x'][$j])) 
                        break;
                    if ( ! isset($raw[$i]['x'][$j+1])) 
                    // Draw the dot for the coordinate
                        imagesetpixel ( $im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $black); 
                    else
                    // Draw the line for the coordinate pair
                    imageline($im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $raw[$i]['x'][$j+1], $raw[$i]['y'][$j+1], $black);
                }
            } 
        
        //Create Image
        $ifp = fopen($output_file, "wb"); 
        imagepng($im, $output_file);
        fclose($ifp);  
        imagedestroy($im);
    
        return $output_file; 
    }

    public function hero_file($atts, $content = null)
    { 
        //[hero_file]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'hero_file'
        );

        $hero_prm = $atts;
        //return HTML
        ob_start();
        include 'partials/monster-pack-hero-file.php';
        return ob_get_clean();
    }

    public function product_form($atts, $content = null)
    {
        global $prd_prm;
        //[product_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(  
                'step1_title'     =>  '',
                'step1_subtitle'  =>  '',
                'step1_button'    =>  '',
                'step2_title'     =>  '',
                'step2_subtitle'  =>  '',
                'step2_button'    =>  '',
            ),
            $atts,
            'product_form'
        );
        $prd_prm = $atts;
        //return HTML
        ob_start();
        include 'partials/monster-pack-product.php';
        return ob_get_clean();
    }

    public function trust_pilot($atts, $content = null)
    {
        //[download_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'trust_pilot'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-trust-pilot.php';
        return ob_get_clean();
    }
    public function download_form($atts, $content = null)
    {
        //[download_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'download_form'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-download.php';
        return ob_get_clean();
    }
    public function subscribe_form($atts, $content = null)
    {
        //[subscribe_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'subscribe_form'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-subscribe.php';
        return ob_get_clean();
    }
    public function order_signoff($atts, $content = null)
    {
        //[order_signoff]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'order_signoff'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-sign-off.php';
        return ob_get_clean();
    }

    public function contact_form($atts, $content = null)
    {
        //[contact_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'contact_form'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-contact.php';
        return ob_get_clean();
    }

    public function a_column($atts, $content = null)
    {
        //usage: [a_column class="filipstefansson" style="simple"]Follow me on Twitter![/a_column]
        extract(shortcode_atts(array(
            'class' => 'class',
            'style' => 'style',
        ), $atts));
        return '<div class="col-md-12' . esc_attr($style) . '" ' . esc_attr($style) . '">' . $content . '</div>';
    }

    public function SubscribeForm()
    {
        global $wpdb;
        $subscribe_email = $_POST['subscribe_email'];
        $table_name = $wpdb->prefix . 'email_signups';

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL  AUTO_INCREMENT,
				email_address text NOT NULL,
				date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  	UNIQUE KEY (id)
			) $charset_collate;";
            $wpdb->query($sql);
        }

        $subscribe_email_check = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE email_address = '" . $subscribe_email . "'");
        if ($wpdb->num_rows > 0) {
            echo 'Email id already exists';
        } else {
            $wpdb->insert($table_name, array(
                'email_address' => $subscribe_email,
                'date_added' => date('Y-m-d H:i:s'),
            ));
            echo 'You are successfully subscribed to our mailing list!';
        }

        die();
    }

    public function SaveAppointment()
    {

        global $wpdb;
        $everything_is_ok = true;
        $table_name = $wpdb->prefix . 'appt_data';

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL  AUTO_INCREMENT,
				appt_date date NOT NULL,
				appt_time text NOT NULL,
				appt_range text NOT NULL,
				form_data text NOT NULL,
				date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  	UNIQUE KEY (id)
			) $charset_collate;";
            $wpdb->query($sql);
        }

        $quote_data = array(
            'appt_date' => $_POST['booking_date'],
            'appt_time' => $_POST['booking_time'],
            'appt_range' => $_POST['booking_time_range'],
            'form_data' => json_encode($_POST),
            'date_added' => date("Y-m-d H:i:s"),
        );

        $wpdb->insert($table_name, $quote_data);
        $appt_id = $wpdb->insert_id;

        $time = "";
        $appt_time = "";
        if ($_POST['booking_time'] == "morning") {
            $time = "Mornings - 8am to 12pm";
            $appt_time = "morning";
        } else if ($_POST['booking_time'] == "afternoon") {
            $time = "Afternoon - 12pm to 5pm";
            $appt_time = "afn";
        } else {
            $time = "Evenings - 5pm to 8.30pm";
            $appt_time = "evening";
        }

        $shifting_date = '';
        if ($_POST['booking_date'] != '') {
            $shifting_date = str_replace('/', '-', $_POST['booking_date']);
            $shifting_date = date('Y-m-d', strtotime($shifting_date));
        }

        $data = null;
        $res_data = null;
        $error_msg = '';
         
        if ($appt_id == 0) { 
            $everything_is_ok = false;
            if ($wpdb->last_error !=  ''):
                $error_msg = $wpdb->print_error();
            endif;
        }
        
        $return_msg = array(
            'appt_date' => $_POST['booking_date'],
            'appt_time' => ucfirst($_POST['booking_time']) . ' - ' . $_POST['booking_time_range'],
            'appt_id' => $appt_id,
            'appt_data' => $data,
            'appt_res' => $res_data,
        ); 

        if($everything_is_ok){
            header('Content-Type: application/json');
            echo json_encode(array("return_msg" => $return_msg, "data" => $data)); 
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) == ""){
                echo json_encode('Error 500: Internal Server. Please try again.');  
            } else {                
                echo json_encode('Error 400: Bad Request - ['.$error_msg.']. Please try again.'); 
            }  

            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) != ""){
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            } else if(trim($curl_error_msg) != ""){                
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else { 
                echo json_encode('Error 409: Conflict.['.json_encode($response).']. Please try again.'); 
            }                      
        }


        die(0);
    }

    public function SaveUserDetails()
    {
        global $wpdb;
        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';

        $table_name = $wpdb->prefix . 'lead_data';
        $q1 = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL  AUTO_INCREMENT,
				fname text NOT NULL,
				lname text NOT NULL,
				email_id text NOT NULL,
				mobile_phn text NOT NULL,
                full_address text DEFAULT NULL,
                street_name text DEFAULT NULL,
                suburb text DEFAULT NULL,
				postcode text DEFAULT NULL,
                state_name text DEFAULT NULL,
                source text DEFAULT NULL,
                service_req text NOT NULL,
                quarter_bill text DEFAULT NULL,
                step2_sync tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
                section_src  text NOT NULL,
                page_src  text NOT NULL,
                advertising text DEFAULT NULL, 
                lead_source text DEFAULT NULL, 
				booking_id int(11) DEFAULT NULL,
                em_ref_id int(11) DEFAULT NULL,
                power_company  text DEFAULT NULL,
                shifting_date datetime DEFAULT NULL,
				date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  	UNIQUE KEY (id)
            ) $charset_collate;";

            $q2 = $wpdb->query($sql);
        }

        $prepend = "";
        if (isset($_POST['prepend']) && $_POST['prepend'] != "") {
            $prepend = trim($_POST['prepend']);
        }

        $service_req = "";
        if (isset($_POST['service_req'])) {
            $service_req = $_POST['service_req'];
        }

        $fname = ucwords(strtolower($_POST[$prepend . '_firstname']));
        $lname = "";
        if (isset($_POST[$prepend . '_lastname'])) {
            $lname = ucwords(strtolower($_POST[$prepend . '_lastname']));
        }

        $phone_num = "";
        if (isset($_POST[$prepend . '_contact'])) {
            $phone_num = $_POST[$prepend . '_contact'];
            $to_remove_array = array('$', '-', '_', '(', ')', ',', ' ');
            $phone_num = str_replace($to_remove_array, '', $phone_num);
        }

        $email_id = trim($_POST[$prepend . '_email']);

        $postcode = $_POST[$prepend . '_postcode'];
        $postcode_details = $wpdb->get_row('SELECT * FROM sm_postcodes WHERE postcode = ' . $postcode, ARRAY_A);
        $state_name = ($postcode_details) ? $postcode_details['state'] : "";

        $source = (isset($_POST['source']) ? $_POST['source'] : 'homepage');

        $page_src = "SM-";
        if (isset($_POST['page_src'])) {
            $page_src = $page_src . $_POST['page_src'];
        } else {
            $page_src = $page_src . 'homepage';
        }


        $booking_id = "";
        $booking_date = "";
        $booking_time = ""; 
        if (isset($_POST['book_appt_id']))  $booking_id = $_POST['book_appt_id']; 
        if (isset($_POST['booking_date']))  $booking_date = $_POST['booking_date']; 
        if (isset($_POST['booking_time']))  $booking_time = $_POST['booking_time'];  
        
        $quarter_bill = "";
        if (isset($_POST[$prepend . '_quarter_bill']))  $quarter_bill = strtolower($_POST[$prepend . '_quarter_bill']);  

        $advertising = "";
        if (isset($_COOKIE['campaign'])) {
            $advertising = $_COOKIE['campaign'];
        }
        $advertising = ($advertising == "organic" ? "Organic" : ($advertising == 'direct' ? 'DIRECT' : $advertising));


        $cnfm_details = array(
            'service_req'   =>  $service_req,
            'fname'         =>  $fname,
            'lname'         =>  $lname,
            'email_id'      =>  $email_id,
            'source'        =>  $source,
            'lead_source'   =>  $source,
            'mobile_phn'    =>  $phone_num,
            'date_added'    =>  date('Y-m-d H:i:s'), 
            'postcode'      =>  $postcode,
            'advertising'   =>  $advertising,
            'state_name'    =>  ($state_name ? $state_name : ""),
            'section_src'   =>  $prepend,
            'quarter_bill'   => $quarter_bill,
            'page_src'      =>  $page_src,
            'booking_id'    =>  $booking_id,
        );

        $wpdb->insert($table_name, $cnfm_details);
        $lastq = $wpdb->last_query;
        $test = $wpdb->insert_id; 
        
        if ($wpdb->last_error !== ''):
            $error_msg = $wpdb->print_error();
        endif; 

        $api_msg = '';
        $response = '';
        $em_lead_id = '';
        if ($test != 0) {  
            $postdata = array(
                'service_req'   =>  $service_req,
                'fname'         =>  $fname,
                'lname'         =>  $lname,
                'email_id'      =>  $email_id,
                'phone_num'     =>  $phone_num,
                'postcode'      =>  $postcode,
                'page_type'     =>  $page_src,
                'source'        =>  $source,
                'lead_source'   =>  $prepend, 
                'lead_from'     =>  'solarmonster',
                'advertising'   =>  $advertising,
                'action'        =>  'save_em_lead',
                
                'sm_lead_no'    =>  $test, 
                'appt_date'     =>  $booking_date,
                'appt_time'     =>  $booking_time, 
                'estimate_bill' =>  strtolower($quarter_bill),
            ); 

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $data = curl_exec($ch);
            if (!curl_errno($ch)) {  
                $response_em_id = json_decode($data);
                $em_lead_id = $response_em_id->lead_id;
                $wpdb->update($table_name, array("em_ref_id" => $response_em_id->lead_id), array("id" => $test));
                $api_msg = json_encode(array("saved" => 1, "seeking_for" => $service_req, "data" => $data, "em_lead_response" => $response_em_id->lead_id, "this_em_id" => $test, 'state_name' => $state_name));
            } else {
                $everything_is_ok = false;
                $curl_error_msg = curl_error($ch);
            }
            curl_close($ch);
        } else {
            $everything_is_ok = false;
            $response = array(
                'code' => 401,
                'message' => "Some Error Occurred. Please try again.",
            );
        }  
        
        if($everything_is_ok){
            header('Content-Type: application/json');

            // set the expiration date to 1 day
            setcookie("smLeadID", $test, time()+86400);
            setcookie("emLeadID", $em_lead_id, time()+86400);
            setcookie("smSection", $page_src, time()+86400);
            setcookie("smSectionStep", $prepend, time()+86400);

            $return_msg = array(
                'error'     =>  $error_msg,
                'lastq'     =>  $lastq,
                'source'    =>  $_POST['page_src'] . "-->" . $prepend,
                'lead_id'   =>  $test,
                'api_msg'   =>  $api_msg,
                'em_lead_id'=>  $em_lead_id,
                'booking_id'=>  $_POST['book_appt_id'],
                'response'  =>  $response,                
                //'headers'   =>  $this->headers,
                //'url'       =>  $this->api_url,
            );

            echo json_encode( $return_msg );
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) != ""){
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            } else if(trim($curl_error_msg) != ""){                
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else { 
                echo json_encode('Error 409: Conflict.['.json_encode($response).']. Please try again.'); 
            }            
        }
        die(0);

    }

    public function SaveStep2()
    {
        global $wpdb;
        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';

        $table_name = $wpdb->prefix . 'lead_data'; 
        $prepend = "";
        if (isset($_POST['prepend']) && $_POST['prepend'] != "") {
            $prepend = trim($_POST['prepend']);
        }

        $user_id = "";
        if (isset($_COOKIE['smLeadID'])) {
            $user_id = $_COOKIE['smLeadID'];
        } else {
            $user_id = $_POST[$prepend . '_step_user_id'];
        }

        $lead_id = "";
        if (isset($_COOKIE['emLeadID'])) {
            $lead_id = $_COOKIE['emLeadID'];
        } else {
            $lead_id = $_POST[$prepend . '_step_lead_id'];
        }  

        $power_company = $_POST[$prepend . '_step_retailer'];

        $shifting_date = '';
        if ($_POST[$prepend . '_step_shifting_date'] != '') {
            $shifting_date = str_replace('/', '-', $_POST[$prepend . '_step_shifting_date']);
            $shifting_date = date('Y-m-d', strtotime($shifting_date));
        }

        $lead_data = array(
            'full_address'  => $_POST[$prepend . '_step_address'],
            'street_name'   => $_POST[$prepend . '_step_street_name'],
            'suburb'        => $_POST[$prepend . '_step_suburb'],
            'postcode'      => $_POST[$prepend . '_step_postcode'],
            'state_name'    => $_POST[$prepend . '_step_state'],
            'shifting_date' => $shifting_date,
            'power_company' => $power_company,
        );

       
        $return_msg = $wpdb->update($table_name, $lead_data, array('id' => $user_id));
        $data = null;

        $response = ''; 
        if ($wpdb->last_error !=  ''):
            $error_msg = $wpdb->print_error();
        endif;

        if ($return_msg) {  
            $postdata = array(
                'address'       =>  $_POST[$prepend . '_step_address'],
                'street_name'   =>  $_POST[$prepend . '_step_street_name'],
                'suburb'        =>  $_POST[$prepend . '_step_suburb'],
                'state'         =>  $_POST[$prepend . '_step_state'],
                'country'       =>  $_POST[$prepend . '_step_country'],
                'postcode'      =>  $_POST[$prepend . '_step_postcode'],
                'power_company' =>  $power_company,
                'em_lead_id'    =>  $lead_id,
                'shifting_date' =>  $shifting_date,
                'action'        =>  "save_em_lead_step2",
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $data = curl_exec($ch);

            if (curl_errno($ch)) { 
                $everything_is_ok = false;
                $curl_error_msg = curl_error($ch); 
            } else {
                $wpdb->update($table_name, array("step2_sync" => 1), array("id" => $lead_id));
            }
            curl_close($ch);
        }else{
            $everything_is_ok = false; 
            $response = array(
                'id'        =>  $return_msg,
                'code'      =>  401,
                'message'   =>  "Some Error Occurred. Please try again.",
                'query'     => $wpdb->last_query,
            );
        }

        if($everything_is_ok){
            header('Content-Type: application/json');
            echo json_encode(array("return_msg" => $return_msg, "data" => $data)); 
        }else{ 
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) != ""){
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            } else if(trim($curl_error_msg) != ""){                
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else { 
                echo json_encode('Error 409: Conflict.['.json_encode($response).']. Please try again.'); 
            }                      
        }

        
        die(0);
    }

    public function SaveContactDetails()
    {
        global $wpdb;

        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';

        $table_name = $wpdb->prefix . 'contact_us';
        $sql = "";
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();
    
            $sql = "CREATE TABLE $table_name (
                id int(11) NOT NULL  AUTO_INCREMENT,
                service_request text NOT NULL,
                fname text NOT NULL,
                lname text NOT NULL,
                email_id text NOT NULL,
                contact_num text NOT NULL,
                company text NOT NULL,
                full_address text DEFAULT NULL,
                street_name text DEFAULT NULL,
                suburb text DEFAULT NULL,
                postcode text DEFAULT NULL,
                state_name text DEFAULT NULL,
                contact_message text NOT NULL,
                source text DEFAULT NULL,
                date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY (id)
                ) $charset_collate;";
            $wpdb->query($sql);
        }

        $prepend  = "";
        if(isset($_POST['prepend']) && $_POST['prepend'] != "")  $prepend = trim($_POST['prepend']); 
       
        $to_remove_array = array('$','-','_','(',')',',',' ');

        $fname = ucwords(strtolower(trim(stripslashes($_POST[ $prepend.'_firstname']))));
        $lname = ucwords(strtolower(trim(stripslashes($_POST[ $prepend.'_lastname']))));
        $phone_num = str_replace($to_remove_array,"",trim($_POST[ $prepend.'_phone']));

        $mobile = $land_line = '';
        $code = substr($phone_num, 0, 2);
        if($code == '04')
        $mobile = $phone_num;
        else
        $land_line = $phone_num;

        $service_request = trim($_POST[$prepend.'_customerservice']);
        $email_id = trim($_POST[$prepend.'_email']);
        $source = (isset($_POST['source']) ? $_POST['source'] : 'contact-us'); 

        $cnfm_details = array(
            'service_request'   =>      $service_request,
            'fname'             =>      $fname,
            'lname'             =>      $lname,
            'email_id'          =>      $email_id,
            'contact_num'       =>      $phone_num,
            'company'           =>      trim($_POST[ $prepend.'_company']),
            'full_address'      =>      trim($_POST[ $prepend.'_address']),
            'street_name'       =>      trim($_POST[ $prepend.'_street_name']),
            'suburb'            =>      trim($_POST[ $prepend.'_suburb']),
            'postcode'          =>      trim($_POST[ $prepend.'_postcode']),
            'state_name'        =>      trim($_POST[ $prepend.'_state']),
            'contact_message'   =>      trim($_POST[ $prepend.'_message']),
        );
        $wpdb->insert( $table_name, $cnfm_details);
        $contact_us_id = $wpdb->insert_id;

        $name = $fname.' '.$lname;
        $email = $email_id;
        $message = trim($_POST[ $prepend.'_message']);
        $subject = "Solar Monster Contact Message";

        $content="From: $name \n Email: $email \n Message: $message";
        $recipient = "mark.anthony@monstergroup.com.au;";
        $mailheader = "From: $email \r\n";
        mail($recipient, $subject, $content, $mailheader) or die("Error!");
        $contact_us_msg  = "Email sent!";

       
        if ($contact_us_id) {  
            $data = "";
            $postdata = array(
                'customerservice'   =>  $service_request,
                'fname'             =>  $fname,
                'lname'             =>  $lname,
                'phone_num'         =>  $phone_num,
                'email_id'          =>  $email_id,
                'address'           =>  trim($_POST[ $prepend.'_address']),
                'postcode'          =>  trim($_POST[ $prepend.'_postcode']),
                'street_name'       =>  trim($_POST[ $prepend.'_street_name']),
                'suburb'            =>  trim($_POST[ $prepend.'_suburb']),
                'state'             =>  trim($_POST[ $prepend.'_state']),
                'country'           =>  trim($_POST[ $prepend.'_country']),
                'company'           =>  trim($_POST[ $prepend.'_company']), 
                'source'            =>  $source,
                'comment_query'     =>  $message,
                'site_source'       =>  "solarmonster",
                'action'            =>  "save_em_enquiry",
                'sm_contact_id'     =>  $contact_us_id
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $data = curl_exec($ch);
            if (!curl_errno($ch)) {
            } else {
                $everything_is_ok = false;
                $curl_error_msg = curl_error($ch);
            }
        } else {
            $everything_is_ok = false;
            if ($wpdb->last_error !=  ''):
                $error_msg = $wpdb->print_error();
            endif;
        }

        $return_msg = array(
            'return_id'     =>      $contact_us_id,            
            'return_msg'    =>      $contact_us_msg,
        );  
        
        if($everything_is_ok){
            header('Content-Type: application/json');
            echo json_encode(array("return_msg" => $return_msg, "data" => $data)); 
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) == ""){
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else {                
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            }            
        } 
        die(0); 
    } 
    
    public function CheckUserSignOff()
    {
        global $wpdb; 
        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';
        $cuso_step = null;

        $table_name = $wpdb->prefix . 'sign_off';
        $sql = "";  

        $order_form_id  = "0";
        if(isset($_POST['order_form_id']) && $_POST['order_form_id'] != "")  $order_form_id = trim($_POST['order_form_id']); 

        $sub_action = "check";
        if (isset($_POST['subs']) && $_POST['subs'] != "") $sub_action = trim($_POST['subs']); 

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();
    
            $sql = "CREATE TABLE $table_name (
                id int(11) NOT NULL  AUTO_INCREMENT,
                source text DEFAULT NULL,
                em_lead_id text DEFAULT NULL,  
                order_form_id text DEFAULT NULL,
                order_form_name text DEFAULT NULL, 
                crm_lead_name text DEFAULT NULL, 
                order_lead_name text DEFAULT NULL, 
                order_lead_sign text DEFAULT NULL, 
                sign_off_date datetime DEFAULT NULL,
                date_added  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY (id)
                ) $charset_collate;";
            $wpdb->query($sql);  
        } else {
            $cuso_step = $wpdb->get_row( "SELECT * FROM $table_name WHERE order_form_id = $order_form_id" ); 
        }

        $response = ''; 
        $em_data = null;
        $pdf_link = null;
        $signed_off = null;
        $postdata = null;
        $step = 0;
        $fname = "";
        
        if($cuso_step){
            if ($sub_action == 'check') {
                $step = 2;
                $signed_off = $cuso_step->sign_off_date;
                $fname = $cuso_step->crm_lead_name;
                $pdf_link = $this->pdf_url . $cuso_step->order_form_name; 
            }else{
                $step = 3;   
                if (isset($_POST['so_fullname']) && $_POST['so_fullname'] != ""){
                    $fname = trim($_POST['so_fullname']);
                }  

                $dirs = wp_upload_dir();
                $path = $dirs['basedir'] .'/signatures';  
                $text = '';  
                $stamp = $order_form_id.'-'.date("Ymd").'.png';
                if (isset($_POST['sign']) && $_POST['sign'] != ""){  
                    if(is_dir($path)){ 
                        $text = $path .'/'. $stamp;
                    }else{
                        if (!mkdir($dirs['basedir'] .'/signatures', 0777, true)) {
                            die('Failed to create folders...');
                        }else{
                            $text = $path .'/'. $stamp;
                        } 
                    }                     
                  
                    if ($text != "") $this->base30_to_jpeg($_POST['sign'], $text);
                }   

                $postdata = array(
                    'order_form_id' =>  $order_form_id,
                    'confirm_name'  =>  $fname,
                    'stamp_file'    =>  $stamp,
                    'action'        =>  "record_signoff",
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->api_url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

                $em_data = curl_exec($ch);
                if (!curl_errno($ch)) {
                    $em_data = json_decode($em_data);
                    if ($em_data->code==200){
                        $wpdb->update($table_name, array(
                            "sign_off_date" => date("Y-m-d H:i:s"),
                            "order_lead_name" => $fname,
                            "order_lead_sign" => $text
                        ), array("id" => $cuso_step->id));  
                    }else{
                        $everything_is_ok = false;
                        $error_msg = '[CURL]:'.$em_data->code.' -->'.$em_data->message; 
                    }
                } else {
                    $everything_is_ok = false;
                    $error_msg = '[CURL]:' . curl_error($ch); 
                } 
           }  
        }else{ 
            $step = 1;
            $postdata = array(
                'order_form_id' => $order_form_id,
                'action' => "get_quote_data",
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $em_data = curl_exec($ch);
            if (!curl_errno($ch)) {
                $em_data = json_decode($em_data);
                
                if ($em_data->code==200){
                    $cnfm_details = array(
                        'em_lead_id'        =>      $em_data->em_lead_id,
                        'order_form_name'   =>      $em_data->order_form_name,
                        'crm_lead_name'     =>      $em_data->full_name,
                        'order_form_id'     =>      $order_form_id,
                        'sign_off_date'     =>      null,
                        'source'            =>      'SM SignOff',
                    );

                    $wpdb->insert($table_name, $cnfm_details); 
                    $pdf_link = $this->pdf_url.$em_data->order_form_name; 
                    $fname = $em_data->full_name;
                    $lastq = $wpdb->last_query;
                    $test = $wpdb->insert_id;
                }else{
                    $everything_is_ok = false;
                    $error_msg = '[CURL]:'.curl_error($ch);
                } 
            } else {
                $everything_is_ok = false;
                $error_msg = '[CURL]:'.curl_error($ch);
            } 
        } 
 

        $response = array(
            'order_form_id' =>$order_form_id,
            'postdata'  =>  $postdata,
            'action'    =>  $sub_action,
            'lead'      =>  $lead_sign_off,
            'error'     =>  $error_msg,
            'id'        =>  $cuso_step->id,
            'sql'       =>  $wpdb->last_query,
            'res'       =>  $cuso_step,
            'crm'       =>  $em_data, 
            'link'      =>  $pdf_link,
            'done'      =>  $signed_off,
            'step'      =>  $step,
            'is_ok'     =>  $everything_is_ok,
            'path'      =>  $path,
            'text'      =>  $text,
            'fname'     =>  $fname,
        );


        if($everything_is_ok){ 
            echo json_encode($response); 
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) == ""){
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else {                
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            }            
        }  
        
        die(0); 
    } 

}
