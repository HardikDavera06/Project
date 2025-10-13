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
editEmpLeave = document.querySelectorAll(".edit_emp_leave");

function changeStatus(leaveID, status) {
  var newStatus = status == 1 ? 2 : 1;
  $.ajax({
    url: `applyLeave.php?approve=true&id=${leaveID}&changeStatus=true&status=${status}`,
    method: "GET",
    success: function (response) {
      var row = $(`a[onclick^="changeStatus(${leaveID},"]`).closest("tr");
      if (!row.length) row = $(`#${leaveID}`).closest("tr");
      if (!row.length) row = $(`[data-leave-id="${leaveID}"]`).closest("tr");

      if (row.length) {
        var cols = row.find("td");
        // columns in table: 0:serial,1:applicant,2:leave_type,3:reason,4:from,5:to,6:status,7:actions (maybe)
        var leaveType = cols.eq(2).text().trim();
        var reason = cols.eq(3).text().trim();
        var fromDate = cols.eq(4).text().trim();
        var toDate = cols.eq(5).text().trim();

        function esc(s) {
          return String(s || "")
            .replace(/&/g, "&amp;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#39;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;");
        }

        var statusBadge =
          newStatus == 1
            ? `<span class="badge bg-success p-2 rounded-3" style="font-size:13px;">Accepted</span>`
            : `<span class="badge bg-danger p-2 rounded-3" style="font-size:13px;">Rejected</span>`;

        var changeBtn = `<a class="btn btn-sm text-decoration-none btn-info text-white fw-bolder" title="Change Status" onclick="changeStatus(${leaveID},${newStatus})"><i class="fa fa-arrows-rotate"></i></a>`;

        var editBtn = `<button type="button" class="btn btn-sm text-decoration-none btn-info fw-bolder edit_emp_leave" data-leave-id="${esc(
          leaveID
        )}" data-leave-type="${esc(leaveType)}" data-reason="${esc(
          reason
        )}" data-from="${esc(fromDate)}" data-to="${esc(
          toDate
        )}" title="Edit Leave" data-bs-toggle="modal" data-bs-target="#editLeaveModal"><i class="fa fa-edit"></i></button>`;

        if (cols.eq(6).length) {
          cols
            .eq(6)
            .html(
              `${statusBadge} <span class="text-secondary fs-5">|</span> ${changeBtn} ${editBtn}`
            );
        }

        if (cols.eq(7).length) {
          cols.eq(7).html(`${changeBtn} ${editBtn}`);
        }
      }

      if (typeof toastr !== "undefined") {
        toastr.success("Status updated successfully", "Success");
      }
    },
    error: function (xhr, status, error) {
      alert("Failed to change status. Please try again.");
    },
  });
}

// delegated handler to populate edit modal from data-* attributes (vanilla JS)
document.addEventListener("click", (e) => {
  const btn = e.target.closest(".edit_emp_leave");
  if (!btn) return;

  const id = btn.getAttribute("data-leave-id") ?? btn.dataset.leaveId ?? "";
  const leaveType =
    btn.getAttribute("data-leave-type") ?? btn.dataset.leaveType ?? "";
  const reason = btn.getAttribute("data-reason") ?? btn.dataset.reason ?? "";
  const fromDate = btn.getAttribute("data-from") ?? btn.dataset.from ?? "";
  const toDate = btn.getAttribute("data-to") ?? btn.dataset.to ?? "";

  const setValue = (elemId, value) => {
    const el = document.getElementById(elemId);
    if (el) el.value = value;
  };

  setValue("leaveID", id);
  setValue("edit_leave_type", leaveType);
  setValue("edit_reason", reason);
  setValue("edit_from_date", fromDate);
  setValue("edit_to_date", toDate);
});

Array.from(edits)?.forEach((e) => {
  e?.addEventListener("click", (y) => {
    const tr = y.target?.closest("tr");
    const tds = tr?.getElementsByTagName("td") ?? [];

    const empName = tds[1]?.innerText ?? "";
    const empEmail = tds[2]?.innerText ?? "";
    const empContact = tds[3]?.innerText ?? "";
    const empJDate = tds[4]?.innerText ?? "";
    const empDob = tds[5]?.innerText ?? "";
    const empDepart = tds[6]?.innerText ?? "";
    const empDesignation = tds[7]?.innerText ?? "";
    const empPackages = tds[8]?.innerText ?? "";

    if (typeof unm1 !== "undefined" && unm1) unm1.value = empName;
    if (typeof jd1 !== "undefined" && jd1) jd1.value = empJDate;
    if (typeof dob1 !== "undefined" && dob1) dob1.value = empDob;
    if (typeof dep1 !== "undefined" && dep1) dep1.value = empDepart;
    if (typeof designation1 !== "undefined" && designation1)
      designation1.value = empDesignation;
    if (typeof package1 !== "undefined" && package1)
      package1.value = empPackages;

    const id = y.target?.id ?? "";
    if (typeof sno !== "undefined" && sno) sno.value = id;
    if (typeof editID !== "undefined" && editID) editID.value = id;
    if (empDesignation === "superadmin") {
      if (typeof editDelete !== "undefined" && editDelete)
        editDelete.value = id;
    }

    if (typeof empContact1 !== "undefined" && empContact1)
      empContact1.value = empContact;
    if (typeof empEmail1 !== "undefined" && empEmail1)
      empEmail1.value = empEmail;

    //* <---- toggle for open modal -----> */
    if (typeof $ === "function" && $("#EDITmodal").length) {
      $("#EDITmodal").modal("toggle");
    }
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
    const tr = h.target?.closest("tr");
    const tds = tr?.getElementsByTagName("td") ?? [];

    const departmentName = tds[6]?.innerText ?? "";
    const password = h.target.id;
    if (typeof department !== "undefined" && department)
      department.value = departmentName;
    if (typeof passwordID !== "undefined" && passwordID)
      passwordID.value = password;

    $("#forgetPasswordModal").modal("toggle");
  });
});
