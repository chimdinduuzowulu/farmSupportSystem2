<?php 
$displayChoice=isset($_GET["email"])? strval($_GET["email"]):null;
// $limitValue=isset($_GET["limitVal"]) ? intval($_GET["limitVal"]):null;


?>




<script>
function searchUser(){
var form2 = new FormData(document.querySelector('form'))
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        tableAjax2.innerHTML = this.responseText;
      }
    };
    
    xmlhttp.open("GET","SearchUsers.php?email=<?php echo $email?>",true);
    xmlhttp.send();
    
  
}
</script>