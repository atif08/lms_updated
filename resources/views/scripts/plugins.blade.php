<script type="text/javascript">
    {{--  DATE RANGE PICKER START  --}}
    $.fn.dateRangePicker = function(callback, options = {}) {
        let ranges = {
            'Today'     : [moment(), moment()],
            'Yesterday' : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Days'    : [moment().subtract(6, 'days'), moment()],
            'This Week' : [moment().startOf('week'), moment().endOf('week')],
            'Last Week' : [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
            'This Year' : [moment().startOf('year'), moment()],
            '30 Days'   : [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }

        let startDate = moment($(this).data('start-date'));
        let endDate = moment($(this).data('end-date'));

        let settings = $.extend({
            alwaysShowCalendars: true,
            autoApply: true,
            opens: 'left',
            ranges: ranges,
            startDate: startDate,
            endDate: endDate
        }, options);

        $(this).daterangepicker(settings, function (start, end, label) {
            callback(start, end, label);
        });
    };
    {{--  DATE RANGE PICKER END  --}}

    $.fn.dataTableExt.oSort['numeric_ignore_nan-asc'] = function(x,y) {
        x = numericClean( x );
        y = numericClean( y );

        if (isNaN(x) && isNaN(y)) return 0;
        if (isNaN(x)) return 1;
        if (isNaN(y)) return -1;

        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    };

    $.fn.dataTableExt.oSort['numeric_ignore_nan-desc'] = function(x,y) {
        x = numericClean( x );
        y = numericClean( y );

        if (isNaN(x) && isNaN(y)) return 0;
        if (isNaN(x)) return 1;
        if (isNaN(y)) return -1;

        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
    };

    function numericClean(input) {
        if (typeof input === 'string') {
            if (input.indexOf('N/A') >= 0) {
                return 'N/A';
            }

            $.each([' ', '<br/>'], function (index, value) {
                input = input.split(value)[0];
            });

            if (input.endsWith('</span>')) {
                input = $(input).text();
            }

            input = input.replace(/[^\d\.\-]/g, '');
        }

        return parseFloat(input);
    }

    function success_alert(message) {
        return Swal.fire('Success', message, 'success');
    }

    function error_alert(message) {
        return Swal.fire('Error', message, 'error');
    }

    function delete_alert(text = 'You won\'t be able to revert this!') {
        return Swal.fire({
            title: 'Are you sure?',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        });
    }

    function displayValidationErrors(container, data) {
        if (container.find('.validation-container').length < 1) {
            container.prepend('<div class="validation-container"></div>');
        }

        const errors = data.responseJSON ? data.responseJSON.errors : data.errors;

        let html = '<ul class="list-unstyled">';

        $.each(errors, function (key, error) {
            html += '<li>- ' + error + '</li>';

            if (container.find('#' + key).length > 0) {
                container.find('#' + key).closest('.form-group').addClass('has-error');
            }
        });

        html += '</ul>';

        container.find('.validation-container').html(html);
    }

    function makeGetCall(url, data = {}, callback) {
        $.ajax({
            url: url,
            type: "GET",
            data: data,
            success: function (response) {
                if (response) {
                    callback(response);
                }
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function makePostCall(url, data = {}, success_cb, error_cb, isFormData = false) {
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            processData: !isFormData, // If it's FormData, don't process data
            contentType: isFormData ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (response) {
                if (response) {
                    success_cb(response);
                }
            },
            error: function (error) {
                if (error_cb) {
                    error_cb(error);
                }
            }
        });
    }

    function copy(text) {
        event.preventDefault();
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text);
        } else { // fallback solution for HTTP hosting
            const input = document.createElement('textarea')
            input.value = text
            document.body.appendChild(input)
            input.select()
            document.execCommand('copy')
            document.body.removeChild(input)
        }
        alertify.success("Copied: " + text);
    }

    $.fn.popper = function(options = {}) {
        options = $.extend({
            html: true,
            placement: 'top',
            animation: true,
            sanitize: false,
        }, options);

        $(this).popover(options);
    };

    $(document).ready(function() {
        $('[data-toggle="popover"]').popper();
    });

    // Global TinyMCE initializer — safe to call after AJAX loads
    window.initializeTinyMCE = function (selector) {
        selector = selector || 'textarea.elm1';
        tinymce.remove(selector);
        tinymce.init({
            selector: selector,
            height: 400,
            menubar: true,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image | code | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px; }',
        });
    };

    // Global Select2 initializer — safe to call after AJAX loads
    window.initializeSelect2 = function () {
        $('select:not(.no-select2)').each(function () {
            if (!$(this).hasClass('select2-hidden-accessible')) {
                $(this).select2({ width: '100%' });
            }
        });
    };

    $(document).ready(function () {
        initializeTinyMCE('textarea.elm1');
        initializeSelect2();
    });
</script>
