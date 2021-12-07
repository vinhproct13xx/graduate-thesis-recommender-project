var helper = new Helper();

function Helper() {
    var methods = this;

    methods.db = null;

    methods.createSlug = function (slug, space) {
        var space = space || '-';
        slug = '' + slug;
        slug = slug.toLowerCase();
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, space);
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        return slug;
    }

    methods.objectId = function () {
        return this.hex(Date.now() / 1000) + ' '.repeat(16).replace(/./g, () => this.hex(Math.random() * 16))
    }

    methods.hex = function (value) {
        return Math.floor(value).toString(16)
    }

    methods.formatMoney = function nFormatter(value) {
        if (value == '' || value == null) {
            return 0;
        }
        var text = String(value).floatText()
        var float_val = parseFloat(text);
        var splice = String(text).split('.');
        var result = String(splice[0]).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        if (splice.length > 1) {
            result += '.' + splice[1].substr(0, 2);
        }
        return result;
    }

    methods.formatNumber = function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    methods.boxFixed = function () {
        $(window).bind("load", function () {
            if ($(".box-fixed-top").length == 0) {
                return;
            } else {
                $('.div-mark-fixed').css('height', $('.box-fixed-top').outerHeight() - 19);
            }
        });
    };

    methods.windowResize = function () {
        $(window).resize(function () {
            if ($(".box-fixed-top").length == 0) {
                return;
            } else {
                $('.div-mark-fixed').css('height', $('.box-fixed-top').outerHeight() - 19);
            }
        });
    };

    methods.boxFixed();

    methods.windowResize();

    methods.formatDate = function (date, format) {
        var date = new Date(date),
            day = date.getDate(),
            month = date.getMonth() + 1,
            year = date.getFullYear(),
            hours = date.getHours(),
            minutes = date.getMinutes(),
            seconds = date.getSeconds();
        if (!format) {
            format = "dd/mm/yyyy";
        }
        format = format.replace("mm", month.toString().replace(/^(\d)$/, '0$1'));
        if (format.indexOf("yyyy") > -1) {
            format = format.replace("yyyy", year.toString());
        } else if (format.indexOf("yy") > -1) {
            format = format.replace("yy", year.toString().substr(2, 2));
        }
        format = format.replace("dd", day.toString().replace(/^(\d)$/, '0$1'));
        if (format.indexOf("t") > -1) {
            if (hours > 11) {
                format = format.replace("t", "pm");
            } else {
                format = format.replace("t", "am");
            }
        }
        if (format.indexOf("HH") > -1) {
            format = format.replace("HH", hours.toString().replace(/^(\d)$/, '0$1'));
        }
        if (format.indexOf("hh") > -1) {
            if (hours > 12) {
                hours -= 12;
            }
            if (hours === 0) {
                hours = 12;
            }
            format = format.replace("hh", hours.toString().replace(/^(\d)$/, '0$1'));
        }
        if (format.indexOf("mm") > -1) {
            format = format.replace("mm", minutes.toString().replace(/^(\d)$/, '0$1'));
        }
        if (format.indexOf("ss") > -1) {
            format = format.replace("ss", seconds.toString().replace(/^(\d)$/, '0$1'));
        }
        return format;
    }

    methods.createId = function () {
        var idStrLen = 32;
        var idStr = (Math.floor((Math.random() * 25)) + 10).toString(36) + "_";
        idStr += (new Date()).getTime().toString(36) + "_";
        do {
            idStr += (Math.floor((Math.random() * 35))).toString(36);
        } while (idStr.length < idStrLen);

        return (idStr);
    }

    methods.createCode = function () {
        var idStrLen = 10;
        // var idStr = (Math.floor((Math.random() * 25)) + 10).toString(36) + "_";
        // idStr += (new Date()).getTime().toString(36) + "_";
        idStr = (new Date()).getTime().toString(36);
        do {
            idStr += (Math.floor((Math.random() * 35))).toString(36);
        } while (idStr.length < idStrLen);

        return (idStr.toUpperCase());
    }

    methods.showNotification = function (message, type,time, icon) {
        icon = icon == null ? '' : icon;
        type = type == null ? 'info' : type;
        time = time == null ? 5000 : time;
        $('.system_message').addClass('show').addClass(type);
        $('.system_message').find('.title').html(message);
        setTimeout(function () {
            $('.system_message').removeClass('show').removeClass(type);
            $('.system_message')
        }, time)

    }

    return this;
}





