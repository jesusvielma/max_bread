<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ base_url('assets/common/img/favicon.ico') }}">

    <title>MaxBread Administrador | Login</title>

    <link href="<?=base_url('assets/backend/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/backend/font-awesome/css/font-awesome.css')?>" rel="stylesheet">

    <link href="<?=base_url('assets/backend/css/animate.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/backend/css/style.css')?>" rel="stylesheet">
    <style media="all">
        .loginscreen{
            width: 400px !important;
        }
        .logo-name{
            font-size: 100px;
            line-height: 65px;
        }
        .logo-name > small {
            font-size: 55px;
            letter-spacing: -5px;
        }
    </style>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown" >
        <div>
            <div>

                <h1 class="logo-name" style="font-size:100px">MaxBread
                    <br>
                    <small>Administrador</small>
                </h1>

            </div>
            <h3>Bienvenido</h3>
            <p>Inicio de sesión</p>
            <?php if (isset($error)): ?>
                <div class="alert alert-warning">
                    <h3>Error de usuario o clave</h3>
                    <p>Parece que haz introducido los datos mal o los datos no estan registrados, Verificalos y vuelve a intentar</p>
                </div>
            <?php endif; ?>
            <?=validation_errors()?>
            <?=form_open('administrador/login/post_login')?>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Correo" required="" name="correo">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" required="" name="clave">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Entrar</button>

                <!-- <a href="login.html#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> -->
            </form>
            <!-- <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p> -->
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?=base_url('assets/backend/js/jquery-3.1.1.min.js')?>"></script>
    <script src="<?=base_url('assets/backend/js/bootstrap.min.js')?>"></script>

</body>

</html>
