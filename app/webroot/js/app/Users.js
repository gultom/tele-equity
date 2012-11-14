
var Users = Class.create({
    
    doLogin: function() {
        var target = '/tele-equity/users/dologin';
        new Ajax.Request (target, {
            method: 'post',
            parameters: Form.serialize("UserLoginForm"),
            onSuccess: function(response) {
                alert(response);
            }
        })
    }
});

var Users = new Users();