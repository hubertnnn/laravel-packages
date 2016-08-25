require.config({
    shim : {
        "bootstrap" : { "deps" :['jquery', 'css!../bootstrap/css/bootstrap.min.css', 'css!../bootstrap/css/bootstrap-theme.min.css'] },
        "larapanel" : { "deps" :['q', 'jquery', '../larapanel/networkmanager', '../larapanel/panel', '../larapanel/admin', '../larapanel/utils'] }
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





    //jQuery('.loading').html('Loading in progress: 10%');
    //
    //lp = new LaraPanel.NetworkManager();
    ////lp.get('test').done(function(data){ console.log('S1', data); }).fail(function(data){ console.log('F1', data); });
    ////lp.get('test123').done(function(data){ console.log('S2', data); }).fail(function(data){ console.log('F2', data); });
    ////lp.get('admin/__panel').done(function(data){ console.log('S3', data); }).fail(function(data){ console.log('F3', data); });
    //
    //console.log(LaraPanel.Utils.getPathSegments());
    //
    //jQuery('.loading').html('Loading in progress: 20%');
    //
    //
    //
    //nm = new LaraPanel.NetworkManager();
    //nm.get('admin/__panel')
    //    .then(function(response){
    //        var dd = Q.defer();
    //
    //        console.log(response);
    //        console.log(response.default);
    //
    //        return dd.promise;
    //    })
    //    .then(function(data){
    //        console.log('else', data);
    //    })
    //
    //    .catch(function(err){ console.log('error', err); }).done();
    //
    //
    //Q(nm).invoke('get', 'admin/__panel')
    //    .then(function(response){
    //        console.log('ok', response);
    //    })
    //    .done();
    //
    ////
    ////Q.post(function(response){
    ////    console.log('aaax', response, this);
    ////}, 'ala').done();


    lp = new LaraPanel.LaraPanel();
    lp.load();




});