<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table'])) {
    $table = $_POST['table'];

    $forms = [
        'home' => '
            <form action="insert_data.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="table" value="home">
                <input type="text" name="title" placeholder="Title" class="form-control mb-2" required>
                <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
                <input type="text" name="address" placeholder="Address" class="form-control mb-2" required>
                <input type="file" name="image" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>',

        'attractions' => '
            <form action="insert_data.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="table" value="attractions">
                <input type="text" name="title" placeholder="Title" class="form-control mb-2" required>
                <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
                <input type="text" name="address" placeholder="Address" class="form-control mb-2" required>
                <select name="category" class="form-control mb-2">
                    <option>Natural Tourist Sites</option>
                    <option>Historical Tourist Sites</option>
                    <option>Ancestral Houses</option>
                    <option>Livelihood</option>
                    <option>Experience Program</option>
                </select>
                <input type="file" name="image" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>',
        
        'events' => '
            <form action="insert_data.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="table" value="events">
                <input type="text" name="title" placeholder="Event Name" class="form-control mb-2" required>
                <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
                <input type="text" name="address" placeholder="Address" class="form-control mb-2" required>
                <input type="date" name="date" class="form-control mb-2" required>
                <input type="file" name="image" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>',

        'restaurants' => '
            <form action="insert_data.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="table" value="restaurants">
                <input type="text" name="name" placeholder="Restaurant Name" class="form-control mb-2" required>
                <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
                <input type="text" name="address" placeholder="Address" class="form-control mb-2" required>
                <input type="text" name="cuisine" placeholder="Cuisine Type" class="form-control mb-2" required>
                <input type="file" name="image" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>'
    ];

    echo $forms[$table] ?? '<p>No form available.</p>';
}
?>
