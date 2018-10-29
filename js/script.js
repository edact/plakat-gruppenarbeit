$(function () {
    $.getJSON("getData.php").done(function (json) {
        $('.fillable').each(function () {
            updateFillable($(this), json[$(this).data('identifier')]);

            $(this).css('top', json[$(this).data('identifier')]['top']);
            $(this).css('left', json[$(this).data('identifier')]['left']);

            $(this).css('width', json[$(this).data('identifier')]['width']);
            $(this).css('height', json[$(this).data('identifier')]['height']);
        });
    });
});
setInterval(function () {
    $.getJSON("getData.php").done(function (json) {
        $('.fillable[readonly]').each(function () {
            updateFillable($(this), json[$(this).data('identifier')]);

            $('.wrapper:not(.master):not(.editor) .fillable[readonly]').each(function () {
                $(this).css('top', json[$(this).data('identifier')]['top']);
                $(this).css('left', json[$(this).data('identifier')]['left']);
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
    if ($(fillable).hasClass('fillable-text')) {
        $(fillable).children('textarea').val(json['data']);
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

    $('.fillable-emoji[data-identifier="' + $(this).parent('.emoji-list').data('input') + '"]').attr('class', 'fillable fillable-emoji em');
    $('.fillable-emoji[data-identifier="' + $(this).parent('.emoji-list').data('input') + '"]').addClass($(this).data('value'));

    $(this).parent('.emoji-list').css('display', 'none');
});

//save images
$('.image-list .image-item').click(function () {
    setData($(this).parent('.image-list').data('input'), 'data', $(this).data('value'));

    $('.fillable-image[data-identifier="' + $(this).parent('.image-list').data('input') + '"]').css('background-image', 'url(' + $(this).data('value') + ')');

    $(this).parent('.image-list').css('display', 'none');
});

//display emoji-picker
$('.fillable-emoji:not([readonly])').click(function () {
    $('.emoji-list[data-input="' + $(this).data('identifier') + '"]').css('display', 'flex');
});

//display image-picker
$('.fillable-image:not([readonly])').click(function () {
    $('.image-list[data-input="' + $(this).data('identifier') + '"]').css('display', 'flex');
});

$(".wrapper.master .fillable, .wrapper.editor .fillable").draggable({
    cancel: "",
    stop: function () {
        setData($(this).data('identifier'), 'top', $(this).css('top'));
        setData($(this).data('identifier'), 'left', $(this).css('left'));
    }
});

$(".wrapper.editor .fillable").resizable({
    cancel: "",
    stop: function () {
        setData($(this).data('identifier'), 'width', $(this).css('width'));
        setData($(this).data('identifier'), 'height', $(this).css('height'));
    }
});