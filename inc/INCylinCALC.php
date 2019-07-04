<?php
$firCountry = $_POST['firCountry'];$secCountry = $_POST['secCountry'];$startYear = (int)$_POST[startYear];
//2386 = infant mortality rate //infant survival rate=3269
include 'INCongo.php';$a1=(int)$_POST[dn1];$b1=(int)$_POST[dn2];$c1=(int)$_POST[dn3];$d1=(int)$_POST[dn4];$e1=(int)$_POST[dn5];$f1=(int)$_POST[dn6];
//START FIRST CHART AND TABLE CALCULATIONS
for ($x = 1; $x <= 6; $x++) {
    if($x==1){$let="a";}if($x==2){$let="b";}if($x==3){$let="c";}if($x==4){$let="d";}if($x==5){$let="e";}if($x==6){$let="f";}
    ${$let."END"} = $db->data_records->find(array('dataset_id' => ${$let."1"},'country' => $firCountry));
    ${$let."END"}->sort(array('year' => -1));
    ${$let."STA"} = $db->data_records->find(array('dataset_id' => ${$let."1"},'country' => $firCountry));
    ${$let."STA"}->sort(array('year' => 1));
    foreach(${$let."STA"} as $a){
        if($a["year"]<$startYear){
            $aonothing=1;
        } else if($a["year"]==$startYear){
            ${$let."StartYear"} = $a["year"];
            ${$let."StartVal"} = $a["value"];
            break;
        } else if($a["year"]>$startYear){
            ${$let."StartYear"} = $a["year"];
            ${$let."StartVal"} = $a["value"];
            break;            
        }
    }
    foreach(${$let."END"} as $a){${$let."EndYear"} = $a["year"];${$let."EndVal"} = $a["value"];break;}

    if($let=="f"){
        ${$let."In"} = round(((((${$let."EndVal"}+11)-(${$let."StartVal"}+11))/(${$let."StartVal"}+11))*100),0);
    } else if($let=="b"){
        ${$let."In"} = round((((${$let."EndVal"}-${$let."StartVal"})/${$let."StartVal"})*100),0)*-1;
    } else{
        ${$let."In"} = round((((${$let."EndVal"}-${$let."StartVal"})/${$let."StartVal"})*100),0);
    }
    
    ${$let."StartVal"} = round(${$let."StartVal"},1);
    ${$let."EndVal"} = round(${$let."EndVal"},1);
}
//END FIRST CHART AND TABLE CALCULATIONS

//START SECOND CHART AND TABLE CALCULATIONS
for ($x = 1; $x <= 6; $x++) {
    if($x==1){$let="a";}if($x==2){$let="b";}if($x==3){$let="c";}if($x==4){$let="d";}if($x==5){$let="e";}if($x==6){$let="f";}
    ${$let."END"} = $db->data_records->find(array('dataset_id' => ${$let."1"},'country' => $secCountry));
    ${$let."END"}->sort(array('year' => -1));
    ${$let."STA"} = $db->data_records->find(array('dataset_id' => ${$let."1"},'country' => $secCountry));
    ${$let."STA"}->sort(array('year' => 1));
    foreach(${$let."STA"} as $a){
        if($a["year"]<$startYear){
            $aonothing=1;
        } else if($a["year"]==$startYear){
            ${$let."DosStartYear"} = $a["year"];
            break;
        } else if($a["year"]>$startYear){
            ${$let."DosStartYear"} = $a["year"];
            break;            
        }
    }
    foreach(${$let."END"} as $a){${$let."DosEndYear"} = $a["year"];break;}
    
    //if((${$let."DosStartYear"}<${$let."StartYear"})||(${$let."StartYear"}==null)){
    if((${$let."DosStartYear"}>${$let."StartYear"})){
        ${$let."FinStartYear"}=${$let."DosStartYear"};
    }else{${$let."FinStartYear"}=${$let."StartYear"};}
    //if(${$let."DosEndYear"}<${$let."EndYear"}||(${$let."EndYear"}==null)){

    if((${$let."EndYear"}==null)){
        ${$let."FinEndYear"}=${$let."DosEndYear"};
    } else if((${$let."DosEndYear"}==null)){
        ${$let."FinEndYear"}=${$let."EndYear"};
    } else if(${$let."DosEndYear"}<${$let."EndYear"}){
        ${$let."FinEndYear"}=${$let."DosEndYear"};
    }else{${$let."FinEndYear"}=${$let."EndYear"};}
}



for ($x = 1; $x <= 6; $x++) {
    if($x==1){$let="a";}if($x==2){$let="b";}if($x==3){$let="c";}if($x==4){$let="d";}if($x==5){$let="e";}if($x==6){$let="f";}
    ${$let."unoSTA"} = $db->data_records->find(array('year' => ${$let."FinStartYear"},'dataset_id' => ${$let."1"},'country' => $firCountry));
    ${$let."unoEND"} = $db->data_records->find(array('year' => ${$let."FinEndYear"},'dataset_id' => ${$let."1"},'country' => $firCountry));
    ${$let."dosEND"} = $db->data_records->find(array('year' => ${$let."FinEndYear"},'dataset_id' => ${$let."1"},'country' => $secCountry));
    ${$let."dosSTA"} = $db->data_records->find(array('year' => ${$let."FinStartYear"},'dataset_id' => ${$let."1"},'country' => $secCountry));

    foreach(${$let."unoSTA"} as $a){
        ${$let."UnoStartVal"} = $a["value"];
    }
    foreach(${$let."unoEND"} as $a){
        ${$let."UnoEndVal"} = $a["value"];
    }
    foreach(${$let."dosSTA"} as $a){
        ${$let."DosStartVal"} = $a["value"];
    }
    foreach(${$let."dosEND"} as $a){
        ${$let."DosEndVal"} = $a["value"];
    }   
    
    if($let=="f"){
        ${$let."UnoIn"} = round(((((${$let."UnoEndVal"}+11)-(${$let."UnoStartVal"}+11))/(${$let."UnoStartVal"}+11))*100),0);
    }else if($let=="b"){
        ${$let."UnoIn"} = round((((${$let."UnoEndVal"}-${$let."UnoStartVal"})/${$let."UnoStartVal"})*100),0)*-1;
    }else{
        ${$let."UnoIn"} = round((((${$let."UnoEndVal"}-${$let."UnoStartVal"})/${$let."UnoStartVal"})*100),0);
    }
    ${$let."UnoStartVal"} = round(${$let."UnoStartVal"},1);
    ${$let."UnoEndVal"} = round(${$let."UnoEndVal"},1);

    if($let=="f"){
        ${$let."DosIn"} = round(((((${$let."DosEndVal"}+11)-(${$let."DosStartVal"}+11))/(${$let."DosStartVal"}+11))*100),0);
    }else if($let=="b"){
        ${$let."DosIn"} = round((((${$let."DosEndVal"}-${$let."DosStartVal"})/${$let."DosStartVal"})*100),0)*-1;
    }else{
        ${$let."DosIn"} = round((((${$let."DosEndVal"}-${$let."DosStartVal"})/${$let."DosStartVal"})*100),0);
    }
    ${$let."DosStartVal"} = round(${$let."DosStartVal"},1);
    ${$let."DosEndVal"} = round(${$let."DosEndVal"},1);
}
    
$sixes = array($aIn,$bIn,$cIn,$dIn,$eIn,$fIn,                                                                        //  0-5=%improvement first  
               $aStartYear,$bStartYear,$cStartYear,$dStartYear,$eStartYear,$fStartYear,                              // 6-11=start year first 
               $aEndYear,$bEndYear,$cEndYear,$dEndYear,$eEndYear,$fEndYear,                                          //12-17=end year first   
               $aStartVal,$bStartVal,$cStartVal,$dStartVal,$eStartVal,$fStartVal,                                    //18-23=start val first 
               $aEndVal,$bEndVal,$cEndVal,$dEndVal,$eEndVal,$fEndVal,                                                //24-29=end val first 
               $aFinStartYear,$bFinStartYear,$cFinStartYear,$dFinStartYear,$eFinStartYear,$fFinStartYear,            //30-35=start year uno/dos 
               $aFinEndYear,$bFinEndYear,$cFinEndYear,$dFinEndYear,$eFinEndYear,$fFinEndYear,                        //36-41=end year uno/dos 
               $aUnoStartVal,$bUnoStartVal,$cUnoStartVal,$dUnoStartVal,$eUnoStartVal,$fUnoStartVal,                  //42-47=start val uno
               $aUnoEndVal,$bUnoEndVal,$cUnoEndVal,$dUnoEndVal,$eUnoEndVal,$fUnoEndVal,                              //48-53=end val uno
               $aDosStartVal,$bDosStartVal,$cDosStartVal,$dDosStartVal,$eDosStartVal,$fDosStartVal,                  //54-59=start val dos
               $aDosEndVal,$bDosEndVal,$cDosEndVal,$dDosEndVal,$eDosEndVal,$fDosEndVal,                              //60-65=end val dos
               $aUnoIn,$bUnoIn,$cUnoIn,$dUnoIn,$eUnoIn,$fUnoIn,                                                      //66-71=%improvement uno
               $aDosIn,$bDosIn,$cDosIn,$dDosIn,$eDosIn,$fDosIn,                                                      //72-77=%improvement dos
               $aDosStartYear,$bDosStartYear,$cDosStartYear,$dDosStartYear,$eDosStartYear,$fDosStartYear);           //78-83=start year second
echo json_encode($sixes);
?>
