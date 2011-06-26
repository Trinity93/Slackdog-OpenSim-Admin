<?php
/*******************************************************************************
**	file:	language.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/18
********************************************************************************
**	$Revision: 1.1 $ on $Date: 2004/03/01 06:07:08 $ by $Author: lmpmbernardo $
*******************************************************************************/
// Nota: Isto assume que o sistema vai ser usado dentro de uma empresa e em
// vez de Empresas há Escritórios. Se quiserem usar para várias empresas basta
// fazer um find & replace e mudar Escritório para Empresa.
///////////////////////////////////////////////////////////////////////////////////////
/** [Common] ********************************************************/
$lang['submit']="Enviar";
$lang['add']="Adicionar";
$lang['update']="Atualizar";
$lang['cancel']="Cancelar";
$lang['delete']="Apagar";
$lang['edit']="Editar";
$lang['modify']="Alterar";
$lang['refresh']="Capturar";
$lang['reset']="Limpar";
$lang['id'] = "ID";


$lang['rank']="Ordem";
$lang['there_are']="Há";
$lang['sort_by']="Ordenar Por";
$lang['previous']="Anterior";
$lang['next']="Próximo";
$lang['detail']="Detalhes";

$lang['success']="Sucesso";
$lang['all']="Todos";
$lang['from']="De";
$lang['to']="Para";

$lang['more_detail']="Mais Detalhes";
$lang['less_detail']="Menos Detalhes";

$lang['unknown']="desconhecido";

//////////////////////////////////////////////////////////////////////
/** [Login] *********************************************************/
$lang['login']="Login";
$lang['user_name']="Usuário";
$lang['password']="Senha";
$lang['lang']="Idioma";


///////////////////////////////////////////////////////////////////////////////////////
/** [Index] *********************************************************/
/** [Left Menu] *****************************************************/
$lang['administration']="Administração";
$lang['support']="Suporte";
$lang['text_who_online']="Quem está online";
$lang['home']="Home";
$lang['logout']="Logout";
$lang['settings']="Configurações";

// Ticket Options
$lang['ticket_options']="Configurar Ocorrências";
$lang['ticket_categories']="Categoria das Ocorrências";
$lang['ticket_priorities']="Prioridade das Ocorrências";
$lang['ticket_status']="Estado das Ocorrências";
$lang['ticket_platforms']="Plataforma das Ocorrências";
//-- Supporter -----------------------------------------------------
$lang['ticket_management']="Gestão das Ocorrências";
$lang['create_ticket']="Criar Ocorrência";
$lang['my_tickets']="Minhas Ocorrências";
$lang['my_groups_tickets']="Ocorrências dos Meus Grupos";
$lang['all_tickets']="Todas as Ocorrências";
$lang['ticket_search']="Procurar Ocorrência";


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
$lang['faqs_management']="Gestão de FAQs";
$lang['view_faqs']="Ver FAQs";
$lang['add_faq']="Adicionar FAQ";
$lang['faq_categories']="Categoria de FAQs";

// Ticket Reporting
$lang['ticket_reporting']="Relatório das Ocorrências";
$lang['cumulative_statistics']="Estatísticas Todas/por Técnico";
// not sure about this translation
$lang['pipeline_statistics']="Estatísticas Todas/por Estado";
$lang['time_sheets']="Registos Horários";

/** [Clients] *******************************************************/
$lang['client_management']="Gestão de Usuários";
$lang['view_contacts']="Ver Contatos";
$lang['view_companies']="Ver Escritórios";
$lang['contact_search']="Procurar Contato";
$lang['add_contact']="Adicionar Contato";
$lang['add_company']="Adicionar Escritório";

$lang['my_records']="Meus Registos";
$lang['edit_my_profile']="Alterar Perfil";
$lang['my_time_sheet']="Meus Registos Horários";
$lang['my_ticket_statistics']="Minhas Estatísticas";

$lang['knowledge_base']="Base de Conhecimento";
$lang['search_faqs']="Procurar FAQs";


///////////////////////////////////////////////////////////////////////////////////////
/** [Announcements] *************************************************/
$lang['announcements']="Anúncios";


///////////////////////////////////////////////////////////////////////////////////////
/** [Tickets] *******************************************************/
$lang['text_ticket_categories']="A ordem das Categorias das Ocorrências é usada para propósitos de ordenação.";
$lang['new_category']="Nova Categoria";

$lang['text_ticket_priorities']="A ordem das Prioridades das Ocorrências é usada para propósitos de ordenação. Quanto mais baixa a ordem, mais alta a prioridade.";
$lang['new_priority']="Prioridade Nova";

$lang['text_ticket_status']="A ordem dos Estados das Ocorrências é usada para propósitos de ordenação. Certifique-se que os <strong>ocorrências encerradas têm a ordem mais alta</strong>.";
$lang['new_status']="Novo Estado";

$lang['text_ticket_platform']="A ordem das Plataformas das Ocorrências é usada para propósitos de ordenação.";
$lang['new_platform']="Nova Plataforma";
//-- [Supporter] -----------------------------------------------------
$lang['ticket_created']="Ocorrência criada";
$lang['assigned_to']="Atribuído a";
$lang['text_take_a_look']="Por favor dê uma olhada nisto";
$lang['ticket']="Ocorrência";
$lang['text_created_assigned']="criado e atribuido a si";
$lang['update_ticket']="Atualizar Ocorrência";
$lang['ticket_information']="Informação da Ocorrência";
$lang['ticket_id']="ID da Ocorrência";
$lang['company']="Escritório";
$lang['companies']="Escritórios";
$lang['date_created']="Data de Criação";
$lang['track_time']="Registo Horário";
$lang['files']="Arquivos";
$lang['history']="Histórico";
$lang['transferred_to_'] = "Transferido para ";
$lang['please_take_over'] = "Por favor encarregue-se desta ocorrência.";
$lang['ticket_reassigned'] = "Bilhete XXX re-atribuído a si."; // DO NOT TRANSLATE XXX
$lang['_contact_changed_to'] = " Contato alterado para XXX."; // DO NOT TRANSLATE XXX
$lang['_priority_changed_to'] = " Prioridade alterada para XXX."; // DO NOT TRANSLATE XXX
$lang['_status_changed_to'] = " Estado alterado para XXX."; // DO NOT TRANSLATE XXX
$lang['email_sent'] = "E-mail Enviado";
$lang['ticket_history_log'] = "Histórico da Ocorrência - Ocorrência Nr.: ";
$lang['reverse'] = "Inverter";


$lang['my_tickets']="Minhas Ocorrências";
$lang['contact_tickets']="Ocorrências do Contato";
$lang['company_tickets']="Ocorrências do Escritório";
$lang['all_tickets']="Todas as Ocorrências";
$lang['updated']="Atualizada";
$lang['text_ticket_search']="Insira um texto sobre a ocorrência de que esteja à procura.";
$lang['keyword']="Palavra Chave";
$lang['number']="Número";
$lang['search']="Procurar";
$lang['created']="Criado";
$lang['text_search_results1']="Resultados da procura: ";
$lang['text_search_results2']="registros";

$lang['text_num_mins_worked']="Insira o tempo gasto - em minutos - que trabalhou para cada ocorrência que quiser atualizar.";

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
$lang['q_are_you_sure']="Tem certeza?";
$lang['text_warning_del_supporter']="Atenção: Remover um técnico não é aconselhável.<br/>Se houver ocorrências associadas com o técnico o estado delas pode ficar inconsistente.";

$lang['last_name']="Último Nome";
$lang['ticket_statistics']="Estatísticas das Ocorrências";
$lang['supporter_id']="ID do Técnico";
$lang['name']="Nome";
$lang['phone']="Telefone";
$lang['email']="E-mail";
$lang['groups']="Grupos";

$lang['supporters']="Técnicos";

$lang['enter_supporter_info']="Insirir Informação do Técnico";
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
$lang['edit_supporter_info']="Alterar Informação do Técnico";
$lang['first_name']="Primeiro Nome";
$lang['password_again']="Repita a Senha";
$lang['email_address']="Endereço de E-mail";
$lang['text_leave_blank']="deixar em branco se não mudar";


///////////////////////////////////////////////////////////////////////////////////////
/** [Error and Success Messages] ************************************/
$lang['err_missing_info']="Faltam informações... por favor volte, insira o que falta e tente outra vez.";
$lang['err_user_exists']="Já existe alguém com esse nome de técnico!";
$lang['err_password_mismatch']="As senhas não são iguais.";
$lang['err_group_exists']="Já existe um grupo com esse nome!";
$lang['err_company_exists']="Já existe um escritório com esse nome!";

$lang['msg_supporter_updated']="Informação do Técnico atualizada com sucesso.";
$lang['msg_added_successfully']="adicionado com sucesso";
$lang['msg_updated_successfully']="atualizado com sucesso";
$lang['msg_created_successfully']="criado com sucesso";
$lang['msg_deleted_successfully']="removido com sucesso";


///////////////////////////////////////////////////////////////////////////////////////
/** [Statistics] ****************************************************/
$lang['ticket_time_sheets']="Registos Horários";
$lang['time_sheet_for']="Registos Horários para ";
$lang['my_time_sheet']="Meus Registos Horários";

$lang['ticket_id']="ID da Ocorrência";
$lang['title']="Título";
$lang['status']="Estado";
$lang['hours_worked']="Horas Gastas";
$lang['minutes_worked']="Minutos Gastos";

$lang['ticket_statistics']="Estatísticas das Ocorrências";
$lang['ticket_statistics_for']="Estatísticas das Ocorrências para ";
$lang['case']="Case";
$lang['open']="Aberta";
$lang['closed']="Encerrada";
$lang['total']="Total";
$lang['priorities']="Prioridades";
$lang['categories']="Categorias";
$lang['last_updated']="Última Atualização";

$lang['opened_during']="Abertos Durante";
$lang['closed_during']="Encerrados Durante";
$lang['ticket_pipeline']="Ocorrências por Estado";
$lang['avg_ticket_lifetime_weeks']="Vida Média das Ocorrências em Semanas";
$lang['less_1']="Menos de Uma";
$lang['1_2']="Uma a Duas";
$lang['2_3']="Duas a Três";
$lang['3_4']="Três a Quatro";
$lang['more_4']="Mais de Quatro";

////////////////////////////////////////////////////////////////////////////////
/** [Time Sheets] ****************************************************/
$lang['track_time_ticket_id'] = "Registo de Tempos - Ocorrência Nr.: ";

////////////////////////////////////////////////////////////////////////////////
/** [Files] ****************************************************/
$lang['files_ticket_id'] = "Arquivos - Ocorrência Nr.: ";
$lang['add_file'] = "Adicionar Arquivo";
$lang['ticket_detail'] = "OcorrÊncia";
$lang['file'] = "Arquivo";
$lang['upload'] = "Carregar";
$lang['no_files'] = "Não há arquivos associados a esta Ocorrência.";
$lang['posted_by'] = "Arquivado a XXX por YYY."; // DO NOT TRANSLATE XXX AND YYY


///////////////////////////////////////////////////////////////////////////////////////
/** [Groups] ********************************************************/
$lang['group_id']="Nr. do Grupo";
$lang['text_warning_del_group']="Atenção: Remover um grupo não remove os técnicos que pertencem ao grupo.<br/>Mas não é aconselhável se houver bilhetes associados com os técnicos deste grupo.";

$lang['group_name']="Nome do Grupo";
$lang['edit_group_info']="Alterar Informação do Grupo";
$lang['choose_supporters']="Escolha de Técnicos";

$lang['enter_group_info']="Insira Informação do Grupo";

// [In common.php]
$lang['group_info']="Informação do Grupo";


///////////////////////////////////////////////////////////////////////////////////////
/** [FAQs] **********************************************************/
$lang['faqs']="FAQs";
$lang['question']="Pergunta";
$lang['category']="Categoria";
$lang['new_category']="Nova Categoria";
$lang['compose_faq']="Compor FAQ";
$lang['answer']="Resposta";
$lang['add_faq']="Adicionar FAQ";
$lang['faq_detail']="Detalhe da FAQ";
$lang['faq_id']="ID da PMF";
$lang['edit_faq']="Alterar FAQ";
$lang['faq_search']="Procurar FAQ";
$lang['text_enter_keyword']="Insira uma palavra chave";


///////////////////////////////////////////////////////////////////////////////////////
/** [Control] *******************************************************/
$lang['control_panel']="Painel de Controle";
$lang['setting']="Parâmetro";
$lang['value']="Valor";
$lang['helpdesk_name']="Nome do Helpdesk";
$lang['administrator_email']="E-mail do Administrador";
$lang['helpdesk_on-off']="Helpdesk Aberto/Fechado";
$lang['reason_helpdesk_off']="Se o helpdesk estiver fechado, por favor insira uma explicação";
$lang['num_supporters_per_page']="Número de Técnicos/Contatos por página";
$lang['num_groups_per_page']="Número de Grupos/Escritórios por página";
$lang['num_tickets_per_page']="Número de Ocorrências por página";
$lang['num_announcements_to_list']="Número de Anúncios visíveis";
$lang['time_tracking_status']="Monitoração dos Tempos";
$lang['products_options_status']="Utilização dos Produtos";
$lang['smtp_status']="Uso de E-mail";
$lang['who_online_status']="Quem está Online";
$lang['system_statistics']="Estatísticas das Ocorrências";
$lang['submit_changes']="Enviar Alterações";
$lang['automatic_mail_notification']="Notificação Automática por E-mail dos Técnicos";


///////////////////////////////////////////////////////////////////////////////////////
/** [Contact] *******************************************************/
$lang['contact_id']="ID do Contato";
$lang['group']="Grupo";
$lang['client']="Contato";
$lang['contact']="Contato";
$lang['priority']="Prioridade";
$lang['platform']="Platforma";
$lang['description']="Descrição";
$lang['version']="Versão";
$lang['product_id']="ID do Produto";
$lang['ticket_modules']="Módulos";
$lang['email_contact']="E-mail do Contato";
$lang['time_spent']="Tempo Gasto";
$lang['text_minutes_spent']="minutos gastos na ocorrência desde a última atualização";
//-- [Supporter] -----------------------------------------------------
$lang['contact_info']="Informação do Contato";
$lang['view_tickets']="Ver Ocorrências";
$lang['edit_contact_info']="Alterar Informação do Contato";
$lang['msg_warning_del_contact']="Atenção: Remover um contato não é aconselhavel.<br/>Se houver ocorrências associadas a este contato eles podem ficar inconsistentes.";
//$lang['contact_search']="Procure Contacto";
$lang['text_contact_search']="Insira qualquer informação sobre um contato em particular que esteja a procurando.";
$lang['enter_contact_info']="Insira Informação do Contato";


///////////////////////////////////////////////////////////////////////////////////////
/** [Company] *******************************************************/
$lang['enter_company_info']="Insira Informação do Escritório";
$lang['company_name']="Nome do Escritório";
$lang['address']="Endereço";
$lang['add_company']="Adicionar Escritório";
$lang['company_id']="ID do Escritório";
$lang['main_contact']="Contato Principal";
$lang['company_info']="Informação do Escritório";
$lang['contacts']="Contatos";

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
$lang['step_one_text'] = "O sistema está pronto para instalar o software de helpdesk. <br>Clique <b>NEXT</b> para criar as tabelas do banco de dados."; // DO NOT TRANSLATE NEXT
$lang['step_two'] = "Segundo Passo: Conta do Administrador";
$lang['company_comments'] = "Commentários do Escritório";
$lang['required_field'] = "Campo Obrigatório";
$lang['press_back_button'] = "Por favor clique no botão Back do browser para corrigir o problema.";
$lang['step_three'] = "Terceiro Passo: Configurar";
$lang['step_three_text'] = "Você instalou o software de helpdesk e criou a conta do Administrador.<br>Agora deve fazer LOGIN e configurar as opções das ocorrências."; // DO NOT TRANSLATE LOGIN
$lang['install_error'] = "A informação XXX não está presente ou é incorreta."; // DO NOT TRANSLATE XXX

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
$lang['open'] = "Aberta";
$lang['in_progress'] = "Em Progresso";
$lang['waiting_for_response'] = "Esperando por resposta";
$lang['closed'] = "Encerrada";

//insert default contact for inactive contacts company
$lang['defaultcontact'] = "Este contato não pode ser alterado!";
//insert inactive contacts company
$lang['inactivecontacts'] = "Este escritório não pode ser alterado!";
$lang['inactivecontactsaddress'] = "Este escritório virtual serve como depósito de contatos que não estão associados com nenhum escritório.";
//insert welcome message in the announcements table
$lang['welcome'] = "Bem-vindo! Obrigado por ter instalado MyHelpdesk! Visite <a href=http://www.sourceforge.net/projects/myhelpdesk/>MyHelpdesk</a> no site da SourceForge se tiver alguma pergunta.";

?>