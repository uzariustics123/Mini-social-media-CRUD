<?php
include_once('config/db.php');
session_start();
$userid = isset($_SESSION['userid']);
$userdata = '';
 if($userid){
// echo 'userid'. $_SESSION['userid'];
  $query = $db->prepare("SELECT * FROM users WHERE userid = ?");
  $query->bind_param('s', $userid);//binding variable and avoid sql injection
  $query->execute();
  $user = $query->get_result();
  $userdata = $user->fetch_assoc();

 }else{
header('location: index.php');
// echo 'inv userid'. $_SESSION['userid'];
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueGenMedia</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet" />
    <!-- <link href="https://fonts.googleapis.com/css2?family=Josefin&display=swap" rel="stylesheet" /> -->
    <link rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="plugins/@fortawesome/fontawesome-free/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>



<body>
<img src="images/nmsc-building.jpg" alt="sample image" class="blur-bg">
    <div class="container">
        <div class="sidebar">
         <span class="logo">S</span>
         <a class="logo-expand" href="#">BlueGenMedia</a>
         <div class="side-wrapper">
          <div class="side-title">MENU</div>
          <div class="side-menu">
           <a class="sidebar-link discover is-active" href="#">
            <svg viewBox="0 0 24 24" fill="currentColor">
             <path d="M9.135 20.773v-3.057c0-.78.637-1.414 1.423-1.414h2.875c.377 0 .74.15 1.006.414.267.265.417.625.417 1v3.057c-.002.325.126.637.356.867.23.23.544.36.87.36h1.962a3.46 3.46 0 002.443-1 3.41 3.41 0 001.013-2.422V9.867c0-.735-.328-1.431-.895-1.902l-6.671-5.29a3.097 3.097 0 00-3.949.072L3.467 7.965A2.474 2.474 0 002.5 9.867v8.702C2.5 20.464 4.047 22 5.956 22h1.916c.68 0 1.231-.544 1.236-1.218l.027-.009z" />
            </svg>
            Feeds
           </a>
           <a class="sidebar-link" href="#">
            <span class="material-icons md-14">person</span>
            Profile
           </a>


          </div>
         </div>
         <div class="side-wrapper">
          <div class="side-title">SESSION</div>
          <div class="side-menu">
           <a class="sidebar-link logout" href="#">
            <span class="material-icons md-14">power_settings_new</span>
            Logout
           </a>
          </div>
         </div>
        </div>



        <div class="wrapper">
         <div class="header">
          <div class="search-bar">
           <!-- <input class="search" type="text" placeholder="Search"> -->
           <div class="post">Write Something...</div>
          </div>
          <div class="user-settings">
           <img class="user-img" src="https://a0.anyrgb.com/pngimg/1772/1960/material-design-icon-user-profile-avatar-ico-flat-facebook-icon-design-conversation-forehead.png" alt="">
           <div class="user-name"><?php echo $userdata['firstname']; ?></div>
           <svg viewBox="0 0 492 492" fill="currentColor">
            <path d="M484.13 124.99l-16.11-16.23a26.72 26.72 0 00-19.04-7.86c-7.2 0-13.96 2.79-19.03 7.86L246.1 292.6 62.06 108.55c-5.07-5.06-11.82-7.85-19.03-7.85s-13.97 2.79-19.04 7.85L7.87 124.68a26.94 26.94 0 000 38.06l219.14 219.93c5.06 5.06 11.81 8.63 19.08 8.63h.09c7.2 0 13.96-3.57 19.02-8.63l218.93-219.33A27.18 27.18 0 00492 144.1c0-7.2-2.8-14.06-7.87-19.12z"></path>
           </svg>
           <div class="notify">
            <div class="notification"></div>
            <svg viewBox="0 0 24 24" fill="currentColor">
             <path fill-rule="evenodd" clip-rule="evenodd" d="M18.707 8.796c0 1.256.332 1.997 1.063 2.85.553.628.73 1.435.73 2.31 0 .874-.287 1.704-.863 2.378a4.537 4.537 0 01-2.9 1.413c-1.571.134-3.143.247-4.736.247-1.595 0-3.166-.068-4.737-.247a4.532 4.532 0 01-2.9-1.413 3.616 3.616 0 01-.864-2.378c0-.875.178-1.682.73-2.31.754-.854 1.064-1.594 1.064-2.85V8.37c0-1.682.42-2.781 1.283-3.858C7.861 2.942 9.919 2 11.956 2h.09c2.08 0 4.204.987 5.466 2.625.82 1.054 1.195 2.108 1.195 3.745v.426zM9.074 20.061c0-.504.462-.734.89-.833.5-.106 3.545-.106 4.045 0 .428.099.89.33.89.833-.025.48-.306.904-.695 1.174a3.635 3.635 0 01-1.713.731 3.795 3.795 0 01-1.008 0 3.618 3.618 0 01-1.714-.732c-.39-.269-.67-.694-.695-1.173z" />
            </svg>
           </div>
          </div>
          
         </div>


         <div class="main-container">
          <!-- chat stream 2 -->
          <div id="chat" class="chat-stream">
            <!-- <span id="chat-icon" class="material-icons">chat</span> -->
          <div class="chat">
           <div class="chat-header anim"><span id="back-chat" class="material-icons">chevron_left</span>
            Live Chat<span class="peps"><svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M14.212 7.762c0 2.644-2.163 4.763-4.863 4.763-2.698 0-4.863-2.119-4.863-4.763C4.486 5.12 6.651 3 9.35 3c2.7 0 4.863 2.119 4.863 4.762zM2 17.917c0-2.447 3.386-3.06 7.35-3.06 3.985 0 7.349.634 7.349 3.083 0 2.448-3.386 3.06-7.35 3.06C5.364 21 2 20.367 2 17.917zM16.173 7.85a6.368 6.368 0 01-1.137 3.646c-.075.107-.008.252.123.275.182.03.369.048.56.052 1.898.048 3.601-1.148 4.072-2.95.697-2.675-1.35-5.077-3.957-5.077a4.16 4.16 0 00-.818.082c-.036.008-.075.025-.095.055-.025.04-.007.09.019.124a6.414 6.414 0 011.233 3.793zm3.144 5.853c1.276.245 2.115.742 2.462 1.467a2.107 2.107 0 010 1.878c-.531 1.123-2.245 1.485-2.912 1.578a.207.207 0 01-.234-.232c.34-3.113-2.367-4.588-3.067-4.927-.03-.017-.036-.04-.034-.055.002-.01.015-.025.038-.028 1.515-.028 3.145.176 3.747.32z" />
             </svg>
             15,988 people
            </span>
           </div>
           <div class="message-container">
            <div class="message anim" style="--delay: .1s">
             <div class="author-img__wrapper video-author video-p">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
               <path d="M20 6L9 17l-5-5" />
              </svg>
              <img class="author-img" src="https://images.unsplash.com/photo-1560941001-d4b52ad00ecc?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1650&q=80" />
             </div>
             <div class="msg-wrapper">
              <div class="msg__name video-p-name"> Wijaya Adabi</div>
              <div class="msg__content video-p-sub"> Lorem ipsum clor sit, ame conse quae debitis</div>
             </div>
            </div>
            <div class="message anim" style="--delay: .2s">
             <div class="author-img__wrapper video-author video-p">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
               <path d="M20 6L9 17l-5-5" />
              </svg>
              <img class="author-img" src="https://images.pexels.com/photos/2889942/pexels-photo-2889942.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" />
             </div>
             <div class="msg-wrapper">
              <div class="msg__name video-p-name offline"> Johny Wise</div>
              <div class="msg__content video-p-sub"> Suscipit eos atque voluptates labore</div>
             </div>
            </div>
            <div class="message anim" style="--delay: .3s">
             <div class="author-img__wrapper video-author video-p">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
               <path d="M20 6L9 17l-5-5" />
              </svg>
              <img class="author-img" src="https://images.unsplash.com/photo-1496345875659-11f7dd282d1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mzl8fG1lbnxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
             </div>
             <div class="msg-wrapper">
              <div class="msg__name video-p-name offline"> Budi Hakim</div>
              <div class="msg__content video-p-sub">Dicta quidem sunt adipisci</div>
             </div>
            </div>
            <div class="message anim" style="--delay: .4s">
             <div class="author-img__wrapper video-author video-p">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
               <path d="M20 6L9 17l-5-5" />
              </svg>
              <img class="author-img" src="https://images.pexels.com/photos/1870163/pexels-photo-1870163.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" />
             </div>
             <div class="msg-wrapper">
              <div class="msg__name video-p-name"> Thomas Hope</div>
              <div class="msg__content video-p-sub"> recusandae doloremque aperiam alias molestias</div>
             </div>
            </div>
            <div class="message anim" style="--delay: .5s">
             <div class="author-img__wrapper video-author video-p">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
               <path d="M20 6L9 17l-5-5" />
              </svg>
              <img class="author-img" src="https://a0.anyrgb.com/pngimg/1772/1960/material-design-icon-user-profile-avatar-ico-flat-facebook-icon-design-conversation-forehead.png" />
             </div>
             <div class="msg-wrapper">
              <div class="msg__name video-p-name"> Gerard Will</div>
              <div class="msg__content video-p-sub">Dicta quidem sunt adipisci</div>
             </div>
            </div>
            <div class="message anim" style="--delay: .6s">
             <div class="author-img__wrapper video-author video-p">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
               <path d="M20 6L9 17l-5-5" />
              </svg>
              <img class="author-img" src="https://images.pexels.com/photos/2889942/pexels-photo-2889942.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" />
             </div>
             <div class="msg-wrapper">
              <div class="msg__name video-p-name offline">Johny Wise</div>
              <div class="msg__content video-p-sub"> recusandae doloremque aperiam alias molestias</div>
             </div>
            </div>

            <div class="message anim" style="--delay: .6s">
              <div class="author-img__wrapper video-author video-p">
               <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                <path d="M20 6L9 17l-5-5" />
               </svg>
               <img class="author-img" src="https://images.pexels.com/photos/2889942/pexels-photo-2889942.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" />
              </div>
              <div class="msg-wrapper">
               <div class="msg__name video-p-name offline">Johny Wise</div>
               <div class="msg__content video-p-sub"> recusandae doloremque aperiam alias molestias</div>
              </div>
             </div>

             <div class="message anim" style="--delay: .6s">
              <div class="author-img__wrapper video-author video-p">
               <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                <path d="M20 6L9 17l-5-5" />
               </svg>
               <img class="author-img" src="https://images.pexels.com/photos/2889942/pexels-photo-2889942.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" />
              </div>
              <div class="msg-wrapper">
               <div class="msg__name video-p-name offline">Johny Wise</div>
               <div class="msg__content video-p-sub"> recusandae doloremque aperiam alias molestias</div>
              </div>
             </div>

             <div class="message anim" style="--delay: .6s">
              <div class="author-img__wrapper video-author video-p">
               <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                <path d="M20 6L9 17l-5-5" />
               </svg>
               <img class="author-img" src="https://images.pexels.com/photos/2889942/pexels-photo-2889942.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" />
              </div>
              <div class="msg-wrapper">
               <div class="msg__name video-p-name offline">Johny Wise</div>
               <div class="msg__content video-p-sub"> recusandae doloremque aperiam alias molestias</div>
              </div>
             </div>

           </div>
           <div class="chat-footer anim" style="--delay: .1s">
           <div class="send-btn"></div>
            <input type="text" placeholder="Write your message">
           </div>
          </div>
         </div>
          <!-- end chat 2 -->
          <div class="main-header anim" style="--delay: 0s">Feeds</div>
          <div class=" stream-area">
           <div class="video-stream">


           </div>
           
          </div>
         </div>
        </div>
       </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
  const userID = "<?php echo $_SESSION['userid'];?>";
  const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
});
const customSwal = Swal.mixin({
  customClass: {
    confirmButton: "customSwalConfirmBtn",
    denyButton: "customSwalDenyBtn",
    cancelButton: "customSwalCancelBtn"
  },
  buttonsStyling: false
});
customSwal.showLoading();

    $(function () {
        $(".sidebar-link").click(function () {
         $(".sidebar-link").removeClass("is-active");
         $(this).addClass("is-active");
        });
        
        $("#back-chat").click(function () {
          if($("#chat").hasClass('mobile-mode')){
            $("#chat").removeClass("mobile-mode");
          }else{
            $("#chat").addClass("mobile-mode");
          }
          
          console.log('close chat');
         });

       });
       
       $(window)
        .resize(function () {
         if ($(window).width() > 1090) {
          $(".sidebar").removeClass("collapse");
         } else {
          $(".sidebar").addClass("collapse");
         }

         if ($(window).width() < 1035) {
          $("#chat").addClass("mobile-mode");
          //$("#chat").removeClass("chat-stream");
         } else {
          $("#chat").removeClass("mobile-mode");
          //$("#chat").addClass("chat-stream");
         }

        })
        .resize();
       
</script>
<script src="js/posts.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', ()=>{
    getPosts();
    // Swal.fire({
    //     title: "test!",
    //     text: "Email or password should not be empty",
    //     icon: "warning",
    //     showConfirmButton: true
    //   });
    $('.logout').on('click', ()=>{
      customSwal.fire({
                title: "Warning!",
                text: 'Do you want to logout?',
                showConfirmButton: true,
                showDenyButton: true,
                confirmButtonText: 'Logout',
                icon: 'warning',
              }).then( (result)=>{
                console.log(result);
                if(result.isConfirmed){
                  logout();
                }
              }).catch((error)=>{
                console.log(error);
              });
    });
});

function logout(){
  $.ajax({
        url: 'api/logout.php',
        method: 'POST',
        data: {},
        success: (response)=>{            
            console.log(response);
            try {
                customSwal.showLoading();
                let res = JSON.parse(response);
                if(res.status === 'success'){
                    customSwal.fire({
                        title: "Yay!",
                        text: res.message,
                        icon: "info",
                        showConfirmButton: true
                      }).then( (result)=>{
                        window.location.href = 'main.php';
                      }).catch((error)=>{
                        window.location.href = 'main.php';
                      });
                }else{
                    errorResponse(res.message);
                }
            } catch (error) {
                errorResponse(error);
                console.log(error);
            }
            function errorResponse(errorMsg){
                customSwal.fire({
                    title: "Ooops!",
                    text: errorMsg,
                    icon: "error",
                    showConfirmButton: true
                  });
            }
            
        },
        error: (xhr, status, error)=>{

        }
    });
}
</script>