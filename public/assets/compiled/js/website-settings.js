"use strict";
$(function () {
    // update
    $("body").on("click", `.updates-count a`, function (e) {
        e.preventDefault();
        let _this = $(this);
        let id = _this.parents(".updates-count").data("id");
        let _url = _this.attr("href");
        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id,
            },
            beforeSend: function () {
                $(".updates-count .rotate").removeClass("rotate_paused");
            },
            success: function (res) {
                if (res.SUCCESS) {
                    Swal.fire({
                        icon: "success",
                        text: res.MSG,
                    });
                }
                checkUpdates();
            },
        });
    });

    function checkUpdates() {
        $.ajax({
            url: $(".updates-count").attr("data-url"),
            type: "POST",
            success: function (res) {
                if (res.SUCCESS) {
                    $(".updates-count .core-count").text(
                        res.update_notification.core
                    );
                    $(".updates-count .themes-count").text(
                        res.update_notification.theme
                    );
                    $(".updates-count .plugins-count").text(
                        res.update_notification.plugin
                    );
                }
            },
            complete: function () {
                $(".updates-count .rotate").addClass("rotate_paused");
            },
        });
    }

    // ssl
    function checkSsl() {
        var sslAnimation;
        $.ajax({
            url: $(".ssl-secure").data("url"),
            type: "POST",
            beforeSend: function () {
                sslAnimation = setInterval(function () {
                    $(".ssl-secure .ssl-view").toggleClass("fa-unlock-alt");
                    $(".ssl-secure .ssl-view").toggleClass("fa-lock");
                }, 1000);
            },
            success: function (res) {
                setTimeout(() => {
                    clearInterval(sslAnimation);
                    if (res) {
                        $(".ssl-secure .ssl-view")
                            .removeClass("fa-unlock-alt")
                            .addClass("fa-lock");
                    } else {
                        $(".ssl-secure .ssl-view")
                            .removeClass("fa-lock")
                            .addClass("fa-unlock-alt");
                    }
                }, 1000);
            },
            complete: function () {
                setTimeout(() => {
                    clearInterval(sslAnimation);
                }, 1000);
            },
        });
    }

    $("body").on("click", `.ssl-secure a`, function (e) {
        e.preventDefault();
        var sslAnimation;
        $.ajax({
            url: $(this).attr("href"),
            type: "POST",
            beforeSend: function () {
                sslAnimation = setInterval(function () {
                    $(".ssl-secure .ssl-view").toggleClass("fa-unlock-alt");
                    $(".ssl-secure .ssl-view").toggleClass("fa-lock");
                }, 1000);
            },
            success: function (res) {
                if (res.SUCCESS) {
                    Swal.fire({
                        icon: "success",
                        text: res.MSG,
                    });
                }
                checkSsl();
            },
            complete: function () {
                setTimeout(() => {
                    clearInterval(sslAnimation);
                }, 1000);
            },
        });
    });

    setTimeout(() => {
        checkUpdates();
        checkSsl();
    }, 200);
});
