define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';
    return Component.extend({
        quantity: ko.observable(''),
        showQuantity: ko.observable(false),
        // showQuantity: ko.computed(function()
        // {
        //     return this.quantity.length > 0;
        // }),
        isLoading: ko.observable(false),
        url: '',
        initialize: function () {
            this._super();
            return this;
        },
        quantityCheck: function () {
            this.isLoading(true);
            var self = this;
            $.ajax({
                url: self.url,
                type: 'post',
                dataType: 'json'})
                .done(function (data) {
                    if (data.qty ) {
                        self.quantity(data.qty);
                    }
                })
                .fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                    self.quantity('');
                })
                .always(function () {
                self.isLoading(false);
            });
        }
    });
});