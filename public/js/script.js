$(document).keyup(function(e) {
    if (e.keyCode === 27) {
        $('#close').click();
    }
});
function ShowHistory(id) {
    jQuery.ajax({
        url: '/history/',
        data: { car : id },
        success: function (result) {
            $('#invisible .content').empty();
            $('#invisible .content').html(result);
            $('#invisible').css('display', 'block');
        },
    });
    return false;
}

function formatDate(obj) {
    if (obj.month.length == 1) {
        obj.month = '0'+obj.month;
    }
    if (obj.day.length == 1) {
        obj.day = '0'+obj.day;
    }
    if (obj.hour == undefined || obj.hour == '') {
        obj.hour = "00";
    }
    if (obj.min == undefined || obj.min == '') {
        obj.min="00";
    }

    return obj.year +'-'+ obj.month +'-'+ obj.day +" "+ obj.hour +":"+ obj.min;
}

function betweenDate() {
    var tmonth = $('#history_dates_took_date_month option:selected').val();
    var tday = $('#history_dates_took_date_day option:selected').text();
    var tyear = $('#history_dates_took_date_year option:selected').text();
    var thour = $('#history_dates_took_date_hour option:selected').text();
    var tmin = $('#history_dates_took_time_minute option:selected').text();
    var tookdate = formatDate({
        'month': tmonth,
        'day': tday,
        'hour': thour,
        'min' : tmin,
        'year' : tyear
    });

    var gmonth = $('#history_dates_gave_date_month option:selected').val();
    var gday = $('#history_dates_gave_date_day option:selected').text();
    var gyear = $('#history_dates_gave_date_year option:selected').text();
    var ghour = $('#history_dates_gave_date_hour option:selected').text();
    var gmin = $('#history_dates_gave_time_minute option:selected').text();
    var gavedate = formatDate({
        'month': gmonth,
        'day': gday,
        'hour': ghour,
        'min' : gmin,
        'year' : gyear
    });

    jQuery.ajax({
        url: '/history/',
        data: {
            'car' : $('#auto_id').val(),
            'date-from' : tookdate,
            'date-to' : gavedate,
        },
        success: function (result) {
            $('#invisible .content').empty();
            $('#invisible .content').html(result);
            $('#invisible').css('display', 'block');
            $('#invisible').scrollTop($(document).height());
            return false;
        },
    });
    return false;
}

function ClosePanel() {
    $('#invisible').css('display', 'none');
}

// auto select car
$( document ).ready(function() {
    if ($('#history_auto') !== undefined) {
        if (window.location.href.indexOf('history/new?id=')+1 !== 0) {
            var auto_id = window.location.search.replace(/[^-0-9]/gim,'');
            $("#history_auto").val(auto_id).change();
        }
    }
});