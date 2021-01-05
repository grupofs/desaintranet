<?php
    $cia = $this->session->userdata('s_cia');
    $idrol = $this->session->userdata('s_idrol');
    $idempleado = $this->session->userdata('s_idempleado');
    $nombres = $this->session->userdata('s_nombre');
    $infousuario = $this->session->userdata('s_infodato');
    $imgperfil = $this->session->userdata('s_druta'); 
    $nombperfil = $this->session->userdata('s_usu'); 
    $usuario = $this->session->userdata('s_usuario');
    $sessionAct = $this->session->userdata('sessionAct');  

    if($imgperfil == ''):
        $imgperfil = 'avatar5.png';
    endif;
    
    if($cia == '1'):
        $ccia = 'fs';
        $title = 'FS';
        $nomCia = 'Grupo FS';
        $claseCabecera = 'navbar-success';
        $hreflogo = 'http://www.grupofs.com/';
    elseif($cia == '2'):
        $ccia = 'fsc';
        $title = 'FSC';
        $nomCia = 'FS Certificaciones';
        $claseCabecera = 'navbar-navy';
        $hreflogo = 'http://www.fscertificaciones.com/';
    endif;

    $añoActual=date("Y");
?>  
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo $title .'-'. $añoActual ?> | INTRANET</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/Ionicons/css/ionicons.min.css"> 
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">  
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- date-range-picker -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/ekko-lightbox/ekko-lightbox.css">
  <!--  summernote -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/GUI/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>cssweb/fontsgoogleapis.css">
  <!-- DataTable.net 
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/DataTable/DataTables/css/dataTables.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/DataTable/DataTables/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/DataTable/Responsive/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/DataTable/Select/css/select.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/DataTable/Checkboxes/css/dataTables.checkboxes.css">  
  <link rel="stylesheet" type="text/css" href="<?php echo public_url(); ?>template/DataTable/RowGroup/css/rowGroup.dataTables.min.css" />
    
  <!-- file input -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>template/plugins/fileinput/fileinput.min.css">
  
    <?php if ($cia == 1): ?>
            <link rel="stylesheet" href="<?php echo public_url(); ?>cssweb/mainfs.css">
    <?php elseif ($cia == 2): ?>
            <link rel="stylesheet" href="<?php echo public_url(); ?>cssweb/mainfsc.css">
    <?php endif; ?>

  <!-- CSS general proyecto -->
  <link rel="stylesheet" href="<?php echo public_url(); ?>cssweb/estiloGeneral.css">
    
  <link rel="shortcut icon" href="<?php echo public_url(); ?>images/ico-<?php echo $ccia; ?>.ico" type="image/x-icon" />

</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">        
        <input type="hidden" id="hdidempleado" name="hdidempleado" value= <?php echo $idempleado; ?> >
        <input type="hidden" id="hdsessionAct" name="hdsessionAct" value= <?php echo $sessionAct; ?> >
        <input type="hidden" id="hdnccia" name="hdnccia" value= <?php echo $ccia;?> >
        <input type="hidden" id="hdncia" name="hdncia" value= <?php echo $cia;?> >

        <!-- MAIN CABECERA  -->
        <nav class="main-header navbar navbar-expand navbar-dark <?php echo $claseCabecera ?>">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars fa-2x"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block nomcab">
                    <h3>BIENVENIDO,</h3>
                </li>
                <li class="nav-item d-none d-sm-inline-block nomcab">
                    <h3 style="margin-left:5px;"><?php echo $nombres ?></h3>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- PERFIL USUARIO -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?php echo base_url()?>perfil" >
                        <i class="fas fa-address-card fa-2x"></i>
                    </a>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="" onclick="CerrarSesion();" >
                        <i class="fas fa-sign-out-alt fa-2x"></i>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large fa-2x"></i>    
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.CABECERA  -->

        <!-- MAIN MENU -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- CIA Logo -->
            <a href="<?php echo $hreflogo ?>" class="brand-link <?php echo $claseCabecera ?>" target="_blank">
                <img src="<?php echo public_url(); ?>images/logo-<?php echo $ccia; ?>.png"  alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?php echo $nomCia ?></span>
            </a>

            <!-- Panel Lateral I -->
            <div class="sidebar">
                <!-- Usuario -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo public_url_ftp(); ?>Imagenes/user/<?php echo $imgperfil ?>"  class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <h6 style="color:#fff;"><?php echo $usuario ?></h6> 
                    </div>
                </div>

                <!-- Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?php echo base_url()?>jobdesk" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>INTERNO</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                            $ci = &get_instance();
                            $ci->load->model("mprincipal");
                            $arearol= $ci->mprincipal->getareasacceso($cia,$idrol);
                            foreach($arearol as $marearol){                
                        ?>   
                        <li class="nav-header"><?php echo $marearol->darea; ?></li>                  
                        <?php
                            $carea = $marearol->carea;
                            $modulorol= $ci->mprincipal->getmenumodulo($cia,$idrol,$carea);
                            foreach($modulorol  as $mmodulorol){
                        ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon <?php echo $mmodulorol->class_icono; ?>"></i>
                                <p>
                                    <?php echo $mmodulorol->desc_modulo; ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">                  
                            <?php
                                $idmodulo = $mmodulorol->id_modulo;
                                $opcionrol= $ci->mprincipal->getmenuopciones($idrol,$idmodulo);                                
                                foreach($opcionrol  as $mopcionrol){
                                    $vista = $mopcionrol->vista_opcion;
                                    $script = $mopcionrol->script_opcion;
                            ?>
                                <li class="nav-item">
                                    <form method="post" action="<?php echo base_url()?>jobdesk" class="inline">
                                        <input type="hidden" name="vista" value="<?php echo $vista; ?>">
                                        <input type="hidden" name="script" value="<?php echo $script; ?>">
                                        <button type="submit" name="submit_param" value="submit_value" class="nav-link" >
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><?php echo $mopcionrol->desc_opcion; ?></p>
                                        </button>
                                    </form>
                                </li>              
                            <?php
                                } 
                            ?>    
                            </ul>
                        </li>               
                        <?php
                            } 
                            } 
                        ?>   
                                         
                    </ul>
                </nav>
                <!-- /.menu -->
            </div>
            <!-- /.sidebar -->

        </aside>
        <!-- /.MENU  -->

        <!-- MAIN CONTENIDO -->
        <div class="content-wrapper" id="admin">
            <?php 
                if($vista == 'DInterno'):
                    $this->load->view($content_for_layout,$datos_ventana);
                else:                    
                    if($vista == 'DPerfil'):
                        $this->load->view($content_for_layout,$datos_ventana);
                    else:
                        $this->load->view($content_for_layout);
                    endif;
                endif;
            ?>
        </div>
        <!-- /.PAGE  -->

        <!-- MAIN FOOTER -->
        <footer class="main-footer">
            <strong>Copyright &copy; sistemas :: 2018-2020 <a href="http://grupofs.com">GrupoFS</a>.</strong>
            Todos los Derechos Reservados. - All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0 
            </div>
        </footer>
        <!-- /.FOOTER  -->

        <!-- Panel Lateral D - CONTACTOS -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.Panel Lateral D - CONTACTOS -->        


        <div class="modal fade" id="modalExpired">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">CIERRE DE SESIÓN</h4>
                        <button type="button" id="cerrarModal" name="cerrarModal" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>                    
                    <!-- Modal body -->
                    <div class="modal-body">                    
                        <div class="callout callout-danger">
                            <p>EN:</p>
                            <h1 id="timerDiv" style="text-align:center"></h1>
                            <br>
                            <p class="text-danger">Cuenta regresiva antes de cierre de sesión de forma automática</p>
                        </div>
                    </div>                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" id="btnContinuar" name="btnContinuar" class="btn btn-block btn-success btn-lg" data-dismiss="modal">Continuar</button>
                    </div>                    
                </div>
            </div>
        </div>        


    </div>

    <!-- SCRIPTS -->
        <!-- jQuery -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip 
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>-->
        <!-- Bootstrap 4 -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- jquery-validation -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?php echo public_url(); ?>template/GUI/plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- moment-->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/moment/moment.min.js"></script> 
        <!-- InputMask -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <script src="<?php echo public_url(); ?>template/GUI/plugins/moment/locale/es.js"></script>
        <!-- bs-custom-file-input -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- date-range-picker -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/daterangepicker/daterangepicker.js"></script> 
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Bootstrap Switch -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <!-- Select2 -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/select2/js/select2.full.min.js"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
        <!-- Summernote  -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="<?php echo public_url(); ?>template/GUI/plugins/summernote/lang/summernote-es-ES.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="<?php echo public_url(); ?>template/GUI/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- SweetAlert2-->
        <script src="<?php echo public_url(); ?>/template/GUI/plugins/sweetalert2/sweetalert2.min.js"></script> 
        <!-- Ekko Lightbox -->
        <script src="<?php echo public_url(); ?>/template/GUI/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>        
        <!-- DataTable.net -->
        <script src="<?php echo public_url(); ?>template/DataTable/DataTables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo public_url(); ?>template/DataTable/DataTables/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo public_url(); ?>template/DataTable/DataTables/js/datatables.settingsDefault.js"></script>
        <script src="<?php echo public_url(); ?>template/DataTable/Responsive/js/dataTables.responsive.min.js"></script> 
        <script src="<?php echo public_url(); ?>template/DataTable/DataTables/js/datetime.js"></script> 
        <script src="<?php echo public_url(); ?>template/DataTable/Select/js/dataTables.select.min.js"></script> 
        <script src="<?php echo public_url(); ?>template/DataTable/Checkboxes/js/dataTables.checkboxes.min.js"></script>   
        <script src="<?php echo public_url(); ?>template/DataTable/RowGroup/js/dataTables.rowGroup.min.js"></script> 
        <!-- file input -->
        <script src="<?php echo public_url(); ?>template/plugins/fileinput/fileinput.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo public_url(); ?>template/GUI/dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo public_url(); ?>template/GUI/dist/js/demo.js"></script>
        <!-- Principal Main -->
        <script src="<?php echo public_url(); ?>script/principal.js?v1000000002"></script>
    <!-- /.SCRIPTS  -->

    <!-- Script Generales -->
    <script type="text/javascript">
        const BASE_URL = "<?php echo base_url();?>";
        var baseurl = "<?php echo base_url();?>";
        var ccia = "<?php echo $ccia ?>";
        $(document).ready(function() {

            //Date picker
            $('.datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoclose: true,
                theme: 'bootstrap4',
                locale: {
                    format: 'DD/MM/YYYY',
                    daysOfWeek: [
                        'Do',
                        'Lu',
                        'Ma',
                        'Mi',
                        'Ju',
                        'Vi',
                        'Sa'
                    ],
                    monthNames: [
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Setiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre'
                    ]
                }
            });

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

        });
    </script>

    <?php echo $this->layout->getJs(); ?>

</body>
</html>




