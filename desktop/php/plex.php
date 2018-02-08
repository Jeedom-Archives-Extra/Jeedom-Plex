<?php
if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}
sendVarToJS('eqType', 'plex');
$eqLogics = eqLogic::byType('plex');
?>
<div class="row row-overflow">
    <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
				<a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add">
					<i class="fa fa-plus-circle"></i> {{Ajouter un équipement}}
				</a>
                <li class="filter" style="margin-bottom: 5px;">
					<input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/>
				</li>
                <?php
                foreach (eqLogic::byType('plex') as $eqLogic) {
					echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
	<div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
		<legend>{{Gestion}}</legend>
		<div class="eqLogicThumbnailContainer">
			<div class="cursor eqLogicAction" data-action="add" style="background-color : #ffffff; height : 140px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
				<center>
					<i class="fa fa-plus-circle" style="font-size : 5em;color:#406E88;"></i>
				</center>
				<span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#406E88"><center>{{Ajouter}}</center></span>
			</div>
			<div class="cursor eqLogicAction" data-action="gotoPluginConf" style="height: 120px; margin-bottom: 10px; padding: 5px; border-radius: 2px; width: 160px; margin-left: 10px; position: absolute; left: 170px; top: 0px; background-color: rgb(255, 255, 255);">
				<center>
			      		<i class="fa fa-wrench" style="font-size : 5em;color:#767676;"></i>
			    	</center>
			    	<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676"><center>Configuration</center></span>
			</div>
		</div>
        <legend>{{Mes clients}}</legend>
		<div class="eqLogicThumbnailContainer">
			<?php
			if (count($eqLogics) == 0) {
				echo "<br/><br/><br/><center><span style='color:#767676;font-size:1.2em;font-weight: bold;'>{{Vous n'avez pas encore de clients, cliquez sur Ajouter pour commencer}}</span></center>";
			} else {
				foreach ($eqLogics as $eqLogic) {
					echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >';
					echo '<center><img src="plugins/plex/plugin_info/plex_icon.png" height="105" width="95" /></center>';
					echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;"><center>' . $eqLogic->getHumanName(true, true) . '</center></span>';
					echo '</div>';
				}
			} 
			?>
		</div>
    </div>
	<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
		<a class="btn btn-success eqLogicAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> Sauvegarder</a>
		<a class="btn btn-danger eqLogicAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> Supprimer</a>
		<a class="btn btn-default eqLogicAction pull-right" data-action="configure"><i class="fa fa-cogs"></i> Configuration avancée</a>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation">
				<a href="#" class="eqLogicAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay">
					<i class="fa fa-arrow-circle-left"></i>
				</a>
			</li>
			<li role="presentation" class="active">
				<a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
					<i class="fa fa-tachometer"></i> Equipement</a>
			</li>
			<li role="presentation" class="">
				<a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
					<i class="fa fa-list-alt"></i> Commandes</a>
			</li>
		</ul>
		<div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
			<div role="tabpanel" class="tab-pane active" id="eqlogictab">
				<div class="col-sm-6">
					<form class="form-horizontal">
						<legend>Général</legend>
						<fieldset>			
							<div class="form-group">
								<label class="col-md-4 control-label">
									{{Nom de l'équipement}}
									<sup>
										<i class="fa fa-question-circle tooltips" title="Indiquez le nom de votre équipement" style="font-size : 1em;color:grey;"></i>
									</sup>
								</label>
								<div class="col-md-8">
									<input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
									<input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement KNX}}"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">
									{{Objet parent}}
									<sup>
										<i class="fa fa-question-circle tooltips" title="Indiquez l'objet dans lequel le widget de cette equipement apparaiterai sur le dashboard" style="font-size : 1em;color:grey;"></i>
									</sup>
								</label>
								<div class="col-md-8">
									<select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
										<?php
										foreach (object::all() as $object) {
											echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">
									{{Catégorie}}
									<sup>
										<i class="fa fa-question-circle tooltips" title="Choisissez une catégorie
									Cette information n'est pas obigatoire mais peut etre utile pour filtrer les widget" style="font-size : 1em;color:grey;"></i>
									</sup>
								</label>
								<div class="col-md-8">
									<?php
									foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
										echo '<label class="checkbox-inline">';
										echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
										echo '</label>';
									}
									?>

								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">
									{{Etat du widget}}
									<sup>
										<i class="fa fa-question-circle tooltips" title="Choisissez les options de visibilité et d'activation
									Si l'equipement n'est pas activé il ne sera pas utilisable dans jeedom, mais visible sur le dashboard
									Si l'equipement n'est pas visible il ne sera caché sur le dashbord, mais utilisable dans jeedom" style="font-size : 1em;color:grey;"></i>
									</sup>
								</label>
								<div class="col-md-8">
									<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
									<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
								</div>
							</div>
						</fieldset> 
					</form>
				</div>
				<div class="col-sm-6">
					<form class="form-horizontal">
						<legend>Paramètre du clients</legend>
						<fieldset>
							<div class="form-group">
								<label class="col-md-4 control-label">
									{{Heartbeat}}
									<sup>
										<i class="fa fa-question-circle tooltips" style="font-size : 1em;color:grey;" title="Permet de vérifier toutes les minutes si le plex est toujours actif. Si il n'est plus actif, cela le mettra comme arrêté dans Jeedom. Utile pour les plexs qui sont sur des machines qui s'éteignent sans forcément arrêter plex"></i>
									</sup>
									<input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="heartbeat" checked/>
								</label>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">
									{{Choisir le client}}
									<sup>
										<i class="fa fa-question-circle tooltips" style="font-size : 1em;color:grey;" title="Permet de choisir un client reconnue par le systeme. Attention les clients doivent etres actif pour etre reconnue"></i>
									</sup>
								</label>
								<div class="col-md-8">
									<input type="hidden" class="eqLogicAttr form-control" data-l1key="logicalId"/>
									<?php	
										if(count($eqLogics)>0){
											foreach($eqLogics[0]->getClients() as $Client){
												if ($Client->getName()!='')
													echo '<a class="btn btn-default bt_PlexClient">'.$Client->getName().'</a>';
											}
										}
									?>
								</div>
							</div>
							<div class="form-group expertModeVisible">								
								<label class="col-md-4 control-label">{{Modifier son address}}</label>
								<div class="col-md-8">
									<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="HostUpdate" placeholder="{{Modifier son address}}"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">{{Volume +/-}}</label>
								<div class="col-md-8">
									<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="volume_inc" placeholder="{{Volume incrément}}"/>
								</div>
							</div>						
						</fieldset> 
					</form>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="commandtab">
				<br>
				<!--a class="btn btn-success btn-sm cmdAction pull-right" data-action="add"><i class="fa fa-plus-circle"></i> Ajouter une commande</a-->
				<table id="table_cmd" class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Type</th>
							<th>Options</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php 
include_file('desktop', 'plex', 'js', 'plex');
include_file('core', 'plugin.template', 'js'); 
?>
