<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dropdown Selection</title>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <select name="dropdown1" id="dropdown1">
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>

    <select name="dropdown2" id="dropdown2">
        <?php
        // Depending on the value of dropdown1, generate options for dropdown2
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedOption = $_POST["dropdown1"];

            if ($selectedOption == "option1") {
                echo '<option value="suboption1" selected>Suboption 1</option>';
                echo '<option value="suboption2">Suboption 2</option>';
            } elseif ($selectedOption == "option2") {
                echo '<option value="suboption3" selected>Suboption 3</option>';
                echo '<option value="suboption4">Suboption 4</option>';
            } elseif ($selectedOption == "option3") {
                echo '<option value="suboption5" selected>Suboption 5</option>';
                echo '<option value="suboption6">Suboption 6</option>';
            }
        } else {
            // Default options for dropdown2
            echo '<option value="suboption1" selected>Suboption 1</option>';
            echo '<option value="suboption2">Suboption 2</option>';
        }
        ?>
    </select>

    <input type="submit" value="Submit">
</form>

<script>
document.getElementById('dropdown1').addEventListener('change', function() {
    // Submit the form when dropdown1 changes
    this.form.submit();
});
</script>

</body>
</html>
