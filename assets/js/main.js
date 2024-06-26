// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// fungsi untuk kembali ke halaman index
function direct(){
  window.location.href = "index.php";
}

// fungsi untuk clear event listener
function clearEventListeners(element) {
  let newElement = element.cloneNode(true);
  element.parentNode.replaceChild(newElement, element);
  return newElement;
}

let modal = document.querySelector(".bg-modal");
// fungsi untuk menampilkan modal
function tampilModal(){
  let modalWindow = modal.querySelector(".modal");
  modal.style.display = "block";
  modalWindow.style.animation = "fadeIn 0.4s";
};

// fungsi untuk menutup modal
function tutupModal() {
  let modalWindow = modal.querySelector(".modal");
  modalWindow.style.animation = "fadeOut 0.4s";
  modalWindow.addEventListener('animationend', function(){
    modal.style.display = "none";
  }, {once: true});
}

// fungsi untuk memodifikasi modal
const urlParams = new URLSearchParams(window.location.search);
if(modal){
  // mengumpulkan elemen modal
  let modalMsg = modal.querySelector(".teks");
  let gambarModal = modal.querySelector("img");
  let btn1 =  document.querySelector('.btn-1');
  let btn2 =  document.querySelector('.btn-2');

  // cek apakah url terdapat parameter status yang bernilai success
  if(urlParams.get('status') === 'success'){
    tampilModal();
    let imgPath = "assets/imgs/checklist.png";
    gambarModal.src = imgPath;
    // mengubah teks modal berdasarkan nilai parameter message pada url
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
  // cek apakah url terdapat parameter status yang bernilai failed
  } else if(urlParams.get('status') === 'failed'){
    tampilModal();
    let imgPath = "assets/imgs/remove.png";
    gambarModal.src = imgPath;
    // mengubah teks modal berdasarkan nilai parameter message pada url
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
  // menetapkan nilai default pada button modal
  btn1.innerText = "Oke";
  btn1.style.cursor = "pointer";
  btn2.style.display = "none";
  btn1 = clearEventListeners(btn1);
  btn2 = clearEventListeners(btn2);
  btn1.addEventListener('click', function () {
    tutupModal();
  });

  // fungsi untuk memberikan event pada notes
  function eventNotes() {
    let notes = document.querySelectorAll("#notes");
    if(notes){
      notes.forEach(note => {
        // mengumpulkan elemen pada note
        let noteId = note.querySelector('.noteId').value;
        let btnHapus = note.querySelector('.icon_hapus');
        let btnEdit = note.querySelector('.icon_edit');

        // ketika note di click jalankan sebuah fungsi
        note.addEventListener('click', function(e){
          // cek apakah yang diklik bukan tombol hapus dan tombol edit
          if(e.target !== btnHapus && e.target !== btnEdit){
            window.location.href = "detailNote.php?id=" + noteId;
          }
          // cek apakah yang diklik adalah tombol hapus
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
            // ketika tombol tidak pada modal diklik
            btn1.addEventListener('click', function () {
              tutupModal();
            });
            // ketika tombol iya pada modal diklik
            btn2.addEventListener('click', function (e) {
              tutupModal();
              window.location.href = "hapusNote.php?id=" + noteId;
            });
          }
        });
      });
    }
  }
  
  // selalu jalankan event pada notes
  eventNotes();
}

// fungsi untuk menampilkan modal konfirmasi logout
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

// fungsi untuk mengatur format waktu pada note
function formatTimestamp(timestamp){
  const date = new Date(timestamp);
  const formattedDate = date.toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
  return formattedDate;
};

// fungsi untuk menerapkan format waktu pada semua note
function formatTimestampAll() {
  let displayTime = document.querySelectorAll(".time-create");
  displayTime.forEach(dTime => {
    let timestamps = dTime.innerText;
    dTime.innerText = formatTimestamp(timestamps);
  });
}

// fungsi untuk mengecek apakah notes ada atau tidak
function messageEmpty(){
  let container = document.querySelector('.cardBox');
  let message = document.querySelector(".message");

  // jika kosong tampilkan pesan untuk membuat notes
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

// menerapkan format waktu pada notes 
formatTimestampAll();

// menampilkan pesan jika notes kosong
messageEmpty();

// fungsi untuk menjalankan fitur searching
document.addEventListener('DOMContentLoaded', () => {
  // mengumpulkan elemen yang akan dimodifikasi
  let search = document.getElementById('search');
  let container = document.querySelector('.cardBox');
  if(search){
    // pada input search ketika keyboard diklik jalankan sebuah fungsi
    search.addEventListener('keyup', function () {
      // menampilkan animasi loading
      let loading = document.getElementById('loading');
      container.style.display = "none";
      loading.style.display = "inline";

      // menjalankan ajax untuk searching secara asyncronus
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
          // menyembunyikan animasi loading ketika data pencarian didapat
          loading.style.display = "none";
          container.style.display = "flex";

          // menampilkan data yang dicari di halaman html
          container.innerHTML = xhr.responseText;

          // menjalankan semua event pada notes hasil pencarian
          eventNotes();

          // menerapkan format waktu pada notes hasil pencarian
          formatTimestampAll();

          // menampilkan pesan jika notes kosong
          messageEmpty();

          // let message = container.querySelector(".message");
          // if(message !== null){
          //   container.style.display = "flex";
          //   container.style.justifyContent = "center";
          //   container.style.alignItems = "center";
          //   message.style.color = "#888"
          // } else {
          //   container.style.display = "grid";
          //   messageEmpty();
          // }   
        }
      }
      xhr.open('GET', 'ajax/notes.php?keyword='+search.value, true);
      xhr.send();
    });
  }
});

document.addEventListener('DOMContentLoaded', function(){
  // fungsi pada halaman profile dan update profile 
  if(document.getElementById('profile')){
    // mengambil element pada halaman update profile
    let userProfileEdit = document.querySelector('.user-profile-edit');
    let image = document.querySelector('.user-profile-edit img');
    let pencil = document.querySelector('.pencil');
    if(userProfileEdit){
      pencil.style.display = "block";
      image.style.opacity = "0.7";
      userProfileEdit.addEventListener('click', function () {
        inputGambar.click();
      }); 
      // fungsi untuk menampilkan preview foto profile setelah diubah
      let inputGambar = document.getElementById("inputGambar");
      let previousValue;
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

  // fungsi untuk memodifikasi form
  if(document.getElementById('noteForm')){
    let toggleEye = document.getElementById('toggleIcon');
    if (toggleEye) {
      // fungsi untuk menampilkan password ketika tombol mata diklik
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
      // fungsi untuk menampilkan password ketika tombol mata kedua diklik
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

    // fungsi untuk memodifikasi input warna pada note
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