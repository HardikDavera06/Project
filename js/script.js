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
    tr = y.target.parentNode.parentNode.parentNode.parentNode;
    name = tr.getElementsByTagName("td")[1].innerText;
    email = tr.getElementsByTagName("td")[2].innerText;
    contact = tr.getElementsByTagName("td")[3].innerText;
    jdate = tr.getElementsByTagName("td")[4].innerText;
    dob = tr.getElementsByTagName("td")[5].innerText;
    depart = tr.getElementsByTagName("td")[6].innerText;
    designation = tr.getElementsByTagName("td")[7].innerText;
    packages = tr.getElementsByTagName("td")[8].innerText;
    unm1.value = name;
    jd1.value = jdate;
    dob1.value = dob;
    dep1.value = depart;
    designation1.value = designation;
    package1.value = packages;
    sno.value = y.target.id;
    editID.value = y.target.id;
    if (designation == "superadmin") {
      editDelete.value = y.target.id;
      empContact1.value = contact;
      empEmail1.value = email;
    } else {
      empContact1.value = contact;
      empEmail1.value = email;
      empContact1.disabled = true;
      empEmail1.disabled = true;
    }
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

forgetPassword = document.getElementsByClassName("forgetPassword");
Array.from(forgetPassword)?.forEach((e) => {
  e?.addEventListener("click", (h) => {
    tr = h.target.parentNode.parentNode.parentNode.parentNode;
    department.value = tr.getElementsByTagName("td")[6].innerText;
    passwordID.value = h.target.id;
    $("#forgetPasswordModal").modal("toggle");
  });
});
