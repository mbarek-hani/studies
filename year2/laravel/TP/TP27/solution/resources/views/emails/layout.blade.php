<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title')</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .header {
                text-align: center;
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
            }
            .content {
                padding: 20px 0;
                line-height: 1.6;
            }
            .button {
                display: inline-block;
                background-color: #4f46e5;
                color: white;
                padding: 12px 25px;
                text-decoration: none;
                border-radius: 5px;
                margin: 20px 0;
            }
            .footer {
                text-align: center;
                font-size: 12px;
                color: #888;
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @yield('content')
            <div class="footer">
                © {{ date('Y') }} Eventify - Tous droits réservés.<br />
                Mirleft, Maroc
            </div>
        </div>
    </body>
</html>
