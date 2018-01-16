<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>recuperar</title>
    </head>
    <body>
        {{ form_open('recuperar/recuperar') }}
            <label for="">Token </label> <input type="text" name="token" value="" />
            <button type="submit" name="button">Recuperar</button>
        </form>
    </body>
</html>
