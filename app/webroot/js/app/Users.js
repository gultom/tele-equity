
var Users = Class.create({
    
    doLogin: function(formName) {
        new Ajax.Request ('dologin', {
            method: 'post',
            parameters: Form.serialize(formName.toString()),
            onSuccess: function(response) {
                if (response.responseText === 'true') {
                    window.location.href = '/tele-equity/customers/view';
                }
            }
        })
    }
});