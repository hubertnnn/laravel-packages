<html>
    <head>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" crossorigin="anonymous">
        <!-- Optional theme -->
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">-->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" type="text/css" href="/vendor/larapanel/css/themes/slate.css">


        <!--DataTables-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/keytable/2.1.2/css/keyTable.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/1.4.2/css/scroller.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.0/css/select.bootstrap.css"/>

        <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/keytable/2.1.2/js/dataTables.keyTable.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/scroller/1.4.2/js/dataTables.scroller.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.js"></script>

        <!--Animate.css-->
        <link rel="stylesheet" type="text/css" href="/vendor/larapanel/css/animate.css"/>

        <!--AngularJS-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.js"></script>

        <!--Angular DataTables-->
        <script src="/vendor/larapanel/bower_components/angular-data-table/release/dataTable.js"></script>

        <!--Application-->
        <link rel="stylesheet" type="text/css" href="/vendor/larapanel/css/app.css"/>
        <script type="text/javascript" src="/vendor/larapanel/js/angular-app.js"></script>



    </head>
    <body>
        <!--Include laravel menu-->
        <?php echo view('larapanel::panel/menu', array_except(get_defined_vars(), array('__data', '__path')))->render() ?>



        <div class="clearfix">

            <div id="main-panel" class="panel panel-default pull-left" style="position: absolute; width: 80%">
                <div class="panel-heading clearfix">
                    <div class="pull-left">
                        Panel Heading
                    </div>
                    <div class="pull-right">
                        <a href="#" class="btn btn-default">Nowy</a>
                        <a href="#" class="btn btn-default">Akcja</a>
                    </div>
                </div>
                <div class="panel-body">

                    <table
                        id="main-table"
                        class="table table-bordered table-stripped table-condensed table-hover"
                        data-ajax="/admin/user/table/data">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>

            <div id="side-panel" class="pull-right" style="width: 20%">

                <div class="panel panel-default">
                    <div class="panel-body">
                        AAA
                    </div>
                </div>
            </div>




        </div>
    </body>

</html>