
$(document).ready( function () {

    loadDatatables();



});




function loadDatatables()
{
    var table = $("#main-table").DataTable({
        "serverSide": true,
        select: 'single',

        "columns": [
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'other'
            },
        ],

    });


    table.on('select', function (event, dt, type, indexes) {
        var id = table.rows( indexes ).data().pluck( 'id' )[0];
        openEdit(id);
    });

    table.on('deselect', function (event, dt, type, indexes) {

        closeEdit();
    });

}


var selected = 0;

function openEdit(id)
{
    selected = id;

    $("#main-panel").animate({
        width: '50%',
    }, 400);


    $("#side-panel").animate({
        width: '50%',
    }, 400);

}

function closeEdit()
{
    selected = 0;

    $("#main-panel").animate({
        width: '80%',
    }, 300);


    $("#side-panel").animate({
        width: '20%',
    }, 300);

}








// JQuery Based Functions

function jqDataTables(tableName, $scope)
{
    var table = $(tableName).DataTable({
        "serverSide": true,
        select: 'single',

        "columns": [
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'other'
            },
        ],

    });

    table.on('select', function (event, dt, type, indexes) {
        var id = table.rows( indexes ).data().pluck( 'id' )[0];
        $scope.$apply(function(){
            $scope.selectedRow = id;
        });
    } );


    table.on('deselect', function (event, dt, type, indexes) {
        $scope.$apply(function(){
            $scope.selectedRow = 0;
        });
    } );
}

