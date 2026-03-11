<?php
session_start();
include("config.php");

$id = $_GET['id'] ?? '';

// Fetch birth record using prepared statement to prevent SQL injection
$stmt = mysqli_prepare($conn, "SELECT * FROM birth WHERE id=?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$b = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Fetch field labels (local language)
$result2 = mysqli_query($conn, "SELECT * FROM fields LIMIT 1");
$f = mysqli_fetch_assoc($result2);

// Fetch organization info
$result3 = mysqli_query($conn, "SELECT * FROM organization LIMIT 1");
$o = mysqli_fetch_assoc($result3);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="generator" content="pdftohtml 0.36"/>
<title>Birth Certificate</title>
<style type="text/css">
<!--
p {margin: 0; padding: 0;}
.bold {font-weight: bold;}
.capital {text-transform: uppercase;}
body {
  background-color: white;
  font-family: Arial, sans-serif;
}
.page {
  position: relative;
  overflow: hidden;
  margin: auto;
  padding: 0;
  width: 1263px;
  height: 1785px;
}
.c {
  position: absolute;
  border: none;
  padding: 0;
  margin: 0;
}
.t {
  position: absolute;
  overflow: visible;
  white-space: pre;
}

/* Font Family */
.ff0 { font-family: Arial, sans-serif; }
.ff1 { font-family: Arial, sans-serif; font-weight: bold; }
.ff2 { font-family: Times New Roman, serif; }
.ff3 { font-family: Arial, sans-serif; }

/* Font Sizes */
.fs0 { font-size: 38px; }
.fs1 { font-size: 45px; }
.fs2 { font-size: 52px; }
.fs3 { font-size: 56px; }
.fs4 { font-size: 60px; }
.fs5 { font-size: 65px; }

/* Font Colors */
.fc0 { color: #000000; }
.fc1 { color: #000000; }
.fc2 { color: #0000ff; }

/* Other styles */
.sc0 { text-decoration: none; }
.ls0 { letter-spacing: 0px; }
.ws0 { word-spacing: 0px; }

/* Position helpers */
.x0 { left: 0px; }
.x1 { left: 50px; }
.x2 { left: 100px; }
.x3 { left: 150px; }
.x4 { left: 200px; }
.x5 { left: 250px; }
.x6 { left: 300px; }
.x7 { left: 350px; }
.x8 { left: 640px; }
.x9 { left: 400px; }
.x10 { left: 450px; }
.x11 { left: 500px; }
.x12 { left: 550px; }
.x13 { left: 600px; }
.x14 { left: 650px; }
.x15 { left: 700px; }
.x16 { left: 750px; }
.x17 { left: 800px; }
.x18 { left: 850px; }
.x19 { left: 50px; }
.x20 { left: 900px; }

/* Width helpers */
.w1 { width: 200px; }
.w2 { width: 400px; }
.w3 { width: 560px; }
.w4 { width: 600px; }
.w5 { width: 700px; }

/* Height helpers */
.h1 { height: 50px; }
.h2 { height: 100px; }
.h3 { height: 150px; }
.h4 { height: 200px; }
.h5 { height: 250px; }
.h6 { height: 300px; }
.h7 { height: 350px; }
.h8 { height: 80px; }
.h9 { height: 60px; }
.ha { height: 70px; }
.hb { height: 140px; }
.hc { height: 160px; }
.hd { height: 120px; }
.he { height: 100px; }
.hf { height: 180px; }
.h10 { height: 400px; }
.h11 { height: 110px; }

/* Vertical position helpers */
.y1 { top: 450px; }
.y1b { top: 650px; }
.y1c { top: 660px; }
.y1d { top: 1550px; }
.y1e { top: 660px; }
.y17 { top: 460px; }
.y18 { top: 465px; }
.y19 { top: 455px; }
.y2 { top: 500px; }
.y23 { top: 850px; }
.y24 { top: 855px; }
.y25 { top: 1000px; }
.y26 { top: 1005px; }
.y28 { top: 1180px; }
.y29 { top: 1185px; }
.y31 { top: 1400px; }
.y35 { top: 1540px; }
.m0 { margin: 0; }

/* Helper classes for consistent spacing and text wrapping */
.uniform-spacing {
    margin-top: 35px !important;
    line-height: 1.3em;
}

.address-field {
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
}
-->
</style>
</head>
<body>
<div class="page">

<!-- Certificate Header -->
<div class="c" style="top:30px; left:50px; width:1163px; text-align:center;">
    <div class="t m0 ff1 fs4 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($o['organization_name'] ?? 'MUNICIPAL CORPORATION'); ?></b>
    </div>
</div>

<div class="c" style="top:100px; left:50px; width:1163px; text-align:center;">
    <div class="t m0 ff1 fs3 fc1 sc0 ls0 ws0">
        <b>BIRTH CERTIFICATE / जन्म प्रमाण पत्र</b>
    </div>
</div>

<!-- Certificate Border / Template Image -->
<div class="c" style="top:0px; left:0px; width:1263px; height:1785px;">
    <?php if(file_exists('birth_certificate_template.jpg')): ?>
    <img src="birth_certificate_template.jpg" width="1263" height="1785"/>
    <?php endif; ?>
</div>

<!-- Name and Sex Section (around line 464) -->
<div class="c x19 y17 w3 h8">
    <div class="t m0 x0 h9 y18 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['namelocal'] ?? 'नाम')?> / NAME</b>: 
        <span class="ff3 fs3 capital"><?php echo strtoupper($b['name'] ?? ''); ?></span>
    </div>
</div>
<div class="c x8 y17 w3 h8">
    <div class="t m0 x0 h9 y18 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['genderlocal'] ?? 'लिंग')?> / SEX</b>: 
        <span class="ff3 fs3 capital"><?php 
            $g = strtolower(trim($b['gender'] ?? ''));
            echo ($g == 'male' || $g == 'm') ? "MALE / पुरुष" : (($g == 'female' || $g == 'f') ? "FEMALE / महिला" : "OTHER / अन्य");
        ?></span>
    </div>
</div>

<!-- EID/Aadhaar Section (around line 470) -->
<div class="c x1 y1 w2 h2">
    <div class="t m0 x1 ha y19 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['aadharlocal'] ?? 'आधार')?> / EID </b>
    </div>
    <div class="t m0 ff3 fs3 fc1 sc0 ls0 ws0" style="margin-top:669px; margin-left:26px;"><!-- 669px positions the EID value below the section label -->
        <?php if(($b['aadharno'] ?? '') != ""){ ?>XXXX-XXXX-<?php echo substr($b['aadharno'], -4); ?><?php } ?>
    </div>
</div>

<!-- Date of Birth Section (around line 477) -->
<div class="c x19 y1b w3 hb">
    <div class="t m0 x0 ha y1c ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['doblocal'] ?? 'जन्म तिथि')?> / DATE OF BIRTH: </b>
    </div>
    <div class="t m0 x0 ff3 fs3 fc1 sc0 ls0 ws0" style="margin-top:35px;">
        <?php 
            if(!empty($b['dob'])) {
                $date = date_create($b['dob']);
                echo date_format($date, "d-m-Y");
            }
        ?>
    </div>
    <div class="ff3 fs3 capital" style="margin-top:15px; line-height:1.3em;">
        <?php 
            if(($b['dodwords'] ?? '') == "") { echo "&nbsp;"; } else { echo strtoupper($b['dodwords']); }
        ?>-<?php echo strtoupper($b['dodwords1'] ?? ''); ?>-<?php echo strtoupper($b['dodwords2'] ?? ''); ?>
    </div>
</div>

<!-- Place of Birth Section (around line 489) -->
<div class="c x8 y1b w3 hb">
    <div class="t m0 x0 ha y1e ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['poblocal'] ?? 'जन्म स्थान')?> / PLACE OF BIRTH: </b>
    </div>
    <div class="ff3 fs3 capital" style="margin-top:35px; line-height:1.3em; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">
        <?php echo strtoupper($b['placeofbirth'] ?? ''); ?>
    </div>
</div>

<!-- Mother's Name Section (around line 496) -->
<div class="c x19 y23 w3 hd">
    <div class="t m0 x0 ha y24 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['mnamelocal'] ?? 'माता का नाम')?> / NAME OF MOTHER: </b>
    </div>
    <div class="t m0 x0 ff3 fs3 fc1 sc0 ls0 ws0 capital" style="margin-top:35px;">
        <?php echo strtoupper($b['mname'] ?? ''); ?>
    </div>
</div>

<!-- Father's Name Section (around line 502) -->
<div class="c x8 y23 w3 hd">
    <div class="t m0 x0 ha y24 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['fnamelocal'] ?? 'पिता का नाम')?> / NAME OF FATHER:</b>
    </div>
    <div class="t m0 x0 ff3 fs3 fc1 sc0 ls0 ws0 capital" style="margin-top:35px;">
        <?php echo strtoupper($b['fname'] ?? ''); ?>
    </div>
</div>

<!-- Mother's Aadhaar Section (around line 512) -->
<div class="c x19 y25 w3 he">
    <div class="t m0 x0 ha y26 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['maadharlocal'] ?? 'माता का आधार')?> / AADHAAR NUMBER OF MOTHER:</b>
    </div>
    <div class="t m0 x0 ff3 fs3 fc1 sc0 ls0 ws0" style="margin-top:30px;">
        <?php if(($b['maadhar'] ?? '') != "") { ?>XXXX-XXXX-<?php echo substr($b['maadhar'], -4); ?><?php } else { ?>&nbsp;<?php } ?>
    </div>
</div>

<!-- Father's Aadhaar Section (around line 525) -->
<div class="c x8 y25 w3 he">
    <div class="t m0 x0 ha y26 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['faadharlocal'] ?? 'पिता का आधार')?> / AADHAAR NUMBER OF FATHER:</b>
    </div>
    <div class="t m0 x0 ff3 fs3 fc1 sc0 ls0 ws0" style="margin-top:30px;">
        <?php if(($b['faadhar'] ?? '') != "") { ?>XXXX-XXXX-<?php echo substr($b['faadhar'], -4); ?><?php } else { ?>&nbsp;<?php } ?>
    </div>
</div>

<!-- Birth Address Section (around line 533) -->
<div class="c x19 y28 w3 hf">
    <div class="t m0 x0 ha y29 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['birthaddresslocal'] ?? 'जन्म के समय पता')?> / ADDRESS OF PARENTS AT THE <br>TIME OF BIRTH OF THE CHILD:</b>
    </div>
    <div class="ff3 fs3 capital" style="margin-top:55px; line-height:1.3em; word-wrap: break-word;">
        <?php echo strtoupper($b['birthaddress'] ?? ''); ?>
    </div>
</div>

<!-- Permanent Address Section (around line 539) -->
<div class="c x8 y28 w3 hf">
    <div class="t m0 x0 ha y1c ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['permanentaddresslocal'] ?? 'स्थायी पता')?> / PERMANENT ADDRESS OF PARENTS:</b>
    </div>
    <div class="ff3 fs3 capital" style="margin-top:39px; line-height:1.3em; word-wrap: break-word;">
        <?php echo strtoupper($b['permanentaddress'] ?? ''); ?>
    </div>
</div>

<!-- Registration Number Section (around line 545) -->
<div class="c x19 y31 w3 hd">
    <div class="t m0 x0 ha y24 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['regnolocal'] ?? 'पंजीकरण संख्या')?> / REGISTRATION NUMBER:</b>
    </div>
    <div class="t m0 x0 ff3 fs3 fc1 sc0 ls0 ws0" style="margin-top:35px;">
        <?php echo strtoupper($b['regno'] ?? ''); ?>
    </div>
</div>

<!-- Date of Registration Section (around line 551) -->
<div class="c x8 y31 w3 hd">
    <div class="t m0 x0 ha y24 ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['regdatelocal'] ?? 'पंजीकरण तिथि')?> / DATE OF REGISTRATION:</b>
    </div>
    <div class="t m0 x0 ff3 fs3 fc1 sc0 ls0 ws0" style="margin-top:35px;">
        <?php 
            if(!empty($b['dateofregister'])) {
                $date = new DateTime($b['dateofregister']);
                echo $date->format('d-m-Y');
            }
        ?>
    </div>
</div>

<!-- Date of Issue Section (around line 561) -->
<div class="c x19 y35 w4 h11">
    <div class="t m0 x0 ha y1d ff1 fs2 fc1 sc0 ls0 ws0">
        <b><?php echo strtoupper($f['doilocal'] ?? 'जारी करने की तिथि')?> / DATE OF ISSUE:</b>
    </div>
    <div class="t m0 x0 ff3 fs3 fc1 sc0 ls0 ws0" style="margin-top:30px;">
        <?php echo strtoupper($b['dateofissue'] ?? ''); ?>
    </div>
</div>

</div>
</body>
</html>
