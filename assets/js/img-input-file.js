
const inpFile = document.getElementById("inpFile");
const previewContainer = document.getElementById("img-preview__div");
const previewImage = previewContainer.querySelector(".image-preview__img");
const previewDefaultText = previewContainer.querySelector(
  ".image-preview__default-text"
);

inpFile.addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    previewDefaultText.style.display = "none";
    previewImage.style.display = "block";

    reader.addEventListener("load", function () {
      previewImage.setAttribute("src", this.result);
      console.log(previewImage);
    });

    reader.readAsDataURL(file);
  } else {
    previewDefaultText.style.display = null;
    previewImage.style.display = null;
    previewImage.setAttribute("src", "");
  }
});