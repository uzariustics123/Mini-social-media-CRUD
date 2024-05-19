let postdata = [];
$(".post").click(function () {
    writePost(userID);
  });
  function errorResponse(errorMsg){
    customSwal.fire({
        title: "Ooops!",
        text: errorMsg,
        icon: "error",
        showConfirmButton: true
      });
}
function getPosts(){
        let mainContent = document.querySelector('.video-stream');
    let postElem = '';
   $.ajax({
    url: 'api/getAllFeedPosts.php',
    method: 'GET',
    success: (response)=>{            
        console.log(response);
        try {
            let res = JSON.parse(response);
            if(res.status === 'success'){
                console.log('data', res.data);
                res.data.forEach( (post)=>{
                    let postID = post.post_id;
                    let postAuthorName = post.firstname +' '+post.lastname;
                    let postEmail = post.email;
                    let postTitle = post.title;
                    let postContent = post.content;
                    postdata[postID] = post;
                    postElem += `<div class="video-detail" post="${postID}">
                    <div class="video-content">
                    <div class="video-p-wrapper anim" style="--delay: .1s">
                    <div class="author-img__wrapper video-author video-p">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                        <path d="M20 6L9 17l-5-5" />
                    </svg>
                    <img class="author-img" src="https://a0.anyrgb.com/pngimg/1772/1960/material-design-icon-user-profile-avatar-ico-flat-facebook-icon-design-conversation-forehead.png" />
                    </div>
                    <div class="video-p-detail">
                    <div class="video-p-name">${postAuthorName}</div>
                    <div class="video-p-sub">${postEmail}</div>
                    </div>
                    <div class="button-wrapper">
                    <button class="comment">
                    <span class="material-icons md-14">chat_bubble</span>&nbsp;
                        Comments
                    </button>
                    <button class="comment red">
                    <span class="material-icons md-14">thumb_up</span>&nbsp;
                        Liked
                    </button>
                    <button class="comment morebtn" postid="${postID}">
                    <span class="material-icons md-14">sort</span>&nbsp;
                        More
                    </button>
                    </div>
                    </div>
                    <div class="video-p-title anim" style="--delay: .2s">${postTitle}</div>
                    <div class="video-p-subtitle anim" style="--delay: .3s">${postContent}</div>
                    </div>
                    </div>`;
                } );
                mainContent.innerHTML = postElem;
                customSwal.close();
                setClickEvents();
            }else{
                errorResponse(res.message);
            }
        } catch (error) {
            errorResponse(error);
            console.log(error);
        }
        
        
    },
    error: (xhr, status, error)=>{

    }
   });

    function setClickEvents(){
        $('.morebtn').on('click', (event)=>{
            console.log('postid', event.currentTarget.getAttribute('postid'));
            let postid = event.currentTarget.getAttribute('postid');
            let postElem = document.querySelector(`div[post='${[postid]}']`);
            customSwal.fire({
                title: "More actions",
                text: 'Choose what action you want to perform on this post',
                showConfirmButton: true,
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonText: 'Edit',
                cancelButtonText: 'Cancel',
                denyButtonText: 'Delete'
              }).then( (result)=>{
                console.log(result);
                if(result.isConfirmed){
                    editPost(postid);
                    console.log('userID',userID);
                }else if(result.isDenied){
                    deleteWarning(postid);
                }
              }).catch((error)=>{
                console.log(error);
              });
        });
    }
    
}
function deleteWarning(postid){
    customSwal.fire({
        title: "Warning!",
        text: 'Are you sure want you to delete post '+ postdata[postid].title +'?',
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: 'Proceed',
        icon: 'warning',
      }).then( (result)=>{
        console.log(result);
        if(result.isConfirmed){
            deletePost(postid);
            console.log('userID',userID);
        }
      }).catch((error)=>{
        console.log(error);
      });
}
async function writePost(userID){
    console.log('userID', userID);
    const { value: postValues } = await customSwal.fire({
        title: "Share your thoughts",
        html: `
          <input placeholder="Title" id="post-title" class="swal2-input">
          <textarea value="" placeholder="Write something..." id="post-content" class="swal2-textarea"></textarea>
        `,
        focusConfirm: false,
        confirmButtonText: 'Post',
        cancelButtonText: 'Discard',
        showCancelButton: true,
        preConfirm: () => {
          return { 
            title: document.getElementById("post-title").value,
            content: document.getElementById("post-content").value
        };
        }
      });
      if (postValues) {
        createPost(postValues.title, postValues.content, userID);
      }
}
async function editPost(postId){
    const { value: postValues } = await customSwal.fire({
        title: "Update Post",
        html: `
          <input placeholder="Title" id="post-title" value="${postdata[postId].title}" class="swal2-input">
          <textarea  placeholder="Write something..." id="post-content" class="swal2-textarea">${postdata[postId].content}</textarea>
        `,
        focusConfirm: false,
        confirmButtonText: 'Save',
        cancelButtonText: 'Discard',
        showCancelButton: true,
        preConfirm: () => {
          return { 
            title: document.getElementById("post-title").value,
            content: document.getElementById("post-content").value
        };
        }
      });
      if (postValues) {
        updatePost(postValues.title, postValues.content, postId);
      }
}
function createPost(title, content, userid){
    $.ajax({
        url: 'api/createPost.php',
        method: 'POST',
        data: {title: title, content: content, userid: userid},
        success: (response)=>{            
            console.log(response);
            try {
                let res = JSON.parse(response);
                if(res.status === 'success'){
                    customSwal.fire({
                        title: "Success!",
                        text: res.message,
                        icon: "success",
                        showConfirmButton: true
                      }).then( (result)=>{
                        getPosts();
                      }).catch((error)=>{
                        getPosts();
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
    })
};

function updatePost(title, content, postid){
    $.ajax({
        url: 'api/updatePost.php',
        method: 'POST',
        data: {title: title, content: content, postid: postid},
        success: (response)=>{            
            console.log(response);
            try {
                let res = JSON.parse(response);
                if(res.status === 'success'){
                    customSwal.fire({
                        title: "Success!",
                        text: res.message,
                        icon: "success",
                        showConfirmButton: true
                      }).then( (result)=>{
                        getPosts();
                      }).catch((error)=>{
                        getPosts();
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
    })
};


function deletePost(postid){
    customSwal.showLoading();
    $.ajax({
        url: 'api/deletePost.php',
        method: 'POST',
        data: {postid: postid},
        success: (response)=>{            
            console.log(response);
            try {
                customSwal.showLoading();
                let res = JSON.parse(response);
                if(res.status === 'success'){
                    customSwal.fire({
                        title: "Success!",
                        text: res.message,
                        icon: "success",
                        showConfirmButton: true
                      }).then( (result)=>{
                        getPosts();
                      }).catch((error)=>{
                        getPosts();
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