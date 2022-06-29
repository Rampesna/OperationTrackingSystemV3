const months = [
    {
        id: 1,
        name: 'Ocak'
    },
    {
        id: 2,
        name: 'Şubat'
    },
    {
        id: 3,
        name: 'Mart'
    },
    {
        id: 4,
        name: 'Nisan'
    },
    {
        id: 5,
        name: 'Mayıs'
    },
    {
        id: 6,
        name: 'Haziran'
    },
    {
        id: 7,
        name: 'Temmuz'
    },
    {
        id: 8,
        name: 'Ağustos'
    },
    {
        id: 9,
        name: 'Eylül'
    },
    {
        id: 10,
        name: 'Ekim'
    },
    {
        id: 11,
        name: 'Kasım'
    },
    {
        id: 12,
        name: 'Aralık'
    }
];

Inputmask({mask: "(999) 999-9999"}).mask(".phoneMask");

Inputmask({mask: "9999 9999 9999 9999"}).mask(".creditCardMask");

Inputmask({
    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
    greedy: false,
    onBeforePaste: function (pastedValue, opts) {
        pastedValue = pastedValue.toLowerCase();
        return pastedValue.replace("mailto:", "");
    },
    definitions: {
        "*": {
            validator: '[0-9A-Za-z!#$%&"*+/=?^_`{|}~\-]',
            cardinality: 1,
            casing: "lower"
        }
    }
}).mask(".emailMask");

function initializeMoneyInputMask() {
    Inputmask({
        mask: "*{1,20}.*{2,4}",
        definitions: {
            "*": {
                validator: '[0-9]',
                cardinality: 1,
                casing: "lower"
            },
        },
        placeholder: "0",
    }).mask(".moneyMask");
}

function groupBy(array, key) {
    return array.reduce((result, obj) => {
        (result[obj[key]] = result[obj[key]] || []).push(obj);
        return result;
    }, {});
}

function initializeCurrencyInputMask() {
    Inputmask({
        mask: "*{1,20}.*{8,8}",
        definitions: {
            "*": {
                validator: '[0-9]',
                cardinality: 1,
                casing: "lower"
            },
        },
        placeholder: "0",
    }).mask(".currencyMask");
}

initializeMoneyInputMask();
initializeCurrencyInputMask();

$('.decimal').on("copy cut paste drop", function () {
    return false;
}).keyup(function () {
    var val = $(this).val();
    if (isNaN(val)) {
        val = val.replace(/[^0-9\.]/g, '');
        if (val.split('.').length > 2)
            val = val.replace(/\.+$/, "");
    }
    $(this).val(val);
});

$(".onlyNumber").keypress(function (e) {
    if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function reformatDateForCalendar(date) {
    var formattedDate = new Date(date);
    return formattedDate.getFullYear() + '-' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '-' +
        String(formattedDate.getDate()).padStart(2, '0') + 'T' +
        String(formattedDate.getHours()).padStart(2, '0') + ':' +
        String(formattedDate.getMinutes()).padStart(2, '0') + ':00';
}

function reformatDatetime(date) {
    var formattedDate = new Date(date);
    return formattedDate.getFullYear() + '-' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '-' +
        String(formattedDate.getDate()).padStart(2, '0') + ' ' +
        String(formattedDate.getHours()).padStart(2, '0') + ':' +
        String(formattedDate.getMinutes()).padStart(2, '0') + ':' +
        String(formattedDate.getSeconds()).padStart(2, '0');
}

function reformatDatetimeTo_YYYY_MM_DD_WithDot(date) {
    var formattedDate = new Date(date);
    return formattedDate.getFullYear() + '.' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '.' +
        String(formattedDate.getDate()).padStart(2, '0');
}

function reformatDatetimeTo_YYYY_MM_DD(date) {
    var formattedDate = new Date(date);
    return formattedDate.getFullYear() + '-' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '-' +
        String(formattedDate.getDate()).padStart(2, '0');
}

function reformatDatetimeTo_DD_MM_YYYY_WithDot(date) {
    var formattedDate = new Date(date);
    return String(formattedDate.getDate()).padStart(2, '0') + '.' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '.' +
        formattedDate.getFullYear();
}

function reformatDatetimeTo_DD_MM_YYYY_HH_ii_WithDot(date) {
    var formattedDate = new Date(date);
    return String(formattedDate.getDate()).padStart(2, '0') + '.' +
        String(formattedDate.getMonth() + 1).padStart(2, '0') + '.' +
        formattedDate.getFullYear() + ', ' +
        String(formattedDate.getHours()).padStart(2, '0') + ':' +
        String(formattedDate.getMinutes()).padStart(2, '0');
}

function reformatDatetimeToDateForHuman(date) {
    var formattedDate = new Date(date);
    return String(formattedDate.getDate()).padStart(2, '0') + ' ' +
        months.find(date => date.id === formattedDate.getMonth() + 1).name + ', ' +
        formattedDate.getFullYear();
}

function reformatDatetimeToDatetimeForHuman(date) {
    var formattedDate = new Date(date);
    return String(formattedDate.getDate()).padStart(2, '0') + ' ' +
        months.find(date => date.id === formattedDate.getMonth() + 1).name + ', ' +
        formattedDate.getFullYear() + ' ' +
        String(formattedDate.getHours()).padStart(2, '0') + ':' +
        String(formattedDate.getMinutes()).padStart(2, '0');
}

function reformatInvoiceNumber(datetime, number) {
    return (new Date(datetime)).getFullYear() + '-' + number.padStart(9, '0');
}

$.sum = function (arr) {
    var r = 0;
    $.each(arr, function (i, v) {
        r += +v;
    });
    return r;
}

function reformatNumberToMoney(number) {
    return parseFloat(number).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
}

function detectMobile() {
    if (navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)
    ) {
        return true;
    } else {
        return false;
    }
}

function checkScreen() {
    if (detectMobile() || $(window).width() < 950) {
        $('.showIfMobile').show();
        $('.hideIfMobile').hide();
        $('#DashboardQuickActions').hide();
        $('#defaultFooter').hide();
        $('#mobileFooter').show();

        $('#kt_body').swipe({
            swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                if (detectMobile() && distance > 150) {
                    if (direction === 'right') {
                        $('#kt_aside_mobile_toggle').trigger('click');
                    }

                    if (direction === 'left' && $('#kt_aside').hasClass('drawer-on')) {
                        $('#kt_aside_mobile_toggle').trigger('click');
                    }
                }
            },
            threshold: 1,
            fingers: 'all',
            allowPageScroll: 'vertical',
        });
    } else {
        $('.showIfMobile').hide();
        $('.hideIfMobile').show();
        $('#DashboardQuickActions').show();
        $('#defaultFooter').show();
        $('#mobileFooter').hide();

    }

    // if (detectMobile()) {
    //     $('#kt_aside_menu_wrapper').removeClass('top-0').addClass('top-25');
    // } else {
    //     $('#kt_aside_menu_wrapper').removeClass('top-25').addClass('top-0');
    // }
}

$(window).resize(function () {
    checkScreen();
});

checkScreen();

$('.modal').on('shown.bs.modal', function (e) {
    $(this).find('.select2Input').select2({
        dropdownParent: $(this).find('.modal-content')
    });
});
