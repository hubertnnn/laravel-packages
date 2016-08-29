// Namespace
(function( LaraPanel ) {

    LaraPanel.Drawer = function(arg_larapanel)
    {
        var self = this;
        var laraPanel = arg_larapanel;

        self.type = null;


        self.select = function(arg_type)
        {
            self.type = arg_type;

        };

        self.drawPanel = function()
        {
            self.getResource('panel.html')
                .then(function(source){
                    jQuery('.larapanel-loading').replaceWith(source);
                    return self.getResource('menu.html');
                })
                .then(function(source){
                    jQuery('.larapanel-menu').replaceWith(source);
                })
                .then(function(source){
                    var panelMenu = new LaraPanel.FrontEnd.Panel.Menu(laraPanel);
                    panelMenu.init(laraPanel.getPanel().menuSrc);
                })
                .done();
        };

        self.getResource = function(resource)
        {
            return laraPanel.networkManager.get(laraPanel.urlManager.getResourcePath('html/' + self.type + '/' + resource))
        }

    };

}( window.LaraPanel = window.LaraPanel || {} ));