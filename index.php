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
            align-items: center:
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
        }

        h2 {
            margin-top: 40px;
            text-align: center;
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
    <div class="body">
        <h2>Add Students Informations:</h2>
        <form action="insert.php" method="post">
            <label for="certificate_id">Certificate ID:</label>
            <input type="text" id="certificate_id" name="certificate_id" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name" required>

            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name" required>

            <label for="course_name">Course Name:</label>
            <select id="course_name" name="course_name" required>
                <option value="Web Development">Web Development</option>
                <option value="Digital Marketing">Digital Marketing</option>
                <option value="Web Design">Web Design</option>
            </select>

            <label for="batch_number">Batch Number:</label>
            <input type="text" id="batch_number" name="batch_number" required>

            <label for="course_end_date">Course End Date:</label>
            <input type="date" id="course_end_date" name="course_end_date" required>

            <label for="certificate_date">Certificate Date:</label>
            <input type="date" id="certificate_date" name="certificate_date" required>

            <input type="submit" value="Add to Database">
        </form>

        

    </div>

    <h2>Search by ID:</h2>
    <form action="search.php" method="get">
        <label for="searchId">Enter ID</label>
        <input type="text" id="searchId" name="certificate_id">
        <input type="submit" value="Search">
    </form>

    <div>
        <!-- <h2>Student List: </h2> -->
        <?php
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "creativeit";
        
        // $conn = new mysqli($servername, $username, $password, $dbname);
        
        // if ($conn->connect_error){
        //     die("connection failed" . $conn->connect_error);
        // }
        // $result = $conn -> query("SELECT * FROM students");
        // while ($row = $result->fetch_assoc()){
        //     echo "<li>{$row['name']} - Course: {$row['course']} - Batch: {$row['batch']}</li>";
        // }
        // $conn->close();
        ?>
    </div>


</body>

</html>