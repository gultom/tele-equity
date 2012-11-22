
var User = Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    load: function() {
        new Ajax.Request(Functions.getAppAddress() + 'users/view', {
            method: 'get',
            parameters: 'users=reload',
            onLoading: function() {
                
            },
            onSuccess: function() {
                
            }
        })
    },
    
    initLogoutDialog: function() {
        jQuery("#logoutDialog").dialog("open");
    },
    
    logout: function() {
        jQuery("#logoutDialog").dialog("close");
        Functions.redirect(Functions.getAppAddress() + 'users/logout');
    },
    
    initAddDialog: function() {
        jQuery("#addUserDialog").dialog("open");
        new Ajax.Request(Functions.getAppAddress() + 'users/add', {
            method: 'get',
            onSuccess: function(response) {
                document.getElementById("addUserDialog").innerHTML = response.responseText;
                Functions.initCalendar("joinDate");
                User.validate();
            }
        });
    },
    
    validate: function() {
        jQuery("#UserAdd").validate({
            errorPlacement: function(error, placement) {
                $(placement).qtip({
                    content: error.text(),
                    show: { when: { event: 'none'}, ready: true },
                    hide: { when: { event: 'unfocus' } },
                    position: {
                      corner: {
                         target: 'topRight',
                         tooltip: 'bottomLeft'
                      }
                   },
                   style: {
                      border: {
                         width: 1,
                         radius: 10
                      },
                      tip: true,
                      name: 'red'
                   }
                });
            },
            rules: {
                'data[User][username]':  {
                    required: true
                },
                'data[User][level]': {
                    required: true
                }
            },
            messages: {
                'data[User][username]': {
                    messages: 'Please fill username'
                }
            },
            submitHandler: function() {
                User.add();
            }
        });
    },
    
    add: function() {
        new Ajax.Request(Functions.getAppAddress() + 'users/add', {
            method: 'post',
            parameters: Form.serialize("UserAdd"),
            onSuccess: function(response) {
                if (response.responseText === 'true') {
                    jQuery("#addUserDialog").dialog("close");
                    //User.load();
                }
                else {
                    alert('false');
                }
            }
        })
    },
    
    initEditDialog: function() {
        if (this.id === null) {
            document.getElementById('userInfo').innerHTML = '<b>Please select user first.</b>';
            Functions.initInformationDialog('userInfo', 300, 125);
            jQuery("#userInfo").dialog('open');
        }
        else {
            jQuery("#editUserDialog").dialog("open");
        }
    }
});