//解决中文乱码
function utf16to8(str) { 
 
   var out, i, len, c;  
 
   out = "";  
 
   len = str.length;  
 
   for(i = 0; i < len; i++) {  
 
   c = str.charCodeAt(i);  
 
   if ((c >= 0x0001) && (c <= 0x007F)) {  
 
       out += str.charAt(i);  
 
   } else if (c > 0x07FF) {  
 
       out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));  
 
       out += String.fromCharCode(0x80 | ((c >>  6) & 0x3F));  
 
       out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));  
 
   } else {  
 
       out += String.fromCharCode(0xC0 | ((c >>  6) & 0x1F));  
 
       out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));  
 
   }  
 
   }  
 
   return out;  
 
}  
//解决中文乱码


//图片转base64
function getBase64Image(img) {
            var canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, img.width, img.height);
            var dataURL = canvas.toDataURL("image/jpeg");
            return dataURL // return dataURL.replace("data:image/png;base64,", ""); 
        } 
//图片转base64

//图片转base64
function getBase64Image_png(img) {
            var canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, img.width, img.height);
            var dataURL = canvas.toDataURL("image/png");
            return dataURL // return dataURL.replace("data:image/png;base64,", ""); 
        } 
//图片转base64

