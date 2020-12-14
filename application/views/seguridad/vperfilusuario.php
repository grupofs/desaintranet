<?php
    $idusu = $this -> session -> userdata('s_idusuario');
    $idemp = $this -> session -> userdata('s_idempleado');
    $idadm = $this -> session -> userdata('s_idadministrado');
    $usu = $this -> session -> userdata('s_usuario');
    $cusuario = $this -> session -> userdata('s_cusuario');
    $imgperfil = $this->session->userdata('s_druta'); 
    $cia = $this-> session-> userdata('s_cia');
  
    foreach($datos_perfil as $mresumenperfil){ 
      $anexo = $mresumenperfil->anexo;
      $cel_empresa = $mresumenperfil->cel_empresa;
      $nomarea = $mresumenperfil->nomarea;  
      $nombre_cargo = $mresumenperfil->nombre_cargo;
      $email = $mresumenperfil->email;
    }  
?>

<style>
    .img-perfil{
        width: 200px !important;
    }
    #file-input{
        display: none;
    }
    .text-center img{     
        cursor: pointer; 
        text-align: center;       
    }
    .text-center:hover img{
        opacity: 0.6;        
        filter:brightness(0.4);
    }
    #border{
        border-radius: 50px 50px;
        border: 1px solid #008d4c;
    }
    .li-perfil{
        border: 0px rgba(0,0,0,0) !important;
        background-color: rgba(0,0,0,.0) !important;
    }

</style>

<!-- content-header -->
<div class="content-header">   
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">PERFIL DE USUARIO</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo public_base_url(); ?>main">Home</a></li>
          <li class="breadcrumb-item active">Mantenimiento de perfil</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">  
        <div class="card card-solid">  
            <div class="card-body"> 
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-gray-dark card-outline">
                            <div class="card-body box-profile">
                                <h2><i class="fa fa-user"></i> Mi Perfil</h2>
                                <div class="text-center">
                                    <form id="frmFileinput" name="frmFileinput" method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="hdnIdusu" name="hdnIdusu" value="<?php echo $idusu ?>">
                                        <input type="hidden" id="hdnCusuario" name="hdnCusuario" value="<?php echo $cusuario ?>">  
                                        <label for="file-input"> 
                                            <img src="<?php echo public_url_ftp(); ?>Imagenes/user/<?php echo $imgperfil ?>" alt="Foto de Perfil" class="profile-user-img img-fluid img-circle img-perfil" style="border: 3px solid #adb5bd; padding: 3px;" title="Click para cambiar de foto ">
                                        </label>
                                        <input id="file-input" name="file-input" type="file" onchange="changeFiles()" ref="image"/> 
                                    </form>
                                </div> 
                                <h3 class="profile-username text-center"><?php echo $usu ?></h3>
                                <p class="text-muted text-center"><?php echo $nombre_cargo ?></p>                 
                                <div id="border">
                                    <ul class="list-group mb-6">
                                        <li class="list-group-item li-perfil">
                                            <div class="row">
                                                <div class="col-4">
                                                    <b>Área : </b>
                                                </div> 
                                                <div class="col-8">
                                                    <a><?php echo $nomarea ?></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item li-perfil">
                                            <div class="row">
                                                <div class="col-4">
                                                    <b>Email : </b>
                                                </div> 
                                                <div class="col-8">
                                                    <a><?php echo $email ?></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item li-perfil">
                                            <div class="row">
                                                <div class="col-4">
                                                    <b>Anexo : </b>
                                                </div> 
                                                <div class="col-8">
                                                    <a><?php echo $anexo ?></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item li-perfil">
                                            <div class="row">
                                                <div class="col-4">
                                                    <b>Celular : </b>
                                                </div> 
                                                <div class="col-8">
                                                    <a><?php echo $cel_empresa ?></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-gray-dark card-outline">
                            <form class="form-horizontal" id="frmDatosPersonales" action="<?= base_url('cperfilusuario/setperfil')?>" method="POST" enctype="multipart/form-data" role="form">
                                <div class="card-body">
                                    <h2><i class="fa fa-id-card"></i>  Datos Personales</h2>
                                
                                    <input type="hidden" id="hdnIdadm" name="hdnIdadm" value="<?php echo $idadm ?>"> <!-- ID -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="text-info">Nombres</div>
                                                <div> 
                                                <input type="text" class="form-control" id="txtnombperfil" name="txtnombperfil" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-info">Apellido Paterno</div>
                                                <div> 
                                                <input type="text" class="form-control" id="txtapepatperfil" name="txtapepatperfil" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-info">Apellido Materno</div>
                                                <div> 
                                                <input type="text" class="form-control" id="txtapematperfil" name="txtapematperfil" >
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="text-info">Documentos <span style="color: #FD0202">*</span></div>
                                                <div>   
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span id="btntipodoc">DNI</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" onClick="javascript:tddni()">DNI</a>
                                                                <a class="dropdown-item" onClick="javascript:tdcex()">C.EXT</a>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="txtNrodoc" id="txtNrodoc" data-validation="required"/>
                                                    </div>                                                                                 
                                                    <input type="hidden" name="txtTipodoc" id="txtTipodoc" value="1">  
                                                </div> 
                                            </div> 
                                            <div class="col-md-8">
                                                <div class="text-info">Direccion</div>
                                                <div> 
                                                <input type="text" class="form-control" id="txtdirperfil" name="txtdirperfil" >
                                                </div>
                                            </div> 
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="text-info">Correo Electrónico</div>
                                                <div> 
                                                <input type="text" class="form-control" id="txtemailperfil" name="txtemailperfil" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="text-info">Número de Telefono</div>
                                                <div> 
                                                <input type="text" class="form-control" id="txtfonoperfil" name="txtfonoperfil" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="text-info">Número de Celular</div>
                                                <div> 
                                                <input type="text" class="form-control" id="txtcelperfil" name="txtcelperfil" >
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success" id="btnGrabPerfil"><i class="fas fa-save"></i> Grabar</button>
                                </div>
                            
                            </form>
                        </div>
                        <div class="card card-gray-dark card-outline">
                            <form class="form-horizontal" id="frmCambiarpws" action="<?= base_url('cperfilusuario/setclave')?>" method="POST" enctype="multipart/form-data" role="form">
                                <div class="card-body">
                                    <h2><i class="fa fa-key"></i>  Cambiar Contraseña</h2>
                                
                                    <input type="hidden" id="hdnIdusu" name="hdnIdusu"> <!-- ID -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="text-info">Nueva Contraseña <span style="color: #FD0202">*</span></div>
                                                <div> 
                                                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="***************"  title="La contraseña debe tener minimo 6 caracteres" required pattern=".{6,}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-info">Confirmar Nueva Contraseña <span style="color: #FD0202">*</span></div>
                                                <div> 
                                                    <input type="password" id="conf_password" name="conf_password" class="form-control" placeholder="***************"  title="Por favor ingrese una contraseña que coincidan" required >
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="card-footer text-right">
                                    <button id="idbtnsave" type="submit" class="btn btn-success" disabled="true"><i class="fa fa-floppy-o"></i>Cambiar contraseña</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.Main content -->