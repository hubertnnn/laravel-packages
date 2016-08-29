require.config({
    shim : {
        "bootstrap" : { "deps" :['jquery', 'css!../bootstrap/css/bootstrap.min.css', 'css!../bootstrap/css/bootstrap-theme.min.css'] },
        "larapanel" : {
            "deps" :[
                'q',
                'jquery',
                '../larapanel/networkmanager',
                '../larapanel/panel',
                '../larapanel/admin',
                '../larapanel/utils',
                '../larapanel/urlmanager',
                '../larapanel/drawer'
            ]
        }
    },
    paths: {
        "css" : "css.min",
        "jquery" : "jquery-3.1.0.min",
        "bootstrap": "../bootstrap/js/bootstrap.min",
        "larapanel": '../larapanel/larapanel'
    }
});



require(['q', 'jquery','bootstrap', 'larapanel'], function(Q) {

    // Register modules as namespaces
    window.Q = Q;





    LaraPanel.instance = new LaraPanel.LaraPanel();
    LaraPanel.instance.load();



});