<!doctype html>
<html lang="en">
<head>
    <title>500</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Mono');

        .center-xy {
            width: inherit;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            position: absolute;
        }

        html, body {
            font-family: 'Roboto Mono', monospace;
            font-size: 16px;
        }

        html {
            box-sizing: border-box;
            user-select: none;
        }

        body {
            background-color: #000;
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        .container {
            width: 100%;
        }

        .copy-container {
            text-align: center;
        }

        p {
            color: #fff;
            font-size: 24px;
            letter-spacing: .2px;
            margin: 0;
        }

        .handle {
            background: #f0801e;
            width: 14px;
            height: 30px;
            top: 0;
            right: 0;
            margin-top: 5px;
            position: absolute;
            animation: background 3s cubic-bezier(1,0,0,1) infinite;
        }

        .handle2 {
            background: #f0801e;
            width: 14px;
            height: 30px;
            top: 0;
            left: 0;
            margin-top: 2px;
            position: absolute;
            animation: background 3s cubic-bezier(1,0,0,1) infinite;
        }

        .zero {
            animation: title 3s cubic-bezier(1,0,0,1) infinite;
        }

        .ask {
            animation: ask_title 3s cubic-bezier(1,0,0,1) infinite;
        }

        @-webkit-keyframes background {
            0% { background-color: #f0801e; }
            50% { background-color: transparent; }
            100% { background-color: #f0801e; }
        }

        @keyframes background {
            0% { background-color: #f0801e; }
            50% { background-color: transparent; }
            100% { background-color: #f0801e; }
        }

        @-webkit-keyframes title {
            0% { color: #f0801e; }
            50% { color: transparent; }
            100% { color: #f0801e; }
        }

        @keyframes title {
            0% { color: #f0801e; }
            50% { color: transparent; }
            100% { color: #f0801e; }
        }

        @-webkit-keyframes ask_title {
            0% { color: white; }
            50% { color: transparent; }
            100% { color: white; }
        }

        @keyframes ask_title {
            0% { color: white; }
            50% { color: transparent; }
            100% { color: white; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="copy-container center-xy">
        <span class="handle"></span>
        <p>
            ays@soft:~# <a class="404" style="color: #f0801e">500</a> Internal Server Error
        </p>
        <span class="handle2"></span>

    </div>
</div>

</body>
</html>
