    const btnsLeft = document.querySelectorAll('.left');

    const btnsRight = document.querySelectorAll('.right');

    const itemsCarrousel = document.querySelectorAll('.carrousel-scroll-item');

    const containerCarrousel = document.querySelector('.carrousel-scroll .carrousel-scroll-itens .container-posts');

	itemsCarrousel[0].classList.add('active');


    for (let cont in btnsLeft){
    //for(let cont = 0; cont < btnsLeft.length; cont++){

        btnsLeft[cont].onclick = () => {

            console.log('Botão esquerdo ' + cont + ' Pressionado');

            let indexAtual;

            for(let item = 0; item < itemsCarrousel.length; item++){

                if(itemsCarrousel[item].classList.contains('active')){

                    indexAtual = item;

                    console.log(indexAtual);

                }

            }

            if(indexAtual > 0){

                indexAtual--

                console.log('indice: ' + indexAtual)

                //indexAtual = itemsCarrousel.length - 1;


//                containerCarrousel.style.transform =  "translateX(-" + indexAtual + "00%)";
				
				containerCarrousel.style.transform =  "translateX(-" + ((indexAtual) * 250) + "px)";

                document.querySelector('.carrousel-scroll .active').classList.remove('active');

                itemsCarrousel[indexAtual].classList.add('active');

            }

            else{

                indexAtual = itemsCarrousel.length - 7;

                //indexAtual--;

//                containerCarrousel.style.transform =  "translateX(-" + indexAtual + "00%)";

				containerCarrousel.style.transform =  "translateX(-" + ((indexAtual) * 250) + "px)";
				
                document.querySelector('.carrousel-scroll .active').classList.remove('active');

                itemsCarrousel[indexAtual].classList.add('active');

            }

        }

    }













    //right


    for (let cont in btnsRight){

        btnsRight[cont].onclick = () => {

            let indexAtual;

            for(let item = 0; item < itemsCarrousel.length; item++){

                if(itemsCarrousel[item].classList.contains('active')){

                    indexAtual = item;

                }

            }

            if(indexAtual === itemsCarrousel.length - 7){

                indexAtual = 0;

                //indexAtual = itemsCarrousel.length - 1;


//                containerCarrousel.style.transform =  "translateX(-" + indexAtual + "00%)";
				
				containerCarrousel.style.transform =  "translateX(-" + ((indexAtual) * 250) + "px)";

                document.querySelector('.carrousel-scroll .active').classList.remove('active');

                itemsCarrousel[indexAtual].classList.add('active');

            }

            else{

                indexAtual++;

                //indexAtual--;

//                containerCarrousel.style.transform =  "translateX(-" + indexAtual + "00%)";
				
				containerCarrousel.style.transform =  "translateX(-" + ((indexAtual) * 250) + "px)";

                document.querySelector('.carrousel-scroll .active').classList.remove('active');

                itemsCarrousel[indexAtual].classList.add('active');

            }

        }

    }


	setInterval(()=>{
		
		document.querySelector('.right').click();
		
		
	}, 5000);



//    //efeito hover
//
//
//    const divsCarrousel = document.querySelectorAll('.container-carrousel div.container-posts');
//
//    const setas = document.querySelectorAll('.seta-carrousel');
//
//    for (let cont in divsCarrousel){
//
//        divsCarrousel[cont].onmouseenter = () => {
//
//            for (let seta in setas){
//
//                setas[seta].classList.add('opacity-1');
//
//            }
//
//        }
//
//        divsCarrousel[cont].onmouseout = () => {
//
//            for (let seta in setas){
//
//                setas[seta].classList.remove('opacity-1');
//
//            }
//
//        }
//
//    }