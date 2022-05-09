// javascript functions to hide a comment 
function commentaires(id) {
    let comm = document.querySelector("#commentaire-" + id);
    if (comm.style.display === "none") {
        comm.style.display = "block";
    } else {
        comm.style.display = "none";
    }
}

function toggleCommentForm() {
    let comm = document.querySelector("#comment-form");
    if (comm.style.display === "none") {
        comm.style.display = "block";
    } else {
        comm.style.display = "none";
    }
}

function myFunction() {
    var x = document.getElementById("comments");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}