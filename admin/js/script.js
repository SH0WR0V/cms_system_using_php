$("#selectAllBoxs").click(function () {
  if (this.checked) {
    // Iterate each checkbox
    $(".checkBoxes").each(function () {
      this.checked = true;
    });
  } else {
    $(".checkBoxes").each(function () {
      this.checked = false;
    });
  }
});
