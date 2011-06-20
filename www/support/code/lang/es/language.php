<?php
/*******************************************************************************
**	file: language.php
********************************************************************************
**	author:	Sergio Arias
**	date:	12/12/2003
********************************************************************************
**	$Revision: 1.12 $ on $Date: 2004/02/12 04:35:04 $ by $Author: lmpmbernardo $
*******************************************************************************/
//////////////////////////////////////////////////////////////////////////////////////
/** [Common] ********************************************************/
$lang['submit']="Enviar";
$lang['add']="A&ntilde;adir";
$lang['update']="Actualizar";
$lang['cancel']="Cancelar";
$lang['delete']="Borrar";
$lang['edit']="Editar";
$lang['modify']="Modificar";
$lang['refresh']="Refrescar";
$lang['reset']="Resetear";
$lang['id'] = "ID";


$lang['rank']="Posici&oacute;n";
$lang['there_are']="Hay";
$lang['sort_by']="Ordenado por";
$lang['previous']="Anterior";
$lang['next']="Siguiente";
$lang['detail']="Detalle";

$lang['success']="&Eacute;xito";
$lang['all']="Todos";
$lang['from']="Desde";
$lang['to']="Hasta";

// [15/12/2003 seh] Since this value is used in the submission, don't use HTML entities, as in 'M&aacute;s'
// TODO: Fix it (in common.php)
$lang['more_detail']="Más";
$lang['less_detail']="Menos";
//--

$lang['unknown']="desconocido";


///////////////////////////////////////////////////////////////////////////////////////
/** [Login] *********************************************************/
$lang['login']="Registro";
$lang['user_name']="Usuario";
$lang['password']="Contrase&ntilde;a";
$lang['lang']="Idioma";
$lang['login_to']="Entrar en";

$lang['err_login_failed']="Fallo al registrarse";
$lang['err_username_incorrect']="Su usuario/clave no son correctos.";


///////////////////////////////////////////////////////////////////////////////////////
/** [Index] *********************************************************/
/** [Left Menu] *****************************************************/
$lang['administration']="Administraci&oacute;n";
$lang['support']="Soporte";
$lang['text_who_online']="En l&iacute;nea";
$lang['home']="Inicio";
$lang['logout']="Salir";
$lang['settings']="Ajustes";

// Ticket Options
$lang['ticket_options']="Opciones de Incidencia";
$lang['ticket_categories']="Categor&iacute;as de Incidencia";
$lang['ticket_priorities']="Prioridades de Incidencia";
$lang['ticket_status']="Estado de Incidencia";
$lang['ticket_platforms']="Plataforma de Incidencia";
//-- Supporter -----------------------------------------------------
$lang['ticket_management']="Gesti&oacute;n de Incidencias";
$lang['create_ticket']="Crear Incidencia";
$lang['my_tickets']="Mis Incidencias";
$lang['my_groups_tickets']="Incidencias de Mis Grupos";
$lang['all_tickets']="Todas las Incidencias";
$lang['ticket_search']="B&uacute;squeda de Incidencias";

// Product Options
$lang['product_options']="Opciones del Producto";
$lang['product_modules']="M&oacute;dulos del Producto";
$lang['product_versions']="Versiones del Producto";

// Supporter Management
$lang['supporter_management']="Gesti&oacute;n de T&eacute;cnicos";
$lang['view_supporters']="Ver T&eacute;cnicos";
$lang['view_groups']="Ver Grupos";
$lang['add_supporter']="A&ntilde;adir T&eacute;cnico";
$lang['add_group']="A&ntilde;adir Grupo";

// FAQs Management
$lang['faqs_management']="Gesti&oacute;n de FAQs";
$lang['view_faqs']="Ver FAQs";
$lang['add_faq']="A&ntilde;adir FAQ";
$lang['faq_categories']="Categor&iacute;as de FAQs";

// Ticket Reporting
$lang['ticket_reporting']="Informes de Incidencias";
$lang['cumulative_statistics']="Estad&iacute;sticas Acumuladas";
// not sure about this translation
$lang['pipeline_statistics']="Estad&iacute;sticas en Tr&aacute;mite";
$lang['time_sheets']="Registro Horario";

/** [Clients] *******************************************************/
$lang['client_management']="Gesti&oacute;n de Clientes";
$lang['view_contacts']="Ver Contactos";
$lang['view_companies']="Ver Empresas";
$lang['contact_search']="B&uacute;squeda de Contactos";
$lang['add_contact']="A&ntilde;adir Contacto";
$lang['add_company']="A&ntilde;adir Empresa";

$lang['my_records']="Mis Registros";
$lang['edit_my_profile']="Editar Mi Perfil";
$lang['my_ticket_statistics']="Mis Estad&iacute;sticas de Incidencias";

$lang['knowledge_base']="Base de Conocimiento";
$lang['search_faqs']="Buscar FAQs";


///////////////////////////////////////////////////////////////////////////////////////
/** [Announcements] *************************************************/
$lang['announcements']="Anuncios";


///////////////////////////////////////////////////////////////////////////////////////
/** [Tickets] *******************************************************/
$lang['text_ticket_categories']="La posici&oacute;n de las Categor&iacute;as de Incidencias se utilizan para la ordenaci&oacute;n.";
$lang['new_category']="Nueva Categor&iacute;a";

$lang['text_ticket_priorities']="La posici&oacute;n de las Prioridades de la Incidencia se utilizan para la ordenaci&oacute;n. <strong>Cuanto menor es la posici&oacute;n, mayor es la prioridad.</strong>.";
$lang['new_priority']="Nueva Prioridad";

$lang['text_ticket_status']="La posici&oacute;n del Estado de la Incidencia se utiliza para la ordenaci&oacute;n. Aseg&uacute;rese de que <strong>las incidencias cerradas tienen la posici&oacute;n m&aacute;s alta</strong>.";
$lang['new_status']="Nuevo Estado";

$lang['text_ticket_platform']="La posici&oacute;n de las Plataformas de la Incidencia se utilizan para la ordenaci&oacute;n.";
$lang['new_platform']="Nueva Plataforma";
//-- [Supporter] -----------------------------------------------------
$lang['ticket_created']="Incidencia creada";
$lang['assigned_to']="Asignada a";
$lang['text_take_a_look']="Echa un vistazo a esto";
$lang['ticket']="Incidencia";
$lang['text_created_assigned']="creada y asignado a ti";
$lang['update_ticket']="Actualizar Incidencia";
$lang['ticket_information']="Informaci&oacute;n de la Incidencia";
$lang['ticket_id']="ID de la Incidencia";
$lang['company']="Empresa";
$lang['companies']="Empresas";
$lang['date_created']="Fecha Creaci&oacute;n";
$lang['track_time']="Ficha Seguimiento";
$lang['files']="Ficheros";
$lang['history']="Historial";
$lang['transferred_to_'] = "Transferred to ";
$lang['please_take_over'] = "Please take over this ticket.";
$lang['ticket_reassigned'] = "Ticket XXX re-assigned to you."; // DO NOT TRANSLATE XXX
$lang['_contact_changed_to'] = " Contact changed to XXX."; // DO NOT TRANSLATE XXX
$lang['_priority_changed_to'] = " Priority changed to XXX."; // DO NOT TRANSLATE XXX
$lang['_status_changed_to'] = " Status changed to XXX."; // DO NOT TRANSLATE XXX
$lang['email_sent'] = "E-mail Sent";
$lang['ticket_history_log'] = "Ticket History Log - Ticket ID: ";
$lang['reverse'] = "Reverse";


$lang['my_tickets']="Mis Incidencias";
$lang['contact_tickets']="Incidencias del Contacto";
$lang['company_tickets']="Incidencias de la Empresa";
$lang['all_tickets']="Todas las Incidencias";
$lang['updated']="Actualizado";
$lang['text_ticket_search']="Introduzca cualquier informaci&oacute;n acerca de una incidencia en particular que est&eacute; buscando.";
$lang['keyword']="Palabra Clave";
$lang['number']="N&uacute;mero";
$lang['search']="Buscar";
$lang['created']="Creada";

$lang['records_found']="Records found: ";

$lang['text_num_mins_worked']="Introduzca el n&uacute;mero de mintos trabajados para cada incidencia que desee actualizar.";


///////////////////////////////////////////////////////////////////////////////////////
/** [Modules] *******************************************************/
$lang['new_module']="Nuevo M&oacute;dulo";
$lang['module']="m&oacute;dulo";
$lang['modules']="m&oacute;dulos";

$lang['new_version']="Nueva Versi&oacute;n";
$lang['version']="versi&oacute;n";
$lang['versions']="versiones";


///////////////////////////////////////////////////////////////////////////////////////
/** [Supporters] ****************************************************/
$lang['confirmation']="Confirmaci&oacute;n";
$lang['q_are_you_sure']="&iquest;Est&aacute; seguro?";
$lang['text_warning_del_supporter']="Aviso: No es aconsejable eliminar un t&eacute;cnico.<br/>Si hay alguna incidencia asignada a ese t&eacute;cnico el estado de las mismas puede volverse inconsistente.";

$lang['last_name']="Apellido";
$lang['ticket_statistics']="Estad&iacute;sticas de la Incidencia";
$lang['supporter_id']="ID del T&eacute;cnico";
$lang['name']="Nombre";
$lang['phone']="Tel&eacute;fono";
$lang['email']="Correo-e";
$lang['groups']="Grupos";

$lang['supporters']="T&eacute;cnicos";

$lang['enter_supporter_info']="Introduzca la Informaci&oacute;n del T&eacute;cnico";
$lang['administrator']="Administrador";
$lang['supporter']="T&eacute;cnico";
$lang['add_supporter']="A&ntilde;adir T&eacute;cnico";
$lang['add_to_groups']="A&ntilde;adir A Grupos";

// [In common.php]
$lang['supporter_info']="Informaci&oacute;n del T&eacute;cnico";
$lang['fax']="Fax";
$lang['type']="Tipo";
$lang['comments']="Comentarios";
$lang['modified_by']="Modificado Por";
$lang['last_modified']="&Uacute;ltima Modificaci&oacute;n";

//-----------------
$lang['edit_supporter_info']="Editar la Informaci&oacute;n del T&eacute;cnico";
$lang['first_name']="Nombre";
$lang['password_again']="Repetir Contrase&ntilde;a";
$lang['email_address']="Direcci&oacute;n de Correo-e";
$lang['text_leave_blank']="d&eacute;jelo en blanco si no cambia";


///////////////////////////////////////////////////////////////////////////////////////
/** [Error and Success Messages] ************************************/
$lang['err_missing_info']="Falta por completar alguna informaci&oacute;n... Pulsa el bot&oacute;n de volver de tu navegador e int&eacute;ntalo de nuevo.";
$lang['err_user_exists']="¡Ya existe un usuario con ese nombre!";
$lang['err_password_mismatch']="Las contrase&ntilde;as no coinciden.";
$lang['err_group_exists']="¡Ya existe un grupo con ese nombre!";
$lang['err_company_exists']="¡Ya existe una empresa con ese nombre!";
$lang['err_email_exists']="¡Ya existe una persona con ese correo-e!";

$lang['msg_supporter_updated']="La informaci&oacute;n del t&eacute;nico se ha actualizado con &eacute;xito.";
$lang['msg_added_successfully']="a&ntilde;adido/a con &eacute;xito";
$lang['msg_updated_successfully']="actualizado/a con &eacute;xito";
$lang['msg_created_successfully']="creado/a con &eacute;xito";
$lang['msg_deleted_successfully']="eliminado/a con &eacute;xito";
$lang['msg_profile_updated']="Su perfil se ha actualizado con &eacute;xito.";


///////////////////////////////////////////////////////////////////////////////////////
/** [Statistics] ****************************************************/
$lang['ticket_time_sheets']="Registro Horario de las Incidencias";
$lang['time_sheet_for']="Registro Horario de";
$lang['my_time_sheet']="Mi Registro Horario";

$lang['ticket_id']="ID de la Incidencia";
$lang['title']="T&iacute;tulo";
$lang['status']="Estado";
$lang['hours_worked']="Horas Trabajadas";
$lang['minutes_worked']="Minutos Trabajados";

$lang['ticket_statistics']="Estad&iacute;sticas de la Incidencia";
$lang['ticket_statistics_for']="Estad&iacute;sticas de la Incidencia para ";
$lang['case']="Caso";
$lang['open']="Abiertos";
$lang['opened']="Abiertos";
$lang['closed']="Cerrados";
$lang['total']="Total";
$lang['priorities']="Prioridades";
$lang['categories']="Categor&iacute;as";
$lang['last_updated']="&Uacute;ltima Actualizaci&oacute;n";

$lang['opened_during']="Abiertas Durante";
$lang['closed_during']="Cerradas Durante";
$lang['ticket_pipeline']="Incidencias en Tr&aacute;mite";
$lang['avg_ticket_lifetime_weeks']="Tiempo Medio de Vida de las incidencias en Semanas";
$lang['less_1']="Menos de Una";
$lang['1_2']="De Una a Dos";
$lang['2_3']="De Dos a Tres";
$lang['3_4']="De Tres a Cuatro";
$lang['more_4']="M&aacute;s de Cuatro";

////////////////////////////////////////////////////////////////////////////////
/** [Time Sheets] ****************************************************/
$lang['track_time_ticket_id'] = "Track Time - Ticket ID: ";

////////////////////////////////////////////////////////////////////////////////
/** [Files] ****************************************************/
$lang['files_ticket_id'] = "Files - Ticket ID: ";
$lang['add_file'] = "Add File";
$lang['ticket_detail'] = "Ticket Detail";
$lang['file'] = "File";
$lang['upload'] = "Upload";
$lang['no_files'] = "There are no files associated with this ticket.";
$lang['posted_by'] = "Posted on XXX by YYY."; // DO NOT TRANSLATE XXX AND YYY


///////////////////////////////////////////////////////////////////////////////////////
/** [Groups] ********************************************************/
$lang['group_id']="ID de Grupo";
$lang['text_warning_del_group']="Aviso: Borrar un grupo no elimina los t&eacute;cnicos que forman parte del mismo.<br/> No es aconsejable borrar un grupo si has asignado incidencias a t&eacute;cnicos del grupo.";

$lang['group_name']="Nombre del Grupo";
$lang['edit_group_info']="Editar la Informaci&oacute;n del Grupo";
$lang['choose_supporters']="Elige T&eacute;cnicos";

$lang['enter_group_info']="Introduzca la Infromaci&oacute;n del Grupo";

// [In common.php]
$lang['group_info']="Informaci&oacute;n de Grupo";


///////////////////////////////////////////////////////////////////////////////////////
/** [FAQs] **********************************************************/
$lang['faqs']="Preguntas M&aacute;s Frecuentes (PMFs/FAQs)";
$lang['question']="Pregunta";
$lang['category']="Categor&iacute;a";
$lang['new_category']="Nueva Categor&iacute;a";
$lang['compose_faq']="Crear FAQ";
$lang['answer']="Respuesta";
$lang['add_faq']="A&ntilde;adir FAQ";
$lang['faq_detail']="Detalle de FAQ";
$lang['faq_id']="ID de FAQ";
$lang['edit_faq']="Editar FAQ";
$lang['faq_search']="Buscar PMF (FAQ)";
$lang['text_enter_keyword']="Introduzca una palabra clave";


///////////////////////////////////////////////////////////////////////////////////////
/** [Control] *******************************************************/
$lang['control_panel']="Panel de Control";
$lang['setting']="Variable";
$lang['value']="Valor";
$lang['helpdesk_name']="Nombre del <i>helpdesk</i>";
$lang['administrator_email']="Correo-e del Administrador";
$lang['helpdesk_on-off']="<i>Helpdesk</i> On/Off";
$lang['reason_helpdesk_off']="Si el <i>helpdesk</i> est&aacute; desactivado, indica el motivo";
$lang['num_supporters_per_page']="N&uacute;mero de T&eacute;cnicos/Contactos a mostrar por p&aacute;gina";
$lang['num_groups_per_page']="N&uacute;mero de Grupos/Compa&ntilde;&iacute;as a mostrar por p&aacute;gina";
$lang['num_tickets_per_page']="N&uacute;mero de Incidencias a mostrar por p&aacute;gina";
$lang['num_announcements_to_list']="N&uacute;mero de Anuncios a mostrar";
$lang['time_tracking_status']="Estado del Seguimiento Temporal";
$lang['products_options_status']="Estado de las Opciones de Productos";
$lang['smtp_status']="Estado del SMTP";
$lang['who_online_status']="Estado de Quien est&aacute; en L&iacute;nea";
$lang['system_statistics']="Estad&iacute;sticas del Sistema";
$lang['submit_changes']="Enviar Cambios";
$lang['automatic_mail_notification']="Estado de la Notificaci&oacute;n Autom&aacute;tica al T&eacute;cnico por Correo-e";


///////////////////////////////////////////////////////////////////////////////////////
/** [Contact] *******************************************************/
$lang['contact_id']="ID del Contacto";
$lang['group']="Grupo";
$lang['client']="Cliente";
$lang['contact']="Contacto";
$lang['priority']="Prioridad";
$lang['platform']="Plataforma";
$lang['description']="Descripci&oacute;n";
$lang['version']="Versi&oacute;n";
$lang['product_id']="ID del Producto";
$lang['ticket_modules']="M&oacute;dulos";
$lang['email_contact']="Mandar Correo-e al Contacto";
$lang['time_spent']="Tiempo Transcurrido";
$lang['text_minutes_spent']="minutos transcurridos trabajando en la incidencia desde la &uacute;ltima actualizaci&oacute;n";
//-- [Supporter] -----------------------------------------------------
$lang['contact_info']="Informaci&oacute;n del Contacto";
$lang['view_tickets']="Ver Incidencias";
$lang['edit_contact_info']="Editar Informaci&oacute;n del Contacto";
$lang['msg_warning_del_contact']="Aviso: Eliminar un contacto no es aconsejable.<br/>Si hay incidencias asociadas a este contacto, su estado puede volverse inconsistente.";
$lang['contact_search']="B&uacute;squeda de Contacts";
$lang['text_contact_search']="Introduzca cualquier informaci&oacute;n acerca de un contacto en particular que est&eacute; buscando.";
$lang['enter_contact_info']="Introduzca la Informaci&oacute;n del Contacto";


///////////////////////////////////////////////////////////////////////////////////////
/** [Company] *******************************************************/
$lang['enter_company_info']="Introduce la Informaci&oacute;n de la Empresa";
$lang['company_name']="Nombre de la Empresa";
$lang['address']="Direcci&oacute;n";
$lang['add_company']="A&ntilde;adir Empresa";
$lang['company_id']="ID de la Empresa";
$lang['main_contact']="Contacto Principal";
$lang['company_info']="Informaci&oacute;n de la Empresa";
$lang['contacts']="Contactos";
$lang['edit_company_info']="Editar la Informaci&oacute;n de la Empresa";
$lang['text_warning_del_company']="Aviso: Los contactos de la empresa no se eliminan, sino que se asignan a la empresa 'Inactive Contacts'.<br/>Eliminar una empresa no es aconsejable.<br/>Si hay incidencias asociadas a esta empresa, su estado puede volverse inconsistente.";

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
$lang['step_one'] = "Step One: Create Tables";
$lang['step_one_text'] = "You are now ready to begin the installation of the helpdesk software.<br>Click <b>Next</b> to create all of the database tables.";
$lang['step_two'] = "Step Two: Administrator Account Setup";
$lang['company_comments'] = "Company Comments";
$lang['required_field'] = "Required Field";
$lang['press_back_button'] = "Please press the back button on your browser to correct the problem.";
$lang['step_three'] = "Step Three: Finishing Up";
$lang['step_three_text'] = "You have installed the helpdesk software and created the Administrator account.<br>You should now LOGIN and create a ticketing schema."; // DO NOT TRANSLATE LOGIN
$lang['install_error'] = "Your XXX information is either missing or incorrect."; // DO NOT TRANSLATE XXX

//insert some data into the platforms table.
$lang['generic'] = "Generic";
$lang['pc'] = "PC";
$lang['macintosh'] = "Macintosh";

//insert some data into the categories table.
$lang['big_problem'] = "Big Problem";
$lang['small_problem'] = "Small Problem";
$lang['other_problem'] = "Other Problem";

//insert some data into the priorities table.
$lang['critical'] = "Critical";
$lang['high'] = "High";
$lang['medium'] = "Medium";
$lang['low'] = "Low";

//insert some data into the status table.
$lang['open'] = "Open";
$lang['in_progress'] = "In Progress";
$lang['waiting_for_response'] = "Waiting for Response";
$lang['closed'] = "Closed";

//insert default contact for inactive contacts company
$lang['defaultcontact'] = "This contact cannot be modified!";
//insert inactive contacts company
$lang['inactivecontacts'] = "This company cannot be modified!";
$lang['inactivecontactsaddress'] = "This virtual company serves as a pool for contacts that are not assigned to any company.";
//insert welcome message in the announcements table
$lang['welcome'] = "Welcome! Thank you for installing MyHelpdesk! Visit <a href=http://www.sourceforge.net/projects/myhelpdesk/>MyHelpdesk</a> at SourceForge if you have any question.";

?>