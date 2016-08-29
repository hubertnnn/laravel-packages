// Namespace
(function( LaraPanel ) {

    LaraPanel.Panel = function(arg_larapanel, arg_name)
    {
        var self = this;
        var laraPanel = arg_larapanel;

        self.name = arg_name;
        self.label = null;
        self.theme = null;
        self.type = null;
        self.icon = null;
        self.favicon = null;
        self.defaultAdmin = null;

        self.menuSrc = null;

        var initPromise = null;

        this.init = function()
        {
            if(initPromise !== null)
                return initPromise;

            return initPromise = Q.try(function(){

                var deferred = Q.defer();

                var segments = [
                    self.name,
                    '__panel'
                ];
                laraPanel.networkManager.get(laraPanel.urlManager.segmentsToPath(segments))
                    .then(function(response){
                        self.name = (typeof response.panel === 'undefined') ? null : response.panel;
                        self.label = (typeof response.name === 'undefined') ? null : response.name;
                        self.theme = (typeof response.theme === 'undefined') ? null : response.theme;
                        self.type = (typeof response.type === 'undefined') ? null : response.type;
                        self.icon = (typeof response.icon === 'undefined') ? null : response.icon;
                        self.favicon = (typeof response.favicon === 'undefined') ? null : response.favicon;
                        self.defaultAdmin = (typeof response.default === 'undefined') ? null : response.default;

                        self.menuSrc = (typeof response.menu === 'undefined') ? null : response.menu;
                    })
                    .then(function(){
                        // Draw the panel
                        laraPanel.drawer.select(self.type);

                        return laraPanel.drawer.drawPanel();
                    })
                    .then(function(){
                        deferred.resolve();
                    })
                    .catch(function(err){
                        deferred.reject(err);
                    })
                    .done();
            });
        };


    }



}( window.LaraPanel = window.LaraPanel || {} ));