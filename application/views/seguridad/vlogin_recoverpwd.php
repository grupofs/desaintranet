<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <?php
            if ($ccia == 'fs'):
                $grupo = 'GRUPO FS';
                $cia = 1;
                $colorWind = 'card-success';
            elseif ($ccia == 'fsc'):
                $grupo = 'FS Certificaciones';
                $cia = 2;
                $colorWind = 'card-navy';
            endif;

            $set_tipo = $tipo;

            if ($set_tipo == '2'):
                $set_email = $dmail;
            else:
                $set_email = '';
            endif;
        ?>

        <title><?php echo 'RECUPERAR CONTRASEÑA' ?></title>

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
                <p id="rcornersLogin"><a><b>PASSWORD </b><?php echo $grupo; ?></a> </p>
            </div>
            <form id="frmrecoverpwd" action="<?= base_url('clogin/request_password')?>" method="POST"> 
                <div class="card <?php echo $colorWind;?>">
                
                
                    <input type="hidden" name="tipo" value= <?php echo $set_tipo ?> > 
                    <input type="hidden" name="ccia" value= <?php echo $ccia ?> > 
                    <input type="hidden" name="cia" value= <?php echo $cia ?> > 

                    <div class="card-header text-center">
                        <h4> RECUPERAR CONTRASEÑA </h4>
                    </div> 

                    <div class='card-body login-card-body'>              
                        <?php
                        if($set_tipo == '2'):
                        ?>      
                            <h3><small><b>USUARIO BLOQUEADO¡¡</b> <br> Se le enviara un Email para validar.</small></h3>       
                        <?php
                        else:
                        ?>
                            <h3><small><b>¿Olvidó su contraseña?</b> <br> Escriba su dirección de correo electrónico para comenzar el proceso de recuperación.</small></h3>
                        <?php 
                        endif;
                        ?> 
                            
                        <div class="form-group has-feedback">
                        <br><label>Email :: </label><br>           
                            <?php
                            if($set_tipo == '2'):
                            ?> 
                                <input type="text" id="email" name="email" class="form-control" value =<?php echo $set_email ?> required>
                            <?php
                            else:
                            ?>
                                <input type="text" id="email" name="email" class="form-control" value="<?php echo set_value('email')?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Ingrese Correo Electronico" title="mail@example.com" required>
                            <?php 
                            endif;
                            ?>
                        </div>
                        <input type="hidden" name="cia" value= <?php echo $cia ?> > 
                    </div>     
                    <div class="card-footer" align="right">
                        <div class="text-right">  
                            <button id="idbuttongrupo" type="submit" class="btn btn-success" >Verificar Email</button>
                            <a id="btnreturn" href="<?php echo base_url($ccia) ?>" class="btn btn-warning">Regresar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </body>


<script src="<?php echo public_url(); ?>template/GUI/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo public_url(); ?>template/GUI/dist/js/adminlte.js"></script>   
<script src="<?php echo public_url(); ?>script/login.js"></script>   
</html>