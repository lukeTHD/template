"use strict";
var KTAppInbox = function() {
    var i, a, t, e, s, l = function(i, a) {
            a = new Quill("#" + a, {
                modules: {
                    toolbar: {}
                },
                placeholder: "Type message...",
                theme: "snow"
            });
            var t = KTUtil.find(i, ".ql-toolbar");
            a = KTUtil.find(i, ".ql-editor");
            t && KTUtil.addClass(t, "px-5 border-top-0 border-left-0 border-right-0"), a && KTUtil.addClass(a, "px-8")
        },
        n = function(i) {
            i = KTUtil.getById(i);
            var a = KTUtil.find(i, "[name=compose_to]"),
                t = (new Tagify(a, {
                    delimiters: ", ",
                    maxTags: 10,
                    blacklist: ["fuck", "shit", "pussy"],
                    keepInvalidTags: !0,
                    whitelist: [{
                        value: "Chris Muller",
                        email: "chris.muller@wix.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_11.jpg",
                        class: "tagify__tag--primary"
                    }, {
                        value: "Nick Bold",
                        email: "nick.seo@gmail.com",
                        initials: "SS",
                        initialsState: "warning",
                        pic: ""
                    }, {
                        value: "Alon Silko",
                        email: "alon@keenthemes.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_6.jpg"
                    }, {
                        value: "Sam Seanic",
                        email: "sam.senic@loop.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_8.jpg"
                    }, {
                        value: "Sara Loran",
                        email: "sara.loran@tilda.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_9.jpg"
                    }, {
                        value: "Eric Davok",
                        email: "davok@mix.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_13.jpg"
                    }, {
                        value: "Sam Seanic",
                        email: "sam.senic@loop.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_13.jpg"
                    }, {
                        value: "Lina Nilson",
                        email: "lina.nilson@loop.com",
                        initials: "LN",
                        initialsState: "danger",
                        pic: "./assets/media/users/100_15.jpg"
                    }],
                    templates: {
                        dropdownItem: function(i) {
                            try {
                                var a = "";
                                return a += '<div class="tagify__dropdown__item">', a += '   <div class="d-flex align-items-center">', a += '       <span class="symbol sumbol-' + (i.initialsState ? i.initialsState : "") + ' mr-2">', a += '           <span class="symbol-label" style="background-image: url(\'' + (i.pic ? i.pic : "") + "')\">" + (i.initials ? i.initials : "") + "</span>", a += "       </span>", a += '       <div class="d-flex flex-column">', a += '           <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">' + (i.value ? i.value : "") + "</a>", a += '           <span class="text-muted font-weight-bold">' + (i.email ? i.email : "") + "</span>", a += "       </div>", a += "   </div>", a += "</div>"
                            } catch (i) {}
                        }
                    },
                    transformTag: function(i) {
                        i.class = "tagify__tag tagify__tag--primary"
                    },
                    dropdown: {
                        classname: "color-blue",
                        enabled: 1,
                        maxItems: 5
                    }
                }), KTUtil.find(i, "[name=compose_cc]")),
                e = (new Tagify(t, {
                    delimiters: ", ",
                    maxTags: 10,
                    blacklist: ["fuck", "shit", "pussy"],
                    keepInvalidTags: !0,
                    whitelist: [{
                        value: "Chris Muller",
                        email: "chris.muller@wix.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_11.jpg",
                        class: "tagify__tag--primary"
                    }, {
                        value: "Nick Bold",
                        email: "nick.seo@gmail.com",
                        initials: "SS",
                        initialsState: "warning",
                        pic: ""
                    }, {
                        value: "Alon Silko",
                        email: "alon@keenthemes.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_6.jpg"
                    }, {
                        value: "Sam Seanic",
                        email: "sam.senic@loop.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_8.jpg"
                    }, {
                        value: "Sara Loran",
                        email: "sara.loran@tilda.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_9.jpg"
                    }, {
                        value: "Eric Davok",
                        email: "davok@mix.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_13.jpg"
                    }, {
                        value: "Sam Seanic",
                        email: "sam.senic@loop.com",
                        initials: "",
                        initialsState: "",
                        pic: "./assets/media/users/100_13.jpg"
                    }, {
                        value: "Lina Nilson",
                        email: "lina.nilson@loop.com",
                        initials: "LN",
                        initialsState: "danger",
                        pic: "./assets/media/users/100_15.jpg"
                    }],
                    templates: {
                        dropdownItem: function(i) {
                            try {
                                var a = "";
                                return a += '<div class="tagify__dropdown__item">', a += '   <div class="d-flex align-items-center">', a += '       <span class="symbol sumbol-' + (i.initialsState ? i.initialsState : "") + ' mr-2" style="background-image: url(\'' + (i.pic ? i.pic : "") + "')\">", a += '           <span class="symbol-label">' + (i.initials ? i.initials : "") + "</span>", a += "       </span>", a += '       <div class="d-flex flex-column">', a += '           <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">' + (i.value ? i.value : "") + "</a>", a += '           <span class="text-muted font-weight-bold">' + (i.email ? i.email : "") + "</span>", a += "       </div>", a += "   </div>", a += "</div>"
                            } catch (i) {}
                        }
                    },
                    transformTag: function(i) {
                        i.class = "tagify__tag tagify__tag--primary"
                    },
                    dropdown: {
                        classname: "color-blue",
                        enabled: 1,
                        maxItems: 5
                    }
                }), KTUtil.find(i, "[name=compose_bcc]"));
            new Tagify(e, {
                delimiters: ", ",
                maxTags: 10,
                blacklist: ["fuck", "shit", "pussy"],
                keepInvalidTags: !0,
                whitelist: [{
                    value: "Chris Muller",
                    email: "chris.muller@wix.com",
                    initials: "",
                    initialsState: "",
                    pic: "./assets/media/users/100_11.jpg",
                    class: "tagify__tag--primary"
                }, {
                    value: "Nick Bold",
                    email: "nick.seo@gmail.com",
                    initials: "SS",
                    initialsState: "warning",
                    pic: ""
                }, {
                    value: "Alon Silko",
                    email: "alon@keenthemes.com",
                    initials: "",
                    initialsState: "",
                    pic: "./assets/media/users/100_6.jpg"
                }, {
                    value: "Sam Seanic",
                    email: "sam.senic@loop.com",
                    initials: "",
                    initialsState: "",
                    pic: "./assets/media/users/100_8.jpg"
                }, {
                    value: "Sara Loran",
                    email: "sara.loran@tilda.com",
                    initials: "",
                    initialsState: "",
                    pic: "./assets/media/users/100_9.jpg"
                }, {
                    value: "Eric Davok",
                    email: "davok@mix.com",
                    initials: "",
                    initialsState: "",
                    pic: "./assets/media/users/100_13.jpg"
                }, {
                    value: "Sam Seanic",
                    email: "sam.senic@loop.com",
                    initials: "",
                    initialsState: "",
                    pic: "./assets/media/users/100_13.jpg"
                }, {
                    value: "Lina Nilson",
                    email: "lina.nilson@loop.com",
                    initials: "LN",
                    initialsState: "danger",
                    pic: "./assets/media/users/100_15.jpg"
                }],
                templates: {
                    dropdownItem: function(i) {
                        try {
                            var a = "";
                            return a += '<div class="tagify__dropdown__item">', a += '   <div class="d-flex align-items-center">', a += '       <span class="symbol sumbol-' + (i.initialsState ? i.initialsState : "") + ' mr-2" style="background-image: url(\'' + (i.pic ? i.pic : "") + "')\">", a += '           <span class="symbol-label">' + (i.initials ? i.initials : "") + "</span>", a += "       </span>", a += '       <div class="d-flex flex-column">', a += '           <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">' + (i.value ? i.value : "") + "</a>", a += '           <span class="text-muted font-weight-bold">' + (i.email ? i.email : "") + "</span>", a += "       </div>", a += "   </div>", a += "</div>"
                        } catch (i) {}
                    }
                },
                transformTag: function(i) {
                    i.class = "tagify__tag tagify__tag--primary"
                },
                dropdown: {
                    classname: "color-blue",
                    enabled: 1,
                    maxItems: 5
                }
            });
            KTUtil.on(i, '[data-inbox="cc-show"]', "click", (function(a) {
                var t = KTUtil.find(i, ".inbox-to-cc");
                KTUtil.removeClass(t, "d-none"), KTUtil.addClass(t, "d-flex"), KTUtil.find(i, "[name=compose_cc]").focus()
            })), KTUtil.on(i, '[data-inbox="cc-hide"]', "click", (function(a) {
                var t = KTUtil.find(i, ".inbox-to-cc");
                KTUtil.removeClass(t, "d-flex"), KTUtil.addClass(t, "d-none")
            })), KTUtil.on(i, '[data-inbox="bcc-show"]', "click", (function(a) {
                var t = KTUtil.find(i, ".inbox-to-bcc");
                KTUtil.removeClass(t, "d-none"), KTUtil.addClass(t, "d-flex"), KTUtil.find(i, "[name=compose_bcc]").focus()
            })), KTUtil.on(i, '[data-inbox="bcc-hide"]', "click", (function(a) {
                var t = KTUtil.find(i, ".inbox-to-bcc");
                KTUtil.removeClass(t, "d-flex"), KTUtil.addClass(t, "d-none")
            }))
        },
        o = function(i) {
            var a = "#" + i,
                t = $(a + " .dropzone-item");
            t.id = "";
            var e = t.parent(".dropzone-items").html();
            t.remove();
            var s = new Dropzone(a, {
                url: "https://keenthemes.com/scripts/void.php",
                parallelUploads: 20,
                maxFilesize: 1,
                previewTemplate: e,
                previewsContainer: a + " .dropzone-items",
                clickable: a + "_select"
            });
            s.on("addedfile", (function(i) {
                $(document).find(a + " .dropzone-item").css("display", "")
            })), s.on("totaluploadprogress", (function(i) {
                document.querySelector(a + " .progress-bar").style.width = i + "%"
            })), s.on("sending", (function(i) {
                document.querySelector(a + " .progress-bar").style.opacity = "1"
            })), s.on("complete", (function(i) {
                var t = a + " .dz-complete";
                setTimeout((function() {
                    $(t + " .progress-bar, " + t + " .progress").css("opacity", "0")
                }), 300)
            }))
        };
    return {
        init: function() {
            i = KTUtil.getById("kt_inbox_aside"), a = KTUtil.getById("kt_inbox_list"), t = KTUtil.getById("kt_inbox_view"), e = KTUtil.getById("kt_inbox_compose"), s = KTUtil.getById("kt_inbox_reply"), KTAppInbox.initAside(), KTAppInbox.initList(), KTAppInbox.initView(), KTAppInbox.initReply(), KTAppInbox.initCompose()
        },
        initAside: function() {
            new KTOffcanvas(i, {
                overlay: !0,
                baseClass: "offcanvas-mobile",
                toggleBy: "kt_subheader_mobile_toggle"
            }), KTUtil.on(i, '.list-item[data-action="list"]', "click", (function(e) {
                var s = KTUtil.attr(this, "data-type"),
                    l = KTUtil.find(a, ".kt-inbox__items"),
                    n = this.closest(".kt-nav__item"),
                    o = KTUtil.find(i, ".kt-nav__item.kt-nav__item--active"),
                    c = new KTDialog({
                        type: "loader",
                        placement: "top center",
                        message: "Loading ..."
                    });
                c.show(), setTimeout((function() {
                    c.hide(), KTUtil.css(a, "display", "flex"), KTUtil.css(t, "display", "none"), KTUtil.addClass(n, "kt-nav__item--active"), KTUtil.removeClass(o, "kt-nav__item--active"), KTUtil.attr(l, "data-type", s)
                }), 600)
            }))
        },
        initList: function() {
            KTUtil.on(a, '[data-inbox="message"]', "click", (function(i) {
                var e = KTUtil.find(this, '[data-inbox="actions"]');
                if (i.target === e || e && !0 === e.contains(i.target)) return !1;
                var s = new KTDialog({
                    type: "loader",
                    placement: "top center",
                    message: "Loading ..."
                });
                s.show(), setTimeout((function() {
                    s.hide(), KTUtil.addClass(a, "d-none"), KTUtil.removeClass(a, "d-block"), KTUtil.addClass(t, "d-block"), KTUtil.removeClass(t, "d-none")
                }), 700)
            })), KTUtil.on(a, '[data-inbox="group-select"] input', "click", (function() {
                for (var i = KTUtil.findAll(a, '[data-inbox="message"]'), t = 0, e = i.length; t < e; t++) {
                    var s = i[t];
                    KTUtil.find(s, ".checkbox input").checked = this.checked, this.checked ? KTUtil.addClass(s, "active") : KTUtil.removeClass(s, "active")
                }
            })), KTUtil.on(a, '[data-inbox="message"] [data-inbox="actions"] .checkbox input', "click", (function() {
                var i = this.closest('[data-inbox="message"]');
                i && this.checked ? KTUtil.addClass(i, "active") : KTUtil.removeClass(i, "active")
            }))
        },
        initView: function() {
            KTUtil.on(t, '[data-inbox="back"]', "click", (function() {
                var i = new KTDialog({
                    type: "loader",
                    placement: "top center",
                    message: "Loading ..."
                });
                i.show(), setTimeout((function() {
                    i.hide(), KTUtil.addClass(a, "d-block"), KTUtil.removeClass(a, "d-none"), KTUtil.addClass(t, "d-none"), KTUtil.removeClass(t, "d-block")
                }), 700)
            })), KTUtil.on(t, '[data-inbox="message"]', "click", (function(i) {
                var a = this.closest('[data-inbox="message"]'),
                    t = KTUtil.find(this, '[data-toggle="dropdown"]'),
                    e = KTUtil.find(this, '[data-inbox="toolbar"]');
                return !(i.target === t || t && !0 === t.contains(i.target)) && (!(i.target === e || e && !0 === e.contains(i.target)) && void(KTUtil.hasClass(a, "toggle-on") ? (KTUtil.addClass(a, "toggle-off"), KTUtil.removeClass(a, "toggle-on")) : (KTUtil.removeClass(a, "toggle-off"), KTUtil.addClass(a, "toggle-on"))))
            }))
        },
        initReply: function() {
            l(s, "kt_inbox_reply_editor"), o("kt_inbox_reply_attachments"), n("kt_inbox_reply_form")
        },
        initCompose: function() {
            l(e, "kt_inbox_compose_editor"), o("kt_inbox_compose_attachments"), n("kt_inbox_compose_form"), KTUtil.on(e, '[data-inbox="dismiss"]', "click", (function(i) {
                swal.fire({
                    text: "Are you sure to discard this message ?",
                    type: "danger",
                    buttonsStyling: !1,
                    confirmButtonText: "Discard draft",
                    confirmButtonClass: "btn btn-danger",
                    showCancelButton: !0,
                    cancelButtonText: "Cancel",
                    cancelButtonClass: "btn btn-light-primary"
                }).then((function(i) {
                    $(e).modal("hide")
                }))
            }))
        }
    }
}();
jQuery(document).ready((function() {
    KTAppInbox.init()
}));