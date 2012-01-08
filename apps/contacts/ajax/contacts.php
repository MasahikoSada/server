<?php
/**
 * Copyright (c) 2011 Thomas Tanghus <thomas@tanghus.net>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

require_once('../../../lib/base.php');
OC_JSON::checkLoggedIn();
OC_JSON::checkAppEnabled('contacts');

$ids = OC_Contacts_Addressbook::activeIds(OC_User::getUser());
$contacts = OC_Contacts_VCard::all($ids);
//OC_Log::write('contacts','contacts.php: '.count($contacts).' contacts.',OC_Log::DEBUG);
/*
$addressbooks = OC_Contacts_Addressbook::active(OC_User::getUser());
$contacts = array();
foreach( $addressbooks as $addressbook ){
	$addressbookcontacts = OC_Contacts_VCard::all($addressbook['id']);
	foreach( $addressbookcontacts as $contact ){
		if(is_null($contact['fullname'])){
			continue;
		}
		$contacts[] = $contact;
	}
}
usort($contacts,'contacts_namesort');
*/
$tmpl = new OC_TEMPLATE("contacts", "part.contacts");
$tmpl->assign('contacts', $contacts);
$page = $tmpl->fetchPage();

OC_JSON::success(array('data' => array( 'page' => $page )));
?>
