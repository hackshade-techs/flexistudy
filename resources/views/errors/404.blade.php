<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ trans('http.404.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }

        h1 {
            color: #555;
            font-size: 2em;
            font-weight: 400;
        }

        p {
            margin: 10px auto;
            width: 280px;
        }

        @media only screen and (max-width: 280px) {

            body, p {
                width: 95%;
            }

            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
            }

        }
    </style>
</head>
<body>
    <img src="/images/404.png" />
    <h1>{{ trans('http.404.title') }}</h1>
    <p>{{ trans('http.404.description') }}</p>
    <br />
    <p><a href="/">{{ trans('http.404.take-me-back-home') }}</a></p>
</body>
</html>
<!-- IE needs 512+ bytes: http://blogs.msdn.com/b/ieinternals/archive/2010/08/19/http-error-pages-in-internet-explorer.aspx -->