(function () {
    var
    scrollSetp = 500,//menu左右按钮每次滑动的像素
    operationWidth = 90,//menu操作按钮的总宽度
    leftOperationWidth = 30,//左侧按钮的宽度
    animatSpeed = 150,//切换动画速度

    linkframe = function (url, value) {
        /**
         * 切换选中的菜单
         * @param url url地址
         * @param value 菜单显示的名称
         */
        //激活iframe
        $("#menu-list a.active").removeClass("active");
        $("#menu-list a[data-url='" + url + "'][data-value='" + value + "']").addClass("active");

        //激活menu
        $("#page-content iframe.active").removeClass("active");
        $("#page-content .iframe-content[data-url='" + url + "'][data-value='" + value + "']").addClass("active");

        //激活所有菜单中的li
        $("#menu-all-ul li.active").removeClass("active");
        $("#menu-all-ul li[data-url='" + url + "'][data-value='" + value + "']").addClass("active");


    },
    move = function (selDom) {
        /**
         * 点击已存在的menu 时 调整menu显示区域
         * @param selDom 触发的菜单dom元素
         */
        var nav = $("#menu-list");//menu list对象
        var releft = selDom.offset().left; //元素顶端到可见区域左侧的距离
        var wwidth = parseInt($("#page-tab").width());
        var left = parseInt(nav.css("margin-left"));

        if (releft < 0 && releft <= wwidth) {
            nav.animate({ "margin-left": (left - releft + leftOperationWidth) + "px" }, animatSpeed);
        } else if (releft + selDom.width() > wwidth - operationWidth) {
            nav.animate({ "margin-left": (left - releft + wwidth - selDom.width() - operationWidth) + "px" }, animatSpeed);
        }
    },
    createmove = function () {
        /**
         * 创建新menu时 调整menu显示区域
         */
        var nav = $("#menu-list");//menu list对象
        var wwidth = parseInt($("#page-tab").width());
        var navwidth = parseInt(nav.width());

        if (wwidth - operationWidth < navwidth) {
            nav.animate({ "margin-left": "-" + (navwidth - wwidth + operationWidth) + "px" }, animatSpeed);
        }
    },
    closemenu = function () {
        /**
         * 关闭当前菜单
         */
        $(this.parentElement).animate({ "width": "0", "padding": "0" }, 0, function () {

            var jthis = $(this);

            if (jthis.hasClass("active")) {
                //active后一个菜单，如果当前为最后一个菜单，则active前一个菜单
                var linext = jthis.next();
                if (linext.length > 0) {
                    linext.click();
                    move(linext);
                } else {
                    var liprev = jthis.prev();
                    if (liprev.length > 0) {
                        liprev.click();
                        move(liprev);
                    }
                }
            }

            //移除当前dom元素
            this.remove();
            $("#page-content .iframe-content[data-url='" + jthis.data("url") + "'][data-value='" + jthis.data("value") + "']").remove();

        });
        //阻止事件向上冒泡到 DOM 树，阻止任何父处理程序被事件通知
        event.stopPropagation();
    },
    init = function (opts) {
        /**
         * 初始化菜单控件
         */
        //前翻页事件
        $("#page-prev").bind("click", function () {

            var nav = $("#menu-list");//menu list对象
            var left = parseInt(nav.css("margin-left"));

            if (left !== 0) {
                nav.animate({ "margin-left": (left + scrollSetp > 0 ? 0 : (left + scrollSetp)) + "px" }, animatSpeed);
            }
        });
        //向后翻页事件
        $("#page-next").bind("click", function () {
            var nav = $("#menu-list");//menu list对象
            var left = parseInt(nav.css("margin-left"));

            var wwidth = parseInt($("#page-tab").width());
            var navwidth = parseInt(nav.width());

            var allshowleft = -(navwidth - wwidth + operationWidth);

            if (allshowleft !== left && navwidth > wwidth - operationWidth) {
                var temp = (left - scrollSetp);
                nav.animate({ "margin-left": (temp < allshowleft ? allshowleft : temp) + "px" }, animatSpeed);
            }
        });
        //所有菜单按钮点击事件
        $("#page-operation").bind("click", function () {
            var menuall = $("#menu-all");
            if (menuall.is(":visible")) {
                menuall.hide();
            } else {
                menuall.show();
            }
        });
        //注册点击body隐藏所有菜单事件
        $("body").bind("mousedown", function (event) {
            if (!(event.target.id === "menu-all" || event.target.id === "menu-all-ul" || event.target.id === "page-operation" || event.target.id === "page-operation" || event.target.parentElement.id === "menu-all-ul")) {
                $("#menu-all").hide();
            }
        });
        //创建默认
        if(opts.defaultTab){
            buildDefaultTab(opts.defaultTab,opts.defaultUrl,opts.defaultIcon);
        }

    },
    buildTab=function(allowClose){
        allowClose=allowClose==undefined?true:allowClose;
        //链接地址
        var linkUrl = this.href;
		 var icon = $(this).attr("icon");
        //链接文字
        var linkHtml = this.text.trim();

        var selDom = $("#menu-list a[data-url='" + linkUrl + "'][data-value='" + linkHtml + "']");
        if (selDom.length === 0) {
            /**
             *没有创建过menu和显示Iframe，创建
             */
  
            //创建menu,绑定点击事件
            var iel =allowClose? $("<i>", { "class": "menu-close" }).bind("click", closemenu):$("<span>");
			var iconhtml=""
			if(icon){
				iconhtml+="<i class='"+icon+"'></i>&nbsp;";
				}
			
            $("<a>", {
                "html": iconhtml+linkHtml,
                "href": "javascript:void(0);",
                "data-url": linkUrl,
                "data-value": linkHtml
            }).bind("click", function () {
                var jthis = $(this);
                linkframe(jthis.data("url"), jthis.data("value"));
            }).append(iel).appendTo("#menu-list");

            //创建iframe
            $("<iframe>", {
                "class": "iframe-content",
                "data-url": linkUrl,
                "data-value": linkHtml,
                src: linkUrl
            }).appendTo("#page-content");

            //创建所有菜单列表
            $("<li>", {
                "html": linkHtml,
                "data-url": linkUrl,
                "data-value": linkHtml
            }).bind("click", function () {
                var jthis = $(this);
                linkframe(jthis.data("url"), jthis.data("value"));
                move($("#menu-list a[data-url='" + linkUrl + "'][data-value='" + linkHtml + "']"));
                $("#menu-all").hide();
                event.stopPropagation();
            }).appendTo("#menu-all-ul");

            createmove();
        } else {
            move(selDom);
        }
    },
        buildDefaultTab=function(text,url,icon){
           var a= document.createElement("a");
            a.text='<i class="icon '+icon+'">&nbsp;'+text;
            a.href=url;
            buildTab.apply(a,[false]);
            linkframe(a.href, a.text);
    }

    $.fn.tab = function (opts) {
        opts= $.extend({
            defaultTab:"默认Tab",
			defaultIcon:"icon-home",
            defaultUrl:"content.html#默认Tab"
        },opts);
        init(opts);
        //绑定点击事件

        this.bind("click", function () {
            //链接地址
            var linkUrl = this.href;
            //链接文字
            var linkHtml = this.text.trim();
            buildTab.apply(this);
            linkframe(linkUrl, linkHtml);
            //不跳转
            return false;
        });

        return this;
    };
})()