$("body").on("contextmenu", "img", function(e) {
    return false;
});
$('img').attr('draggable', false);
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function auth_content(obj)
{
    $("#page_login").hide();
    $("#page_forgot").hide();
    $("#" + obj).show();
}
function content_auth(obj,title)
{
    $("#title_auth").html(title);
    $("#main_auth").hide();
    $("#mail_login").hide();
    $("#phone_login").hide();
    $("#register_page").hide();
    $("#forgot_page").hide();
    $("#" + obj).show();
}
$("#form_login").on('keydown', 'input', function(event) {
    if (event.which == 13) {
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('data-login'));
        var val = $($this).val();
        if (val == 1) {
            $('[data-login="' + (index + 1).toString() + '"]').focus();
        } else {
            $('#tombol_login').trigger("click");
        }
    }
});
$("#email").focus();
function handle_post(tombol,form,url){
    $(tombol).prop("disabled", true);
    $(tombol).attr("data-kt-indicator", "on");
    $.post(url, $(form).serialize(), function(result) {
        if (result.alert == "success") {
            Swal.fire({ text: result.message, icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, Mengerti!", customClass: { confirmButton: "btn btn-primary" } }).then(function() {
                if(result.callback == "reload"){
                    location.reload();
                }else{
                    content_auth(result.callback,result.title);
                }
            });
        }else{
            Swal.fire({ text: result.message, icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, Mengerti!", customClass: { confirmButton: "btn btn-primary" } });
        }
        $(tombol).prop("disabled", false);
        $(tombol).removeAttr("data-kt-indicator");
    }, "json");
}