require.config({
    shim : {
        "bootstrap" : { "deps" :['jquery', 'css!../bootstrap/css/bootstrap.min.css', 'css!../bootstrap/css/bootstrap-theme.min.css'] }
    },
    paths: {
        "css" : "css.min",
        "jquery" : "jquery-3.1.0.min",
        "bootstrap": "../bootstrap/js/bootstrap.min"
    }
});



require(['jquery','bootstrap', 'larapanel'], function() {
    jQuery('.loading').html('Loading in progress: 10%');


    alert(larapanel.test);

    jQuery('.loading').html('Loading in progress: 20%');



});