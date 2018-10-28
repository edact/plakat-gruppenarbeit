$(function () {
    $.getJSON("getData.php").done(function (json) {
        $('.fillable').each(function () {
            updateFillable($(this), json[$(this).attr('id')]);

            $(this).css('top', json[$(this).attr('id')]['top']);
            $(this).css('left', json[$(this).attr('id')]['left']);
        });
    });
});
setInterval(function () {
    $.getJSON("getData.php").done(function (json) {
        $('.fillable[readonly]').each(function () {
            updateFillable($(this), json[$(this).attr('id')]);

            $('.wrapper:not(.master) .fillable').each(function () {
                $(this).css('top', json[$(this).attr('id')]['top']);
                $(this).css('left', json[$(this).attr('id')]['left']);
            });
        });
    });
}, 250);


//save data to file
function setData(key, type, value) {
    $.post("setData.php", {
        key: key,
        type: type,
        value: value
    });
}

function updateFillable(fillable, json) {
    console.log($(fillable).hasClass('fillable-text'));
    if ($(fillable).hasClass('fillable-text')) {
        $(fillable).val(json['data']);
    }

    if ($(fillable).hasClass('fillable-emoji')) {
        $(fillable).removeClass($(fillable).data('value'));
        $(fillable).data('value', json['data']);
        $(fillable).addClass(json['data']);
    }

    if ($(fillable).hasClass('fillable-image')) {
        $(fillable).css('background-image', 'url(' + json['data'] + ')');
    }
}

//save text
$('textarea').keyup(function () {
    setData($(this).attr('id'), "data", $(this).val())
});

//save emojis
$('.emoji-list .em').click(function () {
    setData($(this).parent('.emoji-list').data('input'), 'data', $(this).data('value'));

    $('.fillable-emoji[id="' + $(this).parent('.emoji-list').data('input') + '"]').attr('class', 'fillable fillable-emoji em');
    $('.fillable-emoji[id="' + $(this).parent('.emoji-list').data('input') + '"]').addClass($(this).data('value'));

    $(this).parent('.emoji-list').css('display', 'none');
});

//save images
$('.image-list .image-item').click(function () {
    setData($(this).parent('.image-list').data('input'), 'data', $(this).data('value'));

    $('.fillable-image[id="' + $(this).parent('.image-list').data('input') + '"]').css('background-image', 'url(' + $(this).data('value') + ')');

    $(this).parent('.image-list').css('display', 'none');
});

//display emoji-picker
$('.fillable-emoji:not([readonly])').click(function () {
    $('.emoji-list[data-input="' + $(this).attr('id') + '"]').css('display', 'flex');
});

//display image-picker
$('.fillable-image:not([readonly])').click(function () {
    $('.image-list[data-input="' + $(this).attr('id') + '"]').css('display', 'flex');
});

$(".wrapper.master .fillable").draggable({
    cancel: "",
    stop: function () {
        setData($(this).attr('id'), 'top', $(this).css('top'));
        setData($(this).attr('id'), 'left', $(this).css('left'));
    }
});