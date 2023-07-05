const btnMenuMob = document.querySelector('#btn-menu-mobile');

const btnCloseMenuMob = document.querySelector('#btn-close-menu-mobile');


btnMenuMob.onclick = () =>{

	document.querySelector('.menu-mobile').classList.add('open');

	btnMenuMob.classList.remove('open');

	btnCloseMenuMob.classList.add('open');
	
	// document.querySelector('.menu-mobile').style.display = 'block';

	// btnMenuMob.style.display = 'none';

	// btnCloseMenuMob.style.display = 'block';

}

btnCloseMenuMob.onclick = () =>{

	document.querySelector('.menu-mobile').classList.remove('open');

	btnMenuMob.classList.add('open');

	btnCloseMenuMob.classList.remove('open');



	// document.querySelector('.menu-mobile').style.display = 'none';

	// btnMenuMob.style.display = 'block';

	// btnCloseMenuMob.style.display = 'none';

}