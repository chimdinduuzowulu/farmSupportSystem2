var form = document.getElementById("ViewUser");
form.onsubmit= (event) =>{ event.preventDefault(); } 

// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}

function view() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("tableAjax").innerHTML = this.responseText;
      }
    };
    
    xmlhttp.open("GET","ajaxResponse.php?Qoption=<?php echo $_POST['queryOptions']?>&limitVal=<?php echo $_POST['MaxDisplayValue']?>&submit=<?php echo $_POST['ShowQuery']?>",true);
    xmlhttp.send();
    
  
}
function viewThem(){
document.getElementById("tableCon").style.visibility="visible";

}
function ClearThem(){
document.getElementById("tableCon").innerHTML="";

}