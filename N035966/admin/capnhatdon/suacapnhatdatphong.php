<?php
     include('../config.php');
    //  tenpsua: tenpsua, mattdpsua: mattdpsua, tendvsua:tendvsua, tenttsua: tenttsua, datphongtusua: datphongtusua,
    //             denngaysua:denngaysua,
    //             chuthichsua:chuthichsua
    $tenpsua = $_POST['tenpsua'];
    $mattdpsua = $_POST['mattdpsua'];
    $tendvsua = $_POST['tendvsua'];
    $tenttsua = $_POST['tenttsua'];
    $datphongtusua =$_POST['datphongtusua'];
    $denngaysua = $_POST['denngaysua'];
    $chuthichsua = $_POST['chuthichsua'];
       $lenh2 = 'insert ctdv value ('.$mattdpsua.','.$tendvsua.')';
       mysqli_set_charset($conn,'utf8');

       if($tendvsua!=''){
        mysqli_query($conn, $lenh2);
         }
   // lay gia dich vu
    $lenh3 = 'select giadv from dichvu where madv in(select madv from ctdv where mattdp='.$mattdpsua.')';
    $kq3 = mysqli_query($conn,$lenh3);
    $tongtien = 0;
        while($row3 = mysqli_fetch_assoc($kq3)){
        $tongtien = $tongtien + $row3['giadv'];
        
        }
        //lay gia phong
    $lenh4 = 'select giap from phong where map =(select map from ttdatphong where mattdp = '.$mattdpsua.')';
    $kq4 = mysqli_query($conn,$lenh4);
    $row4 = mysqli_fetch_assoc($kq4);

    $lenh = 'update ttdatphong set matt ='.$tenttsua.', datphongtu = "'.$datphongtusua.'", denngay="'.$denngaysua.'",chuthich = "'.$chuthichsua.'", tongtien = '.$tongtien.' + (datediff(denngay,datphongtu)*'.$row4['giap'].') where mattdp ='.$mattdpsua;
    $kq =  mysqli_query($conn, $lenh);
    if($kq || $kq3 || $kq4){
        echo '1';
    }else echo '0';
?>