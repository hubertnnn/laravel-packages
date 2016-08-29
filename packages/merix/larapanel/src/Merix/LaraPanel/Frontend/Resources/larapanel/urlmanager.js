// Namespace
(function( LaraPanel ) {

    LaraPanel.UrlManager = function(arg_larapanel, arg_baseUrl)
    {
        var self = this;
        var laraPanel = arg_larapanel;

        var baseUrl = arg_baseUrl;
        var resourceUrl = '/vendor/larapanel/';


        var panelName = 'admin';


        window.onpopstate = function(event) {

        };


        self.getSegments = function()
        {
            path = window.location.pathname;
            return self.pathToSegments(path);
        };

        self.segmentsToPath = function(segments)
        {
            return baseUrl + segments.join('/');
        };

        self.pathToSegments = function(path)
        {
            path = path.substr(path.indexOf(baseUrl) + baseUrl.length);
            return path.split('/');
        };

        self.getResourcePath = function(resource)
        {
            return resourceUrl + resource;
        };




        self.select = function(panel, admin, entity)
        {
            var segments = [panel];

            if((admin !== null) && (admin !== undefined))
            {
                segments[1] = admin;
            }

            if((entity !== null) && (entity !== undefined))
            {
                segments[2] = entity;
            }

            path = self.segmentsToPath(segments);

            history.pushState(segments, null, path);
        };


        self.getAdminPath = function(admin)
        {
            return baseUrl + panelName + '/' + admin;
        }

    };



}( window.LaraPanel = window.LaraPanel || {} ));