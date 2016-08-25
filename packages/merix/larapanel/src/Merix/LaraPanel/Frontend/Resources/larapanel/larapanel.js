// Namespace
(function( LaraPanel ) {

    // class
    LaraPanel.LaraPanel = function() {
        var coreLoadedPromise = null;
        var panelLoadedPromise = null;

        var networkManager = null;
        var panel = null;
        var admin = null;
        var edit = null;

        var self = this;

        this.doLoadCore = function()
        {
            networkManager = new LaraPanel.NetworkManager();
            console.log('core loaded', this);

        };

        this.loadCore = function()
        {
            if(coreLoadedPromise !== null)
                return coreLoadedPromise;

            coreLoadedPromise = Q(self).invoke('doLoadCore');
            return coreLoadedPromise;
        };


        this.doLoadPanel = function()
        {
            panel = new LaraPanel.Panel(this, LaraPanel.Utils.getPathSegments()[0]);
            console.log('loading panel', this, self);
            return panel.init();
        };

        this.loadPanel = function()
        {
            if(panelLoadedPromise !== null)
                return panelLoadedPromise;

            console.log('trying to load panel', this, self);
            panelLoadedPromise = Q(self).invoke('doLoadPanel');
            return panelLoadedPromise;
        };

        var doLoadAdmin = function()
        {
            console.log('la');
        };

        var loadAdmin = Q.promised(doLoadAdmin);

        var loadEdit = function()
        {

        };


        this.load = function(admin){
            //console.log(this.loadCore().done());
            //this.loadPanel().done();
            this.loadCore().then(this.loadPanel).done();

            //loadAdmin().then(function(){ console.log('aa1');});
            //loadAdmin().then(function(){ console.log('aa2');});


        };



        this.test = function() { return 'abc'; };
    }






}( window.LaraPanel = window.LaraPanel || {} ));