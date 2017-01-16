var ComponentsPickers = function () {
	
	var handleDatePickers = function () {

        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true
            });
        }
    }
	
    var handleDatetimePicker = function () {

        if (!jQuery().datetimepicker) {
            return;
        }

        $(".form_datetime").datetimepicker({
            autoclose: true,
            isRTL: Metronic.isRTL(),
            format: "yyyy-mm-dd hh:ii:ss",
			todayBtn: true,
			startDate: "2013-01-01 00:00:00",
            pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left"),
			minuteStep: 10
        });
    }
	
    return {
        //main function to initiate the module
        init: function () {
            handleDatePickers();
            handleDatetimePicker();
        }
    };

}();