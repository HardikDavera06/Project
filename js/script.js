let number = document.querySelector("#aboutContactNumber") ;
let signupContact = document.querySelector("#signupContact");
let regExContact = /[^0-9]/g;

number?.addEventListener("input", (e) => {
  e.target.value = e.target.value.replace(regExContact, "");
});

signupContact?.addEventListener("input", (e) => {
  e.target.value = e.target.value.replace(regExContact, "");
});

//* <---- Edit feature ------> */
edits = document.getElementsByClassName("editData");
Array.from(edits)?.forEach((e) => {
  e?.addEventListener("click", (y) => {
    tr = y.target.parentNode.parentNode;
    name = tr.getElementsByTagName("td")[1].innerText;
    password = tr.getElementsByTagName("td")[2].innerText;
    jdate = tr.getElementsByTagName("td")[3].innerText;
    depart = tr.getElementsByTagName("td")[4].innerText;
    unm1.value = name;
    pwd1.value = password;
    jd1.value = jdate;
    dep1.value = depart;
    sno.value = y.target.id;
    editID.value = y.target.id;
    editDelete.value = y.target.id;
    //* <---- toggle for open modal -----> */
    $("#EDITmodal").modal("toggle");
  });
});

users = document.getElementsByClassName("navUsers");
Array.from(users)?.forEach((e) => {
  e?.addEventListener("click", (h) => {
    $("#navModal").modal("toggle");
  });
});
