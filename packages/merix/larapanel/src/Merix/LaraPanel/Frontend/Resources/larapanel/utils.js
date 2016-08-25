// Namespace
(function( LaraPanel ) {

    LaraPanel.Utils = {};

    LaraPanel.Utils.getPathSegments = function()
    {
        path = window.location.pathname;
        return path.substr(1).split('/');
    };




}( window.LaraPanel = window.LaraPanel || {} ));