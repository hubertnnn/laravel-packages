// Namespace
(function( LaraPanel ) {

    LaraPanel.log = function(...args)
    {
        var date = new Date();

        var prefix = 'LP ';
        prefix += date.getFullYear() + '.' + date.getMonth() + '.' + date.getDate() + ' ';
        prefix += date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds() + ':' + date.getMilliseconds();

        console.log(prefix, ...args);
    };

    // class
    LaraPanel.LaraPanel = function() {
        var self = this;

        var corePromise = null;

        var panel = null;
        var panelName = null;
        var panelPromise = null;

        var admin = null;
        var adminName = null;
        var adminPromise = null;

        var edit = null;
        var editName = null;
        var editPromise = null;


        // Modules available to other modules
        self.networkManager = null;
        self.urlManager = null;
        self.drawer = null;



        self.loadCore = function()
        {
            if(corePromise !== null)
                return corePromise;

            // And this is async
            return corePromise = Q.try(function(){
                self.networkManager = new LaraPanel.NetworkManager(self);
                self.urlManager = new LaraPanel.UrlManager(self, '/');
                self.drawer = new LaraPanel.Drawer(self);
            });
        };


        self.loadPanel = function(arg_panelName)
        {
            if(panelName == arg_panelName)
                return panelPromise; // This panel is already loaded


            return panelName = Q.try(function(){
                panel = new LaraPanel.Panel(self, arg_panelName);
                return panel.init().then(function(){
                    panelName = panel.name;
                });
            });
        };



        self.load = function()
        {
            Q.try(function(){})
                .then(function(){
                    return self.loadCore();
                })
                .then(function(){
                    // Core is loaded, we can get first segment as panel name
                    return self.loadPanel(self.urlManager.getSegments()[0]);
                })
                .done();

                //TODO: load other things
        };




        // TODO: Functions to implement

        self.getPanel = function(){ return panel; }; // Returns current panel or null if none
        self.getAdmin = function(){}; // Returns current admin or null if none
        self.getEdit  = function(){}; // Returns current edit  or null if none
        self.getMenu  = function(){}; // Returns current menu  or null if none

        self.getAction = function(action){};






    }






}( window.LaraPanel = window.LaraPanel || {} ));