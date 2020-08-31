<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php
    $grupo = 'GRUPO FS | FSC';
    $cia = 0;
    ?>

    <title><?php echo $grupo ?></title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo public_url(); ?>template/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/dist/css/adminlte.min.css">
    <!--    <link href="--><?php //echo public_url(); ?><!--cssweb/bootst.css" rel="stylesheet"/>-->
    <link href="<?php echo public_url(); ?>cssweb/login.css" rel="stylesheet"/>
    <link rel="shortcut icon" href="<?php echo public_url(); ?>images/favicon.png" type="image/x-icon"/>

    <?php
    $this->load->library('session');
    $newdata = array(
        's_compania' => $cia,
        's_intentos' => 0,
    );
    $this->session->set_userdata($newdata);
    ?>

    <style>
        .fondo-login {
            background-image: url(../assets/images/bg_desktop.jpg);
            background-color: #cccccc;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .top-left-login {
            position: absolute;
            top: 8px;
            left: 16px;
        }

        .top-right-login {
            position: absolute;
            top: 8px;
            right: 190px;
        }

        .centered-login {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .full-height {
            height: 100%;
        }

        .info-text-group span {
            font-size: 1.8rem;
        }

        .titulo-imagen {
            width: 100px;
            height: 95px;
        }

        .titulo-imagen:hover {
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }

        @media (max-width: 991.98px) {
            .info-text-group span {
                font-size: 1.2rem;
            }
            .titulo-imagen {
                width: 70px;
                height: 65px;
            }
        }

    </style>
</head>

<body class="w-100 h-100">
<div class="container-fluid full-height">
    <div class="row full-height">
        <div id="info-panel" class="col-md-8 full-height">
            <div class="fondo-login d-block">
                <div class="top-left-login">
                    <img id="logo-img" src="<?php echo public_url(); ?>images/logotransp_fs.png">
                </div>
                <div class="top-right-login">
                    <img id="logo-img" src="<?php echo public_url(); ?>images/logotransp_fsc.png">
                </div>
                <div class="info-text-group centered-login pb-5">
                    <div class="info-text text-center" style="font-size: 2rem" >Nuestros Servicios</div>

                    <div class="box-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center">
                                <ul class="list-group list-group-horizontal list-unstyled justify-content-center">
                                    <li class="mx-4">
                                        <a href="#" data-toggle="modal" data-target="#modal1" >
                                            <img src="<?php echo public_url(); ?>images/logo-fsc.png"
                                                 class="rounded-circle titulo-imagen"
                                                 alt="User Image">
                                        </a>
                                        <span class="titulo" style="">Asuntos</span>
                                        <span class="titulo" style="">Regulatorios</span>
                                    </li>
                                    <li class="mx-4">
                                        <a href="#" data-toggle="modal" data-target="#modal2">
                                            <img src="<?php echo public_url(); ?>images/logo-fsc.png"
                                                 class="rounded-circle titulo-imagen"
                                                 alt="User Image">
                                        </a>
                                        <span class="titulo" style="">Area</span>
                                        <span class="titulo" style="">Tecnica</span>
                                    </li>
                                    <li class="mx-4">
                                        <a href="#" data-toggle="modal" data-target="#modal3">
                                            <img src="<?php echo public_url(); ?>images/logo-fsc.png"
                                                 class="rounded-circle titulo-imagen"
                                                 alt="User Image">
                                        </a>
                                        <span class="titulo" style="">Procesos</span>
                                        <span class="titulo" style="">Termicos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2 text-center">
                                <ul class="list-group list-group-horizontal list-unstyled justify-content-center">
                                    <li class="mx-4">
                                        <a href="#" data-toggle="modal" data-target="#modal4" >
                                            <img src="<?php echo public_url(); ?>images/logo-fsc.png"
                                                 class="rounded-circle titulo-imagen"
                                                 alt="User Image">
                                        </a>
                                        <span class="titulo" style="">Laboratorio</span>
                                    </li>
                                    <li class="mx-4">
                                        <a href="#" data-toggle="modal" data-target="#modal5" >
                                            <img src="<?php echo public_url(); ?>images/logo-fsc.png"
                                                 class="rounded-circle titulo-imagen"
                                                 alt="User Image">
                                        </a>
                                        <span class="titulo" style="">Organismo</span>
                                        <span class="titulo" style="">Inspeccion</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-contact">
                    <span style="font-size: 1.2rem">Consultas:</span>
                    <span style="font-size: 1.2rem">
                    | consultas@grupofs.com | fsc@fscertificaciones.com | lab@fscertificaciones.com |
                       <i class="fa fa-phone-square"></i>
                      (511)480-0561
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="clsDivLogo"></div>
                    <div class="wrapper_login">
                        <div class="text-center">
                            <span class="titulo_principal_login" style="color: #5a8ae3" >¡Bienvenido!</span>
                        </div>
                        <div class="content_campo_usuario" style="display: block;">
                            <input type="hidden" id="showRecoverInput"/>

                            <form id="frmlogin" action="<?= base_url('clogin/ingresar') ?>" class="form-horizontal"
                                  method="post" role="form">
                                <hr class="clear"/>
                                <input name="cia" type="hidden" id="cia" value="<?php echo $cia; ?>">

                                <div>
                                    <span class="mensaje_error_sesion"> </span>
                                </div>
                                <div class="input-group auth-input-group">
                    <span class="input-group-addon">
                      <img src="<?php echo base_url() ?>assets/images/icon_user.png"/>
                    </span>
                                    <input autofocus="autofocus" class="form-control text-box single-line" id="txtemail"
                                           name="txtemail" placeholder="Usuario" required="required" type="text"
                                           value=""/>
                                </div>
                                <div class="input-group auth-input-group">
                    <span class="input-group-addon">
                      <img src="<?php echo base_url() ?>assets/images/icon_lock.png"/>
                    </span>
                                    <input class="form-control text-box single-line" id="txtpassword" maxlength="20"
                                           name="txtpassword" placeholder="Contraseña" required="required"
                                           type="password"
                                           value=""/>
                                </div>
                                <a href="<?php echo base_url('clogin/recover_pass/0') ?>" class="link-login">Olvidé mi
                                    contraseña</a>
                                <input type="submit" value="Iniciar Sesión" class="auth-button"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal1" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Asuntos regulatorios
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Contenido del texto
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal2" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Área tecnica
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Contenido del texto
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal3" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Procesos Termicos
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Contenido del texto
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal4" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Laboratorio
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Contenido del texto
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal5" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Organismo Inspeccion
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Contenido del texto
                </p>
            </div>
        </div>
    </div>
</div>

</body>
<!-- jQuery 2.2.3 -->
<script src="<?php echo public_url(); ?>template/GUI/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- login -->
<script src="<?php echo public_url(); ?>script/login.js"></script>
</html>
