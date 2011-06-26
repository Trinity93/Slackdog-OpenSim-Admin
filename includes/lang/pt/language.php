<?php
/*******************************************************************************
**	file:	language.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/18
********************************************************************************
**	$Revision: 1.8 $ on $Date: 2004/02/12 04:35:04 $ by $Author: lmpmbernardo $
*******************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////
/** [Common] ********************************************************/
$lang['submit']="Submeter";
$lang['add']="Adicionar";
$lang['update']="Actualizar";
$lang['cancel']="Cancelar";
$lang['delete']="Apagar";
$lang['edit']="Alterar";
$lang['modify']="Modificar";
$lang['refresh']="Refrescar";
$lang['reset']="Anular";
$lang['id'] = "Nr.";


$lang['rank']="Ordem";
$lang['there_are']="Há";
$lang['sort_by']="Ordenar Por";
$lang['previous']="Anterior";
$lang['next']="Seguinte";
$lang['detail']="Detalhe";

$lang['success']="Sucesso";
$lang['all']="Todos";
$lang['from']="De";
$lang['to']="Para";

$lang['more_detail']="Mais Detalhe";
$lang['less_detail']="Menos Detalhe";

$lang['unknown']="desconhecido";

//////////////////////////////////////////////////////////////////////
/** [Login] *********************************************************/
$lang['login']="Entrada";
$lang['user_name']="Utilizador";
$lang['password']="Senha";
$lang['lang']="Idioma";


///////////////////////////////////////////////////////////////////////////////////////
/** [Index] *********************************************************/
/** [Left Menu] *****************************************************/
$lang['administration']="Administração";
$lang['support']="Suporte";
$lang['text_who_online']="Quem está online";
$lang['home']="Início";
$lang['logout']="Sair";
$lang['settings']="Configurar";

// Ticket Options
$lang['ticket_options']="Configurar Bilhetes";
$lang['ticket_categories']="Categoria dos Bilhetes";
$lang['ticket_priorities']="Prioridade dos Bilhetes";
$lang['ticket_status']="Estado dos Bilhetes";
$lang['ticket_platforms']="Plataforma dos Bilhetes";
//-- Supporter -----------------------------------------------------
$lang['ticket_management']="Gestão dos Bilhetes";
$lang['create_ticket']="Criar Bilhete";
$lang['my_tickets']="Os Meus Bilhetes";
$lang['my_groups_tickets']="Bilhetes dos Meus Grupos";
$lang['all_tickets']="Todos os Bilhetes";
$lang['ticket_search']="Procurar Bilhete";


// Product Options
$lang['product_options']="Configurar Produtos";
$lang['product_modules']="Módulos dos Produtos";
$lang['product_versions']="Versões dos Produtos";

// Supporter Management
$lang['supporter_management']="Gestão de Técnicos";
$lang['view_supporters']="Ver Técnicos";
$lang['view_groups']="Ver Grupos";
$lang['add_supporter']="Adicionar Técnico";
$lang['add_group']="Adicionar Grupo";

// FAQs Management
$lang['faqs_management']="Gestão das PMFs";
$lang['view_faqs']="Ver PMFs";
$lang['add_faq']="Adicionar PMF";
$lang['faq_categories']="Categoria das PMFs";

// Ticket Reporting
$lang['ticket_reporting']="Relatório dos Bilhetes";
$lang['cumulative_statistics']="Estatísticas Agregadas";
// not sure about this translation
$lang['pipeline_statistics']="Estatísticas de Trânsito";
$lang['time_sheets']="Registos Horários";

/** [Clients] *******************************************************/
$lang['client_management']="Gestão dos Clientes";
$lang['view_contacts']="Ver Contactos";
$lang['view_companies']="Ver Empresas";
$lang['contact_search']="Procurar Cliente";
$lang['add_contact']="Adicionar Contacto";
$lang['add_company']="Adicionar Empresa";

$lang['my_records']="Os Meus Registos";
$lang['edit_my_profile']="Alterar Perfil";
$lang['my_time_sheet']="Os Meus Registos Horários";
$lang['my_ticket_statistics']="As Minhas Estatísticas";

$lang['knowledge_base']="Base do Conhecimento";
$lang['search_faqs']="Procurar PMFs";


///////////////////////////////////////////////////////////////////////////////////////
/** [Announcements] *************************************************/
$lang['announcements']="Anúncios";


///////////////////////////////////////////////////////////////////////////////////////
/** [Tickets] *******************************************************/
$lang['text_ticket_categories']="A ordem das Categorias dos Bilhetes é usada para propósitos de ordenação.";
$lang['new_category']="Categoria Nova";

$lang['text_ticket_priorities']="A ordem das Prioridades dos Bilhetes é usada para propósitos de ordenação. Quanto mais baixa a ordem, mais alta a prioridade.";
$lang['new_priority']="Prioridade Nova";

$lang['text_ticket_status']="A ordem dos Estados dos Bilhetes é usada para propósitos de ordenação. Certifique-se que os <strong>bilhetes fechados têm a ordem mais alta</strong>.";
$lang['new_status']="Estado Novo";

$lang['text_ticket_platform']="A ordem das Plataformas dos Bilhetes é usada para propósitos de ordenação.";
$lang['new_platform']="Plataforma Nova";
//-- [Supporter] -----------------------------------------------------
$lang['ticket_created']="Bilhete criado";
$lang['assigned_to']="Atribuido a";
$lang['text_take_a_look']="Por favor dê uma olhada nisto";
$lang['ticket']="Bilhete";
$lang['text_created_assigned']="criado e atribuido a si";
$lang['update_ticket']="Actualize Bilhete";
$lang['ticket_information']="Informação do Bilhete";
$lang['ticket_id']="Nr. do Bilhete";
$lang['company']="Empresa";
$lang['companies']="Empresas";
$lang['date_created']="Data Criado";
$lang['track_time']="Registo Horário";
$lang['files']="Ficheiros";
$lang['history']="Historial";
$lang['transferred_to_'] = "Transferido para ";
$lang['please_take_over'] = "Por favor encarregue-se deste bilhete.";
$lang['ticket_reassigned'] = "Bilhete XXX re-atribuído a si."; // DO NOT TRANSLATE XXX
$lang['_contact_changed_to'] = " Contacto alterado para XXX."; // DO NOT TRANSLATE XXX
$lang['_priority_changed_to'] = " Prioridade alterada para XXX."; // DO NOT TRANSLATE XXX
$lang['_status_changed_to'] = " Estado alterado para XXX."; // DO NOT TRANSLATE XXX
$lang['email_sent'] = "E-mail Enviado";
$lang['ticket_history_log'] = "Bilhete Historial - Bilhete Nr.: ";
$lang['reverse'] = "Inverter";


$lang['my_tickets']="Os Meus Bilhetes";
$lang['contact_tickets']="Bilhetes do Contacto";
$lang['company_tickets']="Bilhetes da Empresa";
$lang['all_tickets']="Todos os Bilhetes";
$lang['updated']="Actualizado";
$lang['text_ticket_search']="Insira qualquer da informação sobre um bilhete de que esteja à procura.";
$lang['keyword']="Palavra Chave";
$lang['number']="Número";
$lang['search']="Procurar";
$lang['created']="Criado";

$lang['records_found']="Registos encontrados: ";

$lang['text_num_mins_worked']="Insira o número de minutos que trabalhou para cada bilhete que quiser actualizar.";

///////////////////////////////////////////////////////////////////////////////////////
/** [Modules] *******************************************************/
$lang['new_module']="Novo Módulo";
$lang['module']="módulo";
$lang['modules']="módulos";

$lang['new_version']="Nova Versão";
$lang['version']="versão";
$lang['versions']="versões";


///////////////////////////////////////////////////////////////////////////////////////
/** [Supporters] ****************************************************/
$lang['confirmation']="Confirmação";
$lang['q_are_you_sure']="Têm a certeza?";
$lang['text_warning_del_supporter']="Atenção: Remover um técnico não é aconselhavel.<br/>Se houver bilhetes associados com o técnico o estado deles pode ficar inconsistente.";

$lang['last_name']="Último Nome";
$lang['ticket_statistics']="Estatísticas dos Bilhetes";
$lang['supporter_id']="Nr. do Técnico";
$lang['name']="Nome";
$lang['phone']="Telefone";
$lang['email']="E-mail";
$lang['groups']="Grupos";

$lang['supporters']="Técnicos";

$lang['enter_supporter_info']="Insira Informação do Técnico";
$lang['administrator']="Administrador";
$lang['supporter']="Técnico";
$lang['add_supporter']="Adicionar Técnico";
$lang['add_to_groups']="Adicionar aos Grupos";


// [In common.php]
$lang['supporter_info']="Informação do Técnico";
$lang['fax']="Fax";
$lang['type']="Tipo";
$lang['comments']="Comentários";
$lang['modified_by']="Modificado por";
$lang['last_modified']="Última Modificação";

//-----------------
$lang['edit_supporter_info']="Altere Informação do Técnico";
$lang['first_name']="Primeiro Nome";
$lang['password_again']="Senha Outra Vez";
$lang['email_address']="Endereço de E-mail";
$lang['text_leave_blank']="deixar em branco se não mudar";


///////////////////////////////////////////////////////////////////////////////////////
/** [Error and Success Messages] ************************************/
$lang['err_missing_info']="Há informação que falta... por favor volte atrás e tente outra vez.";
$lang['err_user_exists']="Já existe alguém com esse nome de utilizador!";
$lang['err_password_mismatch']="As senhas não são iguais.";
$lang['err_group_exists']="Já existe um grupo com esse nome!";
$lang['err_company_exists']="Já existe uma empresa com esse nome!";

$lang['msg_supporter_updated']="Informação do Técnico actualizada com sucesso.";
$lang['msg_added_successfully']="adicionado com sucesso";
$lang['msg_updated_successfully']="actualizado com sucesso";
$lang['msg_created_successfully']="criado com sucesso";
$lang['msg_deleted_successfully']="removido com sucesso";


///////////////////////////////////////////////////////////////////////////////////////
/** [Statistics] ****************************************************/
$lang['ticket_time_sheets']="Registos Horários";
$lang['time_sheet_for']="Registos Horários para ";
$lang['my_time_sheet']="Os Meus Registos Horários";

$lang['ticket_id']="Nr. do Bilhete";
$lang['title']="Título";
$lang['status']="Estado";
$lang['hours_worked']="Horas Gastas";
$lang['minutes_worked']="Minutos Gastos";

$lang['ticket_statistics']="Estatísticas dos Bilhetes";
$lang['ticket_statistics_for']="Estatísticas dos Bilhetes para ";
$lang['case']="Caso";
$lang['open']="Aberto";
$lang['closed']="Fechado";
$lang['total']="Total";
$lang['priorities']="Prioridades";
$lang['categories']="Categorias";
$lang['last_updated']="Última Actualização";

$lang['opened_during']="Abertos Durante";
$lang['closed_during']="Fechados Durante";
$lang['ticket_pipeline']="Bilhetes em Trânsito";
$lang['avg_ticket_lifetime_weeks']="Vida Média dos Bilhetes em Semanas";
$lang['less_1']="Menos de Uma";
$lang['1_2']="Uma a Dois";
$lang['2_3']="Duas a Três";
$lang['3_4']="Três a Quatro";
$lang['more_4']="Mais de Quatro";

////////////////////////////////////////////////////////////////////////////////
/** [Time Sheets] ****************************************************/
$lang['track_time_ticket_id'] = "Registo de Tempos - Bilhete Nr.: ";

////////////////////////////////////////////////////////////////////////////////
/** [Files] ****************************************************/
$lang['files_ticket_id'] = "Ficheiros - Bilhete Nr.: ";
$lang['add_file'] = "Adicionar Ficheiro";
$lang['ticket_detail'] = "Bilhete";
$lang['file'] = "Ficheiro";
$lang['upload'] = "Carregar";
$lang['no_files'] = "Não há ficheiros associados com este bilhete.";
$lang['posted_by'] = "Arquivado a XXX por YYY."; // DO NOT TRANSLATE XXX AND YYY


///////////////////////////////////////////////////////////////////////////////////////
/** [Groups] ********************************************************/
$lang['group_id']="Nr. do Grupo";
$lang['text_warning_del_group']="Atenção: Remover um grupo não remove os técnicos que pertencem ao grupo.<br/>Mas não é aconselhavel se houver bilhetes associados com os técnicos deste grupo.";

$lang['group_name']="Nome do Grupo";
$lang['edit_group_info']="Alterar Informação do Grupo";
$lang['choose_supporters']="Escolha Técnicos";

$lang['enter_group_info']="Insira Informação do Grupo";

// [In common.php]
$lang['group_info']="Informação do Grupo";


///////////////////////////////////////////////////////////////////////////////////////
/** [FAQs] **********************************************************/
$lang['faqs']="PMFs";
$lang['question']="Questão";
$lang['category']="Categoria";
$lang['new_category']="Categoria Nova";
$lang['compose_faq']="Compor PMF";
$lang['answer']="Resposta";
$lang['add_faq']="Adicionar PMF";
$lang['faq_detail']="Detalhe da PMF";
$lang['faq_id']="Nr. da PMF";
$lang['edit_faq']="Altere PMF";
$lang['faq_search']="Procure PMF";
$lang['text_enter_keyword']="Insira uma palavra chave";


///////////////////////////////////////////////////////////////////////////////////////
/** [Control] *******************************************************/
$lang['control_panel']="Painel de Controlo";
$lang['setting']="Parâmetro";
$lang['value']="Valor";
$lang['helpdesk_name']="Nome da Helpdesk";
$lang['administrator_email']="E-mail do Administrador";
$lang['helpdesk_on-off']="Helpdesk Aberta/Fechada";
$lang['reason_helpdesk_off']="Se a helpdesk esta fechada, por favor insira explicação";
$lang['num_supporters_per_page']="Número de Técnicos/Contactos por página";
$lang['num_groups_per_page']="Número de Grupos/Empresas por página";
$lang['num_tickets_per_page']="Número de Endereços/Bilhetes por página";
$lang['num_announcements_to_list']="Número de Anúncios visíveis";
$lang['time_tracking_status']="Monitorização dos Tempos";
$lang['products_options_status']="Utilização dos Produtos";
$lang['smtp_status']="Uso de E-mail";
$lang['who_online_status']="Quem está Online";
$lang['system_statistics']="Estatísticas dos Bilhetes";
$lang['submit_changes']="Submeter Alterações";
$lang['automatic_mail_notification']="Notificação Automática por E-mail dos Técnicos";


///////////////////////////////////////////////////////////////////////////////////////
/** [Contact] *******************************************************/
$lang['contact_id']="Nr. do Contacto";
$lang['group']="Grupo";
$lang['client']="Cliente";
$lang['contact']="Contacto";
$lang['priority']="Prioridade";
$lang['platform']="Platforma";
$lang['description']="Descrição";
$lang['version']="Versão";
$lang['product_id']="Nr. do Producto";
$lang['ticket_modules']="Módulos";
$lang['email_contact']="E-mail Contacto";
$lang['time_spent']="Tempo Gasto";
$lang['text_minutes_spent']="minutos gastos a trabalhar no bilhete desde a última actualização";
//-- [Supporter] -----------------------------------------------------
$lang['contact_info']="Informação do Contacto";
$lang['view_tickets']="Ver Bilhetes";
$lang['edit_contact_info']="Alterar Informação do Contacto";
$lang['msg_warning_del_contact']="Atenção: Remover um contacto não é aconselhavel.<br/>Se houver bilhetes associados com este contacto eles podem ficar inconsistentes.";
//$lang['contact_search']="Procure Contacto";
$lang['text_contact_search']="Insira qualquer informação acerca de um cliente que esteja a procurar.";
$lang['enter_contact_info']="Insira Informação do Contacto";


///////////////////////////////////////////////////////////////////////////////////////
/** [Company] *******************************************************/
$lang['enter_company_info']="Insira Informação da Empresa";
$lang['company_name']="Nome da Empresa";
$lang['address']="Endereço";
$lang['add_company']="Adicionar Empresa";
$lang['company_id']="Nr. da Empresa";
$lang['main_contact']="Principal Contacto";
$lang['company_info']="Informação da Empresa";
$lang['contacts']="Contactos";

////////////////////////////////////////////////////////////////////////////////
/** [Address Book] *******************************************************/
$lang['address_book'] = "Lista de Endereços";
$lang['last_first_name'] = "Último, Primeiro Nome";

////////////////////////////////////////////////////////////////////////////////
/** [Company Statistics] *******************************************************/
$lang[company_statistics] = "Estatísticas por Empresas";
$lang[tickets] = "Bilhetes";
$lang[first_ticket] = "Primeiro Bilhete";
$lang[last_ticket] = "Último Bilhete";

////////////////////////////////////////////////////////////////////////////////
/** [Installation] *******************************************************/
$lang['installation'] = "Instalação";
$lang['step_one'] = "Primeiro Passo: Criar Tabelas";
$lang['step_one_text'] = "Está pronto a instalar o software de helpdesk.<br>Clicar <b>NEXT</b> para criar as tabelas da base de dados."; // DO NOT TRANSLATE NEXT
$lang['step_two'] = "Segundo Passo: Conta do Administrador";
$lang['company_comments'] = "Commentários da Empresa";
$lang['required_field'] = "Campo Obrigatório";
$lang['press_back_button'] = "Por favor clicar no botão Back do browser para corrigir o problema.";
$lang['step_three'] = "Terceiro Passo: Configurar";
$lang['step_three_text'] = "Você instalou o software de helpdesk e criou a conta do Administrador.<br>Agora deve fazer LOGIN e configurar as opções dos bilhetes."; // DO NOT TRANSLATE LOGIN
$lang['install_error'] = "A informação XXX está a faltar ou é incorrecta."; // DO NOT TRANSLATE XXX

//insert some data into the platforms table.
$lang['generic'] = "Genérico";
$lang['pc'] = "PC";
$lang['macintosh'] = "Macintosh";

//insert some data into the categories table.
$lang['big_problem'] = "Problema Grande";
$lang['small_problem'] = "Problema Pequeno";
$lang['other_problem'] = "Outro Problema";

//insert some data into the priorities table.
$lang['critical'] = "Crítica";
$lang['high'] = "Alta";
$lang['medium'] = "Média";
$lang['low'] = "Baixa";

//insert some data into the status table.
$lang['open'] = "Aberto";
$lang['in_progress'] = "Em Progresso";
$lang['waiting_for_response'] = "À Espera de Resposta";
$lang['closed'] = "Fechado";

//insert default contact for inactive contacts company
$lang['defaultcontact'] = "Este contacto não pode ser alterado!";
//insert inactive contacts company
$lang['inactivecontacts'] = "Esta empresa não pode ser alterada!";
$lang['inactivecontactsaddress'] = "Esta empresa virtual serve como depósito de contactos que não estão associados com nenhuma empresa.";
//insert welcome message in the announcements table
$lang['welcome'] = "Bem-vindo! Obrigado por ter instalado MyHelpdesk! Visite <a href=http://www.sourceforge.net/projects/myhelpdesk/>MyHelpdesk</a> no site da SourceForge se tiver alguma pergunta.";

?>