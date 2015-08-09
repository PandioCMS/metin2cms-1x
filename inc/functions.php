<?PHP

  function calcPages($gesEin,$aktSeite,$eSeite) {
    $output = array();
    $esQuote = ceil(($gesEin/$eSeite));
    if($aktSeite==0) {$aktSeite=1;}
    $startS = ($aktSeite*$eSeite)-$eSeite;
    $output[0]=$esQuote;
    $output[1]=$startS;
    return $output;
  }
  
  function checkAnum($wert) {
    $checkit = preg_match("/^[a-zA-Z0-9]+$/",$wert);
    if($checkit) {
      return true;
    }
    else {
      return false;
    }
  }
  
  function checkIP($wert) {
    $checkit = preg_match("/^[0-9\*]{1,3}+\.[0-9\*]{1,3}+\.[0-9\*]{1,3}+\.[0-9\*]{1,3}+$/",$wert);
    if($checkit) {
      return true;
    }
    else {
      return false;
    }
  }
  
  function checkMail($string) {
    if(preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\.-]+\.[a-zA-Z]{2,4}$/", $string)) {
      return true;
    }
    else { return false; }
  }
  
  function checkInt($wert) {
    $checkit = preg_match("/^[0-9]+$/",$wert);
    if($checkit) {
      return true;
    }
    else {
      return false;
    }
  }
?>