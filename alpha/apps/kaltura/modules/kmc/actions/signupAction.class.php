<?php
/**
 * @package    Core
 * @subpackage KMC
 */
class signupAction extends kalturaAction
{
	public function execute ( ) 
	{
		$this->redirect("http://corp.kaltura.com/about/signup");
		sfView::SUCCESS;
	}
}
