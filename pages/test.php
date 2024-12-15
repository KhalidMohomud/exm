<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Select with Popup</title>
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
 <style>
    /* style.css */
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    align-items: center;
    justify-content: center;
}

.popup-content {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}

.popup-close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}

 </style>
<body>

    <!-- Select dropdown -->
    <select id="classSelect" class="form-control">
        
        <option value="" disabled selected>Select Class</option>
        <?php
        // PHP: Create dynamic options
        $classes = [
            ['id' => 1, 'name' => 'Math', 'class_name' => 'math-class'],
            ['id' => 2, 'name' => 'Science', 'class_name' => 'science-class'],
            ['id' => 3, 'name' => 'History', 'class_name' => 'history-class'],
        ];
        
        foreach ($classes as $class) {
            echo "<option value='" . $class['class_name'] . "' data-classname='" . $class['class_name'] . "'>" . $class['name'] . "</option>";
        }
        ?>
    </select>

    <!-- Popup Modal (Initially hidden) -->
    <div id="popup" class="popup" style="display:none;">
        <div class="popup-content">
            <span id="popup-close" class="popup-close">×</span>
            <h2>Class Selected: <span id="selectedClassName"></span></h2>
        </div>
    </div>

    <script >
        // script.js
$(document).ready(function() {
    // When the select option changes
    $('#classSelect').change(function() {
        // Get the selected option's class_name
        var selectedClassName = $(this).find(':selected').data('classname');

        // Show the popup with the selected class_name
        $('#selectedClassName').text(selectedClassName); // Set the class_name in popup
        $('#popup').fadeIn(); // Show the popup
    });

    // Close the popup when clicking the close button
    $('#popup-close').click(function() {
        $('#popup').fadeOut(); // Hide the popup
    });
});

    </script>
</body>
</html>
