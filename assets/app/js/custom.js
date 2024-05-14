/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
var FixedSidebarCustomScroll = function() {


    //
    // Setup module components
    //

    // Perfect scrollbar
    var _componentPerfectScrollbar = function() {
        if (typeof PerfectScrollbar == 'undefined') {
            console.warn('Warning - perfect_scrollbar.min.js is not loaded.');
            return;
        }

        // Initialize
        var ps = new PerfectScrollbar('.sidebar-fixed .sidebar-content', {
            wheelSpeed: 2,
            wheelPropagation: true
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentPerfectScrollbar();
        }
    }
}();
 
var DateTimePickers = function() {
	var _componentDaterange = function() {
        $('.daterange-single').daterangepicker({ 
            singleDatePicker: true,
			locale: {
                format: 'YYYY-MM-DD'
            }
        });
	};
	
	var _componentPickadate = function() {
		if (!$().pickadate) {
			console.warn('Warning - picker.js and/or picker.date.js is not loaded.');
			return;
		}
		
		$('.pickadate-disable-range').pickadate({
			disable: [
				5,
				[2013, 10, 21, 'inverted'],
				{ from: [2014, 3, 15], to: [2014, 3, 25] },
				[2014, 3, 20, 'inverted'],
				{ from: [2014, 3, 17], to: [2014, 3, 18], inverted: true }
			]
		});
	};
	
	return {
        init: function() {
            _componentPickadate();
			_componentDaterange();
        }
    }
}();

var Select2Selects = function() {
    var _componentSelect2 = function() {
		$('.select-search').select2();
	};
	
	return {
        init: function() {
            _componentSelect2();
        }
    }
}();

var FormWizard = function() {
    //
    // Setup module components
    //

    // Wizard
    var _componentWizard = function() {
        if (!$().steps) {
            console.warn('Warning - steps.min.js is not loaded.');
            return;
        }
		
		var form = $('.steps-basic');
		
		$('.steps-basic').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            transitionEffect: 'fade',
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> Sebelumnya',
                next: 'Selanjutnya <i class="icon-arrow-right14 ml-2" />',
                finish: 'Kirim Data <i class="icon-arrow-right14 ml-2" />'
            },
            onFinished: function (event, currentIndex) {
                form.submit();
            }
        });
		
		//
        // Wizard with validation
        //

        // Stop function if validation is missing
        if (!$().validate) {
            console.warn('Warning - validate.min.js is not loaded.');
            return;
        }

        // Show form
        var form = $('.steps-validation').show();


        // Initialize wizard
        $('.steps-validation').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> Sebelumnya',
                next: 'Selanjutnya <i class="icon-arrow-right14 ml-2" />',
                finish: 'Kirim Data <i class="icon-arrow-right14 ml-2" />'
            },
            transitionEffect: 'fade',
            autoFocus: true,
            onStepChanging: function (event, currentIndex, newIndex) {

                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }

                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {

                    // To remove error styles
                    form.find('.body:eq(' + newIndex + ') label.error').remove();
                    form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                }

                form.validate().settings.ignore = ':disabled,:hidden';
                return form.valid();
            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ':disabled';
				if(confirm("Anda yakin data sudah benar?")){
					form.submit();
				};
            },
            onFinished: function (event, currentIndex) {
                alert('Submitted!');
            }
        });


        // Initialize validation
        $('.steps-validation').validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-invalid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

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
                nik: {
                    minlength: 16,
					maxlength: 16,
                },
            },
            messages: {
				nik: {
                    required: "NIK harus diisi",
					minlength: jQuery.validator.format("NIK harus {0} karakter"),
					maxlength: jQuery.validator.format("NIK tidak boleh lebih {0} karakter"),
                },
            }
        });
    };

    // Uniform
    var _componentUniform = function() {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }
		
		$('.form-control-uniform').uniform();
		
        // Initialize
        $('.form-input-styled').uniform({
            fileButtonClass: 'action btn bg-success'
        });
    };

    // Select2 select
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        var $select = $('.form-control-select2').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });

        // Trigger value change when selection is made
        $select.on('change', function() {
            $(this).trigger('blur');
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentWizard();
            _componentUniform();
            _componentSelect2();
        }
    }
}();

var DatatableBasic = function() {


    //
    // Setup module components
    //

    // Basic Datatable examples
    var _componentDatatableBasic = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Ketik untuk memfilter...',
                lengthMenu: '<span>Tampil:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });

        // Basic datatable
        $('.datatable-admin').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
		});
		
		$('.datatable-negara').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 2 ]
            }],
		});
		
		$('.datatable-provinsi').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 2 ]
            }],
		});
		
		$('.datatable-kabupaten').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 4 ]
            }],
		});
		
		$('.datatable-kecamatan').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 2 ]
            }],
		});
		
		$('.datatable-desa').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 3 ]
            }],
		});
		
		$('.datatable-jalan').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 8 ]
            }],
		});
		
		$('.datatable-jenis').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 3 ]
            }],
		});
		
		$('.datatable-jukir').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 7 ]
            }],
		});
		
		$('.datatable-korlap').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
		});
		
		$('.datatable-jenisretribusi').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 6 ]
            }],
		});
		
		$('.datatable-tagihan').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 6 ]
            }],
		});
		
		$('.datatable-setoran').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
		});
		
		$('.datatable-lihatsetoran').DataTable({
			columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 7 ]
            }],
		});

        // Alternative pagination
        $('.datatable-pagination').DataTable({
            pagingType: "simple",
            language: {
                paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
            }
        });

        // Datatable with saving state
        $('.datatable-save-state').DataTable({
            stateSave: true
        });

        // Scrollable datatable
        var table = $('.datatable-scroll-y').DataTable({
            autoWidth: true,
            scrollY: 300
        });

        // Resize scrollable table when sidebar width changes
        $('.sidebar-control').on('click', function() {
            table.columns.adjust().draw();
        });
    };

    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableBasic();
        }
    }
}();

var Gallery = function() {


    //
    // Setup module components
    //

    // Lightbox
    var _componentFancybox = function() {
        if (!$().fancybox) {
            console.warn('Warning - fancybox.min.js is not loaded.');
            return;
        }

        // Image lightbox
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentFancybox();
        }
    }
}();

var InputsCheckboxesRadios = function () {


    //
    // Setup components
    //

    // Uniform
    var _componentUniform = function() {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        // Default initialization
        $('.form-check-input-styled').uniform();


        //
        // Contextual colors
        //

        // Primary
        $('.form-check-input-styled-primary').uniform({
            wrapperClass: 'border-primary-600 text-primary-800'
        });

        // Danger
        $('.form-check-input-styled-danger').uniform({
            wrapperClass: 'border-danger-600 text-danger-800'
        });

        // Success
        $('.form-check-input-styled-success').uniform({
            wrapperClass: 'border-success-600 text-success-800'
        });

        // Warning
        $('.form-check-input-styled-warning').uniform({
            wrapperClass: 'border-warning-600 text-warning-800'
        });

        // Info
        $('.form-check-input-styled-info').uniform({
            wrapperClass: 'border-info-600 text-info-800'
        });

        // Custom color
        $('.form-check-input-styled-custom').uniform({
            wrapperClass: 'border-indigo-600 text-indigo-800'
        });
    };


    return {
        initComponents: function() {
            _componentUniform();
        }
    }
}();

var FormValidation = function() {


    //
    // Setup module components
    //

    // Uniform
    var _componentUniform = function() {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.form-input-styled').uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    };


    // Select2 select
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        var $select = $('.form-control-select2').select2({
            minimumResultsForSearch: Infinity
        });

        // Trigger value change when selection is made
        $select.on('change', function() {
            $(this).trigger('blur');
        });
    };

    // Validation config
    var _componentValidation = function() {
        if (!$().validate) {
            console.warn('Warning - validate.min.js is not loaded.');
            return;
        }

        // Initialize
        var validator = $('.form-validate-jquery').validate({
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
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
            },

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
                    minlength: 5
                },
            },
            messages: {
                kepuasan: {
                    required: 'Mohon pilih salah satu jawaban'
                },
				kecepatan: {
                    required: 'Mohon pilih salah satu jawaban'
                },
                agree: 'Please accept our policy'
            }
        });

        // Reset form
        $('#reset').on('click', function() {
            validator.resetForm();
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentUniform();
            _componentSelect2();
            _componentValidation();
        }
    }
}();


	
// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
	FixedSidebarCustomScroll.init();
	DatatableBasic.init();
	FormWizard.init();
	DateTimePickers.init();
	Select2Selects.init();
	Gallery.init();
	InputsCheckboxesRadios.initComponents();
	FormValidation.init();
});