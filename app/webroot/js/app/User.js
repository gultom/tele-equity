
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
            onLoading: function() {
                Functions.write('userList', '<img src="' + Functions.getAppAddress() + 'img/loading.gif' + '" />');
                jQuery("#userList").css('text-align', 'center');
            },
            onSuccess: function(response) {
                Functions.write('userList', response.responseText);
                Functions.initDatatable('usersDatatable', 100);
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
                Functions.write('addUserDialog', response.responseText);
                Functions.initCalendar("joinDate");
                User.validate();
            }
        });
    },
    
    checkLevel: function(code) {
        if (code == 0) {
            jQuery("#UserGroupId").prop('disabled', false);
            jQuery("#UserQa").prop('disabled', false);
        }
        else {
            jQuery("#UserGroupId").prop('disabled', true);
            jQuery("#UserQa").prop('disabled', true);
        }
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
                    User.load();
                }
                else {
                    Functions.write('addInfo', 'Failed to add new User. Please try again later.');
                    jQuery('#addInfo').addClass('error');
                    jQuery('#addInfo').css('text-align', 'center');
                }
            }
        })
    },
    
    initEditDialog: function() {
        if (this.id === null) {
            Functions.write('userInfo', '<b>Please select user first.</b>');
            Functions.initInformationDialog('userInfo', 300, 125);
            jQuery("#userInfo").dialog('open');
        }
        else {
            jQuery("#editUserDialog").dialog("open");
        }
    }
});