const flashdata = $(".flash-data").data("flashdata");

if (flashdata == "added") {
  Swal.fire({
    title: "SUCCESS",
    text: "Data berhasil disimpan!",
    icon: "success",
    confirmButtonText: "Oke",
  });
}
