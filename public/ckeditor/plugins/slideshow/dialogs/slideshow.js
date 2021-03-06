function removeDomainFromUrl(f) {
    return f.replace(/^https?:\/\/[^\/]+/i, "")
}
var IMG_PARAM = {
    URL: 0,
    TITLE: 1,
    ALT: 2,
    WIDTH: 3,
    HEIGHT: 4
}, pluginPath = removeDomainFromUrl(CKEDITOR.plugins.get("slideshow").path), BASE_PATH = removeDomainFromUrl(CKEDITOR.basePath), SCRIPT_JQUERY = pluginPath + "3rdParty/jquery.min.js", SCRIPT_ADDGAL = pluginPath + "3rdParty/ad-gallery/jquery.ad-gallery.min.js", CSS_ADDGAL = pluginPath + "3rdParty/ad-gallery/jquery.ad-gallery.css", SCRIPT_FANCYBOX = pluginPath + "3rdParty/fancybox2/jquery.fancybox.pack.js?v\x3d2.1.5", CSS_FANCYBOX = pluginPath + "3rdParty/fancybox2/jquery.fancybox.css?v\x3d2.1.5";
function var_dump(f, l) {
    var k = "";
    l || (l = 0);
    var r = "", h;
    for (h = 0; h < l + 1; h += 1)r += "    ";
    if ("object" == typeof f)for (var n in f)f.hasOwnProperty(n) && (h = f[n], "object" == typeof h ? (k += r + "'" + n + "' ...\n", k += var_dump(h, l + 1)) : k += r + "'" + n + "' \x3d\x3e \"" + h + '"\n'); else k = "\x3d\x3d\x3d\x3e" + f + "\x3c\x3d\x3d\x3d(" + typeof f + ")";
    return k
}
var listItem = function (f) {
    return f.type == CKEDITOR.NODE_ELEMENT && f.is("li")
}, ULItem = function (f) {
    return f.type == CKEDITOR.NODE_ELEMENT && f.is("ul")
}, iFrameItem = function (f) {
    return f.type == CKEDITOR.NODE_ELEMENT && f.is("iframe")
};
Array.prototype.pushUnique = function (f) {
    var l;
    for (l = 0; l < this.length; l += 1)if (this[l][0] == f[0])return -1;
    this.push(f);
    return this.length - 1
};
Array.prototype.updateVal = function (f, l) {
    var k;
    for (k = 0; k < this.length; k += 1)if (this[k][0] == f)return this[k] = [f, l], !0;
    this[k] = [f, l];
    return !1
};
Array.prototype.getVal = function (f) {
    var l;
    for (l = 0; l < this.length; l += 1)if (this[l][0] == f)return this[l][1];
    return null
};
CKEDITOR.dialog.add("slideshowDialog", function (f) {
    function l(a, b, d, c, e) {
        a = h(a);
        c = c ? c.createElement("OPTION") : document.createElement("OPTION");
        if (a && c && "option" == c.getName())CKEDITOR.env.ie ? (isNaN(parseInt(e, 10)) ? a.$.options.add(c.$) : a.$.options.add(c.$, e), c.$.innerHTML = 0 < b.length ? b : "", c.$.value = d) : (null !== e && e < a.getChildCount() ? a.getChild(0 > e ? 0 : e).insertBeforeMe(c) : a.append(c), c.setText(0 < b.length ? b : ""), c.setValue(d)); else return !1;
        return c
    }

    function k(a) {
        return (a = h(a)) ? a.$.selectedIndex : -1
    }

    function r(a,
               b) {
        a = h(a);
        if (0 > b)return null;
        var d = a.getChildren().count();
        a.$.selectedIndex = b >= d ? d - 1 : b;
        return a
    }

    function h(a) {
        return a && a.domId && a.getInputElement().$ ? a.getInputElement() : a && a.$ ? a : !1
    }

    function n(a) {
        1 != a.openCloseStep && (a.getContentElement("slideshowinfoid", "framepreviewid").isVisible() ? y(a) : v(a))
    }

    function w(a) {
        a = a.getContentElement("slideshowinfoid", "imglistitemsid");
        return k(a)
    }

    function v(a) {
        var b = a.getContentElement("slideshowinfoid", "imglistitemsid"), b = k(b), d = a.imagesList[b], b = a.getContentElement("slideshowinfoid",
            "imgtitleid"), b = h(b);
        b.setValue(d[1]);
        b = a.getContentElement("slideshowinfoid", "imgdescid");
        b = h(b);
        b.setValue(d[2]);
        b = a.getContentElement("slideshowinfoid", "imgpreviewid");
        b = h(b);
        b.setHtml('\x3cdiv style\x3d"text-align:center;"\x3e \x3cimg src\x3d"' + d[0] + '" title\x3d"' + d[1] + '" alt\x3d"' + d[2] + '" style\x3d" max-height: 200px;  max-width: 350px;"\x3e \x3c/div\x3e');
        b = a.getContentElement("slideshowinfoid", "framepreviewid");
        a = a.getContentElement("slideshowinfoid", "imgparamsid");
        b = h(b);
        b.hide();
        a = h(a);
        a.show()
    }

    function z(a, b) {
        var d = a.getContentElement("slideshowinfoid", "imglistitemsid"), d = h(d), c = k(d);
        if (!(1 == d.getChildren().count() || -1 == b && 0 == c || 1 == b && c == d.getChildren().count() - 1)) {
            var e = d, f = a.getParentEditor().document, e = h(e), d = k(e);
            if (!(0 > d) && (c = d + b, c = 0 > c ? 0 : c, c = c >= e.getChildCount() ? e.getChildCount() - 1 : c, d != c)) {
                var g = /(^IMG_\d+)/, q = e.getChild(c), t = q.getText(), m = q.getValue(), t = t.replace(g, "IMG_" + d);
                var n, q = c;
                n = h(e);
                0 > q || (q = n.getChild(q), q.setText(t), q.setValue(m));
                q = e.getChild(d);
                t = q.getText();
                m = q.getValue();
                q.remove();
                t = t.replace(g, "IMG_" + c);
                l(e, t, m, f ? f : null, c);
                r(e, c);
                e = a.imagesList[d];
                a.imagesList[d] = a.imagesList[c];
                a.imagesList[c] = e
            }
            A(a)
        }
    }

    function y(a) {
        var b = a.getContentElement("slideshowinfoid", "framepreviewid"), d = a.getContentElement("slideshowinfoid", "imgparamsid"), d = h(d);
        d.hide();
        b = h(b);
        b.show();
        A(a)
    }

    function A(a) {
        var b = 300;
        1 == a.params.getVal("showthumbid") ? b -= 120 : 1 == a.params.getVal("showcontrolid") && (b -= 30);
        if (0 != a.imagesList.length) {
            var d = a.getContentElement("slideshowinfoid", "imglistitemsid"),
                c = k(d);
            0 > c && (c = 0);
            var d = a.getContentElement("slideshowinfoid", "framepreviewid"), e = "", f = '\x3cscript src\x3d"' + SCRIPT_JQUERY + '" type\x3d"text/javascript"\x3e\x3c/script\x3e', e = e + "\x3chead\x3e", e = e + f, e = e + ('\x3cscript type\x3d"text/javascript" src\x3d"' + SCRIPT_ADDGAL + '"\x3e\x3c/script\x3e'), e = e + ('\x3clink rel\x3d"stylesheet" type\x3d"text/css" href\x3d"' + CSS_ADDGAL + '" /\x3e');
            1 == a.params.getVal("openOnClickId") && (e += '\x3clink rel\x3d"stylesheet" type\x3d"text/css" href\x3d"' + CSS_FANCYBOX + '" /\x3e', e +=
                '\x3cscript type\x3d"text/javascript" src\x3d"' + SCRIPT_FANCYBOX + '"\x3e\x3c/script\x3e', e += '\x3cscript type\x3d"text/javascript"\x3e', e += B(a), e += "\x3c/script\x3e");
            e += '\x3cscript type\x3d"text/javascript"\x3e';
            e += C(a, c, 436, b);
            e += "\x3c/script\x3e";
            e += "\x3c/head\x3e";
            e += "\x3cbody\x3e";
            c = D(a);
            e += c.getOuterHtml();
            e += "\x3c/body\x3e";
            e += "";
            d = h(d);
            (c = d.getFirst(iFrameItem)) && c.remove();
            var g = null;
            1 == a.params.getVal("showthumbid") ? b += 120 : 1 == a.params.getVal("showcontrolid") && (b += 30);
            a = CKEDITOR.dom.element.createFromHtml('\x3ciframe style\x3d"width:496px;height:' +
                b + 'px;background:azure; " class\x3d"cke_pasteframe" frameborder\x3d"10"  allowTransparency\x3d"false" role\x3d"region" scrolling\x3d"no"\x3e\x3c/iframe\x3e');
            a.setAttribute("name", "totoFrame");
            a.setAttribute("id", "totoFrame");
            a.on("load", function (a) {
                if (null == g) {
                    g = this.$;
                    var b;
                    g.contentDocument ? b = g.contentDocument : g.contentWindow && (b = g.contentWindow.document);
                    b ? (a = b, b = e, a.open(), a.writeln(b), a.close()) : alert("Cannot inject dynamic contents into iframe.")
                }
            });
            d.append(a)
        }
    }

    function p() {
        var a = this.getDialog();
        if (a.newSlideShowMode)a.slideshowDOM.setAttribute("data-" + this.id, this.getValue()); else switch (this.type) {
            case "checkbox":
                this.setValue("true" == a.slideshowDOM.getAttribute("data-" + this.id));
                break;
            case "text":
                this.setValue(a.slideshowDOM.getAttribute("data-" + this.id));
                break;
            case "select":
                this.setValue(a.slideshowDOM.getAttribute("data-" + this.id))
        }
    }

    function m() {
        var a = this.getDialog();
        a.params.updateVal(this.id, this.getValue());
        n(a)
    }

    function E(a) {
        a.previewImage && (a.previewImage.removeListener("load",
            x), a.previewImage.removeListener("error", u), a.previewImage.removeListener("abort", u), a.previewImage.remove(), a.previewImage = null);
        a.imagesList = null;
        a.params = null;
        a.slideshowDOM = null;
        for (var b = a.getContentElement("slideshowinfoid", "imglistitemsid"), b = h(b); b.getChild(0) && b.getChild(0).remove(););
        a.openCloseStep = !1
    }

    function F(a) {
        for (var b = ""; b.length < a;)b += Math.random().toString(36).substring(2);
        return b.substring(0, a)
    }

    function C(a, b, d, c) {
        var e = "ad-gallery_" + a.params.getVal("slideshowid"), f, h = "";
        f = "(function($) {$(function() {";
        0 == c && (c = a.params.getVal("pictheightid"));
        0 == d && (d = "false");
        0 == a.params.getVal("showtitleid") && (h = ",  hooks: { displayDescription: function(image) {}}");
        b = "loader_image: '" + pluginPath + "3rdParty/ad-gallery/loader.gif', width:" + d + ", height:" + c + ", start_at_index: " + b + ", animation_speed: " + a.params.getVal("animspeedid") + h + ", update_window_hash: false, effect: '" + a.params.getVal("transitiontypeid") + "',";
        a = " slideshow: { enable: true, autostart: " + a.params.getVal("autostartid") + ", start_label: '" + g.labelStart +
            "', stop_label: '" + g.labelStop + "', speed: " + 1E3 * a.params.getVal("speedid") + "}";
        f = f + ("   var galleries \x3d $('#" + e + "').adGallery({" + b + a + "});") + "});";
        return f += "})(jQuery);"
    }

    function B(a) {
        a = "ad-gallery_" + a.params.getVal("slideshowid");
        a = "(function($) {$(function() {" + ('$("#' + a + '").on("click",".ad-image",function(){');
        a += 'var imgObj \x3d$(this).find("img");';
        a += 'var isrc\x3dimgObj.attr("src");';
        a += "var ititle\x3dnull;";
        a += "var idesc\x3dnull;";
        a += "var iname\x3disrc.split('/');";
        a += "iname\x3diname[iname.length-1];";
        a += 'var imgdescid\x3d$(this).find(".ad-image-description");';
        a += "if(imgdescid){";
        a += 'ititle\x3d$(this).find(".ad-description-title");';
        a += "if(ititle)ititle\x3dititle.text();";
        a += "if(ititle!\x3d'')ititle\x3d'\x3cbig\x3e'+ititle+'\x3c/big\x3e';";
        a += 'idesc\x3d$(this).find("span");';
        a += "if(idesc)idesc\x3didesc.text();";
        a += "if (idesc.indexOf('IMAGE_LINK_') \x3e\x3d 0) {";
        a += "idesc \x3d '';";
        a += "}";
        a += "if(idesc!\x3d''){";
        a += "if(ititle!\x3d'')ititle\x3dititle+'\x3cbr\x3e';";
        a += "idesc\x3d'\x3ci\x3e'+idesc+'\x3c/i\x3e';";
        a += "}";
        a += "}";
        a += "$.fancybox.open({";
        a += "href:isrc,";
        a += "beforeLoad:function(){";
        a += "this.title\x3dititle+idesc;";
        a += "},";
        a += "});";
        a += "});";
        a += "});";
        return a += "})(jQuery);"
    }

    function G(a) {
        a = "ad-gallery_" + a.params.getVal("slideshowid");
        a = "(function($) {$(function() {" + ('$("#' + a + '").on("click",".ad-image",function(){');
        a += 'var imgObj \x3d$(this).find("img");';
        a += 'var isrc\x3dimgObj.attr("src");';
        a += "var ititle\x3dnull;";
        a += "var idesc\x3dnull;";
        a += "var iname\x3disrc.split('/');";
        a += "iname\x3diname[iname.length-1];";
        a += 'var imgdescid\x3d$(this).find(".ad-image-description");';
        a += "if(imgdescid){";
        a += 'ititle\x3d$(this).find(".ad-description-title");';
        a += "if(ititle)ititle\x3dititle.text();";
        a += 'idesc\x3d$(this).find("span");';
        a += "if(idesc)idesc\x3didesc.text();";
        a += "if(idesc!\x3d''){";
        a += "var url\x3dwindow.location.href.trim();";
        a += "if (idesc.indexOf('IMAGE_LINK_TAB:') \x3e\x3d 0) {";
        a += "\tidesc \x3d idesc.substring(15).trim();";
        a += " if (url !\x3d idesc) window.open(idesc,'_blank');";
        a += "} else if (idesc.indexOf('IMAGE_LINK_PAR:') \x3e\x3d 0) {";
        a += "\tidesc \x3d idesc.substring(15).trim();";
        a += " if (url !\x3d idesc) window.open(idesc,'_self');";
        a += "}";
        a += "}";
        a += "}";
        a += "});";
        a += "});";
        return a += "})(jQuery);"
    }

    function D(a) {
        var b = a.params.getVal("slideshowid"), d = "ad-gallery_" + b, c = "display: block;", e = "display: block;";
        0 == a.params.getVal("showthumbid") && (c = "display: none;");
        0 == a.params.getVal("showcontrolid") && (e = "visibility: hidden;");
        var g = f.document.createElement("div");
        g.setAttribute("id", b);
        g.setAttribute("class", "slideshowPlugin");
        g.setAttribute("contenteditable",
            "false");
        b = g.append("div");
        b.setAttribute("class", "ad-gallery");
        b.setAttribute("contenteditable", "false");
        b.setAttribute("id", d);
        d = b.append("div");
        d.setAttribute("class", "ad-image-wrapper");
        d.setAttribute("contenteditable", "false");
        d = b.append("div");
        d.setAttribute("class", "ad-controls");
        d.setAttribute("contenteditable", "false");
        d.setAttribute("style", e);
        e = b.append("div");
        e.setAttribute("class", "ad-nav");
        e.setAttribute("style", c);
        e.setAttribute("contenteditable", "false");
        c = e.append("div");
        c.setAttribute("class",
            "ad-thumbs");
        c.setAttribute("contenteditable", "false");
        c = c.append("ul");
        c.setAttribute("class", "ad-thumb-list");
        c.setAttribute("contenteditable", "false");
        for (e = 0; e < a.imagesList.length; e += 1)b = c.append("li"), b.setAttribute("contenteditable", "false"), b = b.append("a"), b.setAttribute("href", removeDomainFromUrl(a.imagesList[e][IMG_PARAM.URL])), b.setAttribute("contenteditable", "false"), b = b.append("img"), b.setAttribute("src", removeDomainFromUrl(a.imagesList[e][IMG_PARAM.URL])), b.setAttribute("title", a.imagesList[e][IMG_PARAM.TITLE]),
            b.setAttribute("alt", a.imagesList[e][IMG_PARAM.ALT]), b.setAttribute("contenteditable", "false"), b.setAttribute("width", a.imagesList[e][IMG_PARAM.WIDTH]), b.setAttribute("height", a.imagesList[e][IMG_PARAM.HEIGHT]);
        return g
    }

    var g = f.lang.slideshow, x = function () {
        var a = this.previewImage;
        a.removeListener("load", x);
        a.removeListener("error", u);
        a.removeListener("abort", u);
        a = BASE_PATH + "plugins/slideshow/images/placeholder.png";
        1 == this.imagesList.length && this.imagesList[0][IMG_PARAM.URL] == a && (a = this.getContentElement("slideshowinfoid",
            "imglistitemsid"), a = h(a), this.imagesList.splice(0, 1), a.getChild(0).remove());
        var b = this.previewImage, a = b.$.src, d = b.$.width / b.$.height, c = b = 50;
        1 < d ? c /= d : b *= d;
        d = this.getContentElement("slideshowinfoid", "imglistitemsid");
        b = this.imagesList.pushUnique([a, "", "", b.toFixed(0), c.toFixed(0)]);
        0 <= b && (l(d, "IMG_" + b + " : " + a.substring(a.lastIndexOf("/") + 1), a, this.getParentEditor().document), r(d, b), n(this))
    }, u = function () {
        var a = this.previewImage;
        a.removeListener("load", x);
        a.removeListener("error", u);
        a.removeListener("abort",
            u)
    };
    return {
        title: g.dialogTitle,
        width: 500,
        height: 600,
        resizable: CKEDITOR.DIALOG_RESIZE_NONE,
        buttons: [CKEDITOR.dialog.okButton(f, {label: "OkCK", style: "display:none;"}), CKEDITOR.dialog.cancelButton, {
            id: "myokbtnid",
            type: "button",
            label: "OK",
            title: g.validModif,
            accessKey: "C",
            disabled: !1,
            onClick: function () {
                var a = this.getDialog(), b = {};
                a.openCloseStep = !0;
                a.commitContent(a);
                var d = D(a), c;
                for (c = 0; c < a.params.length; c += 1)d.data(a.params[c][0], a.params[c][1]);
                f.config.slideshowDoNotLoadJquery && 1 == f.config.slideshowDoNotLoadJquery ||
                (c = CKEDITOR.document.createElement("script", {
                    attributes: {
                        type: "text/javascript",
                        src: SCRIPT_JQUERY
                    }
                }), d.append(c));
                c = CKEDITOR.document.createElement("script", {
                    attributes: {
                        type: "text/javascript",
                        src: SCRIPT_ADDGAL
                    }
                });
                d.append(c);
                1 == a.params.getVal("openOnClickId") && (f.config.slideshowDoNotLoadFancyBoxCss && 1 == f.config.slideshowDoNotLoadFancyBoxCss || (c = CKEDITOR.document.createElement("script", {attributes: {type: "text/javascript"}}), c.setText("(function($) { $('head').append('\x3clink rel\x3d\"stylesheet\" href\x3d\"" +
                    CSS_FANCYBOX + '" type\x3d"text/css" /\x3e\'); })(jQuery);'), d.append(c)), f.config.slideshowDoNotLoadFancyBoxScript && 1 == f.config.slideshowDoNotLoadFancyBoxScript || (c = CKEDITOR.document.createElement("script", {
                    attributes: {
                        type: "text/javascript",
                        src: SCRIPT_FANCYBOX
                    }
                }), d.append(c)), c = CKEDITOR.document.createElement("script", {attributes: {type: "text/javascript"}}), c.setText(B(a)), d.append(c));
                c = CKEDITOR.document.createElement("script", {attributes: {type: "text/javascript"}});
                c.setText(G(a));
                d.append(c);
                c = CKEDITOR.document.createElement("script",
                    {attributes: {type: "text/javascript"}});
                c.setText("(function($) { $('head').append('\x3clink rel\x3d\"stylesheet\" href\x3d\"" + CSS_ADDGAL + '" type\x3d"text/css" /\x3e\'); })(jQuery);');
                d.append(c);
                c = CKEDITOR.document.createElement("script", {attributes: {type: "text/javascript"}});
                c.setText(C(a, 0, 0, 0));
                d.append(c);
                a.imagesList.length && (b.backgroundImage = 'url("' + a.imagesList[0][IMG_PARAM.URL] + '")');
                b.backgroundSize = "contain";
                b.backgroundRepeat = "no-repeat";
                b.backgroundPosition = "center";
                b.display = "block";
                b.width = "64px";
                b.height = "64px";
                b.border = "1px solid black";
                d = f.createFakeElement(d, "cke_slideShow", "slideShow", !1);
                d.setAttributes({});
                d.setStyles(b);
                a.fakeImage ? (d.replace(a.fakeImage), f.getSelection().selectElement(d)) : f.insertElement(d);
                E(a);
                a.hide()
            }
        }],
        contents: [{
            id: "slideshowinfoid",
            label: "Basic Settings",
            align: "center",
            elements: [{
                type: "text", id: "id", style: "display:none;", onLoad: function () {
                    this.getInputElement().setAttribute("readOnly", !0)
                }
            }, {
                type: "text", id: "txturlid", style: "display:none;", label: g.imgList,
                onChange: function () {
                    var a = this.getDialog(), b = this.getValue();
                    if (0 < b.length) {
                        var d = a.previewImage;
                        d.on("load", x, a);
                        d.on("error", u, a);
                        d.on("abort", u, a);
                        d.setAttribute("src", b)
                    }
                }
            }, {
                type: "button",
                id: "browse",
                hidden: "true",
                style: "display:inline-block;margin-top:0px;",
                filebrowser: {
                    action: "Browse",
                    target: "slideshowinfoid:txturlid",
                    url: f.config.filebrowserImageBrowseUrl || f.config.filebrowserBrowseUrl
                },
                label: g.imgAdd
            }, {
                type: "vbox", align: "center", children: [{
                    type: "html",
                    align: "center",
                    id: "framepreviewtitleid",
                    style: "font-family: Amaranth; color: #1E66EB;\tfont-size: 20px; font-weight: bold;",
                    html: g.previewMode
                }, {type: "html", id: "framepreviewid", align: "center", style: "width:500px;height:320px", html: ""}, {
                    type: "hbox", id: "imgparamsid", style: "display:none;width:500px;", height: "325px", children: [{
                        type: "vbox", align: "center", width: "400px", children: [{
                            type: "text", id: "imgtitleid", label: g.imgTitle, onChange: function () {
                                var a = this.getDialog(), b = this.getValue();
                                a.imagesList[w(a)][IMG_PARAM.TITLE] = b;
                                v(a)
                            }, onBlur: function () {
                                var a =
                                    this.getDialog(), b = this.getValue();
                                a.imagesList[w(a)][IMG_PARAM.TITLE] = b;
                                v(a)
                            }
                        }, {
                            type: "text", id: "imgdescid", label: g.imgDesc, onChange: function () {
                                var a = this.getDialog(), b = this.getValue();
                                a.imagesList[w(a)][IMG_PARAM.ALT] = b;
                                v(a)
                            }, onBlur: function () {
                                var a = this.getDialog(), b = this.getValue();
                                a.imagesList[w(a)][IMG_PARAM.ALT] = b;
                                v(a)
                            }
                        }, {
                            type: "html",
                            id: "imgpreviewid",
                            style: "width:400px;height:200px;",
                            html: "\x3cdiv\x3exx\x3c/div\x3e"
                        }]
                    }]
                }, {
                    type: "hbox", align: "center", height: 110, widths: ["25%", "50%"], children: [{
                        type: "vbox",
                        children: [{
                            type: "checkbox",
                            id: "autostartid",
                            label: g.autoStart,
                            "default": "checked",
                            style: "margin-top:15px;",
                            onChange: m,
                            commit: m,
                            setup: p
                        }, {
                            type: "checkbox",
                            id: "showtitleid",
                            label: g.showTitle,
                            "default": "checked",
                            onChange: m,
                            commit: m,
                            setup: p
                        }, {
                            type: "checkbox",
                            id: "showcontrolid",
                            label: g.showControls,
                            "default": "checked",
                            onChange: m,
                            commit: m,
                            setup: p
                        }, {
                            type: "checkbox",
                            id: "showthumbid",
                            label: g.showThumbs,
                            "default": "checked",
                            onChange: m,
                            commit: m,
                            setup: p
                        }, {
                            type: "checkbox", id: "openOnClickId", label: g.openOnClick,
                            "default": "checked", onChange: m, commit: m, setup: p
                        }]
                    }, {
                        type: "select",
                        id: "imglistitemsid",
                        label: g.picturesList,
                        multiple: !1,
                        style: "height:125px;width:250px",
                        items: [],
                        onChange: function (a) {
                            a = this;
                            var b = a.getDialog();
                            a = h(a);
                            var d = 0, c, e;
                            for (c = 0; c < a.getChildren().count(); c += 1)if (e = a.getChild(c), e.$.selected) {
                                d = c;
                                break
                            }
                            r(a, d);
                            n(b)
                        }
                    }, {
                        type: "vbox",
                        children: [{
                            type: "button",
                            id: "previewbtn",
                            style: "margin-top:15px;margin-left:25px;",
                            label: g.previewMode,
                            onClick: function () {
                                y(this.getDialog())
                            }
                        }, {
                            type: "button", id: "removeselectedbtn",
                            style: "margin-left:25px;", label: g.imgDelete, onClick: function () {
                                var a = this.getDialog(), b = a.getContentElement("slideshowinfoid", "imglistitemsid"), b = h(b), d = !1, c;
                                for (c = b.getChildren().count() - 1; 0 <= c; c--)b.getChild(c).$.selected && (a.imagesList.splice(c, 1), b.getChild(c).remove(), d = !0);
                                d && (0 == a.imagesList.length && (d = BASE_PATH + "plugins/slideshow/images/placeholder.png", l(b, "IMG_0 : " + d.substring(d.lastIndexOf("/") + 1), d, a.getParentEditor().document), a.imagesList.pushUnique([d, g.imgTitle, g.imgDesc, "50", "50"])),
                                    r(b, 0), n(a))
                            }
                        }, {
                            type: "button",
                            id: "editselectedbtn",
                            style: "margin-left:25px;",
                            label: g.imgEdit,
                            onClick: function () {
                                v(this.getDialog())
                            }
                        }, {
                            type: "hbox",
                            children: [{
                                type: "button",
                                id: "upselectedbtn",
                                style: "width:32px; margin-left:25px;",
                                label: g.arrowUp,
                                onClick: function () {
                                    z(this.getDialog(), -1)
                                }
                            }, {
                                type: "button",
                                id: "downselectedbtn",
                                style: "width:32px;",
                                label: g.arrowDown,
                                onClick: function () {
                                    z(this.getDialog(), 1)
                                }
                            }]
                        }]
                    }]
                }, {
                    type: "hbox", children: [{
                        type: "text", id: "pictheightid", label: g.pictHeight, maxLength: 3, style: "width:100px;",
                        "default": "300", onChange: function (a) {
                            0 == /^\d+$/.test(this.getValue()) && this.setValue(300);
                            this.getDialog().params.updateVal(this.id, this.getValue());
                            n(this.getDialog())
                        }, commit: m, setup: p
                    }, {
                        type: "text",
                        id: "speedid",
                        label: g.displayTime,
                        maxLength: 3,
                        style: "width:100px;",
                        "default": "5",
                        onChange: function (a) {
                            0 == /^\d+$/.test(this.getValue()) && this.setValue(5);
                            this.getDialog().params.updateVal(this.id, this.getValue());
                            n(this.getDialog())
                        },
                        commit: m,
                        setup: p
                    }, {
                        type: "text", id: "animspeedid", label: g.transitionTime,
                        style: "width:100px;", maxLength: 4, "default": "500", onChange: function (a) {
                            0 == /^\d+$/.test(this.getValue()) && this.setValue(500);
                            this.getDialog().params.updateVal(this.id, this.getValue());
                            n(this.getDialog())
                        }, commit: m, setup: p
                    }, {
                        type: "select",
                        id: "transitiontypeid",
                        label: g.transition,
                        items: [[g.tr1, "none"], [g.tr2, "resize"], [g.tr3, "slide-vert"], [g.tr4, "slide-hori"], [g.tr5, "fade"]],
                        "default": "resize",
                        style: "width:100px;",
                        commit: m,
                        setup: p,
                        onChange: m
                    }]
                }]
            }]
        }],
        onLoad: function () {
        },
        onShow: function () {
            this.dialog = this;
            this.slideshowDOM = null;
            this.openCloseStep = !0;
            var a = this.fakeImage = null;
            this.imagesList = [];
            this.params = [];
            this.previewImage = f.document.createElement("img");
            this.okRefresh = !0;
            var b = this.getSelectedElement();
            b && b.data("cke-real-element-type") && "slideShow" == b.data("cke-real-element-type") && (this.fakeImage = b, a = f.restoreRealElement(b));
            if (a) {
                this.slideshowDOM = a;
                b = a.getElementsByTag("ul");
                b = null == b ? null : 1 == b.count() ? b.getItem(0) : null;
                if (null == b)return alert("BIG Problem slideShowContainer !!"), !1;
                var d =
                    a.getAttribute("id");
                if (null == d)return alert("BIG Problem slideshowid !!"), !1;
                this.params.push(["slideshowid", d]);
                for (var c, e, h, k, m = b.$.getElementsByTagName("img"), t = this.getContentElement("slideshowinfoid", "imglistitemsid"), b = 0; b < m.length; b += 1)c = m[b], d = c.src, e = c.width, 0 == e && (e = c.naturalWidth), 0 == e ? h = e = 50 : (h = c.height, 0 == h && (h = c.naturalHeight), 0 == h && (h = e = 50)), e /= h, k = h = 50, 1 < e ? k /= e : h *= e, c = this.imagesList.pushUnique([d, c.title, c.alt, h, k]), 0 <= c && l(t, "IMG_" + c + " : " + d.substring(d.lastIndexOf("/") + 1), d, this.getParentEditor().document);
                r(t, 0);
                n(this);
                var a = a.$.dataset, p;
                for (p in a)this.params.push([p, a[p]]);
                this.setupContent(this, !0);
                this.newSlideShowMode = !1
            } else this.params.push(["slideshowid", "cke_" + F(8) + "_slideShow"]), p = this.getContentElement("slideshowinfoid", "imglistitemsid"), a = BASE_PATH + "plugins/slideshow/images/placeholder.png", l(p, "IMG_0 : " + a.substring(a.lastIndexOf("/") + 1), a, this.getParentEditor().document), this.imagesList.pushUnique([a, g.imgTitle, g.imgDesc, "50", "50"]), r(p, 0), n(this), this.commitContent(this);
            this.openCloseStep = !1;
            y(this)
        },
        onOk: function () {
            return !1
        },
        onHide: function () {
            E(this)
        }
    }
});