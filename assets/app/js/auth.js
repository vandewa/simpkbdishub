/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

 var LoginValidation = function() {
    var _componentUniform = function() {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        $('.form-input-styled').uniform();
    };

    var _componentValidation = function() {
        if (!$().validate) {
            console.warn('Warning - validate.min.js is not loaded.');
            return;
        }

        // Initialize
        var validator = $('.form-validate').validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
			
			/*
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
            },
			*/

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Unstyled checkboxes, radios
                if (element.parents().hasClass('form-check')) {
                    error.appendTo( element.parents('.form-check').parent() );
                }

                // Input with icons and Select2
                else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Input group, styled file input
                else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                // Other elements
                else {
                    error.insertAfter(element);
                }
            },
            rules: {
                password: {
                    minlength: 6,
                },
				rpassword: {
                    minlength: 6,
                },
				reppassword:{
					minlength: 6,
					equalTo: "#rpassword",
				}
            },
            messages: {
				nama: "Nama harus diisi",
				alamat: "Alamat harus diisi",
				pekerjaan: "pekerjaan harus diisi",
				telepon: "Nomor telepon harus diisi",
				rusername: "Username harus diisi",
				rpassword: {
                    required: "Password harus diisi",
                    minlength: jQuery.validator.format("Password harus lebih {0} karakter")
                },
				reppassword: {
					required: "Konfirmasi password harus diisi",
					equalTo: "Konfirmasi password tidak sama",
				},
                username: "Masukan username anda",
                password: {
                    required: "Masukan password anda",
                    minlength: jQuery.validator.format("Password harus lebih {0} karakter")
                }
            }
        });
    };


    return {
        init: function() {
            _componentUniform();
            _componentValidation();
        }
    }
}();

	
// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    LoginValidation.init();
});