$(document).ready(function () {
    $('#TestAppTable').jtable({
        title: 'Customer Table',
        paging: true,
        pageSize: 10,
        sorting: true,
        defaultSorting: 'name ASC',
        openChildAsAccordion: true,
        actions: {
            listAction: 'customerList.php',
            createAction: 'customerCreate.php',
            updateAction: 'customerUpdate.php',
            deleteAction: 'customerDelete.php'
        },
        fields: {
            id: {
                key: true,
                list: false,
                create:false,
                edit: false,
            },
            name: {
                title: 'Customer Name',
                width: '40%'
            },
            email: {
                title: 'Email',
                width: '20%'
            },
            country: {
                title: 'Country',
                width: '30%',
            },
            Sales: {
                title: '',
                width: '2%',
                edit: false,
                create: false,
                sorting: false,
                display: function (customerData) {
                    //Create an image that will be used to open child table
                    var $img = $('<img src="includes/images/sales.png" title="View Sales" />');
                    //Open child table when user clicks the image
                    $img.click(function () {
                        $('#TestAppTable').jtable('openChildTable',
                                $img.closest('tr'),
                                {
                                    title: customerData.record.name + ' Sales list',
                                    actions: {
                                        listAction: 'salesList.php?CustomerId=' + customerData.record.id,
                                        deleteAction: 'salesDelete.php',
                                        updateAction: 'salesUpdate.php',
                                        createAction: 'salesCreate.php'
                                    },
                                    fields: {
                                        customer_id: {
                                            type: 'hidden',
                                            defaultValue: customerData.record.id
                                        },
                                        id: {
                                            key: true,
                                            create: false,
                                            edit: false,
                                            list: false,
                                            
                                        },
                                        item: {
                                            title: 'Item',
                                            width: '30%',
                                        },
                                        amount: {
                                            title: 'Amount',
                                            width: '30%'
                                        }
                                    }
                                }, function (data) { //opened handler
                                    data.childTable.jtable('load');
                                });
                    });
                    return $img;
                }
            },
            Email: {
                title: '',
                width: '2%',
                edit: false,
                create: false,
                sorting: false,
                display: function (customerData) {
                    //Create an image that will be used to open child table
                    var $img = $('<img src="includes/images/email-icon.png" title="Send Mail" />');
                    //Open child table when user clicks the image
                    $img.click(function () {
                       $.post("mail.php", {id: customerData.record.id}, function(data){
                    	   $('#emailmessage p').html(data);
                    	   $('#emailmessage').dialog({
                    		   modal: true,
                    		   buttons: {
                    			   Ok: function() {
                    				   $(this).dialog('close');
                    			   }
                    		   }
                    	   });
                       })
                    });
                    return $img;
                }
            }
        }
	});
    $('#LoadRecordsButton').click(function (e) {
        e.preventDefault();
        $('#TestAppTable').jtable('load', {
            name: $('#name').val(),
        });
    });
    $('#LoadRecordsButton').click();
    //Load all records when page is first shown
});