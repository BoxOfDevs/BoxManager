<?PHP 
 require_once("fg_membersite.php"); 
  
 $fgmembersite = new FGMembersite(); 
  
 //Site name 
 $fgmembersite->SetWebsiteName(json_decode(file_get_contents("../configs/config.json"),true)["Site name"]); 
  
 //Provide the admin email (notifications) 
 $fgmembersite->SetAdminEmail('contact@boxofdevs.com'); 
  
 //Provide your database login details here: 
 //hostname, user name, password, database name and table name 
 //note that the script will create the table (for example, resource in this case) 
 //by itself on submitting register.php for the first time 
 $fgmembersite->InitDB(/*hostname*/json_decode(file_get_contents("../configs/config.json"),true)["Database address"], 
                       /*username*/json_decode(file_get_contents("../configs/config.json"),true)["Database admin username"], 
                       /*password*/json_decode(file_get_contents("../configs/config.json"),true)["Database admin password"], 
                       /*database name*/json_decode(file_get_contents("../configs/config.json"),true)["Database name"], 
                       /*table name*/'resource'); 
  
  
 $fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr'); 
  
 ?> 
