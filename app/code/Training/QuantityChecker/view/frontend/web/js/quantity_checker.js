define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';

    var self;

    return Component.extend({
        quantity: ko.observable(''),
        // showQuantity: ko.observable(false),

        isLoading: ko.observable(false),
        url: '',
        initialize: function () {
            self = this;

            this.showQuantity = ko.computed(function () {
                return ( self.quantity() + "").length > 0
            });

            this._super();
            return this;
        },

        hideQuantity: function () {
            self.quantity('');
        },
        quantityCheck: function () {
            this.isLoading(true);
            $.ajax({
                url: self.url,
                type: 'post',
                dataType: 'json'
            })
                .done(function (data) {
                    if (data.qty) {
                        self.quantity(data.qty);
                    }
                })
                .fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                    self.quantity('');
                })
                .always(function () {
                    self.isLoading(false);
                });
        }
    });
});