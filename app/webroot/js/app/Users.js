
var Users = Class.create({
    
    initLogoutDialog: function() {
        jQuery("#logoutDialog").dialog("open");
    },
    
    logout: function() {
        jQuery("#logoutDialog").dialog("close");
        Functions.redirect(Functions.getAppAddress() + 'users/logout');
    }
});