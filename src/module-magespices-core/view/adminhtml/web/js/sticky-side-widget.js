require([
    'jquery'
], function ($) {
    'use strict';
    let stickySideWidget = {
        init: function () {
            this.$widget = $('.js-sticky-side-widget');
            this.$btn = this.$widget.find('.js-sticky-side-widget-trigger');

            if (this.$widget.length) {
                this.widget()
            }
        },
        widget: function () {
            let that = this;

            that.$btn.on('click', function (e) {
                e.preventDefault();
                that.$widget.toggleClass('is-visible');
            });
            $(document).on('click', function (e) {
                e.stopPropagation();
                if (that.$widget.has(e.target).length === 0) {
                    that.$widget.removeClass('is-visible');
                }
            });
        }
    };
    stickySideWidget.init();
});