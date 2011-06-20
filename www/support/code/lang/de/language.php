<?php
/*******************************************************************************
**	file: language.php
********************************************************************************
**	author:	Sergio Arias
**	date:	12/12/2003
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/02/12 04:35:04 $ by $Author: lmpmbernardo $
++	Tranlated to german Version by Martin Lentzsch   mailto:martin@lentzsch.net
*******************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////
/** [Common] ********************************************************/
$lang['submit']="Senden";
$lang['add']="Hinzuf&uuml;gen";
$lang['update']="Aktualisieren";
$lang['cancel']="Abbruch";
$lang['delete']="L&ouml;schen";
$lang['edit']="Bearbeiten";
$lang['modify']="&Auml;ndern";
$lang['refresh']="Aktualisieren";
$lang['reset']="Reset";
$lang['id'] = "ID";


$lang['rank']="Rang";
$lang['there_are']="Es existieren";
$lang['sort_by']="Sortieren nach";
$lang['previous']="Vorheriges";
$lang['next']="Weiter";
$lang['detail']="Detail";

$lang['success']="Erfolg";
$lang['all']="Alle";
$lang['from']="Von";
$lang['to']="An";

$lang['more']="Mehr";
$lang['less']="Weniger";

$lang['more_detail']="Mehr Detail";
$lang['less_detail']="Weniger Detail";

$lang['unknown']="unbekannt";


//////////////////////////////////////////////////////////////////////
/** [Login] *********************************************************/
$lang['login']="Login";
$lang['user_name']="Benutzerame";
$lang['password']="Passwort";
$lang['lang']="Sprache";
$lang['login_to']="Login auf";

$lang['err_login_failed']="Login fehlgeschlagen";
$lang['err_username_incorrect']="Der Bneutzername oder das Passwort stimmen nicht.";



///////////////////////////////////////////////////////////////////////////////////////
/** [Index] *********************************************************/
/** [Left Menu] *****************************************************/
$lang['administration']="Administration";
$lang['support']="Support";
$lang['text_who_online']="Wer ist angemeldet";
$lang['home']="Home";
$lang['logout']="Logout";
$lang['settings']="Einstellungen";

// Ticket Options
$lang['ticket_options']="Ticket Optionen";
$lang['ticket_categories']="Ticket Kategorien";
$lang['ticket_priorities']="Ticket Priorit&auml;ten";
$lang['ticket_status']="Ticket Status";
$lang['ticket_platforms']="Ticket Platformen";
//-- Supporter -----------------------------------------------------
$lang['ticket_management']="Ticket Management";
$lang['create_ticket']="Ticket erzeugen";
$lang['my_tickets']="Meine Tickets";
$lang['my_groups_tickets']="Tickets meiner Gruppe";
$lang['all_tickets']="Alle Tickets";
$lang['ticket_search']="Ticket Suche";


// Product Options
$lang['product_options']="Produkt Optionen";
$lang['product_modules']="Produkt Module";
$lang['product_versions']="Produkt Versionen";

// Supporter Management
$lang['supporter_management']="Bearbeiter Management";
$lang['view_supporters']="Bearbeiter ansehen";
$lang['view_groups']="Gruppen ansehen";
$lang['add_supporter']="Bearbeiter hinzuf&uuml;gen";
$lang['add_group']="Gruppe hinzuf&uuml;gen";

// FAQs Management
$lang['faqs_management']="FAQ Management";
$lang['view_faqs']="FAQs ansehen";
$lang['add_faq']="FAQ hinzuf&uuml;gen";
$lang['faq_categories']="FAQ Kategorien";

// Ticket Reporting
$lang['ticket_reporting']="Ticket Reporting";
$lang['cumulative_statistics']="Kumulative Statistik";
// not sure about this translation
$lang['pipeline_statistics']="Pipeline Statistik";
$lang['time_sheets']="Zeiterfassung";

/** [Clients] *******************************************************/
$lang['client_management']="Kunden Management";
$lang['view_contacts']="Kontakte ansehen";
$lang['view_companies']="Firmen ansehen";
$lang['contact_search']="Kontakt suchen";
$lang['add_contact']="Kontakt hinzuf&uuml;gen";
$lang['add_company']="Firma hinzuf&uuml;gen";

$lang['my_records']="Meine Notizen";
$lang['edit_my_profile']="Mein Profil bearbeiten";
$lang['my_time_sheet']="Meine ZZeiterfassung";
$lang['my_ticket_statistics']="Meine Ticket Statistik";

$lang['knowledge_base']="Knowledge Base";
$lang['search_faqs']="FAQs suchen";


///////////////////////////////////////////////////////////////////////////////////////
/** [Announcements] *************************************************/
$lang['announcements']="Ank&uuml;ndigungen";


///////////////////////////////////////////////////////////////////////////////////////
/** [Tickets] *******************************************************/
$lang['text_ticket_categories']="Ticket Kategorien Rangfolgen werden f&uuml; Sortierzwecke verwendet.";
$lang['new_category']="Neue Kategorie";

$lang['text_ticket_priorities']="Ticket Priorit&auml;ten Rangfolgen werden f&uuml;r Sortierzwecke verwendet. Je niedriger der Rang, desto h&ouml;her die Priorit&auml;t.";
$lang['new_priority']="Neue Priorit&auml;t";

$lang['text_ticket_status']="Ticket Status Rangfolgen werden f&uuml;r Sortierzwecke verwendet. Stellen Sie sicher, <strong>dass geschlossene Tickets den h&ouml;chsten Rang haben.</strong>.";
$lang['new_status']="Neuer Status";

$lang['text_ticket_platform']="Ticket Platform Rangfolgen werden f&uuml;r Sortierzwecke verwendet.";
$lang['new_platform']="Neue Platform";

//-- [Supporter] -----------------------------------------------------
$lang['ticket_created']="Ticket erzeugt";
$lang['assigned_to']="Zugeordnet zu";
$lang['text_take_a_look']="Bitte beachten Sie";
$lang['ticket']="Ticket";
$lang['text_created_assigned']="erzeugt und Ihnen zugeordnet";
$lang['update_ticket']="Ticket aktualisieren";
$lang['ticket_information']="Ticket Information";
$lang['ticket_id']="Ticket ID";
$lang['company']="Firma";
$lang['companies']="Firmen";
$lang['date_created']="Datum erzeugt";
$lang['track_time']="Zeit verfolgen";
$lang['files']="Dateien";
$lang['history']="Verlauf";
$lang['transferred_to_'] = "&Uuml;bertragen an ";
$lang['please_take_over'] = "Bitte das Ticket &uuml;bernehmen.";
$lang['ticket_reassigned'] = "Ticket XXX zur&uuml;ck."; // DO NOT TRANSLATE XXX
$lang['_contact_changed_to'] = " Kontakt ge&auml;ndert auf XXX."; // DO NOT TRANSLATE XXX
$lang['_priority_changed_to'] = " Priorit&auml;t ge&auml;ndert auf XXX."; // DO NOT TRANSLATE XXX
$lang['_status_changed_to'] = " Status ge&auml;ndert auf XXX."; // DO NOT TRANSLATE XXX
$lang['email_sent'] = "E-Mail gesendet";
$lang['ticket_history_log'] = "Ticket Verlaufs Protokoll - Ticket ID: ";
$lang['reverse'] = "Umgekehrt";

$lang['my_tickets']="Meine Tickets";
$lang['contact_tickets']="Kontakt Tickets";
$lang['company_tickets']="Firma Tickets";
$lang['all_tickets']="Alle Tickets";
$lang['updated']="letzte Aktualisierung";
$lang['text_ticket_search']="Bitte geben Sie s&auml;mtliche Informationen zu dem gesuchten Ticket ein.";
$lang['keyword']="Keyword";
$lang['number']="Nummer";
$lang['search']="Suche";
$lang['created']="Erzeugt";

$lang['records_found']="Records found: ";

$lang['text_num_mins_worked']="Bitte geben Sie die Zeit in Minuten ein, die Sie für die Tickets benötigt haben.";


///////////////////////////////////////////////////////////////////////////////////////
/** [Modules] *******************************************************/
$lang['new_module']="Neues Mudul";
$lang['module']="Modul";
$lang['modules']="Module";

$lang['new_version']="Neue Version";
$lang['version']="Version";
$lang['versions']="Versionen";


///////////////////////////////////////////////////////////////////////////////////////
/** [Supporters] ****************************************************/
$lang['confirmation']="Best&auml;tigung";
$lang['q_are_you_sure']="Sind Sie sicher?";
$lang['text_warning_del_supporter']="Warnung: Einen Bearbeiter zu l&ouml;schen ist nicht empfehlenswert.<br/>Sollten ihm Tickets zugeordnet sein, wird ihr Status inkonsistent.";

$lang['last_name']="Nachname";
$lang['ticket_statistics']="Ticket Statistik";
$lang['supporter_id']="Bearbeiter ID";
$lang['name']="Name";
$lang['phone']="Telefon";
$lang['email']="E-mail";
$lang['groups']="Gruppe";

$lang['supporters']="Bearbeiter";

$lang['enter_supporter_info']="Bearbeiter Informationen eingeben";
$lang['administrator']="Administrator";
$lang['supporter']="Bearbeiter";
$lang['add_supporter']="Bearbeiter hinzuf&uuml;gen";
$lang['add_to_groups']="Zu Gruppen hinzuf&uuml;gen";


// [In common.php]
$lang['supporter_info']="Bearbeiter Information";
$lang['fax']="Fax";
$lang['type']="Typ";
$lang['comments']="Bemerkungen";
$lang['modified_by']="Ge&auml;ndert von";
$lang['last_modified']="Letzte &Auml;nderung";

//-----------------
$lang['edit_supporter_info']="Bearbeiter Information bearbeiten";
$lang['first_name']="Vorname";
$lang['password_again']="Passwort wiederholen";
$lang['email_address']="E-mail Adresse";
$lang['text_leave_blank']="frei lassen, um Passwort nicht zu &auml;ndern";


///////////////////////////////////////////////////////////////////////////////////////
/** [Error and Success Messages] ************************************/
$lang['err_missing_info']="Es fehlern einige Informationen... Bitte im Browser auf zur&uuml;ck klicken und &uuml;berpr&uuml;fen.";
$lang['err_user_exists']="Eine Person mit diesem Namen existiert bereits!";
$lang['err_password_mismatch']="Die Passw&ouml;rter stimmen nicht &uuml;berein.";
$lang['err_group_exists']="Eine Gruppe mit diesem Namen existiert bereits!";
$lang['err_company_exists']="Eine Firma mit diesem Namen existiert bereits!";
$lang['err_email_exists']="Einen Person mit dieser E-Mail Adresse existiert bereits!";

$lang['msg_supporter_updated']="Bearbeiter Informationen erfolgreich ge&auml;ndert.";
$lang['msg_added_successfully']="erfolgreich hinzugef&uuml;gt";
$lang['msg_updated_successfully']="erfolgreich ge&auml;ndert";
$lang['msg_created_successfully']="erfolgreich erzeugt";
$lang['msg_deleted_successfully']="erfolgreich gel&ouml;scht";
$lang['msg_profile_updated']="Ihr Profil wurde erfolgreich ge&auml;ndert.";


///////////////////////////////////////////////////////////////////////////////////////
/** [Statistics] ****************************************************/
$lang['ticket_time_sheets']="Ticket Zeiterfassung";
$lang['time_sheet_for']="Zeiterfassung f&uuml;r";
$lang['my_time_sheet']="Meine Zeiterfassung";

$lang['ticket_id']="Ticket ID";
$lang['title']="Titel";
$lang['status']="Status";
$lang['hours_worked']="Arbeitsstunden";
$lang['minutes_worked']="Minuten besch&auml;ftigt";

$lang['ticket_statistics']="Ticket Statistik";
$lang['ticket_statistics_for']="Ticket Statistik f&uuml;r ";
$lang['case']="Fall";
$lang['open']="offen";
$lang['closed']="geschlossen";
$lang['total']="Total";
$lang['priorities']="Eigenschaften";
$lang['categories']="Kategorien";
$lang['last_updated']="Letzte &Auml;nderung";

$lang['opened_during']="ge&ouml;ffnet w&auml;hrend";
$lang['closed_during']="geschlossen w&auml;rend";
$lang['ticket_pipeline']="Ticket Pipeline";
$lang['avg_ticket_lifetime_weeks']="Durchschnittliche Lebenszeit der Tickest pro Woche";
$lang['less_1']="Weniger als eins";
$lang['1_2']="ein bis zwei";
$lang['2_3']="zwei bis drei";
$lang['3_4']="drei bis vier";
$lang['more_4']="mehr als vier";

////////////////////////////////////////////////////////////////////////////////
/** [Time Sheets] ****************************************************/
$lang['track_time_ticket_id'] = "Track Time - Ticket ID: ";

////////////////////////////////////////////////////////////////////////////////
/** [Files] ****************************************************/
$lang['files_ticket_id'] = "Dateien - Ticket ID: ";
$lang['add_file'] = "Datei zuf&uuml;gen";
$lang['ticket_detail'] = "Ticket Detail";
$lang['file'] = "Datei";
$lang['upload'] = "Upload";
$lang['no_files'] = "Es sind keine Dateien an diesem Ticket angehangen.";
$lang['posted_by'] = "Am XXX von YYY gesendet."; // DO NOT TRANSLATE XXX AND YYY


///////////////////////////////////////////////////////////////////////////////////////
/** [Groups] ********************************************************/
$lang['group_id']="Gruppe ID";
$lang['text_warning_del_group']="Warnung: Durch das l&ouml;schen der Gruppe werden die Bearbeiter der Gruppe nicht gel&ouml;scht.<br/>Es w&auml;re nicht empfehlenswert da die Bearbeiter dieser Gruppe noch zugeordnete Tickets haben k&ouml;nnten.";

$lang['group_name']="Gruppenname";
$lang['edit_group_info']="Gruppen Information bearbeiten";
$lang['choose_supporters']="Bearbeiter ausw&auml;hlen";

$lang['enter_group_info']="Gruppen Information eingeben";

// [In common.php]
$lang['group_info']="Gruppen Information";


///////////////////////////////////////////////////////////////////////////////////////
/** [FAQs] **********************************************************/
$lang['faqs']="FAQs";
$lang['question']="Fragen";
$lang['category']="Kategorie";
$lang['new_category']="Neue Kategorie";
$lang['compose_faq']="FAQ erstellen";
$lang['answer']="Antwort";
$lang['add_faq']="FAQ hinzuf&uuml;gen";
$lang['faq_detail']="FAQ Detail";
$lang['faq_id']="FAQ ID";
$lang['edit_faq']="FAQ bearbeiten";
$lang['faq_search']="FAQ Suche";
$lang['text_enter_keyword']="Keyword eingeben";


///////////////////////////////////////////////////////////////////////////////////////
/** [Control] *******************************************************/
$lang['control_panel']="Control Panel";
$lang['setting']="Setting";
$lang['value']="Wert";
$lang['helpdesk_name']="Helpdesk Name";
$lang['administrator_email']="Administrator E-mail";
$lang['helpdesk_on-off']="Helpdesk On/Off";
$lang['reason_helpdesk_off']="Bitte eine Begr&uuml;ndung eintragen, wenn der Helpdesk offline ist";
$lang['num_supporters_per_page']="Anzahl angezeigter Bearbeiter/Kontakte pro Seite";
$lang['num_groups_per_page']="Anzahl angezeigter Gruppen/Firmen pro Seite";
$lang['num_tickets_per_page']="Anzahl angezeigter Tickets pro Seite";
$lang['num_announcements_to_list']="Anzahl angezeigter Ank&uuml;ndigungen pro Seite";
$lang['time_tracking_status']="Zeit&uuml;bersicht Status";
$lang['products_options_status']="Produkt Optionen Status";
$lang['smtp_status']="SMTP Status";
$lang['who_online_status']="Wer ist angemeldet Status";
$lang['system_statistics']="System Statistik";
$lang['submit_changes']="&Auml;nderungen senden";
$lang['automatic_mail_notification']="Automatische Bearbeiter E-Mail Benachrichtung Status";


///////////////////////////////////////////////////////////////////////////////////////
/** [Contact] *******************************************************/
$lang['contact_id']="Kontakt ID";
$lang['group']="Gruppe";
$lang['client']="Kunde";
$lang['contact']="Kontakt";
$lang['priority']="Priorit&auml;t";
$lang['platform']="Plattform";
$lang['description']="Beschreibung";
$lang['version']="Version";
$lang['product_id']="Produkt ID";
$lang['ticket_modules']="Module";
$lang['email_contact']="E-Mail Kontakt";
$lang['time_spent']="Zeit verbracht";
$lang['text_minutes_spent']="Minuten an diesem Ticket gearbeitet seit letztem Update";
//-- [Supporter] -----------------------------------------------------
$lang['contact_info']="Kontakt Information";
$lang['view_tickets']="Tickets ansehen";
$lang['edit_contact_info']="Kontakt Information bearbeiten";
$lang['msg_warning_del_contact']="Warnung: Es ist nicht empfehlenswert einen Kontakt zu l&ouml;schen.<br/>Dem Kontakt zugeordnete Tickets bekommen einen inkosistenten Status.";
$lang['contact_search']="Kontakt Suche";
$lang['text_contact_search']="Bitte geben Sie s&auml;mtliche Informationen zu dem gesuchten Kontakt ein.";
$lang['enter_contact_info']="Kontakt Information eingeben";


///////////////////////////////////////////////////////////////////////////////////////
/** [Company] *******************************************************/
$lang['enter_company_info']="Firmen Informationen eingeben";
$lang['company_name']="Firmenname";
$lang['address']="Adresse";
$lang['add_company']="Firma hinzuf&uuml;gen";
$lang['company_id']="Firma ID";
$lang['main_contact']="Haupkontakt";
$lang['company_info']="Firmen Information";
$lang['contacts']="Kontakte";
$lang['edit_company_info']="Firmen Information bearbeiten";
$lang['text_warning_del_company']="Warnung: Kontakte die zu einer Firma geh&ouml;ren werden nicht gel&ouml;scht, sondern zu inaktiven Kontakten verschoben.<br/>L&ouml;schen von Firmen ist nicht empfehlenswert.<br/>Der Firma zugeordnete Tickets bekommen einen inkosistenten Status.";

////////////////////////////////////////////////////////////////////////////////
/** [Address Book] *******************************************************/
$lang['address_book'] = "Address Book";
$lang['last_first_name'] = "Last, First Name";

////////////////////////////////////////////////////////////////////////////////
/** [Company Statistics] *******************************************************/
$lang[company_statistics] = "Company Statistics";
$lang[tickets] = "Tickets";
$lang[first_ticket] = "First Ticket";
$lang[last_ticket] = "Last Ticket";

////////////////////////////////////////////////////////////////////////////////
/** [Installation] *******************************************************/
$lang['installation'] = "Installation";
$lang['step_one'] = "Erster Schritt: Tabellen erzeugen";
$lang['step_one_text'] = "Das System ist jetzt bereit um die Installation der Helpdesk Software zu beginnen.<br>Klicken Sie <b>Weiter</b> um die Tabellen der Datenbank zu erzeugen.";
$lang['step_two'] = "Zweiter Schritt: Administrator Konto einrichten";
$lang['company_comments'] = "Firma Bemerkungen";
$lang['required_field'] = "Erforderliche Felder";
$lang['press_back_button'] = "Bitte klicken Sie auf den Zur&uuml;ck Button des Browsers um das Problem zu beheben.";
$lang['step_three'] = "Dritter Schritt: Abschluss";
$lang['step_three_text'] = "Die Helpdesk Software wurde installiert und das Administrator Konto wurde erzeugt.<br>Sie sollten jetzt auf LOGIN klicken une ein Ticket Schema erzeugen."; // DO NOT TRANSLATE LOGIN
$lang['install_error'] = "Die XXX Information ist nicht vorhanden oder fehlerhaft."; // DO NOT TRANSLATE XXX

//insert some data into the platforms table.
$lang['generic'] = "Allgemein";
$lang['pc'] = "PC";
$lang['macintosh'] = "Macintosh";

//insert some data into the categories table.
$lang['big_problem'] = "Gro&szlig;es Problem";
$lang['small_problem'] = "Kleines Problem";
$lang['other_problem'] = "Anderes Problem";

//insert some data into the priorities table.
$lang['critical'] = "Kritisch";
$lang['high'] = "Hoch";
$lang['medium'] = "Mittel";
$lang['low'] = "Niedrig";

//insert some data into the status table.
$lang['open'] = "Offen";
$lang['in_progress'] = "In Bearbeitung";
$lang['waiting_for_response'] = "Warten auf R&uuml;ckmeldung";
$lang['closed'] = "Geschlossen";

//insert default contact for inactive contacts company
$lang['defaultcontact'] = "Dieser Kontakt kann nicht bearbeitet werden!";
//insert inactive contacts company
$lang['inactivecontacts'] = "Diese Firma kann nicht bearbeitet werden!";
$lang['inactivecontactsaddress'] = "Diese virtuelle Firma dient als Pool f&uuml;r nicht zugeordnete Kontakte.";
//insert welcome message in the announcements table
$lang['welcome'] = "Willkommen! Vielen Dank f&uuml;r die Installation von MyHelpdesk! Besuchen Sie <a href=http://www.sourceforge.net/projects/myhelpdesk/>MyHelpdesk</a> bei SourceForge wenn Sie Fragen haben.";

?>