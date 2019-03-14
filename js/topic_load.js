window.onscroll = function () {
    getSearchIds();
    showItems();
}
var show_array = []; // 显示的所有pids
var send_status = 1; // 发送状态 默认允许发
function getSearchIds() {
    var items = $(".imgList").find(".imgItem");
    var len = items.length;
    var start = 0;
    for (var i = start; i < len; i++) {
        var elem = items[i];
        if ($(elem).offset().top <= $(window).height() + $(window).scrollTop() && $(elem).offset().top + $(elem).outerHeight() > $(window).scrollTop()) {

            var img = $(elem).find("img");
            var pid = $(img).parent().attr("data-id");
            var is_has = show_array.indexOf(pid);
            if (is_has < 0) {
                show_array.push(pid);
            }
            start = i;
            send_status = 0;
        }
        else {
            if ($(elem).offset().top > $(window).height() + $(window).scrollTop()) {
                send_status = 1;
                break;
            }
        }
    }
    // 解决只有一排数据不发送的问题
    if (len <= 5 && len > 0) {
        send_status = 1;
    }
}

function showItems() {
    var items = $(".imgList").find(".imgItem");
    var len = items.length;
    var start = 0;
    for (var i = start; i < len; i++) {
        var elem = items[i];
        if ($(elem).offset().top < $(window).height() + $(window).scrollTop() && $(elem).offset().top + $(elem).outerHeight() > $(window).scrollTop()) {

            var img = $(elem).find("img");
            if (!$(img).attr("src")) {
                $(img).attr("src", $(img).attr("data-original")).fadeIn();
                start = i;
            }
        }
        else {
            if ($(elem).offset().top > $(window).height() + $(window).scrollTop()) {
                break;
            }
        }
    }
}

function setPiclistSize() {
    $(".imgList").Huiphoto({
        wraperWidth: "auto",
        item: ".imgItem",
        margin: 50,
        extra: 0
    });
}

$(function () {
    setPiclistSize();
    showItems();
    $(window).resize(function () {
        setPiclistSize();
    });
    $('.collect-topic').on('click', function (e) {
        var topic_id = $(this).attr('data-topic-id');
        $.ajax({
            url: 'http://meisupic.com/collect_topic.php?id=' + topic_id,
            type: 'get',
            success: function (returndata) {
                var data = jQuery.parseJSON(returndata);
                switch (parseInt(data["code"])) {
                    case -4:
                        dialog('您已收藏该专辑', 1);
                        break;
                    case -3:
                        dialog('系统错误，缺少id', 1);
                        break;
                    case -2:
                        dialog('请先登录', 1);
                        break;
                    case 1:
                        layer.closeAll();
                        dialog(data["message"], 1);
                        location.reload();
                        break;
                    default:
                        layer.closeAll();
                        dialog('系统错误', 1);
                }
            },
            error: function () {
                layer.closeAll();
                dialog('系统错误', 1);
            }
        })
    });
});