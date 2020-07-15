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
    <link href="<?php echo public_url(); ?>cssweb/bootst.css" rel="stylesheet"/>
    <link href="<?php echo public_url(); ?>cssweb/login.css" rel="stylesheet"/>
    <link rel="shortcut icon" href="<?php echo public_url(); ?>images/favicon.png" type="image/x-icon" />
    
    <?php
      $this->load->library('session');  
      $newdata = array(
                's_compania' => $cia,
                's_intentos' => 0,
      );
      $this-> session-> set_userdata($newdata); 
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
    </style>
  </head>

  <body class="container-fluid full-height">
    <div class="row full-height">
      <div id="info-panel" class="col-md-8 full-height">   
        <div class="fondo-login">               
          <div class="top-left-login">
            <img id="logo-img" src="<?php echo public_url(); ?>images/logotransp_fs.png">
          </div>
          <div class="top-right-login">
            <img id="logo-img" src="<?php echo public_url(); ?>images/logotransp_fsc.png">
          </div>
          <div class="info-text-group centered-login">
            <span class="info-text">Nuestros Servicios</span>
            <div class="box-body">
              <div class="row justify-content-center">
                <div class="col-md-12 text-center"> 
                  <ul class="list-inline justify-content-center">
                          <li>                            
                            <a href="#"><img src="<?php echo public_url(); ?>images/logo-fsc.png" alt="User Image"></a>
                            <span class="users-list-date">Asuntos</span>
                            <span class="users-list-date">Regulatorios</span>
                          </li>
                          <li>
                            <a href="#"><img src="<?php echo public_url(); ?>images/logo-fsc.png" alt="User Image"></a>
                            <span class="users-list-date">Area</span>
                            <span class="users-list-date">Tecnica</span>
                          </li>
                          <li>
                            <a href="#"><img src="<?php echo public_url(); ?>images/logo-fsc.png" alt="User Image"></a>
                            <span class="users-list-date">Procesos</span>
                            <span class="users-list-date">Termicos</span>
                          </li>
                  </ul>
                </div>
              </div> 
              <div class="row">
                <div class="col-md-12"> 
                  <ul class="users-list">
                          <li>
                            <a href="#"><img src="<?php echo public_url(); ?>images/logo-fsc.png" alt="User Image"></a>
                            <span class="users-list-date">Laboratorio</span>
                          </li>
                          <li>
                            <a href="#"><img src="<?php echo public_url(); ?>images/logo-fsc.png" alt="User Image"></a>
                            <span class="users-list-date">Organismo</span>
                            <span class="users-list-date">Inspeccion</span>
                          </li>
                  </ul>
                </div>
              </div> 
            </div>
          </div>          
          <div class="info-contact">
            <span>Consultas:</span>
            <span>
            | consultas@grupofs.com | fsc@fscertificaciones.com | lab@fscertificaciones.com |
               <i class="fa fa-phone-square"></i>
              (511)480-0561
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-xs-12">
            <did class="clsDivLogo"></did>
            <div class="wrapper_login">
              <div class="text-center">
                <span class="titulo_principal_login">¡Bienvenido!</span>
              </div>
              <div class="content_campo_usuario" style="display: block;">
                <input type="hidden" id="showRecoverInput" />
                <form id="frmlogin" action="<?= base_url('clogin/ingresar')?>" class="form-horizontal" method="post" role="form">            
                  <hr class="clear" />
                  <input name="cia" type="hidden" id="cia" value="<?php echo $cia ;?>">          
                  <div>
                    <span class="mensaje_error_sesion"> </span>
                  </div>
                  <div class="input-group auth-input-group">
                    <span class="input-group-addon">
                      <img src="<?php echo base_url() ?>assets/images/icon_user.png" />
                    </span>
                    <input autofocus="autofocus" class="form-control text-box single-line" id="txtemail" name="txtemail" placeholder="Usuario" required="required" type="text" value="" />
                  </div>
                  <div class="input-group auth-input-group">
                    <span class="input-group-addon">
                      <img src="<?php echo base_url() ?>assets/images/icon_lock.png" />
                    </span>
                    <input class="form-control text-box single-line" id="txtpassword" maxlength="20" name="txtpassword" placeholder="Contraseña" required="required" type="password" value="" />
                  </div>
                  <a href="<?php echo base_url('clogin/recover_pass/0') ?>" class="link-login">Olvidé mi contraseña</a> 
                  <input type="submit" value="Iniciar Sesión" class="auth-button" />
                </form> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <footer>
    <!-- jQuery 2.2.3 -->
    <script src="<?php echo public_url(); ?>template/GUI/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- login -->
    <script src="<?php echo public_url(); ?>script/login.js"></script>
    
  </footer>
</html>
