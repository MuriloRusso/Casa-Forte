            
const inputThumb = document.querySelector('#upload');
            
const inputImage = document.querySelector('.upload-image');
    
const thumbImageText = 'Escolha uma imagem';
    
inputImage.innerHTML = thumbImageText;
    
    
inputThumb.addEventListener('change', function(e){

    const inputTarget = e.target;
    const file = inputTarget.files[0];
    
    if(file){
        
        const reader = new FileReader();
        
        reader.addEventListener('load', function(e){
                        
            const readerTarget = e.target;
                                
            const img = document.createElement('img');
        
            img.src = readerTarget.result;
            
            inputImage.innerHTML = '';
            
            inputImage.appendChild(img);

            setTimeout(function(){

                document.querySelector('#img-atual').style.display = 'none';


            }, 2000);

            document.querySelector('#img-atual').style.display = 'none';

            try{

                document.querySelector('#img-atual').style.display = 'none';

            }

            catch{}
                                
                                
        });
        
        reader.readAsDataURL(file);
        
    }
    
    else{
        
        inputImage.innerHTML = thumbImageText;
        
    }

});	