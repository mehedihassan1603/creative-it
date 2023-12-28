<?php
session_start();

// Sample data for team members
$teamMembers = array(
    array('id' => 1, 'name' => 'Abul', 'position' => 'Founder', 'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
    );


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($teamMembers as &$member) {
        $id = $member['id'];
        $member['name'] = isset($_POST["name_$id"]) ? $_POST["name_$id"] : $member['name'];
        $member['position'] = isset($_POST["position_$id"]) ? $_POST["position_$id"] : $member['position'];
        $member['bio'] = isset($_POST["bio_$id"]) ? $_POST["bio_$id"] : $member['bio'];
    }
    $_SESSION['teamMembers'] = $teamMembers;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us (Editable)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-4">About Us (Editable)</h2>

        <form method="post" action="">
            <?php
            foreach ($teamMembers as $member) {
                echo "<div class='bg-white p-4 mb-4 shadow-md rounded-md'>";
                echo "<input type='text' name='name_{$member['id']}' value='{$member['name']}' class='text-xl font-bold mb-2'>";
                echo "<input type='text' name='position_{$member['id']}' value='{$member['position']}' class='text-gray-600 mb-2'>";
                echo "<textarea name='bio_{$member['id']}' class='mb-2'>{$member['bio']}</textarea>";
                echo "</div>";
            }
            ?>
            <input type="submit" value="Save Changes" class="px-4 py-2 bg-green-500 text-white rounded cursor-pointer">
        </form>
    </div>

</body>

</html>
