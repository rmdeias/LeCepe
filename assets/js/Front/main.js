

/*********************************Scroll to hide navbar*************************************************/
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 90 || document.documentElement.scrollTop > 90) {
    mybutton.style.display = "none";
  } else {

   
    if(window.screen.width > 900){
      mybutton.style.display = "flex";
    }
   
  }

}

/*********************************Change Image*************************************************/
var img = document.getElementsByClassName("img")
var imgAlt = document.getElementsByClassName("imgAlt")

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

var imgTab = toObject(img, imgAlt);
console.log(imgTab);

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
      image[0].classList.remove("cache");
      image[1].classList.add("cache");

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