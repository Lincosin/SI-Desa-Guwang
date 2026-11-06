/* =========================================================
   CUSTOM SCRIPT LOGIN MANDIRI DESA GUWANG
   Lokasi: assets/js/login-guwang.js
   ========================================================= */
$(document).ready(function () {
    var pass = $("#pin");
    var checkbox = $("#checkbox");
    var eyeIcon = $("#eyeIcon");

    function togglePinVisibility(show) {
        if (show) {
            pass.attr("type", "text");
            eyeIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            checkbox.prop("checked", true);
        } else {
            pass.attr("type", "password");
            eyeIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            checkbox.prop("checked", false);
        }
    }

    // Saat checkbox diklik
    checkbox.on("change", function () {
        togglePinVisibility(this.checked);
    });

    // Saat ikon mata di dalam input PIN diklik
    $("#togglePinBtn").on("click", function () {
        var isPassword = pass.attr("type") === "password";
        togglePinVisibility(isPassword);
    });

    // Ambil UUID anjungan dari localStorage
    var anjungan_uuid = localStorage.getItem("anjungan_uuid");
    if (anjungan_uuid) {
        $("#anjungan_uuid").val(anjungan_uuid);
    }
});