<?php
include("config.php");
include("user_function.php");

if(isset($_POST["q"])){
    if($_POST["q"]!="")
    {
        $key=$_POST["q"];
         $sql="SELECT * FROM blood_donor WHERE NAME LIKE '%".$key."%' OR FATHER_NAME LIKE '%".$key."%' OR GENDER LIKE '%".$key."%' OR BLOOD LIKE '%".$key."%' OR BODY_WEIGHT LIKE '%".$key."%' OR EMAIL LIKE '%".$key."%' OR ADDRESS LIKE '%".$key."%' OR AREA LIKE '%".$key."%' OR CITY LIKE '%".$key."%' OR PINCODE LIKE '%".$key."%' OR STATE LIKE '%".$key."%' OR conTACT_1 LIKE '%".$key."%' OR conTACT_2 LIKE '%".$key."%' OR VOLUNTARY LIKE '%".$key."%' OR VOLUNTARY_GROUP LIKE '%".$key."%'";
        load_donor($sql,$conn);

    }
    else if($_POST["q"]=="")
    {
        $sql="Select * from blood_donor";
                    load_donor($sql,$conn);
    }
}

if(isset($_POST['c'])){
    if($_POST["c"]!="")
    {
        $key=$_POST["c"];
         $sql="SELECT * FROM campaign WHERE camp_name LIKE '%".$key."%' OR camp_org_name LIKE '%".$key."%' OR camp_address LIKE '%".$key."%' OR camp_area LIKE '%".$key."%' OR camp_city LIKE '%".$key."%' OR camp_org_number LIKE '%".$key."%' OR camp_date LIKE '%".$key."%' OR camp_time LIKE '%".$key."%' OR camp_desc LIKE '%".$key."%'";
        load_campaign($sql,$conn);

    }
    else if($_POST["c"]=="")
    {
        $sql="Select * from campaign";
                    load_campaign($sql,$conn);
    }
}
if(isset($_POST['b'])){
    if($_POST["b"]!="")
    {
        $key=$_POST["b"];
         $sql="SELECT * FROM blood_stock WHERE donor_name LIKE '%".$key."%' OR blood_type LIKE '%".$key."%' OR quantity LIKE '%".$key."%' OR blood_campaign LIKE '%".$key."%' OR date LIKE '%".$key."%'";
        load_blood($sql,$conn);

    }
    else if($_POST["b"]=="")
    {
        $sql="Select * from blood_stock";
                    load_blood($sql,$conn);
    }
}


?>
