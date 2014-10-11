//Load common code that includes config, then load the app logic for this page.
requirejs.config({
    baseUrl: 'js/lib',
    paths: {
        jquery: 'jquery-1.11.1.min'
    }
});

require(['jquery'], function ($) {
    //require(['app/main1']);
    console.log($);
    
});