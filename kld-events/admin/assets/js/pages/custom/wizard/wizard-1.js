"use strict";

// Class definition
var KTWizard1 = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizard;
	var _validations = [];

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		_wizard = new KTWizard(_wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		_wizard.on('beforeNext', function (wizard) {
			// Don't go to the next step yet
			_wizard.stop();

			// Validate form
			var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
			validator.validate().then(function (status) {
				if (status == 'Valid') {
					_wizard.goNext();
					KTUtil.scrollTop();
				} else {
					Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

		// Change event
		_wizard.on('change', function (wizard) {
			KTUtil.scrollTop();
		});
	}


	$('#kt_datetimepicker_7_1').datetimepicker();
$('#kt_datetimepicker_7_2').datetimepicker({
    useCurrent: false
});

$('#kt_datetimepicker_7_1').on('change.datetimepicker', function(e) {
    $('#kt_datetimepicker_7_2').datetimepicker('minDate', e.date);
});
$('#kt_datetimepicker_7_2').on('change.datetimepicker', function(e) {
    $('#kt_datetimepicker_7_1').datetimepicker('maxDate', e.date);
});
$('#kt_datetimepicker_12').datetimepicker();

	var initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					venue: {
						validators: {
							notEmpty: {
								message: 'Venue is required'
							}
						}
					},
					
					startdate: {
						validators: {
							notEmpty: {
								message: 'Start Date is required'
							}
						}
					},
					enddate: {
						validators: {
							notEmpty: {
								message: 'End Date is required'
							}
						}
					},
					
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 2
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					package: {
						validators: {
							notEmpty: {
								message: 'Event details is required'
							}
						}
					},
					weight: {
						validators: {
							notEmpty: {
								message: 'Package weight is required'
							},
							digits: {
								message: 'The value added is not valid'
							}
						}
					},
					width: {
						validators: {
							notEmpty: {
								message: 'Package width is required'
							},
							digits: {
								message: 'The value added is not valid'
							}
						}
					},
					height: {
						validators: {
							notEmpty: {
								message: 'Package height is required'
							},
							digits: {
								message: 'The value added is not valid'
							}
						}
					},
					packagelength: {
						validators: {
							notEmpty: {
								message: 'Package length is required'
							},
							digits: {
								message: 'The value added is not valid'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 3
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					venue: {
						validators: {
							notEmpty: {
								message: 'Venue is required'
							}
						}
					},
					packaging: {
						validators: {
							notEmpty: {
								message: 'Packaging type is required'
							}
						}
					},
					preferreddelivery: {
						validators: {
							notEmpty: {
								message: 'Preferred delivery window is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 4
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					locaddress1: {
						validators: {
							notEmpty: {
								message: 'Address is required'
							}
						}
					},
					locpostcode: {
						validators: {
							notEmpty: {
								message: 'Postcode is required'
							}
						}
					},
					loccity: {
						validators: {
							notEmpty: {
								message: 'City is required'
							}
						}
					},
					locstate: {
						validators: {
							notEmpty: {
								message: 'State is required'
							}
						}
					},
					loccountry: {
						validators: {
							notEmpty: {
								message: 'Country is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));
	}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_wizard_v1');
			_formEl = KTUtil.getById('kt_form');

			initWizard();
			initValidation();
		}
	};
}();

jQuery(document).ready(function () {
	KTWizard1.init();
});
