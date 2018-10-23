var gmap_key = 'AIzaSyAvIqYIPuYPtHvdJoqndErZRrzUUTKZYQI';

function initSolarMap() {
	//console.log('initSolarMap started');
	var mapOptions = {
		center: new google.maps.LatLng(-33.8688, 151.2195),
		zoom: 13,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	if (jQuery('#map-canvas').length > 0) {
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		var fldName = getCookie("InputFld");
		var prepend = '#';
		if (fldName.indexOf("_step") > 0) {
			prepend = prepend + fldName.substring(0, fldName.indexOf("_step")) + '_step_';
		} else {
			prepend = prepend + fldName.substring(0, fldName.indexOf("_address")) + '_';
		}

		//console.log('initSolarMap prepend:' + prepend);
		var input = (document.getElementById(fldName));
		var autocomplete = new google.maps.places.Autocomplete(input, {
			types: ['geocode'],
			componentRestrictions: {
				'country': 'au'
			}
		});

		google.maps.event.addListener(autocomplete, 'place_changed', function (e, a) {
			jQuery('#' + fldName, '');
			var place = autocomplete.getPlace();
			fillAddress(place, prepend);
			return false;
		});
	}
}

function fillAddress(place, prepend) {
	//console.log('fillAddress : ' + place, 'prepend:' + prepend);
	jQuery(prepend + 'address-error').html("");

	var address = place.name;
	jQuery(prepend + 'street_name').val(address).data('address', address);
	for (i in place.address_components) {
		var comp = place.address_components[i];
		//console.log(comp.types[0]);
		switch (comp.types[0]) {
			case 'locality':
				jQuery(prepend + 'suburb').val(comp.long_name);
				break;
			case 'administrative_area_level_1':
				jQuery(prepend + 'state').val(comp.short_name);
				break;
			case 'postal_code':
				jQuery(prepend + 'postcode').each(function () {
					jQuery(this).val(comp.short_name);
				});
				break;
			case 'country':
				jQuery(prepend + 'country').val(comp.long_name);
				break;
		}
	}
	return true;
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function loadGMAP(fldName) {
	setCookie("InputFld", fldName, 1);
	if (typeof initSolarMap === 'function') {
		//console.log('jQuery found initSolarMap function');
		jQuery("head").prepend('<script src="https://maps.googleapis.com/maps/api/js?key=' + gmap_key + '&libraries=places&callback=initSolarMap"></script>');
	} else {
		//console.log('jQuery could not find initSolarMap function');
	}
}

(function ($) {
	'use strict';

	$(document).ready(function () {

		//https://manual.limesurvey.org/Using_regular_expressions
		var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		$.validator.addMethod("emailStr", function (value, element) {
			return this.optional(element) || regex.test(value);
		}, 'Invalid Email');

		$.validator.addMethod("nameStr", function (value, element) {
			value = value.replace(/^\s+|\s+$/g, "");
			return this.optional(element) || /^(?=.{1,40}$)[a-zA-Z]+(?:[-' ][a-zA-Z]+)*$/.test(value);
		}, 'Invalid Name');


		$.validator.addMethod("addressStr", function (value, element) {
			var stateStr = '#' + element.id.substring(0, element.id.indexOf('address')) + 'state';
			var stateVal = $.trim($(stateStr).val());
			var returnVal = true;
			if (stateVal == '') {
				returnVal = false;
			} else {
				returnVal = true;
				stateStr = '#' + element.id + '-error'
				$(stateStr).html('');
			}
			//console.log('stateStr : ' + stateStr, 'returnVal : ' + returnVal);
			return returnVal;
		}, 'Invalid Address');


		$.validator.addMethod("postCode", function (value, element) {
			return this.optional(element) || /^(?:(?:[2-8]\d|9[0-7]|0?[28]|0?9(?=09))(?:\d{2}))$/.test(value);
		}, 'Invalid Post Code');

		//https://manual.limesurvey.org/Using_regular_expressions
		//Very precise:
		$.validator.addMethod("phoneNum1", function (value, element) {
			return this.optional(element) || /^\(?(?:\+?61|0)(?:(?:2\)?[ -]?(?:3[ -]?[38]|[46-9][ -]?[0-9]|5[ -]?[0-35-9])|3\)?(?:4[ -]?[0-57-9]|[57-9][ -]?[0-9]|6[ -]?[1-67])|7\)?[ -]?(?:[2-4][ -]?[0-9]|5[ -]?[2-7]|7[ -]?6)|8\)?[ -]?(?:5[ -]?[1-4]|6[ -]?[0-8]|[7-9][ -]?[0-9]))(?:[ -]?[0-9]){6}|4\)?[ -]?(?:(?:[01][ -]?[0-9]|2[ -]?[0-57-9]|3[ -]?[1-9]|4[ -]?[7-9]|5[ -]?[018])[ -]?[0-9]|3[ -]?0[ -]?[0-5])(?:[ -]?[0-9]){5})$/.test(value);
		}, 'Invalid AU Phone Number');
		//Not very precise:
		$.validator.addMethod("phoneNum", function (value, element) {
			return this.optional(element) || /^(?:\+?61|0)[2-478](?:[ -]?[0-9]){8}$/.test(value);
		}, 'Invalid AU Phone Number');


		$(":input").attr("autocorrect", "off")
			.attr("autocapitalize", "off")
			.attr("autocomplete", "off")
			.attr("spellcheck", "false");

		//console.log('Monster Pack Public JS is LOADED.');
		var disabledDays = [0, 6];
		$('#booking_date').datepicker({
			language: 'en',
			minDate: new Date(),
			onRenderCell: function (date, cellType) {
				if (cellType == 'day') {
					var day = date.getDay(),
						isDisabled = disabledDays.indexOf(day) != -1;
					return {
						disabled: isDisabled
					}
				}
			},
			onSelect: function onSelect(fd, date) {
				$('#booking_date').val(fd);
				var myDatepicker = $('#booking_date').datepicker().data('datepicker');
				myDatepicker.hide();
			}
		})

		$("#subscribe_notify").click(function () {
			$(this).addClass("d-none");
			$("#subscribe_form").removeClass("d-none").fadeIn("slow");
		});

		$("#subscribe_email").on('input', function () {
			if (regex.test($(this).val())) {
				$("#subscribe_button").removeAttr("disabled");
			} else {
				$("#subscribe_button").attr("disabled", "disabled");
			}
		});

		$('#subscribe_form').validate({
			ignore: '',
			rules: {
				subscribe_email: {
					required: true
				},
			},
			messages: {
				subscribe_email: {
					email: "Please Enter Valid Email Address",
					required: "Please Enter Email Address"
				},
			},
			submitHandler: function (form) {
				//console.log('Call subscribe form php: ' + JSON.stringify($(form).serialize() + '&action=SubscribeForm'));
				//console.log('Call ajax subscribe form php: ' + $.trim(monster_pack_ajax_script.ajaxurl));
				$('.response-text').empty().removeClass("d-none");
				$("#subscribe_button").attr("disabled", "disabled").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>');

				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SubscribeForm',
					success: function (response) {
						//console.log('Success:' + JSON.stringify(response));
						$('#subscribe_button').html('Thank you!').attr("disabled", "disabled");
						$("#subscribe_email").attr("disabled", "disabled");
						$('.response-text').removeClass("d-none").html(response).fadeIn();

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'newsletterSubmissionSuccess',
							formId: 'subscribe_form',
						});
					},
					error: function (response) {
						console.log('Subscribe Error:' + JSON.stringify(response));
					}
				});
			}
		});

		function clear_form(nam) {
			if (nam == 'CTA') {
				$("#cta_firstname").val("");
				$("#cta_lastname").val("");
				$("#cta_email").val("");
				$("#cta_contact").val("");
				$("#cta_postcode").val("");
				$("#cta_quarter_bill").val("");
				$("#book_appt_id").val("");
			} else if (nam == 'PRD') {
				$("#prd_firstname").val("");
				$("#prd_lastname").val("");
				$("#prd_email").val("");
				$("#prd_contact").val("");
				$("#prd_postcode").val("");
				$("#prd_quarter_bill").val("");
			} else if (nam == 'PRD_STEP') {
				$("#prd_step_address").val("");
				$("#prd_step_street_name").val("");
				$("#prd_step_suburb").val("");
				$("#prd_step_state").val("");
				$("#prd_step_country").val("");
				$("#prd_step_postcode").val("");
				$("#prd_step_retailer").val("");
				$("#prd_step_shifting_date").val("");
				$("#prd_step_lead_id").val("");
				$("#prd_step_button").html("GET MY QUOTE");
			} else if (nam == 'CTA_STEP') {
				$("#cta_step_address").val("");
				$("#cta_step_street_name").val("");
				$("#cta_step_suburb").val("");
				$("#cta_step_state").val("");
				$("#cta_step_country").val("");
				$("#cta_step_postcode").val("");
				$("#cta_step_retailer").val("");
				$("#cta_step_shifting_date").val("");
				$("#cta_step_lead_id").val("");
				$("#cta_step_button").html("GET MY QUOTE");
			} else if (nam == 'HERO_STEP') {
				$("#hero_step_address").val("");
				$("#hero_step_street_name").val("");
				$("#hero_step_suburb").val("");
				$("#hero_step_state").val("");
				$("#hero_step_country").val("");
				$("#hero_step_postcode").val("");
				$("#hero_step_retailer").val("");
				$("#hero_step_shifting_date").val("");
				$("#hero_step_lead_id").val("");
				$("#hero_step_button").html("GET MY QUOTE");
			} else {
				$("#appt_button").html("Book Appointment");
				$("#booking_time_range").val("");
				$("#booking_date").val("");
				$("#booking_time").val("");
			}

			$("#CTA3").addClass("d-none");
			$("#CTA4").addClass("d-none");
			$(".cnfm_btn").removeAttr("disabled");
		}

		$("#cta1-btn").click(function () {
			$("#CTA1").removeClass("d-none").slideToggle("slow");
			clear_form("CTA");
			$("#cta_button").html("Get My Custom Quote");

			//BOOKING FORM
			divcss = $('#CTA2').css("display");
			if (divcss == 'flex') {
				$("#cta2-btn").addClass("active-cta-btn");
				$("#cta_firstname").focus();
			} else {
				$("#cta2-btn").removeClass("active-cta-btn");
			}

			//BOOKING FORM
			var divcss = $('#CTA2').css("display");
			if (divcss == 'flex') {
				$("#CTA2").removeClass("d-none").toggle(false);
				$("#cta2-btn").removeClass("active-cta-btn");
				$("#CTA2").addClass("d-none");
			}

			//CTA FORM
			divcss = $('#CTA1').css("display");
			if (divcss == 'flex') {
				$("#cta1-btn").addClass("active-cta-btn");
				$("#cta_firstname").focus();
			} else {
				$("#cta1-btn").removeClass("active-cta-btn");
			}
		});


		$("#cta2-btn").click(function () {
			$("#CTA2").removeClass("d-none").slideToggle("slow");
			clear_form("Booking");
			$("#cta_button").html("Confirm Details");

			//CTA FORM
			divcss = $('#CTA1').css("display");
			if (divcss == 'flex') {
				$("#cta1-btn").addClass("active-cta-btn");
				$("#cta_firstname").focus();
			} else {
				$("#cta1-btn").removeClass("active-cta-btn");
			}

			//CTA FORM
			var divcss = $('#CTA1').css("display");
			if (divcss == 'flex') {
				$("#CTA1").removeClass("d-none").toggle(false);
				$("#cta1-btn").removeClass("active-cta-btn");
				$("#CTA1").addClass("d-none");
			}

			//BOOKING FORM
			divcss = $('#CTA2').css("display");
			if (divcss == 'flex') {
				$("#cta2-btn").addClass("active-cta-btn");
				//$("#booking_date").focus();
			} else {
				$("#cta2-btn").removeClass("active-cta-btn");
			}
		});

		$("#booking_form").validate({
			ignore: '',
			messages: {
				booking_date: {
					required: "Please select appointment date."
				},
				booking_time: {
					required: "Please select preferred time of appointment."
				}
			},
			invalidHandler: function (e, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					var message = errors == 1 ?
						'Found an error. Please provide the correct information.' :
						'Found ' + errors + ' errors.  Please provide the correct information.';
					$("#booking_form_error span").html(message);
					$("#booking_form_error").removeClass('d-none');
				} else {
					$("#booking_form_error").addClass('d-none');
				}
			},
			onkeyup: false,
			submitHandler: function (form) {
				$("#cta1-btn").attr("disabled", "disabled");
				if ($("#booking_time").val() == 'morning') {
					$("#booking_time_range").val("8am to 12pm");
				} else if ($("#booking_time").val() == 'afternoon') {
					$("#booking_time_range").val("12pm to 5pm");
				} else {
					$("#booking_time_range").val("5pm to 8.30pm");
				}

				$(".appt_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveAppointment',
					success: function (response) {
						clear_form("CTA");


						$("#book_appt_id").val(response.return_msg.appt_id);

						setCookie("booking_date", response.return_msg.appt_id, 1);
						setCookie("booking_date", response.return_msg.appt_date, 1);
						setCookie("booking_time", response.return_msg.appt_time, 1);


						$(".sel_date").html(response.appt_date);
						$(".sel_session").html(response.appt_time);
						$("#CTA1").removeClass('d-none').fadeIn();
						$("#CTA2").addClass('d-none');
						$(".bill-estimate").addClass('d-none');
						$("#cta_quarter_bill").remove();

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'booking_form',
							step: 'Step1'
						});
					},
					error: function (response) {
						console.log('Error:' + response);
					}
				});
			}
		});

		$("#booking_form input, #booking_form select").blur(function () {
			var numItems = $('#booking_form .form-control.error').length;

			if (numItems == 0) {
				$("#booking_form_error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#booking_form_error span").html(message);
			}

		});

		$("#cta_form").validate({
			ignore: '',
			rules: {
				cta_firstname: {
					required: true,
					nameStr: true,
				},
				cta_email: {
					required: true,
					emailStr: true,
				},
				cta_contact: {
					required: true,
					phoneNum: true,
				},
				cta_postcode: {
					required: true,
					postCode: true,
				},
			},
			messages: {
				cta_firstname: {
					required: "Please enter your first name.",
					nameStr: "Please enter a valid name.",
				},
				cta_email: {
					required: "Please enter a valid email address.",
					emailStr: "Please enter a valid email address.",
				},
				cta_contact: {
					required: "Please enter your contact detail.",
					phoneNum: "Please enter a valid contact detail.",
				},
				cta_postcode: {
					required: "Please enter your post code.",
					postCode: "Please enter a valid post code.",
				},
			},
			invalidHandler: function (e, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					var message = errors == 1 ?
						'Found an error. Please provide the correct information.' :
						'Found ' + errors + ' errors.  Please provide the correct information.';
					$("#cta_form_error span").html(message);
					$("#cta_form_error").removeClass('d-none');
				} else {
					$("#cta_form_error").addClass('d-none');
				}
			},
			onkeyup: false,
			submitHandler: function (form) {
				var str = window.location.pathname;
				var res = str.split("/").join("");
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveUserDetails&prepend=cta&page_src=' + res,
					success: function (response) {
						clear_form("CTA_STEP");
						var tmp_booking_id = $("#book_appt_id").val();
						loadGMAP('cta_step_address');

						if (($.trim(response.booking_id) == "") && ($.trim(tmp_booking_id) == "")) {
							$("#CTA5").removeClass('d-none').fadeIn();
							$("#cta_step_user_id").val(response.lead_id);
							$("#cta_step_lead_id").val(response.em_lead_id);
							window.dataLayer = window.dataLayer || [];
							window.dataLayer.push({
								event: 'formSubmissionSuccess',
								formId: 'cta_form',
								step: 'Step1'
							});
						} else {
							$("#CTA3").removeClass('d-none').fadeIn();
							window.dataLayer = window.dataLayer || [];
							window.dataLayer.push({
								event: 'formSubmissionSuccess',
								formId: 'booking_form',
								step: 'Step2'
							});
						}
						$("#CTA1").addClass('d-none');
					},
					error: function (response) {
						console.log('Error:' + JSON.stringify(response));
						$("#cta_form_error span").html(response.responseText.replace(/"/g, ''));
						$("#cta_form_error").removeClass('d-none');
					}
				});
			}
		});

		$("#cta_form input").blur(function () {
			var numItems = $('#cta_form .form-control.error').length;

			if (numItems == 0) {
				$("#cta_form_error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#cta_form_error span").html(message);
			}

		});

		$("#cta_step2").validate({
			ignore: '',
			messages: {
				cta_step_address: {
					required: "Please enter your address.",
					nameStr: "Please enter your address.",
				},
				cta_step_retailer: {
					required: "Please enter your current energy provider.",
					nameStr: "Please enter your current energy provider.",
				},
			},
			invalidHandler: function (e, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					var message = errors == 1 ?
						'Found an error. Please provide the correct information.' :
						'Found ' + errors + ' errors.  Please provide the correct information.';
					$("#cta_step_error span").html(message);
					$("#cta_step_error").removeClass('d-none');
				} else {
					$("#cta_step_error").addClass('d-none');
				}
			},
			onkeyup: false,
			submitHandler: function (form) {
				var str = window.location.pathname;
				var res = str.split("/").join("");
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveStep2&prepend=cta&page_src=' + res,
					success: function (response) {
						$("#CTA4").removeClass('d-none').fadeIn();

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'cta_form',
							step: 'Step2'
						});

						$("#CTA5").addClass('d-none');
					},
					error: function (response) {
						console.log('Error:' + JSON.stringify(response));
						$("#cta_step_error span").html(response.responseText.replace(/"/g, ''));
						$("#cta_step_error").removeClass('d-none');
					}
				});
			}
		});

		$("#cta_step2 input, #cta_step2 select").blur(function () {
			var numItems = $('#cta_step2 .form-control.error').length;

			if (numItems == 0) {
				$("#cta_step_error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#cta_step_error span").html(message);
			}

		});


		$("#hero_form").validate({
			ignore: '',
			rules: {
				hero_firstname: {
					required: true,
					nameStr: true,
				},
				hero_lastname: {
					required: true,
					nameStr: true,
				},
				hero_email: {
					required: true,
					emailStr: true,
				},
				hero_contact: {
					required: true,
					phoneNum: true,
				},
				hero_postcode: {
					required: true,
					postCode: true,
				},
			},

			messages: {
				hero_firstname: {
					required: "Please enter your first name.",
					nameStr: "Please enter a valid name.",
				},
				hero_lastname: {
					required: "Please enter your last name.",
					nameStr: "Please enter a valid name.",
				},
				hero_email: {
					required: "Please enter a valid email address.",
					emailStr: "Please enter a valid email address.",
				},
				hero_contact: {
					required: "Please enter your contact detail.",
					phoneNum: "Please enter a valid contact detail.",
				},
				hero_postcode: {
					required: "Please enter your post code.",
					postCode: "Please enter a valid post code.",
				},
			},

			invalidHandler: function (e, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					var message = errors == 1 ?
						'Found an error. Please provide the correct information.' :
						'Found ' + errors + ' errors.  Please provide the correct information.';
					$("#hero_form_error span").html(message);
					$("#hero_form_error").removeClass('d-none');
				} else {
					$("#hero_form_error").addClass('d-none');
				}
			},
			onkeyup: false,
			submitHandler: function (form) {
				$("#hero_form_error").addClass('d-none');
				var str = window.location.pathname;
				var res = str.split("/").join("");
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveUserDetails&book_appt_id=0&prepend=hero&page_src=' + res,
					success: function (response) {
						clear_form("HERO_STEP");
						loadGMAP('hero_step_address');
						$("#hero_step2").removeClass('d-none').fadeIn();
						$("#hero_step_user_id").val(response.lead_id);
						$("#hero_step_lead_id").val(response.em_lead_id);
						$("#hero_form").addClass('d-none');

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'hero_form',
							step: 'Step1'
						});
					},
					error: function (response) {
						console.log('Error:' + JSON.stringify(response));
						$("#hero_form_error span").html(response.responseText.replace(/"/g, ''));
						$("#hero_form_error").removeClass('d-none');
					}
				});
			}
		});

		$("#hero_form input").blur(function () {
			var numItems = $('#hero_form .form-control.error').length;

			if (numItems == 0) {
				$("#hero_form_error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#hero_form_error span").html(message);
			}

		});

		$("#hero_step2").validate({
			ignore: '',
			messages: {
				hero_step_address: {
					required: "Please enter your address.",
					nameStr: "Please enter your address.",
				},
				hero_step_retailer: {
					required: "Please enter your current energy provider.",
					nameStr: "Please enter your current energy provider.",
				},
			},
			invalidHandler: function (e, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					var message = errors == 1 ?
						'Found an error. Please provide the correct information.' :
						'Found ' + errors + ' errors.  Please provide the correct information.';
					$("#hero_step_error span").html(message);
					$("#hero_step_error").removeClass('d-none');
				} else {
					$("#hero_step_error").addClass('d-none');
				}
			},
			onkeyup: false,
			submitHandler: function (form) {
				var str = window.location.pathname;
				var res = str.split("/").join("");
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveStep2&prepend=hero&page_src=' + res,
					success: function (response) {
						$("#hero_response").removeClass('d-none').fadeIn();

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'hero_form',
							step: 'Step2'
						});

						$("#hero_step2").addClass('d-none');
					},
					error: function (response) {
						console.log('Error:' + JSON.stringify(response));
						$("#hero_step_error span").html(response.responseText.replace(/"/g, ''));
						$("#hero_step_error").removeClass('d-none');
					}
				});
			}
		});

		$("#hero_step2 input, #hero_step2 select").blur(function () {
			var numItems = $('#hero_step2 .form-control.error').length;

			if (numItems == 0) {
				$("#hero_step_error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#hero_step_error span").html(message);
			}

		});

		$("#contact_form").validate({
			ignore: '',
			rules: {
				cf_firstname: {
					required: true,
					nameStr: true,
				},
				cf_lastname: {
					required: true,
					nameStr: true,
				},
				cf_phone: {
					required: true,
					phoneNum: true,
				},
				cf_email: {
					required: true,
					emailStr: true
				},
				cf_address: {
					required: true,
					addressStr: true,
				},
				cf_message: {
					required: true
				},
				cf_company: {
					required: function (element) {
						var selected = $("input[name='cf_customerservice']:checked").val();
						if (selected == 'Interested Partner') {
							return true;
						} else {
							return false;
						}
					}
				}
			},
			errorPlacement: function (error, element) {
				$(element)
					.closest("form")
					.find("label[for='" + element.attr("id") + "']")
					.append(error);
			},
			errorElement: "span",
			messages: {
				cf_firstname: {
					required: " (required)",
					nameStr: " (invalid input)",
				},
				cf_lastname: {
					required: " (required)",
					nameStr: " (invalid input)",
				},
				cf_email: {
					required: " (required)",
					emailStr: " (invalid input)"
				},
				cf_phone: {
					required: " (required)",
					phoneNum: " (invalid input)",
				},
				cf_address: {
					required: " (required)",
					addressStr: " (invalid input)",
				},
				cf_message: {
					required: " (required)"
				},
				cf_company: {
					required: " (required)"
				},
			},
			submitHandler: function (form) {
				var str = window.location.pathname;
				var res = str.split("/").join("");
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveContactDetails&book_appt_id=0&prepend=cf&page_src=' + res,
					success: function (response) {
						$("#cf_response").removeClass('d-none').fadeIn();
						$("#contact_form").addClass('d-none');

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'contact_form'
						});
					},
					error: function (response) {
						alert(response.responseText.replace(/"/g, ''));
						console.log('Error:' + response.responseText.replace(/"/g, ''));
					}
				});
			}
		});

		$('#contact_form input[type=radio]').on('change', function () {
			var selected = $("input[name='cf_customerservice']:checked").val();
			if (selected == 'Interested Partner') {
				$(".switch1").removeClass('small-12').addClass('small-6');
				$(".switch2").removeClass('d-none');
			} else {
				$(".switch1").removeClass('small-6').addClass('small-12');
				$(".switch2").addClass('d-none');
			}
		});

		$.fn.scrollView = function () {
			return this.each(function () {
				$('html, body').animate({
					scrollTop: $(this).offset().top - 55
				}, 1000);
			});
		}

		$('#pc-btn-1').click(function (e) {
			e.preventDefault();
			if ($("#PRD1").hasClass("d-none")) $('#PRD1').removeClass('d-none').removeAttr("style");
			$('#PRD1').scrollView();
			return false;
		});

		$('#pc-btn-2').click(function (e) {
			e.preventDefault();
			if ($("#PRD1").hasClass("d-none")) $('#PRD1').removeClass('d-none').removeAttr("style");
			$('#PRD1').scrollView();
			return false;
		});

		$('#pc-btn-3').click(function (e) {
			e.preventDefault();
			if ($("#PRD1").hasClass("d-none")) $('#PRD1').removeClass('d-none').removeAttr("style");
			$('#PRD1').scrollView();
			return false;
		});

		$("#prd_form").validate({
			ignore: '',
			rules: {
				prd_firstname: {
					required: true,
					nameStr: true,
				},
				prd_lastname: {
					required: true,
					nameStr: true,
				},
				prd_email: {
					required: true,
					emailStr: true,
				},
				prd_contact: {
					required: true,
					phoneNum: true,
				},
				prd_postcode: {
					required: true,
					postCode: true,
				},
			},
			messages: {
				prd_firstname: {
					required: "Please enter your first name.",
					nameStr: "Please enter a valid name.",
				},
				prd_lastname: {
					required: "Please enter your last name.",
					nameStr: "Please enter a valid name.",
				},
				prd_email: {
					required: "Please enter a valid email address.",
					emailStr: "Please enter a valid email address.",
				},
				prd_contact: {
					required: "Please enter your contact detail.",
					phoneNum: "Please enter a valid contact detail.",
				},
				prd_postcode: {
					required: "Please enter your post code.",
					postCode: "Please enter a valid post code.",
				},
			},
			invalidHandler: function (e, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					var message = errors == 1 ?
						'Found an error. Please provide the correct information.' :
						'Found ' + errors + ' errors.  Please provide the correct information.';
					$("#prd_form_error span").html(message);
					$("#prd_form_error").removeClass('d-none');
				} else {
					$("#prd_form_error").addClass('d-none');
				}
			},
			onkeyup: false,
			submitHandler: function (form) {
				var str = window.location.pathname;
				var res = str.split("/").join("");
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveUserDetails&prepend=prd&page_src=' + res,
					success: function (response) {

						clear_form("PRD_STEP");
						loadGMAP('prd_step_address');

						$("#PRD2").removeClass('d-none').fadeIn();
						$("#prd_step_user_id").val(response.lead_id);
						$("#prd_step_lead_id").val(response.em_lead_id);

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'prd_form',
							step: 'Step1'
						});

						$("#PRD1").addClass('d-none');
					},
					error: function (response) {
						console.log('Error:' + JSON.stringify(response));
					}
				});
			}
		});

		$("#prd_form input").blur(function () {
			var numItems = $('#prd_form .form-control.error').length;

			if (numItems == 0) {
				$("#prd_form_error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#prd_form_error span").html(message);
			}

		});

		$("#prd_step2").validate({
			ignore: '',
			messages: {
				prd_step_address: {
					required: "Please enter your address.",
					nameStr: "Please enter your address.",
				},
				prd_step_retailer: {
					required: "Please enter your current energy provider.",
					nameStr: "Please enter your current energy provider.",
				},
			},
			invalidHandler: function (e, validator) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					var message = errors == 1 ?
						'Found an error. Please provide the correct information.' :
						'Found ' + errors + ' errors.  Please provide the correct information.';
					$("#prd_step_error span").html(message);
					$("#prd_step_error").removeClass('d-none');
				} else {
					$("#prd_step_error").addClass('d-none');
				}
			},
			onkeyup: false,
			submitHandler: function (form) {
				var str = window.location.pathname;
				var res = str.split("/").join("");
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveStep2&prepend=prd&page_src=' + res,
					success: function (response) {
						$("#PRD3").removeClass('d-none').fadeIn();

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'prd_form',
							step: 'Step2'
						});

						$("#PRD2").addClass('d-none');
					},
					error: function (response) {
						console.log('Error:' + JSON.stringify(response));
						$("#prd_step_error span").html(response.responseText.replace(/"/g, ''));
						$("#prd_step_error").removeClass('d-none');
					}
				});
			}
		});


		$("#prd_step2 input, #prd_step2 select").blur(function () {
			var numItems = $('#prd_step2 .form-control.error').length;

			if (numItems == 0) {
				$("#prd_step_error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#prd_step_error span").html(message);
			}
		});

		if (!(getCookie('smSectionStep') === null)) {

			var Step2 = getCookie('smSectionStep');
			if (Step2 == 'hero') {
				clear_form("HERO_STEP");
				loadGMAP('hero_step_address');
				$("#hero_step2").removeClass('d-none').fadeIn();
				$("#hero_step_user_id").val(getCookie('smLeadID'));
				$("#hero_step_lead_id").val(getCookie('emLeadID'));
				$("#hero_form").addClass('d-none');
			} else if (Step2 == 'cta') {
				clear_form("CTA_STEP");
				loadGMAP('cta_step_address');
				$("#CTA5").removeClass('d-none').fadeIn();
				$("#cta_step_user_id").val(getCookie('smLeadID'));
				$("#cta_step_lead_id").val(getCookie('emLeadID'));
				$("#CTA1").addClass('d-none');
			} else if (Step2 == 'prd') {
				clear_form("PRD_STEP");
				loadGMAP('prd_step_address');
				$("#PRD2").removeClass('d-none').fadeIn();
				$("#prd_step_lead_id").val(getCookie('emLeadID'));
				$("#prd_step_user_id").val(getCookie('smLeadID'));
				$("#PRD1").addClass('d-none');
			} else {

			}
		}

		$('.wp-video-shortcode').each(function () {
			var video = $(this).attr('href');
		})


		var sigdiv = null;
		$("#lp2-btn").click(function () {
			$('#signature-section').fadeToggle("slow", "linear", function () {
				if (sigdiv == null) {
					var wpx = $("#signature").width() + 'px';
					sigdiv = $("#signature").jSignature({
						'lineWidth': 1,
						'height': '200px',
						'width': wpx
					});
					$('#signature-section').scrollView();
				} else {
					$("#signature").empty();
					$(window).unbind('.jSignature');
					sigdiv = null;
				}
			});
		})

		$('a[href*="#"]').on('click', function (e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top
			}, 2000, 'linear');
		});

		$("#clr-btn").click(function () {
			$("#signature").jSignature("clear");
			$('#sbmt-btn').prop("disabled", true);
		})

		$("#so_fullname").bind('change', function (e) {
			var stamp = $('#signature').jSignature("getData", 'native').length > 0;
			var fname = $('#so_fullname').val().trim();
			if (stamp && fname != '') $('#sbmt-btn').prop("disabled", false);
		})

		$("#signature").bind('change', function (e) {
			var stamp = $('#signature').jSignature("getData", 'native').length > 0;
			var fname = $('#so_fullname').val().trim();
			if (stamp && fname != '') $('#sbmt-btn').prop("disabled", false);
		})

		$("#signoff_form").validate({
			submitHandler: function (form) {
				$('#clr-btn').prop("disabled", true);
				$('#sbmt-btn-txt').addClass('d-none');
				$('#sbmt-btn-icon').removeClass('d-none');
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&sign=' + $("#signature").jSignature("getData", "base30") +
						'&action=CheckUserSignOff&subs=add&order_form_id=' + $("#leadIDCheck").val(),
					success: function (response) {
						$('#congratulations').removeClass('d-none').fadeIn();
						$('#sign-off-part').addClass('d-none').fadeOut();
						$('#signature-section').addClass('d-none').fadeOut();
					},
					error: function (response) {
						console.log('addUserSignOff Error:' + JSON.stringify(response));
						$('#unauthorized').removeClass('d-none');
						$('#api-err-msg').html(response.responseText.replace(/"/g, ''));
					}
				});
			}
		})

		$("#solar_lead_promo").validate({
			ignore: '',
			rules: {
				firstname: {
					required: true,
				},
				email: {
					required: true,
				},
				contact: {
					required: true,
				},
				postcode: {
					required: true,
				},
			},

			onkeyup: false,
			submitHandler: function (form) {
				console.log($(form).serialize() + '&action=SaveUserDetails&book_appt_id=0&prepend=promo&page_src=solar-landing&refresh_source=rd');
				$("#solar_lead_promo_error").addClass('d-none');
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveUserDetails&book_appt_id=0&prepend=promo&page_src=solar-promo&refresh_source=rd&source=solar-promo',
					success: function (response) {
						$(".promo-form").addClass('d-none');
						$(".congrats").removeClass('d-none');

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'solar_promo',
							step: 'Step1'
						});
					},
					error: function (response) {
						console.log('Error:' + JSON.stringify(response));
					}
				});
			}
		});

		$("#solar_lead_promo input").blur(function () {
			var numItems = $('#solar_lead_promo.form-control.error').length;
			console.log('numItems :' + numItems);
			if (numItems == 0) {
				$("#solar_lead_promo_error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#solar_lead_promo_error span").html(message);
			}

		});

		$(".mbl_tag_btn").click(function () {
			$(".mbl_head").removeClass('show-for-small').addClass('hide-for-small').fadeOut();
			$(".bg-animate").removeClass('hide-for-small').addClass('show-for-small').fadeIn();
		})

		$("#campaign-form").validate({
			ignore: '',
			rules: {
				firstname: {
					required: true,
				},
				email: {
					required: true,
				},
				contact: {
					required: true,
				},
				postcode: {
					required: true,
				},
			},
			onkeyup: false,
			submitHandler: function (form) {
				console.log($(form).serialize() + '&action=SaveUserDetails&book_appt_id=0&prepend=promo&page_src=solar-landing&refresh_source=rd');
				$("#campaign-form-error").addClass('d-none');
				$(".cnfm_btn").html('<i class="icon-flickr icon-is-spinning icon-fw"></i>').attr("disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() + '&action=SaveUserDetails&book_appt_id=0&prepend=campaign&page_src=solar-campaign&refresh_source=rd',
					success: function (response) {
						loadGMAP('campaign_step_address');

						var date = new Date();
						date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
						var expires = "; expires=" + date.toGMTString();
						document.cookie = "sm_lead_response=" + data.em_lead_id +
							expires + "; path=/";
						document.cookie = "this_fbsm_id=" + data.lead_id +
							expires + "; path=/";
						document.cookie = "stepsm=" + data.step + expires +
							"; path=/";
						document.cookie =
							'bill_size_htmls=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
						var cookies = get_cookies_array();
						for (var name in cookies) {
							if (name.indexOf("bill_size_htmls_") > -1)
								document.cookie = name +
								'=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
						}
						if (data.hasOwnProperty("bill_size_html"))
							jQuery("#campaign_step_quarter_bill").html(data.bill_size_html);

						if (data.hasOwnProperty("distrib_html")) {
							jQuery("#campaign_step_quarter_bill").closest("div").hide();
							var distrib_html ='<div class="clearfix"></div><div class="form-group col-md-12 col-sm-12 col-xs-12">'
								'<select class="btn-select-box required" id="cust_dis_id" name="cust_dis_id"><option value="">' +
								'Your Electricity Distributor</option>' + data.distrib_html + '</select></div>';
							jQuery("#campaign_step_address").closest("div").after(
								distrib_html);
							jQuery.each(data.bill_size_htmls, function (k, v) {
								document.cookie = "bill_size_htmls_" +
									k + "=" + v + expires + "; path=/";
							});
							document.cookie = "bill_size_htmls=" + data.bill_size_htmls +
								expires + "; path=/";
						}

						$("#campaign-form").addClass('d-none');
						$("#campaign-form2").removeClass('d-none');
						$(".cnfm_btn").html('Download').removeAttr("disabled");

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							event: 'formSubmissionSuccess',
							formId: 'solar_campaign',
							step: 'Step1'
						});
					},
					error: function (response) {
						console.log('Error:' + JSON.stringify(response));
					}
				});
			}
		});

		$("#campaign-form input").blur(function () {
			var numItems = $('#campaign-form.form-control.error').length;
			console.log('numItems :' + numItems);
			if (numItems == 0) {
				$("#campaign-form-error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#campaign-form-error span").html(message);
			}

		});


		$("#campaign-form2").validate({
			ignore: '',
			messages: {
				campaign_step_quarter_bill: 'Please Select Your Electricity Bill',
				campaign_step_retailer: 'Please Select Your Electricity Company',
				campaign_step_address: 'Please Select Your Address',
			},
			submitHandler: function (form) {
				$("#bill_btn").html('<i class="fas fa-spinner fa-spin"></i>').attr(
					"disabled", "disabled");
				$.ajax({
					url: $.trim(monster_pack_ajax_script.ajaxurl),
					type: "POST",
					data: $(form).serialize() +
						'&action=SMQuoteStep2&sm_lead_response=' + getCookie(
							'sm_lead_response') + '&this_fbsm_id=' + getCookie(
							'this_fbsm_id') + '&stepsm=' + getCookie('stepsm'),
					success: function (response) {
						var data = $.parseJSON(response);
						if (data.code == '401') {
							alert(data.message);
						} else {
							$("#campaign-form2").hide(); // .remove()        
							$("#campaign-form3").fadeIn().removeClass('d-none');
							document.cookie =
								'sm_lead_response=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
							document.cookie =
								'this_fbsm_id=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
							document.cookie =
								'stepsm=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
							document.cookie =
								'bill_size_htmls=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
							var cookies = get_cookies_array();
							for (var name in cookies) {
								if (name.indexOf("bill_size_htmls_") > -1)
									document.cookie = name +
									'=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
							}

							if (data.hasOwnProperty('filename')) {
								$(".dwnld_link").attr("href", data.filename);
								setTimeout(function () {
									$(".dwnld_link")[0].click();
								}, 1000);
							}

							window.dataLayer = window.dataLayer || [];
							window.dataLayer.push({
								event: 'formSubmissionSuccess',
								formId: 'sm-campaign-2',
								step: 'Step2'
							});
						}
					}
				});
				return false;
			}
		});


		$("#campaign-form2:input").blur(function () {
			var numItems = $('#campaign-form2.form-control.error').length;
			console.log('numItems :' + numItems);
			if (numItems == 0) {
				$("#campaign-form2-error").addClass('d-none');
			} else {
				var message = numItems == 1 ?
					'Found an error. Please provide the correct information.' :
					'Found ' + numItems + ' errors.  Please provide the correct information.';
				$("#campaign-form2-error span").html(message);
			}

		});


	})

})(jQuery);