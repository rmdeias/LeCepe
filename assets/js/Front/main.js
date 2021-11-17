

/*********************************Scroll to hide logo and fix navbar*************************************************/

var logo = document.getElementById("logo");
var mybutton = document.getElementById("myBtn");
var main = document.getElementsByTagName("main");
const isFirefox = typeof InstallTrigger !== 'undefined';

// When the user scrolls down from the top of the document logohidden and navabar fix to the top
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
   
    if(window.screen.width > 900){
        
      mybutton.classList.remove("sticky");
      logo.style.display = "flex";
      main[0].classList.remove("marginTopMain");

      if (document.body.scrollTop > 310 || document.documentElement.scrollTop > 310 ) {
      
        logo.style.display = "none";
        mybutton.classList.add("sticky");
        main[0].classList.add("marginTopMain");
      } 
    
    }
}

/*********************************Change Image Product Hover*************************************************/
function toObject(img, imgAlt) 
{
  var result=[];
  var test={};
  for (var i = 0; i < img.length;++i){
    test.img = img[i];
    test.alt = imgAlt[i];

    result.push([test.img, test.alt])
  }
  return result
}

var img = document.getElementsByClassName("img")
var imgAlt = document.getElementsByClassName("imgAlt")
var imgTab = toObject(img, imgAlt);

imgTab.forEach(
  
  function (image, index) {

   

    //For pc
    image[0].addEventListener("mouseover",function() 
    {
      image[0].classList.add("cache");
      image[1].classList.remove("cache");
    });
  
    image[1].addEventListener("mouseout",function() 
    {
      image[1].classList.add("cache");
      image[0].classList.remove("cache");
    });

    //For phone
    image[0].addEventListener("touchmove",function() 
    {
      image[0].classList.add("cache");
      image[1].classList.remove("cache");
    });
    
    image[1].addEventListener("touchend",function() 
    {
      image[0].classList.remove("cache");
      image[1].classList.add("cache");

    });
  }
)

/***************************   Card Link Hover ************************************/

function LinktoInner(info) 
{
  var result=[];
  var test=[];
  for (var i = 0; i < info.length;++i){
    test[i] = info[i];
  
    result.push(test[i])
  }
  return result
}

function LinkOver(overLink, message){

  overLink.forEach(
  
    function (link, index) {
  
      var name = link.textContent;
      //For pc
      link.addEventListener("mouseover",function() 
      {
        link.textContent = message;
      });
  
      link.addEventListener("mouseout",function() 
      {
        link.textContent = name;
      });

      //For phone
      link.addEventListener("touchmove",function() 
      {
        link.textContent = message;
      });
  
      link.addEventListener("touchend",function() 
      {
        link.textContent = name;
      });
    
    }
  )

}

var bandsName = document.getElementsByClassName("bandName");
var albumsTitle = document.getElementsByClassName("albumTitle");
 
var bandName = LinktoInner(bandsName);
var albumTitle = LinktoInner(albumsTitle);
 
LinkOver(bandName, "Go to Artist page");
LinkOver(albumTitle, "Go to Album page");

