<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <?php
      if ($ccia == 'fs'):
        $grupo = 'GRUPO FS';
        $colorgrupo = '#73AD21';
        $cia = 1;
      elseif ($ccia == 'fsc'):
        $grupo = 'FSC';
        $colorgrupo = '#122F99';
        $cia = 2;
      endif;
    ?>
    
    <title><?php echo $grupo . ' | LOCKSCREEN' ?></title>    

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
    <style>  
        .expired {
            background-color: rgba(255,255,255,0.4);
            background-blend-mode: lighten;
        }
    </style>
  </head>

  <body class="hold-transition lockscreen login-page expired">
    <div class="lockscreen-wrapper" style="margin-top: 0%;">
        <div class="lockscreen-logo"> 
            <?PHP echo "<p> <a><b>ACCESO </b>$grupo</a> </p>"; ?>
        </div>
        <div class="lockscreen-name"><?php echo $usuario ?></div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="<?php echo public_url_ftp(); ?>Imagenes/user/<?php echo $ruta ?>" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" id="frmCierre" name="frmCierre" action="<?= base_url('cexpired/validarAcceso')?>" method="POST">
            <div class="input-group">
            <input type="password" id="txtpassword" name="txtpassword" class="form-control" placeholder="password">
            <input type="hidden" id="hdcia" name="hdcia" value= <?php echo $cia; ?> >
            <input type="hidden" id="hdemail" name="hdemail" value= <?php echo $dmail; ?> >
            <input type="hidden" id="hdusuario" name="hdusuario" value= <?php echo $usuario; ?> >
            <div class="input-group-append">
                <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
            </div>
            </div>
        </form>
        <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            <?php echo $nombre ?>
        </div>
        <div class="text-center">
            Ingrese su contraseña para recuperar su sesión
        </div>
        <div class="lockscreen-footer text-center">
        O inicie sesión como un usuario diferente <b><a href="<?php echo base_url('clogin/'.$ccia) ?>" style='color: black'><i class="fas fa-arrow-circle-right fa-2x"></i></a>
        </div>
    </div> 
 
  </body>


  <script src="<?php echo public_url(); ?>template/GUI/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="<?php echo public_url(); ?>template/GUI/dist/js/adminlte.js"></script>   
  <script src="<?php echo public_url(); ?>script/login.js"></script>   
  <script src="<?php echo public_url(); ?>script/expired.js"></script>   
</html>

    <!-- Script Generales -->
    <script type="text/javascript">   
        var baseurl = "<?php echo base_url();?>"; 
    </script>
