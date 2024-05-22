<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-success text-center m-0">
    <div class="m-auto w-50 mt-5">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"
            class="bg-success text-center ">
            <div class="mb-3">
                <label for="value_1" class="form-label text-white fs-1">First value</label>
                <input type="number" class="form-control text-black fs-3" name="value_1" required>
            </div>
            <h1 class="text-white fs-1">Select your operator</h1>
            <select class="form-select form-select-lg mb-3 text-center fs-2" aria-label="Large select example"
                name="operator">
                <option value="null">Null</option>
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <div class="mb-3">
                <label for="value_2" class="form-label text-white fs-1">Second value</label>
                <input type="number" class="form-control text-black fs-3" name="value_2" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // grab data for input
        $valueFst = filter_input(INPUT_POST, 'value_1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $valueSec = filter_input(INPUT_POST, 'value_2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $operator = htmlspecialchars($_POST['operator']);

        // error handler
        $errors = false;
        if (empty($valueFst) || empty($valueSec) || $operator === 'null') {
            echo '<h1 class="text-danger fs-1">Please fill in all fields correctly</h1>';
            $errors = true;
        }

        // calculate the number if no error 
        if (!$errors) {
            $result;
            switch ($operator) {
                case 'add':
                    $result = $valueFst + $valueSec;
                    break;
                case 'subtract':
                    $result = $valueFst - $valueSec;
                    break;
                case 'multiply':
                    $result = $valueFst * $valueSec;
                    break;
                case 'divide':
                    if ($valueSec != 0) {
                        $result = $valueFst / $valueSec;
                    } else {
                        echo '<h1 class="text-danger fs-1">Cannot divide by zero</h1>';
                        $errors = true;
                    }
                    break;
                default:
                    echo '<h1 class="text-danger fs-1">Invalid operator selected</h1>';
                    $errors = true;
                    break;
            }
            if (!$errors) {
                echo '<h1 class="text-white fs-1">Result: ' . $result . '</h1>';
            }
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>