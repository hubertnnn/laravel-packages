<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <script>
            function test(){
                url = 'http://localhost:8000/admin/group/0/__store';

                data = {
                    "fields": [
                        {
                            'name': 'name',
                            'value': 'Ala5'
                        },
                        {
                            'name': 'email',
                            'value': 'makota5@example.com'
                        },
                        {
                            'name': 'picture',
                            'value': 'picture.jpg',
                            'base64': 'dG8ganXFvCBqZXN0IGtvbmllYw=='
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