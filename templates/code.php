<?php
include('security.php');

$connection = mysqli_connect("localhost","root","","ats");


if(isset($_POST['registerbtn'])) {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = md5($_POST['password1']);
    $usertype = $_POST['usertype'];

    if($password == $cpassword) {
        $query = "INSERT INTO systemuser (id,username,email,password1,usertype) VALUES ('$id','$username','$email','$password1','$usertype')";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
    {
       
        $_SESSION['success'] =  "Data is Added Successfully";
        header('Location: systemadmin/accountlist.php');
    }
    else 
    {
      
        $_SESSION['status'] =  "Data is Not Added";
        header('Location: systemadmin/accountlist.php');
    }

    }
 
 
    
}

if(isset($_POST['registercustbtn'])) {
    $prefix = $_POST['prefix'];
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $alias = $_POST['alias'];
    $email = $_POST['email'];
    $address1 = $_POST['address1'];
    $phoneno = $_POST['phoneno'];

   

    if($password == $cpassword) {
        $query = "INSERT INTO customer (id,prefix,fullname,alias,email,address1,phoneno) VALUES ('$id','$prefix','$fullname','$alias','$email','$address1','$phoneno')";
        $query_run = mysqli_query($connection, $query);
        

        if($query_run)
    {
       
        $_SESSION['success'] =  "Data is Added Successfully";
        header('Location: traveladvisor/accountlist.php');
    }
    else 
    {
      
        $_SESSION['status'] =  "Data is Not Added";
        header('Location: traveladvisor/accountlist.php');
    }

    }
 
 
    
}

if(isset($_POST['edit_btn_ta'])) {
    $id = $_POST['edit_id_ta'];
    
    $query = "SELECT * FROM customer WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
}


if(isset($_POST['updatebtn_ta']))

{
    $id = $_POST['edit_id_ta'];
    $prefix = $_POST['edit_prefix'];
    $fullname = $_POST['edit_fullname'];
    $alias = $_POST['alias'];
    $email = $_POST['edit_email'];
    $address1 = $_POST['edit_address'];
    $phoneno = $_POST['edit_phoneno'];
    $type = $_POST['edit_type'];

    $query  = "UPDATE customer SET prefix='$prefix', fullname='$fullname',alias = '$alias', email='$email', address1 = '$address1', phoneno = '$phoneno',type = '$type' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Data Updated";
        header('Location: traveladvisor/accountlist.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Updated";
        header('Location: traveladvisor/accountlist.php');
    }
}


if(isset($_POST['delete_btn_ta'])) {
    $id = $_POST['delete_id_ta'];

    $query = "DELETE FROM customer WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Data Deleted";
        header('Location: traveladvisor/accountlist.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Deleted";
        header('Location: traveladvisor/accountlist.php');
    }

}

if(isset($_POST['edit_btn'])) {
    $id = $_POST['edit_id'];
    
    $query = "SELECT * FROM systemuser WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
}


if(isset($_POST['updatebtn']))

{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password1 = md5($_POST['edit_password']);
    $usertype = $_POST['edit_usertype'];

    $query  = "UPDATE systemuser SET username='$username', email='$email', password1 = '$password1', usertype = '$usertype' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Data Updated";
        header('Location: systemadmin/accountlist.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Updated";
        header('Location: systemadmin/accountlist.php');
    }
}


if(isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM systemuser WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Data Deleted";
        header('Location: systemadmin/accountlist.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Deleted";
        header('Location: systemadmin/accountlist.php');
    }

}

if(isset($_POST['adminassignBlankstockbtn2'])) {
    $id = $_POST['id'];
    $date1 = $_POST['date1'];
    $blanktype = $_POST['blanktype'];
    $blankno = $_POST['blankno'];
    $range1 = $_POST['range1'];
    $range2 = $_POST['range2'];
    
    
  
    for ($blankno = $range1; $blankno <= $range2; $blankno++) {
       

       
        $sql = mysqli_query($connection,"INSERT INTO blankstock (id, date1, blanktype, blankno, range1, range2) VALUES ('$id','$date1','$blanktype','$blankno','$range1', '$range2' )");
        $sql = mysqli_query($connection,"INSERT INTO blankstockhistory (id, date1, blanktype, blankno) VALUES ('$id','$date1','$blanktype','$blankno')");
            // $query_run = mysqli_query($connection, $sql);
            header("Location: systemadmin/blankStock.php");   
       
            
        

    }
    
    if($range1 >= $range2) {
        header("Location: systemadmin/blankStock.php");  
        
    }
   
}
    
if(isset($_POST['adminassignBlankstockbtn'])) {
    $id = $_POST['id'];
    $date1 = $_POST['date1'];
    $blanktype = $_POST['blanktype'];
    $blankno = $_POST['blankno'];
 
    
    
    $sql = mysqli_query($connection,"INSERT INTO blankstock (id, date1, blanktype, blankno) VALUES ('$id','$date1','$blanktype','$blankno')");
    $sql = mysqli_query($connection,"INSERT INTO blankstockhistory (id, date1, blanktype, blankno) VALUES ('$id','$date1','$blanktype','$blankno')");
    
    // $query_run = mysqli_query($connection, $sql);
    header("Location: systemadmin/blankStock.php");    
    


   
}


if(isset($_POST['adminassignBlankbtn'])) {
    $blanktypeandno = $_POST['blanktypeandno'];
    $blanktype = $_POST['blanktype'];
    $blankno = $_POST['blankno'];
    $OMid = $_POST['omid'];
    $date1 = $_POST['date1'];
   



        $sql = mysqli_query($connection,"INSERT INTO adminassignedblanks (blanktypeandno, omid) VALUES ('$blanktypeandno','$OMid') ");
        
        $sql = mysqli_query($connection, "DELETE FROM blankstock WHERE CONCAT(blanktype,blankno) IN (SELECT blanktypeandno FROM adminassignedblanks);");

   
    // $sql = mysqli_query($connection, "DELETE FROM blankstock");
    
   
  
    header("Location: systemadmin/assignBlank.php");

}

if(isset($_POST['adminassignBlankbtn2'])) {
    $blanktypeandno = $_POST['blanktypeandno'];
    $OMid = $_POST['omid'];

  
        $sql = mysqli_query($connection,"INSERT INTO adminassignedblanks (blanktypeandno, omid) (select CONCAT(blanktype,blankno),username from blankstock,systemuser WHERE username = '$OMid')  ");
        $sql = mysqli_query($connection, "DELETE FROM blankstock WHERE CONCAT(blanktype,blankno) IN (SELECT blanktypeandno FROM adminassignedblanks);");

  
    // $sql = mysqli_query($connection, "DELETE FROM blankstock");
    
   
  
    header("Location: systemadmin/assignBlank.php");

}


if(isset($_POST['assignBlankbtn'])) {
$blanktypeandno = $_POST['blanktypeandno'];
$staffid = $_POST['staffid'];
$email = $_POST['email'];
$date1 = $_POST['date1'];
$sql = mysqli_query($connection, "INSERT INTO assignblank (blanktypeandno, staffid,email, date1) VALUES ('$blanktypeandno','$staffid','$email','$date1')");
$sql = mysqli_query($connection, "DELETE FROM adminassignedblanks WHERE blanktypeandno IN (SELECT blanktypeandno FROM assignblank);");


header("Location: officemanager/assignBlank.php");
}

if(isset($_POST['assignBlankBulkbtn'])) {
    $blanktypeandno = $_POST['blanktypeandno'];
    $staffid = $_POST['staffid'];
    $email = $_POST['email'];
    $date1 = $_POST['date1'];
    $range1 = $_POST['range1'];
    $range2 = $_POST['range2'];

    for ($blanktypeandno = $range1; $blanktypeandno <= $range2; $blanktypeandno++) {
    $sql = mysqli_query($connection, "INSERT INTO assignblank (blanktypeandno, staffid,email, date1,range1,range2) VALUES ('$blanktypeandno','$staffid','$email','$date1','$range1', '$range2' )");
    $sql = mysqli_query($connection, "DELETE FROM adminassignedblanks WHERE blanktypeandno IN (SELECT blanktypeandno FROM assignblank);");
    header("Location: officemanager/assignBlank.php");
    }
    if($range1 >= $range2) {
        header("Location: officemanager/assignBlank.php");  
        
    }



    }


if(isset($_POST['edit_btn_blank'])) {
    $id = $_POST['edit_id_blank'];
    
    $query = "SELECT * FROM assignblank WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
}


if(isset($_POST['reassignbtn']))

{
    $id = $_POST['edit_id_blank'];
    $blanktypeandno = $_POST['blanktypeandno'];
    $staffid = $_POST['staffid'];
   
   

    $query  = "UPDATE assignblank SET blanktypeandno='$blanktypeandno', staffid='$staffid' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);
    if($query_run){
        $_SESSION['success'] = "Successfully Reassigned";
        header('Location: officemanager/assignedBlanks.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Updated";
        header('Location: officemanager/assignedBlanks.php');
    }
  

}

if(isset($_POST['updatebtnblank']))

{
    $id = $_POST['edit_id_blank'];
    $staffid = $_POST['edit_id_staff'];
    $blanktype = $_POST['edit_blanktype'];
    $blankno = $_POST['edit_blankno'];
   

    $query  = "UPDATE assignblank SET blanktype='$blanktype', blankno = '$blankno' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Data Updated";
        header('Location: officemanager/assignedBlanks.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Updated";
        header('Location: officemanager/assignedBlanks.php');
    }
}


if(isset($_POST['delete_btn_blank'])) {
    $id = $_POST['delete_id_blank'];

    $query = "DELETE FROM assignblank WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Data Deleted";
        header('Location: officemanager/assignedBlanks.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Deleted";
        header('Location: officemanager/assignedBlanks.php');
    }

}



//for blank stock
if(isset($_POST['edit_btn_blank_stock'])) {
    $id = $_POST['edit_id_blank_stock'];
    
    $query = "SELECT * FROM blankstock WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
}

if(isset($_POST['stock'])) {
    $date1 = $_POST['date1'];

    $query = "SELECT from blankstock where blankno='00000001'";
    $query_run = mysqli_query($connection,$query);

  

}


if(isset($_POST['updatebtnblankstock']))

{
    $id = $_POST['edit_id_blank_stock'];
    $date1 = $_POST['edit_date_blank_stock'];
    $blanktype = $_POST['edit_blanktype'];
    $blankno = $_POST['edit_blankno'];
   

    $query  = "UPDATE blankstock SET date1='$date1', blanktype='$blanktype', blankno = '$blankno' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Data Updated";
        header('Location: systemadmin/blankStock.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Updated";
        header('Location: systemadmin/blankStock.php');
    }
}


if(isset($_POST['delete_btn_blank_stock'])) {
    $id = $_POST['delete_id_blank_stock'];

    $query = "DELETE FROM blankstock WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Data Deleted";
        header('Location: systemadmin/blankStock.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Deleted";
        header('Location: systemadmin/blankStock.php');
    }

}


//for assigned blanks edit, update and delete in the admin account
if(isset($_POST['edit_btn_blank_assignedblanks'])) {
    $id = $_POST['edit_id_blank_assignedblanks'];
    
    $query = "SELECT * FROM adminassignedblanks WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
}

if(isset($_POST['updatebtnblankassignedblanks']))

{
    $id = $_POST['edit_id_blank_assignedblanks'];
    $blanktypeandno = $_POST['edit_blanktypeandno'];
    $OMid = $_POST['edit_user'];
   

    $query  = "UPDATE adminassignedblanks SET blanktypeandno='$blanktypeandno', OMid = '$OMid' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Data Updated";
        header('Location: systemadmin/assignedBlanks.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Updated";
        header('Location: systemadmin/assignedBlanks.php');
    }
}


if(isset($_POST['delete_btn_blank_blanktypeandno'])) {
    $id = $_POST['delete_id_blank_blanktypeandno'];

    $query = "DELETE FROM adminassignedblanks WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Data Deleted";
        header('Location: systemadmin/assignedBlanks.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Deleted";
        header('Location: systemadmin/assignedBlanks.php');
    }

}



//blank stock history

if(isset($_POST['delete_btn_blank_stock_history'])) {
    $id = $_POST['delete_id_blank_stock_history'];

    $query = "DELETE FROM blankstockhistory WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Data Deleted";
        header('Location: systemadmin/blankhistory.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Deleted";
        header('Location: systemadmin/blankhistory.php');
    }

}

//for sell ticket


if(isset($_POST['sellticketbtn'])) {
   
    $date1 = $_POST['date1'];
    $type1 = $_POST['type1'];
    $paymenttype1 = $_POST['paymenttype1'];
    $blanktypeandno1 = $_POST['blanktypeandno1'];
    $fullname1 = $_POST['fullname1'];
    $othername = $_POST['othername'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $currcode = $_POST['currcode'];
    $amount1 = $_POST['amount1'];
    $USD = $_POST['USD'];
    $decimals = $_POST['decimals'];
    $amountUSD = $_POST['amountUSD'];
    $totaltax = $_POST['totaltax'];
    $totalamount1 = $_POST['totalamount1'];
    $nameoncard1 = $_POST['nameoncard1'];
    $cardno1 = $_POST['cardno1'];
    $cvv1 = $_POST['cvv1'];
    $expirydate1 = $_POST['expirydate1'];
    $datepaid = $_POST['datepaid'];
    $soldby = $_POST['soldby'];
    

    $sql = mysqli_query($connection, "INSERT INTO soldticket (date1, type1,paymenttype1, blanktypeandno1, fullname1,othername, origin, destination, currcode,amount1,USD, decimals, amountUSD,totaltax, totalamount1, nameoncard1, cardno1, cvv1, expirydate1, datepaid, soldby) VALUES ('$date1','$type1','$paymenttype1','$blanktypeandno1','$fullname1','$othername','$origin','$destination','$currcode','$amount1','$USD','$decimals','$amountUSD','$totaltax','$totalamount1','$nameoncard1','$cardno1','$cvv1','$expirydate1','$datepaid','$soldby')");
    // $sql = mysqli_query($connection,"INSERT INTO soldticket (id, date1, type1,paymenttype1, blanktypeandno1, fullname1,othername, origin, destination, amount1, nameoncard1, cardno1, cvv1, expirydate1, soldby) VALUES ('$id','$date1','$type1''$paymenttype1','$blanktypeandno1','$fullname1','$othername','$origin','$destination','$amount1','$nameoncard1','$cardno1','$cvv1','$expirydate1','$soldby')");
    $sql = mysqli_query($connection,"UPDATE soldticket SET totalamount1 = $amount1 + $totaltax WHERE blanktypeandno1 = '$blanktypeandno1'");
    $sql = mysqli_query($connection, "DELETE FROM assignblank WHERE blanktypeandno IN (SELECT blanktypeandno1 FROM soldticket);");
    // $query_run = mysqli_query($connection, $sql) or die(mysqli_error());  
    header("Location: traveladvisor/sellticket.php");
  }

  if(isset($_POST['sellticketbtn2'])) {
   
    $date1 = $_POST['date1'];
    $type1 = $_POST['type1'];
    $paymenttype1 = $_POST['paymenttype1'];
    $blanktypeandno1 = $_POST['blanktypeandno1'];
    $fullname1 = $_POST['fullname1'];
    $othername = $_POST['othername'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $currcode = $_POST['currcode'];
    $amount1 = $_POST['amount1'];
    $USD = $_POST['USD'];
    $decimals = $_POST['decimals'];
    $amountUSD = $_POST['amountUSD'];
    $localtax = $_POST['localtax'];
    $othertax = $_POST['othertax'];
    $totaltax = $_POST['totaltax'];
    $totalamount1 = $_POST['totalamount1'];
    $nameoncard1 = $_POST['nameoncard1'];
    
    $cardno1 = $_POST['cardno1'];
    $cvv1 = $_POST['cvv1'];
    $expirydate1 = $_POST['expirydate1'];
    $datepaid = $_POST['datepaid'];
    $soldby = $_POST['soldby'];
    
    
    $sql = mysqli_query($connection, "INSERT INTO soldticket (date1, type1,paymenttype1, blanktypeandno1, fullname1,othername, origin, destination, currcode,amount1,USD, decimals, amountUSD,localtax,othertax,totaltax, totalamount1 , nameoncard1, cardno1, cvv1, expirydate1, datepaid, soldby) VALUES ('$date1','$type1','$paymenttype1','$blanktypeandno1','$fullname1','$othername','$origin','$destination','$currcode','$amount1','$USD','$decimals','$amountUSD','$localtax','$othertax','$totaltax','$totalamount1','$nameoncard1','$cardno1','$cvv1','$expirydate1','$datepaid','$soldby')");
    // $sql = mysqli_query($connection,"INSERT INTO soldticket (id, date1, type1,paymenttype1, blanktypeandno1, fullname1,othername, origin, destination, amount1, nameoncard1, cardno1, cvv1, expirydate1, soldby) VALUES ('$id','$date1','$type1''$paymenttype1','$blanktypeandno1','$fullname1','$othername','$origin','$destination','$amount1','$nameoncard1','$cardno1','$cvv1','$expirydate1','$soldby')");
    $sql = mysqli_query($connection,"UPDATE soldticket SET totalamount1 = $amount1 + $totaltax WHERE blanktypeandno1 = '$blanktypeandno1'");
    $sql = mysqli_query($connection, "DELETE FROM assignblank WHERE blanktypeandno IN (SELECT blanktypeandno1 FROM soldticket);");
    // $query_run = mysqli_query($connection, $sql) or die(mysqli_error());  
    
    header("Location: traveladvisor/interlineticket.php");
  }



  //for assigned blanks edit, update and delete in the admin account
if(isset($_POST['edit_btn_sold'])) {
    $id = $_POST['edit_id_sold'];
    
    $query = "SELECT * FROM soldticket WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
}

if(isset($_POST['updatebtn_sold']))

{
    $id = $_POST['edit_id_sold'];
    $paymenttype1 = $_POST['edit_paymenttype'];
    $blanktypeandno1 = $_POST['edit_blanktypeandno'];
    $fullname1 = $_POST['edit_fullname'];
    $origin = $_POST['edit_origin'];
    $destination = $_POST['edit_destination'];
    $amount1 = $_POST['edit_amount'];
    $nameoncard1 = $_POST['edit_nameoncard'];
    $cardno1 = $_POST['edit_cardno'];
    $cvv1 = $_POST['edit_cvv'];
    $expirydate1 = $_POST['edit_expirydate'];
   
   

    $query  = "UPDATE soldticket SET paymenttype1 = '$paymenttype1', blanktypeandno1='$blanktypeandno1',fullname1 = '$fullname1',origin = '$origin',destination='$destination',amount1 = '$amount1',nameoncard1 = '$nameoncard1',cardno1 = '$cardno1', cvv1 = '$cvv1',expirydate1 = '$expirydate1' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Data Updated";
        header('Location: traveladvisor/soldticket.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Updated";
        header('Location: traveladvisor/soldticket.php');
    }
}


if(isset($_POST['delete_btn_sold'])) {
    $id = $_POST['delete_id_sold'];

    $query = "DELETE FROM soldticket WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Data Deleted";
        header('Location: traveladvisor/soldticket.php');
    }
    else {
        $_SESSION['status'] = "Data is NOT Deleted";
        header('Location: traveladvisor/soldticket.php');
    }

}

//for ticket deletion

if(isset($_POST['cancelticket'])) {
    $id = $_POST['ticketid'];
    
    $query = "DELETE FROM soldticket WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);
    header("Location: traveladvisor/cancelticket.php");  
}




if(isset($_POST['cancelTicketBulk'])) {
    $id = $_POST['ticketID'];
    $range1 = $_POST['range1'];
    $range2 = $_POST['range2'];
    
    
  
    for ($id = $range1; $id <= $range2; $id++) {
     
        $query = mysqli_query($connection,"DELETE FROM soldticket WHERE id='$id'");
            // $query_run = mysqli_query($connection, $sql);
            header("Location: traveladvisor/cancelticket.php");   
    }
            if($range1 >= $range2) {
                header("Location: traveladvisor/cancelticket.php");  
                
            }
        

    }

    

if(isset($_POST['refundTicket'])) {
    
    $fullname1 = $_POST['fullname1'];
    $amount1 = $_POST['amount1'];
    $blanktypeandno1 = $_POST['blanktypeandno1'];
    $refundedby = $_POST['refundedby'];
    

    $query = mysqli_query($connection, "INSERT INTO refunds(fullname1, amount1,refundedby,blanktypeandno1) VALUES ('$fullname1','$amount1','$refundedby','$blanktypeandno1')");
    $query = mysqli_query($connection, "DELETE FROM soldticket WHERE fullname1='$fullname1' AND amount1='$amount1' AND blanktypeandno1 = '$blanktypeandno1");
    header("Location: traveladvisor/refundTicket.php");  
}   
//customer status in office manager


   
if(isset($_POST['customerstatussubmit'])) {

    $fullname = $_POST['fullname'];
    $type = $_POST['type'];
    
    $query = mysqli_query($connection, "UPDATE customer SET type='$type' WHERE fullname='$fullname'");
    // $query_run = mysqli_query($connection, $query);
  
    if($query){
        $_SESSION['success'] = "Customer Status Changed Successfully";
        header("Location: officemanager/customerstatus.php");  
    }
    else {
        $_SESSION['status'] = "Customer Status NOT Changed";
        header("Location: officemanager/customerstatus.php");  
    }
}
        

//set commission in the office manager profile

if(isset($_POST['setCommissionBtn'])) {
    $soldby = $_POST['soldby'];
    $blanktypeandno1 = $_POST['blanktypeandno1'];
    $commission = $_POST['commission'];

    $query = mysqli_query($connection, "UPDATE soldticket SET commission='$commission' WHERE blanktypeandno1='$blanktypeandno1'");
    header("Location: officemanager/setCommission.php");   
}

if(isset($_POST['commission23'])) {
   
    $blanktypeandno1 = $_POST['blanktypeandno1'];

    $commission = $_POST['commission'];

    $query = mysqli_query($connection, "UPDATE soldticket SET commission='$commission'  WHERE SUBSTRING(blanktypeandno1,1,3)  LIKE '444%' ");
    header("Location: officemanager/setCommission.php");   
}

if(isset($_POST['commission24'])) {
   
    $blanktypeandno1 = $_POST['blanktypeandno12'];

    $commission = $_POST['commission2'];

    $query = mysqli_query($connection, "UPDATE soldticket SET commission='$commission'  WHERE SUBSTRING(blanktypeandno1,1,3)  LIKE '201%' ");
    header("Location: officemanager/setCommission.php");   
}


if(isset($_POST['removeCommissionBtn'])) {
    $soldby = $_POST['soldby'];
    $blanktypeandno1 = $_POST['blanktypeandno1'];
    $commission = $_POST['commission'];
  

    $query = mysqli_query($connection, "UPDATE soldticket SET commission='$commission' WHERE blanktypeandno1='$blanktypeandno1'");
    header("Location: officemanager/removeCommission.php");   
}


//late payment button in office manager page

if(isset($_POST['latepaymentbtn'])) {
    $fullname1 = $_POST['fullname1'];
    $amount1 = $_POST['amount1'];
    $datepaid1 = $_POST['datepaid1'];
    $datepaid = $_POST['datepaid'];
    $nameoncard1 = $_POST['nameoncard1'];
    $cardno1 = $_POST['cardno1'];
    $cvv1 = $_POST['cvv1'];
    $expirydate1 = $_POST['expirydate1'];
    $paymenttype1 = $_POST['paymenttype1'];

    $query = mysqli_query($connection, "UPDATE soldticket SET amount1='$amount1',datepaid1 = '$datepaid1',datepaid = '$datepaid',nameoncard1 = '$nameoncard1',cardno1 = '$cardno1',cvv1 = '$cvv1',expirydate1 = '$expirydate1', paymenttype1 = '$paymenttype1' WHERE fullname1='$fullname1'");
    $query = mysqli_query($connection, "INSERT INTO latepayments (fullname1, amount1, datepaid1) VALUES ('$fullname1','$amount1','$datepaid1')");
    header("Location: officemanager/latepayment0.php");   
}


//yet to pay btn in office mang page


if(isset($_POST['yetopaybtn'])) {
    $fullname1 = $_POST['fullname1'];
    $amount1 = $_POST['amount1'];
    $datepaid1 = $_POST['datepaid1'];
    $datepaid = $_POST['datepaid'];
    $nameoncard1 = $_POST['nameoncard1'];
    $cardno1 = $_POST['cardno1'];
    $cvv1 = $_POST['cvv1'];
    $expirydate1 = $_POST['expirydate1'];
    $paymenttype1 = $_POST['paymenttype1'];

    $query = mysqli_query($connection, "UPDATE soldticket SET amount1='$amount1',datepaid1 = '$datepaid1',datepaid = '$datepaid',nameoncard1 = '$nameoncard1',cardno1 = '$cardno1',cvv1 = '$cvv1',expirydate1 = '$expirydate1', paymenttype1 = '$paymenttype1' WHERE fullname1='$fullname1'");
    $query = mysqli_query($connection, "INSERT INTO latepayments (fullname1, amount1, datepaid1) VALUES ('$fullname1','$amount1','$datepaid1')");
    header("Location: officemanager/yettopay.php");   
}


//yet to pay btn in TA page

if(isset($_POST['yetopaybtn1'])) {
    $fullname1 = $_POST['fullname1'];
    $amount1 = $_POST['amount1'];
    $datepaid1 = $_POST['datepaid1'];
    $datepaid = $_POST['datepaid'];
    $nameoncard1 = $_POST['nameoncard1'];
    $cardno1 = $_POST['cardno1'];
    $cvv1 = $_POST['cvv1'];
    $expirydate1 = $_POST['expirydate1'];
    $paymenttype1 = $_POST['paymenttype1'];

    $query = mysqli_query($connection, "UPDATE soldticket SET amount1='$amount1',datepaid1 = '$datepaid1',datepaid = '$datepaid',nameoncard1 = '$nameoncard1',cardno1 = '$cardno1',cvv1 = '$cvv1',expirydate1 = '$expirydate1', paymenttype1 = '$paymenttype1' WHERE fullname1='$fullname1'");
    $query = mysqli_query($connection, "INSERT INTO latepayments (fullname1, amount1, datepaid1) VALUES ('$fullname1','$amount1','$datepaid1')");
    header("Location: traveladvisor/yettopay.php");   
}

//void tickets in office manager page

if(isset($_POST['void_btn_blank'])) {
   $id = $_POST['void_id_blank'];
 
   

    $sql = mysqli_query($connection, "INSERT INTO voidedtickets SELECT * FROM soldticket WHERE id='$id'");
    $query = mysqli_query($connection, "DELETE FROM soldticket WHERE id='$id'");


    
        header('Location: officemanager/viewtickets.php');
    

}


?>







