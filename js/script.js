// Or, to prevent back navigation entirely (use cautiously, as it can annoy users):
history.pushState(null, null, location.href);
window.onpopstate = function () {
  history.go(1);
};

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
editLeave = document.querySelectorAll(".editLeave");
showLeave = document.querySelectorAll(".leaveApplication");

Array.from(editLeave)?.forEach((e) => {
  e?.addEventListener("click", (y) => {
    tr = y.target.parentNode.parentNode;
    Leavetype = tr.getElementsByTagName("td")[2].innerText;
    LeaveReason = tr.getElementsByTagName("td")[3].innerText;
    LeaveFrom = tr.getElementsByTagName("td")[4].innerText;
    LeaveTo = tr.getElementsByTagName("td")[5].innerText;

    leaveID.value = y.target.id;
    edit_leave_type.value = Leavetype;
    edit_reason.value = LeaveReason;
    edit_from_date.value = LeaveFrom;
    edit_to_date.value = LeaveTo;
    $("#editLeaveModal").modal("toggle");
  });
});

Array.from(showLeave)?.forEach((e) => {
  e?.addEventListener("click", (y) => {
    tr = y.target.parentNode;
    Leavetype = tr.getElementsByTagName("td")[2].innerText;
    LeaveReason = tr.getElementsByTagName("td")[3].innerText;
    LeaveFrom = tr.getElementsByTagName("td")[4].innerText;
    LeaveTo = tr.getElementsByTagName("td")[5].innerText;
    leaveID.value = y.target.id;

    show_leave_type.disabled = true;
    show_reason.disabled = true;
    show_from_date.disabled = true;
    show_to_date.disabled = true;

    show_leave_type.value = Leavetype;
    show_reason.value = LeaveReason;
    show_from_date.value = LeaveFrom;
    show_to_date.value = LeaveTo;
    $("#showLeaveModal").modal("toggle");
  });
});

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
    }
    empContact1.value = contact;
    empEmail1.value = email;
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
