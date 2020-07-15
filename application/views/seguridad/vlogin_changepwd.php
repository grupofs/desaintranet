<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php  
        if ($ccia == 'fs'):
            $grupo = 'GRUPO FS';
            $idgrupo = 'rcornersfs';
            $colorgrupo = '#73AD21';
            $idbuttongrupo = 'button-fs';
            $cia = 1;
        elseif ($ccia == 'fsc'):
            $grupo = 'FS Certificaciones';
            $idgrupo = 'rcornersfsc';
            $colorgrupo = '#122F99';
            $idbuttongrupo = 'button-fsc';
            $cia = 2;
        endif;
        
        $set_email = $dmail;
        $set_idusuario = $idusuario;
        $set_tipo = $tipo;
    ?>

    <title><?php echo 'CAMBIAR CONTRASEÑA' ?></title>

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
        <?PHP echo "<p id=$idgrupo> <a><b>PASSWORD </b>$grupo</a> </p>"; ?>
    </div>
    <div class="card">
        <?php 
        echo 
        "<div class='card-body login-card-body' style='border:2px solid $colorgrupo;' >
            <p style='background: $colorgrupo; font-size:20px; color:white; text-align:center;'>Cambiar Contraseña</p>";
        ?>
        <p> </p>
        <form class="form-group" action="<?= base_url('clogin/changepasw_login')?>" id="frmchangepwd" method="POST">
            <div class="form-group">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Minimo 6 Caracteres, Opcional Mayuscúlas y Números.
                </div>
            </div>      
            <div class="form-group">
                <label>Usuario / Email :: </label>
                <input type="text" class="form-control" id="email" name="email" value =<?php echo $set_email ?> > 
            </div> 
            <?php
            if($set_tipo == '2'):
            ?>
            <div class="form-group">      
                <label>Contraseña Actual :: </label><br>
                <input type="password" id="txtpassword" name="txtpassword" class="form-control" value = "" required >
            </div>        
            <?php
            endif;
            ?>  
            <div class="form-group">      
                <label>Nueva Contraseña :: </label><br>          
                <input type="password" id="new_password" name="new_password" class="form-control"  title="La contraseña debe tener minimo 6 caracteres" required pattern=".{6,}">          
            </div>
            <div class="form-group">
                <label>Confirmar Contraseña :: </label><br>          
                <input type="password" id="conf_password" name="conf_password" class="form-control" title="Por favor ingrese la misma contraseña que se indica arriba" required >          
            </div>
            <div class="form-group">
                <div class="text-right">  
                    <button id="idbtnsave" type="submit" class="btn btn-success" disabled="true"><i class="fa fa-floppy-o"></i>Cambiar contraseña</button>
                    <a id="btnreturn" href="<?php echo base_url('clogin/'.$ccia) ?>" class="btn btn-warning">Regresar</a>
                </div>
            </div>
            <br> 
            <input type="hidden" name="cia" value= <?php echo $cia ?> > 
            <input type="hidden" name="tipo" value= <?php echo $set_tipo ?> > 
            <input type="hidden" name="ccia" value= <?php echo $ccia ?> >  
            <input type="hidden" name="idusuario" value= <?php echo $set_idusuario ?> >  
        </form>
    </div>
  </div>
 
 </body>


 <script src="<?php echo public_url(); ?>template/GUI/plugins/jquery/jquery.min.js"></script>
 <script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2/sweetalert2.all.min.js"></script>
 <script src="<?php echo public_url(); ?>template/GUI/dist/js/adminlte.js"></script>   
 <script src="<?php echo public_url(); ?>script/login.js"></script>   
</html>







