<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>The Password generator</title>
    <meta name="description" content="Password generator">

    <link rel="stylesheet" href="public/libary/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/site.css">
</head>

<body>
    <div class="container clearfix content-area">
        <div class="col-md-8 col-lg-offset-2">
            <div class="password-generator-area">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php endif ?>
                <form class="form-password-generator" method="post">
                    <input type="hidden" name="form" value="passwordGeneratorForm">
                    <div class="form-group">
                        <label for="numberOfSymbol">Type number of symbol</label>
                        <select class="form-control" name="symbolLength"  id="numberOfSymbol">
                            <?php for ($i = 6; $i <=28; $i++) : ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="number" checked="checked" type="checkbox" value="1">
                            Only numbers
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="largeLetters" checked="checked" type="checkbox" value="1">
                            Only large letters
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="smallLetters" checked="checked" type="checkbox" value="1">
                            Only small letters
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </form>
                <?php if (isset($password)) : ?>
                    <div class="text-center">
                        <div class="generated-password">
                            <?php echo $password ?>
                        </div>
                        <small>Password generated!</small>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>
