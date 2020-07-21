<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <?php
      if ($cia == 1):
        $grupo = 'GRUPO FS';
        $idgrupo = 'rcornersfs';
        $colorgrupo = '#73AD21';
        $idbuttongrupo = 'button-fs';
        $ccia = 'fs';
      elseif ($cia == 2):
        $grupo = 'FSC';
        $idgrupo = 'rcornersfsc';
        $colorgrupo = '#122F99';
        $idbuttongrupo = 'button-fsc';
        $ccia = 'fsc';
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
            <link rel="shortcut icon" href="<?php echo public_url(); ?>images/ico-gfs.ico" type="image/x-icon" />
    <?php elseif ($cia == 2): ?>
            <link rel="stylesheet" href="<?php echo public_url(); ?>cssweb/loginfsc.css">
            <link rel="shortcut icon" href="<?php echo public_url(); ?>images/ico-fsc.ico" type="image/x-icon" />
    <?php endif; ?>
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo"> 
        <?PHP echo "<p id=$idgrupo> <a><b>ACCESO </b>$grupo</a> </p>"; ?>
      </div>
      <div class="card">
        <?php
        echo 
        "<div class='card-body login-card-body' style='border:2px solid $colorgrupo;' >
          <p style='background: $colorgrupo; font-size:20px; color:white; text-align:center;' >Iniciar Sesion</p>";
        ?>
        <p> </p>
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
                <?php echo "<button id=$idbuttongrupo type='submit'class='btn btn-block' value='ingresar'><i class='fas fa-paper-plane'></i> INGRESAR</button>"; ?>
              </div>
              <input name="cia" type="hidden" id="cia" value="<?php echo $cia ;?>">
            </div>
          </form>
          <br>
          <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="chboxsession" name="chboxsession" value="sessionSi">
            <label for="chboxsession" class="custom-control-label">Mantener Sesion</label>
          </div>
          <div align="right">
            <a href="<?php echo base_url('clogin/recover_pass/'.$ccia) ?>">Olvidé mi contraseña</a>    
          </div>
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
