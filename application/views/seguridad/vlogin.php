<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <?php
      if ($cia == 1):
        $grupo = 'GRUPO FS';
        $ccia = 'fs';
        $colorWind = 'card-success';
      elseif ($cia == 2):
        $grupo = 'FSC';
        $ccia = 'fsc';
        $colorWind = 'card-navy';
      endif;
    ?>
    
    <title><?php echo $grupo . ' | LOGIN' ?></title>    

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo public_url(); ?>template/Ionicons/css/ionicons.min.css">  
    <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo public_url(); ?>cssweb/fontsgoogleapis.css">

    <?php if ($cia == 1): ?>
            <link rel="stylesheet" href="<?php echo public_url(); ?>cssweb/loginfs.css">
    <?php elseif ($cia == 2): ?>
            <link rel="stylesheet" href="<?php echo public_url(); ?>cssweb/loginfsc.css">
    <?php endif; ?>

    <link rel="shortcut icon" href="<?php echo public_url(); ?>images/ico-<?php echo $ccia; ?>.ico" type="image/x-icon" />
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo"> 
        <p id="rcornersLogin"><a><b>ACCESO - </b><?php echo $grupo; ?></a> </p>
      </div>  

      <div class="card <?php echo $colorWind;?>">
        <div class="card-header text-right">
          <h4> INICIAR SESIÓN</h4>
        </div> 

        <div class="card-body login-card-body">      
          <div class="col-12 user-img" >
            <img src="<?php echo public_url(); ?>images/logo-<?php echo $ccia; ?>.png" alt="User Image">
          </div>
        
          <form id="frmlogin" action="<?= base_url('clogin/ingresar')?>" method="POST">
            <input type="hidden" name="hdnAlerta" class="form-control" id="hdnAlerta" value =<?php echo $alerta ?> > 

            <div class="input-group mb-3">
              <input type="text" name="txtemail" class="form-control" placeholder="Email/Usuario" id="txtemail" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="txtpassword" class="form-control" placeholder="Password" id="txtpassword" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col" align="center">
                <button id="buttonLogin" type="submit" class="btn btn-block" value="ingresar"><i class="fas fa-paper-plane"></i> INGRESAR</button>
              </div>
              <input name="cia" type="hidden" id="cia" value="<?php echo $cia ;?>">
            </div>
            <br>
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="chboxsession" name="chboxsession" value="N">
              <label for="chboxsession" class="custom-control-label">Mantener Sesion</label>
            </div>
          </form> 
        </div>

        <div class="card-footer" align="right">
          <a href="<?php echo base_url('clogin/recover_pass/'.$ccia) ?>">Olvidó su contraseña?</a>   
        </div>
      </div> 
    </div> 
 
  </body>

  <script src="<?php echo public_url(); ?>template/GUI/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="<?php echo public_url(); ?>template/GUI/dist/js/adminlte.js"></script>   
  <script src="<?php echo public_url(); ?>script/login.js"></script>   

</html>
