
<script src="<?php echo base_url(); ?>public/mesa/analytics.js"></script>
<script src="<?php echo base_url(); ?>public/mesa/js-common.js"></script>
<script src="<?php echo base_url(); ?>public/mesa/tools.js"></script> 
<style type="text/css">


</style>

<script>
    (function(i,r){i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)}})(window,'ga');
</script>
<script>
    var ABexperimentLeads = 1;
    var ABTestingGDPRDesktop = 1;
    var ABTestingGDPRMobile = 1;
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r].l=1*new Date();
    a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})
    (window,document,'script','//www.google-analytics.com/analytics.js','ga');
</script>        
<script>
    var internalTrackingService = internalTrackingService || {
        triggerSubmit : function() {},
        triggerAbandon : function() {},
        loaded : false
    };
</script>
<body class="layout-tables app-tables-main" data-section="tables">

    <div class="menu-top">
        <div class="menu-top-wrapper">
            <strong class="menu-top-title ellipsis">
            Organizador de Mesas                </strong>
        </div>
    </div>

    <div class="wrapper-tools-tables">
        <span class="tools-tables-left-uncollapse app-tools-grid-menu-open"><i class="icon-tools icon-tools-double-arrow-right icon-left"></i>Menú</span>
        <div id="app-tools-grid-menu" class="tools-tables-left ">
            <div>
                <span class="tools-tables-left-collapse app-tools-grid-menu-close"><i class="icon-tools icon-tools-double-arrow-left icon-left"></i>Ocultar</span>
            </div>
            <div class="tools-tables-left-content separator">
                <p class="tools-tables-left-title">Agregar mesa</p>
                <div class="pure-g mt20 va-flex-middle">
                    <div class="pure-u-1-3 text-center">
                        <a rel="nofollow" class="inline-block app-icon-hover" onclick="modales('2side')" data-icon-new="icon-tools-table-3-active" data-icon-old="icon-tools-table-3" role="button">
                            <i class="app-create-table icon-tools icon-tools-table-3 pointer text-center" data-type="2side"></i>
                        </a>
                    </div>
                    <div class="pure-u-1-3 text-center">
                        <a rel="nofollow" class="inline-block app-icon-hover" onclick="modales('1side')" data-icon-new="icon-tools-table-2-active" data-icon-old="icon-tools-table-2" role="button">
                            <i class="app-create-table icon-tools icon-tools-table-2 pointer text-center" data-type="1side"></i>
                        </a>
                    </div>
                    <div class="pure-u-1-3 text-center">
                        <a rel="nofollow" class="inline-block app-icon-hover" onclick="modales('round')" data-icon-new="icon-tools-table-1-active" data-icon-old="icon-tools-table-1" role="button">
                            <i class="app-create-table icon-tools icon-tools-table-1 pointer text-center" data-type="round"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="tools-tables-left-content pb0">
                <div class="flex">
                    <p class="tools-tables-left-title">Invitados</p>
                    <div class="tools-tables-left-switch">
                        <span class="app-pending-seat pointer" data-pending="0">Todos</span> |
                        <span class="app-pending-seat pointer current" data-pending="1">Pendientes</span>
                    </div>
                </div>
                <div class="mt10 mb20 flex" data-target="#tool-modal" data-toggle="modal" role="button" data-remote="/tools/TablesGuestsAdd?utm=1">
                    <button class="btn-flat red tools-tables-left-content-addGuest">Agregar invitado</button>
                </div>
                <div class="tools-tables-leftSearch">
                    <i class="icon-tools icon-tools-search"></i>
                    <input class="app-tables-guest-search" placeholder="Buscar invitados">
                </div>
            </div>
            <div class="tools-tables-left-content">
                <div class="tools-tables-left-guests app-tables-guest-list">
                    <div class="app-tools-tables-group">
                        <p class="app-tools-tables-group-title tools-tables-left-guests-family-title">Comensales</p>
                        <?php if(isset($data["sillas"][0])){ ?>
                            <?php foreach ($data["sillas"] as $key => $value) { ?>
                                <?php if($value["silla_estado"]!=0){ ?>  
                                <ul class="app-tools-tables-group-family tools-tables-left-guests-family">
                                    <li data-position="0"
                                    <?php if($value["silla_estado"] ==1){ echo 'data-proxy="guestProxyNovio"'; }else{echo 'data-proxy="guestProxyBoy"';}?>                     data-grupo="1"
                                    data-edad=""
                                    data-nombre="<?php echo $value["silla_descripcion"] ?>"
                                    data-apellidos=""
                                    data-seat-id="<?php echo $value["silla_seat_id"] ?>"
                                    data-mesa="<?php echo $value["mesa_idMesaTable"] ?>"
                                    data-parent="<?php echo $value["silla_idsilla"] ?>"
                                    data-idcontact="<?php echo $value["silla_idsilla"] ?>"
                                    data-confirmado="1"
                                    id="i<?php echo $value["silla_idsilla"] ?>"
                                    class="app-tables-persona app-tables-persona-list tools-tables-left-guests-item">
                                    <span class="app-tables-guest-name tools-tables-left-guests-name  parent "><?php echo $value["silla_descripcion"] ?> </span>
                                    <i class="app-tables-guest-icon icon-tools fright relative icon-tools-guest-dropped dropped"></i>
                                    </li>
                                </ul>                               
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div id="app-zero-persona" style="display:none;">
                        <div class="tools-tables-guests-empty">
                            <strong>No hay invitados por sentar</strong>
                            <p>Agrega invitados a tu lista y arrástralos a su mesa</p>
                            <span class="tools-tables-left-addGuest" data-target="#tool-modal" data-toggle="modal" role="button" data-remote="/tools/TablesGuestsAdd?utm=1"><i class="icon-tools icon-tools-tables-add-red icon-left"></i>Agregar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tools-tables-right-content">

            <div class="wrapper-tables-header-buttons main">
                <div class="tools-toggle">
                    <a class="tools-toggle-item active" href="/tools/Tables">Plano</a>
                    <a class="tools-toggle-item " href="/tools/TablesReport">Lista</a>
                </div>
                <div class="tools-toggle">
                    <span class="app-open-layer-pdf tools-toggle-item" data-section="main"><i class="icon-tools icon-tools-download icon-left"></i>PDF</span>
                </div>
            </div>        <div class="app-tables-viewbox tools-tables-viewbox ui-resizable ui-droppable">
                <div class="app-tables-content tools-tables-content"></div>
                <div id="app-container-data" class="dnone"></div>
            </div>
        </div>
    </div>   
        <div id="app-table-info" data-panel-width="1059" data-panel-height="550"></div>


<div tabindex="-1" role="dialog" aria-labelledby="tool-modal-header-planner-show" aria-hidden="true" class="modal" id="initPlannerShow"></div>

<div id="editarmesa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<div tabindex="-1" role="dialog" aria-labelledby="layer-modal-header" aria-hidden="true" class="modal fade" id="app-common-layer"></div>

<div id="fb-root"></div>
    <script id="app-table-data" type="text/javascript">
     [<?php 
        if(isset($data["tabla"][0])){
            $ultimo = count($data["tabla"]);
            $i = 1;
            $mostrar = '';
            foreach ($data["tabla"] as $key => $value) {
                    $divId = $value["mesa_idMesaTable"];
                    $name = $value["mesa_TableName"];
                    $type = $value["mesa_TableType"];
                    $seats = $value["mesa_TableSeats"];
                    $posX = $value["mesa_posX"];
                    $posY = $value["mesa_posY"];
                    $tableHtml = json_encode($value["mesa_codigotext"]);
                if($i != $ultimo){
                   $mostrar = $mostrar.'{"divId":"'.$divId.'","name":"'.$name.'","type":"'.$type.'","seats":'.$seats.',"posX":'.$posX.',"posY":'.$posY.',"tableHtml":'.$tableHtml.'},';
                }else{
                   $mostrar = $mostrar.'{"divId":"'.$divId.'","name":"'.$name.'","type":"'.$type.'","seats":'.$seats.',"posX":'.$posX.',"posY":'.$posY.',"tableHtml":'.$tableHtml.'}';
                }
                $i++;      
            }
            echo $mostrar;
        }
    ?>]
    </script>
    <script type="text/javascript">
        var focusanterior = '';
        var focusactual = '';
        $(function(){
        	$( ".app-table-edit" ).remove();
        	$(".app-rotate-table").remove();
        	$(".app-tables-persona").draggable({ disabled: true });
        	$(".ui-state-disabled").css("opacity",'2.35');
        });
        function modalventa(id,idlugar){
        cargar = loading();
        $("#editarmesa").empty().html(cargar);
        url = base_url+"Adminmesa/traersillas";
        $("#editarmesa").modal({show: 'false'});
        $.post(url,{"id" : id,"idlugar" : idlugar}, function(data){     
            html='';
            html1='';
            html+='<div class="modal-dialog">';
            html+='<div class="modal-content">';
            html+='<div class="modal-content">';
            html+='    <div class="modal-header">';
            html+='        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            html+='        <h5 class="modal-title">Nueva venta - '+data["mesa"][0]["mesa_TableName"]+ '('+data["mesa"][0]["lugarmesa_descripcion"]+')</h5>';
            html+='    </div>';
            html+='    <div class="modal-body">';
            html+= '<div class="modal-addTable-content">';
            var aux = 0;
            var band = 2;
            contador = 0;
            idsill = '';
            do{
                html+= '<div class="row">'; 
                for (var i = aux ; i < data["sillas"].length; i++) {
                   html+=' <div class="col-md-4" ><button type="button'+data["sillas"][i]["silla_idsilla"]+'" id="boton'+data["sillas"][i]["silla_idsilla"]+'" name="boton'+data["sillas"][i]["silla_idsilla"]+'" value="0" onclick="realizarventa('+data["sillas"][i]["mesa_id"]+','+data["sillas"][i]["silla_idsilla"]+','+data["sillas"][i]["silla_estado"]+')" class="btn btn-'+data["sillas"][i]["nombre_color"]+' btn-anim btn-lg"><i>'+data["sillas"][i]["nombre_estado"]+'</i><span class="btn-text">'+data["sillas"][i]["nombre_silla"]+'</span></button></div>';
                   if(data["sillas"][i]["silla_estado"] == 0 && contador == 0){
                        focusactual = 'boton'+data["sillas"][i]["silla_idsilla"];
                        idsill = data["sillas"][i]["silla_idsilla"];
                        contador++;
                   }
                   if(i == band){break;}
                }
                band = band +3;
                aux = (i+1);
                html+= '</div>';
                html+='<br>';
            }while(aux <data["sillas"].length );
            if (idsill!='') {
                html+='<div id="opcionesventa" class="row"><div id="footer-toolbar"><div id="margen-pie" style="z-index:0;"><div class="col-md-4"><a name="procedimiento" id="procedimiento" onclick="llamarfuncion('+idsill+',1)" value="option1"><img style="height: 80px; width: 80px;" src="public/img/pedido.png"></a><p><span class="texto">VENTA</span></p></div><div class="col-md-4" id="pd"><a onclick="llamarfuncion('+idsill+',2)" name="procedimiento" id="procedimiento" value="option2"><img  style="height: 80px; width: 80px;"src="public/img/vender.png"></a><p><span class="texto">PEDIDO</span></p></div></div></div></div>';

                
            }        
            
            html+= '</div>';
            html+='    </div>';
//          html+='    <div class="modal-footer">';
//          html+='        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
//          html+='        <button type="button" class="btn btn-danger">Save changes</button>';
//          html+='    </div>';
            html+='</div>';
            html+='</div>';
        $("#editarmesa").empty().append(html);
        $('#'+focusactual).css({
            "background" : "#8bc34a",
            "border-top-color": "rgba(244, 245, 28, 0.86)",
            "border-top-style": "solid",
            "border-top-width": "5px",
            "border-right-color": "rgba(244, 245, 28, 0.86)",
            "border-right-style": "solid",
            "border-right-width": "5px",
            "border-bottom-color": "rgba(244, 245, 28, 0.86)",
            "border-bottom-style": "solid",
            "border-bottom-width": "5px",
            "border-left-color": "rgba(244, 245, 28, 0.86)",
            "border-left-style": "solid",
            "border-left-width": "5px",
            "border-image-source": "initial",
            "border-image-slice": "initial",
            "border-image-width": "initial",
            "border-image-outset": "initial",
            "border-image-repeat": "initial"});
        },'json');             
    }
    


    function realizarventa(idmesa,idsilla,sillaestado){
        if (sillaestado == 1) {
            url = base_url+"Adminmesa/comprobarmesero";
            $.post(url,{"idmesa" : idmesa,"idsilla" : idsilla}, function(data){
                if (data[0]["validacion"] == 0) {
                    alertainfo('Usted no tiene permiso...!');
                }
            },'json');
        }else{
            if (sillaestado ==0) {
            html1 = '<div id="footer-toolbar"><div id="margen-pie" style="z-index:0;"><div class="col-md-4"><a name="procedimiento" id="procedimiento" onclick="llamarfuncion('+idsilla+',1)" value="option1"><img style="height: 80px; width: 80px;" src="public/img/pedido.png"></a><p><span class="texto">VENTA</span></p></div><div class="col-md-4" id="pd"><a onclick="llamarfuncion('+idsilla+',2)" name="procedimiento" id="procedimiento" value="option2"><img  style="height: 80px; width: 80px;"src="public/img/vender.png"></a><p><span class="texto">PEDIDO</span></p></div></div></div>';
            $("#opcionesventa").empty().append(html1);
            focusanterior = focusactual;
            focusactual = 'boton'+idsilla;
            $('#'+focusanterior).css({
                "background" : "#8bc34a",
                "border-top-color": "rgb(139, 195, 74)",
                "border-top-style": "solid",
                "border-top-width": "5px",
                "border-right-color": "rgb(139, 195, 74)",
                "border-right-style": "solid",
                "border-right-width": "5px",
                "border-bottom-color": "rgb(139, 195, 74)",
                "border-bottom-style": "solid",
                "border-bottom-width": "5px",
                "border-left-color": "rgb(139, 195, 74)",
                "border-left-style": "solid",
                "border-left-width": "5px",
                "border-image-source": "initial",
                "border-image-slice": "initial",
                "border-image-width": "initial",
                "border-image-outset": "initial",
                "border-image-repeat": "initial"});
            $('#'+focusactual).css({
                "background" : "#8bc34a",
                "border-top-color": "rgba(244, 245, 28, 0.86)",
                "border-top-style": "solid",
                "border-top-width": "5px",
                "border-right-color": "rgba(244, 245, 28, 0.86)",
                "border-right-style": "solid",
                "border-right-width": "5px",
                "border-bottom-color": "rgba(244, 245, 28, 0.86)",
                "border-bottom-style": "solid",
                "border-bottom-width": "5px",
                "border-left-color": "rgba(244, 245, 28, 0.86)",
                "border-left-style": "solid",
                "border-left-width": "5px",
                "border-image-source": "initial",
                "border-image-slice": "initial",
                "border-image-width": "initial",
                "border-image-outset": "initial",
                "border-image-repeat": "initial"});
                }
        }
    }

        function modales(diseno){
            url = base_url+"Adminmesa/traerlugares";
            $.post(url,{}, function(data){
            	console.log(data);
                if(diseno == '2side'){
                    var maxChairs = 100;
                    var min = 2;
                }
                if(diseno == '1side'){
                    var maxChairs = 50;
                    var min = 2;
                }
                if(diseno == 'round'){
                    var maxChairs = 12;
                    var min = 6;
                }
                html='';
                html+= '<div class="modal-dialog">';
                html+= '<div class="modal-content" style="width: 400px;margin-left: 100px;padding-left: 20px;">';
                html+= '<div class="modal-header">';
                html+= '<center style="padding-bottom: 20px;"><button type="button" class="close" data-dismiss="modal">&times;</button></center>';
                html+= '<p class="modal-headerTools-title">Agregar mesa</p>';
                html+= '</div>';
                html+= '<form name="frmTableModif" id="ModifTable">';
                html+= '<div class="modal-addTable-content">';
                html+= '<input type="hidden" name="id_lugar_mesa" value="1">';
                html+= '<input type="hidden" name="TableType" value="'+diseno+'">';
                html+= '<input type="hidden" name="idMesa" value="">';
                html+= '<input type="hidden" name="posX" value="470">';
                html+= '<input type="hidden" name="posY" value="60">';
                html+= '<input type="hidden" name="minChairs" value="2">';
                html+= '<input type="hidden" name="maxChairs" value="'+maxChairs+'">';
                html+= '<center><div style="padding: 8px;" class="pure-g">';
                html+= '<div class="pure-u-1-3">';
                html+= '<i class="icon-tools icon-tools-table-'+diseno+'"></i>';
                html+= '</div></center>';
                html+= '<div class="pure-u-2-3">';
                html+= '<div class="input-group-line" stlye="padding-right: 20px;" >';
                html+= '<span class="input-group-line-label" style=" padding-right: 20px;">Nombre</span>';
                html+= '<input name="TableName" type="text" value="'+data["correlativo"]+'" readonly placeholder="Nombre de la mesa" data-msgerror="Tienes que especificar el nombre." required>';
                html+= '</div>';
                html+= '<div class="input-group-line input-group-naked">';
                html+= '<span class="input-group-line-label">Nº de sillas</span>';
                html+= '<div class="mt5">';
                html+= '<input class="spinner" name="TableSeats"  min="'+min+'" max="'+maxChairs+'" value="6">';
                html+= '</div>';
                html+= '<div class="input-group-line input-group-naked">';
                html+= '<span class="input-group-line-label">Lugar</span>';
                html+= '<div class="mt5">';
                html+= '<select id="idlugar" name="idlugar" class="form-control" required>'+data["html"]+'</select>';
                html+= '</div>';
                html+= '</div>';
                html+= '</div>';
                html+= '</div>';
                html+= '</div>';
                html+= '<center><div class="modal-addTable-footer" style="padding-bottom: 20px;padding-top:10px;">';
                html+= '<button type="button" class="btn-flat red" value="Agregar" onclick="submitCreateTable()">Guardar</button>';
                html+= '</div></center>';
                html+= '</form>';
                html+= '</div>';
                html+= '</div>';
                $("#initPlannerShow").empty().append(html);
                $("#initPlannerShow").modal({show: 'false'}); 
                var spin = $('.spinner');
                spin.val(6);
                if ($.fn.spinner) {
                    spin.spinner({
                        max:            maxChairs,
                        min:            min,
                        numberFormat: 'n'
                    });
                }
                common_form_setautofocus($("#ModifTable"));
            },'json');
        }

        function llamarfuncion(idsilla,opcion){
            $("#editarmesa").modal('hide');
            if(opcion == 1){
            setTimeout(function(){
                reload_url('Ventas/nuevaventa/'+idsilla+'/'+opcion);
            },500);
                    //window.location.href =base_url+"Ventas/nuevo?idsilla="+idsilla;

            }else{
                url = base_url+"Adminmesa/reserva";
                $.post(url,{"idsilla" : idsilla,"opcion" : opcion}, function(data){

                    generar_notificaciontoastrop('Se registro correctamente','La reserva se realizó correctamente','success'); 
                    reload_url('Adminmesa/cargar');
                    //location.reload();
                },'json');

            }
        }

        function submitCreateTable(){
            datos = {};
            datos["datos"]=$("#ModifTable").serialize();
            url = base_url+"Adminmesa/procesamientoguardar";
            $.post(url,JSON.stringify(datos), function(data){
                alertasuccess('Se creo Correctamente','Exitoso!!');
                location.reload();
            });
        }

        $(".app-table-edit mb15").on('click',function() {
            var tex = $(this).data('id');
            alert(tex);          
        });
    </script>
</body>
