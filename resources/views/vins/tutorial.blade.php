@extends('layouts.app')
@section('content')
<section class="content-header">
   <h1 class="pull-left">Tutorial de Uso</h1>
</section>
<div class="content">
<div class="clearfix"></div>
@include('flash::message')
<div class="clearfix"></div>
<div class="box box-primary">
<div class="box-body">
   <h1 class="box-title">Manual de Gesti&oacute;n de ThunderVIN</h1>
   <h4>
      En los siguientes paneles encontrar&aacute; la informaci&oacute;n para la utilizaci&oacute;n &oacute;ptima y adecuada del Panel de Control de ThunderVIN.
   </h4>
   <h5>Para acceder a cada tema, haga clic encima de cada bot&oacute;n para mostrar su contenido.</h5>
   <p><b>Nota importante:</b> Para una mejor experiencia de usuario en toda la plataforma, por favor utilice otro navegador diferente a Internet Explorer en versiones inferiores a IE 11  (Microsoft Edge). Pruebas realizadas han comprobado que pueden ocurrir fallos en la gesti&oacute;n de informaci&oacute;n, uso de calendarios y carga de archivos, por lo que recomendamos utilizar navegadores como Google Chrome o Mozilla Firefox. Gracias.</p>
</div>
<div class="box-body tutorial-cards">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-12">
                  <div id="card-1">
                     <div class="card">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" data-parent="#card-1" href="#card-element-1">
                              <h3 class="box-title">1. Acceder a ThunderVIN</h3>
                           </a>
                        </div>
                        <div id="card-element-1" class="collapse">
                           <div class="card-body">
                              <div class="col-md-5">
                                 <img alt="Tutorial" src="{{asset('frontend/img/tutorial/1-login.png')}}" class="tut-img" />
                              </div>
                              <div class="col-md-7">
                                 <h4 class="box-title">Accediendo a ThunderVIN</h4>
                                 <p>
                                   Deber&#225; ingresar desde la URL <a href="https://campanas-servicio.cl/admin/" target="_blank" class="link-consultas">https://campanas-servicio.cl/admin/</a>, e ingresar el correo electr&#243;nico y contrase&#241;a asignados a su usuario al momento de la creaci&#243;n del mismo en el sistema de ThunderVIN.
                                 </p>
                                 <p>Al dar clic en "Recu&#233;rdame", si la configuraci&#243;n de su navegador lo permite, se guardar&#225;n los datos de acceso para un ingreso r&#225;pido en futuras ocasiones.</p>
                                 
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header">
                           <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-2">
                              <h3 class="box-title">2. Cambiar la contrase&#241;a</h3>
                           </a>
                        </div>
                        <div id="card-element-2" class="collapse">
                           <div class="card-body">
                              <div class="col-md-5">
                                 <img alt="Tutorial" src="../../frontend/img/tutorial/2-reset.png" class="tut-img" />
                              </div>
                              <div class="col-md-7">
                                 <h4 class="box-title">Proceso de cambio de contrase&#241;a</h4>
                                 <p>
                                    Puede hacer clic en el enlace "Olvid&#233; mi contrase&#241;a" o ingresar desde la URL <a href="https://campanas-servicio.cl/password/reset" target="_blank" class="link-consultas">https://campanas-servicio.cl/password/reset</a>, e ingresar el correo electr&#243;nico al cual desea recibir el enlace de cambio de contrase&#241;a.
                                 </p>
                                 <p>En pocos minutos recibir&#225; en el correo indicado un enlace, el cual dirigir&#225; a la p&#225;gina desde la cual podr&#225; asignar una nueva contrase&#241;a. Una vez guardada, inicie sesi&#243;n nuevamente con la nueva contrase&#241;a.</p>
                                 <p>Si no ha recibido el mensaje r&#225;pidamente en su correo electr&#243;nico, recuerde buscar en la carpeta de "SPAM o Correo No Deseado" y agregar el mensaje a la lista de correos deseados (lista segura).</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header">
                           <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-3">
                              <h3 class="box-title">3. Panel de Control</h3>
                           </a>
                        </div>
                        <div id="card-element-3" class="collapse">
                           <div class="card-body">
                              <div class="col-md-5">
                                 <span class="tut-count-number">1</span>
                                 <img alt="Tutorial" src="{{asset('frontend/img/tutorial/3-panel.png')}}" class="tut-img" />
                                 <span class="tut-count-number">2</span>
                                 <img alt="Tutorial" src="{{asset('frontend/img/tutorial/3-panel-2.png')}}" class="tut-img" />
                                 <span class="tut-count-number">3</span>
                                 <img alt="Tutorial" src="{{asset('frontend/img/tutorial/3-panel-3.png')}}" class="tut-img" />
                                 <span class="tut-count-number">4</span>
                                 <img alt="Tutorial" src="{{asset('frontend/img/tutorial/3-panel-4.png')}}" class="tut-img-2" />
                              </div>
                              <div class="col-md-7">
                                 <h4 class="box-title">Gesti&#243;n del Panel</h4>
                                 <p>
                                    1. El panel inicial facilita una vista r&#225;pida de los procesos que se han generado en el uso de la plataforma. Igualmente ofrece una navegaci&#243;n r&#225;pida a las funciones inclu&#237;das, mediante el men&#250; de navegaci&#243;n lateral.
                                 </p>
                                 <p>2. La parte superior del panel de inicio se compone de:
                                 <ul>
                                    <li><b>Nuevas Consultas:</b>Permite ver la totalidad de consultas que se han realizado en busca de VINes, desde todos los paneles de cada marca que se pueden acceder directamente desde cada p&#225;gina web de las marcas por separado.</li>
                                    <li><b>Consultas Efectivas en Total:</b> Contabiliza &#250;nicamente las consultas en las cuales SI hab&#237;a un VIN asociado a una campa&#241;a.</li>
                                    <li><b>Consultas Realizadas &#218;ltimo Mes:</b> Muestra la informaci&#243;n variable de la cantidad de consultas recibidas (en total) en los &#250;ltimos 30 d&#237;as calendario.</li>
                                    <li><b>Consultas Efectivas &#218;ltimo Mes:</b>Contabiliza &#250;nicamente las consultas en las cuales SI hab&#237;a un VIN asociado a una campa&#241;a en los &#250;ltimos 30 d&#237;as calendario.</li>
                                 </ul>
                                 </p>
                                 <p>3. La parte inferior del panel permite un acceso a las vistas de Gesti&#243;n de Campa&#241;as por Marca, y la creaci&#243;n r&#225;pida de las mismas.</p>
                                 <p>4. <b>Nota General:</b> Para facilitar la edici&#243;n y eliminaci&#243;n de los datos ya creados en el sistema, todas las funciones del mismo a partir de este punto ser&#225;n susceptibles de edici&#243;n, eliminaci&#243;n, desactivaci&#243;n y activaci&#243;n desde estos botones. </p>
                              </div>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-header">
                              <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-4">
                                 <h3 class="box-title">4. Administrar Campa&#241;as por Marca</h3>
                              </a>
                           </div>
                           <div id="card-element-4" class="collapse">
                              <div class="card-body">
                                 <div class="col-md-5">
                                    <span class="tut-count-number">1</span>
                                    <img alt="Tutorial" src="../../frontend/img/tutorial/4-admin-marca-5.png" class="tut-img" />
                                    <span class="tut-count-number">2</span>
                                    <img alt="Tutorial" src="../../frontend/img/tutorial/4-admin-marca.png" class="tut-img" />
                                    <span class="tut-count-number">3</span>
                                    <img alt="Tutorial" src="../../frontend/img/tutorial/4-admin-marca-0.png" class="tut-img" />
                                    <span class="tut-count-number">4</span>
                                    <img alt="Tutorial" src="../../frontend/img/tutorial/4-admin-marca-4.png" class="tut-img" />
                                    <span class="tut-count-number">5</span>
                                    <img alt="Tutorial" src="../../frontend/img/tutorial/4-admin-marca-3.png" class="tut-img" />
                                    <span class="tut-count-number">6</span>
                                    <img alt="Tutorial" src="../../frontend/img/tutorial/4-admin-marca-6.png" class="tut-img" />
                                 </div>
                                 <div class="col-md-7">
                                    <h4 class="box-title">Gestionar la informaci&#243;n de campa&#241;as seg&#250;n cada marca</h4>
                                    <p>
                                       1. Para acceder a cada marca desde el men&#250; lateral, haga clic en el &#237;tem "Administrar por marca" y seleccionar la marca deseada con un clic.
                                    </p>
                                    <p>2. Este panel, de forma similar al principal, permite ver la totalidad de informaci&#243;n computada dentro del sistema pero ya filtrada por cada marca.
                                    </p>
                                    <p>3. La parte superior del panel muestra 3 resultados del sistema para la marca respectiva: Total de Consultas y Consultas Efectivas, m&#225;s el c&#243;mputo porcentual de ambos: Efectividad de Consultas. Adicionalmente los resultados de "Campa&#241;as m&#225;s Consultadas" se pueden filtrar y reordenar r&#225;pidamente.</p>
                                    <p>4. La gr&#225;fica din&#225;mica muestra el desempe&#241;o en las consultas para cada marca en el transcurso de un a&#241;o, y se actualiza gradualmente. </p>
                                    <p>5. El bot&#243;n verde "Ver m&#225;s" permite desplegar una vista independiente, donde se puede ver en formato m&#225;s grande la vista de resultados de las "Campa&#241;as m&#225;s Consultadas" </p>
                                    <p>6. El bot&#243;n "Ver m&#225;s" de cada campa&#241;a enlistada le permite ver toda la informaci&#243;n asociada con cada campa&#241;a, incluyendo los c&#243;mputos asociados a su consulta, como extensi&#243;n informativa. </p>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header">
                                 <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-5">
                                    <h3 class="box-title">5. Gestionar el M&#225;ster de Campa&#241;as</h3>
                                 </a>
                              </div>
                              <div id="card-element-5" class="collapse">
                                 <div class="card-body">
                                    <div class="col-md-5">
                                       <span class="tut-count-number">1</span>
                                       <img alt="Tutorial" src="../../frontend/img/tutorial/5-master-campanas.png" class="tut-img" />
                                       <span class="tut-count-number">2</span>
                                       <img alt="Tutorial" src="../../frontend/img/tutorial/5-master-campanas-2.png" class="tut-img" />
                                    </div>
                                    <div class="col-md-7">
                                       <h4 class="box-title">Gesti&#243;n de las campa&#241;as en su totalidad</h4>
                                       <p>
                                          1. El M&#225;ster de Campa&#241;as es el eje de consulta de informaci&#243;n de todo el sistema ThunderVIN, por lo que sus cambios afectan todo contenido y los elementos que ac&#225; sean eliminados, lo ser&#225;n de manera irreversible.
                                       </p>
                                       <p>En el panel dispuesto para su consulta, se pueden filtrar las columnas visibles, hacer b&#250;squedas espec&#237;ficas de informaci&#243;n, imprimir, exportar a .CSV y .XLS los datos consignados hasta la fecha.</p>
                                       <p>2. Al pulsar el bot&#243;n "Crear Nueva Campa&#241;a" podr&#225; generar una nueva en el sistema, para lo cual requerir&#225; diligenciar los campos establecidos y cargar el archivo .txt asociado a la campa&#241;a, sin hacerle modificaciones. Recuerde que al dar clic al bot&#243;n "+" en "L&#237;neas afectadas por Campa&#241;a" se generar&#225;n autom&#225;ticamente ambas l&#237;neas, las cuales siempre dber&#225;n estar diligenciadas.</p>
                                       <p>Para guardar una nueva campa&#241;a, o guardar los cambios realizados en una ya creada, haga clic en el bot&#243;n "Crear/Actualizar Campa&#241;a" y revise en el M&#225;ster los datos que necesite.</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-6">
                                       <h3 class="box-title">6. Consulta de VINes</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-6" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/6-consulta-vines.png" class="tut-img" />
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Para visualizar la  cantidad de consultas por cada VIN registrado</h4>
                                          <p>
                                             La consulta de Vines permite filtrar por Marca, Cantidad de Consultas y Fecha de &#250;ltima consulta la informaci&#243;n de la tabla. Si requiere filtrar r&#225;pidamente, ingrese los datos de b&#250;squeda en el &#225;rea "Buscar" ubicada en la parte superior derecha de la tabla.
                                          </p>
                                          <p>Igualmente se puede exportar para .CSV y .XLS la totalidad de Vines registrados como CONSULTADOS, pues esta vista no registra VINes no buscados a la fecha.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-7">
                                       <h3 class="box-title">7. Actualizar Campa&#241;as</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-7" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/7-actualizacion-campanas.png" class="tut-img" />
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/7-actualizacion-campanas-2.png" class="tut-img" />
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">En este panel se actualizan campa&#241;as con sobreescritura de los datos</h4>
                                          <p>
                                             Esta herramienta agiliza la carga r&#225;pida de Campa&#241;as de Servicio actualizando la base de datos de una marca &#250;nica, para que el cliente solo pueda acceder a campa&#241;as activas.
                                             Si desea actualizar una campa&#241;a, seleccione la marca deseada y haga clic en el bot&#243;n Cargar y Actualizar Campa&#241;a para subir el nuevo archivo, el sistema mostrar&#225; la ventana desde la cu&#225;l puede buscar los archivos en su equipo y seleccionarlos para la carga.
                                          </p>
                                          <p>Una vez ingresados los datos y cargados los archivos .TXT, el sistema generar&#225; la carga y actualizar&#225; la informaci&#243;n disponible para la campa&#241;a, y dar&#225; de baja los VINes que ya no aparezcan. De esta manera se mantienen en el sistema solo datos vigentes.</p>
                                          <p> Al finalizar la carga se notificar&#225; la carga exitosa. Si se presenta una falla, refresque su navegador (teclas CTRL+R) e intente nuevamente. Por favor abst&#233;ngase de manipular los archivos .TXT o cambiarlos, puede generar fallos en su lectura. Si el problema persiste, contacte a soporte.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-8">
                                       <h3 class="box-title">8. Gestionando Usuarios</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-8" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <span class="tut-count-number">1</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/8-gestion-usuarios.png" class="tut-img" />
                                          <span class="tut-count-number">2</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/8-gestion-usuarios-2.png" class="tut-img" />
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Para crear y eliminar usuarios para el sistema.</h4>
                                          <p>
                                             En el panel inicial de la Gestión de Usuarios se pueden ver el nombre de usuario, la cuenta de correo, la fecha de creaci&#243;n del usuario y la posibilidad de editar sus datos o eliminarlo del sistema. 
                                          </p>
                                          <p>Al igual que en los otros paneles, desde este podr&#225; exportar el listado de usuarios a .CSV y .XLS, as&#237; como filtrar por b&#250;squeda.</p>
                                          <p>Por seguridad de la plataforma se recomienda cambiar las contrase&#241;as de usuario anualmente, al igual que eliminar usuarios asociados a ex-empleados de la organizaci&#243;n a la mayor brevedad.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-9">
                                       <h3 class="box-title">9. Revisando Logs</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-9" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/9-consulta-logs.png" class="tut-img" />
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Los logs son registros a la grabaci&#243;n secuencial en un archivo o en una base de datos de todos los acontecimientos asociados a una acci&#243;n y a un usuario.</h4>
                                          <p>
                                             En este panel permanecer&#225; un registro de accesos, acciones, usuarios, archivos, IPs, fechas y cambios realizados dentro de la plataforma. 
                                          </p>
                                          <p>Por motivos de funcionalidad,  este panel genera un registro autom&#225;tico de informaci&#243;n que no se puede editar ni eliminar, pero si filtrar por b&#250;squeda y exportar a .CSV y .XLS, usualmente relacionado con procesos de seguimiento y auditor&#237;a.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-10">
                                       <h3 class="box-title">10.Revisando registros hist&#243;ricos</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-10" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/10-generar-historicos.png" class="tut-img" />
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Consultando todo lo hecho en la plataforma</h4>
                                          <p>
                                             En este panel el sistema generar&#225; una consulta a la base de datos, donde se exportar&#225;n a .XLS los datos de toda una campa&#241;a.
                                          </p>
                                          <p>Para generar el reporte, usted deber&#225; seleccionar la marca y buscar o ingresar directamente el c&#243;digo de campa&#241;a. Luego haga clic en "Generar reporte y descargar" y espere un momento. La descarga del archivo generado iniciar&#225; en inmediatamente y se guardar&#225; por defecto en la carpeta "Descargas" (Downloads) de su sistema, donde usted podr&#225; renombrarla y consultar su informaci&#243;n.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-11">
                                       <h3 class="box-title">11. Haciendo consultas en ThunderVIN</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-11" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <span class="tut-count-number">1</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/12-busqueda-vin.png" class="tut-img" />
                                          <span class="tut-count-number">2</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/12-busqueda-vin-2.png" class="tut-img" />  <span class="tut-count-number">3</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/12-busqueda-vin-3.png" class="tut-img" />
                                          <span class="tut-count-number">4</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/12-busqueda-vin-4.png" class="tut-img" />
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Consultando un VIN desde las p&#225;ginas de las marcas</h4>
                                          <p>
                                             La consulta de VINes es el mayor generador de cambios en tiempo real de los datos computados dentro del sistema ThunderVIN. 
                                          </p>
                                          <p>Para generar una consulta, el cliente debe ingresar los 17 caracteres en la p&#225;gina de Campa&#241;as de Seguridad y Servicio correspondiente a la marca de su veh&#237;culo, y el sistema le indicar&#225; si existen o no campa&#241;as asociadas, y le mostrar&#225; el bot&#243;n de Concesionarios a los cuales poder dirigirse. Los accesos a dichas p&#225;ginas son:</p>
                                          <p><b>1. VOLKSWAGEN PKW y LCV: </b> <a href="https://www.volkswagen.cl/tengo-un-vw/campanas-preventivas" target="_blank" class="link-consultas">Ir a p&#225;gina de consulta</a></p>
                                          <p><b>2. AUDI: </b> <a href="https://www.audi.cl/postventa/consultasactualizaciones" target="_blank" class="link-consultas">Ir a p&#225;gina de consulta</a></p>
                                          <p><b>3. SEAT: </b> <a href="https://www.seat.cl/servicio-seat/servicio-seat/campanas-de-seguridad" target="_blank" class="link-consultas">Ir a p&#225;gina de consulta</a></p>
                                          <p><b>4. &#138;KODA: </b> <a href="https://www.skoda.cl/experiencia-skoda/actualizacionescampanas" target="_blank" class="link-consultas">Ir a p&#225;gina de consulta</a></p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-12">
                                       <h3 class="box-title">12. Exportando datos a plataforma externa de Business Intelligence (B.I.)</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-12" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <span class="tut-count-number">1</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/13-exportacion-bi-1.png" class="tut-img" />
                                          <span class="tut-count-number">2</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/13-exportacion-bi-2.png" class="tut-img" style="max-width:50%;" />  
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Exportaci&oacute;n automatizada</h4>
                                          <p>
                                             Este es un proceso automatizado, que diariamente a las 3:00 a.m. exporta al FTP ftp.porsche-ftp.co, en la carpeta "in", los archivos .txt correspondientes a la fecha, conteniendo la informaci&aacute;n que alimenta la base de datos externa del software de B.I., con los datos: Consultas, Campa&ntilde;as, Revisiones y Homologaci&oacute;n de Marcas, dise&ntilde;ados para ese sistema. Una vez exportados los archivos:
                                          </p>
                                          <p>1. Se registrar&aacute; en el sistema interno de notificaciones de ThunderVIN. </p>
                                          <p>2. Se registrar&aacute; el dato en la vista de "Exportaci&oacute;n B.I.", para consultar desde el panel de ThunderVIN. </p>
                                          <p>Nota: Los datos de acceso a este FTP son restringidos, solic&iacute;telos con el funcionario encargado de Tableros de Garant&iacute;as.</p>
                                          <h4 class="box-title">Exportaci&oacute;n manual</h4>
                                          <p>En caso de requerirse, ThunderVIN facilita la exportaci&oacute;n manual al FTP asignado, al hacer clic en el bot&oacute;n "Exportar manualmente". Encontrar&aacute; igualmente en la carpeta "in" los archivos .txt generados.</p>
                                        
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-13">
                                       <h3 class="box-title">13. Consultando los Errores de Importaci&oacute;n desde la plataforma externa de Business Intelligence (B.I.)</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-13" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <span class="tut-count-number">1</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/14-log-errores-1.png" class="tut-img" />
                                          <span class="tut-count-number">2</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/14-log-errores-2.png" class="tut-img" style="max-width:50%;" />  
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Importaci&oacute;n automatizada</h4>
                                          <p>
                                             Este es un proceso automatizado, que diariamente a las 20:33 p.m. importa desde el FTP ftp.porsche-ftp.co, en la carpeta "errores", los reportes de fallos generados desde la plataforma externa del software de B.I., con los archivos .xlsx "Errores_funcionales_fecha" y "Errores_tecnicos_fecha", que aparecer&aacute;n si y solo si han ocurrido errores en la importaci&oacute;n de la informaci&oacute;n desde esa plataforma externa. 
                                             </p>
                                          <p>En caso de que solo exista un tipo de error o ninguno, se cargar&aacute; un &uacute;nico archivo. En todo caso, siempre que exista un reporte de error, este se leer&aacute; en la carpeta del FTP "errores" y:</p>
                                          <p>1. Se registrar&aacute; en el sistema interno de notificaciones de ThunderVIN. </p>
                                          <p>2. Enviar&aacute; un email de notificaci&oacute;n a los correos administrados por la plataforma de B.I. </p>
                                          <p>3. Se registrar&aacute; el dato en la vista de "Log de Errores de Importaci&oacute;n", para consultar desde el panel de ThunderVIN. </p>
                                          <p>Nota: Los datos de acceso a este FTP son restringidos, solic&iacute;telos con el funcionario encargado de Tableros de Garant&iacute;as.</p>
                                          <h4 class="box-title">Importaci&oacute;n manual</h4>
                                          <p>En caso de requerirse, ThunderVIN facilita la importaci&oacute;n manual al FTP asignado, al hacer clic en el bot&oacute;n "Importar manualmente archivo de errores".</p>
                                          <p> Para ello aseg&uacute;rese que los archivos .xlsx ya han sido generados y se encuentran en la carpeta "errores" del FTP asignado.</p>
                                        
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-14">
                                       <h3 class="box-title">14. Consultando las notificaciones</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-14" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <span class="tut-count-number">1</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/15-notificaciones-2.png" class="tut-img"  style="max-width:50%;"/>
                                          <div style="clear:both;"></div>
                                          <span class="tut-count-number">2</span>
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/15-notificaciones-1.png" class="tut-img" />  
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Consulta r&aacute;pida</h4>
                                          <p>
                                             En la parte superior derecha,  junto al bot&oacute;n del usuario, encontrar&aacute;  un &iacute;cono de campana con un contador de notificaciones. Este n&uacute;mero mostrar&aacute; la cantidad de notificaciones actuales relacionados con los procesos de automatizaci&oacute;n (importaci&oacute;n y exportaci&oacute;n) relacionados con la plataforma externa de B.I.
                                          </p>
                                          <p>Para consultarlas, solo haga clic sobre el &iacute;cono y se desplagar&aacute;n las alertas recientes.</p>
                                          <p>Si desea consultar todas las notificaciones, en la parte inferior del listado desplegado encontrar&aacute; el bot&oacute;n "Ver todas las alertas", que abrir&aacute; una vista donde puede consultarlas y filtrarlas al detalle.</p>
                                        
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" data-parent="#card-1" href="#card-element-15">
                                       <h3 class="box-title">15. Cerrando sesi&#243;n</h3>
                                    </a>
                                 </div>
                                 <div id="card-element-15" class="collapse">
                                    <div class="card-body">
                                       <div class="col-md-5">
                                          <img alt="Tutorial" src="../../frontend/img/tutorial/11-editar-perfil-salir.png" class="tut-img" />
                                       </div>
                                       <div class="col-md-7">
                                          <h4 class="box-title">Cerrar sesi&#243;n dentro del sistema</h4>
                                          <p>
                                             Para llevar un registro controlado de las sesiones de usuario en el Log, es necesario que al finalizar la utilizaci&#243;n de la plataforma, el usuario lo haga desde el bot&#243;n ubicado en la parte superior derecha en la plataforma, y de clic en el bot&#243;n "Salir".
                                          </p>
                                          <p>En el caso excepcional en que necesite cambiar o actualizar alg&#250;n dato relacionado con su perfil de usuario, podr&#225; hacer modificaciones a este desde el bot&#243;n "Editar perfil" que lo llevar&#225; a la vista de "Editar usuario".</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div></div>
</div>
@endsection
