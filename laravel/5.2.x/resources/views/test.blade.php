<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <script>
            function test(){
                url = 'http://localhost:8000/admin/group/510/__store';

                data = {
                    "fields": [
                        {
                            'name': 'name',
                            'value': 'Ala4a'
                        },
                        {
                            'name': 'email',
                            'value': 'makota4@example.com'
                        }
                    ]
                };



                $.ajax({
                    url: url,
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    async: false
                });

            }

        </script>
    </head>
    <body>
        <a href="#" onclick="test()">Test</a>

    </body>
</html>