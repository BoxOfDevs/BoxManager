<?PHP 
 require_once("fg_membersite.php"); 
  
 $fgmembersite = new FGMembersite(); 
  
 //Site name 
 $fgmembersite->SetWebsiteName('boxofdevs.x10host.com'); 
  
 //Provide the admin email (notifications) 
 $fgmembersite->SetAdminEmail('contact@boxofdevs.ml'); 
  
 //Provide your database login details here: 
 //hostname, user name, password, database name and table name 
 //note that the script will create the table (for example, resource in this case) 
 //by itself on submitting register.php for the first time 
 $fgmembersite->InitDB(/*hostname*/'localhost', 
                       /*username*/'user', 
                       /*password*/'pass', 
                       /*database name*/'dbname', 
                       /*table name*/'resource'); 
  
  
 $fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr'); 
  
 ?> 
