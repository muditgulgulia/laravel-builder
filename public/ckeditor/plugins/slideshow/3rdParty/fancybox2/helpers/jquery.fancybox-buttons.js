(function (e) {
    var d = e.fancybox;
    d.helpers.buttons = {
        defaults: {
            skipSingle: !1,
            position: "top",
            tpl: '\x3cdiv id\x3d"fancybox-buttons"\x3e\x3cul\x3e\x3cli\x3e\x3ca class\x3d"btnPrev" title\x3d"Previous" href\x3d"javascript:;"\x3e\x3c/a\x3e\x3c/li\x3e\x3cli\x3e\x3ca class\x3d"btnPlay" title\x3d"Start slideshow" href\x3d"javascript:;"\x3e\x3c/a\x3e\x3c/li\x3e\x3cli\x3e\x3ca class\x3d"btnNext" title\x3d"Next" href\x3d"javascript:;"\x3e\x3c/a\x3e\x3c/li\x3e\x3cli\x3e\x3ca class\x3d"btnToggle" title\x3d"Toggle size" href\x3d"javascript:;"\x3e\x3c/a\x3e\x3c/li\x3e\x3cli\x3e\x3ca class\x3d"btnClose" title\x3d"Close" href\x3d"javascript:;"\x3e\x3c/a\x3e\x3c/li\x3e\x3c/ul\x3e\x3c/div\x3e'
        },
        list: null, buttons: null, beforeLoad: function (c, a) {
            c.skipSingle && 2 > a.group.length ? (a.helpers.buttons = !1, a.closeBtn = !0) : a.margin["bottom" === c.position ? 2 : 0] += 30
        }, onPlayStart: function () {
            this.buttons && this.buttons.play.attr("title", "Pause slideshow").addClass("btnPlayOn")
        }, onPlayEnd: function () {
            this.buttons && this.buttons.play.attr("title", "Start slideshow").removeClass("btnPlayOn")
        }, afterShow: function (c, a) {
            var b = this.buttons;
            b || (this.list = e(c.tpl).addClass(c.position).appendTo("body"), b = {
                prev: this.list.find(".btnPrev").click(d.prev),
                next: this.list.find(".btnNext").click(d.next),
                play: this.list.find(".btnPlay").click(d.play),
                toggle: this.list.find(".btnToggle").click(d.toggle),
                close: this.list.find(".btnClose").click(d.close)
            });
            0 < a.index || a.loop ? b.prev.removeClass("btnDisabled") : b.prev.addClass("btnDisabled");
            a.loop || a.index < a.group.length - 1 ? (b.next.removeClass("btnDisabled"), b.play.removeClass("btnDisabled")) : (b.next.addClass("btnDisabled"), b.play.addClass("btnDisabled"));
            this.buttons = b;
            this.onUpdate(c, a)
        }, onUpdate: function (c, a) {
            var b;
            this.buttons && (b = this.buttons.toggle.removeClass("btnDisabled btnToggleOn"), a.canShrink ? b.addClass("btnToggleOn") : a.canExpand || b.addClass("btnDisabled"))
        }, beforeClose: function () {
            this.list && this.list.remove();
            this.buttons = this.list = null
        }
    }
})(jQuery);