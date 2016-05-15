(function () {
    (function () {
        var b = document.createElement("div"),
            a = !1;
        ["Moz", "Webkit", "ms"].forEach(function (c) {
            a |= c + "Animation" in b.style
        });
        return !!a
    })();
    document.createElement("input").setAttribute("type", "file");
    window.navigator.userAgent.match(/Macintosh/);
    (function () {
        var b = document.createElement("div"),
            a = !1;
        ["Moz", "Webkit", "ms"].forEach(function (c) {
            a |= c + "Transition" in b.style
        });
        return !!a
    })();

    function k() {
        this.h = null;
        this.j = l;
        this.k = []
    }

    function m(b) {
        var a = new k;
        a.init(b);
        return a
    }
    var l = "UNINITIALIZED",
        n = "INITIALIZED",
        p = {
            i: function (b, a) {
                this.l = a.permissions.data[0]
            },
            param: "permissions"
        },
        q = {
            n: {
                i: function () {}
            },
            o: {
                i: function () {},
                param: "email"
            },
            q: {
                i: function () {},
                param: "first_name"
            },
            s: {
                i: function (b) {
                    this.id = b.userID
                }
            },
            t: {
                i: function () {},
                param: "last_name"
            },
            u: {
                i: function (b, a) {
                    this.name = a.name
                },
                param: "name"
            },
            v: p,
            A: {
                i: function () {},
                param: "picture.type(large)"
            },
            p: {
                i: function () {}
            }
        };

    function r(b) {
        this.m = b
    }
    k.prototype.init = function (b) {
        // function a(a) {
        //     FB.Event.subscribe("auth.authResponseChange", function (b) {
        //         "connected" == b.status ? s(a).then(c).fail(e) : a.h = null
        //     });
        //     FB.init({
        //         appId: "525265914179580",
        //         channelUrl: "//" + window.location.hostname + "/static/channel.html",
        //         status: !0,
        //         xfbml: !1
        //     });
        //     a.j = n;
        //     for (var b = a.k.length, d = 0; d < b; d++) a.k.pop()(a)
        // }

        function c(a) {
            d.h = a
        }

        function e() {
            d.h = null
        }
        var d = this;
        this.j == n ? b(d) : (this.k.push(b), "INITIALIZING" != this.j && (this.j = "INITIALIZING", window.fbAsyncInit = function () {
            a(d)
        },
        // function (a,
        //     b, c) {
        //     var e = a.getElementsByTagName(b)[0];
        //     a.getElementById(c) || (a = a.createElement(b), a.id = c, a.src = "//connect.facebook.net/en_US/all.js", e.parentNode.insertBefore(a, e))
        // }
        (document, "script", "facebook-jssdk")))
    };
    k.prototype.getAuthResponse = function () {
        var b = new $.Deferred;
        FB.getAuthResponse() ? b.resolve(FB.getAuthResponse()) : FB.getLoginStatus(function (a) {
            "connected" == a.status ? b.resolve(a.authResponse) : b.reject("UNAUTHORIZED")
        });
        return b.promise()
    };

    function s(b) {
        var a = [],
            c;
        for (c in q) a.push(q[c]);
        var e = new $.Deferred;
        t(b, a).then(function (a) {
            b.h = new r(a.l);
            e.resolve(b.h)
        }).fail(function (a) {
            e.reject(a)
        });
        return e.promise()
    }

    function t(b, a) {
        var c = new $.Deferred;
        b.getAuthResponse().then(function (b) {
            for (var d = [], f = 0; f < a.length; f++) {
                var g = a[f];
                g.param && d.push(g.param)
            }
            FB.api("/me?return_ssl_resources\x3d1\x26fields\x3d" + encodeURIComponent(d.join(",")), function (d) {
                if ("error" in d) c.reject("FB_API_ERROR");
                else {
                    for (var f = {}, g = 0; g < a.length; g++) a[g].i.call(f, b, d);
                    c.resolve(f)
                }
            })
        }).fail(function (a) {
            b.h = null;
            c.reject(a)
        });
        return c.promise()
    }

    function u(b, a) {
        var c = new $.Deferred;
        t(b, [p]).then(function (e) {
            var d = [];
            b.h && (b.h.m = e.l);
            d = e.l;
            e = [];
            for (var f in a) null == d[a[f]] && e.push(a[f]);
            c.resolve(e)
        }).fail(function (a) {
            c.reject(a)
        });
        return c.promise()
    }

    function v() {
        var b = w,
            a = ["email", "user_photos", "user_status"];

        function c(a) {
            h.resolve(a)
        }

        function e(a) {
            this.h = null;
            h.reject(a)
        }
        var d = [],
            f = b.h ? b.h.m : [],
            g;
        for (g in a) null == f[a[g]] && d.push(a[g]);
        var h = $.Deferred();
        0 < d.length ? FB.login(function (d) {
            d.authResponse && d.status ? u(b, a).then(c).fail(e) : h.reject("FB_API_ERROR")
        }, {
            scope: d.join(",")
        }) : u(b, a).then(c).fail(e);
        return h.promise()
    }

    function x() {
        function b(a) {
            c.reject(a)
        }
        var a = w,
            c = new $.Deferred;
        a.getAuthResponse().then(function (a) {
            y(a).then(function (a) {
                c.resolve(a)
            }).fail(b)
        }).fail(b);
        return c.promise()
    }

    function y(b) {
        var a = new $.Deferred;
        $.post("/login/_ajax/fb", {
            fbId: b.userID,
            fbToken: b.accessToken,
            fbTokenExpires: b.expiresIn
        }).done(function (b) {
            a.resolve(b.redirect)
        }).fail(function () {
            a.reject("/login")
        });
        return a.promise()
    };
    var z = 800,
        A = 500,
        B = 20,
        w;
    $(C);

    function C() {
        w = m(function () {
            D(!0)
        });
        0 >= $("*:focus").length && !("createTouch" in document) && $("input[type\x3dtext]").first().focus();
        $("#forgot").on("click", function () {
            $("#loginForm").addClass("fade");
            setTimeout(function () {
                $("#loginForm").addClass("off")
            }, z);
            $("#forgotForm").removeClass("off");
            setTimeout(function () {
                $("#forgotForm").removeClass("fade");
                "createTouch" in document || $("#forgotEmail").focus()
            }, B);
            $(".error").text("");
            return !1
        });
        $("#unForgot").on("click", function () {
            $("#forgotForm").addClass("fade");
            setTimeout(function () {
                    $("#forgotForm").addClass("off")
                },
                z);
            $("#loginForm").removeClass("off");
            setTimeout(function () {
                $("#loginForm").removeClass("fade");
                $("#loginUsername").focus()
            }, B);
            $(".error").text("");
            return !1
        })
    }

    function D(b) {
        var a = $("#facebookLoginButton");
        a.removeClass("disabled");
        if (b) a.on("click", E);
        else a.off("click")
    }

    function E(b) {
        function a(a) {
            window.location.href = window._loginRedirect || a
        }

        function c() {
            window.clearInterval(d);
            $("#facebookLoginButton").text("Login with Facebook");
            $(".error").text("Logging in with Facebook failed.").show();
            D(!0)
        }
        b.preventDefault();
        var e = 0;
        $(".error").text("");
        $("#facebookLoginButton").text("Logging you in");
        D(!1);
        var d = window.setInterval(function () {
            var a = "....".substring(0, e++ % 4);
            $("#facebookLoginButton").text("Logging you in" + a)
        }, A);
        v().then(function () {
            x().then(a).fail(c)
        }).fail(c)
    };
})();