/**
 * Created by ali on 04.11.17.
 */

App = {
    send: function () {
        $.getJSON("/site", $('#frm').serialize(), function (data) {
            if (data.resp == true) {
                history.pushState(null, null, "?" + $('#frm').serialize());

                $(Table.OBJ_NAME).find('tbody tr').remove();
                $(Table.OBJ_NAME).find('tbody').html(data.view);
                Table.init('.tbl-data');
            }
        });
    },
    sound: {
        AUDIO: new Audio(),
        play: function (src) {
            this.AUDIO.src = src;
            this.AUDIO.play();
        },
        pause: function (src) {
            this.AUDIO.src = src;
            this.AUDIO.pause();
        },
    },
    cart: {
        add: function () {
            var tbl = $(Table.OBJ_NAME);
            var tr = tbl.find('tbody tr');
            var data = [];
            tr.each(function () {
                if ($(this).find('td.chkbx input').is(':checked')) {
                    data.push($(this).data('id'));
                }
            });
            if (data.length > 0) {
                $.post("/cart/add", {data: data}, function (res) {
                    if (res.resp == true) {
                        alert('Добавленов корзину');
                        $('#cartCount').html(res.counts);
                    } else {
                        alert('Что-то пошло не так... Попробуйте по позже...');
                    }
                });
            }
        },
        remove: function () {
            var tbl = $(Table.OBJ_NAME);
            var tr = tbl.find('tbody tr');
            var data = [];
            tr.each(function () {
                if ($(this).find('td.chkbx input').is(':checked')) {
                    data.push($(this).data('id'));
                }
            });
            if (data.length > 0) {
                $.post("/cart/clear", {data: data}, function (res) {
                    if (res.resp == true) {
                        $('#cartCount').html(res.counts);
                        tr.each(function () {
                            if ($(this).find('td.chkbx input').is(':checked')) {
                                $(this).remove();
                            }
                        });
                    }
                });
            }
        }
    },
    excel: {
        exports: function () {
            var tbl = $(Table.OBJ_NAME);
            var tr = tbl.find('tbody tr');
            var data = [];
            tr.each(function () {
                if ($(this).find('td.chkbx input').is(':checked')) {
                    data.push($(this).data('id'));
                }
            });
            if (data.length > 0) {
                $.getJSON("/site/excel", {data: data}, function (res) {
                    if (res.resp==true) {
                        var $a = $("<a>");
                        $a.attr("href",res.file);
                        $("body").append($a);
                        $a.attr("download","tones.xls");
                        $a[0].click();
                        $a.remove();
                    }
                });
            }
        }
    }

}