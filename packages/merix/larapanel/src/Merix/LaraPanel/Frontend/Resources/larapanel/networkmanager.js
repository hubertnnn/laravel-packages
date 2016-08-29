// Namespace
(function( LaraPanel ) {

    LaraPanel.NetworkManager = function() {
        this.ajax = function(path, method, parameters){
            var defer = Q.defer();

            request = {
                type: method,
                url: path,
                data: parameters
            };

            var success = function(data){
                defer.resolve(data);

                //if((data !== null) && ((typeof data) === 'object')) {
                //    defer.resolve(data);
                //} else {
                //    defer.reject(data);
                //}
            };

            var failure = function(data){
                defer.reject(data);
            };

            jQuery.ajax(request).done(success).fail(failure);

            return defer.promise;
        };

        this.get = function(path, parameters){
            return this.ajax(path, 'GET', parameters);
        };

        this.post = function(path, parameters){
            return this.ajax(path, 'POST', parameters);
        };
    };




}( window.LaraPanel = window.LaraPanel || {} ));