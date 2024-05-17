// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

function direct(e){
  e.preventDefault();
  window.location.href = "index.php";
}

let modal = document.querySelector(".modal");
function tampilModal(){
  modal.style.display = "flex";
};

function tutupModal() {
  modal.style.display = "none";
}

let notes = document.querySelectorAll("#notes");
if(notes){
  notes.forEach(note => {
    let noteId = note.querySelector('.noteId').value;
    let btnHapus = note.querySelector('.icon_hapus');
    let btnEdit = note.querySelector('.icon_edit');
    let btnIya =  document.querySelector('.btnIya');
    let btnTidak =  document.querySelector('.btnTidak');
    note.addEventListener('click', function(e){
      if(e.target !== btnHapus && e.target !== btnEdit){
        window.location.href = "detailNote.php?id=" + noteId;
      }
      if(e.target === btnHapus){
        tampilModal();
        btnTidak.addEventListener('click', function () {
          tutupModal();
        });
        btnIya.addEventListener('click', function () {
          window.location.href = "hapusNote.php?id=" + noteId;
          tutupModal();
        });
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', function(){
  if(document.getElementById('profile')){
    let userProfileEdit = document.querySelector('.user-profile-edit');
    let image = document.querySelector('.user-profile-edit img');
    let pencil = document.querySelector('.pencil');
    if(userProfileEdit){
      userProfileEdit.addEventListener('mouseover', function () {
        pencil.style.display = "block";
        image.style.opacity = "0.7";
      });
      userProfileEdit.addEventListener('mouseout', function(){
        pencil.style.display = "none";
        image.style.opacity = "1";
      });
      userProfileEdit.addEventListener('click', function () {
        let inputGambar = document.getElementById("inputGambar");
        inputGambar.click();
      });
    }
    let btnEditProfile = document.getElementById('btnEditProfile');
    if(btnEditProfile){
      btnEditProfile.addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = "updateProfile.php";
      });
    }
  }
  if(document.getElementById('noteForm')){
    let btnCancel = document.querySelector(".btn_cancel");
    let btnEdit = document.querySelector(".btn_edit");
    let inputColor = document.getElementById('note_color');
    let noteRed = document.querySelector(".colors .red");
    let noteBlue = document.querySelector(".colors .blue");
    let noteGreen = document.querySelector(".colors .green");
    let noteOrange = document.querySelector(".colors .orange");
    let toggleEye = document.getElementById('toggleIcon');
    let toggleEye2 = document.getElementById('toggleIcon2');
    
    if (toggleEye) {
      toggleEye.addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        const name = this.getAttribute('name') === 'eye-outline' ? 'eye-off-outline' : 'eye-outline';
        this.setAttribute('name', name);
      });
    }
    if (toggleEye2) {
      toggleEye2.addEventListener('click', function () {
        const passwordInput = document.getElementById('pwdRepeat');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        const name = this.getAttribute('name') === 'eye-outline' ? 'eye-off-outline' : 'eye-outline';
        this.setAttribute('name', name);
      });
    }
    if(noteRed){
      noteRed.addEventListener('click', function(){
        inputColor.value = "#ff686b";
        noteRed.style.borderColor = "#aaf683";
        noteBlue.style.borderColor = "#fff";
        noteGreen.style.borderColor = "#fff";
        noteOrange.style.borderColor = "#fff";
      });
    } 
    if(noteBlue){
      noteBlue.addEventListener('click', function(){
        inputColor.value = "#5aa9e6";
        noteRed.style.borderColor = "#fff";
        noteBlue.style.borderColor = "#aaf683";
        noteGreen.style.borderColor = "#fff";
        noteOrange.style.borderColor = "#fff";
      });
    }
    if(noteGreen){
      noteGreen.addEventListener('click', function(){
        inputColor.value = "#adf7b6";
        noteRed.style.borderColor = "#fff";
        noteBlue.style.borderColor = "#fff";
        noteGreen.style.borderColor = "#aaf683";
        noteOrange.style.borderColor = "#fff";
      });
    }
    if(noteOrange){
      noteOrange.addEventListener('click', function(){
        inputColor.value = "#ffd670";
        noteRed.style.borderColor = "#fff";
        noteBlue.style.borderColor = "#fff";
        noteGreen.style.borderColor = "#fff";
        noteOrange.style.borderColor = "#aaf683";
      });
    }
    if(btnCancel){
      btnCancel.addEventListener('click', function(e){
        e.preventDefault();
        window.history.back();
      });
    }
    if(btnEdit){
      let noteId = document.getElementById("noteId").value;
      btnEdit.addEventListener('click', function(e){
        e.preventDefault();
        window.location.href = "updateNote.php?id="+noteId;
      });
    }
  }
});

function formatTimestamp(timestamp){
  const date = new Date(timestamp);
  const formattedDate = date.toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
  return formattedDate;
};

let displayTime = document.querySelectorAll(".time-create");
displayTime.forEach(dTime => {
  let timestamps = dTime.innerText;
  dTime.innerText = formatTimestamp(timestamps);
});