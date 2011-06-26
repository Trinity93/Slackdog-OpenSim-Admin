<?php
/*******************************************************************************
**	file: language.php
********************************************************************************
**	author:	Rémi Porcedda
**	date:	12/12/2003
********************************************************************************
** $Revision: 1.3 $ on $Date: 2004/02/12 04:35:05 $ by $Author: lmpmbernardo $
*******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/** [Common] ********************************************************/
$lang['submit']="Valider";
$lang['add']="Ajouter";
$lang['update']="Mise à jour ";
$lang['cancel']="Annuler";
$lang['delete']="Supprimer";
$lang['edit']="Editer";
$lang['modify']="Modifier";
$lang['refresh']="Actualiser";
$lang['reset']="Réinitialiser";
$lang['id'] = "N°";

$lang['rank']="Niveau";
$lang['there_are']="Il y a";
$lang['sort_by']="Trier par";
$lang['previous']="Pécédent";
$lang['next']="Suivant";
$lang['detail']="Détail";

$lang['success']="Réussi";
$lang['all']="Tous";
$lang['from']="De";
$lang['to']="A";

$lang['more_detail']="Plus de détails";
$lang['less_detail']="Moins de détails";

$lang['unknown']="inconnu";


//////////////////////////////////////////////////////////////////////
/** [Login] *********************************************************/
$lang['login']="Connexion";
$lang['user_name']="Identifiant ";
$lang['password']="Mot de passe ";
$lang['lang']="Langue";
$lang['login_to']="Se connecter à";

$lang['err_login_failed']="Connexion refusée";
$lang['err_username_incorrect']="Votre identifiant et/ou votre mot de passe sont incorrects.";



///////////////////////////////////////////////////////////////////////////////////////
/** [Index] *********************************************************/
/** [Left Menu] *****************************************************/
$lang['administration']="Administration";
$lang['support']="Support";
$lang['text_who_online']="Membres connectés";
$lang['home']="Accueil";
$lang['logout']="Déconnexion";
$lang['settings']="Préférences";

// Ticket Options
$lang['ticket_options']="Paramétrage des Tickets";
$lang['ticket_categories']="Tickets : Catégories";
$lang['ticket_priorities']="Tickets : Priorités";
$lang['ticket_status']="Tickets : Statuts";
$lang['ticket_platforms']="Tickets : Plateformes";
//-- Supporter -----------------------------------------------------
$lang['ticket_management']="Gestion des Tickets";
$lang['create_ticket']="Créer un Ticket";
$lang['my_tickets']="Mes Tickets";
$lang['my_groups_tickets']="Mes Groupes de Tickets";
$lang['all_tickets']="Tout les Tickets";
$lang['ticket_search']="Recherche de Tickets";


// Product Options
$lang['product_options']="Paramétrage des Produits";
$lang['product_modules']="Produits : Modules";
$lang['product_versions']="Produits : Versions";

// Supporter Management
$lang['supporter_management']="Gestion des Membres";
$lang['view_supporters']="Consulter les Membres";
$lang['view_groups']="Consulter les Groupes";
$lang['add_supporter']="Ajouter un Membre";
$lang['add_group']="Ajouter un Groupe";

// FAQs Management
$lang['faqs_management']="Gestion des FAQ";
$lang['view_faqs']="Consulter les FAQ";
$lang['add_faq']="Ajouter une Question";
$lang['faq_categories']="FAQ : Catégories";

// Ticket Reporting
$lang['ticket_reporting']="Statistiques sur les Tickets";
$lang['cumulative_statistics']="Statistiques globales";
// not sure about this translation
$lang['pipeline_statistics']="Tableau de bord";
$lang['time_sheets']="Suivi des tâches";

/** [Clients] *******************************************************/
$lang['client_management']="Gestion des Contacts";
$lang['view_contacts']="Consulter les Contacts";
$lang['view_companies']="Consulter les Sociétés";
$lang['contact_search']="Rechercher un Contact";
$lang['add_contact']="Ajouter un Contact";
$lang['add_company']="Ajouter une Société";

$lang['my_records']="Mes Enregistrements";
$lang['edit_my_profile']="Modifier mon Profil";
$lang['my_time_sheet']="Mes Tâches";
$lang['my_ticket_statistics']="Mes statistiques";

$lang['knowledge_base']="Base de connaissance";
$lang['search_faqs']="Rechercher dans les FAQ";


///////////////////////////////////////////////////////////////////////////////////////
/** [Announcements] *************************************************/
$lang['announcements']="Messages";


///////////////////////////////////////////////////////////////////////////////////////
/** [Tickets] *******************************************************/
$lang['text_ticket_categories']="Les niveaux des Catégories des Tickets sont utilisés afin de permettre des tris.";
$lang['new_category']="Nouvelle Catégorie";

$lang['text_ticket_priorities']="Les niveaux de Priorité des Tickets sont utilisés afin de permettre des tris. Plus le niveau est petit, plus la priorité est élevée.";
$lang['new_priority']="Nouvelle Priorité";

$lang['text_ticket_status']="Les niveaux des Statuts des Tickets sont utilisés afin de permettre des tris. Assurez vous que <strong>les tickets traités ont le niveau le plus élevé</strong>.";
$lang['new_status']="Nouveau Statut";

$lang['text_ticket_platform']="Les niveaux des Plateformes des Tickets sont utilisés afin de permettre des tris.";
$lang['new_platform']="Nouvelle Plateforme";
//-- [Supporter] -----------------------------------------------------
$lang['ticket_created']="Ticket créé";
$lang['assigned_to']="Attribué à";
$lang['text_take_a_look']="Veuillez prêter attention à celà";
$lang['ticket']="Ticket";
$lang['text_created_assigned']="créé et vous est attribué";
$lang['update_ticket']="Mettre à jour le Ticket";
$lang['ticket_information']="Information sur le Ticket";
$lang['ticket_id']="N° de Ticket";
$lang['company']="Société";
$lang['companies']="Sociétés";
$lang['date_created']="Date de création";
$lang['track_time']="Temps passé";
$lang['files']="Fichiers";
$lang['history']="Historique";
$lang['transferred_to_'] = "Transféré à ";
$lang['please_take_over'] = "Veuillez prendre en charge ce ticket.";
$lang['ticket_reassigned'] = "Le Ticket XXX vous est réattribué."; // DO NOT TRANSLATE XXX
$lang['_contact_changed_to'] = " Le Contact est devenu XXX."; // DO NOT TRANSLATE XXX
$lang['_priority_changed_to'] = " La Priorité est devenue XXX."; // DO NOT TRANSLATE XXX
$lang['_status_changed_to'] = " Le Statut est devenu XXX."; // DO NOT TRANSLATE XXX
$lang['email_sent'] = "Courriel envoyé";
$lang['ticket_history_log'] = "Historique des Tickets - N° de Ticket : ";
$lang['reverse'] = "Tri inverse";

$lang['my_tickets']="Mes Tickets";
$lang['contact_tickets']="Tickets par Contacts";
$lang['company_tickets']="Tickets par Sociétés";
$lang['all_tickets']="Tous les Tickets";
$lang['updated']="Mis à jour";
$lang['text_ticket_search']="Saisissez une information quelconque recherchée dans un des tickets.";
$lang['keyword']="Mots clés";
$lang['number']="Numéro";
$lang['search']="Recherche";
$lang['created']="Créé le";

$lang['records_found']="Records found: ";

$lang['text_num_mins_worked']="Saisissez le temps passé en minutes pour chaque ticket que vous voulez mettre à jour.";


///////////////////////////////////////////////////////////////////////////////////////
/** [Modules] *******************************************************/
$lang['new_module']="Nouveau Module";
$lang['module']="module";
$lang['modules']="modules";

$lang['new_version']="Nouvelle Version";
$lang['version']="version";
$lang['versions']="versions";


///////////////////////////////////////////////////////////////////////////////////////
/** [Supporters] ****************************************************/
$lang['confirmation']="Confirmation";
$lang['q_are_you_sure']="Etes-vous sure ?";
$lang['text_warning_del_supporter']="Attention : La suppression d'un membre n'est pas conseillée.<br/>S'il existe des Tickets affectés à ce membre, leur statut risque de devenir incohérent.";

$lang['last_name']="Nom ";
$lang['ticket_statistics']="Statistiques sur le Ticket";
$lang['supporter_id']="N° de Membre ";
$lang['name']="Nom ";
$lang['phone']="Téléphone ";
$lang['email']="Courriel ";
$lang['groups']="Groupes ";

$lang['supporters']="Membres";

$lang['enter_supporter_info']="Saisissez les Informations pour le membre";
$lang['administrator']="Administrateur";
$lang['supporter']="Membre ";
$lang['add_supporter']="Ajouter un Membre";
$lang['add_to_groups']="Ajouter aux Groupes";


// [In common.php]
$lang['supporter_info']="Informations pour le Membre";
$lang['fax']="Fax ";
$lang['type']="Type ";
$lang['comments']="Commentaires ";
$lang['modified_by']="Modifié par ";
$lang['last_modified']="Dernière Modification ";

//-----------------
$lang['edit_supporter_info']="Editer les Information du Membre";
$lang['first_name']="Prénom ";
$lang['password_again']="Confirmez le Mot de Passe ";
$lang['email_address']="Adresse de Courriel ";
$lang['text_leave_blank']="Laissez à blanc pour ne pas changer";


///////////////////////////////////////////////////////////////////////////////////////
/** [Error and Success Messages] ************************************/
$lang['err_missing_info']="Il manque des informations...Cliquez sur le bouton 'Précédent' de votre navigateur et réessayez.";
$lang['err_user_exists']="Un membre ayant le même nom existe déjà !";
$lang['err_password_mismatch']="Les 'Mot de Passe' ne correspondent pas.";
$lang['err_group_exists']="Un groupe ayant le même nom existe déjà !";
$lang['err_company_exists']="Une société ayant le même nom existe déjà !";
$lang['err_email_exists']="Un membre ayant la même adresse de courriel existe déjà !";

$lang['msg_supporter_updated']="Mise à jour des information du Membre réussie.";
$lang['msg_added_successfully']="ajouté avec succés";
$lang['msg_updated_successfully']="mis à jour avec succés";
$lang['msg_created_successfully']="créé avec succés";
$lang['msg_deleted_successfully']="suppression réussie";
$lang['msg_profile_updated']="Votre profil a été mis à jour avec succés.";


////////////////////////////////////////////////////////////////////////////////
/** [Statistics] ****************************************************/
$lang['ticket_time_sheets']="Suivi des tâches";
$lang['time_sheet_for']="Suivi des tâches pour ";
$lang['my_time_sheet']="Mes tâches";

$lang['ticket_id']="N° de Ticket ";
$lang['title']="Intitulé ";
$lang['status']="Statut ";
$lang['hours_worked']="Temps passé (H)";
$lang['minutes_worked']="Temps passé (M)";

$lang['ticket_statistics']="Statistiques";
$lang['ticket_statistics_for']="Statistiques pour ";
$lang['case']="Objet";
$lang['open']="Ouverts";
$lang['closed']="Terminés";
$lang['total']="Total";
$lang['priorities']="Priorités";
$lang['categories']="Catégories ";
$lang['last_updated']="Dernière Mise à Jour";

$lang['opened_during']="Ouverts";
$lang['closed_during']="Fermés";
$lang['ticket_pipeline']="Tableau de bord";
$lang['avg_ticket_lifetime_weeks']="Durée de vie moyenne des Tickets par semaines";
$lang['less_1']="Moins d'Une";
$lang['1_2']="Une à Deux";
$lang['2_3']="Deux à Trois";
$lang['3_4']="Trois à Quatre";
$lang['more_4']="Plus de Quatre";

////////////////////////////////////////////////////////////////////////////////
/** [Time Sheets] ****************************************************/
$lang['track_time_ticket_id'] = "Temps passé - N° de Ticket : ";

////////////////////////////////////////////////////////////////////////////////
/** [Files] ****************************************************/
$lang['files_ticket_id'] = "Fichiers - N° de Ticket : ";
$lang['add_file'] = "Ajouter un Fichier";
$lang['ticket_detail'] = "Détail du Ticket";
$lang['file'] = "Fichier";
$lang['upload'] = "Envoyer";
$lang['no_files'] = "Il n'existe pas de fichiers associés à ce ticket.";
$lang['posted_by'] = "Envoyé le XXX par YYY."; // DO NOT TRANSLATE XXX AND YYY

///////////////////////////////////////////////////////////////////////////////////////
/** [Groups] ********************************************************/
$lang['group_id']="N° de Groupe";
$lang['text_warning_del_group']="Attention : Supprimer un groupe ne supprime pas les membres du groupe.<br/>Mais il est déconseillé d'attribuer des tickets aux membres de ce groupe.";

$lang['group_name']="Nom du Groupe";
$lang['edit_group_info']="Editer les Informations du Groupe";
$lang['choose_supporters']="Choisir des Membres";

$lang['enter_group_info']="Saisissez les Informations du Groupe";

// [In common.php]
$lang['group_info']="Information du Groupe";


///////////////////////////////////////////////////////////////////////////////////////
/** [FAQs] **********************************************************/
$lang['faqs']="FAQ";
$lang['question']="Question ";
$lang['category']="Catégorie ";
$lang['new_category']="Nouvelle Catégorie";
$lang['compose_faq']="Soumettre un FAQ";
$lang['answer']="Répondre";
$lang['add_faq']="Ajouter un FAQ";
$lang['faq_detail']="Détail d'un FAQ";
$lang['faq_id']="N° de FAQ";
$lang['edit_faq']="Editer un FAQ";
$lang['faq_search']="Rechercher un FAQ";
$lang['text_enter_keyword']="Saisissez un mot clé";


///////////////////////////////////////////////////////////////////////////////////////
/** [Control] *******************************************************/
$lang['control_panel']="Préférences";
$lang['setting']="Paramètres";
$lang['value']="Valeur";
$lang['helpdesk_name']="Nom du Helpdesk ";
$lang['administrator_email']="Adresse de courriel de l'Administrateur ";
$lang['helpdesk_on-off']="Helpdesk Activé/Désactivé ";
$lang['reason_helpdesk_off']="Si votre helpdesk est désactivé, veuillez renseigner une raison ";
$lang['num_supporters_per_page']="Nombre de Membres/Contacts par pages ";
$lang['num_groups_per_page']="Nombre de Groupes/Sociétés par pages ";
$lang['num_tickets_per_page']="Nombre de Tickets par pages ";
$lang['num_announcements_to_list']="Nombre de messages à afficher ";
$lang['time_tracking_status']="Gérer les temps de traitement ";
$lang['products_options_status']="Gérer les Produits ";
$lang['smtp_status']="Activer SMTP ";
$lang['who_online_status']="Afficher les Membres connectés ";
$lang['system_statistics']="Statistiques Système ";
$lang['submit_changes']="Appliquer les modifications";
$lang['automatic_mail_notification']="Activer la notification par courriel aux membres ";


///////////////////////////////////////////////////////////////////////////////////////
/** [Contact] *******************************************************/
$lang['contact_id']="N° de Contact ";
$lang['group']="Groupe ";
$lang['client']="Société ";
$lang['contact']="Contact ";
$lang['priority']="Priorité ";
$lang['platform']="Plateforme ";
$lang['description']="Description ";
$lang['version']="Version ";
$lang['product_id']="N° de Produit ";
$lang['ticket_modules']="Modules ";
$lang['email_contact']="Adresse de courriel du Contact ";
$lang['time_spent']="Temps passé ";
$lang['text_minutes_spent']="minutes passées pour le ticket depuis la dernière mise à jour";
//-- [Supporter] -----------------------------------------------------
$lang['contact_info']="Informations pour le Contact";
$lang['view_tickets']="Consulter les Tickets";
$lang['edit_contact_info']="Editer les Informations du Contact";
$lang['msg_warning_del_contact']="Attention : Supprimer un contact n'est pas conseillé.<br/>S'il existe des tickets asociés au contact, leur état peut devenir incohérent.";
$lang['contact_search']="Rechercher un Contact";
$lang['text_contact_search']="Saisissez une information quelconque pour le contact que vous recherchez.";
$lang['enter_contact_info']="Saisissez les Informations du Contact";


////////////////////////////////////////////////////////////////////////////////
/** [Company] *******************************************************/
$lang['enter_company_info']="Saisissez les Informations de la Société";
$lang['company_name']="Nom de la Société";
$lang['address']="Adresse";
$lang['add_company']="Ajouter une Société";
$lang['company_id']="N° de Société";
$lang['main_contact']="Contact Principal";
$lang['company_info']="Informations pour la Société";
$lang['contacts']="Contacts";
$lang['edit_company_info']="Editer les Informations de la Société";
$lang['text_warning_del_company']="Attention : Les contacts rattachés à une société ne sont pas supprimés mais déplacés vers les contacts non affectés à une société.<br/>Mais supprimer une société n'est pas conseillé.<br/>S'il existe des tickets associés à cette société, leur état peut devenir incohérent.";

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
$lang['step_one'] = "1ère Etape : Créer les Tables";
$lang['step_one_text'] = "Vous êtes maintenant prêt à commencer l'installation du logiciel 'MyHelpDesk'.<br>Cliquez sur <b>Suivant</b> pour créer toutes les tables de la base de données.";
$lang['step_two'] = "2ème Etape : Configurer le compte Administrateur";
$lang['company_comments'] = "Commentaires pour la Société";
$lang['required_field'] = "Champs obligatoires";
$lang['press_back_button'] = "Cliquez sur le bouton 'Précédent' de votre navigateur pour corriger le problème.";
$lang['step_three'] = "3ème Etape : Fin d'installation";
$lang['step_three_text'] = "Vous venez d'installer le logiciel 'MyHelpDesk' et de créer le compte Administrateur.<br>Vous devez maintenant vous connecter en tant que LOGIN et créer une structure pour les Tickets."; // DO NOT TRANSLATE LOGIN
$lang['install_error'] = "L'information pour XXX est manquante ou incorrecte."; // DO NOT TRANSLATE XXX

//insert some data into the platforms table.
$lang['generic'] = "Générique";
$lang['pc'] = "PC";
$lang['macintosh'] = "Macintosh";

//insert some data into the categories table.
$lang['big_problem'] = "Gros Problème";
$lang['small_problem'] = "Petit Problème";
$lang['other_problem'] = "Autre Problème";

//insert some data into the priorities table.
$lang['critical'] = "Critique";
$lang['high'] = "Elevé";
$lang['medium'] = "Normal";
$lang['low'] = "Faible";

//insert some data into the status table.
$lang['open'] = "Ouvert";
$lang['in_progress'] = "En cours";
$lang['waiting_for_response'] = "Attente d'une réponse";
$lang['closed'] = "Terminé";

//insert default contact for inactive contacts company
$lang['defaultcontact'] = "Ce contact ne peut pas être modifié !";
//insert inactive contacts company
$lang['inactivecontacts'] = "Cette société ne peut pas être modifiée !";
$lang['inactivecontactsaddress'] = "Cette société virtuelle sert au regroupement des contacts non attachés à une société.";
//insert welcome message in the announcements table
$lang['welcome'] = "Bienvenue ! Merci d'avoir installé MyHelpdesk ! Consultez <a href=http://www.sourceforge.net/projects/myhelpdesk/>MyHelpdesk</a> sur SourceForge si vous avez des questions.";

?>
