<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
        }

        ul {
            list-style-type: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        li {
            margin: 0 10px;
        }

        a {
            text-decoration: none;
            font-weight: bold;
            color: #fff;
        }

        h2 {
            margin-top: 40px;
            text-align: center;
        }

        form {
            margin-top: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"] {
            width: 200px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <nav>
        <div>
            Creative IT
        </div>
        <div>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Service</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </div>
        <div>
            <button>Login</button>
        </div>
    </nav>

    <h2>Search by ID:</h2>
    <form action="search.php" method="get">
        <label for="searchId">Enter ID:</label>
        <input type="text" id="searchId" name="certificate_id" required>
        <input type="submit" value="Search">
    </form>
</body>

</html>
