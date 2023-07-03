const avatarInput = document.querySelector('#avatarInput');

const avatarImg = document.querySelector('#avatarImg');

const avatarContainar = document.querySelector('#avatar-container');



avatarInput.addEventListener('change', function(e){

    const inputTarget = e.target;
    const file = inputTarget.files[0];
    
    if(file){

        const reader = new FileReader();
            
        reader.addEventListener('load', function(e){
                        
            const readerTarget = e.target;

            // console.log(readerTarget.result);

            const img = document.createElement('img');
        
            img.src = readerTarget.result;
            
            avatarContainar.innerHTML = '';
            
            avatarContainar.appendChild(img);

            // avatarImg.src = readerTarget.result;

        })

    }


})