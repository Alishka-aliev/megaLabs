/**
 * Created by ali on 01.11.17.
 */
Table = {
    OBJ_NAME: "table",
    //Инициализация таблицы,поднятие всех данных.
    init: function (selector) {
        this.OBJ_NAME = selector;
        highlight.on(this.getObj("td"), 'highlight');
        check.on(this.getObj("td"));
        $(this.OBJ_NAME +' input.chckAll').on('click',function(){
            $('input:checkbox').prop('checked', this.checked);
        });
    },
    getObj: function (tag) {
        tag = typeof tag !== 'undefined' ? tag : "";
        var obj = this.OBJ_NAME;
        return $(obj + " " + tag);
    }
}
//Подсветка.
var highlight = {
    on: function ($obj, cls) {
        cls = typeof cls !== 'undefined' ? cls : "";
        $obj.click(function () {
            $(this).closest('div').find('.' + cls).removeClass(cls);
            var selected = $(this).hasClass(cls);
            $(this).removeClass(cls);
            if (!selected)
                $(this).addClass(cls);
        });
    }
}

//клик, при клике на ячейку
var check = {
    on: function ($obj) {
        $obj.click(function () {
            var selected = $(this).find('input[type="text"]');
            selected.trigger('click');
        });
    }
}