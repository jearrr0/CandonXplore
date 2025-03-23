<?php
    // Handle form submission (database connection required)
    include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Data Entry Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container py-5">
    <h2 class="mb-4">Data Entry Form</h2>
    <div class="mb-3">
        <label for="tableSelect" class="form-label">Select Table:</label>
        <select id="tableSelect" class="form-select">
            <option value="">-- Choose Table --</option>
            <option value="home">Home</option>
            <option value="attractions">Attractions</option>
            <option value="hotels">Hotels</option>
            <option value="restaurants">Restaurants</option>
            <option value="events">Events</option>
        </select>
    </div>
    
    <!-- Forms -->
    <div id="formContainer"></div>
    
    <script>
        $(document).ready(function() {
            $('#tableSelect').change(function() {
                var table = $(this).val();
                if (table) {
                    $.ajax({
                        url: "fetch_form.php",
                        type: "POST",
                        data: { table: table },
                        success: function(response) {
                            $('#formContainer').html(response);
                        }
                    });
                } else {
                    $('#formContainer').html('');
                }
            });
        });
    </script>
</body>
</html>


?>
