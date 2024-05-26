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

function clearEventListeners(element) {
  let newElement = element.cloneNode(true);
  element.parentNode.replaceChild(newElement, element);
  return newElement;
}

let modal = document.querySelector(".bg-modal");
function tampilModal(){
  let modalWindow = modal.querySelector(".modal");
  modal.style.display = "block";
  modalWindow.style.animation = "fadeIn 0.4s";
};

function tutupModal() {
  let modalWindow = modal.querySelector(".modal");
  modalWindow.style.animation = "fadeOut 0.4s";
  modalWindow.addEventListener('animationend', function(){
    modal.style.display = "none";
  }, {once: true});
}

const urlParams = new URLSearchParams(window.location.search);
if(modal){
  let modalMsg = modal.querySelector(".teks");
  let gambarModal = modal.querySelector("img");
  let btn1 =  document.querySelector('.btn-1');
  let btn2 =  document.querySelector('.btn-2');
  if(urlParams.get('status') === 'success'){
    tampilModal();
    let imgPath = "assets/imgs/checklist.png";
    gambarModal.setAttribute("src", imgPath);
    if(urlParams.get('message') === 'addsuccess'){
      modalMsg.innerText = "Berhasil menambah note!";
    } else if(urlParams.get('message') === 'delsuccess'){
      modalMsg.innerText = "Berhasil menghapus note!";
    } else if(urlParams.get('message') === 'updtsuccess'){
      modalMsg.innerText = "Berhasil update note!";
    } else if(urlParams.get('message') == 'regsuccess'){
      modalMsg.innerText = "Berhasil membuat akun!";
    } else if(urlParams.get('message') == 'profileupdt'){
      modalMsg.innerText = "Berhasil update profile!";
    }
  } else if(urlParams.get('status') === 'failed'){
    tampilModal();
    let imgPath = "assets/imgs/remove.png";
    gambarModal.setAttribute("src", imgPath);
    if(urlParams.get('message') === 'addfailed'){
      modalMsg.innerText = "Gagal menambah note!";
    } else if(urlParams.get('message') === 'delfailed') {
      modalMsg.innerText = "Gagal menghapus note!";
    } else if(urlParams.get('message') === 'updtfailed'){
      modalMsg.innerText = "Gagal update note!";
    } else if(urlParams.get('message') == 'invalidpwd'){
      modalMsg.innerText = "Password dan Ulangi Password harus sama!";
    } else if(urlParams.get('message') == 'regfailed'){
      modalMsg.innerText = "Gagal membuat akun!";
    } else if(urlParams.get('message') == 'invalidimg'){
      modalMsg.innerText = "Format file pada gambar salah!";
    } else if(urlParams.get('message') == 'oversizeimg'){
      modalMsg.innerText = "Gambar tidak boleh lebih dari 2 MB!";
    } else if(urlParams.get('message') == 'failprofileupdt'){
      modalMsg.innerText = "Update profile gagal!";
    } else if(urlParams.get('message') == 'usernamenotfound'){
      modalMsg.innerText = "Username anda salah!";
    } else if(urlParams.get('message') == 'wrongpassword'){
      modalMsg.innerText = "Password anda salah!";
    } 
  }
  btn1.innerText = "Oke";
  btn1.style.cursor = "pointer";
  btn2.style.display = "none";
  btn1 = clearEventListeners(btn1);
  btn2 = clearEventListeners(btn2);
  btn1.addEventListener('click', function () {
    tutupModal();
  });

  function eventNotes() {
    let notes = document.querySelectorAll("#notes");
    if(notes){
      notes.forEach(note => {
        let noteId = note.querySelector('.noteId').value;
        let btnHapus = note.querySelector('.icon_hapus');
        let btnEdit = note.querySelector('.icon_edit');
        note.addEventListener('click', function(e){
          if(e.target !== btnHapus && e.target !== btnEdit){
            window.location.href = "detailNote.php?id=" + noteId;
          }
          if(e.target === btnHapus){
            tampilModal();
            let imgPath = "assets/imgs/question.png";
            gambarModal.setAttribute("src", imgPath);
            btn1.classList.add("btnTidak");
            btn1.innerText = "Tidak";
            btn2.classList.add("btnIya");
            btn2.innerText = "Iya";
            btn2.style.display = "inline";
            modalMsg.innerText = "Apakah Anda Yakin Ingin Menghapus?";
            if(modalMsg.innerText == "Apakah Anda Yakin Ingin Menghapus?"){
              btn1.addEventListener('click', function () {
                tutupModal();
              });
              btn2.addEventListener('click', function (e) {
                tutupModal();
                window.location.href = "hapusNote.php?id=" + noteId;
              });
            }
          }
        });
      });
    }
  }
  
  eventNotes();
}


function formatTimestamp(timestamp){
  const date = new Date(timestamp);
  const formattedDate = date.toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
  return formattedDate;
};

function formatTimestampAll() {
  let displayTime = document.querySelectorAll(".time-create");
  displayTime.forEach(dTime => {
    let timestamps = dTime.innerText;
    dTime.innerText = formatTimestamp(timestamps);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  let search = document.getElementById('search');
  let container = document.querySelector('.cardBox');
  if(search){
    search.addEventListener('keyup', function () {
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
          container.innerHTML = xhr.responseText;
          eventNotes();
          formatTimestampAll();
          let message = container.querySelector(".message");
          if(message !== null){
            container.style.display = "flex";
            container.style.justifyContent = "center";
            container.style.alignItems = "center";
            message.style.color = "#888"
          } else {
            container.style.display = "grid";
            messageEmpty();
          }   
        }
      }
      xhr.open('GET', 'ajax/notes.php?keyword='+search.value, true);
      xhr.send();
    });
  }
});

formatTimestampAll();

function messageEmpty(){
  let container = document.querySelector('.cardBox');
  let message = document.querySelector(".message");
  if(message !== null){
    container.style.display = "flex";
    container.style.justifyContent = "center";
    container.style.alignItems = "center";
    message.style.marginTop = "140px";
    message.style.color = "#888"
  } else {
    if (container) {
      container.style.display = "grid";
    }
  }   
}

messageEmpty();

document.addEventListener('DOMContentLoaded', function(){
  if(document.getElementById('profile')){
    let userProfileEdit = document.querySelector('.user-profile-edit');
    let image = document.querySelector('.user-profile-edit img');
    let pencil = document.querySelector('.pencil');
    if(userProfileEdit){
      pencil.style.display = "block";
      image.style.opacity = "0.7";
      let inputGambar = document.getElementById("inputGambar");
      let previousValue;
      userProfileEdit.addEventListener('click', function () {
        inputGambar.click();
      });
      inputGambar.addEventListener('change', function(e){
        const file = e.target.files[0];
        console.log(file.name);
        if(file){
          const reader = new FileReader();
          reader.onload = function(e) {
            image.src = e.target.result;
            previousValue = image.src;
          };
          reader.readAsDataURL(file);
        } else {
          image.src = previousValue;
        }
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
    let toggleEye = document.getElementById('toggleIcon');
    if (toggleEye) {
      toggleEye.addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        const name = this.getAttribute('name') === 'eye-outline' ? 'eye-off-outline' : 'eye-outline';
        this.setAttribute('name', name);
      });
    }
    let toggleEye2 = document.getElementById('toggleIcon2');
    if (toggleEye2) {
      toggleEye2.addEventListener('click', function () {
        const passwordInput = document.getElementById('pwdRepeat');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        const name = this.getAttribute('name') === 'eye-outline' ? 'eye-off-outline' : 'eye-outline';
        this.setAttribute('name', name);
      });
    }
    let inputColor = document.getElementById('note_color');
    let noteRed = document.querySelector(".colors .red");
    let noteBlue = document.querySelector(".colors .blue");
    let noteGreen = document.querySelector(".colors .green");
    let noteOrange = document.querySelector(".colors .orange");
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
    let btnCancel = document.querySelector(".btn_cancel");
    let btnEdit = document.querySelector(".btn_edit");
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

let btnLogout = document.getElementById("logout");
if(btnLogout){
  btnLogout.addEventListener('click', function(e){
    e.preventDefault();
    let modalMsg = modal.querySelector(".teks");
    let gambarModal = modal.querySelector("img");
    let btn1 =  document.querySelector('.btn-1');
    let btn2 =  document.querySelector('.btn-2');
    let imgPath = "assets/imgs/question.png";
    modalMsg.innerText = "Apakah anda yakin ingin keluar?";
    gambarModal.setAttribute("src", imgPath);
    btn2.style.display = "inline";
    btn1.innerText = "Tidak";
    btn2.innerText = "Iya";
    tampilModal();
    btn2.addEventListener('click', function(){
      window.location.href = "logout.php";
    });
    btn1.addEventListener('click', function (e){
      if(e.target !== btnLogout){
        tutupModal();
      }
    });
  });
}