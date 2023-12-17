<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }
        h2{
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: auto;
        }

        label {
            /* display: block; */
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            cursor: pointer;
        }

        input[type="date"] {
            /* additional styling for date input */
            appearance: none;
            padding: 8px;
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

    <form action="insert.php" method="post">
        <h2>Add Students Information:</h2>

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

</body>
</html>
