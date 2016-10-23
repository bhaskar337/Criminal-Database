
window.onload = function () {
    document.getElementById("default").focus();
    document.getElementById("finger_print").style.display = "block";
    evt.currentTarget.className += " active";
};

function openDetail(evt, detail) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(detail).style.display = "block";
    evt.currentTarget.className += " active";
}


var modal = document.getElementById('myModal');
var img1 = document.getElementById('box1');
var img2 = document.getElementById('box2');
var img3 = document.getElementById('box3');
var img4 = document.getElementById('box4');
var img5 = document.getElementById('box5');

img1.onclick = function(){
    modal.style.display = "block";
}
img2.onclick = function(){
    modal.style.display = "block";
}
img3.onclick = function(){
    modal.style.display = "block";
}
img4.onclick = function(){
    modal.style.display = "block";
}
img5.onclick = function(){
    modal.style.display = "block";
}

var modal2 = document.getElementById('myModal2');
var img = document.getElementById('box');

img.onclick = function(){
    modal2.style.display = "block";
}

document.onkeypress = function(evt) {
    evt = evt || window.event;
      if (evt.keyCode == 27&& modal2.style.display=="block") {
        modal2.style.display="none";
    }
    if (evt.keyCode == 27&& modal.style.display=="block") {
        modal.style.display="none";
    }
   
};  
    

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var span2 = document.getElementsByClassName("close")[1];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
span2.onclick = function() { 
    modal2.style.display = "none";
}