function triggerClick(selBtn) {
  $(selBtn).trigger("click");
}
function checkMatch(sel1,sel2) {
  var str1 = $(sel1).val();
  var str2 = $(sel2).val();
  if (str1 != str2) {
    $(sel1).css('box-shadow', '0 0 2px rgb(220, 53, 69) inset');
    $(sel1).css('border', '1px solid rgb(220, 53, 69)');
    $(sel2).css('box-shadow', '0 0 2px rgb(220, 53, 69) inset');
    $(sel2).css('border', '1px solid rgb(220, 53, 69)');
    return false;
  }
  else if (str1 == str2) {
    $(sel1).css('box-shadow', '0 0 2px #16C88C inset');
    $(sel1).css('border', '1px solid #16C88C');
    $(sel2).css('box-shadow', '0 0 2px #16C88C inset');
    $(sel2).css('border', '1px solid #16C88C');
    return true;
  }
}

function checkNview(input, which) {
  if(which == "add") {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var imgSize = input.files[0].size / 1024;
      if (imgSize > 500) {
        $('.addimgSizeAlert').text("Sorry, your profile image is larger than limit.");
      }
      else {
        reader.onload = function(e) {
          $('.addProfileImg').attr('src',e.target.result);
          $('.addimgSizeAlert').text("");
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  }
  else if (which == "edit") {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var imgSize = input.files[0].size / 1024;
      if (imgSize > 500) {
        $('.editimgSizeAlert').text("Sorry, your profile image is larger than limit.");
      }
      else {
        reader.onload = function(e) {
          $('.editProfileImg').attr('src',e.target.result);
          $('.editimgSizeAlert').text("");
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  }
}

$(window).on("load", function () {

  $('.loader').fadeOut(function () {
    $('.loader').remove();
  });
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });

  window.addEventListener("scroll", yScroll);

  var pageHeaderHeight = $('.page-header').outerHeight();
  var logoDivHeight = $('.logo-div').outerHeight();
  var windowHeight = $(window).height();

  var yPos;
  function yScroll(){
    yPos = window.pageYOffset;
    if(yPos > logoDivHeight) {
      $('.first-division').css("padding-top",pageHeaderHeight);
      $('.page-header').css("position","fixed");
      $('.logo-div').hide(0);
    }
    else {
      $('.first-division').css("padding-top","0");
      $('.page-header').css("position","static");
      $('.logo-div').show(0);
    }
    if(yPos > windowHeight) {
      $('.go-up').fadeIn();
    }
    else {
      $('.go-up').fadeOut();
    }
  }

  $('.crop-text').each(function() {
    var crop = $(this).text();
    if (crop.length > 100) {
      crop = crop.substring(0, 100);
      $(this).text(crop + "...");
    }
  });

  $('.crop-text-lg').each(function() {
    var crop = $(this).text();
    if (crop.length > 200) {
      crop = crop.substring(0, 200);
      $(this).text(crop + "...");
    }
  });

  function createMasonry () {
    function createColumn() {
      var mediaWidth = $(window).width();
      if(mediaWidth >= 768 && mediaWidth <= 991) {
        for (var i = 0; i < 2; i++) {
          $("<div class='col-12 col-md-6 col-lg-4 mb-4'></div>").appendTo('.masonry .row');
        }
      }
      else if (mediaWidth < 768) {
        $("<div class='col-12 col-md-6 col-lg-4 mb-4'></div>").appendTo('.masonry .row');
      }
      else {
        for (var i = 0; i < 3; i++) {
          $("<div class='col-12 col-md-6 col-lg-4 mb-4'></div>").appendTo('.masonry .row');
        }
      }
    }
  
    var noOfElement = $('.tmp-masonry').children('.card').length;
    $('.tmp-masonry').after("<div class='masonry mt-4'><div class='row'></div></div>");
    createColumn();
    var noOfCol = $('.masonry .row > div').length;
    var whichCol = 1;
    for (var i = noOfCol; i > 0; i--) {
      var tmpNum = i-1;
      var nthChild = ".tmp-masonry .card:nth-child("+i+"n-"+tmpNum+")";
      $(nthChild).each(function () {
        $(this).appendTo('.masonry .row > div:nth-child('+whichCol+')');
      });
      whichCol++;
    }
    $('.tmp-masonry').remove();
  }

  createMasonry();



$('.logo-div img').click(function () {
  location.replace("techtricitymm.com"); 
});

  $('.open-window-overlay').click(function () {
    var selector = $(this).attr("data");
    selector = "."+selector;
    $(selector).show(0);
    $('.window-overlay').fadeIn('fast');
  });

  $('.close-window-overlay').click(function () {
    $('.window-overlay').fadeOut('fast', function () {
      $('.window-overlay').children('div').hide(0);
    });
  });

  $('.go-up').click(function(){
    $('html,body').animate({ scrollTop: 0}, 'slow');
  });

  $('.editprofileImgValue').change(function () {
    var which = "edit";
    checkNview(this, which);
  });
  $('.addprofileImgValue').change(function () {
    var which = "add";
    checkNview(this, which);
  });

  $('.clearaddProfileImg').click(function () {
    $('.addProfileImg').attr('src','../img/profile.png');
    $('.addprofileImgValue').files[0] = '';
  });
  $('.cleareditProfileImg').click(function () {
    $('.editProfileImg').attr('src','../img/profile.png');
    $('.editprofileImgValue').files[0] = '';
  });

  $('.keywordValue').keyup(function (e) {
    var fakeTag = $(this).val();
    $(this).val(fakeTag.toLowerCase());
    if(e.which == 35 || e.which == 32) {
      var str = $(this).val();
      if(str.indexOf('#') != -1 && str.indexOf(' ') != -1) {
        var val = str.substring(str.lastIndexOf("#") + 1, str.lastIndexOf(" "));
        if(val != ''){
          var hiddenKeyword = $('.hidden').val();
          if(hiddenKeyword == '') {
            hiddenKeyword += val;
            $('.hidden').val(hiddenKeyword);
            val = "<span class='badge badge-pill bg-theme mb-3 mx-1 py-1 px-2'>"+val+"<span class='fas fa-times fa-sm ml-2 remove-tag' style='cursor: pointer;'></span></span>";
            $('.keyword-bubble').append(val);
            $(this).val(''); 
          }
          else {
            if(hiddenKeyword.length == val.length) {
              if(hiddenKeyword.indexOf(val) == -1 ) {
                hiddenKeyword += ", "+val;
                $('.hidden').val(hiddenKeyword);
                val = "<span class='badge badge-pill bg-theme mb-3 mx-1 py-1 px-2'>"+val+"<span class='fas fa-times fa-sm ml-2 remove-tag' style='cursor: pointer;'></span></span>";
                $('.keyword-bubble').append(val);
                $(this).val(''); 
              }
            }
            else {
              if(hiddenKeyword.indexOf(val+",") == -1 && hiddenKeyword.indexOf(", "+val) == -1) {
                hiddenKeyword += ", "+val;
                $('.hidden').val(hiddenKeyword);
                val = "<span class='badge badge-pill bg-theme mb-3 mx-1 py-1 px-2'>"+val+"<span class='fas fa-times fa-sm ml-2 remove-tag' style='cursor: pointer;'></span></span>";
                $('.keyword-bubble').append(val);
                $(this).val(''); 
              }
            }
          }
        }
      }
    }
    $('.remove-tag').click(function () {
      var tagVal = $(this).parent().text();
      var str = $('.hidden').val();
      if ((str.indexOf(tagVal) == 0 && tagVal.length == str.length) || str.indexOf(tagVal) == 0) {
        var temp = str.replace(tagVal, '');
        temp = temp.replace(', ','');
        $('.hidden').val(temp);
      }
      else {
        tagVal = ", "+tagVal;
        var temp = str.replace(tagVal, '');
        $('.hidden').val(temp);
      }
      $(this).parent().remove();
    });
  });

  if($('.keyword-bubble').children().length == 0) {
    $('.hidden').val('');
  }

});

$('.remove-tag-old').click(function () {
  var tagVal = $(this).parent().text();
  var str = $('.hidden').val();
  if ((str.indexOf(tagVal) == 0 && tagVal.length == str.length) || str.indexOf(tagVal) == 0) {
    var temp = str.replace(tagVal, '');
    temp = temp.replace(', ','');
    $('.hidden').val(temp);
  }
  else {
    tagVal = ", "+tagVal;
    var temp = str.replace(tagVal, '');
    $('.hidden').val(temp);
  }
  $(this).parent().remove();
});


//Text Editor

$(document).ready(function () {
  
  $('.editor').on('focus', function () {
    $('.placeholder').fadeOut('fast', function () {
      $('.placeholder').remove();
    });
  });

  $('.text-bold-btn').click(function() {
    document.execCommand('bold');
  });
  $('.text-italic-btn').click(function() {
    document.execCommand('italic');
  });
  $('.text-underline-btn').click(function() {
    document.execCommand('underline');
  });
  $('.text-strikethrough-btn').click(function() {
    document.execCommand('strikethrough');
  });
  $('.text-superscript-btn').click(function() {
    document.execCommand('superscript');
  });
  $('.text-subscript-btn').click(function() {
    document.execCommand('subscript');
  });
  $('.text-list-ul-btn').click(function() {
    document.execCommand('insertunOrderedList');
  });
  $('.text-list-ol-btn').click(function() {
    document.execCommand('insertOrderedList');
  });
  $('.text-align-left-btn').click(function() {
    document.execCommand('justifyLeft');
  });
  $('.text-align-center-btn').click(function() {
    document.execCommand('justifyCenter');
  });
  $('.text-align-right-btn').click(function() {
    document.execCommand('justifyRight');
  });
  $('.text-align-justify-btn').click(function() {
    document.execCommand('justifyFull');
  });
  $('.insert-unlink-btn').click(function() {
    document.execCommand('unlink');
  });
  $('.insert-link-btn').click(function() {
    document.execCommand('createLink',false,'tempLink');
  });
  $('.add-link-value').click(function () {
    var url = $('.linkValue').val();
    $('.editor').children("a[href*='tempLink']").css('display','block');
    $('.editor').children("a[href*='tempLink']").attr('href',url);
  });
  $('.insert-image-btn').click(function() {
    document.execCommand('insertImage',false,'tempImage');
  });
  $('.insert-youtube-btn').click(function () {
    var youtubeLink = $('.youtubeValue').val().replace('https://youtu.be/','');
    youtubeLink = "<div><iframe class='d-block my-3' src='https://youtube.com/embed/"+youtubeLink+"' width='640px' height='360px' frameborder='0' allowfullscreen></iframe></div><br>";
    document.execCommand('insertHTML',false,youtubeLink).delay(100);
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $(".editor img[src='tempImage']").attr('src',e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  
  $(".imageValue").change(function() {
    readURL(this);
    $('.modal .close').trigger("click");
  });

  $('.post-upload').click(function () {
    $('.editor .placeholder').remove();
    var postImage = new Array(); // for storing base64 string
    var imageName = new Array(); // for sotring image name with path
    var d = new Date(); // for generating data time
    for(var i=0; i< $('.editor img').length; i++) {
      var tmp = '.editor img:eq('+i+')';
      postImage.push($(tmp).attr('src')); // for inserting base64 string to array
      var mime = $(tmp).attr('src').match(/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).*,.*/); // for finding file extention inbase 64 string
      mime = mime[1].replace('image/', '.');
      var n = '../images/'+d.toDateString()+d.getTime()+i;
      n = n.replace(/ /g,'')+mime;
      $(tmp).attr('src',n); // for replacing image src value with image name with server path
      imageName.push(n); // for inserting image name with path to array
    }
    var tmpBody = $('.editor').html();
    $('.body-of-post').val(tmpBody);

    var postTitle = $('.title-of-post').val();
    var postBody = $('.body-of-post').val();
    var postKeyword = $('.keyword-of-post').val();
    var postToken = $('.token').text();
    postImage = JSON.stringify(postImage);
    imageName = JSON.stringify(imageName);

    var postCat = '';
    postCat = $('.post-cat option:selected').attr("value");
    var favPost = '0';
    favPost = $('#favorite-post:checked').attr("value");

    var now = "";
    if($('.upload-state').text() == 'Edit Posts') {
      now = "edit";
    }
    else {
      now = "new";
    }

    $.post("../admin/upload.php",{
      title:postTitle,
      body:postBody,
      keyword:postKeyword,
      postImg:postImage,
      imgName:imageName,
      type:postCat, //Category for uploaded post
      favorite:favPost, //Checkbox value for 'favorite post'
      editORnot:now, //This is for condition whether 'edit post' or 'new post'
      token:postToken
    },
    function (response, status) {
    });
  });

  $('.editor-section .image-container').click(function(){
    var tmpLink = $(this).children('.overlay').children().children().children('.post-title').children('a').attr('href');
    location.replace(tmpLink);
  });

  $('.all-division .masonry .card img').click(function(){
    var tmpLink = $(this).parent().children('.post-title').children('a').attr('href');
    location.replace(tmpLink);
  });

  $('.popular-div .image-container').click(function(){
    var tmpLink = $(this).next().next('.post-title').children('a').attr('href');
    location.replace(tmpLink);
  });

  $('.overlap-card').prev('.image-container').click(function(){
    var tmpLink = $(this).next().children('.post-title').children('a').attr('href');
    location.replace(tmpLink);
  });

  $('.image-overlay-text').parent('.overlay').parent('.image-container').click(function(){
    var tmpLink = $(this).children().children().children('.post-title').children('a').attr('href');
    location.replace(tmpLink);
  });

  

});