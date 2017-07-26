<?php
try {
    	require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
	include_file('core', 'authentification', 'php');
	include_file('core', 'Plex', 'php', 'plex');
	if (!isConnect('admin')) {
		throw new Exception(__('401 - Accès non autorisé', __FILE__));
	}
	if (init('action') == 'getLibrary') {
		$equipement=eqLogic::byId(init('Id'));
		if(is_object($equipement))
			ajax::success($equipement->getLibrary());
		else
			ajax::success(false);
   	}
	if (init('action') == 'SearchMedia') {	
		$equipement=eqLogic::byId(init('Id'));
		if(is_object($equipement))
			ajax::success($equipement->getMedia(init('Filtre'),init('param')));
		else
			ajax::success(false);
	}
	if (init('action') == 'UpdateCommande') {
		$eqLogic=eqLogic::byId(init('EqId'));
		if(is_object($eqLogic)){
			$eqLogic->checkAndUpdateCmd(init('logicalId'),init('Name'));			
			cache::set('plex::MediaKey::'.$eqLogic->getId(), init('Key'), 0);
			ajax::success(true);
		}
		ajax::success(false);
	}
    	throw new Exception(__('Aucune methode correspondante à : ', __FILE__) . init('action'));
    	/*     * *********Catch exeption*************** */
} catch (Exception $e) {
    	ajax::error(displayExeption($e), $e->getCode());
}
?>
