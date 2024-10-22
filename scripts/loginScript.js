$(document).ready(function(){
  $(".login-btn").click(function(){
    $(".popupMenu").toggle(300);
  });
});
$(document).ready(function(){
  $(".closePopup").click(function(){
    $(".popupMenu").hide(300);
  });
});
// close popup register form on clicking outside it
document.addEventListener("click", function(e) {
  if (!e.target.closest(".popupMenu") && !e.target.closest(".login-btn")) {
    document.querySelector(".popupMenu").style.display = "none";
  }
},
false
)

