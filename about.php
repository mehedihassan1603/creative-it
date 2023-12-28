<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-4">About Us</h2>

        <?php
        $teamMembers = array(
            array('id' => 1, 'name' => 'John Doe', 'position' => 'Founder', 'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
            array('id' => 2, 'name' => 'Jane Smith', 'position' => 'Developer', 'bio' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
            array('id' => 3, 'name' => 'Bob Johnson', 'position' => 'Designer', 'bio' => 'Sed quis lectus in enim dictum fermentum ac nec ligula.'),
        );

        foreach ($teamMembers as $member) {
            echo "<div class='bg-white p-4 mb-4 shadow-md rounded-md'>";
            echo "<h3 class='text-xl font-bold mb-2' contenteditable='true' data-field='name' data-id='{$member['id']}'>{$member['name']}</h3>";
            echo "<p class='text-gray-600 mb-2' contenteditable='true' data-field='position' data-id='{$member['id']}'>{$member['position']}</p>";
            echo "<p contenteditable='true' data-field='bio' data-id='{$member['id']}'>{$member['bio']}</p>";
            echo "</div>";
        }
        ?>

        <script>
            document.addEventListener('input', function (e) {
                if (e.target.hasAttribute('contenteditable')) {
                    const id = e.target.getAttribute('data-id');
                    const field = e.target.getAttribute('data-field');
                    const value = e.target.innerText.trim();

                    updateMemberData(id, field, value);
                }
            });

            function updateMemberData(id, field, value) {
                console.log(`Updated data for member ${id}: ${field} - ${value}`);
            }
        </script>
    </div>
</body>

</html>
