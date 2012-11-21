/**
 * file		: Functions.js
 * created	: 17 Nov 2012
 *
 * @package	: 
 * @author	: Charles
 */

var Functions = Class.create({
    
    getAppAddress: function() {
        var url = document.URL;
        var explode = url.split('/');
        
        return (explode[0] + '//' + explode[2] + '/' + explode[3] + '/');
    },
    
    animatedLoading: function(filename) {
        return '<div class="centerElement"><img src="./tpl/img/' + filename + '" /></div>';
    },
    
    initDatatable: function(tableId, scrollXInner) {
        jQuery("#" + tableId.toString()).dataTable({
            "bRetrieve": true,
            "bDestroy": true,
            "bPaginate": false,
            "bFilter": false,
            "bSort": false,
            "sScrollY": 280,
            "sScrollX": "100%",
            "sScrollXInner": scrollXInner.toString() + "%",
            "bScrollCollapse": true,
            "bJQueryUI": true,
            "oLanguage": {
                "sInfo": "",
                "sInfoFiltered": ""
            }
        });
    },
    
    initCalendar: function(datepickerId) {
        jQuery("#" + datepickerId.toString()).datepicker({
            hide: true,
            autoSize: true,
            yearRange: '-90:+0',
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        })
    },
    
    initDialog: function(elementId, dialogTitle, dialogWidth, dialogHeight) {
        jQuery("#" + elementId.toString()).dialog({
            title: dialogTitle,
            autoOpen: false,
            draggable: false,
            resizable: false,
            modal: true,
            width: dialogWidth,
            height: dialogHeight
        })
    },
    
    initConfirmationDialog: function(elementId, dialogTitle, dialogWidth, dialogHeight, confirmFunction) {
        jQuery("#" + elementId).dialog({
            title: dialogTitle,
            autoOpen: false,
            draggable: false,
            resizable: false,
            modal: true,
            width: dialogWidth,
            height: dialogHeight,
            buttons: {
                "Yes": confirmFunction,
                "No": function() {
                    jQuery(this).dialog("close");
                }
            }
        })
    },
    
    initInformationDialog: function(elementId, dialogWidth, dialogHeight) {
        jQuery("#" + elementId.toString()).dialog({
            title: "Information",
            autoOpen: false,
            draggable: false,
            resizable: false,
            modal: true,
            width: dialogWidth,
            height: dialogHeight,
            buttons: {
                "OK": function() {
                    jQuery(this).dialog("close");
                }
            }
        })
    },
    
    closeDialog: function(elementId) {
        jQuery("#" + elementId.toString()).dialog("close");
    },
    
    redirect: function (url) {
        window.location.href = url;
    },
    
    textToUpper: function(field) {
        field.value = field.value.toUpperCase();
    },
    
    /**
     * number formatting function
     * copyright Stephen Chapman 24th March 2006, 22nd August 2008
     * permission to use this function is granted provided
     * that this copyright notice is retained intact
     * @author Stephen Chapman
     * @link http://javascript.about.com/library/blnumfmt.htm
     * 
     * @param num {Int} num
     * @param dec {Int} decimal places
     * @param thou {String} thousand separator
     * @param pnt {String} decimal point
     * @param curr1 {String} front currency number
     * @param curr2 {String} back currency number
     * @param n1 {String} front symbol
     * @param n2 {String} back symbol
     */
    numberFormat: function(num, dec, thou, pnt, curr1, curr2, n1, n2) {
        var x = Math.round(num * Math.pow(10,dec));
        if (x >= 0) n1=n2='';
        
        var y = (''+Math.abs(x)).split('');
        var z = y.length - dec;
        
        if (z<0) z--;
        
        for(var i = z; i < 0; i++) {
            y.unshift('0');
        }
        
        y.splice(z, 0, pnt);
        if(y[0] == pnt) y.unshift('0');
        
        while (z > 3) {
            z-=3;
            y.splice(z,0,thou);
        }
        
        var r = curr1+n1+y.join('')+n2+curr2;
        
        return r;
    }
})