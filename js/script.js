regEx = /[^0-9]/g;
function validateNumber(element) {
  element?.addEventListener("input", (e) => {
    e.target.value = e.target.value.replace(regEx, "");
  });
}
contact =
  document.querySelector("#aboutContact") ??
  document.querySelector("#signupContact");
pac = document.querySelector("#package");
empContact = document.querySelector("#employeeContact");
editPackageValidation = document.querySelector("#package1");
editContactValidation = document.querySelector("#empContact1");

validateNumber(contact);
validateNumber(pac);
validateNumber(empContact);
validateNumber(editPackageValidation);
validateNumber(editContactValidation);

//* <---- Edit feature ------> */
edits = document.getElementsByClassName("editData");
Array.from(edits)?.forEach((e) => {
  e?.addEventListener("click", (y) => {
    tr = y.target.parentNode.parentNode;
    name = tr.getElementsByTagName("td")[1].innerText;
    contact = tr.getElementsByTagName("td")[2].innerText;
    email = tr.getElementsByTagName("td")[3].innerText;
    password = tr.getElementsByTagName("td")[4].innerText;
    jdate = tr.getElementsByTagName("td")[5].innerText;
    dob = tr.getElementsByTagName("td")[6].innerText;
    depart = tr.getElementsByTagName("td")[7].innerText;
    designation = tr.getElementsByTagName("td")[8].innerText;
    packages = tr.getElementsByTagName("td")[9].innerText;
    unm1.value = name;
    empContact1.value = contact;
    empEmail1.value = email;
    pwd1.value = password;
    jd1.value = jdate;
    dob1.value = dob;
    dep1.value = depart;
    designation1.value = designation;
    package1.value = packages;
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
