/*
Template Name: Minible - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Form wizard Js File
*/

window.importWizard = undefined;

function submitImportForm(container, form, formData) {
    makePostCall(form.action, formData, function (response) {
        let html = $(response);
        $('#import-wizard #step1-form').html(html.find('#step1-form').html());
        $('#import-wizard #step2-form').html(html.find('#step2-form').html());
        window.importWizard.steps('next');
    }, function (response) {
        displayValidationErrors(container, response);
    }, true);
}

function submitMappings(container, form, formData) {
    makePostCall(form.action, formData, function (response) {
        success_alert(response.message);
        $('.btn-close').click();
        redrawDataTable();
    }, function (response) {
        displayValidationErrors(container, response);
    }, true);
}

function loadImportWizard(step = 0) {
    window.importWizard = $("#import-wizard").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slide",
        labels: {finish: "Submit"},
        onInit : function (event, currentIndex) {
            $("#import-wizard").find('a[href="#previous"]').hide();
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > 0) {
                return false;
            }

            let container = $('#import-wizard .file-import-form');
            let form = container[0];
            let formData = new FormData(form);
            let import_id = formData.get('import_id');

            if (import_id != null) {
                return true;
            }

            let fileInput = formData.get('file');
            if (fileInput instanceof File && fileInput.size > 0) {
                submitImportForm(container, form, formData);
            } else {
                displayValidationErrors(container,
                    {errors: {file: ["The Import File * field is required."]}});
            }

            return false;
        },
        onFinishing: function (e, currentIndex) {
            let container = $('#import-wizard .mappings-form');
            let form = container[0];
            let formData = new FormData(form);
            submitMappings(container, form, formData);
            return false;
        },
    });

    if (step > 0) {
        window.importWizard.steps('next');
    }
}

function destroyImportWizard() {
    if (window.importWizard) {
        window.importWizard.steps('destroy');
    }
}


