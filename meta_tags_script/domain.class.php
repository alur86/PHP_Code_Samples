<?php
class domain{
var $domain="";
var $servers=array(
array("com","whois.geektools.com","No match"),
        array("net","whois.geektools.com","No match"),
                array("org","whois.geektools.com","No match"),
);



var $idn=array(224,225,226,227,228,229,230,231,232,233,234,235,240,236,237,238,239,241,242,243,244,245,246,248,254,249,250,251,252,253,255);
//      var $idn=array("00E0","00E1","00E2","00E3","00E4","00E5","0101","0103","0105","00E6","00E7","0107","0109","010B","010D","010F","0111","00E8","00E9","00EA","00EB","0113","0115","0117","0119","011B","014B","00F0","011D","011F","0121","0123","0125","0127","00EC","00ED","00EE","00EF","0129","012B","012D","012F","0131","0135","0137","0138","013A","013C","013E","0142","00F1","0144","0146","0148","00F2","00F3","00F4","00F5","00F6","00F8","014D","014F","0151","0153","0155","0157","0159","015B","015D","015F","0161","0163","0165","0167","00FE","00F9","00FA","00FB","00FC","0169","016B","016D","016F","0171","0173","0175","00FD","00FF","0177","017A","017C","017E");

function domain($str_domainname){
        $this->domain=$str_domainname;
}

function info(){
        if($this->is_valid()){

                $tldname=$this->get_tld();
                $domainname=$this->get_domain();
                $whois_server=$this->get_whois_server();

                if($whois_server!=""){
                        $fp = fsockopen($whois_server,43);

                        $dom=$domainname.".".$tldname;
//                      fputs($fp, "$dom\r\n");

                        // New IDN
                        if($tldname=="de") {
                                fputs($fp, "-C ISO-8859-1 -T dn $dom\r\n");
                        } else {
                                fputs($fp, "$dom\r\n");
                        }

                        // Getting string
                        $string="";

                        // Checking whois server for .com and .net
                        if($tldname=="com" || $tldname=="net" || $tldname=="edu"){
                                while(!feof($fp)){
                                        $line=trim(fgets($fp,128));

                                        $string.=$line;

                                        $lineArr=split(":",$line);

                                        if(strtolower($lineArr[0])=="whois server"){
                                                $whois_server=trim($lineArr[1]);
                                        }
                                }
                                // Getting whois information
                                $fp = fsockopen($whois_server,43);

                                $dom=$domainname.".".$tldname;
                                fputs($fp, "$dom\r\n");

                                // Getting string
                                $string="";

                                while(!feof($fp)){
                                        $string.=fgets($fp,128);
                                }

                                // Checking for other tld's
                        }else{
                                while(!feof($fp)){
                                        $string.=fgets($fp,128);
                                }
                        }
                        fclose($fp);

                        return $string;
                }else{
                        return "No whois server for this tld in list!";
                }
        }else{
                return "Domainname isn't valid!";
        }
}

/**
* Returns the whois data of the domain in HTML format
* @return string $whoisdata Whois data as string in HTML
* @desc Returns the whois data of the domain  in HTML format
*/
function html_info(){
        return nl2br($this->info());
}

/**
* Returns name of the whois server of the tld
* @return string $server the whois servers hostname
* @desc Returns name of the whois server of the tld
*/
function get_whois_server(){
        $found=false;
        $tldname=$this->get_tld();
        for($i=0;$i<count($this->servers);$i++){
                if($this->servers[$i][0]==$tldname){
                        $server=$this->servers[$i][1];
                        $full_dom=$this->servers[$i][3];
                        $found=true;
                }
        }
        return $server;
}

/**
* Returns the tld of the domain without domain name
* @return string $tldname the tlds name without domain name
* @desc Returns the tld of the domain without domain name
*/
function get_tld(){
        // Splitting domainname
        $domain=split("\.",$this->domain);
        if(count($domain)>2){
                $domainname=$domain[0];
                for($i=1;$i<count($domain);$i++){
                        if($i==1){
                                $tldname=$domain[$i];
                        }else{
                                $tldname.=".".$domain[$i];
                        }
                }
        }else{
                $domainname=$domain[0];
                $tldname=$domain[1];
        }
        return $tldname;
}


/**
* Returns all tlds which are supported by the class
* @return array $tlds all tlds as array
* @desc Returns all tlds which are supported by the class
*/
function get_tlds(){
        $tlds="";
        for($i=0;$i<count($this->servers);$i++){
                $tlds[$i]=$this->servers[$i][0];
        }
        return $tlds;
}

/**
* Returns the name of the domain without tld
* @return string $domain the domains name without tld name
* @desc Returns the name of the domain without tld
*/
function get_domain(){
        // Splitting domainname
        $domain=split("\.",$this->domain);
        return $domain[0];
}

/**
* Returns the full domain
* @return string $fulldomain
* @desc Returns the full domain
*/
function get_fulldomain(){
        return $this->domain;
}

/**
* Returns the string which will be returned by the whois server of the tld if a domain is avalable
* @return string $notfound  the string which will be returned by the whois server of the tld if a domain is avalable
* @desc Returns the string which will be returned by the whois server of the tld if a domain is avalable
*/
function get_notfound_string(){
        $found=false;
        $tldname=$this->get_tld();
        for($i=0;$i<count($this->servers);$i++){
                if($this->servers[$i][0]==$tldname){
                        $notfound=$this->servers[$i][2];
                }
        }
        return $notfound;
}

/**
* Returns if the domain is available for registering
* @return boolean $is_available Returns 1 if domain is available and 0 if domain isn't available
* @desc Returns if the domain is available for registering
*/
function is_available(){
        $whois_string=$this->info(); // Gets the entire WHOIS query from registrar
        $not_found_string=$this->get_notfound_string(); // Gets 3rd item from array
        $domain=$this->domain; // Gets current domain being queried

        $whois_string2=@ereg_replace("$domain","",$whois_string);

        $whois_string =@preg_replace("/\s+/"," ",$whois_string); //Replace whitespace with single space

        $array=split(":",$not_found_string);

        if($array[0]=="MAXCHARS"){
                if(strlen($whois_string2)<=$array[1]){
                        return true;
                }else{
                        return false;
                }
        }else{
                if(preg_match("/".$not_found_string."/i",$whois_string)){
                        return true;
                }else{
                        return false;
                }
        }
}

function get_cn_server($whois_text){

}


/**
* Returns if the domain name is valid
* @return boolean $is_valid Returns 1 if domain is valid and 0 if domain isn't valid
* @desc Returns if the domain name is valid
*/
function is_valid(){

        $domainArr=split("\.",$this->domain);

        // If it's a tld with two Strings (like co.uk)
        if(count($domainArr)==3){

                $tld=$domainArr[1].".".$domainArr[2];
                $found=false;

                for($i=0;$i<count($this->servers) && $found==false;$i++){
                        if($this->servers[$i][0]==$tld){
                                $found=true;
                        }
                }
                if(!$found){
                        return false;
                }

        }else if(count($domainArr)>3){
                return false;
        }

        // Creating regular expression for
        if($this->get_tld()=="de"){
                for($i=0;$i<count($this->idn);$i++){
                        $idn.=chr($this->idn[$i]);
                        // $idn.="\x".$this->idn[$i]."";
                }
                $pattern="^[a-z".$idn."0-9\-]{3,}$";
        }else{
                $pattern="^[a-z0-9\-]{3,}$";
        }

        if(ereg($pattern,strtolower($this->get_domain())) && !ereg("^-|-$",strtolower($this->get_domain())) && !preg_match("/--/",strtolower($this->get_domain()))){
                return true;
        }else{
                return false;
        }
}
}
?>

