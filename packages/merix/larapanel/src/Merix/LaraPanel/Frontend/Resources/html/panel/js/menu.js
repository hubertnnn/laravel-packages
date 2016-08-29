// Namespace
(function( LaraPanel ) {

    LaraPanel.FrontEnd = LaraPanel.FrontEnd || {};
    LaraPanel.FrontEnd.Panel = LaraPanel.FrontEnd.Panel || {};


    LaraPanel.FrontEnd.Panel.Menu = function(arg_larapanel)
    {
        var self = this;
        var laraPanel = arg_larapanel;


        var itemPrototype = null;
        var subMenuPrototype = null;

        var menuHandle = null;
        var itemsHandle = null;

        self.init = function(items)
        {
            itemPrototype = jQuery('.larapanel-menu-partials > .larapanel-menu-partials-item').first().children();
            subMenuPrototype = jQuery('.larapanel-menu-partials > .larapanel-menu-partials-submenu').first().children();

            menuHandle = jQuery('.larapanel-menu').first();
            itemsHandle = menuHandle.find('.navbar-left').first();

            self.append(items);

        };

        self.append = function(data, parent)
        {
            if((parent === null) || (parent === undefined))
            {
                parent = itemsHandle;
            }

            if(Array.isArray(data))
            {
                data.forEach(function(item){
                    self.append(item, parent);
                });
            }


            if((data.label === undefined) || (data.label === null)){
                data.label = '';
            }

            if((data.class === undefined) || (data.class === null)){
                data.class = '';
            }

            if((data.admin === undefined) || (data.admin === null)){
                data.admin = null;
            }

            var href = laraPanel.urlManager.getAdminPath(data.admin);


            var child = null;

            if((data.menu !== null) && (data.menu !== undefined))
            {
                child = subMenuPrototype.clone();
                child.find('.larapanel-menu-partials-item-link').attr('href', data.admin);
                child.find('.larapanel-menu-partials-item-text').html(data.label);
                child.attr('id', 'larapanel-menu-admin-'+data.admin);
                child.addClass('data.class');
                subParent = child.find('ul');

                data.menu.forEach(function(item){
                    self.append(item, subParent);
                });
            }
            else
            {
                child = itemPrototype.clone();
                child.find('.larapanel-menu-partials-item-link').attr('href', href);
                child.find('.larapanel-menu-partials-item-text').html(data.label);
                child.attr('id', 'larapanel-menu-admin-'+data.admin);
                child.addClass('data.class');
            }

            parent.append(child);
        };


    }



}( window.LaraPanel = window.LaraPanel || {} ));
