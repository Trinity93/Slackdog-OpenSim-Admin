<?php
/*******************************************************************************
**	file: language.php
********************************************************************************
**	author:	Sergio Arias
**	date:	12/12/2003
********************************************************************************
**	$Revision: 1.12 $ on $Date: 2004/02/12 04:35:05 $ by $Author: lmpmbernardo $
*******************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////
/** [Common] ********************************************************/
$lang['submit']="Submit";
$lang['add']="Add";
$lang['update']="Update";
$lang['cancel']="Cancel";
$lang['delete']="Delete";
$lang['edit']="Edit";
$lang['modify']="Modify";
$lang['refresh']="Refresh";
$lang['reset']="Reset";
$lang['id'] = "ID";

$lang['rank']="Rank";
$lang['there_are']="There are";
$lang['sort_by']="Sort By";
$lang['previous']="Previous";
$lang['next']="Next";
$lang['detail']="Detail";

$lang['success']="Success";
$lang['all']="All";
$lang['from']="From";
$lang['to']="To";

$lang['more_detail']="More Detail";
$lang['less_detail']="Less Detail";

$lang['unknown']="unknown";


//////////////////////////////////////////////////////////////////////
/** [Login] *********************************************************/
$lang['login']="Login";
$lang['user_name']="User Name";
$lang['password']="Password";
$lang['lang']="Language";
$lang['login_to']="Login to";

$lang['err_login_failed']="Login Failed";
$lang['err_username_incorrect']="Your username and/or password was incorrect.";



///////////////////////////////////////////////////////////////////////////////////////
/** [Index] *********************************************************/
/** [Left Menu] *****************************************************/
$lang['administration']="Administration";
$lang['support']="Support";
$lang['text_who_online']="Who's online";
$lang['home']="Home";
$lang['logout']="Logout";
$lang['settings']="Settings";

// Ticket Options
$lang['ticket_options']="Ticket Options";
$lang['ticket_categories']="Ticket Categories";
$lang['ticket_priorities']="Ticket Priorities";
$lang['ticket_status']="Ticket Status";
$lang['ticket_platforms']="Ticket Platforms";
//-- Supporter -----------------------------------------------------
$lang['ticket_management']="Ticket Management";
$lang['create_ticket']="Create Ticket";
$lang['my_tickets']="My Tickets";
$lang['my_groups_tickets']="My Groups Tickets";
$lang['all_tickets']="All Tickets";
$lang['ticket_search']="Search Tickets";


// Product Options
$lang['product_options']="Product Options";
$lang['product_modules']="Product Modules";
$lang['product_versions']="Product Versions";

// Supporter Management
$lang['supporter_management']="Supporter Management";
$lang['view_supporters']="View Supporters";
$lang['view_groups']="View Groups";
$lang['add_supporter']="Add Supporter";
$lang['add_group']="Add Group";

// FAQs Management
$lang['faqs_management']="FAQs Management";
$lang['view_faqs']="View FAQs";
$lang['add_faq']="Add FAQ";
$lang['faq_categories']="FAQ Categories";

// Ticket Reporting
$lang['ticket_reporting']="Ticket Reporting";
$lang['cumulative_statistics']="Cumulative Statistics";
// not sure about this translation
$lang['pipeline_statistics']="Pipeline Statistics";
$lang['time_sheets']="Time Sheets";

/** [Clients] *******************************************************/
$lang['client_management']="Client Management";
$lang['view_contacts']="View Contacts";
$lang['view_companies']="View Companies";
$lang['contact_search']="Search Contacts";
$lang['add_contact']="Add Contact";
$lang['add_company']="Add Company";

$lang['my_records']="My Records";
$lang['edit_my_profile']="Edit My Profile";
$lang['my_time_sheet']="My Time Sheet";
$lang['my_ticket_statistics']="My Ticket Statistics";

$lang['knowledge_base']="Knowledge Base";
$lang['search_faqs']="Search FAQs";


///////////////////////////////////////////////////////////////////////////////////////
/** [Announcements] *************************************************/
$lang['announcements']="Announcements";


///////////////////////////////////////////////////////////////////////////////////////
/** [Tickets] *******************************************************/
$lang['text_ticket_categories']="Ticket Categories rankings are used for sorting purposes.";
$lang['new_category']="New Category";

$lang['text_ticket_priorities']="Ticket Priorities rankings are used for sorting purposes. The lower the rank, the higher the priority.";
$lang['new_priority']="New Priority";

$lang['text_ticket_status']="Ticket Status rankings are used for sorting purposes. Make sure that <strong>closed tickets have the highest rank</strong>.";
$lang['new_status']="New Status";

$lang['text_ticket_platform']="Ticket Platforms rankings are used for sorting purposes.";
$lang['new_platform']="New Platform";
//-- [Supporter] -----------------------------------------------------
$lang['ticket_created']="Ticket created";
$lang['assigned_to']="Assigned to";
$lang['text_take_a_look']="Please take a look at this";
$lang['ticket']="Ticket";
$lang['text_created_assigned']="created and assigned to you";
$lang['update_ticket']="Update Ticket";
$lang['ticket_information']="Ticket Information";
$lang['ticket_id']="Ticket ID";
$lang['company']="Company";
$lang['companies']="Companies";
$lang['date_created']="Date Created";
$lang['track_time']="Track Time";
$lang['files']="Files";
$lang['history']="History";
$lang['transferred_to_'] = "Transferred to ";
$lang['please_take_over'] = "Please take over this ticket.";
$lang['ticket_reassigned'] = "Ticket XXX re-assigned to you."; // DO NOT TRANSLATE XXX
$lang['_contact_changed_to'] = " Contact changed to XXX."; // DO NOT TRANSLATE XXX
$lang['_priority_changed_to'] = " Priority changed to XXX."; // DO NOT TRANSLATE XXX
$lang['_status_changed_to'] = " Status changed to XXX."; // DO NOT TRANSLATE XXX
$lang['email_sent'] = "E-mail Sent";
$lang['ticket_history_log'] = "Ticket History Log - Ticket ID: ";
$lang['reverse'] = "Reverse";

$lang['my_tickets']="My Tickets";
$lang['contact_tickets']="Contact Tickets";
$lang['company_tickets']="Company Tickets";
$lang['all_tickets']="All Tickets";
$lang['updated']="Updated";
$lang['text_ticket_search']="Enter any of the information about a particular ticket that you are searching for.";
$lang['keyword']="Keyword";
$lang['number']="Number";
$lang['search']="Search";
$lang['created']="Created";

$lang['records_found']="Records found: ";

$lang['text_num_mins_worked']="Enter number of minutes worked for each ticket you want to update.";


///////////////////////////////////////////////////////////////////////////////////////
/** [Modules] *******************************************************/
$lang['new_module']="New Mudule";
$lang['module']="module";
$lang['modules']="modules";

$lang['new_version']="New Version";
$lang['version']="version";
$lang['versions']="versions";


///////////////////////////////////////////////////////////////////////////////////////
/** [Supporters] ****************************************************/
$lang['confirmation']="Confirmation";
$lang['q_are_you_sure']="Are you sure?";
$lang['text_warning_del_supporter']="Warning: Deleting a supporter is not advisable.<br/>If there are tickets assigned to the supporter their state may become inconsistent.";

$lang['last_name']="Last Name";
$lang['ticket_statistics']="Ticket Statistics";
$lang['supporter_id']="Supporter ID";
$lang['name']="Name";
$lang['phone']="Phone";
$lang['email']="E-mail";
$lang['groups']="Groups";

$lang['supporters']="Supporters";

$lang['enter_supporter_info']="Enter Supporter Information";
$lang['administrator']="Administrator";
$lang['supporter']="Supporter";
$lang['add_supporter']="Add Supporter";
$lang['add_to_groups']="Add To Groups";


// [In common.php]
$lang['supporter_info']="Supporter Information";
$lang['fax']="Fax";
$lang['type']="Type";
$lang['comments']="Comments";
$lang['modified_by']="Modified by";
$lang['last_modified']="Last Modified";

//-----------------
$lang['edit_supporter_info']="Edit Supporter Information";
$lang['first_name']="First Name";
$lang['password_again']="Password Again";
$lang['email_address']="Email Address";
$lang['text_leave_blank']="leave blank if not changing";


///////////////////////////////////////////////////////////////////////////////////////
/** [Error and Success Messages] ************************************/
$lang['err_missing_info']="You are missing some information... please press the back button on your browser and try again.";
$lang['err_user_exists']="A person with that user name already exists!";
$lang['err_password_mismatch']="The passwords do not match.";
$lang['err_group_exists']="A group with that name already exists!";
$lang['err_company_exists']="A company with that name already exists!";
$lang['err_email_exists']="A person with that email already exists!";

$lang['msg_supporter_updated']="Supporter information successfully updated.";
$lang['msg_added_successfully']="added successfully";
$lang['msg_updated_successfully']="updated successfully";
$lang['msg_created_successfully']="created successfully";
$lang['msg_deleted_successfully']="successfully deleted";
$lang['msg_profile_updated']="Your profile was updated successfully.";


////////////////////////////////////////////////////////////////////////////////
/** [Statistics] ****************************************************/
$lang['ticket_time_sheets']="Ticket Time Sheets";
$lang['time_sheet_for']="Time Sheet for";
$lang['my_time_sheet']="My Time Sheet";

$lang['ticket_id']="Ticket ID";
$lang['title']="Title";
$lang['status']="Status";
$lang['hours_worked']="Hours Worked";
$lang['minutes_worked']="Minutes Worked";

$lang['ticket_statistics']="Ticket Statistics";
$lang['ticket_statistics_for']="Ticket Statistics for ";
$lang['case']="Case";
$lang['open']="Open";
$lang['closed']="Closed";
$lang['total']="Total";
$lang['priorities']="Priorities";
$lang['categories']="Categories";
$lang['last_updated']="Last Updated";

$lang['opened_during']="Opened During";
$lang['closed_during']="Closed During";
$lang['ticket_pipeline']="Ticket Pipeline";
$lang['avg_ticket_lifetime_weeks']="Average Lifetime of Tickets in Weeks";
$lang['less_1']="Less than One";
$lang['1_2']="One to Two";
$lang['2_3']="Two to Three";
$lang['3_4']="Three to Four";
$lang['more_4']="More than Four";

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
$lang['group_id']="Group ID";
$lang['text_warning_del_group']="Warning: Deleting a group does not delete the supporters that are part of the group.<br/>But it is not advisable if you assigned tickets to supporters of the group.";

$lang['group_name']="Group Name";
$lang['edit_group_info']="Edit Group Information";
$lang['choose_supporters']="Choose Supporters";

$lang['enter_group_info']="Enter Group Information";

// [In common.php]
$lang['group_info']="Group Information";


///////////////////////////////////////////////////////////////////////////////////////
/** [FAQs] **********************************************************/
$lang['faqs']="FAQs";
$lang['question']="Question";
$lang['category']="Category";
$lang['new_category']="New Category";
$lang['compose_faq']="Compose FAQ";
$lang['answer']="Answer";
$lang['add_faq']="Add FAQ";
$lang['faq_detail']="FAQ Detail";
$lang['faq_id']="FAQ ID";
$lang['edit_faq']="Edit FAQ";
$lang['faq_search']="FAQ Search";
$lang['text_enter_keyword']="Enter one keyword";


///////////////////////////////////////////////////////////////////////////////////////
/** [Control] *******************************************************/
$lang['control_panel']="Control Panel";
$lang['setting']="Setting";
$lang['value']="Value";
$lang['helpdesk_name']="Helpdesk name";
$lang['administrator_email']="Administrator E-mail";
$lang['helpdesk_on-off']="Helpdesk On/Off";
$lang['reason_helpdesk_off']="If your helpdesk is off, please enter a reason";
$lang['num_supporters_per_page']="Number of Supporters/Contacts to list per page";
$lang['num_groups_per_page']="Number of Groups/Companies to list per page";
$lang['num_tickets_per_page']="Number of Addresses/Tickets to list per page";
$lang['num_announcements_to_list']="Number of Announcements to list";
$lang['time_tracking_status']="Time Tracking Status";
$lang['products_options_status']="Product Options Status";
$lang['smtp_status']="SMTP Status";
$lang['who_online_status']="Who's online Status";
$lang['system_statistics']="System Statistics";
$lang['submit_changes']="Submit Changes";
$lang['automatic_mail_notification']="Automatic Supporter Email Notification Status";


///////////////////////////////////////////////////////////////////////////////////////
/** [Contact] *******************************************************/
$lang['contact_id']="Contact ID";
$lang['group']="Group";
$lang['client']="Client";
$lang['contact']="Contact";
$lang['priority']="Priority";
$lang['platform']="Platform";
$lang['description']="Description";
$lang['version']="Version";
$lang['product_id']="Product ID";
$lang['ticket_modules']="Modules";
$lang['email_contact']="Email Contact";
$lang['time_spent']="Time Spent";
$lang['text_minutes_spent']="minutes spent working on ticket since last update";
//-- [Supporter] -----------------------------------------------------
$lang['contact_info']="Contact Informaction";
$lang['view_tickets']="View Tickets";
$lang['edit_contact_info']="Edit Contact Informaction";
$lang['msg_warning_del_contact']="Warning: Deleting a contact is not advisable.<br/>If there are tickets associated with this contact their state may become inconsistent.";
$lang['text_contact_search']="Enter any of the information about a particular contact that you are searching for.";
$lang['enter_contact_info']="Enter Contact Information";


////////////////////////////////////////////////////////////////////////////////
/** [Company] *******************************************************/
$lang['enter_company_info']="Enter Company Information";
$lang['company_name']="Company Name";
$lang['address']="Address";
$lang['add_company']="Add Company";
$lang['company_id']="Company ID";
$lang['main_contact']="Main Contact";
$lang['company_info']="Company Information";
$lang['contacts']="Contacts";
$lang['edit_company_info']="Edit Company Information";
$lang['text_warning_del_company']="Warning: Contacts belonging to a company are not deleted but moved to the Inactive Contacts company.<br/>But deleting a company is not advisable.<br/>If there are tickets associated with this company their state may become inconsistent.";

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
$lang['step_one_text'] = "You are now ready to begin the installation of the Slackdog web interface.<br>Click <b>Next</b> to create all of the database tables.";
$lang['step_two'] = "Step Two: Administrator Account Setup";
$lang['company_comments'] = "Company Comments";
$lang['required_field'] = "Required Field";
$lang['press_back_button'] = "Please press the back button on your browser to correct the problem.";
$lang['step_three'] = "Step Three: Finishing Up";
$lang['step_three_text'] = "You have installed the Slackdog web interface software and created an Administrator account.<br>You should now LOGIN and create a ticketing schema."; // DO NOT TRANSLATE LOGIN
$lang['install_error'] = "Your XXX information is either missing or incorrect."; // DO NOT TRANSLATE XXX
$lang['install_admin_text'] = "Please enter your desired Web Interface Administrator details";
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
$lang['welcome'] = "Welcome! Thank you for installing the Slackdog web interface! Visit <a href=http://www.slackdog.com/>Slackdog</a> if you have any question.";

?>