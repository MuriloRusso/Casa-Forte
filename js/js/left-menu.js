
const itens = document.querySelectorAll('#left-menu li');

for (let cont in itens){

    itens[cont].onclick = ()=> {

        //verifica se já tem algum item selecionado, e se tiver, tira as classes de seleção 

        try{

            document.querySelector('#left-menu .active').classList.remove('active');

        }

        catch{}

        try{

            document.querySelector('#left-menu .top-active').classList.remove('top-active');

        }

        catch{}

        try{

            document.querySelector('#left-menu .bottom-active').classList.remove('bottom-active');

        }

        catch{}

        //-------------


        //ativa o item do menu


        itens[cont].classList.add('active');

        try{

            itens[cont - 1].classList.add('top-active');

        }

        catch{}

        try{

            console.log(cont + 1);

			console.log(2 + 1);

            itens[Number(cont) + 1].classList.add('bottom-active');

        }

        catch{}


        //----------------------------------------------

    }

	
}
