<!doctype html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c4497f215d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>TODO App</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1 class="my-5">The Best TODO App ever</h1>

                <?php require "view/button.php"; ?>

                <table class="table table-hover">
                    <thead>
                        
                        <?php require "view/forech.php"  ?>

                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>