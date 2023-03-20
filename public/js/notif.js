counter_notif(localStorage.getItem("route_counter_notif"));
load_notif(localStorage.getItem("route_notification"));

function tombol_notif(){
    counter_notif(localStorage.getItem("route_counter_notif"));
    load_notif(localStorage.getItem("route_notification"));
}

setInterval(function(){
    counter_notif(localStorage.getItem("route_counter_notif"));
}, 5000);

function counter_notif(url){
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        success: function (response){
            if(response.total_notif > 0){
                $('#top-notification-number').html(response.total_notif);
            }else{
                $('#top-notification-number').html(0);
            }
        }
    });
}

function load_notif(url){
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        success: function (response){
            $('#notification_items').html(response.collection);
            $('#top-notification-number').html(response.total_notif);
        },
    });
}
