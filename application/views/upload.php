<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload</title>
    </head>
    <body>
        <?=form_open_multipart('upload/do_upload')?>
        <input type="file" name="userfile" id="">
        <button type="submit" name="button">subir</button>
        <?=form_close()?>
        <br>
        <?php if(isset($error)) :?>
            <?=$error?>
        <?php endif; ?>
    </body>
</html>
