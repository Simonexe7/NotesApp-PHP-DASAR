// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

let btnCancel = document.querySelector(".btn_cancel");
console.log(btnCancel);
btnCancel.addEventListener('click', function (e) {
  e.preventDefault();
  window.location.href = "index.php";
  console.log("ok");
});

let btnHapus = document.querySelectorAll(".icon_hapus");
let modal = document.querySelector(".modal");
// console.log(btnHapus);
function tutupModal() {
  modal.style.display = "none";
  modal.classList.remove("active");
  modal.classList.add("non-active");
}

btnHapus.forEach((btn) => {
  tutupModal();
  btn.addEventListener('click', function (){
    modal.classList.remove("non-active");
    modal.classList.add("active");
    modal.style.display = "flex";
    console.log("ok");
  });
});
