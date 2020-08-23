<!-- 
function loginUser(user, pass) {
$("#loginUser").submit(function (event) {
event.preventDefault();

var user = $("#username").val();
var pass = $("#password").val();

loginUser(user, pass);
var result = "";
});
$.ajax({
method: "post",
url: "modallogin.php",
data: {
user: username,
pass: pass,
},
}).done(function (data) {
var result = data;
var str = "";

if ($result == 0) {
str =
'<div class="alert alert-danger alert-dismissible fade show col-lg-6 " id="alertmsg"> ';
	('<button type="button" class="close" data - dismiss="alert">& times;</button>');
	("<h3><strong>Error:</strong> Invalid Username Or Password. </h3>");
	("</div> ");
} else if ($result == 1) {
str = "<div class='alert alert-success col-lg-6' id='alertmsg'>";
	("<h1> Hi ' . $_SESSION['username'].' Welcome Back <i class='fa-smile'></i></h1>");
	("</div>");
$("#deleteFav").hide(function () {
$("#saveusers").css("display", "block");
});
header("Refresh:3;");
} else if ($result == 2) {
$_SESSION["status"] = "Pending";
str =
'<div class="alert alert-warning alert-dismissible fade show col-lg-6" id="alertmsg">';
	('< button type="button" class="close" data-dismiss="alert">& times;</button>');
		("<h3><strong>Error:</strong>your account is not approved</h3>");
		("</div>");
header("Refresh:3;");
} else if ($result == 3) {
$_SESSION["status"] = "Rejected";
str =
'<div class="alert alert-danger alert-dismissible fade show col-lg-6" id="alertmsg">';
	('<button type="button" class="close" data-dismiss="alert">&times;</button>');
	("<h3><strong>Error:</strong> Your ACCOUNT HAS Been REJECTED!! </h3>");
	("</div>;");
header("Refresh:3;");
} else {
str =
'<div class="alert alert-danger alert-dismissible fade show col-lg-6" id="alertmsg"> ';
	(' <button type="button" class="close" data-dismiss="alert">&times;</button>');
	(" <h3><strong>Error:</strong> UNKNOWN ERROR HAS OCCURRED PLEASE TRY AGAIN. </h3>");
	("</div> ");
header("Refresh:3;");
}
$("#message").html(str);
});
} -->