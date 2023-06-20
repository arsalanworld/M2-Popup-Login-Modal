define([
    'Magento_Customer/js/view/authentication-popup',
    'Know_Module/js/action/fetch-registration-form',
    'jquery'
], function (Component, FetchRegistrationForm, $) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();

            let self = this;
            $(document).on('submit', '#create-customer-popup form', function () {
                let registrationFormEl = $('#create-customer-popup form');
                $.post({
                    data: registrationFormEl.serializeArray(),
                    url: registrationFormEl.attr('action'),
                    success: function (response) {
                        if (response.redirect) {
                            document.location.replace(response.redirect);
                        }
                    },
                    complete: function (response) {
                        // Remove disabled attribute from submit button
                        $('#create-customer-popup form .action.submit').removeAttr('disabled');
                        self.isRegistrationFormVisible(false);
                    }
                });
            });
        },

        /**
         * @return {exports.initObservable}
         */
        initObservable: function () {
            this._super()
                .observe({
                    isRegistrationFormVisible: false,
                    formData: false
                });

            let self = this;
            this.isRegistrationFormVisible.subscribe(function (isVisible) {
                if (isVisible) {
                    FetchRegistrationForm().done(function (response) {
                        self.formData(response.data);
                        $('body').trigger('contentUpdated');
                        $('#create-customer-popup form').attr('onsubmit','return false;');
                    });
                }
            }, this);
            return this;
        },

        showRegistrationForm: function () {
            this.isRegistrationFormVisible(true);
        }
    });
});
