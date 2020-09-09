<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HelloWorld!</title>
    
    <script type="text/javascript" src="<?= $_fullhost .  '/js/app.js'; ?>" defer></script>
    
    <link rel="stylesheet" type="text/css" href="<?= $_fullhost . '/css/bootstrap.min.css'; ?>">
    <link href="css/app.css" rel="stylesheet" href="<?= $_fullhost . '/css/app.css'; ?>">
</head>

<body>
    <div id="hw-app">
        <div class="border-bottom border-grey shadow bg-white">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="hw-navbar pt-3 pb-3">
                            <div class="hw-nav-items text-secondary d-flex" style="font-size: 16px;">
                                <div class="hw-nav-item pr-4">
                                    <a href="<?= $_fullhost; ?>">HelloWorld</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            <?= $_view("contents"); ?>
        </main>
    </div>
</body>

</html>
